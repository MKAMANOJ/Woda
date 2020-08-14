<div class="row">
  <div class="col-md-6">
    <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
      {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
      <span class="required" aria-required="true"> * </span>
      {!! Form::text('title', null, ['class' => 'form-control', 'placeholder'=>'Title']) !!}
      @if($errors->first('title'))
        <div class="ui pointing red basic label"> {{$errors->first('title')}}</div>
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
    <div class="form-group {{ $errors->has('description') ? 'has-error' :'' }}">
      {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
      {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description....', 'rows' => 4]) }}
      @if($errors->first('description'))
        <div class="ui pointing red basic label"> {{$errors->first('description')}}</div>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="col-md-6">
      <div class="form-group md-checkbox {{ $errors->has('upload') ? 'has-error' :'' }}">
        {!! Form::checkbox('upload', '1', isset($file) && ($file->content_type == 'pdf' || $file->content_type == 'image'),
         ['id' => 'upload', 'class' => 'content-type']) !!}
        <label for="upload">
          <span></span>
          <span class="check"></span>
          <span class="box"></span>Upload Files/Photos
        </label>
        @if($errors->first('upload'))
          <div class="ui pointing red basic label"> {{$errors->first('upload')}}</div>
        @endif
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group md-checkbox {{ $errors->has('write') ? 'has-error' :'' }}">
        {!! Form::checkbox('write', '1', isset($file) && $file->content_type == 'html', ['id' => 'write', 'class' => 'content-type']) !!}
        <label for="write">
          <span></span>
          <span class="check"></span>
          <span class="box"></span>Write Content
        </label>
        @if($errors->first('write'))
          <div class="ui pointing red basic label"> {{$errors->first('write')}}</div>
        @endif
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group md-checkbox">
      {!! Form::checkbox('sendNotification', '1', null, ['id' => 'sendNotification']) !!}
      <label for="sendNotification">
        <span></span>
        <span class="check"></span>
        <span class="box"></span>Send Notification
      </label>
    </div>
  </div>
</div>
<div class="row" style="display: none;" id="file-div">
  <div class="col-md-6">
    <div class="form-group {{ $errors->has('uploaded_file') ? 'has-error' :'' }}">
      {!! Form::label('uploaded_file', 'Upload File', ['class' => 'control-label']) !!}
      <span class="required" aria-required="true"> * </span>
      <input type="file" name="uploaded_file" class="form-control">
      @if($errors->first('uploaded_file'))
        <div class="ui pointing red basic label"> {{$errors->first('uploaded_file')}}</div>
      @endif
    </div>
  </div>
  @if(isset($file) && $file->file_name)
    <div class="col-md-6" style="margin-top: 3%;">
      <a href="{{ getStorageURL($file->file_name) }}" target="_blank">{{ $file->original_filename }}</a>
    </div>
  @endif
</div>
<div class="row" style="display: none;" id="content-div">
  <div class="col-md-12">
    <div class="form-group {{ $errors->has('content') ? 'has-error' :'' }}">
      {!! Form::label('content', 'Write Content', ['class' => 'control-label']) !!}
      <span class="required" aria-required="true"> * </span>
      {{ Form::textarea('content', null, ['class' => 'form-control ckeditor', 'placeholder' => 'Content....']) }}
      @if($errors->first('content'))
        <div class="ui pointing red basic label"> {{$errors->first('content')}}</div>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group pull-right">
      <a href="{{ route($route. '.index') }}" type="button" class="btn btn-info"><i class="fa fa-backward"
                                                                                             aria-hidden="true"></i>
        Back</a>
      <button class="btn btn-primary green" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;{{ $formAction }}
      </button>
    </div>
  </div>
</div>

@section('script')
  @parent
  <script type="text/javascript" src="{{ asset('admin/metronic/global/plugins/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('admin/js/script.js') }}"
          type="text/javascript"></script>
  <script type="text/javascript">
    $('document').ready(function() {
      displayAppropriateDiv();
    });
    $('.content-type').change(function() {
      $('.content-type').prop('checked', false);
      $(this).prop('checked', true);
      displayAppropriateDiv();
    });

    function displayAppropriateDiv() {
      if ($('#write').is(":checked")) {
        $('#content-div').show();
        $('#file-div').hide();
      } else if ($('#upload').is(":checked")) {
        $('#content-div').hide();
        $('#file-div').show();
      }
    }
  </script>
@endsection
