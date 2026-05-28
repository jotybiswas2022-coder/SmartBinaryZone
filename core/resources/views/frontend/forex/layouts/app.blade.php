<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#05050f">
    <meta name="color-scheme" content="dark">
    <script>window.routeCart = '{{ route('forex.cart') }}';</script>
    <title>@yield('title', 'SMART BINARY ZONE — Premium Expert Advisors')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/forex.js'])
    <style>
    /* ===== SMART BINARY ZONE — EXACT BRAND COLORS ===== */
    :root {
        /* ── BASE COLORS ── */
        --bg-primary:      #05050f;
        --bg-secondary:    #090914;

        /* ── NEON CYAN (primary accent) ── */
        --cyan-bright:     #00c8ff;
        --cyan-glow:       #0099ff;
        --cyan-dim:        #0066aa;

        /* ── NEON PINK / MAGENTA (secondary accent) ── */
        --pink-bright:     #ff2d78;
        --pink-glow:       #ff00aa;
        --pink-dim:        #aa0044;

        /* ── BLUE EDGE GLOW ── */
        --blue-edge:       #2255ff;

        /* ── PINK EDGE GLOW ── */
        --pink-edge:       #ff1177;

        /* ── TEXT COLORS ── */
        --text-white:      #ffffff;
        --text-gray:       #a0aec0;
        --text-dim:        #4a5568;

        /* ── SIGNATURE DUAL GRADIENT (cyan → pink) ── */
        --gradient-main: linear-gradient(90deg, #00c8ff 0%, #ff2d78 100%);
        --gradient-rev: linear-gradient(90deg, #ff2d78 0%, #00c8ff 100%);

        /* ── Legacy aliases for compatibility ── */
        --page-bg: #05050f;
        --text-primary: #ffffff;
        --text-secondary: #a0aec0;
        --text-label: #4a5568;
        --glass-bg: rgba(255, 255, 255, 0.04);
        --glass-border: rgba(0, 200, 255, 0.15);
        --glass-blur: 20px;
        --glass-radius: 16px;
        --card-shadow: 0 8px 32px rgba(0, 0, 0, 0.6);
        --brand-rainbow: linear-gradient(90deg, #00c8ff 0%, #ff2d78 100%);
        --brand-rainbow-2: linear-gradient(90deg, #00c8ff, #ff2d78, #00c8ff);
        --orb-center: #2255ff;
        --orb-mid: #00c8ff;
        --orb-pink: #ff2d78;
        --orb-pink-glow: #ff00aa;
        --gradient-edge: linear-gradient(90deg, #2255ff 0%, #ff1177 100%);
    }

    /* ===== SHARED STYLES ===== */
    .section-padding { padding-top: 6rem; padding-bottom: 6rem; }
    @media (min-width: 768px) { .section-padding { padding-top: 8rem; padding-bottom: 8rem; } }
    .badge {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.375rem 1rem;
        background: rgba(0,200,255,0.06); border: 1px solid rgba(0,200,255,0.15);
        border-radius: 9999px; font-size: 0.75rem; font-weight: 600;
        letter-spacing: 0.1em; text-transform: uppercase; color: var(--cyan-bright);
        margin-bottom: 1.5rem;
    }
    .badge-dot { width:6px; height:6px; border-radius:50%; background:var(--cyan-bright); animation:pulse-dot 2s ease-in-out infinite; }
    @keyframes pulse-dot { 0%,100%{opacity:1} 50%{opacity:0.4} }
    .section-title {
        font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; line-height: 1.1;
        letter-spacing: -0.02em;
        color: var(--text-primary); margin-bottom: 1rem;
    }
    .section-subtitle {
        font-size: 1rem;
        color: var(--text-secondary); max-width: 36rem; margin: 0 auto; line-height: 1.75;
    }
    .card {
        background: rgba(255, 255, 255, 0.04);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 200, 255, 0.15);
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.6);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative; overflow: hidden;
    }
    .card:hover {
        transform: translateY(-6px);
        border-color: rgba(0, 200, 255, 0.4);
        box-shadow: 0 0 25px rgba(0, 200, 255, 0.15), 0 0 50px rgba(255, 45, 120, 0.1);
    }
    .btn-primary {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 14px 36px;
        background: linear-gradient(90deg, #00c8ff, #ff2d78);
        color: #fff; font-weight: 700; font-size: 1rem;
        border-radius: 9999px; border: none; cursor: pointer;
        box-shadow: 0 0 20px rgba(0,200,255,0.4), 0 0 40px rgba(255,45,120,0.3);
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        box-shadow: 0 0 30px rgba(0,200,255,0.7), 0 0 60px rgba(255,45,120,0.5);
        transform: scale(1.04);
    }
    .btn-outline {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 14px 36px;
        border: 1px solid var(--cyan-bright);
        background: transparent;
        color: var(--cyan-bright); font-weight: 600; font-size: 1rem;
        border-radius: 9999px;
        box-shadow: 0 0 12px rgba(0,200,255,0.25);
        transition: all 0.3s ease;
    }
    .btn-outline:hover {
        background: rgba(0,200,255,0.1);
        box-shadow: 0 0 25px rgba(0,200,255,0.5);
    }
    .gradient-text {
        background: var(--gradient-main);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .reveal { opacity:0; transform:translateY(24px); transition:all 0.6s ease; }
    .reveal.visible { opacity:1; transform:translateY(0); }
    .grid-bg {
        background-image:linear-gradient(rgba(255,255,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.02) 1px,transparent 1px);
        background-size:64px 64px;
    }
    .hero-orb { position:absolute; border-radius:50%; filter:blur(100px); pointer-events:none; }
    .hero-orb-1 { width:500px;height:500px; background:rgba(0,200,255,0.08); top:-200px;right:-200px; }
    .hero-orb-2 { width:400px;height:400px; background:rgba(255,45,120,0.05); bottom:-150px;left:-150px; }
    .stat-divider { width:1px; height:3rem; background:linear-gradient(180deg,rgba(0,200,255,0.3),transparent); }
    @keyframes logo-scroll { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }
    .logo-scroll { animation:logo-scroll 25s linear infinite; }
    .logo-scroll-wrapper:hover .logo-scroll { animation-play-state:paused; }
    .check-item { display:flex; align-items:flex-start; gap:0.625rem; font-size:0.9rem; color:var(--text-gray); line-height:1.5; }
    .check-icon { flex-shrink:0; width:1.25rem;height:1.25rem; margin-top:0.125rem; color:var(--cyan-bright); }
    .star { color:#f59e0b; fill:currentColor; width:1rem; height:1rem; }
    .pricing-popular { border:1px solid var(--cyan-bright); background:linear-gradient(180deg,rgba(0,200,255,0.06),rgba(5,5,15,0.6)); position:relative; }
    .pricing-popular-badge { position:absolute; top:-0.75rem; left:50%; transform:translateX(-50%); background:var(--gradient-main); color:white; font-size:0.75rem; font-weight:700; padding:0.25rem 1rem; border-radius:9999px; white-space:nowrap; }
    .icon-box { width:2.75rem; height:2.75rem; border-radius:0.75rem; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .icon-box-brand { background:rgba(0,200,255,0.1); color:var(--cyan-bright); }
    .icon-box-profit { background:rgba(255,45,120,0.1); color:var(--pink-bright); }
    .accordion-btn { width:100%; display:flex; align-items:center; justify-content:space-between; padding:1rem 1.25rem; background:none; border:none; color:var(--text-white); font-size:0.95rem; font-weight:500; text-align:left; cursor:pointer; transition:color 0.2s ease; }
    .accordion-btn:hover { color:var(--cyan-bright); }
    .accordion-chevron { width:1.25rem; height:1.25rem; color:var(--cyan-bright); transition:transform 0.3s ease; flex-shrink:0; }
    .accordion-content { max-height:0; overflow:hidden; transition:max-height 0.3s ease; }
    .accordion-content-inner { padding:0 1.25rem 1.25rem; font-size:0.9rem; color:var(--text-gray); line-height:1.7; }
    .review-card { min-width:100%; padding:0 0.5rem; }
    .glass-card {
        background: rgba(255, 255, 255, 0.04);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 200, 255, 0.15);
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.6);
        transition: all 0.3s ease;
        position: relative; overflow: hidden;
    }
    .glass-card:hover {
        transform: translateY(-6px);
        border-color: rgba(0, 200, 255, 0.4);
        box-shadow: 0 0 25px rgba(0, 200, 255, 0.15), 0 0 50px rgba(255, 45, 120, 0.1);
    }
    .review-track { display:flex; transition:transform 0.4s ease; }
    .carousel-btn { width:2.5rem; height:2.5rem; border-radius:50%; background:rgba(5,5,15,0.8); border:1px solid rgba(0,200,255,0.15); color:var(--text-gray); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.3s ease; }
    .carousel-btn:hover { border-color:var(--cyan-bright); color:var(--cyan-bright); box-shadow:0 0 15px rgba(0,200,255,0.1); }
    @keyframes bar-grow { 0%{height:0% !important} 100%{height:var(--target-height)} }
    .perf-bar { animation:bar-grow 1.2s ease forwards; }
    .input-modern { background:rgba(5,5,15,0.8); border:1px solid rgba(0,200,255,0.15); transition:all 0.3s ease; color:var(--text-white); }
    .input-modern:focus { border-color:var(--cyan-bright); box-shadow:0 0 0 3px rgba(0,200,255,0.15); outline:none; }
    .underline-animate { position:relative; text-decoration:none; }
    .underline-animate::after { content:''; position:absolute; bottom:-2px; left:0; width:0; height:2px; background:var(--cyan-bright); transition:width 0.3s ease; }
    .underline-animate:hover::after { width:100%; }
    @media (max-width:640px) { .hero-title { font-size:clamp(2.2rem,10vw,3rem) !important; } }
    @media (prefers-reduced-motion:reduce) { *,::before,::after { animation-duration:0.01ms !important; transition-duration:0.01ms !important; } }
    .scroll-progress { position:fixed;top:0;left:0;z-index:9999;height:2px;background:var(--gradient-main);transition:width 0.1s ease; }
    @media (min-width:768px) { .md\\:block { display:block !important; } }
    </style>
</head>
<body style="background-color:#05050f;color:var(--text-gray);font-family:'Inter',sans-serif;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale">
    <!-- Scroll Progress Bar -->
    <div id="scrollProgress" class="scroll-progress"></div>

    <!-- Mouse Glow Effect -->
    <div id="mouseGlow" style="position:fixed;width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(0,200,255,0.06) 0%,rgba(255,45,120,0.03) 40%,transparent 70%);pointer-events:none;z-index:0;transform:translate(-50%,-50%);transition:opacity 0.3s ease;opacity:0" class="md\:block"></div>

    @include('frontend.forex.partials.navbar')
    @include('frontend.forex.partials.toast')
    <main>@yield('content')</main>
    @include('frontend.forex.partials.footer')
    @include('frontend.forex.partials.cookie-banner')

    <!-- Back to Top Button -->
    <button id="backToTop" style="position:fixed;bottom:2rem;right:2rem;z-index:50;width:3rem;height:3rem;border-radius:9999px;background:rgba(255,255,255,0.04);border:1px solid rgba(0,200,255,0.15);display:flex;align-items:center;justify-content:center;color:var(--text-gray);transition:all 0.3s ease;opacity:0;transform:translateY(1rem);pointer-events:none;cursor:pointer" aria-label="Back to top" onmouseover="this.style.color='white';this.style.borderColor='rgba(0,200,255,0.5)';this.style.boxShadow='0 0 20px rgba(0,200,255,0.2)'" onmouseout="this.style.color='var(--text-gray)';this.style.borderColor='rgba(0,200,255,0.15)';this.style.boxShadow='none'">
        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
    </button>

    <script>
    // ==================== CART SYSTEM (inline, works without Vite) ====================
    window.getCart = function() {
        try { return JSON.parse(localStorage.getItem('forex_cart') || '[]'); }
        catch(e) { return []; }
    };
    window.saveCart = function(cart) {
        localStorage.setItem('forex_cart', JSON.stringify(cart));
    };
    window.clearCart = function() {
        localStorage.removeItem('forex_cart');
    };
    window.updateCartButtons = function() {
        const cart = window.getCart();
        document.querySelectorAll('[data-cart-id]').forEach(function(btn) {
            const itemId = btn.getAttribute('data-cart-id');
            const isInCart = cart.some(function(item) {
                return String(item.id) === String(itemId);
            });
            if (isInCart) {
                btn.disabled = true;
            }
        });
    };
    window.addToCart = function(item) {
        item.price = parseFloat(item.price) || 0;
        const cart = window.getCart();
        const existing = cart.findIndex(function(i) { return i.id === item.id; });
        if (existing >= 0) {
            cart[existing].qty = (cart[existing].qty || 1) + 1;
        } else {
            cart.push({ ...item, qty: 1 });
        }
        window.saveCart(cart);
        window.updateCartBadge();
        window.updateCartButtons();
        setTimeout(function() {
            window.location.href = window.routeCart || '/cart';
        }, 600);
    };
    window.removeFromCart = function(index) {
        const cart = window.getCart();
        cart.splice(index, 1);
        window.saveCart(cart);
        window.updateCartBadge();
        window.updateCartButtons();
        if (typeof renderCart === 'function') renderCart();
    };
    window.updateCartBadge = function() {
        const badge = document.getElementById('cartBadge');
        if (!badge) return;
        const cart = window.getCart();
        const count = cart.reduce(function(s, i) { return s + (i.qty || 1); }, 0);
        if (count > 0) {
            badge.classList.remove('hidden');
            badge.textContent = count > 99 ? '99+' : count;
        } else {
            badge.classList.add('hidden');
        }
    };
    window.showToast = function(message, type) {
        if (type === undefined) type = 'info';
        const container = document.getElementById('toastContainer');
        if (!container) return;
        var colors = { success: '#00c8ff', error: '#ff2d78', info: '#00c8ff', warning: '#ff2d78' };
        const toast = document.createElement('div');
        toast.className = 'flex items-center gap-3 px-4 py-3 rounded-lg shadow-2xl text-sm font-medium translate-x-full opacity-0 transition-all duration-300';
        toast.style.backgroundColor = '#090914';
        toast.style.border = '1px solid rgba(0,200,255,0.2)';
        toast.style.borderLeft = '3px solid ' + (colors[type] || colors.info);
        toast.style.maxWidth = '380px';
        var iconSvg = '';
        if (type === 'success') {
            iconSvg = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>';
        } else if (type === 'error') {
            iconSvg = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>';
        } else {
            iconSvg = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>';
        }
        toast.innerHTML = '<span style="color:' + (colors[type] || colors.info) + '"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">' + iconSvg + '</svg></span><span style="color: #e5e5e5">' + message + '</span>';
        container.appendChild(toast);
        requestAnimationFrame(function() {
            toast.style.transform = 'translateX(0)';
            toast.style.opacity = '1';
        });
        setTimeout(function() {
            toast.style.transform = 'translateX(100%)';
            toast.style.opacity = '0';
            setTimeout(function() { toast.remove(); }, 300);
        }, 3000);
    };

    document.addEventListener('DOMContentLoaded', function(){
        'use strict';

        // --- Scroll Reveal Observer ---
        const revealObserver = new IntersectionObserver(function(e){
            e.forEach(function(entry){
                if(entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, {threshold: 0.1, rootMargin: '0px 0px -40px 0px'});
        document.querySelectorAll('.reveal').forEach(function(el){ revealObserver.observe(el); });

        // --- Scroll Progress Bar ---
        const scrollProgress = document.getElementById('scrollProgress');
        if (scrollProgress) {
            window.addEventListener('scroll', function() {
                const scrollTop = window.scrollY;
                const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
                scrollProgress.style.width = progress + '%';
            }, { passive: true });
        }

        // --- Mouse Glow Effect ---
        const mouseGlow = document.getElementById('mouseGlow');
        if (mouseGlow) {
            let mouseX = -400, mouseY = -400;
            let isVisible = true;

            document.addEventListener('mousemove', function(e) {
                mouseX = e.clientX;
                mouseY = e.clientY;
                mouseGlow.style.transform = 'translate(' + (mouseX - 300) + 'px, ' + (mouseY - 300) + 'px)';
                if (!isVisible) {
                    isVisible = true;
                    mouseGlow.style.opacity = '1';
                }
            }, { passive: true });

            document.addEventListener('mouseleave', function() {
                isVisible = false;
                mouseGlow.style.opacity = '0';
            });
        }

        // --- Back to Top ---
        const backToTop = document.getElementById('backToTop');
        if (backToTop) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 400) {
                    backToTop.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
                    backToTop.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
                } else {
                    backToTop.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
                    backToTop.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                }
            }, { passive: true });

            backToTop.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // --- Navbar Scroll Effect ---
        const navbar = document.getElementById('mainNavbar');
        if (navbar) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.style.borderColor = 'rgba(0,200,255,0.1)';
                    navbar.style.background = 'rgba(5,5,15,0.85)';
                    navbar.style.boxShadow = '0 1px 20px rgba(0,0,0,0.3)';
                } else {
                    navbar.style.borderColor = 'rgba(0,200,255,0.05)';
                    navbar.style.background = 'rgba(5,5,15,0.7)';
                }
            }, { passive: true });
        }

        // --- Mobile Drawer ---
        const menuBtn = document.getElementById('mobileMenuBtn');
        const drawer = document.getElementById('mobileDrawer');
        const overlay = document.getElementById('drawerOverlay');
        const hamburger = document.getElementById('hamburgerIcon');
        const closeIcon = document.getElementById('closeIcon');
        if (menuBtn && drawer) {
            function openDrawer() {
                drawer.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                if (hamburger) hamburger.classList.add('hidden');
                if (closeIcon) closeIcon.classList.remove('hidden');
            }
            function closeDrawer() {
                drawer.classList.add('hidden');
                document.body.style.overflow = '';
                if (hamburger) hamburger.classList.remove('hidden');
                if (closeIcon) closeIcon.classList.add('hidden');
            }
            menuBtn.addEventListener('click', openDrawer);
            if (overlay) overlay.addEventListener('click', closeDrawer);
            drawer.querySelectorAll('a').forEach(function(a) { a.addEventListener('click', closeDrawer); });
        }

        // --- Cookie Banner ---
        const cookieBanner = document.getElementById('cookieBanner');
        const cookieAccept = document.getElementById('cookieAccept');
        if (cookieBanner && !localStorage.getItem('cookie_consent')) {
            cookieBanner.classList.remove('hidden');
        }
        if (cookieAccept) {
            cookieAccept.addEventListener('click', function() {
                localStorage.setItem('cookie_consent', 'true');
                cookieBanner.classList.add('hidden');
            });
        }

        // --- Initialize Cart ---
        window.updateCartBadge();
        window.updateCartButtons();
    });
    </script>
    @stack('scripts')
</body>
</html>
