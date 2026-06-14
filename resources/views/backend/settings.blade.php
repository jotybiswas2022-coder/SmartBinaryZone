@extends('backend.app')

@section('title', 'Settings — Admin')

@section('content')

<div class="st-page">
    <div class="st-header">
        <div class="st-header-inner">
            <div class="st-header-left">
                <div class="st-header-icon">
                    <i class="bi bi-gear"></i>
                </div>
                <div>
                    <h4 class="st-header-title">Settings</h4>
                    <p class="st-header-sub">Manage application settings</p>
                </div>
            </div>
        </div>
    </div>

    <div class="st-card">
        <div class="st-card-head">
            <i class="bi bi-currency-exchange"></i>
            <span>Currency</span>
        </div>
        <div class="st-card-bd">
            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf

                <div class="st-fg">
                    <label class="st-label">Default Currency</label>
                    <select name="currency" class="st-select">
                        <option value="">— Select Currency —</option>
                        <option value="USD" {{ $currency === 'USD' ? 'selected' : '' }}>USD ($)</option>
                        <option value="BDT" {{ $currency === 'BDT' ? 'selected' : '' }}>BDT (৳)</option>
                    </select>
                    @error('currency')
                        <span class="st-err">{{ $message }}</span>
                    @enderror
                    <span class="st-hint">Choose the currency to display across all pages. Leave empty to show prices without a symbol.</span>
                </div>

                <div class="st-preview">
                    <span class="st-preview-label">Preview:</span>
                    <span class="st-preview-value">{{ formatPrice(1499.99) }}</span>
                </div>

                <button type="submit" class="st-btn">
                    <i class="bi bi-check-lg"></i> Save Settings
                </button>
            </form>
        </div>
    </div>
</div>

<style>
.st-page {
    padding: 24px 28px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: #f1f5f9;
}
.st-header {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    padding: 18px 22px;
    backdrop-filter: blur(8px);
    margin-bottom: 20px;
}
.st-header-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}
.st-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}
.st-header-icon {
    width: 44px; height: 44px;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, rgba(96,165,250,0.15), rgba(96,165,250,0.05));
    border: 1px solid rgba(96,165,250,0.12);
    border-radius: 12px;
    font-size: 20px; color: #60A5FA; flex-shrink: 0;
}
.st-header-title {
    font-size: 18px; font-weight: 700; margin: 0 0 2px 0;
}
.st-header-sub {
    font-size: 13px; color: #94a3b8; margin: 0;
}
.st-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    overflow: hidden;
    backdrop-filter: blur(8px);
    margin-bottom: 20px;
}
.st-card-head {
    display: flex; align-items: center; gap: 8px;
    padding: 14px 20px;
    background: linear-gradient(135deg, rgba(96,165,250,0.08), rgba(96,165,250,0.02));
    border-bottom: 1px solid rgba(255,255,255,0.08);
    font-size: 13px; font-weight: 600; color: #60A5FA;
    text-transform: uppercase; letter-spacing: 0.4px;
}
.st-card-head i { font-size: 15px; }
.st-card-bd { padding: 24px; }
.st-fg { margin-bottom: 20px; }
.st-label {
    display: block; font-size: 12px; font-weight: 600;
    color: #94a3b8; margin-bottom: 6px;
    text-transform: uppercase; letter-spacing: 0.3px;
}
.st-select {
    width: 100%; max-width: 320px;
    padding: 10px 14px; font-size: 14px;
    background: rgba(10,10,10,0.6); border: 1px solid rgba(255,255,255,0.08);
    border-radius: 8px; color: #f1f5f9;
    transition: all 0.2s; outline: none; font-family: inherit;
    cursor: pointer;
}
.st-select:focus {
    border-color: #60A5FA;
    box-shadow: 0 0 0 3px rgba(96,165,250,0.12);
}
.st-select option {
    background: #1e293b; color: #f1f5f9;
}
.st-err {
    display: block; font-size: 12px; color: #ef4444; margin-top: 4px;
}
.st-hint {
    display: block; font-size: 11px; color: #64748b; margin-top: 4px;
}
.st-preview {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 16px;
    background: rgba(10,10,10,0.4);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 8px;
    margin-bottom: 20px;
}
.st-preview-label {
    font-size: 12px; font-weight: 600;
    color: #94a3b8; text-transform: uppercase; letter-spacing: 0.3px;
}
.st-preview-value {
    font-size: 22px; font-weight: 700; color: #60A5FA;
}
.st-btn {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 28px; font-size: 14px; font-weight: 600;
    background: linear-gradient(135deg, #2563EB, #1E40AF);
    color: #fff; border: none; border-radius: 8px; cursor: pointer;
    transition: all 0.3s; font-family: inherit;
}
.st-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 16px rgba(37,99,235,0.3);
}
@media (max-width: 480px) {
    .st-page { padding: 16px; }
    .st-card-bd { padding: 16px; }
    .st-select { max-width: 100%; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var success = document.getElementById('sessionSuccess');
    if (success && success.value) {
        Swal.fire({
            icon: 'success', title: 'Success',
            text: success.value, timer: 2500, showConfirmButton: false,
            background: '#1e293b', color: '#f1f5f9', iconColor: '#10B981'
        });
    }
});
</script>

@if(session('success'))
<input type="hidden" id="sessionSuccess" value="{{ session('success') }}">
@endif

@endsection
