@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Insira os detalhes do serviço</div>
                        </div>

                        {!! Form::model($service, ['method' => 'POST','action' => ['ServicesController@update',$service->id],'id'=>'servicesform']) !!}

                        @include('services.form',['submitButtonText' => 'Atualizar'])

                        {!! Form::Close() !!}

                        </form>

                    </div>
                </div>
            </div>
        </div>

@stop

@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/service.js') }}" type="text/javascript"></script>
@stop