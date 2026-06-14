@extends('frontend.forex.layouts.app')

@section('title', 'Expert Advisors — SMART BINARY ZONE')

@section('content')
<style>
.scd-bg-grid{background-image:linear-gradient(rgba(255,255,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.02) 1px,transparent 1px);background-size:48px 48px}
</style>
<!-- ==================== HERO ==================== -->
<section style="position:relative;min-height:45vh;display:flex;align-items:center;padding-top:6rem;padding-bottom:3rem;overflow:hidden">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="scd-bg-grid" style="position:absolute;inset:0;opacity:0.03;pointer-events:none"></div>
    <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 40%,rgba(0,95,231,0.02) 100%);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem;text-align:center;width:100%">
        <div class="badge animate-fade-in-up" style="margin-bottom:1.5rem"><span class="badge-dot"></span> Premium Trading Tools</div>
        <h1 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2.5rem,6vw,4rem);font-weight:700;color:#EAEAEA;margin-bottom:1rem;animation:fadeInUp 0.6s ease 0.1s both;line-height:1.1">
            Expert <span class="gradient-text">Advisors</span>
        </h1>
        <p style="color:rgba(234,234,234,0.6);font-size:clamp(0.95rem,1.2vw,1.125rem);max-width:36rem;margin:0 auto 2rem;animation:fadeInUp 0.6s ease 0.2s both;line-height:1.6">
            Discover our collection of professional-grade Expert Advisors — built for performance, backed by data.
        </p>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem;animation:fadeInUp 0.6s ease 0.3s both">
            <div style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1.25rem;background:rgba(0,95,231,0.04);border:1px solid rgba(0,95,231,0.1);border-radius:9999px;font-size:0.8125rem;color:rgba(234,234,234,0.5);transition:all 0.3s">
                <svg style="width:1rem;height:1rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span><strong style="color:#EAEAEA;font-weight:600">{{ $products->total() }}</strong> Products Available</span>
            </div>
            <a href="#products-grid" style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.5rem 1.25rem;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:9999px;font-size:0.8125rem;color:rgba(234,234,234,0.5);transition:all 0.3s" 
               onmouseover="this.style.borderColor='rgba(34,85,255,0.2)';this.style.color='#EAEAEA'" 
               onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.color='rgba(234,234,234,0.5)'">
                Browse All
                <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ==================== PRODUCTS GRID ==================== -->
