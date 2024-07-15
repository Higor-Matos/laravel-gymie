@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">

            <!-- Log de Erro -->
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

            {!! Form::Open(['action' => ['InvoicesController@applyDiscount',$invoice->id],'id'=>'invoicediscountform']) !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Informe os detalhes do desconto</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('invoice_number','Número da Fatura') !!}
                                        {!! Form::text('invoice_number',$invoice->invoice_number,['class'=>'form-control', 'id' => 'invoice_number','readonly' => 'readonly']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('subscription_amount','Taxa de assinatura') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                            {!! Form::text('subscription_amount',$invoice->invoiceDetails->sum('item_amount'),['class'=>'form-control', 'id' => 'subscription_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('additional_fees','Taxas adicionais') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                            {!! Form::text('additional_fees',$invoice->additional_fees,['class'=>'form-control', 'id' => 'additional_fees','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('taxes_amount',sprintf('Adicional',Utilities::getSetting('taxes'))) !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                            {!! Form::text('taxes_amount',$invoice->tax,['class'=>'form-control', 'id' => 'taxes_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /Row -->

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
                                                <option value="{{ $list }}" {{ ($invoice->discount_percent == $list ? "selected" : "") }}>{{ $list.'%' }}</option>
                                            @endforeach
                                            <option value="custom" {{ ($invoice->discount_percent == "custom" ? "selected" : "") }}>Personalizado (R$)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_amount','Valor do desconto') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                            {!! Form::text('discount_amount',$invoice->discount_amount,['class'=>'form-control', 'id' => 'discount_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_note','Observação do desconto') !!}
                                        {!! Form::text('discount_note',$invoice->discount_note,['class'=>'form-control', 'id' => 'discount_note']) !!}
                                    </div>
                                </div>
                            </div>

                        </div> <!-- /Panel-body -->

                    </div> <!-- /Panel-no-border -->

                    <div class="row">
                        <div class="col-sm-2 pull-right">
                            <div class="form-group">
                                {!! Form::submit('Aplicar Desconto', ['class' => 'btn btn-primary pull-right']) !!}
                            </div>
                        </div>
                    </div>

                </div> <!-- /Main Column -->
            </div> <!-- /Main Row -->

            {!! Form::close() !!}

        </div>
    </div>

@stop

@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.applyDiscount();
        });
    </script>
@stop
