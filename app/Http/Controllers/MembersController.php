<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Log;
use App\Member;
use JavaScript;
use App\Enquiry;
use App\Invoice;
use App\Service;
use App\Setting;
use Carbon\Carbon;
use App\SmsTrigger;
use App\ChequeDetail;
use App\Subscription;
use App\InvoiceDetail;
use App\PaymentDetail;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Exibir uma lista do recurso.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $members = Member::indexQuery($request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $count = $members->total();

        $drp_placeholder = $this->drpPlaceholder($request);

        $request->flash();

        return view('members.index', compact('members', 'count', 'drp_placeholder', 'old_sort'));
    }

    public function active(Request $request)
    {
        $members = Member::active($request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $count = $members->total();

        $drp_placeholder = $this->drpPlaceholder($request);

        $request->flash();

        return view('members.active', compact('members', 'count', 'drp_placeholder', 'old_sort'));
    }

    public function inactive(Request $request)
    {
        $members = Member::inactive($request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $count = $members->total();

        $drp_placeholder = $this->drpPlaceholder($request);

        $request->flash();

        return view('members.inactive', compact('members', 'count', 'drp_placeholder', 'old_sort'));
    }

    /**
     * Exibir o recurso especificado.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);

        return view('members.show', compact('member'));
    }

    /**
     * Mostrar o formulário para criar um novo recurso.
     *
     * @return Response
     */
    public function create()
    {
        // Para cálculo de impostos
        JavaScript::put([
            'taxes' => \Utilities::getSetting('taxes'),
            'gymieToday' => Carbon::today()->format('d/m/Y'),
            'servicesCount' => Service::count(),
        ]);

        // Obter modo de numeração
        $invoice_number_mode = \Utilities::getSetting('invoice_number_mode');
        $member_number_mode = \Utilities::getSetting('member_number_mode');

        // Gerando número da fatura
        if ($invoice_number_mode == \constNumberingMode::Auto) {
            $invoiceCounter = \Utilities::getSetting('invoice_last_number') + 1;
            $invoicePrefix = \Utilities::getSetting('invoice_prefix');
            $invoice_number = $invoicePrefix.$invoiceCounter;
        } else {
            $invoice_number = '';
            $invoiceCounter = '';
        }

        // Gerando número do membro
        if ($member_number_mode == \constNumberingMode::Auto) {
            $memberCounter = \Utilities::getSetting('member_last_number') + 1;
            $memberPrefix = \Utilities::getSetting('member_prefix');
            $member_code = $memberPrefix.$memberCounter;
        } else {
            $member_code = '';
            $memberCounter = '';
        }

        return view('members.create', compact('invoice_number', 'invoiceCounter', 'member_code', 'memberCounter', 'member_number_mode', 'invoice_number_mode'));
    }

    /**
     * Armazenar um novo recurso no armazenamento.
     *
     * @return Response
     */

    public function store(Request $request)
    {
        Log::info('Iniciando o processo de criação de um novo membro');

        // Validação do Modelo do Membro
        $this->validate($request, [
            'email' => 'unique:mst_members,email',
            'contact' => 'unique:mst_members,contact',
            'member_code' => 'unique:mst_members,member_code',
            'DOB' => 'required|date_format:d/m/Y',
            'photo' => 'image|max:2048', // Removido o 'required'
            'proof_photo' => 'image|max:2048', // Removido o 'required'
        ]);

        Log::info('Validação dos dados do membro concluída');

        // Start Transaction
        DB::beginTransaction();

        try {
            Log::info('Iniciando transação de banco de dados');

            // Store member's personal details
            $dob = Carbon::createFromFormat('d/m/Y', $request->DOB)->format('Y-m-d');
            $memberData = [
                'name' => $request->name,
                'DOB' => $dob,
                'gender' => $request->gender,
                'contact' => $request->contact,
                'emergency_contact' => $request->emergency_contact,
                'health_issues' => $request->health_issues,
                'email' => $request->email,
                'address' => $request->address,
                'member_code' => $request->member_code,
                'status' => $request->status,
                'pin_code' => $request->pin_code,
                'occupation' => $request->occupation,
                'aim' => $request->aim,
                'source' => $request->source,
            ];

            Log::info('Dados do membro preparados', $memberData);

            $member = new Member($memberData);
            $member->createdBy()->associate(Auth::user());
            $member->updatedBy()->associate(Auth::user());
            $member->save();

            Log::info('Membro criado com sucesso', ['id' => $member->id]);

            // Adding media i.e. Profile & proof photo
            if ($request->hasFile('photo')) {
                Log::info('Adicionando foto de perfil');
                $member->addMedia($request->file('photo'))->usingFileName('profile_'.$member->id.'.'.$request->photo->getClientOriginalExtension())->toCollection('profile');
            }

            if ($request->hasFile('proof_photo')) {
                Log::info('Adicionando foto de prova');
                $member->addMedia($request->file('proof_photo'))->usingFileName('proof_'.$member->id.'.'.$request->proof_photo->getClientOriginalExtension())->toCollection('proof');
            }

            // Resto do código para armazenar fatura, assinatura, detalhes de pagamento, etc.

            DB::commit();
            Log::info('Transação de banco de dados concluída com sucesso');
            flash()->success('Membro foi criado com sucesso');

            return redirect(action('MembersController@show', ['id' => $member->id]));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Erro ao criar o membro: ', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            flash()->error('Erro ao criar o membro');

            return redirect(action('MembersController@index'));
        }
    }


    // Fim de novo membro

    // Fim do método store

    /**
     * Editar um recurso criado no armazenamento.
     *
     * @return Response
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $member_number_mode = \Utilities::getSetting('member_number_mode');
        $member_code = $member->member_code;

        return view('members.edit', compact('member', 'member_number_mode', 'member_code'));
    }

    /**
     * Atualizar um recurso editado no armazenamento.
     *
     * @return Response
     */
    
    public function update($id, Request $request)
    {
        Log::info('Iniciando o processo de atualização de um membro', ['id' => $id]);

        $member = Member::findOrFail($id);

        $this->validate($request, [
            'email' => 'unique:mst_members,email,'.$member->id,
            'contact' => 'unique:mst_members,contact,'.$member->id,
            'member_code' => 'unique:mst_members,member_code,'.$member->id,
            'DOB' => 'date_format:Y-m-d',
            'photo' => 'required|image|max:2048',
            'proof_photo' => 'required|image|max:2048',
        ]);

        Log::info('Validação dos dados do membro concluída');

        DB::beginTransaction();

        try {
            $memberData = $request->only([
                'name', 'DOB', 'gender', 'contact', 'emergency_contact', 'health_issues',
                'email', 'address', 'member_code', 'status', 'pin_code', 'occupation',
                'aim', 'source'
            ]);

            $memberData['DOB'] = Carbon::createFromFormat('d/m/Y', $request->DOB)->format('Y-m-d');

            Log::info('Dados do membro preparados para atualização', $memberData);

            $member->update($memberData);

            Log::info('Membro atualizado com sucesso', ['id' => $member->id]);

            if ($request->hasFile('photo')) {
                Log::info('Atualizando foto de perfil');
                $member->clearMediaCollection('profile');
                $member->addMedia($request->file('photo'))->usingFileName('profile_'.$member->id.'.'.$request->photo->getClientOriginalExtension())->toCollection('profile');
            }

            if ($request->hasFile('proof_photo')) {
                Log::info('Atualizando foto de prova');
                $member->clearMediaCollection('proof');
                $member->addMedia($request->file('proof_photo'))->usingFileName('proof_'.$member->id.'.'.$request->proof_photo->getClientOriginalExtension())->toCollection('proof');
            }

            $member->updatedBy()->associate(Auth::user());
            $member->save();

            Log::info('Dados do membro atualizados e salvos', ['id' => $member->id]);

            DB::commit();
            flash()->success('Detalhes do membro foram atualizados com sucesso');

            return redirect(action('MembersController@show', ['id' => $member->id]));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Erro ao atualizar o membro: ', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            flash()->error('Erro ao atualizar o membro');

            return redirect(action('MembersController@edit', ['id' => $id]));
        }
    }


    /**
     * Arquivar um recurso no armazenamento.
     *
     * @return Response
     */
    public function archive($id, Request $request)
    {
        Subscription::where('member_id', $id)->delete();

        $invoices = Invoice::where('member_id', $id)->get();

        foreach ($invoices as $invoice) {
            InvoiceDetail::where('invoice_id', $invoice->id)->delete();
            $paymentDetails = PaymentDetail::where('invoice_id', $invoice->id)->get();

            foreach ($paymentDetails as $paymentDetail) {
                ChequeDetail::where('payment_id', $paymentDetail->id)->delete();
                $paymentDetail->delete();
            }

            $invoice->delete();
        }

        $member = Member::findOrFail($id);
        $member->clearMediaCollection('profile');
        $member->clearMediaCollection('proof');

        $member->delete();

        return back();
    }

    public function transfer($id, Request $request)
    {
        // Para cálculo de impostos
        JavaScript::put([
            'taxes' => \Utilities::getSetting('taxes'),
            'gymieToday' => Carbon::today()->format('d/m/Y'),
            'servicesCount' => Service::count(),
        ]);

        // Obter modo de numeração
        $invoice_number_mode = \Utilities::getSetting('invoice_number_mode');
        $member_number_mode = \Utilities::getSetting('member_number_mode');

        // Gerando número da fatura
        if ($invoice_number_mode == \constNumberingMode::Auto) {
            $invoiceCounter = \Utilities::getSetting('invoice_last_number') + 1;
            $invoicePrefix = \Utilities::getSetting('invoice_prefix');
            $invoice_number = $invoicePrefix.$invoiceCounter;
        } else {
            $invoice_number = '';
            $invoiceCounter = '';
        }

        // Gerando número do membro
        if ($member_number_mode == \constNumberingMode::Auto) {
            $memberCounter = \Utilities::getSetting('member_last_number') + 1;
            $memberPrefix = \Utilities::getSetting('member_prefix');
            $member_code = $memberPrefix.$memberCounter;
        } else {
            $member_code = '';
            $memberCounter = '';
        }

        $enquiry = Enquiry::findOrFail($id);

        return view('members.transfer', compact('enquiry', 'invoice_number', 'invoiceCounter', 'member_code', 'memberCounter', 'member_number_mode', 'invoice_number_mode'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    private function drpPlaceholder(Request $request)
    {
        if ($request->has('drp_start') and $request->has('drp_end')) {
            return $request->drp_start.' - '.$request->drp_end;
        }

        return 'Selecione o filtro de intervalo de datas';
    }
}
