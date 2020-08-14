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
  <div class="col-md-6">
    <div class="form-group {{ $errors->has('important_contact_category_id') ? 'has-error' :'' }}">
      {!! Form::label('important_contact_category_id', 'Category', ['class' => 'control-label']) !!}
      <span class="required" aria-required="true"> * </span>
      {!! Form::select('important_contact_category_id', $categories , isset($categoryId) ? (int) $categoryId : null , ['class' => 'form-control', 'placeholder' => 'Select Category']) !!}
      @if($errors->first('important_contact_category_id'))
        <div class="ui pointing red basic label"> {{$errors->first('important_contact_category_id')}}</div>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group {{ $errors->has('address') ? 'has-error' :'' }}">
      {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
      {!! Form::text('address', null, ['class' => 'form-control', 'placeholder'=>'Address']) !!}
      @if($errors->first('address'))
        <div class="ui pointing red basic label"> {{$errors->first('address')}}</div>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group {{ $errors->has('phone') ? 'has-error' :'' }}">
      {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
      {!! Form::text('phone', null, ['class' => 'form-control phoneNumber', 'placeholder'=>'phone']) !!}
      @if($errors->first('phone'))
        <div class="ui pointing red basic label"> {{$errors->first('phone')}}</div>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group {{ $errors->has('fax') ? 'has-error' :'' }}">
      {!! Form::label('fax', 'FAX', ['class' => 'control-label']) !!}
      {!! Form::text('fax', null, ['class' => 'form-control phoneNumber', 'placeholder'=>'fax']) !!}
      @if($errors->first('fax'))
        <div class="ui pointing red basic label"> {{$errors->first('fax')}}</div>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group {{ $errors->has('designation') ? 'has-error' :'' }}">
      {!! Form::label('designation', 'Designation', ['class' => 'control-label']) !!}
      {!! Form::text('designation', null, ['class' => 'form-control', 'placeholder'=>'designation']) !!}
      @if($errors->first('designation'))
        <div class="ui pointing red basic label"> {{$errors->first('designation')}}</div>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
      {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
      {!! Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'email']) !!}
      @if($errors->first('email'))
        <div class="ui pointing red basic label"> {{$errors->first('email')}}</div>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group {{ $errors->has('mobile') ? 'has-error' :'' }}">
      {!! Form::label('mobile', 'Mobile', ['class' => 'control-label']) !!}
      {!! Form::text('mobile', null, ['class' => 'form-control phoneNumber', 'placeholder'=>'mobile']) !!}
      @if($errors->first('mobile'))
        <div class="ui pointing red basic label"> {{$errors->first('mobile')}}</div>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group {{ $errors->has('service') ? 'has-error' :'' }}">
      {!! Form::label('service', 'Services', ['class' => 'control-label']) !!}
      {!! Form::textarea('service', null, ['class' => 'form-control', 'placeholder'=>'Services...', 'rows' => 3]) !!}
      @if($errors->first('service'))
        <div class="ui pointing red basic label"> {{$errors->first('service')}}</div>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
    <div class="form-group {{ $errors->has('image') ? 'has-error' :'' }}">
      <div
          class="fileinput {{isset($contact) ? ((!$contact->image) ? 'fileinput-new':'fileinput-exists') :
                'fileinput-new'}}" data-provides="fileinput">
        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
          <img
              src="{{ getThumbnailImageForInsertUpdate() }}"
              alt="" style="width: 190px; height: 140px;"/>
        </div>
        <div class="fileinput-preview fileinput-exists thumbnail"
             style="max-width: 200px; max-height: 150px;">
          <img
              src="{{ isset($contact) ? asset('storage/'.$contact->image) : ''  }}"
              alt="" style="width: 190px; height: 140px;"/>
        </div>
        <div>
          <div class="clearfix margin-top-10">
            <span class="label label-info">Maximum file size is 2MB </span>
          </div>
          <h3></h3>
          <span class="btn default btn-file">
                  <span class="fileinput-new"> Select image </span>
                  <span class="fileinput-exists"> Change </span>
                    <input type="file" name="image" accept="image/*">
                  </span>
          <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
        </div>
        @if($errors->first('image'))
          <div class="ui pointing red basic label"> {{ $errors->first('image') }}</div>
        @endif
      </div>
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

@section('script')
  @parent
  <script src="{{ asset('admin/metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"
          type="text/javascript"></script>
  <script type="text/javascript">
    // For phone number validation
    $(document).on('keydown', '.phoneNumber', function(event) {
      if (event.shiftKey === true && event.keyCode === 187) {
      } else if (event.shiftKey === false && event.keyCode === 189) {
      } else if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) ||
        event.keyCode === 8 || event.keyCode === 9 || event.keyCode === 107 || event.keyCode === 187 || event.keyCode === 109) {
      } else {
        event.preventDefault();
      }
      if ($(this).val().indexOf('+') !== -1 && (event.keyCode === 107 || event.keyCode === 187))
        event.preventDefault();
    });
  </script>
@endsection