<section id="products-grid" style="padding-top:1rem;padding-bottom:6rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:0;left:0;transform:translate(-50%,-50%);opacity:0.04;width:500px;height:500px;border-radius:50%;background:rgba(34,85,255,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <style>
            .prod-grid{display:grid;grid-template-columns:1fr;gap:1.5rem}
            @media (min-width:640px){.prod-grid{grid-template-columns:repeat(2,1fr)}}
            @media (min-width:1024px){.prod-grid{grid-template-columns:repeat(3,1fr)}}
            /* === Home-style product card === */
            :root{--cyan:#005fe7;--purple:#ff2d78}
            .pcard{
              background:linear-gradient(170deg,rgba(255,255,255,0.04),rgba(255,255,255,0.01));
              border:1px solid rgba(255,255,255,0.08);
              border-radius:16px;
              overflow:hidden;
              transition:all .35s cubic-bezier(.16,1,.3,1);
              position:relative;
              backdrop-filter:blur(12px);
              height:100%;display:flex;flex-direction:column;
            }
            .pcard::before{
              content:'';position:absolute;inset:0;
              background:linear-gradient(180deg,transparent 50%,rgba(0,0,0,0.4) 100%);
              pointer-events:none;z-index:1;
            }
            .pcard::after{
              content:'';position:absolute;top:0;left:0;right:0;height:2px;
              background:linear-gradient(90deg,transparent,var(--cyan),var(--purple),transparent);
              opacity:0;transition:opacity .35s;
            }
            .pcard:hover::after{opacity:1}
            .pcard:hover{
              border-color:rgba(0,95,231,0.35);
              transform:translateY(-6px) scale(1.01);
              box-shadow:0 20px 60px rgba(0,95,231,0.12),0 0 0 1px rgba(0,95,231,0.08);
            }
            .pcard-img-wrap{
              height:240px;overflow:hidden;position:relative;flex-shrink:0;
              display:flex;align-items:center;justify-content:center;
              background:linear-gradient(135deg,#0a0f2e,#050d18);
            }
            .pcard-img-wrap::after{
              content:'';position:absolute;inset:0;
              background:linear-gradient(0deg,rgba(5,5,15,0.9) 0%,transparent 50%);
              pointer-events:none;z-index:1;
            }
            .pcard-img-wrap::before{
              content:'';position:absolute;inset:0;
              background:radial-gradient(circle at 30% 40%,rgba(0,95,231,0.08) 0%,transparent 60%),
                          radial-gradient(circle at 70% 60%,rgba(255,45,120,0.06) 0%,transparent 50%);
              pointer-events:none;z-index:1;
            }
            .pcard-img-wrap img{
              width:100%;height:100%;object-fit:cover;
              transition:transform .6s cubic-bezier(.16,1,.3,1);
            }
            .pcard:hover .pcard-img-wrap img{transform:scale(1.08)}
            .pcard-badge{
              position:absolute;top:14px;right:14px;z-index:3;
              background:linear-gradient(135deg,var(--cyan),var(--purple));
              color:#fff;font-size:11px;font-weight:800;
              padding:5px 14px;border-radius:50px;
              letter-spacing:0.5px;
              box-shadow:0 4px 15px rgba(0,95,231,0.3);
            }
            .pcard-indicator{
              position:absolute;top:14px;left:14px;z-index:3;
              display:inline-flex;align-items:center;gap:4px;
              padding:4px 12px;border-radius:9999px;
              font-size:11px;font-weight:600;letter-spacing:0.05em;text-transform:uppercase;
              backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);
              background:rgba(0,0,0,0.5);color:#fff;border:1px solid rgba(255,255,255,0.1);
            }
            .pcard-info{
              padding:20px 20px 22px;
              position:relative;z-index:2;
              background:linear-gradient(0deg,rgba(5,5,15,0.96),rgba(5,5,15,0.82));
              margin-top:-12px;
              border-radius:14px 14px 0 0;
              flex:1;display:flex;flex-direction:column;
            }
            .pcard-name{
              font-size:18px;font-weight:800;color:#fff;
              margin-bottom:4px;letter-spacing:-0.3px;
              display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;
            }
            .pcard-tagline{
              font-size:12px;color:#8892b0;margin-bottom:12px;
              display:flex;align-items:center;gap:6px;
              display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
            }
            .pcard-tagline::before{
              content:'';width:5px;height:5px;border-radius:50%;
              background:var(--cyan);flex-shrink:0;
            }
            .pcard-footer{
              display:flex;justify-content:space-between;align-items:center;
              padding-top:14px;margin-top:auto;
              border-top:1px solid rgba(255,255,255,0.06);
              margin-bottom:14px;
            }
            .pcard-from{font-size:11px;color:#8892b0}
            .pcard-price{
              font-size:24px;font-weight:900;
              background:linear-gradient(135deg,#22c55e,#10b981);
              -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
              letter-spacing:-0.5px;
            }
            .pcard-actions{display:flex;gap:10px;align-items:center}
            .pcard-btn{
              flex:1;
              background:linear-gradient(135deg,rgba(0,95,231,0.12),rgba(255,45,120,0.08));
              border:1px solid rgba(0,95,231,0.2);
              color:#fff;font-size:12px;font-weight:700;
              padding:11px 14px;border-radius:8px;
              cursor:pointer;transition:all .3s;
              text-decoration:none;text-align:center;letter-spacing:0.3px;
            }
            .pcard-btn:hover{
              background:linear-gradient(135deg,var(--cyan),var(--purple));
              border-color:transparent;color:#fff;
              box-shadow:0 4px 24px rgba(0,95,231,0.3);
              transform:translateY(-2px);
            }
            .pcard-cart{
              width:40px;height:40px;
              border:1px solid rgba(255,255,255,0.1);
              background:rgba(255,255,255,0.04);
              border-radius:8px;cursor:pointer;color:#fff;
              display:flex;align-items:center;justify-content:center;
              transition:all .3s;flex-shrink:0;text-decoration:none;
            }
            .pcard-cart:hover{
              border-color:var(--cyan);color:var(--cyan);
              background:rgba(0,95,231,0.1);
              box-shadow:0 0 24px rgba(0,95,231,0.2);
              transform:scale(1.08);
            }
            .pcard-meta{
              display:flex;align-items:center;gap:8px;flex-wrap:wrap;
              padding-top:12px;margin-top:auto;
              border-top:1px solid rgba(255,255,255,0.06);
            }
            .pcard-meta-item{
              display:inline-flex;align-items:center;gap:4px;
              font-size:12px;color:rgba(234,234,234,0.4);
              padding:3px 8px;border-radius:6px;
              background:rgba(255,255,255,0.02);
              border:1px solid rgba(255,255,255,0.04);
              transition:all 0.3s;
            }
            .pcard-meta-item:hover{background:rgba(0,95,231,0.04);border-color:rgba(0,95,231,0.1);color:rgba(234,234,234,0.6)}
            /* Pagination styling */
            .prod-pagination nav {display:flex;justify-content:center}
            .prod-pagination .pagination {display:flex;gap:0.375rem;list-style:none;padding:0;margin:0;flex-wrap:wrap;justify-content:center}
            .prod-pagination .page-item {margin:0}
            .prod-pagination .page-link {display:flex;align-items:center;justify-content:center;min-width:2.25rem;height:2.25rem;padding:0 0.625rem;border-radius:0.625rem;background:rgba(5,5,15,0.6);border:1px solid rgba(255,255,255,0.06);color:rgba(234,234,234,0.5);font-size:0.8125rem;font-weight:500;transition:all 0.3s;text-decoration:none}
            .prod-pagination .page-link:hover {border-color:rgba(34,85,255,0.2);color:#EAEAEA;background:rgba(0,95,231,0.06)}
            .prod-pagination .page-item.active .page-link {background:linear-gradient(135deg,#005fe7,#2255ff);border-color:#005fe7;color:white;box-shadow:0 4px 15px rgba(34,85,255,0.2)}
            .prod-pagination .page-item.disabled .page-link {opacity:0.3;cursor:default;pointer-events:none}
        </style>

        @if($products->count() > 0)
        <!-- Results count & sort bar -->
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;padding:0.75rem 1rem;background:rgba(5,5,15,0.2);border:1px solid rgba(255,255,255,0.04);border-radius:0.75rem">
            <span style="color:rgba(234,234,234,0.4);font-size:0.8125rem">
                Showing <strong style="color:rgba(234,234,234,0.6);font-weight:600">{{ $products->firstItem() }}-{{ $products->lastItem() }}</strong> of <strong style="color:rgba(234,234,234,0.6);font-weight:600">{{ $products->total() }}</strong> Expert Advisors
            </span>
            <div style="display:flex;align-items:center;gap:0.5rem">
                <span style="color:rgba(234,234,234,0.3);font-size:0.75rem">Sort by:</span>
                <span style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.375rem 0.75rem;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:0.5rem;font-size:0.75rem;color:rgba(234,234,234,0.5);cursor:pointer;transition:all 0.3s"
                      onmouseover="this.style.borderColor='rgba(34,85,255,0.2)';this.style.color='#EAEAEA'"
                      onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.color='rgba(234,234,234,0.5)'">
                    Latest
                    <svg style="width:0.75rem;height:0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </span>
            </div>
        </div>

        <div class="prod-grid">
            @foreach($products as $product)
            @php
                $plans = $product->plans ?? [];
                $minPrice = collect($plans)->min('price');
                $initialsColors = ['#005fe7','#ff2d78','#22c55e','#f59e0b','#a855f7','#3b82f6','#ec4899','#10b981'];
            @endphp
            <div style="text-decoration:none;color:inherit;display:block;transition-delay:{{ $loop->index * 0.06 }}s" class="reveal">
            <div class="pcard">
              <div class="pcard-img-wrap" style="background:linear-gradient(135deg,#0a0f2e,#050d18)">
                @if($product->image)
                <img src="{{ config('app.storage_url') }}{{ $product->image }}" alt="{{ $product->name }}">
                @else
                @php
                  $initials = collect(explode(' ', $product->name))->map(fn($w) => substr($w,0,1))->take(2)->implode('');
                  $bgColor = $initialsColors[$loop->index % count($initialsColors)];
                @endphp
                <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,{{ $bgColor }},rgba(255,255,255,0.1));display:flex;align-items:center;justify-content:center;font-size:28px;font-weight:900;color:#fff;opacity:0.9;border:2px solid rgba(255,255,255,0.1);box-shadow:0 8px 30px rgba(0,0,0,0.3)">{{ $initials }}</div>
                @endif
                @if($minPrice)
                <span class="pcard-badge">{{ formatPrice($minPrice, 0) }}</span>
                @endif
                @if($product->indicator)
                <span class="pcard-indicator">{{ $product->indicator }}</span>
                @endif
              </div>
              <div class="pcard-info">
                <div class="pcard-name">{{ $product->name }}</div>
                <div class="pcard-tagline">{{ $product->tagline ?? $product->description ?? 'Premium Product' }}</div>
                <div class="pcard-footer">
                  <span class="pcard-from">Starting from</span>
                  <span class="pcard-price">{{ formatPrice($minPrice ?? 0, 0) }}</span>
                </div>
                <div class="pcard-meta">
                  @if($product->pairs && count($product->pairs) > 0)
                  <span class="pcard-meta-item">
                    <svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    {{ $product->pairs[0] }}{{ isset($product->pairs[1]) ? ', ' . $product->pairs[1] : '' }}
                  </span>
                  @endif
                  @if($product->reviews)
                  <span class="pcard-meta-item">
                    <svg style="width:12px;height:12px;color:#f59e0b" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    {{ $product->reviews }}
                  </span>
                  @endif
                  @if($product->live_signal_years)
                  <span class="pcard-meta-item">
                    <svg style="width:12px;height:12px;color:#ff2d78" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    {{ $product->live_signal_years }}yr
                  </span>
                  @endif
                </div>
                <div class="pcard-actions" style="margin-top:14px">
                  <a href="{{ route('forex.product-detail', $product->slug) }}" class="pcard-btn">View Details</a>
                  <button class="pcard-cart" onclick="addToCart({id:'{{ $product->slug }}',name:'{{ str_replace("'", "\'", $product->name) }}',price:{{ $minPrice ?? 0 }}})" title="Add to cart">
                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM7.2 14.8l.03-.12.97-1.68H16c.75 0 1.41-.41 1.75-1.03l3.86-7L20 4h-1L19 3H4.21l-.94-2.55L2.18 0H0v2h1.73l3.48 7.35L3.96 12c-.14.27-.21.57-.21.89C3.75 14 4.75 15 6 15h14v-2H6.42c-.14 0-.25-.11-.25-.25z"/></svg>
                  </button>
                </div>
              </div>
            </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="prod-pagination" style="margin-top:3rem;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:0.75rem">
            {{ $products->links('pagination::bootstrap-5') }}
            <span style="color:rgba(234,234,234,0.2);font-size:0.75rem">Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</span>
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div style="text-align:center;padding:5rem 0;max-width:32rem;margin:0 auto">
            <div style="width:5.5rem;height:5.5rem;margin:0 auto 1.5rem;border-radius:1rem;background:rgba(0,95,231,0.04);border:1px solid rgba(0,95,231,0.08);display:flex;align-items:center;justify-content:center;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)">
                <svg style="width:2.5rem;height:2.5rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <h3 style="color:#EAEAEA;font-size:1.375rem;font-weight:600;margin:0 0 0.5rem 0;font-family:'Bebas Neue','Oswald',sans-serif">Coming Soon</h3>
            <p style="color:rgba(234,234,234,0.4);font-size:0.875rem;line-height:1.6;margin:0 0 1.5rem 0">Our Expert Advisors are being carefully prepared. Check back soon for premium trading solutions that deliver real results.</p>
            <a href="{{ route('forex.contact-us') }}" style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.625rem 1.25rem;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);color:rgba(234,234,234,0.6);font-weight:500;font-size:0.8125rem;border-radius:0.625rem;transition:all 0.3s;text-decoration:none"
                   onmouseover="this.style.borderColor='rgba(34,85,255,0.2)';this.style.color='#EAEAEA'"
                   onmouseout="this.style.borderColor='rgba(255,255,255,0.08)';this.style.color='rgba(234,234,234,0.6)'">
                    Contact Us
                </a>
        </div>
        @endif
    </div>
</section>
@endsection
