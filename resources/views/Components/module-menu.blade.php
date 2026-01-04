{{-- <nav>
    <ul>
        @foreach($items as $module)
            <li>
                <a
                    href="{{ route($module['route']) }}"
                    class="{{ request()->routeIs($module['route'].'*') ? 'active' : '' }}"
                >
                    {{ $module['icon'] ?? '' }} {{ $module['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav> --}}

<div class="container-fluid navbar navbar-expand navbar-dark bg-dark flex-md-nowrap">
    <span class="navbar-brand me-0 px-3" style="width: 300px;">
        <a href="{{ route('home') }}">
            <i class="bi bi-lg me-2 bi-box-arrow-left"></i>
        </a>
        <a class="text-light" href="{{ route('home') }}">
            {{ auth()->user()->name ?? '' }}
        </a>
    </span>

    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 px-2">
        @foreach($items as $module)
            <li class="nav-item">
                <a
                    class="nav-link {{ request()->routeIs($module['route'].'*') ? 'active' : '' }}"
                    href="{{ route($module['route']) }}"
                >
                    {!! $module['icon'] ?? '' !!} {{ $module['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
