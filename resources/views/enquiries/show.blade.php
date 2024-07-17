@extends('app')

@section('content')

<div class="rightside bg-grey-100">
    <div class="container-fluid">

        @include('flash::message')

        <div class="row"><!-- Main row -->
            <div class="col-md-12"><!-- Main col -->
                <div class="panel no-border ">
                    <div class="panel-title">

                        <div class="panel-head font-size-20">Detalhes da Consulta</div>
                        <div class="pull-right no-margin">
                            @if($enquiry->status == 1)
                                @permission(['manage-gymie','manage-enquiries','edit-enquiry'])
                                <a href="#" class="mark-enquiry-as btn btn-sm btn-primary active pull-right margin-right-5"
                                   data-goto-url="{{ url('enquiries/'.$enquiry->id.'/markMember') }}" data-record-id="{{$enquiry->id}}"><i
                                            class="fa fa-user"></i> Marcar como Aluno</a>
                                <a href="#" class="mark-enquiry-as btn btn-sm btn-primary active pull-right margin-right-5"
                                   data-goto-url="{{ url('enquiries/'.$enquiry->id.'/lost') }}" data-record-id="{{$enquiry->id}}"><i
                                            class="fa fa-times"></i> Marcar como perdido</a>
                                @endpermission
                            @endif

                            @permission(['manage-gymie','manage-enquiries','edit-enquiry'])
                            <a class="btn btn-sm btn-primary pull-right margin-right-5"
                               href="{{ action('EnquiriesController@edit',['id' => $enquiry->id]) }}"><span>Editar</span></a>
                            @endpermission
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="row">                <!--inner row start-->
                            <div class="col-sm-8">          <!-- inner column start -->
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="fa fa-user center-icons color-blue-grey-100 fa-7x"></i>
                                    </div>

                                    <div class="col-sm-8">

                                        <!-- Spacer -->
                                        <div class="row visible-md visible-lg">
                                            <div class="col-sm-4">
                                                <label>&nbsp;</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Nome</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <span class="show-data">{{$enquiry->name}}</span>
                                            </div>
                                        </div>
                                        <hr class="margin-top-0 margin-bottom-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Data de Nascimento</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <span class="show-data">{{ \Carbon\Carbon::parse($enquiry->DOB)->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                        <hr class="margin-top-0 margin-bottom-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <span class="show-data">{{$enquiry->email}}</span>
                                            </div>
                                        </div>
                                        <hr class="margin-top-0 margin-bottom-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Endereço</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <span class="show-data">{{$enquiry->address}}</span>
                                            </div>
                                        </div>
                                        <hr class="margin-top-0 margin-bottom-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Gênero</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <span class="show-data">{{Utilities::getGender($enquiry->gender)}}</span>
                                            </div>
                                        </div>
                                        <hr class="margin-top-0 margin-bottom-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Contato</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <span class="show-data">{{$enquiry->contact}}</span>
                                            </div>
                                        </div>
                                        <hr class="margin-top-0 margin-bottom-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>CEP</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <span class="show-data">{{$enquiry->pin_code}}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="row"><!-- Main row -->
                                    <div class="col-md-12"><!-- Main Col -->
                                        <div class="panel bg-grey-50">
                                            <div class="panel-title margin-top-5 bg-transparent">
                                                <div class="panel-head"><strong><span class="fa-stack">
                          <i class="fa fa-circle-thin fa-stack-2x"></i>
                          <i class="fa fa-ellipsis-h fa-stack-1x"></i>
                        </span> Detalhes Adicionais</strong></div>
                                            </div>
                                            <div class="panel-body">

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Ocupação</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="show-data">{{Utilities::getOccupation($enquiry->occupation)}}</span>
                                                    </div>
                                                </div>
                                                <hr class="margin-top-0 margin-bottom-10">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Início em</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="show-data">{{$enquiry->start_by}}</span>
                                                    </div>
                                                </div>
                                                <hr class="margin-top-0 margin-bottom-10">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Interesse</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <?php
                                                        $Int1 = array();
                                                        $InName = App\Service::whereIn('id', explode(',', $enquiry->interested_in))->get();

                                                        foreach ($InName as $Int2) {
                                                            $Int1[] = $Int2->name;
                                                        }
                                                        ?>
                                                        <span class="show-data">{{ implode(",",$Int1) }}</span>
                                                    </div>
                                                </div>
                                                <hr class="margin-top-0 margin-bottom-10">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Objetivo</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="show-data">{{Utilities::getAim($enquiry->aim)}}</span>
                                                    </div>
                                                </div>
                                                <hr class="margin-top-0 margin-bottom-10">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Fonte</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="show-data">{{Utilities::getSource($enquiry->source)}}</span>
                                                    </div>
                                                </div>
                                                <hr class="margin-top-0 margin-bottom-10">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Status</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="show-data">{{Utilities::getEnquiryStatus ($enquiry->status)}}</span>
                                                    </div>
                                                </div>

                                            </div>   <!-- End of inner Column -->
                                        </div>
                                    </div>
                                </div>
                            </div>   <!-- End Of inner Row -->
                        </div>    <!-- / Panel-body -->
                    </div><!-- / Panel-no-border -->
                </div><!-- / Main-col -->
            </div><!-- / Main-row -->
        </div>

        <!-- Follow-ups já criados -->

        <!-- ############################ Timeline de Follow-ups já criados ######################### -->

        <div class="row"><!-- Main row -->
            <div class="col-md-12">
                <div class="panel no-border">
                    <div class="panel-title bg-white no-border">
                        <div class="panel-head"><i class="fa fa-bookmark-o"></i> <span> Timeline de Follow-ups</span></div>
                        @permission(['manage-gymie','manage-enquiries','add-enquiry-followup'])
                        <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#createFollowupModal"
                                data-id="createFollowupModal">
                            Adicionar Follow-up
                        </button>
                        @endpermission
                    </div>

                    <div class="panel-body">

                        @if($followups->count() != 0)
                            <div class="timeline-centered">
                                @foreach($followups as $followup)
                                    <article class="timeline-entry">
                                        <div class="timeline-entry-inner">
                                            <time class="timeline-time"><span
                                                        class="followup-time">{{ $followup->updated_at->format('d/m/Y') }}</span></time>
                                            <div class="timeline-icon {{ Utilities::getIconBg($followup->status) }}">
                                                <i class="{{ Utilities::getStatusIcon($followup->status) }}"></i>
                                            </div>
                                            <div class="timeline-label">
                                                <p>Via {{ Utilities::getFollowupBy($followup->followup_by) }}
                                                    @if($followup->status == 0)
                                                        @permission(['manage-gymie','manage-enquiries','edit-enquiry-followup'])
                                                        <button class="btn btn-info btn-sm pull-right" data-toggle="modal"
                                                                data-target="#editFollowupModal-{{$followup->id}}" data-id="{{$followup->id}}">
                                                            Editar
                                                        </button>
                                                        @endpermission
                                                    @else
                                                        <span class="label label-primary pull-right followup-label">Concluído</span>
                                                    @endif
                                                </p>
                                                @if($followup->status == 0)
                                                    <p>Data de Vencimento: {{ \Carbon\Carbon::parse($followup->due_date)->format('d/m/Y') }}</p>
                                                @else
                                                    <p>{{ $followup->outcome }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @else
                            <h2 class="text-center padding-top-15">Nenhum follow-up ainda.</h2>
                        @endif
                    </div><!-- Panel Body End -->

                </div><!-- Panel End -->
            </div><!-- Col End -->
        </div><!-- / Row End -->

        <!-- Editar Modal de Follow-up -->
        @if($followups->count() != 0)
            @foreach($followups as $followup)
                <div id="editFollowupModal-{{$followup->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Atualize o status e resultado</h4>
                            </div>
                            {!! Form::Open(['action' => ['FollowupsController@update',$followup->id],'id' => 'followupform']) !!}
                            <div class="modal-body">

                                {!! Form::hidden('enquiry_id',$followup->enquiry->id) !!}

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {!! Form::label('date','Data') !!}
                                            {!! Form::text('date',$followup->created_at->format('d/m/Y'),['class'=>'form-control', 'id' => 'date', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {!! Form::label('followup_by','Follow-up Por') !!}
                                            {!! Form::select('followup_by',array('0' => 'Telefone', '1' => 'SMS', '2' => 'Pessoalmente'),$followup->followup_by,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'followup_by']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {!! Form::label('due_date','Data de Vencimento') !!}
                                            {!! Form::text('due_date',$followup->due_date->format('d/m/Y'),['class'=>'form-control', 'id' => 'due_date', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {!! Form::label('status','Status') !!}
                                            {!! Form::select('status',array('0' => 'Pendente', '1' => 'Concluído',),$followup->status,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'status']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            {!! Form::label('outcome','Resultado') !!}
                                            {!! Form::text('outcome',$followup->outcome,['class'=>'form-control', 'id' => 'outcome']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="submit" class="btn btn-info" value="Concluir" id="btn-{{ $followup->id }}"/>
                            </div>
                            {!! Form::Close() !!}
                        </div>
                    </div>
                </div>

        @endforeach
    @endif

    <!-- Criar Modal de Follow-up -->
        <div id="createFollowupModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Novo Follow-up</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::Open(['action' => 'FollowupsController@store','files'=>'true']) !!}
                        {!! Form::hidden('enquiry_id',$enquiry->id) !!}

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('followup_by','Follow-up Por') !!}
                                    {!! Form::select('followup_by',array('0' => 'Telefone', '1' => 'SMS', '2' => 'Pessoalmente'),null,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'followup_by']) !!}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('due_date','Data de Vencimento') !!}
                                    {!! Form::text('due_date',null,['class'=>'form-control datepicker-default', 'id' => 'due_date']) !!}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-info" value="Criar" id="createFollowup"/>
                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@stop
@section('footer_scripts')
<script src="{{ URL::asset('assets/js/followup.js') }}" type="text/javascript"></script>
@stop
@section('footer_script_init')
<script type="text/javascript">
    $(document).ready(function () {
        gymie.markEnquiryAs();
    });
</script>
@stop
