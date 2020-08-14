@if ($breadcrumbs)
  <ul class="page-breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
      @if (!$breadcrumb->last)
        <li>
          <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
          <i class="fa fa-circle"></i>
        </li>
      @else
        <li><span>{{ $breadcrumb->title }}</span></li>
      @endif
    @endforeach
  </ul>
@endif
