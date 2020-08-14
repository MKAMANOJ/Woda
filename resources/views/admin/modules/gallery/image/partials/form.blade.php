<div class="row">
  <div class="{{ (isset($showCategory) && $showCategory) ? 'col-md-6' : 'col-md-12' }}">
    <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
      {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
      {!! Form::text('title', null, ['class' => 'form-control', 'placeholder'=>'Title']) !!}
      @if($errors->first('title'))
        <div class="ui pointing red basic label"> {{$errors->first('title')}}</div>
      @endif
    </div>
  </div>
  @if(isset($showCategory) && $showCategory)
    <div class="col-md-6">
      <div class="form-group {{ $errors->has('gallery_category_id') ? 'has-error' :'' }}">
        {!! Form::label('gallery_category_id', 'Category', ['class' => 'control-label']) !!}
        <span class="required" aria-required="true"> * </span>
        {!! Form::select('gallery_category_id', $categories , null , ['class' => 'form-control', 'placeholder' => 'Select Category']) !!}
        @if($errors->first('gallery_category_id'))
          <div class="ui pointing red basic label"> {{$errors->first('gallery_category_id')}}</div>
        @endif
      </div>
    </div>
  @endif
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group {{ $errors->has('description') ? 'has-error' :'' }}">
      {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
      {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder'=>'Description', 'rows' => 4]) !!}
      @if($errors->first('description'))
        <div class="ui pointing red basic label"> {{$errors->first('description')}}</div>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group {{ $errors->has('image') ? 'has-error' :'' }}">
      {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
      <span class="required" aria-required="true"> * </span>
      <div class="form-group col-md-12">
        <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-new thumbnail">
            <img src="{{ asset(getThumbnailPath(isset($image) ? 'storage/'.$image->name : '')) }}"
                 style="width: 190px; height: 140px;" alt=""/>
          </div>
          <div class="fileinput-preview fileinput-exists thumbnail"
               style="max-width: 200px; max-height: 150px;"></div>
          <div>
            <div class="clearfix margin-top-10">
              <span class="badge">Maximum file size is 2MB </span>
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
@endsection
