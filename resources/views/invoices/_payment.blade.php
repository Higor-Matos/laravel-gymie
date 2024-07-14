<div class="row">
    <div class="col-md-12">
        <div class="panel no-border ">
            <div class="panel-title">
                <div class="panel-head font-size-20">Detalhes da transação de pagamento da fatura</div>
            </div>
            <div class="panel-body">
                <table id="_payment" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Valor Recebido</th>
                        <th>Modo de Pagamento</th>
                        <th>Data e Hora</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($invoice->payment_details as $payment_detail)
                        <tr>
                            <td>R$ {{ $payment_detail->payment_amount }}</td>
                            <td>{{ Utilities::getPaymentMode ($payment_detail->mode) }}</td>
                            <td>{{ $payment_detail->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- / Panel-Body -->
        </div><!-- / Panel-no-border -->
    </div><!-- / Main-Col -->
</div><!-- / Main-Row -->
