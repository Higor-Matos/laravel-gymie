@extends('app')

@section('content')

<div class="rightside bg-grey-100">
    <div class="container-fluid">

        <!-- Registro de Erros -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Ops!</strong> Houve alguns problemas com a sua entrada.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::Open(['url' => 'enquiries','id'=>'enquiriesform','files'=>'true']) !!}
    <!-- Detalhes da Consulta -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel no-border">
                    <div class="panel-title">
                        <div class="panel-head font-size-20">Insira os detalhes da consulta</div>
                    </div>
                    <div class="panel-body">
                        @include('enquiries.form')
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulário de Follow Up -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel no-border">
                    <div class="panel-title">
                        <div class="panel-head font-size-20">Insira os detalhes do follow up</div>
                    </div>
                    <div class="panel-body">
                        @include('enquiries._followUp')
                    </div>
                </div>
            </div>
        </div>

        <!-- Botão de Enviar -->
        <div class="row">
            <div class="col-sm-2 pull-right">
                <div class="form-group">
                    {!! Form::submit('Criar', ['class' => 'btn btn-primary pull-right']) !!}
                </div>
            </div>
        </div>

        {!! Form::Close() !!}

    </div> <!-- content -->
</div> <!-- rightside -->

@stop
@section('footer_scripts')
<script src="{{ secure_asset('assets/js/enquiry.js') }}" type="text/javascript"></script>
@stop
