@extends('backend.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            {{-- Page Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-person-circle me-2" style="color:#6366f1;"></i>Account Profile</h4>
                    <p class="text-muted small mb-0">Manage your profile information and social links</p>
                </div>
                <a href="{{ url('/admin/account/edit') }}" class="btn btn-admin btn-admin-primary rounded-pill px-4">
                    <i class="bi bi-pencil-square me-1"></i> Edit Profile
                </a>
            </div>

            {{-- Profile Card --}}
            <div class="card-modern border-0 shadow-sm rounded-4 overflow-hidden">
                <div style="height:100px; background:linear-gradient(135deg,#1e293b,#334155,#475569);"></div>
                <div class="px-4 pb-4" style="margin-top:-50px;">
                    <div class="d-flex align-items-end gap-4 flex-wrap">
                        {{-- Profile Image --}}
                        <div style="flex-shrink:0;">
                            @if(isset($account) && $account->image)
                                <img src="{{ config('app.storage_url') }}{{ $account->image }}"
                                     alt="{{ $account->name ?? 'User' }}"
                                     style="width:100px; height:100px; border-radius:50%; object-fit:cover; border:4px solid #fff; box-shadow:0 4px 15px rgba(0,0,0,0.1);">
                            @else
                                <div style="width:100px; height:100px; border-radius:50%; background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff; display:flex; align-items:center; justify-content:center; font-size:2rem; font-weight:700; border:4px solid #fff; box-shadow:0 4px 15px rgba(0,0,0,0.1);">
                                    {{ isset($account->name) ? strtoupper(substr($account->name, 0, 1)) : 'U' }}
                                </div>
                            @endif
                        </div>

                        {{-- Name & Info --}}
                        <div style="flex:1; padding-top:1.5rem;">
                            <h4 class="fw-bold mb-1">{{ $account->name ?? 'Not set' }}</h4>
                            @if(isset($account) && $account->email)
                                <p class="text-muted small mb-2"><i class="bi bi-envelope me-1"></i>{{ $account->email }}</p>
                            @endif
                            <div class="d-flex flex-wrap gap-2">
                                @if(isset($account) && $account->phone)
                                    <span class="badge rounded-pill px-3 py-2" style="background:rgba(16,185,129,0.1); color:#059669; font-weight:500;">
                                        <i class="bi bi-whatsapp me-1"></i>{{ $account->phone }}
                                    </span>
                                @endif
                                @if(isset($account) && $account->cv)
                                    <a href="{{ config('app.storage_url') }}{{ $account->cv }}" target="_blank"
                                       class="badge rounded-pill px-3 py-2 text-decoration-none" style="background:rgba(239,68,68,0.1); color:#dc2626; font-weight:500;">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> View CV
                                    </a>
                                @else
                                    <span class="badge rounded-pill px-3 py-2" style="background:#f1f5f9; color:#64748b; font-weight:500;">
                                        <i class="bi bi-file-earmark me-1"></i> No CV
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Links --}}
            @if(isset($account) && ($account->github || $account->linkedin || $account->facebook || $account->twitter || $account->youtube))
            <div class="card-modern border-0 shadow-sm rounded-4 mt-4">
                <div class="card-header">
                    <i class="bi bi-share me-2"></i> Social Links
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-3">
                        @if($account->github)
                            <a href="{{ $account->github }}" target="_blank" class="btn btn-outline-dark rounded-pill px-4 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-github fs-5"></i> GitHub
                            </a>
                        @endif
                        @if($account->linkedin)
                            <a href="{{ $account->linkedin }}" target="_blank" class="btn btn-outline-primary rounded-pill px-4 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-linkedin fs-5"></i> LinkedIn
                            </a>
                        @endif
                        @if($account->facebook)
                            <a href="{{ $account->facebook }}" target="_blank" class="btn btn-outline-primary rounded-pill px-4 d-inline-flex align-items-center gap-2" style="color:#1877f2; border-color:#1877f2;">
                                <i class="bi bi-facebook fs-5"></i> Facebook
                            </a>
                        @endif
                        @if($account->twitter)
                            <a href="{{ $account->twitter }}" target="_blank" class="btn btn-outline-dark rounded-pill px-4 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-twitter-x fs-5"></i> Twitter
                            </a>
                        @endif
                        @if($account->youtube)
                            <a href="{{ $account->youtube }}" target="_blank" class="btn btn-outline-danger rounded-pill px-4 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-youtube fs-5"></i> YouTube
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
