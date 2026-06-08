@php
use Illuminate\Support\Str;
@endphp

<nav class="navbar navbar-expand-lg navbar-top py-0" style="height:auto; min-height:57px;">
    <div class="container-fluid px-3">
        {{-- Mobile Sidebar Toggle --}}
        <button class="btn d-md-none p-1 me-2 sidebar-toggle-btn" type="button" aria-label="Toggle sidebar">
            <i class="bi bi-list fs-4"></i>
        </button>

        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center fw-bold fs-5 py-0" href="/admin" style="color:#1e293b;">
            <i class="bi bi-speedometer2 me-2 fs-3" style="background:linear-gradient(135deg,#6366f1,#8b5cf6); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;"></i>
            <span class="d-none d-sm-inline">{{ config('app.name', 'Admin') }}</span>
            <span class="d-sm-none">Admin</span>
        </a>

        {{-- Toggler --}}
        <button class="navbar-toggler border-0 py-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTopNav"
                style="color:#64748b;">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Top Nav Links --}}
        <div class="collapse navbar-collapse" id="navbarTopNav">
            <ul class="navbar-nav ms-auto gap-1 align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active-link' : '' }}" href="/" style="font-size:0.85rem;">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Str::startsWith(request()->path(), 'admin') ? 'active-link' : '' }}" href="/admin" style="font-size:0.85rem;">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-danger fw-semibold" style="font-size:0.85rem; text-decoration:none;">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
