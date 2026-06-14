@extends('backend.app')

@section('title', 'Total Sell — Admin')

@section('content')

<div class="ts-page">

    {{-- Header --}}
    <div class="ts-header">
        <div class="ts-header-inner">
            <div>
                <h4 class="ts-header-title">Total Sell</h4>
                <p class="ts-header-sub">{{ $totalItems }} item(s) sold in selected period</p>
            </div>
        </div>
    </div>

    {{-- Date Filter --}}
    <div class="ts-filter">
        <form method="GET" action="{{ route('admin.total-sell') }}" class="ts-filter-form">
            <div class="ts-filter-group">
                <label class="ts-filter-label">From</label>
                <input type="date" name="from" class="ts-filter-input" value="{{ $from }}">
            </div>
            <div class="ts-filter-group">
                <label class="ts-filter-label">To</label>
                <input type="date" name="to" class="ts-filter-input" value="{{ $to }}">
            </div>
            <button type="submit" class="ts-filter-btn">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </form>
    </div>

    {{-- Summary Cards --}}
    <div class="ts-summary">
        <div class="ts-summary-card ts-summary-items">
            <div class="ts-summary-icon">
                <i class="bi bi-box-seam"></i>
            </div>
            <div>
                <span class="ts-summary-label">Total Items Sold</span>
                <span class="ts-summary-value">{{ $totalItems }}</span>
            </div>
        </div>
        <div class="ts-summary-card ts-summary-selling">
            <div class="ts-summary-icon">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div>
                <span class="ts-summary-label">Total Selling Price</span>
                <span class="ts-summary-value">${{ number_format($totalSelling, 2) }}</span>
            </div>
        </div>
        <div class="ts-summary-card ts-summary-avg">
            <div class="ts-summary-icon">
                <i class="bi bi-graph-up"></i>
            </div>
            <div>
                <span class="ts-summary-label">Avg Price / Item</span>
                <span class="ts-summary-value">${{ number_format($avgPrice, 2) }}</span>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="ts-card">
        @if(count($rows) > 0)
        <div class="ts-items-wrap">
            <div class="ts-items-header">
                <span class="ts-h-item">Item</span>
                <span class="ts-h-date">Date</span>
                <span class="ts-h-order">Order #</span>
                <span class="ts-h-type">Type</span>
                <span class="ts-h-qty">Qty</span>
                <span class="ts-h-price">Price</span>
                <span class="ts-h-total">Total</span>
            </div>
            <div class="ts-items-body">
                @foreach($rows as $row)
                    <div class="ts-item-row">
                        <div class="ts-item-info">
                            <div class="ts-item-name">{{ $row['item_name'] }}</div>
                        </div>
                        <div class="ts-item-date">{{ $row['date'] }}</div>
                        <div class="ts-item-order">#{{ $row['order_number'] }}</div>
                        <div>
                            @if($row['type'] === 'Product')
                                <span class="ts-badge ts-badge-product">Product</span>
                            @elseif($row['type'] === 'Source Code')
                                <span class="ts-badge ts-badge-source">Source Code</span>
                            @else
                                <span class="ts-badge ts-badge-na">N/A</span>
                            @endif
                        </div>
                        <div class="ts-item-qty">{{ $row['qty'] }}</div>
                        <div class="ts-item-price">${{ number_format($row['price'], 2) }}</div>
                        <div class="ts-item-total">${{ number_format($row['total'], 2) }}</div>
                    </div>
                @endforeach
            </div>
            <div class="ts-items-footer">
                <span class="ts-footer-label">Grand Total</span>
                <span class="ts-footer-value">${{ number_format($totalSelling, 2) }}</span>
            </div>
        </div>
        @else
            <div class="ts-empty">
                <i class="bi bi-inbox"></i>
                <p>No completed orders found in this date range.</p>
            </div>
        @endif
    </div>
</div>

<style>
/* ─── Page ─── */
.ts-page {
    padding: 24px 28px; height: 100%;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: #f1f5f9;
}

/* ─── Header ─── */
.ts-header {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    padding: 18px 22px;
    backdrop-filter: blur(8px);
    margin-bottom: 20px;
}
.ts-header-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}
.ts-header-title {
    font-size: 18px; font-weight: 700; margin: 0 0 2px 0;
}
.ts-header-sub {
    font-size: 13px; color: #94a3b8; margin: 0;
}

/* ─── Filter ─── */
.ts-filter {
    margin-bottom: 20px;
}
.ts-filter-form {
    display: flex;
    align-items: flex-end;
    gap: 12px;
    flex-wrap: wrap;
}
.ts-filter-group {
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.ts-filter-label {
    font-size: 11px;
    font-weight: 600;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}
.ts-filter-input {
    padding: 8px 12px;
    font-size: 13px;
    background: rgba(10,10,10,0.6);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 8px;
    color: #f1f5f9;
    outline: none;
    transition: all 0.2s;
    font-family: inherit;
}
.ts-filter-input:focus {
    border-color: #60A5FA;
    box-shadow: 0 0 0 3px rgba(96,165,250,0.12);
}
.ts-filter-input::-webkit-calendar-picker-indicator {
    filter: invert(0.7);
    cursor: pointer;
}
.ts-filter-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 20px;
    font-size: 13px;
    font-weight: 600;
    background: linear-gradient(135deg, #2563EB, #1E40AF);
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
    font-family: inherit;
    height: 37px;
}
.ts-filter-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.3);
}

