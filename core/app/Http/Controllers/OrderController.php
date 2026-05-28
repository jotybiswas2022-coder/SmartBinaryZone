<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a list of orders for the authenticated user.
     */
    public function myOrders(Request $request)
    {
        $sort = $request->query('sort', 'newest');

        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', $sort === 'oldest' ? 'asc' : 'desc')
            ->paginate(10);

        return view('frontend.forex.my-orders', compact('orders', 'sort'));
    }
    /**
     * Place an order — save to database and redirect to success page.
     */
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'items'           => 'required|json',
            'total'           => 'required|numeric|min:0',
            'name'            => 'nullable|string|max:100',
            'email'           => 'nullable|email|max:100',
            'notes'           => 'nullable|string|max:1000',
            'payment_method'  => 'nullable|string|max:50',
            'trading_account' => 'nullable|string|max:50',
            'phone'           => 'nullable|string|max:30',
        ]);

        $items = json_decode($validated['items'], true);
        $user  = Auth::user();

        // Calculate subtotal from items to prevent manipulation
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += ($item['price'] ?? 0) * ($item['qty'] ?? 1);
        }

        $order = Order::create([
            'user_id'         => $user?->id,
            'order_number'    => Order::generateOrderNumber(),
            'items'           => $items,
            'subtotal'        => $subtotal,
            'total'           => $validated['total'],
            'payment_method'  => $validated['payment_method'] ?? null,
            'status'          => 'pending_payment',
            'customer_name'   => $validated['name'] ?? ($user?->name),
            'customer_email'  => $validated['email'] ?? ($user?->email),
            'phone'           => $validated['phone'] ?? null,
            'trading_account' => $validated['trading_account'] ?? null,
            'notes'           => $validated['notes'] ?? null,
        ]);

        // Return JSON with order number so the frontend can proceed
        return response()->json([
            'success' => true,
            'order_number' => $order->order_number,
            'message' => 'Order created. Please submit your payment details.'
        ]);
    }

    /**
     * Confirm order with payment proof — handles file upload.
     */
    public function confirmPayment(Request $request)
    {
        $validated = $request->validate([
            'order_number'     => 'required|string|max:50|exists:orders,order_number',
            'transaction_id'     => 'required|string|max:255',
            'payment_screenshot' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $order = Order::where('order_number', $validated['order_number'])->firstOrFail();

        $path = $request->file('payment_screenshot')->store('payments', 'public');

        $updateData = [
            'transaction_id'     => $validated['transaction_id'],
            'payment_screenshot' => $path,
            'status'             => 'payment_submitted',
        ];

        $order->update($updateData);

        return redirect()->route('forex.my-orders')
            ->with('success', 'Your payment details have been submitted successfully! Order #' . $order->order_number);
    }

    /**
     * Order success page — show order details with prev/next navigation.
     */
    public function success(Request $request, $orderNumber = null)
    {
        $orderNumber = $orderNumber ?? $request->query('order');
        $order = null;
        $prevOrder = null;
        $nextOrder = null;

        if ($orderNumber) {
            $order = Order::where('order_number', $orderNumber)->first();

            if ($order && Auth::check()) {
                // Get all user's ordered IDs for prev/next navigation
                $userOrderIds = Order::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->pluck('order_number');

                $currentIndex = $userOrderIds->search($order->order_number);

                if ($currentIndex !== false) {
                    if ($currentIndex > 0) {
                        $prevOrder = $userOrderIds[$currentIndex - 1];
                    }
                    if ($currentIndex < $userOrderIds->count() - 1) {
                        $nextOrder = $userOrderIds[$currentIndex + 1];
                    }
                }
            }
        }

        return view('frontend.forex.order-success', compact('order', 'prevOrder', 'nextOrder'));
    }
}
