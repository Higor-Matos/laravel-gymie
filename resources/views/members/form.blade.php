<?php use Carbon\Carbon; ?>

<!-- Campos Ocultos -->
@if(Request::is('members/create'))
    {!! Form::hidden('invoiceCounter', $invoiceCounter) !!}
    {!! Form::hidden('memberCounter', $memberCounter) !!}
@endif

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('member_code', 'Código do Aluno') !!}
            {!! Form::text('member_code', $member_code, ['class'=>'form-control', 'id' => 'member_code', ($member_number_mode == \constNumberingMode::Auto ? 'readonly' : '')]) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('name', 'Nome', ['class'=>'control-label']) !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'id' => 'name']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('DOB', 'Data de Nascimento') !!}
            {!! Form::text('DOB', null, ['class'=>'form-control datepicker-default', 'id' => 'DOB']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('gender', 'Gênero') !!}
            {!! Form::select('gender', ['m' => 'Masculino', 'f' => 'Feminino'], null, ['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'gender']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('contact', 'Contato') !!}
            {!! Form::text('contact', null, ['class'=>'form-control', 'id' => 'contact']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class'=>'form-control', 'id' => 'email']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('emergency_contact', 'Contato de Emergência') !!}
            {!! Form::text('emergency_contact', null, ['class'=>'form-control', 'id' => 'emergency_contact']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('health_issues', 'Problemas de Saúde') !!}
            {!! Form::text('health_issues', null, ['class'=>'form-control', 'id' => 'health_issues']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('proof_name', 'Forma de pagamento preferencial') !!}
            {!! Form::text('proof_name', null, ['class'=>'form-control', 'id' => 'proof_name']) !!}
        </div>
    </div>

    @if(isset($member))
        <?php
        $media = $member->getMedia('proof');
        $image = ($media->isEmpty() ? 'http://clipart-library.com/images_k/money-icon-transparent-background/money-icon-transparent-background-25.png' : url($media[0]->getUrl('form')));
        ?>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('proof_photo', 'Foto do Comprovante de Pagamento') !!}
                {!! Form::file('proof_photo', ['class'=>'form-control', 'id' => 'proof_photo']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <img alt="Foto do Comprovante de Pagamento" class="pull-right" src="{{ $image }}" style="width:40px; height: 40px; margin-right: auto; margin-left: auto;"/>
        </div>
    @else
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('proof_photo', 'Foto do Comprovante de Pagamento') !!}
                {!! Form::file('proof_photo', ['class'=>'form-control', 'id' => 'proof_photo']) !!}
            </div>
        </div>
    @endif
</div>

<div class="row">
    @if(isset($member))
        <?php
        $media = $member->getMedia('profile');
        $image = ($media->isEmpty() ? 'https://www.pngall.com/wp-content/uploads/12/Avatar-PNG-Images-HD.png' : url($media[0]->getUrl('form')));
        ?>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('photo', 'Foto') !!}
                {!! Form::file('photo', ['class'=>'form-control', 'id' => 'photo']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <img alt="Foto de Perfil" class="pull-right" src="{{ $image }}" style="width: 50px; height: 50px; margin-right: auto; margin-left: auto;"/>
        </div>
    @else
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('photo', 'Foto') !!}
                {!! Form::file('photo', ['class'=>'form-control', 'id' => 'photo']) !!}
            </div>
        </div>
    @endif

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('status', 'Status') !!}
            {!! Form::select('status', ['1' => 'Ativo', '0' => 'Inativo'], null, ['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'status']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('aim', 'Por que pretende se juntar?', ['class'=>'control-label']) !!}
            {!! Form::select('aim', ['0' => 'Fitness', '1' => 'Networking', '2' => 'Body Building', '3' => 'Perda de Gordura', '4' => 'Ganho de Peso', '5' => 'Outros'], null, ['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'aim']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('source', 'Como ficou sabendo de nós?', ['class'=>'control-label']) !!}
            {!! Form::select('source', ['0' => 'Promoções', '1' => 'Boca a Boca', '2' => 'Redes Sociais', '2' => 'Outros'], null, ['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'source']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('occupation', 'Ocupação') !!}
                    {!! Form::select('occupation', ['0' => 'Estudante', '1' => 'Dono de Casa', '2' => 'Autônomo', '3' => 'Profissional', '4' => 'Freelancer', '5' => 'Outros'], null, ['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'occupation']) !!}
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('pin_code', 'CEP', ['class'=>'control-label']) !!}
                    {!! Form::text('pin_code', null, ['class'=>'form-control', 'id' => 'pin_code']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('address', 'Endereço') !!}
            {!! Form::textarea('address', null, ['class'=>'form-control', 'id' => 'address', 'rows' => 5]) !!}
        </div>
    </div>
</div>
