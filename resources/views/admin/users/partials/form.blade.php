<div class="row">
  <div class="{{ getUserDivClass($readAction) }}">
    <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
      {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
      <span class="required" aria-required="true"> * </span>
      {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Name']) !!}
      @if($errors->first('name'))
        <div class="ui pointing red basic label"> {{$errors->first('name')}}</div>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    @if(! $readAction)
      <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
        <span class="required" aria-required="true"> * </span>
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder'=>'email' ]) !!}
        @if($errors->first('email'))
          <div class="ui pointing red basic label"> {{$errors->first('email')}}</div>
        @endif
      </div>
    @endif
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group {{ $errors->has('password') ? 'has-error' :'' }}">
      {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
      <span class="required" aria-required="true"> * </span>
      {!! Form::password('password', ['class' => 'form-control', 'placeholder'=>'Password']) !!}
      @if($errors->first('password'))
        <div class="ui pointing red basic label"> {{$errors->first('password')}}</div>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' :'' }}">
      {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'control-label']) !!}
      <span class="required" aria-required="true"> * </span>
      {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder'=>'Confirm Password']) !!}
      @if($errors->first('password_confirmation'))
        <div class="ui pointing red basic label"> {{$errors->first('password_confirmation')}}</div>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group {{ $errors->has('role') ? 'has-error' :'' }}">
      {!! Form::label('role', 'Role', ['class' => 'control-label']) !!}
      <span class="required" aria-required="true"> * </span>
      {!! Form::select('role', $userRoles , $selected , ['class' => 'form-control']) !!}
      <span class="help-block"> {{ $errors->first('role') }}</span>
    </div>
  </div>
  <br>
  <div class="col-md-6" style="margin-top:8px;">
    <div class="form-group md-checkbox">
      {!! Form::checkbox('active', '1', null, ['id' => 'active']) !!}
      <label for="active">
        <span></span>
        <span class="check"></span>
        <span class="box"></span>Is Active?
      </label>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group pull-right">
      <a href="{{ route('users.index') }}" type="button" class="btn btn-info"><i class="fa fa-backward"
                                                                                 aria-hidden="true"></i> Back</a>
      <button class="btn btn-primary green" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;{{ $formAction }}
      </button>
    </div>
  </div>
</div>
