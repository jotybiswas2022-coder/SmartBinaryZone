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
