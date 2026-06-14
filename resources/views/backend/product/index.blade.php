@extends('backend.app')

@section('title', 'Products — Admin')

@section('content')

@if (session('success'))
    <input type="hidden" id="sessionSuccess" value="{{ session('success') }}">
@endif

<div class="prod-page">

    {{-- Header --}}
    <div class="prod-header">
        <div class="prod-header-inner">
            <div>
                <h4 class="prod-header-title">Products</h4>
                <p class="prod-header-sub">Manage your Expert Advisor products</p>
            </div>
            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
                <div class="prod-header-badge">
                    <i class="bi bi-box-seam me-1"></i>
                    {{ $products->total() }} Products
                </div>
                <a href="{{ route('admin.products.create') }}" class="prod-btn-add">
                    <i class="bi bi-plus-lg"></i>
                    Add Product
                </a>
            </div>
        </div>
    </div>

    {{-- Card with Table --}}
    <div class="prod-card-wrap">
        <div class="prod-card">
            <div class="prod-search-bar">
                <i class="bi bi-search prod-search-icon"></i>
                <input type="text" id="productSearch" class="prod-search-input" placeholder="Search products by name..." autocomplete="off">
                <button type="button" id="searchClearBtn" class="prod-search-clear" style="display:none">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="table-scroll-wrap" id="productTableWrap">
                <table class="prod-table">
                    <thead>
                        <tr>
                            <th style="width:60px;">Image</th>
                            <th class="text-start"><i class="bi bi-tag me-1"></i> Name</th>
                            <th><i class="bi bi-link me-1"></i> Slug</th>
                            <th><i class="bi bi-cpu me-1"></i> Indicator</th>
                            <th><i class="bi bi-currency-dollar me-1"></i> Price Range</th>
                            <th><i class="bi bi-toggle-on me-1"></i> Available</th>
                            <th style="width:110px;"><i class="bi bi-calendar me-1"></i> Created</th>
                            <th style="width:100px;"><i class="bi bi-gear me-1"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        @include('backend.product._table')
                    </tbody>
                </table>
            </div>
            <div id="productPagination">
                @if($products->hasPages())
                <div class="prod-pagination-wrap">
                    <div class="prod-pagination-info">
                        Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} products
                    </div>
                    <div class="prod-pagination-links">
                        {{ $products->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Search bar */
.prod-search-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    border-bottom: 1px solid var(--pborder);
    background: rgba(10,10,10,0.2);
}
.prod-search-icon {
    color: var(--psub);
    font-size: 14px;
    flex-shrink: 0;
}
.prod-search-input {
    flex: 1;
    padding: 8px 12px;
    font-size: 13px;
    background: rgba(10,10,10,0.5);
    border: 1px solid var(--pborder);
    border-radius: 8px;
    color: var(--ptext);
    outline: none;
    transition: all 0.2s;
    font-family: inherit;
}
.prod-search-input:focus {
    border-color: var(--pprimary);
    box-shadow: 0 0 0 2px rgba(96,165,250,0.1);
}
.prod-search-input::placeholder {
    color: var(--psub);
    opacity: 0.6;
}
.prod-search-clear {
    background: transparent;
    border: none;
    color: var(--psub);
    cursor: pointer;
    padding: 4px 6px;
    border-radius: 4px;
    transition: all 0.2s;
    font-size: 11px;
}
.prod-search-clear:hover {
    color: var(--ptext);
    background: rgba(255,255,255,0.05);
}
@keyframes pspin { to { transform: rotate(360deg); } }
:root {
    --pbg: #0f172a;
    --prd: rgba(255,255,255,0.04);
    --ptext: #f1f5f9;
    --pmuted: #94a3b8;
    --psub: #64748b;
    --pborder: rgba(255,255,255,0.08);
    --pprimary: #60A5FA;
    --pprimary-dim: rgba(96,165,250,0.12);
    --phover: rgba(255,255,255,0.06);
    --pthead-bg: rgba(255,255,255,0.05);
}
.prod-page { padding: 24px 28px; height: 100%; font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
.prod-header {
    background: var(--prd); border: 1px solid var(--pborder); border-radius: 14px;
    padding: 18px 22px; backdrop-filter: blur(8px); margin-bottom: 16px;
}
.prod-header-inner {
    display: flex; flex-wrap: wrap; justify-content: space-between;
    align-items: center; gap: 10px;
}
.prod-header-title { font-size: 18px; font-weight: 700; color: var(--ptext); margin: 0 0 2px 0; }
.prod-header-sub { font-size: 13px; color: var(--pmuted); margin: 0; }
.prod-header-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--pprimary-dim); color: var(--pprimary);
    padding: 8px 16px; border-radius: 24px; font-size: 13px;
    font-weight: 600; border: 1px solid rgba(96,165,250,0.2);
}
.prod-btn-add {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 18px; border-radius: 10px; font-size: 13px; font-weight: 600;
    background: linear-gradient(135deg, #2563EB, #1E40AF);
    color: #fff; border: none; text-decoration: none;
    transition: all 0.2s ease; cursor: pointer;
}
.prod-btn-add:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.3);
    color: #fff;
}
.prod-card-wrap {
    border-radius: 14px; border: 1px solid var(--pborder);
    background: var(--prd); overflow: hidden; backdrop-filter: blur(8px);
}
.table-scroll-wrap { overflow-x: auto; }
.prod-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.prod-table thead {
    background: var(--pthead-bg); position: sticky; top: 0; z-index: 5;
}
.prod-table th {
    padding: 14px 16px; text-align: center; font-weight: 600;
    font-size: 13px; color: var(--pmuted); text-transform: uppercase;
    letter-spacing: 0.4px; border-bottom: 1px solid var(--pborder);
}
.prod-table th i { color: var(--pprimary); }
.prod-table td {
    padding: 14px 16px; text-align: center; color: var(--ptext);
    border-bottom: 1px solid var(--pborder); vertical-align: middle;
}
.prod-table tbody tr { transition: background 0.18s ease; }
.prod-table tbody tr:hover { background: var(--phover); }
.prod-table tbody tr:last-child td { border-bottom: none; }
.prod-name { font-size: 14px; font-weight: 600; color: var(--ptext); }
.prod-tagline { font-size: 11px; color: var(--psub); margin-top: 2px; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.prod-slug-badge {
    font-family: 'JetBrains Mono', 'SF Mono', monospace;
    font-size: 11px; color: var(--pprimary);
    background: rgba(96,165,250,0.08);
    padding: 3px 8px; border-radius: 4px; display: inline-block;
}
.prod-indicator { color: var(--pmuted); font-size: 13px; }
.prod-price {
    font-family: 'JetBrains Mono', 'SF Mono', monospace;
    font-weight: 600; font-size: 13px; color: #10b981;
}
.prod-status-dot { width: 7px; height: 7px; border-radius: 50%; display: inline-block; margin-right: 4px; vertical-align: middle; }
.date-badge {
    display: inline-block; background: rgba(255,255,255,0.06);
    color: var(--pmuted); border: 1px solid var(--pborder);
    padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;
}
.prod-actions { display: flex; align-items: center; gap: 6px; justify-content: center; }
.prod-edit-btn {
    width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
    background: var(--pprimary-dim); border: 1px solid rgba(96,165,250,0.15);
    border-radius: 8px; color: var(--pprimary); text-decoration: none;
    transition: all 0.2s; font-size: 14px;
}
.prod-edit-btn:hover { background: rgba(96,165,250,0.2); color: #93c5fd; transform: translateY(-1px); }
.prod-delete-btn {
    width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
    background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2);
    border-radius: 8px; color: #ef4444; cursor: pointer;
    transition: all 0.2s; font-size: 14px; padding: 0;
}
.prod-delete-btn:hover { background: rgba(239,68,68,0.2); }

/* Pagination */
.prod-pagination-wrap {
    display: flex; flex-wrap: wrap; justify-content: space-between;
    align-items: center; gap: 12px;
    padding: 14px 20px; border-top: 1px solid var(--pborder);
}
.prod-pagination-info { font-size: 13px; color: var(--pmuted); }
.prod-pagination-links nav > ul {
    display: flex; gap: 4px; list-style: none; margin: 0; padding: 0;
}
.prod-pagination-links nav > ul li span, .prod-pagination-links nav > ul li a {
    display: flex; align-items: center; justify-content: center;
    padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;
    background: rgba(255,255,255,0.04); border: 1px solid var(--pborder);
    color: var(--pmuted); text-decoration: none; transition: all 0.2s;
}
.prod-pagination-links nav > ul li.active span {
    background: var(--pprimary-dim); border-color: rgba(96,165,250,0.3);
    color: var(--pprimary);
}
.prod-pagination-links nav > ul li a:hover {
    background: var(--phover); color: var(--ptext);
}
.prod-pagination-links nav > ul li.disabled span {
    opacity: 0.4; cursor: default;
}

.empty-row { text-align: center; padding: 60px 20px !important; }
.empty-state { display: flex; flex-direction: column; align-items: center; gap: 8px; }
.empty-icon { font-size: 40px; color: var(--psub); margin-bottom: 8px; display: block; }
.empty-title { font-weight: 600; font-size: 16px; color: var(--pmuted); }
.empty-sub { font-size: 13px; color: var(--psub); }

@media (max-width: 992px) {
    .prod-page { padding: 20px 22px; }
    .prod-table td, .prod-table th { padding: 12px 14px; font-size: 13px; }
}
@media (max-width: 768px) {
    .prod-page { padding: 16px; }
    .prod-table td, .prod-table th { padding: 10px 12px; font-size: 13px; }
    .prod-header { padding: 14px 16px; }
    .prod-header-title { font-size: 16px; }
    .prod-table th:nth-child(3), .prod-table td:nth-child(3) { display: none; }
    .prod-table th:nth-child(4), .prod-table td:nth-child(4) { display: none; }
    .prod-tagline { display: none; }
}
@media (max-width: 480px) {
    .prod-page { padding: 10px; }
    .prod-table td, .prod-table th { padding: 8px 6px; font-size: 11px; }
    .prod-header { padding: 12px 14px; border-radius: 12px; }
    .prod-header-inner { flex-direction: column; align-items: flex-start; gap: 8px; }
    .prod-header-title { font-size: 15px; }
    .prod-header-sub { font-size: 12px; }
    .prod-header-badge { font-size: 11px; padding: 5px 10px; }
    .prod-btn-add { font-size: 12px; padding: 6px 14px; }
    .prod-name { font-size: 12px; }
    .prod-tagline { display: none; }
    .prod-table th:nth-child(3), .prod-table td:nth-child(3) { display: none; }
    .prod-table th:nth-child(4), .prod-table td:nth-child(4) { display: none; }
    .prod-slug-badge { font-size: 10px; padding: 2px 6px; }
    .prod-price { font-size: 11px; }
    .prod-edit-btn, .prod-delete-btn { width: 28px; height: 28px; font-size: 12px; }
    .prod-pagination-wrap { flex-direction: column; align-items: center; gap: 8px; padding: 10px 14px; }
    .prod-pagination-info { font-size: 11px; }
    .date-badge { font-size: 10px; padding: 3px 8px; }
}
@media (max-width: 380px) {
    .prod-page { padding: 8px; }
    .prod-table th:nth-child(7), .prod-table td:nth-child(7) { display: none; }
    .prod-table td, .prod-table th { padding: 6px 4px; }
}
</style>

<script>
var searchTimer;

function fetchPage(url) {
    var tbody = document.getElementById('productTableBody');
    var pagination = document.getElementById('productPagination');
    var wrap = document.getElementById('productTableWrap');

    if (wrap && tbody) {
        tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;padding:32px;color:#64748b"><div style="width:20px;height:20px;border:2px solid rgba(96,165,250,0.2);border-top-color:#60A5FA;border-radius:50%;animation:pspin 0.7s linear infinite;margin:0 auto 8px"></div>Searching...</td></tr>';
    }

    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(function(r) { return r.text(); })
        .then(function(html) {
            var parts = html.split('{{--PAGINATION--}}');
            if (tbody) tbody.innerHTML = parts[0] || html;
            if (pagination && parts[1]) pagination.innerHTML = parts[1];
            else if (pagination) pagination.innerHTML = '';
            bindDeleteButtons();
            bindPaginationLinks();
        });
}

function liveSearch(query) {
    var searchInput = document.getElementById('productSearch');
    window.__currentSearch = query;
    fetchPage(window.location.pathname + '?search=' + encodeURIComponent(query));
}

function bindPaginationLinks() {
    document.querySelectorAll('#productPagination a').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var url = this.getAttribute('href');
            if (window.__currentSearch) {
                var sep = url.indexOf('?') === -1 ? '?' : '&';
                url += sep + 'search=' + encodeURIComponent(window.__currentSearch);
            }
            fetchPage(url);
        });
    });
}

