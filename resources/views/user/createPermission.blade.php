@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Ops!</strong> Houve alguns problemas com sua entrada.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="panel no-border">
                        <div class="panel-title bg-white no-border">
                            <div class="panel-head">Insira os detalhes da permissão</div>
                        </div>

                        {!! Form::Open(['url' => 'permission','id' => 'permissionsform','files'=>'true']) !!}

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('name','Nome') !!}
                                        {!! Form::text('name',null,['class'=>'form-control', 'id' => 'name']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('display_name','Nome de Exibição') !!}
                                        {!! Form::text('display_name',null,['class'=>'form-control', 'id' => 'display_name']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('description','Descrição') !!}
                                        {!! Form::text('description',null,['class'=>'form-control', 'id' => 'description']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('group_key','Chave do Grupo') !!}
                                        {!! Form::text('group_key',null,['class'=>'form-control', 'id' => 'group_key']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 pull-right">
                            <div class="form-group">
                                {!! Form::submit('Criar', ['class' => 'btn btn-primary pull-right']) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::Close() !!}


                </div>
            </div>
        </div>
    </div>
    </div>

@stop
