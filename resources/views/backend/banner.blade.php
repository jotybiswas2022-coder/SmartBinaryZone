@extends('backend.app')

@section('title', 'Banner — Admin')

@section('content')

<div class="st-page">
    <div class="st-header">
        <div class="st-header-inner">
            <div class="st-header-left">
                <div class="st-header-icon">
                    <i class="bi bi-image"></i>
                </div>
                <div>
                    <h4 class="st-header-title">Hero Banner</h4>
                    <p class="st-header-sub">Upload and manage the home page hero banner image</p>
                </div>
            </div>
        </div>
    </div>

    <div class="st-card">
        <div class="st-card-head">
            <i class="bi bi-upload"></i>
            <span>Upload Banner Image</span>
        </div>
        <div class="st-card-bd">
            <form method="POST" action="{{ route('admin.banner.upload') }}" enctype="multipart/form-data">
                @csrf

                <div class="st-fg">
                    <label class="st-label">Banner Image</label>
                    <p class="st-hint" style="margin-bottom:10px">Recommended size: 1920 × 600px or similar wide aspect ratio. Max 5MB.</p>

                    <div class="bn-upload-area">
                        <input type="file" name="banner_image" id="bannerInput" accept="image/*" class="bn-file-input" onchange="previewBanner(event)" required>
                        <div class="bn-upload-placeholder" id="uploadPlaceholder">
                            <div class="bn-upload-icon">
                                <i class="bi bi-cloud-arrow-up"></i>
                            </div>
                            <div class="bn-upload-text">Click to choose a banner image</div>
                            <div class="bn-upload-sub">PNG, JPG, WebP — any size</div>
                        </div>
                        <img id="bannerPreview" src="" alt="Banner preview" class="bn-preview-img" style="display:none">
                    </div>
                    @error('banner_image')
                        <span class="st-err">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="st-btn">
                    <i class="bi bi-check-lg"></i> Upload Banner
                </button>
            </form>
        </div>
    </div>

    @if($bannerPath)
    <div class="st-card">
        <div class="st-card-head">
            <i class="bi bi-eye"></i>
            <span>Current Banner</span>
        </div>
        <div class="st-card-bd">
            <div class="bn-current-wrap">
                <img src="{{ config('app.storage_url') }}{{ $bannerPath }}" alt="Current hero banner" class="bn-current-img">
            </div>
            <div style="margin-top:16px;display:flex;gap:10px;align-items:center">
                <span style="font-size:13px;color:#94a3b8">
                    <i class="bi bi-check-circle" style="color:#22c55e"></i> 
                    Banner is live on the home page
                </span>
                <form method="POST" action="{{ route('admin.banner.remove') }}" style="margin-left:auto" onsubmit="return confirm('Remove the current banner? The home page will show the default hero design instead.')">
                    @csrf
                    <button type="submit" class="st-btn-remove">
                        <i class="bi bi-trash3"></i> Remove Banner
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
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
.st-hint {
    display: block; font-size: 11px; color: #64748b; margin-top: 4px;
}
.st-err {
    display: block; font-size: 12px; color: #ef4444; margin-top: 4px;
}

/* ── Upload Area ── */
.bn-upload-area {
    position: relative;
    border: 2px dashed rgba(96,165,250,0.3);
    border-radius: 12px;
    background: rgba(10,10,10,0.4);
    min-height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    cursor: pointer;
    transition: border-color .2s, background .2s;
}
.bn-upload-area:hover {
    border-color: rgba(96,165,250,0.6);
    background: rgba(10,10,10,0.6);
}
.bn-file-input {
    position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
}
.bn-upload-placeholder {
    display: flex; flex-direction: column; align-items: center; gap: 10px; pointer-events: none;
}
.bn-upload-icon {
    width: 56px; height: 56px;
    border-radius: 50%;
    background: rgba(96,165,250,0.1);
    border: 1.5px solid rgba(96,165,250,0.3);
    display: flex; align-items: center; justify-content: center;
    color: #60A5FA; font-size: 24px;
}
.bn-upload-text {
    font-size: 14px; font-weight: 600; color: #60A5FA;
}
.bn-upload-sub {
    font-size: 11px; color: #64748b;
}
.bn-preview-img {
    width: 100%; height: 100%; object-fit: contain;
    max-height: 300px; border-radius: 10px;
}

/* ── Current Banner ── */
.bn-current-wrap {
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.08);
    background: rgba(10,10,10,0.4);
}
.bn-current-img {
    width: 100%; max-height: 300px; object-fit: cover; display: block;
}

/* ── Buttons ── */
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
.st-btn-remove {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 8px 20px; font-size: 13px; font-weight: 600;
    background: rgba(239,68,68,0.12);
    color: #ef4444; border: 1px solid rgba(239,68,68,0.2); border-radius: 8px;
    cursor: pointer; transition: all 0.2s; font-family: inherit;
}
.st-btn-remove:hover {
    background: rgba(239,68,68,0.2);
    border-color: rgba(239,68,68,0.4);
}

@media (max-width: 480px) {
    .st-page { padding: 16px; }
    .st-card-bd { padding: 16px; }
}
</style>

<script>
function previewBanner(event) {
    var file = event.target.files[0];
    if (!file) return;
    var reader = new FileReader();
    reader.onload = function(e) {
        var preview = document.getElementById('bannerPreview');
        var placeholder = document.getElementById('uploadPlaceholder');
        preview.src = e.target.result;
        preview.style.display = 'block';
        placeholder.style.display = 'none';
    };
    reader.readAsDataURL(file);
}
</script>

@if(session('success'))
<input type="hidden" id="sessionSuccess" value="{{ session('success') }}">
<script>
document.addEventListener('DOMContentLoaded', function() {
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
@endif

@endsection
