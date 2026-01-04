@extends('layouts.app') {{-- основной layout grid --}}

@section('aside_left')
    <nav class="nav flex-column">
        @foreach($actions as $action => $label)
            <a href="{{ route("contracts.$action") }}" 
               class="nav-link {{ request()->routeIs("contracts.$action*") ? 'active_link' : '' }}">
                {{ $label }}
            </a>
        @endforeach
    </nav>
@endsection


@section('content')
    {{-- Здесь будет контент конкретного action --}}
    @yield('module_content')
@endsection
