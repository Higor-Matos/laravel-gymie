<?php use Carbon\Carbon; ?>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('name','Nome') !!}
            {!! Form::text('name',null,['class'=>'form-control','id'=>'name']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php $expenseCategories = App\ExpenseCategory::where('status', '=', '1')->lists('name', 'id'); ?>
            {!! Form::label('category_id','Categoria') !!}
            {!! Form::select('category_id',$expenseCategories,null,['class'=>'form-control selectpicker show-tick show-menu-arrow','id'=>'category_id','data-live-search'=> 'true']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('due_date','Data de Vencimento / Data de Pagamento') !!}
            {!! Form::text('due_date',(isset($expense->due_date) ? $expense->due_date->format('d/m/Y') : Carbon::today()->format('d/m/Y')),['class'=>'form-control datepicker-default','id'=>'due_date']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label('repeat','Repetir') !!}
        <!--0 for inactive , 1 for active-->
            {!! Form::select('repeat',array('0' => 'Nunca repetir', '1' => 'Todo Dia', '2' => 'Toda Semana', '3' => 'Todo Mês', '4' => 'Todo Ano'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'repeat']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('note','Nota') !!}
            {!! Form::text('note',null,['class'=>'form-control','id'=>'note']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('amount','Valor') !!}
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                {!! Form::text('amount',null,['class'=>'form-control','id'=>'amount']) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
        </div>
    </div>
</div>

