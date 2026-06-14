@extends('backend.app')

@section('title', 'Profit & Loss — Admin')

@section('content')

<div class="pl-page">

    {{-- Header --}}
    <div class="pl-header">
        <div class="pl-header-inner">
            <div>
                <h4 class="pl-header-title">Profit & Loss</h4>
                <p class="pl-header-sub">{{ count($rows) }} transactions in selected period</p>
            </div>
        </div>
    </div>

    {{-- Date Filter --}}
    <div class="pl-filter">
        <form method="GET" action="{{ route('admin.profit-loss') }}" class="pl-filter-form">
            <div class="pl-filter-group">
                <label class="pl-filter-label">From</label>
                <input type="date" name="from" class="pl-filter-input" value="{{ $from }}">
            </div>
            <div class="pl-filter-group">
                <label class="pl-filter-label">To</label>
                <input type="date" name="to" class="pl-filter-input" value="{{ $to }}">
            </div>
            <button type="submit" class="pl-filter-btn">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </form>
    </div>

    {{-- Summary Cards --}}
    <div class="pl-summary">
        <div class="pl-summary-card pl-summary-selling">
            <div class="pl-summary-icon">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div>
                <span class="pl-summary-label">Total Selling Price</span>
                <span class="pl-summary-value">${{ number_format($totalSelling, 2) }}</span>
            </div>
        </div>
        <div class="pl-summary-card pl-summary-base">
            <div class="pl-summary-icon">
                <i class="bi bi-cash-stack"></i>
            </div>
            <div>
                <span class="pl-summary-label">Total Base Price</span>
                <span class="pl-summary-value">${{ number_format($totalBase, 2) }}</span>
            </div>
        </div>
        <div class="pl-summary-card {{ $totalProfit >= 0 ? 'pl-summary-profit' : 'pl-summary-loss' }}">
            <div class="pl-summary-icon">
                <i class="bi {{ $totalProfit >= 0 ? 'bi-graph-up-arrow' : 'bi-graph-down-arrow' }}"></i>
            </div>
            <div>
                <span class="pl-summary-label">{{ $totalProfit >= 0 ? 'Total Profit' : 'Total Loss' }}</span>
                <span class="pl-summary-value">${{ number_format(abs($totalProfit), 2) }}</span>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="pl-card">
        @if(count($rows) > 0)
        <div class="table-scroll-wrap">
            <table class="pl-table">
                <thead>
                    <tr>
                        <th><i class="bi bi-calendar-event me-1"></i> Date</th>
                        <th><i class="bi bi-hash me-1"></i> Order #</th>
                        <th class="text-start"><i class="bi bi-box me-1"></i> Item</th>
                        <th><i class="bi bi-tag me-1"></i> Type</th>
                        <th><i class="bi bi-currency-dollar me-1"></i> Selling Price</th>
                        <th><i class="bi bi-cash me-1"></i> Base Price</th>
                        <th><i class="bi bi-bar-chart me-1"></i> Profit/Loss</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td><span class="pl-date">{{ $row['date'] }}</span></td>
                            <td><span class="pl-order-num">#{{ $row['order_number'] }}</span></td>
                            <td class="text-start">{{ $row['item_name'] }}</td>
                            <td>
                                @if($row['type'] === 'Product')
                                    <span class="pl-badge pl-badge-product">Product</span>
                                @elseif($row['type'] === 'Source Code')
                                    <span class="pl-badge pl-badge-source">Source Code</span>
                                @else
                                    <span class="pl-badge pl-badge-na">N/A</span>
                                @endif
                            </td>
                            <td>${{ number_format($row['selling_price'], 2) }}</td>
                            <td>
                                @if($row['type'] === 'Product')
                                    ${{ number_format($row['base_price'], 2) }}
                                @else
                                    <span class="pl-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @if($row['type'] === 'Product')
                                    <span class="{{ $row['profit'] >= 0 ? 'pl-profit' : 'pl-loss' }}">
                                        <i class="bi {{ $row['profit'] >= 0 ? 'bi-caret-up-fill' : 'bi-caret-down-fill' }}"></i>
                                        ${{ number_format(abs($row['profit']), 2) }}
                                    </span>
                                @else
                                    <span class="pl-muted">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <div class="pl-empty">
                <i class="bi bi-inbox"></i>
                <p>No completed orders found in this date range.</p>
            </div>
        @endif
    </div>
</div>

<style>
/* ─── Page ─── */
.pl-page {
    padding: 24px 28px; height: 100%;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: #f1f5f9;
}

/* ─── Header ─── */
.pl-header {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    padding: 18px 22px;
    backdrop-filter: blur(8px);
    margin-bottom: 20px;
}
.pl-header-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}
.pl-header-title {
    font-size: 18px; font-weight: 700; margin: 0 0 2px 0;
}
.pl-header-sub {
    font-size: 13px; color: #94a3b8; margin: 0;
}