/* ─── Summary Cards ─── */
.ts-summary {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 20px;
}
.ts-summary-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
}
.ts-summary-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}
.ts-summary-items .ts-summary-icon {
    background: rgba(251,191,36,0.12);
    color: #F59E0B;
    border: 1px solid rgba(251,191,36,0.15);
}
.ts-summary-selling .ts-summary-icon {
    background: rgba(96,165,250,0.12);
    color: #60A5FA;
    border: 1px solid rgba(96,165,250,0.15);
}
.ts-summary-avg .ts-summary-icon {
    background: rgba(16,185,129,0.12);
    color: #10B981;
    border: 1px solid rgba(16,185,129,0.15);
}
.ts-summary-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    margin-bottom: 2px;
}
.ts-summary-value {
    display: block;
    font-size: 20px;
    font-weight: 700;
}
.ts-summary-items .ts-summary-value { color: #F59E0B; }
.ts-summary-selling .ts-summary-value { color: #60A5FA; }
.ts-summary-avg .ts-summary-value { color: #10B981; }

/* ─── Items Card ─── */
.ts-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    overflow: hidden;
    backdrop-filter: blur(8px);
}
.ts-items-wrap {
    display: flex;
    flex-direction: column;
}
.ts-items-header {
    display: grid;
    grid-template-columns: 1fr 100px 80px 100px 50px 90px 100px;
    gap: 0;
    padding: 12px 16px;
    font-size: 11px;
    font-weight: 600;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    background: rgba(10,10,10,0.3);
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.ts-items-header > span {
    text-align: center;
}
.ts-h-item { text-align: left !important; }
.ts-items-body {
    display: flex;
    flex-direction: column;
}
.ts-item-row {
    display: grid;
    grid-template-columns: 1fr 100px 80px 100px 50px 90px 100px;
    gap: 0;
    padding: 14px 16px;
    font-size: 13px;
    align-items: center;
    border-bottom: 1px solid rgba(255,255,255,0.04);
    transition: background 0.2s;
}
.ts-item-row:hover {
    background: rgba(255,255,255,0.02);
}
.ts-item-row:last-child {
    border-bottom: none;
}
.ts-item-row > div {
    text-align: center;
}
.ts-item-info { text-align: left !important; }
.ts-item-name {
    font-weight: 600;
    color: #f1f5f9;
}
.ts-item-date {
    color: #94a3b8;
    font-size: 12px;
}
.ts-item-order {
    color: #60A5FA;
    font-weight: 600;
    font-size: 12px;
}
.ts-item-qty {
    font-weight: 700;
    color: #f1f5f9;
}
.ts-item-price {
    color: #94a3b8;
}
.ts-item-total {
    font-weight: 700;
    color: #10B981;
}
.ts-items-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 16px;
    padding: 14px 20px;
    border-top: 1px solid rgba(255,255,255,0.06);
    background: rgba(10,10,10,0.2);
}
.ts-footer-label {
    font-size: 13px;
    font-weight: 600;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}
.ts-footer-value {
    font-size: 20px;
    font-weight: 700;
    color: #60A5FA;
}

/* ─── Badges ─── */
.ts-badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
}
.ts-badge-product {
    background: rgba(16,185,129,0.1);
    color: #10B981;
    border: 1px solid rgba(16,185,129,0.15);
}
.ts-badge-source {
    background: rgba(96,165,250,0.1);
    color: #60A5FA;
    border: 1px solid rgba(96,165,250,0.15);
}
.ts-badge-na {
    background: rgba(148,163,184,0.08);
    color: #64748b;
    border: 1px solid rgba(148,163,184,0.12);
}

/* ─── Empty state ─── */
.ts-empty {
    text-align: center;
    padding: 48px 20px;
    color: #64748b;
}
.ts-empty i {
    font-size: 32px;
    margin-bottom: 12px;
    display: block;
    opacity: 0.4;
}
.ts-empty p {
    font-size: 14px;
    margin: 0;
}

/* ─── Responsive ─── */
@media (max-width: 992px) {
    .ts-items-header {
        grid-template-columns: 1fr 90px 70px 90px 45px 80px 90px;
    }
    .ts-item-row {
        grid-template-columns: 1fr 90px 70px 90px 45px 80px 90px;
    }
}
@media (max-width: 768px) {
    .ts-page { padding: 20px 22px; }
    .ts-summary { grid-template-columns: 1fr; }
    .ts-filter-form { flex-direction: column; align-items: stretch; }
    .ts-filter-btn { height: auto; justify-content: center; }
    .ts-items-header { display: none; }
    .ts-item-row {
        grid-template-columns: 1fr 1fr;
        gap: 4px 12px;
        padding: 12px 14px;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .ts-item-row > div { text-align: left; }
    .ts-item-info { grid-column: 1 / -1; margin-bottom: 4px; }
    .ts-item-date::before { content: "Date: "; color: #94a3b8; font-size: 11px; }
    .ts-item-order::before { content: "Order: "; color: #94a3b8; font-size: 11px; }
    .ts-item-qty::before { content: "Qty: "; color: #94a3b8; font-size: 11px; }
    .ts-item-price::before { content: "Price: "; color: #94a3b8; font-size: 11px; }
    .ts-item-total::before { content: "Total: "; color: #94a3b8; font-size: 11px; }
}
@media (max-width: 480px) {
    .ts-page { padding: 16px; }
    .ts-header { padding: 14px 16px; }
    .ts-summary-card { padding: 14px 16px; }
    .ts-summary-value { font-size: 17px; }
}
</style>

@endsection
