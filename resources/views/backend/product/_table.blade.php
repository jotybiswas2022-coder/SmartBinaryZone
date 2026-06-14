@forelse ($products as $product)
    <tr>
        <td>
            @if($product->image)
                <img src="{{ config('app.storage_url') }}{{ $product->image }}" alt="{{ $product->name }}"
                    style="width:44px;height:44px;border-radius:8px;object-fit:cover;border:1px solid var(--pborder)">
            @else
                <div style="width:44px;height:44px;border-radius:8px;background:rgba(96,165,250,0.1);display:flex;align-items:center;justify-content:center;color:var(--pprimary);font-size:18px;border:1px solid var(--pborder)">
                    <i class="bi bi-image"></i>
                </div>
            @endif
        </td>
        <td class="text-start">
            <div class="prod-name">{{ $product->name }}</div>
            @if($product->tagline)
                <div class="prod-tagline">{{ $product->tagline }}</div>
            @endif
        </td>
        <td><span class="prod-slug-badge">{{ $product->slug }}</span></td>
        <td><span class="prod-indicator">{{ $product->indicator ?? '—' }}</span></td>
        <td>
            @if($product->plans && count($product->plans) > 0)
                <span class="prod-price">
                    {{ formatPrice(min(array_column($product->plans, 'price')), 0) }}
                    –
                    {{ formatPrice(max(array_column($product->plans, 'price')), 0) }}
                </span>
            @else
                <span style="color:var(--psub)">—</span>
            @endif
        </td>
        <td>
            @if($product->available)
                <span class="prod-status-dot" style="background:#10b981" title="Available"></span>
                <span style="color:#10b981;font-size:12px;font-weight:500">Active</span>
            @else
                <span class="prod-status-dot" style="background:#ef4444" title="Unavailable"></span>
                <span style="color:#ef4444;font-size:12px;font-weight:500">Hidden</span>
            @endif
        </td>
        <td>
            <span class="date-badge">{{ $product->created_at->format('d M Y') }}</span>
        </td>
        <td>
            <div class="prod-actions">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="prod-edit-btn" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}"
                  class="delete-product-form"
                  data-name="{{ $product->name }}">
                @csrf @method('DELETE')
                <button type="button" class="prod-delete-btn delete-btn-trigger" title="Delete">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="empty-row">
            <div class="empty-state">
                <i class="bi bi-box-seam empty-icon"></i>
                <div class="empty-title">No Products Found</div>
                <div class="empty-sub">Try adjusting your search terms.</div>
            </div>
        </td>
    </tr>
@endforelse
