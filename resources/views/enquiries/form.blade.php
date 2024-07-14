<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('name','Nome',['class'=>'control-label']) !!}
            {!! Form::text('name',null,['class'=>'form-control', 'id' => 'name']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('contact','Contato') !!}
            {!! Form::text('contact',null,['class'=>'form-control', 'id' => 'contact']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('email','Email') !!}
            {!! Form::text('email',null,['class'=>'form-control', 'id' => 'email']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('DOB','Data de Nascimento') !!}
            {!! Form::text('DOB',null,['class'=>'form-control datepicker-default', 'id' => 'DOB']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('gender','Gênero') !!}
            {!! Form::select('gender',array('m' => 'Masculino', 'f' => 'Feminino'),null,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'gender']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('occupation','Ocupação') !!}
            {!! Form::select('occupation',array('0' => 'Estudante', '1' => 'Dona de Casa','2' => 'Autônomo','3' => 'Profissional','4' => 'Freelancer','5' => 'Outros'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'occupation']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('start_by','Início Em') !!}
            {!! Form::text('start_by',null,['class'=>'form-control datepicker-default', 'id' => 'start_by']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php $services = App\Service::lists('name', 'id'); ?>
            {!! Form::label('interested_in','Interesse Em') !!}
            {!! Form::select('interested_in[]',$services,1,['class'=>'form-control selectpicker show-tick show-menu-arrow','multiple' => 'multiple','id' => 'interested_in']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('aim','Por que você planeja se juntar?',['class'=>'control-label']) !!}
            {!! Form::select('aim',array('0' => 'Fitness', '1' => 'Networking', '2' => 'Musculação', '3' => 'Perda de Gordura', '4' => 'Ganho de Peso', '5' => 'Outros'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'aim']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('source','Como você soube sobre nós?',['class'=>'control-label']) !!}
                    {!! Form::select('source',array('0' => 'Promoções', '1' => 'Boca a Boca', '2' => 'Outros'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'source']) !!}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('pin_code','CEP',['class'=>'control-label']) !!}
                    {!! Form::text('pin_code',null,['class'=>'form-control', 'id' => 'pin_code']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('address','Endereço') !!}
            {!! Form::textarea('address',null,['class'=>'form-control', 'id' => 'address', 'rows' => 5]) !!}
        </div>
    </div>
</div>
