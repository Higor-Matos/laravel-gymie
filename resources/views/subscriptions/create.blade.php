@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">

            <!-- Log de Erros -->
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

            {!! Form::Open(['url' => 'subscriptions','id'=>'subscriptionsform']) !!}
            {!! Form::hidden('invoiceCounter',$invoiceCounter) !!}

        <!-- Detalhes do Membro -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Insira os detalhes da assinatura</div>
                        </div>
                        <div class="panel-body">
                            @include('subscriptions.form')
                        </div>
                    </div>
                </div>
            </div>

            @if(Request::is('subscriptions/create'))
            <!-- Detalhes da Fatura -->
                @include('subscriptions._invoice')

            <!-- Detalhes do Pagamento -->
                @include('subscriptions._payment')

            <!-- Linha do Botão de Enviar -->
                <div class="row">
                    <div class="col-sm-2 pull-right">
                        <div class="form-group">
                            {!! Form::submit('Criar', ['class' => 'btn btn-primary pull-right']) !!}
                        </div>
                    </div>
                </div>

                {!! Form::Close() !!}

            @endif

        </div> <!-- content -->
    </div> <!-- rightside -->
@stop
@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/subscription.js') }}" type="text/javascript"></script>
@stop
@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.loaddatepickerstart();
            gymie.chequedetails();
            gymie.subscription();
        });
    </script>
@stop
