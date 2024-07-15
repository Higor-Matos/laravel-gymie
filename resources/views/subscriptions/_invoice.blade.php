<div class="row">
    <div class="col-md-12">
        <div class="panel no-border">
            <div class="panel-title">
                <div class="panel-head font-size-20">Insira os detalhes da fatura</div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('invoice_number','Número da Fatura') !!}
                            {!! Form::text('invoice_number',$invoice_number,['class'=>'form-control', 'id' => 'invoice_number', ($invoice_number_mode == \constNumberingMode::Auto ? 'readonly' : '')]) !!}
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('subscription_amount','Taxa de inscrição na academia') !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                {!! Form::text('subscription_amount',null,['class'=>'form-control', 'id' => 'subscription_amount','readonly' => 'readonly']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('taxes_amount',sprintf('Adicional',Utilities::getSetting('taxes'))) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                {!! Form::text('taxes_amount',0,['class'=>'form-control', 'id' => 'taxes_amount','readonly' => 'readonly']) !!}
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
                                    <option value="{{ $list }}">{{ $list.'%' }}</option>
                                @endforeach
                                <option value="custom">Personalizado(R$)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('discount_amount','Valor do Desconto') !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-money"></i></div>
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

            </div> <!-- /Box-body -->

        </div> <!-- /Box -->
    </div> <!-- /Main Column -->
</div> <!-- /Main Row -->
