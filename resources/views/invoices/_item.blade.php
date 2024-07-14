<div class="row">
    <div class="col-md-12">
        <div class="panel no-border ">
            <div class="panel-title">
                <div class="panel-head font-size-20">Detalhes dos itens da fatura</div>
            </div>
            <div class="panel-body">
                <table id="_item" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nome do Item</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($invoice->invoice_details as $invoice_detail)
                        <tr>
                            <td>{{ $invoice_detail->item_name }}</td>
                            <td>R$ {{ $invoice_detail->item_amount }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- / Panel-Body -->
        </div><!-- / Panel-no-border -->
    </div><!-- / Main-Col -->
</div><!-- / Main-Row -->
