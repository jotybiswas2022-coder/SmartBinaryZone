<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\SourceCode;
use Illuminate\Http\Request;

class ProfitLossController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->format('Y-m-d'));
        $to = $request->input('to', now()->format('Y-m-d'));

        $orders = Order::whereIn('status', ['completed', 'processing'])
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->orderBy('created_at', 'desc')
            ->get();

        $rows = [];
        $totalSelling = 0;
        $totalBase = 0;
        $totalProfit = 0;

        foreach ($orders as $order) {
            foreach ($order->items ?? [] as $item) {
                $itemId = $item['id'] ?? '';
                $sellingPrice = (float) ($item['price'] ?? 0);
                $basePrice = 0;
                $type = 'N/A';

                if (str_starts_with($itemId, 'src-')) {
                    $slug = substr($itemId, 4);
                    $sourceCode = SourceCode::where('slug', $slug)->first();
                    if ($sourceCode) {
                        $type = 'Source Code';
                    }
                } else {
                    $lastDash = strrpos($itemId, '-');
                    if ($lastDash !== false) {
                        $slug = substr($itemId, 0, $lastDash);
                        $planIndex = (int) substr($itemId, $lastDash + 1);
                        $product = Product::where('slug', $slug)->first();
                        if ($product) {
                            $plans = $product->plans ?? [];
                            if (isset($plans[$planIndex])) {
                                $type = 'Product';
                                $basePrice = (float) ($plans[$planIndex]['base_price'] ?? 0);
                            }
                        }
                    }
                }

                $profit = $sellingPrice - $basePrice;

                $rows[] = [
                    'date' => $order->created_at->format('d M Y'),
                    'order_number' => $order->order_number,
                    'item_name' => $item['name'] ?? 'Item',
                    'type' => $type,
                    'selling_price' => $sellingPrice,
                    'base_price' => $basePrice,
                    'profit' => $profit,
                ];

                $totalSelling += $sellingPrice;
                $totalBase += $basePrice;
                $totalProfit += $profit;
            }
        }

        return view('backend.profit-loss', compact(
            'rows', 'from', 'to',
            'totalSelling', 'totalBase', 'totalProfit'
        ));
    }
}
