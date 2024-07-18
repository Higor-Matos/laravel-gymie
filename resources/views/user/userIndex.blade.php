@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100">
            @include('flash::message')
            <h1 class="page-title">Usuários</h1>
            <a href="{{ action('AclController@createUser') }}" class="btn btn-primary active pull-right" role="button"> Adicionar</a>
        </div>

        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel no-border ">
                        <div class="panel-title bg-white no-border">
                        </div>
                        <div class="panel-body no-padding-top bg-white">
                            <table id="staffs" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Nome</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Função</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($users as $user)
                                    <?php
                                    $media = $user->getMedia('staff');
                                    $image = ($media->isEmpty() ? 'https://dragonball.guru/wp-content/uploads/2021/03/goten-profile-pic-400x400.png' : url($media[0]->getUrl('thumb')));
                                    ?>
                                    <tr>
                                        <td class="text-center"><img src="{{ $image }}" alt="Foto do usuário" width="50" height="50"></td>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">{{ $user->roleUser->role->name }}</td>

                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">Ações</button>
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Alternar Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{ action('AclController@editUser', ['id' => $user->id]) }}">
                                                            Editar detalhes
                                                        </a>
                                                    </li>
                                                    @if(Auth::user()->id != $user->id)
                                                        <li>
                                                            <a href="#" class="delete-record" data-delete-url="{{ url('user/'.$user->id.'/delete') }}"
                                                               data-record-id="{{ $user->id }}">Deletar usuário</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
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

@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.deleterecord();
        });
    </script>
@stop
