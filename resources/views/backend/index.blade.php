@extends('backend.app')

@section('content')

<div class="container-fluid py-3">

    {{-- Dashboard Header --}}
    <div class="mb-4">
        <div class="p-4 rounded-4 shadow" style="background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%); color: #fff;">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h3 class="fw-bold mb-1 d-flex align-items-center gap-2">
                        <i class="bi bi-speedometer2" style="color: #6366f1;"></i>
                        Dashboard
                    </h3>
                    <p class="mb-0 opacity-75 small">Welcome back, <strong>{{ auth()->user()->name }}</strong></p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(99,102,241,0.2); color: #a5b4fc; font-weight:500;">
                        <i class="bi bi-calendar3 me-1"></i> {{ now()->format('M d, Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label mb-1">Total Accounts</div>
                        <div class="stat-number">{{ $accountsCount }}</div>
                    </div>
                    <div class="stat-icon" style="background: rgba(99,102,241,0.1); color: #6366f1;">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
                <div class="mt-3" style="height:4px; background:#e2e8f0; border-radius:4px; overflow:hidden;">
                    <div style="width:100%; height:100%; background:linear-gradient(90deg,#6366f1,#818cf8); border-radius:4px;"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label mb-1">Total Messages</div>
                        <div class="stat-number">{{ $contactsCount }}</div>
                    </div>
                    <div class="stat-icon" style="background: rgba(16,185,129,0.1); color: #10b981;">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <div class="mt-3" style="height:4px; background:#e2e8f0; border-radius:4px; overflow:hidden;">
                    <div style="width:100%; height:100%; background:linear-gradient(90deg,#10b981,#34d399); border-radius:4px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Messages --}}
    <div class="row">
        <div class="col-12">
            <div class="card-modern">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-chat-dots me-2"></i> Recent Messages</span>
                    <a href="{{ url('/admin/contact') }}" class="btn btn-sm btn-admin btn-admin-outline rounded-pill px-3">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($contacts->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 mb-2 d-block"></i>
                            <div>No messages found</div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 table-modern">
                                <thead>
                                    <tr>
                                        <th style="width:50px;">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th style="width:120px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $index => $contact)
                                        <tr>
                                            <td class="fw-semibold text-muted">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:34px; height:34px; background:rgba(99,102,241,0.1); color:#6366f1; font-size:0.85rem; font-weight:600;">
                                                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                                                    </span>
                                                    <span class="fw-medium">{{ $contact->name }}</span>
                                                </div>
                                            </td>
                                            <td class="text-muted">{{ $contact->email }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}" style="font-size:0.8rem;">
                                                    <i class="bi bi-eye me-1"></i> View
                                                </button>

                                                <div class="modal fade modal-modern" id="messageModal{{ $contact->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $contact->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content border-0 shadow">
                                                            <div class="modal-header" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border-radius: 12px 12px 0 0;">
                                                                <h5 class="modal-title fw-semibold" id="messageModalLabel{{ $contact->id }}">
                                                                    <i class="bi bi-person-circle me-2"></i> {{ $contact->name }}
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body px-4 py-4">
                                                                <div class="mb-3 pb-3 border-bottom">
                                                                    <small class="text-muted d-block mb-1">Email</small>
                                                                    <span class="fw-medium">{{ $contact->email }}</span>
                                                                </div>
                                                                <div>
                                                                    <small class="text-muted d-block mb-1">Message</small>
                                                                    <p class="mb-0 lh-base">{{ $contact->message }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                                                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
