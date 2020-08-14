<div id="new-categories">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
        {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
        <span class="required" aria-required="true"> * </span>
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder'=>'Title', 'v-model' => 'name']) !!}
        @if($errors->first('title'))
          <div class="ui pointing red basic label"> {{$errors->first('title')}}</div>
        @endif
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group {{ $errors->has('slug') ? 'has-error' :'' }}">
        {!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
        <span class="required" aria-required="true"> * </span>
        {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder'=>'Slug', $readAction ? '' : "v-model = slug", 'readonly' => $readAction ]) !!}
        @if($errors->first('slug'))
          <div class="ui pointing red basic label"> {{$errors->first('slug')}}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group {{ $errors->has('content') ? 'has-error' :'' }}">
        {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
        <span class="required" aria-required="true"> * </span>
        {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Subject']) !!}
        @if($errors->first('subject'))
          <div class="ui pointing red basic label"> {{ $errors->first('subject') }}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group {{ $errors->has('content') ? 'has-error' :'' }}">
        {!! Form::label('content', 'Content', ['class' => 'control-label']) !!}
        <span class="required" aria-required="true"> * </span>
        {!! Form::textarea('content', null, ['class' => 'form-control ckeditor', 'required']) !!}
        @if($errors->first('content'))
          <div class="ui pointing red basic label"> {{$errors->first('content')}}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group pull-right">
        <a href="{{ route('email-template.index') }}" type="button" class="btn btn-info"><i class="fa fa-backward"
                                                                                            aria-hidden="true"></i> Back</a>
        <button class="btn btn-primary green" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;{{ $formAction }}
        </button>
      </div>
    </div>
  </div>
</div>

@section('script')
  @parent
  <script type="text/javascript" src="{{ asset('admin/metronic/global/plugins/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('admin/js/categories/categories.js') }}"></script>
@endsection
