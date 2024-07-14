<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('name', 'Nome da Categoria') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('status', 'Status') !!}
            <!-- 0 para inativo, 1 para ativo -->
            {!! Form::select('status', ['1' => 'Ativo', '0' => 'Inativo'], null, ['class' => 'form-control', 'id' => 'status']) !!}
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
