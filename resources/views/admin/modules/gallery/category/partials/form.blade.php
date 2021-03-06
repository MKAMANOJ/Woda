<div id="new-categories">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
        {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
        <span class="required" aria-required="true"> * </span>
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Name']) !!}
        @if($errors->first('name'))
          <div class="ui pointing red basic label"> {{$errors->first('name')}}</div>
        @endif
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group pull-right">
        <a href="{{ route('gallery.categories') }}" type="button" class="btn btn-info"><i class="fa fa-backward"
                                                                                                aria-hidden="true"></i>
          Back</a>
        <button class="btn btn-primary green" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;{{ $formAction }}
        </button>
      </div>
    </div>
  </div>
</div>
