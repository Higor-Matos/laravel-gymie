<?php

namespace App\Http\Controllers;

use Auth;
use App\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Exibe uma lista dos recursos.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $plans = Plan::excludeArchive()->search('"'.$request->input('search').'"')->paginate(10);
        $count = $plans->total();

        return view('plans.index', compact('plans', 'count'));
    }

    /**
     * Exibe o recurso especificado.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        $plan = Plan::findOrFail($id);

        return view('plans.show', compact('plan'));
    }

    /**
     * Mostra o formulário para criar um novo recurso.
     *
     * @return Response
     */
    public function create()
    {
        return view('plans.create');
    }

    /**
     * Armazena um recurso recém-criado.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // Validação do Modelo
        $this->validate($request, ['plan_code' => 'unique:mst_plans,plan_code',
                                   'plan_name' => 'unique:mst_plans,plan_name', ]);

        $plan = new Plan($request->all());

        $plan->createdBy()->associate(Auth::user());
        $plan->updatedBy()->associate(Auth::user());

        $plan->save();

        flash()->success('Plano foi criado com sucesso');

        return redirect('plans');
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);

        return view('plans.edit', compact('plan'));
    }

    public function update($id, Request $request)
    {
        $plan = Plan::findOrFail($id);

        $plan->update($request->all());
        $plan->updatedBy()->associate(Auth::user());
        $plan->save();
        flash()->success('Detalhes do plano foram atualizados com sucesso');

        return redirect('plans/all');
    }

    public function archive($id)
    {
        Plan::destroy($id);

        return redirect('plans/all');
    }
}
