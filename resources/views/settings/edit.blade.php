@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <!-- INÍCIO DA PÁGINA -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title">Configurações</h1>
        </div>

        <div class="container-fluid">
        {!! Form::Open(['url' => 'settings/save','id'=>'settingsform','files'=>'true']) !!}
        <!-- Configurações Gerais -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-15"><i class="fa fa-cogs"></i> Geral</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <!--Início da Linha Principal-->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('gym_name','Nome da Academia') !!}
                                        {!! Form::text('gym_name',$settings['gym_name'],['class'=>'form-control', 'id' => 'gym_name']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('financial_start','Início do Ano Financeiro') !!}
                                        {!! Form::text('financial_start', \Carbon\Carbon::parse($settings['financial_start'])->format('d/m/Y'),['class'=>'form-control datepicker-default', 'id' => 'financial_start']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('financial_end','Fim do Ano Financeiro') !!}
                                        {!! Form::text('financial_end', \Carbon\Carbon::parse($settings['financial_end'])->format('d/m/Y'),['class'=>'form-control datepicker-default', 'id' => 'financial_end']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if($settings['gym_logo'] != "")
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    {!! Form::label('gym_logo','Logo da Academia') !!}<br>
                                                    <img alt="logo da academia" src="{{url('/images/Invoice/'.'gym_logo'.'.jpg') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    {!! Form::file('gym_logo',['class'=>'form-control', 'id' => 'gym_logo']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            {!! Form::label('gym_logo','Logo da Academia') !!}
                                            {!! Form::file('gym_logo',['class'=>'form-control', 'id' => 'gym_logo']) !!}
                                        </div>
                                    </div>
                                @endif

                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                {!! Form::label('gym_address_1','Endereço da Academia Linha 1') !!}
                                                {!! Form::text('gym_address_1',$settings['gym_address_1'],['class'=>'form-control', 'id' => 'gym_address_1']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                {!! Form::label('gym_address_2','Endereço da Academia Linha 2') !!}
                                                {!! Form::text('gym_address_2',$settings['gym_address_2'],['class'=>'form-control', 'id' => 'gym_address_2']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Configurações de Fatura -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-15"><i class="fa fa-file"></i> Fatura</div>
                        </div>
                        <div class="panel-body">
                            <div class="row"> <!--Início da Linha Principal-->
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                {!! Form::label('invoice_prefix','Prefixo da Fatura') !!}
                                                {!! Form::text('invoice_prefix',$settings['invoice_prefix'],['class'=>'form-control', 'id' => 'invoice_prefix']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                {!! Form::label('invoice_last_number','Último Número da Fatura') !!}
                                                {!! Form::text('invoice_last_number',$settings['invoice_last_number'],['class'=>'form-control', 'id' => 'invoice_last_number']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                {!! Form::label('invoice_name_type','Tipo de Nome na Fatura') !!}
                                                {!! Form::select('invoice_name_type',array('gym_logo' => 'Logo da Academia', 'gym_name' => 'Nome da Academia'),$settings['invoice_name_type'],['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'invoice_name_type']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                {!! Form::label('invoice_number_mode','Modo de Numeração da Fatura') !!}
                                                {!! Form::select('invoice_number_mode',array('0' => 'Manual', '1' => 'Automático'),$settings['invoice_number_mode'],['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'invoice_number_mode']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configurações de Membro -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-15"><i class="fa fa-users"></i> Membro</div>
                        </div>

                        <div class="panel-body">
                            <div class="row"> <!--Início da Linha Principal-->
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                {!! Form::label('member_prefix','Prefixo do Membro') !!}
                                                {!! Form::text('member_prefix',$settings['member_prefix'],['class'=>'form-control', 'id' => 'member_prefix']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                {!! Form::label('member_last_number','Último Número do Membro') !!}
                                                {!! Form::text('member_last_number',$settings['member_last_number'],['class'=>'form-control', 'id' => 'member_last_number']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                {!! Form::label('member_number_mode','Modo de Numeração do Membro') !!}
                                                {!! Form::select('member_number_mode',array('0' => 'Manual', '1' => 'Automático'),$settings['member_number_mode'],['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'member_number_mode']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configurações de Taxas -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-15"><i class="fa fa-dollar"></i> Taxas</div>
                        </div>

                        <div class="panel-body">
                            <div class="row"> <!--Início da Linha Principal-->
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                {!! Form::label('admission_fee','Taxa de Admissão') !!}
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-inr"></i></div>
                                                    {!! Form::text('admission_fee', number_format($settings['admission_fee'], 2, ',', '.'),['class'=>'form-control', 'id' => 'admission_fee']) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                {!! Form::label('taxes','Impostos') !!}
                                                <div class="input-group">
                                                    {!! Form::text('taxes', number_format($settings['taxes'], 2, ',', '.'),['class'=>'form-control', 'id' => 'taxes']) !!}
                                                    <div class="input-group-addon"><i class="fa fa-percent"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                {!! Form::label('discounts','Percentual de Desconto Disponível') !!}
                                                {!! Form::text('discounts',$settings['discounts'],['class'=>'form-control tokenfield', 'id' => 'discounts', 'placeholder' => 'Digite o percentual de desconto e pressione Enter']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configurações de SMS -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-15"><i class="fa fa-file-text-o"></i> SMS</div>
                        </div>

                        <div class="panel-body">
                            <div class="row"> <!--Início da Linha Principal-->
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('sms','Ativar SMS?') !!}
                                                {!! Form::select('sms',array('0' => 'Não', '1' => 'Sim'),$settings['sms'],['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sms']) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('primary_contact','Contato Principal') !!}
                                                {!! Form::text('primary_contact',$settings['primary_contact'],['class'=>'form-control', 'id' => 'primary_contact']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @role('Gymie')
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('sms_request','Solicitação de SMS') !!}
                                                {!! Form::select('sms_request',array('0' => 'Não solicitado', '1' => 'Solicitado'),$settings['sms_request'],['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sms_request']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endrole
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Envio do Formulário -->
            <div class="row">
                <div class="col-sm-2 pull-right">
                    <div class="form-group">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            </div>
            {!! Form::Close() !!}
        </div>
    </div>
@stop

@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/setting.js') }}" type="text/javascript"></script>
@stop

@section('footer_script_init')
    <script type="text/javascript">
        gymie.loadBsTokenInput();
    </script>
@stop
