<?php

namespace App\Http\Controllers;

use Auth;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpensesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $startDate = null;
        $endDate = null;

        if ($request->has('drp_start') && $request->has('drp_end')) {
            $startDate = Carbon::createFromFormat('d/m/Y', $request->drp_start)->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/Y', $request->drp_end)->format('Y-m-d');
        }

        $expensesQuery = Expense::indexQuery($request->category_id, $request->sort_field, $request->sort_direction, $startDate, $endDate)
                                ->search('"'.$request->input('search').'"');

        $expenses = $expensesQuery->paginate(10);
        $expenseTotal = $expensesQuery->get();
        $count = $expenseTotal->sum('amount');

        if (!$request->has('drp_start') || !$request->has('drp_end')) {
            $drp_placeholder = 'Selecione o filtro de intervalo de datas';
        } else {
            $drp_placeholder = $request->drp_start.' - '.$request->drp_end;
        }

        $request->flash();

        return view('expenses.index', compact('expenses', 'count', 'drp_placeholder'));
    }

    public function show($id)
    {
        $expense = Expense::findOrFail($id);

        return view('expenses.show', compact('expense'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        \Log::info($request->all());

        // Validação
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:mst_expenses_categories,id',
            'due_date' => 'required|date_format:d/m/Y',
            'repeat' => 'required|integer',
            'note' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:mst_expenses_categories,id',
            'due_date' => 'required|date_format:d/m/Y',
            'repeat' => 'required|integer',
            'note' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
