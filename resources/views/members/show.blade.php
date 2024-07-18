@extends('app')

@section('content')
    <?php use Carbon\Carbon; ?>

    <div class="rightside bg-grey-100">
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
        </div>
        <div class="container-fluid">

            <div class="row"><!-- Main row -->
                <div class="col-md-12"><!-- Main Col -->
                    <div class="panel no-border ">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Detalhes do Aluno</div>
                            <div class="pull-right no-margin">
                                @permission(['manage-gymie','manage-members','edit-member'])
                                <a class="btn btn-primary" href="{{ action('MembersController@edit',['id' => $member->id]) }}">
                                    <span>Editar</span>
                                </a>
                                @endpermission

                                @permission(['manage-gymie','manage-members','delete-member'])
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$member->id}}" data-id="{{$member->id}}">
                                    <span>Deletar</span>
                                </button>
                                @endpermission

                                <!-- Modal -->
                                <div id="deleteModal-{{$member->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Confirmar</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Você tem certeza que deseja deletar?</p>
                                            </div>
                                            <div class="modal-footer">
                                                {!! Form::Open(['action'=>['MembersController@archive',$member->id],'method' => 'POST','id'=>'archiveform-'.$member->id]) !!}
                                                <input type="submit" class="btn btn-danger" value="Sim" id="btn-{{ $member->id }}"/>
                                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                                {!! Form::Close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">                <!--Main row start-->
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- Spacer -->
                                            <div class="row visible-md visible-lg">
                                                <div class="col-sm-4">
                                                    <label>&nbsp;</label>
                                                </div>
                                            </div>
                                            <?php
                                            $images = $member->getMedia('profile');
                                            $profileImage = ($images->isEmpty() ? 'https://www.pngall.com/wp-content/uploads/12/Avatar-PNG-Images-HD.png' : url($images[0]->getUrl()));
                                            ?>
                                            <img class="AutoFitResponsive" src="{{ $profileImage }}" style="width: 50px; height: 50px; margin-right: auto; margin-left: auto;"/>
                                        </div>


                                        <div class="col-sm-8">            <!-- Outer Row Start -->

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
                                                    <span class="show-data">{{$member->name}}</span>
                                                </div>
                                            </div>

                                            <hr class="margin-top-0 margin-bottom-10">

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Código do Aluno</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{$member->member_code}}</span>
                                                </div>
                                            </div>
                                            <hr class="margin-top-0 margin-bottom-10">

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Data de Nascimento</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{$member->DOB}}</span>
                                                </div>
                                            </div>
                                            <hr class="margin-top-0 margin-bottom-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Gênero</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{Utilities::getGender($member->gender)}}</span>
                                                </div>
                                            </div>
                                            <hr class="margin-top-0 margin-bottom-10">

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Número de Contato</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{$member->contact}}</span>
                                                </div>
                                            </div>

                                            <hr class="margin-top-0 margin-bottom-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{$member->email}}</span>
                                                </div>
                                            </div>

                                            <hr class="margin-top-0 margin-bottom-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Aluno Desde</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{$member->created_at->format('d/m/Y')}}</span>
                                                </div>
                                            </div>
                                            <hr class="margin-top-0 margin-bottom-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Contato de Emergência</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{$member->emergency_contact}}</span>
                                                </div>
                                            </div>


                                        </div>  <!-- End of outer Row -->
                                    </div>
                                </div>   <!-- End of Outer Column -->

                                <div class="col-sm-4">
                                    <div class="row"><!-- Main row -->
                                        <div class="col-md-12"><!-- Main Col -->
                                            <div class="panel bg-grey-50">
                                                <div class="panel-title bg-transparent">
                                                    <div class="panel-head"><strong><span class="fa-stack">
                              <i class="fa fa-circle-thin fa-stack-2x"></i>
                              <i class="fa fa-ellipsis-h fa-stack-1x"></i>
                            </span> Detalhes Adicionais</strong></div>
                                                </div>
                                                <div class="panel-body">

                                                    <div class="row">
                                                        <?php
                                                        $subscriptions = $member->subscriptions;
                                                        $plansArray = array();
                                                        foreach ($subscriptions as $subscription) {
                                                            $plansArray[] = $subscription->plan->plan_name;
                                                        }
                                                        ?>
                                                        <div class="col-sm-4">
                                                            <label>Nome do Plano</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <span class="show-data">{{implode(",",$plansArray)}}</span>
                                                        </div>
                                                    </div>
                                                    <hr class="margin-top-0 margin-bottom-10">

                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Status</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <span class="show-data">{{Utilities::getStatusValue ($member->status)}}</span>
                                                        </div>
                                                    </div>
                                                    <hr class="margin-top-0 margin-bottom-10">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Objetivo</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <span class="show-data">{{Utilities::getAim ($member->aim)}}</span>
                                                        </div>
                                                    </div>
                                                    <hr class="margin-top-0 margin-bottom-10">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Documento de Identidade</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <span class="show-data">{{$member->proof_name}}</span>
                                                        </div>
                                                    </div>
                                                    <hr class="margin-top-0 margin-bottom-10">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Endereço</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <span class="show-data">{{$member->address}}</span>
                                                        </div>
                                                    </div>
                                                    <hr class="margin-top-0 margin-bottom-10">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Problemas de Saúde</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <span class="show-data">{{$member->health_issues}}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>   <!-- End Of Main Row -->
                        </div>
                    </div>
                </div>
            </div>

            <!--######################### Histórico de assinaturas do Aluno ################################# -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border ">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Histórico de assinaturas do Aluno</div>
                        </div>
                        <div class="panel-body">
                            <table id="_payment" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Número da Fatura</th>
                                    <th>Nome do Plano</th>
                                    <th>Data de Início</th>
                                    <th>Data de Término</th>
                                    <th>Status</th>
                                    <th>Status do Pagamento</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($member->subscriptions->sortByDesc('created_at') as $subscription)
                                    <tr>
                                        <td>
                                            <a href="{{ action('InvoicesController@show',['id' => $subscription->invoice_id]) }}">{{ $subscription->invoice->invoice_number }}</a>
                                        </td>
                                        <td>{{ $subscription->plan->plan_name }}</td>
                                        <td>{{ $subscription->start_date->format('d/m/Y') }}</td>
                                        <td>{{ $subscription->end_date->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="{{ Utilities::getSubscriptionLabel ($subscription->status) }}">{{ Utilities::getSubscriptionStatus ($subscription->status) }}</span>
                                        </td>
                                        <td>{{ Utilities::getInvoiceStatus ($subscription->invoice->status) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
