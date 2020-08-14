<div id="new-categories">
  <div class="row">
    <div class="col-md-6">
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
    <div class="form-group {{ $errors->has('nepali_name') ? 'has-error' :'' }}">
      {!! Form::label('nepali_name', 'नाम', ['class' => 'control-label']) !!}
      <span class="required" aria-required="true"> * </span>
      {!! Form::text('nepali_name', null, ['class' => 'form-control', 'placeholder'=>'नाम']) !!}
      @if($errors->first('nepali_name'))
        <div class="ui pointing red basic label"> {{$errors->first('nepali_name')}}</div>
      @endif
    </div>
  </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group {{ $errors->has('website_link') ? 'has-error' :'' }}">
        {!! Form::label('website_link', 'Website Link', ['class' => 'control-label']) !!}
        <span class="required" aria-required="true"> * </span>
        {!! Form::text('website_link', null, ['class' => 'form-control', 'placeholder'=>'Name']) !!}
        @if($errors->first('website_link'))
          <div class="ui pointing red basic label"> {{$errors->first('website_link')}}</div>
        @endif
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->has('order') ? 'has-error' :'' }}">
        {!! Form::label('order', 'Order', ['class' => 'control-label']) !!}
        <span class="required" aria-required="true"> * </span>
        {!! Form::number('order', null, ['class' => 'form-control', 'placeholder'=>'Order']) !!}
        @if($errors->first('order'))
          <div class="ui pointing red basic label"> {{$errors->first('order')}}</div>
        @endif
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group pull-right">
        <a href="{{ route('website-links.index') }}" type="button" class="btn btn-info"><i class="fa fa-backward"
                                                                                       aria-hidden="true"></i>
          Back</a>
        <button class="btn btn-primary green" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;{{ $formAction }}
        </button>
      </div>
    </div>
  </div>
</div>
