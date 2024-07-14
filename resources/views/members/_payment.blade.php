<div class="row">
    <div class="col-md-12">
        <div class="panel no-border">
            <div class="panel-title">
                <div class="panel-head font-size-20">Informe os detalhes do pagamento</div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('payment_amount','Valor Recebido') !!}
                            <div class="input-group">
                                <div class="input-group-addon">R$</div>
                                {!! Form::text('payment_amount',null,['class'=>'form-control', 'id' => 'payment_amount', 'data-amounttotal' => '0']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('payment_amount_pending','Valor Pendente') !!}
                            <div class="input-group">
                                <div class="input-group-addon">R$</div>
                                {!! Form::text('payment_amount_pending',null,['class'=>'form-control', 'id' => 'payment_amount_pending', 'readonly']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('mode','Modo') !!}
                            {!! Form::select('mode',array('1' => 'Dinheiro', '0' => 'Cheque'),1,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'mode']) !!}
                        </div>
                    </div>
                </div> <!-- /Row -->

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

            </div> <!-- /Panel-body -->

        </div> <!-- /Panel-no-border -->
    </div> <!-- /Main Column -->
</div> <!-- /Main Row -->