/* ─── Filter ─── */
.pl-filter {
    margin-bottom: 20px;
}
.pl-filter-form {
    display: flex;
    align-items: flex-end;
    gap: 12px;
    flex-wrap: wrap;
}
.pl-filter-group {
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.pl-filter-label {
    font-size: 11px;
    font-weight: 600;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}
.pl-filter-input {
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
.pl-filter-input:focus {
    border-color: #60A5FA;
    box-shadow: 0 0 0 3px rgba(96,165,250,0.12);
}
.pl-filter-input::-webkit-calendar-picker-indicator {
    filter: invert(0.7);
    cursor: pointer;
}
.pl-filter-btn {
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
.pl-filter-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.3);
}

/* ─── Summary Cards ─── */
.pl-summary {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 20px;
}
.pl-summary-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
}
.pl-summary-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}
.pl-summary-selling .pl-summary-icon {
    background: rgba(96,165,250,0.12);
    color: #60A5FA;
    border: 1px solid rgba(96,165,250,0.15);
}
.pl-summary-base .pl-summary-icon {
    background: rgba(168,85,247,0.12);
    color: #A855F7;
    border: 1px solid rgba(168,85,247,0.15);
}
.pl-summary-profit .pl-summary-icon {
    background: rgba(16,185,129,0.12);
    color: #10B981;
    border: 1px solid rgba(16,185,129,0.15);
}
.pl-summary-loss .pl-summary-icon {
    background: rgba(239,68,68,0.12);
    color: #EF4444;
    border: 1px solid rgba(239,68,68,0.15);
}
.pl-summary-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    margin-bottom: 2px;
}
.pl-summary-value {
    display: block;
    font-size: 20px;
    font-weight: 700;
}
.pl-summary-profit .pl-summary-value { color: #10B981; }
.pl-summary-loss .pl-summary-value { color: #EF4444; }
.pl-summary-selling .pl-summary-value { color: #60A5FA; }
.pl-summary-base .pl-summary-value { color: #A855F7; }

/* ─── Table Card ─── */
.pl-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    overflow: hidden;
    backdrop-filter: blur(8px);
}
.pl-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}
.pl-table thead th {
    padding: 12px 16px;
    text-align: center;
    font-size: 11px;
    font-weight: 600;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    background: rgba(10,10,10,0.3);
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.pl-table thead th.text-start { text-align: left; }
.pl-table tbody td {
    padding: 12px 16px;
    text-align: center;
    border-bottom: 1px solid rgba(255,255,255,0.04);
    vertical-align: middle;
}
.pl-table tbody td.text-start { text-align: left; }
.pl-table tbody tr:hover {
    background: rgba(255,255,255,0.02);
}
.pl-table tbody tr:last-child td {
    border-bottom: none;
}
.pl-date {
    color: #94a3b8;
    font-size: 12px;
    white-space: nowrap;
}
.pl-order-num {
    color: #60A5FA;
    font-weight: 600;
    font-size: 12px;
    white-space: nowrap;
}

/* ─── Badges ─── */
.pl-badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
}
.pl-badge-product {
    background: rgba(16,185,129,0.1);
    color: #10B981;
    border: 1px solid rgba(16,185,129,0.15);
}
.pl-badge-source {
    background: rgba(96,165,250,0.1);
    color: #60A5FA;
    border: 1px solid rgba(96,165,250,0.15);
}
.pl-badge-na {
    background: rgba(148,163,184,0.08);
    color: #64748b;
    border: 1px solid rgba(148,163,184,0.12);
}

/* ─── Profit/Loss colors ─── */
.pl-profit {
    color: #10B981;
    font-weight: 600;
}
.pl-loss {
    color: #EF4444;
    font-weight: 600;
}
.pl-muted {
    color: #64748b;
}

/* ─── Empty state ─── */
.pl-empty {
    text-align: center;
    padding: 48px 20px;
    color: #64748b;
}
.pl-empty i {
    font-size: 32px;
    margin-bottom: 12px;
    display: block;
    opacity: 0.4;
}
.pl-empty p {
    font-size: 14px;
    margin: 0;
}

/* ─── Responsive ─── */
@media (max-width: 768px) {
    .pl-page { padding: 20px 22px; }
    .pl-summary { grid-template-columns: 1fr; }
    .pl-filter-form { flex-direction: column; align-items: stretch; }
    .pl-filter-btn { height: auto; justify-content: center; }
}
@media (max-width: 480px) {
    .pl-page { padding: 16px; }
    .pl-header { padding: 14px 16px; }
    .pl-summary-card { padding: 14px 16px; }
    .pl-summary-value { font-size: 17px; }
}
</style>

@endsection
