<?php
$count = collect(array_filter(explode(',', \Utilities::getSetting('sender_id_list'))))->count();
$senderIds = explode(',', \Utilities::getSetting('sender_id_list'));
?>
<div class="panel-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('name','Nome do Evento') !!}
                {!! Form::text('name',null,['class'=>'form-control', 'id' => 'name']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('date','Data do Evento') !!}
                @if(isset($event) && $event->date != "")
                    {!! Form::text('date',$event->date->format('d/m/Y'),['class'=>'form-control datepicker-default', 'id' => 'date']) !!}
                @else
                    {!! Form::text('date',null,['class'=>'form-control datepicker-default', 'id' => 'date']) !!}
                @endif
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('description','Descrição do Evento') !!}
                {!! Form::text('description',null,['class'=>'form-control', 'id' => 'description']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
            {!! Form::label('status','Status') !!}
            <!--0 for inactive , 1 for active-->
                {!! Form::select('status',array('1' => 'Ativo', '0' => 'Inativo'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'status']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('send_to','Enviar para') !!}
                {!! Form::select('send_to[]',array('0' => 'Membros ativos', '1' => 'Membros inativos', '2' => 'Consultas de leads', '3' => 'Consultas perdidas'),null,['class'=>'form-control selectpicker show-tick show-menu-arrow','multiple' => 'multiple', 'id' => 'send_to']) !!}
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
            <div class="form-group">
                {!! Form::label('message','Texto da Mensagem') !!}
                {!! Form::textarea('message',null,['class'=>'form-control', 'id' => 'message','rows' => '5']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        </div>
    </div>
</div>