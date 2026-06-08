@extends('backend.app')

@section('content')

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-pencil-square me-2" style="color:#6366f1;"></i>Blog Posts</h4>
            <p class="text-muted small mb-0">Manage your blog articles</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill px-3 py-2" style="background:rgba(99,102,241,0.1); color:#6366f1; font-weight:500;">
                <i class="bi bi-database me-1"></i> {{ $posts->count() }} Posts
            </span>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary rounded-3 px-3" style="background:#6366f1; border-color:#6366f1;">
                <i class="bi bi-plus-lg me-1"></i> New Post
            </a>
        </div>
    </div>

    {{-- Table Card --}}
    @if($posts->isEmpty())
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-pencil"></i>
                <div class="fw-semibold mb-2">No Posts Found</div>
                <p class="text-muted small">Start writing your first blog post!</p>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary rounded-3 px-4" style="background:#6366f1; border-color:#6366f1;">
                    <i class="bi bi-plus-lg me-1"></i> Write Post
                </a>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width:800px;">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-semibold" style="width:50px;">#</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:65px;">Image</th>
                            <th class="py-3 text-muted small fw-semibold">Title</th>
                            <th class="py-3 text-muted small fw-semibold">Category</th>
                            <th class="py-3 text-muted small fw-semibold">Author</th>
                            <th class="py-3 text-muted small fw-semibold">Date</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:95px;">Status</th>
                            <th class="pe-4 py-3 text-muted small fw-semibold" style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    @if($post->featured_image)
                                        <img src="{{ config('app.storage_url') }}{{ $post->featured_image }}"
                                             alt="{{ $post->title }}"
                                             class="rounded" style="width:55px; height:38px; object-fit:cover;">
                                    @else
                                        <div class="rounded d-inline-flex align-items-center justify-content-center"
                                             style="width:55px; height:38px; background:#f1f5f9; color:#cbd5e1;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $post->title }}</div>
                                    <a href="{{ url('/blog/' . $post->slug) }}" target="_blank" class="small text-decoration-none" style="color:#6366f1;">
                                        <i class="bi bi-box-arrow-up-right"></i> View
                                    </a>
                                </td>
                                <td>
                                    @if($post->category)
                                        <span class="badge rounded-pill px-3 py-1" style="background:rgba(99,102,241,0.08); color:#6366f1; font-weight:500;">
                                            {{ $post->category }}
                                        </span>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td class="small text-muted">{{ $post->author->name ?? 'Unknown' }}</td>
                                <td class="small">
                                    <span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500; font-size:0.75rem;">
                                        <i class="bi bi-calendar3 me-1"></i>{{ $post->formatted_date }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog.toggleStatus', $post->id) }}"
                                       class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $post->is_published ? 'published-badge' : 'draft-badge' }}"
                                       data-title="{{ $post->title }}">
                                        {{ $post->is_published ? 'Published' : 'Draft' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.blog.edit', $post->id) }}"
                                           class="btn btn-sm btn-outline-primary rounded-3 px-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                                                data-id="{{ $post->id }}"
                                                data-title="{{ $post->title }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $post->id }}"
                                              action="{{ route('admin.blog.destroy', $post->id) }}"
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
.published-badge { background: rgba(16,185,129,0.12); color: #059669; }
.draft-badge { background: #f1f5f9; color: #94a3b8; }
</style>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const title = this.dataset.title;
            Swal.fire({
                title: 'Delete Post?',
                text: 'Are you sure you want to delete "' + title + '"? This cannot be undone.',
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
                text: 'Change "' + title + '" from ' + current + ' to ' + (current === 'Published' ? 'Draft' : 'Published') + '?',
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
