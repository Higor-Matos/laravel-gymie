<?php

namespace App\Http\Controllers;

use Auth;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpensesController extends Controller
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
        $expenses = Expense::indexQuery($request->category_id, $request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $expenseTotal = Expense::indexQuery($request->category_id, $request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->get();
        $count = $expenseTotal->sum('amount');

        if (! $request->has('drp_start') or ! $request->has('drp_end')) {
            $drp_placeholder = 'Selecione o filtro de intervalo de datas';
        } else {
            $drp_placeholder = $request->drp_start.' - '.$request->drp_end;
        }

        $request->flash();

        return view('expenses.index', compact('expenses', 'count', 'drp_placeholder'));
    }

    /**
     * Exibir o recurso especificado.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $expense = Expense::findOrFail($id);

        return view('expenses.show', compact('expense'));
    }

    /**
     * Mostrar o formulário para criar um novo recurso.
     *
     * @return Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Armazenar um recurso recém-criado no armazenamento.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $expenseData = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'due_date' => Carbon::createFromFormat('d/m/Y', $request->due_date)->format('Y-m-d'),
            'repeat' => $request->repeat,
            'note' => $request->note,
            'amount' => $request->amount,
        ];

        $expense = new Expense($expenseData);
        $expense->createdBy()->associate(Auth::user());
        $expense->updatedBy()->associate(Auth::user());
        $expense->save();

        if ($request->due_date <= Carbon::today()->format('d/m/Y')) {
            $expense->paid = \constPaymentStatus::Paid;
        } else {
            $expense->paid = \constPaymentStatus::Unpaid;
        }

        $expense->createdBy()->associate(Auth::user());

        $expense->save();
        flash()->success('Despesa foi adicionada com sucesso');

        return redirect('expenses/all');
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);

        return view('expenses.edit', compact('expense'));
    }

    public function update($id, Request $request)
    {
        $expense = Expense::findOrFail($id);

        $expenseData = $request->all();
        $expenseData['due_date'] = Carbon::createFromFormat('d/m/Y', $request->due_date)->format('Y-m-d');
        $expense->update($expenseData);

        if ($request->due_date == Carbon::today()->format('d/m/Y')) {
            $expense->paid = \constPaymentStatus::Paid;
        } elseif ($request->due_date != Carbon::today()->format('d/m/Y') && $expense->paid == \constPaymentStatus::Paid) {
            $expense->paid = \constPaymentStatus::Paid;
        } else {
            $expense->paid = \constPaymentStatus::Unpaid;
        }

        $expense->updatedBy()->associate(Auth::user());

        $expense->save();
        flash()->success('Despesa foi atualizada com sucesso');

        return redirect('expenses/all');
    }

    public function paid($id, Request $request)
    {
        Expense::where('id', '=', $id)->update(['paid' => \constPaymentStatus::Paid]);

        flash()->success('Despesa foi paga com sucesso');

        return redirect('expenses/all');
    }

    public function delete($id)
    {
        Expense::destroy($id);

        return redirect('expenses/all');
    }
}
