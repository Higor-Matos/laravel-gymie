@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title no-line-height">Faturas
                <small>Detalhes de todas as faturas pagas em excesso</small>
            </h1>
            @permission(['manage-gymie','pagehead-stats'])
            <h1 class="font-size-30 text-right color-blue-grey-600 animated fadeInDown total-count pull-right"><span data-toggle="counter" data-start="0"
                                                                                                                     data-from="0" data-to="{{ $count }}"
                                                                                                                     data-speed="600"
                                                                                                                     data-refresh-interval="10"></span>
                <small class="color-blue-grey-600 display-block margin-top-5 font-size-14">Faturas Pagas em Excesso</small>
            </h1>
            @endpermission
        </div><!-- / PageHead -->

        <div class="container-fluid">
            <div class="row"><!-- Main row -->
                <div class="col-lg-12"><!-- Main Col -->
                    <div class="panel no-border ">
                        <div class="panel-title bg-blue-grey-50">
                            <div class="panel-head font-size-15">

                                <div class="row">
                                    <div class="col-sm-12 no-padding">
                                        {!! Form::open(['method' => 'GET']) !!}

                                        <div class="col-sm-3">

                                            {!! Form::label('invoice-daterangepicker','Intervalo de datas') !!}

                                            <div id="invoice-daterangepicker"
                                                 class="gymie-daterangepicker btn bg-grey-50 daterange-padding no-border color-grey-600 hidden-xs no-shadow">
                                                <i class="ion-calendar margin-right-10"></i>
                                                <span>Selecione uma data</span>
                                                <i class="ion-ios-arrow-down margin-left-5"></i>
                                            </div>

                                            {!! Form::text('drp_start',null,['class'=>'hidden', 'id' => 'drp_start']) !!}
                                            {!! Form::text('drp_end',null,['class'=>'hidden', 'id' => 'drp_end']) !!}
                                        </div>

                                        <div class="col-sm-2">
                                            {!! Form::label('sort_field','Ordenar por') !!}
                                            {!! Form::select('sort_field',array('created_at' => 'Data','invoice_number' => 'Número da Fatura','member_name' => 'Nome do Membro','total' => 'Valor Total','pending_amount' => 'Valor Pendente'),old('sort_field'),['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sort_field']) !!}
                                        </div>

                                        <div class="col-sm-2">
                                            {!! Form::label('sort_direction','Ordem') !!}
                                            {!! Form::select('sort_direction',array('desc' => 'Decrescente','asc' => 'Crescente'),old('sort_direction'),['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sort_direction']) !!}</span>
                                        </div>

                                        <div class="col-xs-3">
                                            {!! Form::label('search','Palavra-chave') !!}
                                            <input value="{{ old('search') }}" name="search" id="search" type="text" class="form-control padding-right-35"
                                                   placeholder="Buscar...">
                                        </div>

                                        <div class="col-xs-2">
                                            {!! Form::label('&nbsp;') !!} <br/>
                                            <button type="submit" class="btn btn-primary active no-border">Buscar</button>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="panel-body bg-white">

                            @if($invoices->count() == 0)
                                <h4 class="text-center padding-top-15">Desculpe! Nenhum registro encontrado</h4>
                            @else

                                <table id="invoices" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Número da Fatura</th>
                                        <th>Nome do Membro</th>
                                        <th>Valor Total</th>
                                        <th>Pendente</th>
                                        <th>Desconto</th>
                                        <th>Criado em</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td><a href="{{ action('InvoicesController@show',['id' => $invoice->id]) }}">{{ $invoice->invoice_number}}</a></td>
                                            <td><a href="{{ action('MembersController@show',['id' => $invoice->member->id]) }}">{{ $invoice->member->name}}</a>
                                            </td>
                                            <td>R$ {{ $invoice->total}}</td>
                                            <td>R$ {{ $invoice->pending_amount}}</td>
                                            <td>R$ {{ $invoice->discount_amount}}</td>
                                            <td>{{ $invoice->created_at->toDayDateTimeString()}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Ações</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            @permission(['manage-gymie','manage-invoices','view-invoice'])
                                                            <a href="{{ action('InvoicesController@show',['id' => $invoice->id]) }}">
                                                                Ver fatura
                                                            </a>
                                                            @endpermission
                                                        </li>
                                                        <li>
                                                            @permission(['manage-gymie','manage-invoices','delete-invoice'])
                                                            <a href="#" class="delete-record" data-delete-url="{{ url('invoices/'.$invoice->id.'/delete') }}"
                                                               data-record-id="{{$invoice->id}}">
                                                                Excluir fatura
                                                            </a>
                                                            @endpermission
                                                        </li>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="gymie_paging_info">
                                            Exibindo página {{ $invoices->currentPage() }} de {{ $invoices->lastPage() }}
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="gymie_paging pull-right">
                                            {!! str_replace('/?', '?', $invoices->appends(Input::only('search'))->render()) !!}
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div><!-- / Panel-Body -->
                    </div><!-- / Panel-no-Border -->
                </div><!-- / Main-Col -->
            </div><!-- / Main-Row -->
        </div><!-- / Container -->
    </div><!-- / RightSide -->
@stop

@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.deleterecord();
        });
    </script>
@stop
