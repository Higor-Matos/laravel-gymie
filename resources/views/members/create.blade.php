@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">

            <!-- Log de Erros -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Opa!</strong> Houve alguns problemas com os seus dados.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(['url' => 'members','id'=>'membersform','files'=>'true']) !!}

            <!-- Detalhes do Membro -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Informe os detalhes do membro</div>
                        </div>
                        <div class="panel-body">
                            @include('members.form')
                        </div>
                    </div>
                </div>
            </div>


            @if(Request::is('members/create'))
                <!-- Detalhes da Assinatura -->
                @include('members._subscription')

                <!-- Detalhes da Fatura -->
                @include('members._invoice')

                <!-- Detalhes do Pagamento -->
                @include('members._payment')

                <!-- Botão de Envio -->
                <div class="row">
                    <div class="col-sm-2 pull-right">
                        <div class="form-group">
                            {!! Form::submit('Criar', ['class' => 'btn btn-primary pull-right']) !!}
                        </div>
                    </div>
                </div>

            @endif

            {!! Form::close() !!}

        </div> <!-- conteúdo -->
    </div> <!-- direita -->


@stop

@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/member.js') }}" type="text/javascript"></script>
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
