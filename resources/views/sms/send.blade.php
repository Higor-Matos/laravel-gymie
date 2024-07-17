@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">

        @include('flash::message')

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

            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Insira os detalhes da mensagem</div>
                        </div>

                        {!! Form::Open(['url' => 'sms/shoot','id'=>'sendform']) !!}
                        <?php
                        $count = collect(array_filter(explode(',', \Utilities::getSetting('sender_id_list'))))->count();
                        $senderIds = explode(',', \Utilities::getSetting('sender_id_list'));
                        ?>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('send_to','Enviar Para') !!} </br>
                                        <div class="checkbox checkbox-theme display-inline-block">
                                            <input type="checkbox" name="send[]" id="activeMembers" value="0">
                                            <label for="activeMembers" class="padding-left-30">Alunos ativos</label>
                                        </div>

                                        <div class="checkbox checkbox-theme display-inline-block">
                                            <input type="checkbox" name="send[]" id="inactiveMembers" value="1">
                                            <label for="inactiveMembers" class="padding-left-30">Alunos inativos</label>
                                        </div>

                                        <div class="checkbox checkbox-theme display-inline-block margin-right-5">
                                            <input type="checkbox" name="send[]" id="leadEnquiries" value="2">
                                            <label for="leadEnquiries" class="padding-left-30">Consultas de leads</label>
                                        </div>

                                        <div class="checkbox checkbox-theme display-inline-block margin-right-11">
                                            <input type="checkbox" name="send[]" id="lostEnquiries" value="3">
                                            <label for="lostEnquiries" class="padding-left-30">Consultas perdidas</label>
                                        </div>

                                        <div class="checkbox checkbox-theme display-inline-block margin-right-5">
                                            <input type="checkbox" name="send[]" id="custom" value="4">
                                            <label for="custom" class="padding-left-30">Personalizado</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($count == 1)

                                {!! Form::hidden('sender_id',\Utilities::getSetting('sms_sender_id')) !!}

                            @elseif($count > 1)

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="sender_id">ID do Remetente</label>
                                            <select id="sender_id" name="sender_id" class="form-control selectpicker show-tick">
                                                @foreach($senderIds as $senderId)
                                                    <option value="{{ $senderId }}">{{ $senderId }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            @endif

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group" id="customcontactsdiv">
                                        {!! Form::label('customcontacts','Números de contato') !!}
                                        {!! Form::text('customcontacts',null,['class'=>'form-control tokenfield', 'id' => 'customcontacts', 'placeholder' => 'Digite números de contato de 10 dígitos e pressione Enter']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('message','Texto da mensagem') !!}
                                        {!! Form::textarea('message',null,['class'=>'form-control', 'id' => 'message','rows' => '5']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::submit('Enviar Agora', ['class' => 'btn btn-primary pull-right']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {!! Form::Close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/send.js') }}" type="text/javascript"></script>
@stop

@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.loadBsTokenInput();
            gymie.customsendmessage();
        });
    </script>
@stop