function bindDeleteButtons() {
    document.querySelectorAll('.delete-btn-trigger').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            var form = this.closest('form');
            var name = form.getAttribute('data-name') || 'this item';

            Swal.fire({
                title: 'Delete "' + name + '"?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                background: '#1e293b',
                color: '#f1f5f9',
                iconColor: '#ef4444',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    popup: 'swal-back-popup',
                    cancelButton: 'swal-back-cancel'
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    var sessionSuccess = document.getElementById('sessionSuccess');
    if (sessionSuccess) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: sessionSuccess.value,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            background: '#1e293b',
            color: '#f1f5f9',
            iconColor: '#60A5FA',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    }

    bindDeleteButtons();
    bindPaginationLinks();

    var searchInput = document.getElementById('productSearch');
    var clearBtn = document.getElementById('searchClearBtn');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            var val = this.value.trim();
            if (clearBtn) clearBtn.style.display = val ? 'flex' : 'none';
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function() { liveSearch(val); }, 350);
        });
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                this.value = '';
                if (clearBtn) clearBtn.style.display = 'none';
                clearTimeout(searchTimer);
                searchTimer = setTimeout(function() { liveSearch(''); }, 50);
            }
        });
    }
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            if (searchInput) { searchInput.value = ''; }
            clearBtn.style.display = 'none';
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function() { liveSearch(''); }, 50);
            if (searchInput) searchInput.focus();
        });
    }
});
</script>

@endsection
