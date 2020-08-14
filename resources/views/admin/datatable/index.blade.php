@if (isset($showPage))
  <a
      href="{{ route($actionParameters['name'].'.show', $actionParameters['id'])  }}"
      class="btn btn-sm blue btn-outline filter-submit margin-bottom {{ empty($showPage) ? 'disabled' : '' }}"
      style="width: 35px;" title="Preview"
  >
    <i class="fa fa-eye"></i>
  </a>
@endif
@if(!isset($onlyDelete) || !$onlyDelete)
  <a
      href="{{ route($actionParameters['name'].'.edit', $actionParameters['id'])  }}"
      class="btn btn-sm blue btn-outline filter-submit margin-bottom"
      style="width: 35px;" title="Edit"
  >
    <i class="fa fa-edit"></i>
  </a>
@endif
@if(!isset($exceptDelete))
  {!! Form::open(['route' => [$actionParameters['name'].'.destroy', $actionParameters['id']], 'method' => 'DELETE', 'class' => 'form-edit-button']) !!}
  <button
      class="btn btn-sm red btn-outline filter-submit margin-bottom mt-sweetalert"
      style="width: 35px; margin-left: 1px;" title="Delete"
  >
    <i class="fa fa-trash-o"></i>
  </button>
  {!! Form::close() !!}
@endif
@if(isset($otherButtons))
  {!! $otherButtons !!}
@endif
