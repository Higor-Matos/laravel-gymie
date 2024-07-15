@extends('app')

@section('content')

    <div class="rightside bg-white">
        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100 margin-bottom-20 hidden-print">
            @include('flash::message')
            <h1 class="page-title">Fatura</h1>
        </div>
        <!-- END PAGE HEADING -->

        <div class="container-fluid">
            <div class="row"> <!--Main Row-->
                <div class="col-lg-12"> <!-- Main column -->
                    <div class="panel"> <!-- Main Panel-->
                        <div class="panel-body">
                            <div class="border-bottom-1 border-grey-100 padding-bottom-20 margin-bottom-20 clearfix">

                                @if($settings['invoice_name_type'] == 'gym_logo')
                                    <img class="no-margin display-inline-block pull-left" src="{{url('/images/Invoice/'.'gym_logo'.'.jpg') }}" alt="Logo da Academia">
                                @else
                                    <h3 class="no-margin display-inline-block pull-left"> {{ $settings['gym_name'] }}</h3>
                                @endif

                                <h4 class="pull-right no-margin">Fatura # {{ $invoice->invoice_number}}</h4>
                            </div>

                            <div class="row"> <!-- Inner row -->
                                <div class="col-xs-6"> <!--Left Side Details -->
                                    <address>
                                        <strong>Cobrado Para</strong><br>
                                        {{ $invoice->member->name }} ({{$invoice->member->member_code}})<br>

                                        <strong>Modo(s) de Pagamento</strong><br>
                                        <?php
                                        $modes = array();
                                        foreach ($invoice->paymentDetails->unique('mode') as $payment_mode) {
                                            $modes[] = Utilities::getPaymentMode($payment_mode->mode);
                                        }
                                        echo implode($modes, ',');
                                        ?><br>
                                        <strong>Pagamento</strong><br>
                                        {{ Utilities::getInvoiceStatus ($invoice->status) }}<br>
                                    </address>
                                </div>
                                <div class="col-xs-6 text-right"> <!--Right Side Details -->
                                    <address>
                                        <strong>Endereço da Academia</strong><br>
                                        {{ $settings['gym_address_1'] }}<br>
                                        {{ $settings['gym_address_2'] }}<br>
                                        <strong>Gerado em</strong><br>
                                        {{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y H:i:s')}}<br>
                                        <strong>Próximo Vencimento</strong><br>
                                        Em {{ $invoice->subscription->start_date->diffInDays($invoice->subscription->end_date) }} dias
                                        Em {{ $invoice->subscription->end_date->format('d/m/Y') }}<br>
                                    </address>
                                </div>
                            </div>        <!-- / inner row -->

                            <!-- Detalhes da Fatura -->

                            <div class="bg-amber-50 padding-md margin-bottom-20 margin-top-20" id="invoiceBlock">
                                <h4 class="margin-bottom-30 color-grey-700">Detalhes da Fatura</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td><strong>Nome do Item</strong></td>
                                            <td class="text-right"><strong>Valor</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($invoice->invoiceDetails as $invoiceDetail)
                                            <tr>
                                                <td>{{ $invoiceDetail->plan->plan_name }}</td>
                                                <td class="text-right">{{ $invoiceDetail->item_amount }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>Adicional</td>
                                            <td class="text-right">{{ $invoice->tax}}</td>
                                        </tr>
                                        @if($invoice->additional_fees != 0)
                                            <tr>
                                                <td>Taxas Adicionais</td>
                                                <td class="text-right">{{ $invoice->additional_fees}}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="text-left"><strong>Desconto</strong></td>
                                            <td class="text-right">- {{ $invoice->discount_amount}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-left"><strong>Total</strong></td>
                                            <td class="text-right">{{ $invoice->total}}</td>
                                        </tr>
                                        @if($invoice->pending_amount != 0)
                                            <tr>
                                                <td class="no-border text-left"><strong>Pendente</strong></td>
                                                <td class="no-border text-right">{{$invoice->pending_amount}}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- / Panel - body no padding -->

                        <!-- Botões do rodapé -->
                        <div class="panel-footer bg-white no-padding-top padding-bottom-20 hidden-print">
                            @if($invoice->pending_amount != 0)
                                @permission(['manage-gymie','manage-payments','add-payment'])
                                <a class="btn btn-success pull-right" href="{{ action('InvoicesController@createPayment',['id' => $invoice->id]) }}"><i
                                            class="ion-card margin-right-5"></i> Aceitar Pagamento</a>
                                @endpermission
                            @endif
                            @permission(['manage-gymie','manage-invoices','print-invoice'])
                            <button class="btn btn-primary pull-right margin-right-10" onclick="window.print();"><i class="ion-printer margin-right-5"></i>
                                Imprimir
                            </button>
                            @endpermission
                        </div> <!-- / Botões do rodapé -->


                    </div> <!-- / Main Panel-->
                </div> <!-- / Main Column -->
            </div><!-- / Main row -->


            <!-- Detalhes de Pagamento -->
            <div class="row hidden-print"> <!--Main Row-->
                <div class="col-lg-12"> <!-- Main column -->
                    <div class="panel no-shadow"> <!-- Main Panel-->
                        <div class="panel-body no-padding">
                            <div class="bg-grey-100 padding-md margin-bottom-20 margin-top-20">
                                <h4 class="margin-bottom-30 color-grey-700">Detalhes de Pagamento</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td><strong>Valor</strong></td>
                                            <td class="text-center"><strong>Como</strong></td>
                                            <td class="text-right"><strong>Em</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($invoice->paymentDetails as $paymentDetail)
                                            <tr>
                                                <td>{{ ($paymentDetail->payment_amount >= 0 ? $paymentDetail->payment_amount : str_replace("-","",$paymentDetail->payment_amount)." (Pago)") }}</td>
                                                <td class="text-center">{{ Utilities::getPaymentMode ($paymentDetail->mode) }}</td>
                                                <td class="text-right">{{ \Carbon\Carbon::parse($paymentDetail->created_at)->format('d/m/Y H:i:s') }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- / Panel - body no padding -->

                    </div> <!-- / Main Panel-->
                </div> <!-- / Main Column -->
            </div><!-- / Main row -->


        </div> <!-- / Container Fluid -->
    </div> <!-- / Right Side -->

@stop
