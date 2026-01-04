{{-- @if($breadcrumbs)
    <nav style="margin-bottom: 16px;">
        @foreach($breadcrumbs as $crumb)
            @if(!$loop->last)
                <a href="{{ route($crumb['route']) }}">
                    {{ $crumb['title'] }}
                </a>
                →
            @else
                <strong>{{ $crumb['title'] }}</strong>
            @endif
        @endforeach
    </nav>
@endif --}}

@php
    $breadcrumbs = \App\Services\ModuleBreadcrumbs::current();
@endphp

@if($breadcrumbs)
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        @foreach($breadcrumbs as $crumb)
            @if(!$loop->last)
                <li class="breadcrumb-item">
                    <a href="{{ route($crumb['route']) }}">{{ $crumb['title'] }}</a>
                </li>
            @else
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $crumb['title'] }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>
@endif

