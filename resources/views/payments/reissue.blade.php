@extends('app')
@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Digite os detalhes do pagamento</div>
                        </div>

                        {!! Form::Open(['url' => 'payments','id' => 'paymentsform']) !!}
                        {!! Form::hidden('previousPayment',$payment_detail->id) !!}

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php $invoiceList = App\Invoice::lists('invoice_number', 'id'); ?>
                                        {!! Form::label('invoice_id','Número da Fatura') !!}
                                        {!! Form::select('invoice_id',$invoiceList,$payment_detail->invoice_id,['class'=>'form-control selectpicker show-tick', 'id' => 'invoice_id', 'data-live-search'=> 'true']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('payment_amount','Valor') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-brl"></i></div>
                                            {!! Form::text('payment_amount',$payment_detail->invoice->pending_amount,['class'=>'form-control', 'id' => 'payment_amount']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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
                            </div>

                            <div id="chequeDetails">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {!! Form::label('number','Número do Cheque') !!}
                                            {!! Form::text('number',null,['class'=>'form-control', 'id' => 'number']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {!! Form::label('date','Data do Cheque') !!}
                                            {!! Form::text('date',null,['class'=>'form-control datepicker-default', 'id' => 'date']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::submit('Aceitar Pagamento', ['class' => 'btn btn-primary pull-right']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
        </div>

@stop

@section('footer_scripts')
    <script src="{{ secure_asset('assets/js/payment.js') }}" type="text/javascript"></script>
@stop

@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.loaddatepicker();
            gymie.chequedetails();
        });
    </script>
@stop
