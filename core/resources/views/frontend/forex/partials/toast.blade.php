<div id="toastContainer" style="position: fixed; top: 80px; right: 16px; z-index: 9999; display: flex; flex-direction: column; gap: 12px; pointer-events: none;"></div>

<script>
// Toast system
function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    if (!container) return;

    const colors = {
        success: { bg: 'rgba(0,255,159,0.1)', border: 'rgba(0,255,159,0.25)', icon: '#00FF9F', glow: 'rgba(0,255,159,0.15)' },
        error: { bg: 'rgba(239,68,68,0.1)', border: 'rgba(239,68,68,0.25)', icon: '#EF4444', glow: 'rgba(239,68,68,0.15)' },
        info: { bg: 'rgba(0,174,239,0.1)', border: 'rgba(0,174,239,0.25)', icon: '#00AEEF', glow: 'rgba(0,174,239,0.15)' }
    };
    const c = colors[type] || colors.success;

    const toast = document.createElement('div');
    toast.style.cssText = `
        pointer-events: auto;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        background: ${c.bg};
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid ${c.border};
        border-radius: 12px;
        color: #fff;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0 8px 32px ${c.glow}, 0 2px 8px rgba(0,0,0,0.2);
        min-width: 280px;
        max-width: 400px;
        position: relative;
        overflow: hidden;
    `;

    const icons = {
        success: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="' + c.icon + '" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
        error: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="' + c.icon + '" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
        info: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="' + c.icon + '" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>'
    };

    toast.innerHTML = icons[type] || icons.success;
    toast.innerHTML += '<span style="flex:1">' + message + '</span>';

    container.appendChild(toast);

    // Auto dismiss
    setTimeout(function() {
        toast.remove();
    }, 3800);
}

// Make showToast globally available
window.showToast = showToast;
</script>
