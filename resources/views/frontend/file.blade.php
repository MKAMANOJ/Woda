@extends('layouts.frontend')

@section('content')
  <div class="panel panel-default notice-panel">
    <div class="panel-heading text-center">
      @if($fileSlug == 'notice-information')
        <h2>@lang('data.old-notice')</h2>
      @else
        <h2>@lang('data.'.$fileSlug)</h2>
      @endif
      <i class="fa fa-list"></i>
    </div>
    <div class="panel-body custom-panel-body">
      <table class="table table-bordered table-striped custom-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Published at</th>
          </tr>
        </thead>
        <tbody>
          @forelse($files as $file)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                @if(isset($file->file_name) && empty($file->content))
                  <a href="../storage/{{ $file->file_name }}">{{ $file->title }}</a>
                @else
                  <a href="{{ route('frontend.file_detail', [$fileSlug, $file->id]) }}">{{ $file->title }}</a>
                @endif
              </td>
              <td>{{ ($file->created_at)->format('Y-m-d') }}</td>
            </tr>
          @empty
            <td colspan="3">No File Added</td>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
