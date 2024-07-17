@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <!-- INÍCIO DA PÁGINA -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title">Configurações</h1>
            <a href="{{ action('SettingsController@edit') }}" class="btn btn-primary active pull-right" role="button"><i class="ion-compose"></i> Editar</a></h1>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title bg-white">
                            <div class="panel-head font-size-18"><i class="fa fa-cogs"></i> Geral</div>
                        </div>

                        <div class="panel-body"> <!-- Corpo do Painel -->

                            <div class="row"> <!-- Primeira Linha -->

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Nome da Academia</label>
                                        <p>{{ $settings['gym_name'] }}</p>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Inicio do Sistema</label>
                                        <p>{{ \Carbon\Carbon::parse($settings['financial_start'])->format('d/m/Y') }}</p>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fim do Sistema</label>
                                        <p>{{ \Carbon\Carbon::parse($settings['financial_end'])->format('d/m/Y') }}</p>
                                    </div>
                                </div>

                            </div> <!-- / Primeira Linha -->

                            <div class="row"> <!-- Segunda Linha -->

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <img alt="logo da academia" src="{{url('/images/50x50/'.'gym_logo'.'.jpg') }}"/>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Endereço da Academia Linha 1</label>
                                                <p>{{ $settings['gym_address_1'] }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Endereço da Academia Linha 2</label>
                                                <p>{{ $settings['gym_address_2'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- / Segunda Linha -->

                        </div> <!-- / Corpo do Painel -->

                    </div> <!-- / Painel Sem Borda -->
                </div> <!-- / Coluna Principal -->
            </div> <!-- / Linha Principal -->

            <!-- Configurações de Fatura -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title bg-white">
                            <div class="panel-head font-size-18"><i class="fa fa-file"></i> Fatura</div>
                        </div>
                        <div class="panel-body">
                            <div class="row"> <!-- Linha do Painel -->
                                <div class="col-sm-12"> <!-- Coluna do Painel -->

                                    <div class="row"> <!-- Linha Interna -->
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Prefixo da Fatura</label>
                                                <p>{{ $settings['invoice_prefix'] }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Último Número da Fatura</label>
                                                <p>{{ $settings['invoice_last_number'] }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Exibir na Fatura</label>
                                                <p>{{ Utilities::getDisplay($settings['invoice_name_type']) }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Modo de Numeração da Fatura</label>
                                                <p>{{ Utilities::getMode($settings['invoice_number_mode']) }}</p>
                                            </div>
                                        </div>
                                    </div> <!-- / Linha Interna -->

                                </div> <!-- / Coluna do Painel -->
                            </div> <!-- / Linha do Painel -->

                        </div> <!-- / Corpo do Painel -->

                    </div> <!-- / Painel Sem Borda -->
                </div> <!-- / Coluna Principal -->
            </div> <!-- / Linha Principal -->

            <!-- Configurações de Aluno -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title bg-white">
                            <div class="panel-head font-size-18"><i class="fa fa-users"></i> Aluno</div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="row"> <!-- Linha Interna -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Prefixo do Código do Aluno</label>
                                                <p>{{ $settings['member_prefix'] }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Último Número do Aluno</label>
                                                <p>{{ $settings['member_last_number'] }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Modo de Numeração do Aluno</label>
                                                <p>{{ Utilities::getMode($settings['member_number_mode']) }}</p>
                                            </div>
                                        </div>
                                    </div> <!-- / Linha Interna -->

                                </div>
                            </div>
                        </div> <!-- / Corpo do Painel -->

                    </div> <!-- / Painel Sem Borda -->
                </div> <!-- / Coluna Principal -->
            </div> <!-- / Linha Principal -->

        </div> <!-- / Container Fluid -->
    </div> <!-- / RightSide -->
@stop
