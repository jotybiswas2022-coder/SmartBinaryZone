@extends('backend.app')

@section('content')

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-chat-quote me-2" style="color:#6366f1;"></i>Testimonials</h4>
            <p class="text-muted small mb-0">Manage client reviews and testimonials</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill px-3 py-2" style="background:rgba(99,102,241,0.1); color:#6366f1; font-weight:500;">
                <i class="bi bi-database me-1"></i> {{ $testimonials->count() }} Total
            </span>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary rounded-3 px-3" style="background:#6366f1; border-color:#6366f1;">
                <i class="bi bi-plus-lg me-1"></i> Add New
            </a>
        </div>
    </div>

    {{-- Table Card --}}
    @if($testimonials->isEmpty())
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-chat-quote"></i>
                <div class="fw-semibold mb-2">No Testimonials Found</div>
                <p class="text-muted small">Start by adding your first client testimonial!</p>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary rounded-3 px-4" style="background:#6366f1; border-color:#6366f1;">
                    <i class="bi bi-plus-lg me-1"></i> Add Testimonial
                </a>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width:800px;">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-semibold" style="width:45px;">#</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:55px;">Avatar</th>
                            <th class="py-3 text-muted small fw-semibold">Name</th>
                            <th class="py-3 text-muted small fw-semibold">Designation</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:110px;">Rating</th>
                            <th class="py-3 text-muted small fw-semibold">Message</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:60px;">Order</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:90px;">Status</th>
                            <th class="pe-4 py-3 text-muted small fw-semibold" style="width:100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                            <tr>
                                <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    @if($testimonial->avatar)
                                        <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                                             alt="{{ $testimonial->name }}"
                                             class="rounded-circle shadow-sm"
                                             style="width:40px; height:40px; object-fit:cover; border:2px solid rgba(99,102,241,0.15);">
                                    @else
                                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center fw-bold"
                                             style="width:40px; height:40px; background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff; font-size:0.95rem;">
                                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $testimonial->name }}</td>
                                <td><span class="text-muted small">{{ $testimonial->designation_display ?: '—' }}</span></td>
                                <td>
                                    <div style="color:#f59e0b; white-space:nowrap; font-size:0.85rem;">
                                        @foreach($testimonial->stars as $filled)
                                            <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-sm rounded-3 px-3 view-msg-btn"
                                            style="background:rgba(99,102,241,0.08); color:#6366f1; border:none; font-weight:500; font-size:0.78rem;"
                                            data-bs-toggle="modal" data-bs-target="#messageModal{{ $testimonial->id }}">
                                        <i class="bi bi-eye me-1"></i> View
                                    </button>

                                    <div class="modal fade modal-modern" id="messageModal{{ $testimonial->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header" style="background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff; border-radius:12px 12px 0 0;">
                                                    <h5 class="modal-title fw-semibold"><i class="bi bi-chat-quote me-2"></i>{{ $testimonial->name }}'s Review</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body px-4 py-3">
                                                    <div class="mb-3 d-flex align-items-center gap-2">
                                                        @if($testimonial->avatar)
                                                            <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                                                                 class="rounded-circle shadow-sm" style="width:48px; height:48px; object-fit:cover;">
                                                        @endif
                                                        <div>
                                                            <div class="fw-bold">{{ $testimonial->name }}</div>
                                                            <div style="color:#f59e0b; font-size:0.85rem;">
                                                                @foreach($testimonial->stars as $filled)
                                                                    <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0" style="font-style:italic; line-height:1.7; color:#334155;">
                                                        "{{ $testimonial->message }}"
                                                    </p>
                                                </div>
                                                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                                                    <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $testimonial->sort_order }}</span></td>
                                <td>
                                    <a href="{{ route('admin.testimonials.toggleStatus', $testimonial->id) }}"
                                       class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $testimonial->is_active ? 'active-badge' : 'inactive-badge' }}"
                                       data-title="{{ $testimonial->name }}">
                                        {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                           class="btn btn-sm btn-outline-primary rounded-3 px-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                                                data-id="{{ $testimonial->id }}"
                                                data-title="{{ $testimonial->name }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $testimonial->id }}"
                                              action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
                                              method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

<style>
.status-badge { transition: all 0.2s; }
.status-badge:hover { transform: scale(1.05); }
.active-badge { background: rgba(16,185,129,0.12); color: #059669; }
.inactive-badge { background: #f1f5f9; color: #94a3b8; }
</style>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const title = this.dataset.title;
            Swal.fire({
                title: 'Delete Testimonial?',
                text: 'Are you sure you want to delete the testimonial from "' + title + '"?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="bi bi-trash me-1"></i> Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        });
    });

    document.querySelectorAll('.status-badge').forEach(badge => {
        badge.addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            const title = this.dataset.title;
            const current = this.textContent.trim();
            Swal.fire({
                title: 'Toggle Status?',
                text: 'Change "' + title + '" from ' + current + ' to ' + (current === 'Active' ? 'Inactive' : 'Active') + '?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#6366f1',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="bi bi-arrow-repeat me-1"></i> Toggle',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
});
</script>
@endsection

@endsection
