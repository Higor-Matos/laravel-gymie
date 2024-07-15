@extends('app')

@section('content')

    <?php
    use Carbon\Carbon;
    ?>
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

            {!! Form::Open(['url' => 'members','id'=>'membersform','files'=>'true']) !!}
            {!! Form::hidden('transfer_id',$enquiry->id) !!}
            {!! Form::hidden('memberCounter',$memberCounter) !!}
            {!! Form::hidden('invoiceCounter',$invoiceCounter) !!}
        <!-- Detalhes do Membro -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Insira os detalhes do membro</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('name','Nome',['class'=>'control-label']) !!}
                                        {!! Form::text('name',$enquiry->name,['class'=>'form-control', 'id' => 'name']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('photo','Foto') !!}
                                        {!! Form::file('photo',['class'=>'form-control', 'id' => 'photo']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('DOB','Data de Nascimento') !!}
                                        {!! Form::text('DOB',$enquiry->DOB,['class'=>'form-control datepicker', 'id' => 'DOB']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('gender','Gênero') !!}
                                        {!! Form::select('gender',array('m' => 'Masculino', 'f' => 'Feminino'),null,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'gender']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('contact','Contato') !!}
                                        {!! Form::text('contact',$enquiry->contact,['class'=>'form-control', 'id' => 'contact']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('email','Email') !!}
                                        {!! Form::text('email',$enquiry->email,['class'=>'form-control', 'id' => 'email']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('emergency_contact','Contato de Emergência') !!}
                                        {!! Form::text('emergency_contact',null,['class'=>'form-control', 'id' => 'emergency_contact']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('health_issues','Problemas de Saúde') !!}
                                        {!! Form::text('health_issues',null,['class'=>'form-control', 'id' => 'health_issues']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('proof_name','Nome do Documento') !!}
                                        {!! Form::text('proof_name',null,['class'=>'form-control', 'id' => 'proof_name']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('proof_photo','Foto do Documento') !!}
                                        {!! Form::file('proof_photo',['class'=>'form-control', 'id' => 'proof_photo']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('member_code','Código do Membro') !!}
                                        {!! Form::text('member_code',$member_code,['class'=>'form-control', 'id' => 'member_code', ($member_number_mode == \constNumberingMode::Auto ? 'readonly' : '')]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    {!! Form::label('status','Status') !!}
                                    <!--0 para inativo, 1 para ativo-->
                                        {!! Form::select('status',array('1' => 'Ativo', '0' => 'Inativo'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'status']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('pin_code','CEP',['class'=>'control-label']) !!}
                                        {!! Form::text('pin_code',$enquiry->pin_code,['class'=>'form-control', 'id' => 'pin_code']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('occupation','Ocupação') !!}
                                        {!! Form::select('occupation',array('0' => 'Estudante', '1' => 'Dona de Casa','2' => 'Autônomo','3' => 'Profissional','4' => 'Freelancer','5' => 'Outros'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'occupation']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('aim','Por que você pretende se juntar?',['class'=>'control-label']) !!}
                                        {!! Form::select('aim',array('0' => 'Fitness', '1' => 'Networking', '2' => 'Musculação', '3' => 'Perda de Peso', '4' => 'Ganho de Peso', '5' => 'Outros'),$enquiry->aim,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'aim']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('source','Como você soube sobre nós?',['class'=>'control-label']) !!}
                                        {!! Form::select('source',array('0' => 'Promoções', '1' => 'Boca a Boca', '2' => 'Outros'),$enquiry->source,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'source']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        {!! Form::label('address','Endereço') !!}
                                        {!! Form::textarea('address',$enquiry->address,['class'=>'form-control', 'id' => 'address']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Detalhes da Assinatura -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Insira os detalhes da assinatura</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    {!! Form::label('plan_0','Plano') !!}
                                </div>

                                <div class="col-sm-3">
                                    {!! Form::label('start_date_0','Data de Início') !!}
                                </div>

                                <div class="col-sm-3">
                                    {!! Form::label('end_date_0','Data de Término') !!}
                                </div>

                                <div class="col-sm-1">
                                    <label>&nbsp;</label><br/>
                                </div>
                            </div> <!-- / Linha -->
                            <div id="servicesContainer">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group plan-id">
                                            <?php $plans = App\Plan::where('status', '=', '1')->get(); ?>

                                            <select id="plan_0" name="plan[0][id]" class="form-control selectpicker show-tick show-menu-arrow childPlan"
                                                    data-live-search="true" data-row-id="0">
                                                @foreach($plans as $plan)
                                                    <option value="{{ $plan->id }}" data-price="{{ $plan->amount }}" data-days="{{ $plan->days }}"
                                                            data-row-id="0">{{ $plan->plan_display }} </option>
                                                @endforeach
                                            </select>
                                            <div class="plan-price">
                                                {!! Form::hidden('plan[0][price]','', array('id' => 'price_0')) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group plan-start-date">
                                            {!! Form::text('plan[0][start_date]',Carbon::today()->format('d/m/Y'),['class'=>'form-control datepicker-startdate childStartDate', 'id' => 'start_date_0', 'data-row-id' => '0']) !!}
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group plan-end-date">
                                            {!! Form::text('plan[0][end_date]',null,['class'=>'form-control childEndDate', 'id' => 'end_date_0', 'readonly' => 'readonly','data-row-id' => '0']) !!}
                                        </div>
                                    </div>

                                    <div class="col-sm-1">
                                        <div class="form-group">
                            <span class="btn btn-sm btn-danger pull-right hide remove-service">
                              <i class="fa fa-times"></i>
                            </span>
                                        </div>
                                    </div>
                                </div> <!-- / Linha -->
                            </div>
                            <div class="row">
                                <div class="col-sm-2 pull-right">
                                    <div class="form-group">
                                        <span class="btn btn-sm btn-primary pull-right" id="addSubscription">Adicionar</span>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- / Corpo do Painel -->

                    </div> <!-- /Painel -->
                </div> <!-- /Coluna Principal -->
            </div> <!-- /Linha Principal -->

            <!-- Detalhes da Fatura -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Insira os detalhes da fatura</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('invoice_number','Número da Fatura') !!}
                                        {!! Form::text('invoice_number',$invoice_number,['class'=>'form-control', 'id' => 'invoice_number', ($invoice_number_mode == \constNumberingMode::Auto ? 'readonly' : '')]) !!}
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('admission_amount','Taxa de Admissão') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-brl"></i></div>
                                            {!! Form::text('admission_amount',Utilities::getSetting('admission_fee'),['class'=>'form-control', 'id' => 'admission_amount']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('subscription_amount','Taxa de Assinatura da Academia') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-brl"></i></div>
                                            {!! Form::text('subscription_amount',null,['class'=>'form-control', 'id' => 'subscription_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('taxes_amount',sprintf('Adicional' ,Utilities::getSetting('taxes'))) !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-brl"></i></div>
                                            {!! Form::text('taxes_amount',0,['class'=>'form-control', 'id' => 'taxes_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /Linha -->

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_percent','Desconto') !!}
                                        <?php
                                        $discounts = explode(",", str_replace(" ", "", (Utilities::getSetting('discounts'))));
                                        $discounts_list = array_combine($discounts, $discounts);
                                        ?>
                                        <select id="discount_percent" name="discount_percent" class="form-control selectpicker show-tick show-menu-arrow">
                                            <option value="0">Nenhum</option>
                                            @foreach($discounts_list as $list)
                                                <option value="{{ $list }}">{{ $list.'%' }}</option>
                                            @endforeach
                                            <option value="custom">Customizado (R$)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_amount','Valor do Desconto') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-brl"></i></div>
                                            {!! Form::text('discount_amount',null,['class'=>'form-control', 'id' => 'discount_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_note','Nota do Desconto') !!}
                                        {!! Form::text('discount_note',null,['class'=>'form-control', 'id' => 'discount_note']) !!}
                                    </div>
                                </div>
                            </div>

                        </div> <!-- /Corpo do Painel -->

                    </div> <!-- /Painel -->
                </div> <!-- /Coluna Principal -->
            </div> <!-- /Linha Principal -->

            <!-- Detalhes do Pagamento -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Insira os detalhes do pagamento</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('payment_amount','Valor Recebido') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-brl"></i></div>
                                            {!! Form::text('payment_amount',null,['class'=>'form-control', 'id' => 'payment_amount', 'data-amounttotal' => '0']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('payment_amount_pending','Valor Pendente') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-brl"></i></div>
                                            {!! Form::text('payment_amount_pending',null,['class'=>'form-control', 'id' => 'payment_amount_pending', 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('mode','Modo') !!}
                                        {!! Form::select('mode',array(
                                            '1' => 'Dinheiro',
                                            '0' => 'Cheque',
                                            '2' => 'PIX',
                                            '3' => 'Cartão de Crédito',
                                            '4' => 'Cartão de Débito'
                                        ),1,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'mode']) !!}
                                    </div>
                                </div>
                            </div> <!-- /Linha -->
                            <div class="row" id="chequeDetails">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('number','Número do Cheque') !!}
                                        {!! Form::text('number',null,['class'=>'form-control', 'id' => 'number']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('date','Data do Cheque') !!}
                                        {!! Form::text('date',null,['class'=>'form-control datepicker-default', 'id' => 'date']) !!}
                                    </div>
                                </div>
                            </div>

                        </div> <!-- /Corpo do Painel -->

                    </div> <!-- /Painel -->
                </div> <!-- /Coluna Principal -->
            </div> <!-- /Linha Principal -->

            <!-- Linha do Botão de Envio -->
            <div class="row">
                <div class="col-sm-2 pull-right">
                    <div class="form-group">
                        {!! Form::submit('Criar', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            </div>

            {!! Form::Close() !!}

        </div> <!-- conteúdo -->
    </div> <!-- lado direito -->

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
