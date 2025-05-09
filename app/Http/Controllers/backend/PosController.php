<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Juice;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    /**
     * Display the POS interface with all juices
     */
    public function index()
    {
        $juices = Juice::where('is_available', true)->get();
        return view('backend.pos.index', compact('juices'));
    }
    
    /**
     * Get juice details by ID
     */
    public function getJuiceDetails($id)
    {
        $juice = Juice::findOrFail($id);
        
        return response()->json([
            'id' => $juice->id,
            'name' => $juice->name,
            'price_small' => $juice->price_small,
            'price_medium' => $juice->price_medium,
            'price_large' => $juice->price_large,
        ]);
    }
    
    /**
     * Process order checkout
     */
   public function checkout(Request $request)
{
    $request->validate([
        'items' => 'required|array',
        'items.*.id' => 'required|exists:juices,id',
        'items.*.name' => 'required|string',
        'items.*.size' => 'required|in:small,medium,large',
        'items.*.price' => 'required|numeric',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.total' => 'required|numeric',
        'subtotal' => 'required|numeric',
        'discount' => 'required|numeric',
        'total' => 'required|numeric',
    ]);
    
    try {
        DB::beginTransaction();
        
        // Create order
        $order = new Order();
        $order->order_number = 'ORD-' . str_pad(Order::count() + 1, 6, '0', STR_PAD_LEFT); // Unique order number
        $order->order_name = Order::generateOrderName(); // Cyclical order name (folafol-1 to folafol-100)
        $order->subtotal = $request->subtotal;
        $order->discount = $request->discount;
        $order->total = $request->total;
        $order->payment_method = 'Cash';
        $order->status = 'Completed';
        $order->save();
        
        // Create order items
        foreach ($request->items as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->juice_id = $item['id'];
            $orderItem->juice_name = $item['name'];
            $orderItem->size = $item['size'];
            $orderItem->price = $item['price'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->total = $item['total'];
            $orderItem->save();
        }
        
        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => 'Order completed successfully!',
            'order' => [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'order_name' => $order->order_name, // Include the order name in the response
                'total' => $order->total,
                'date' => $order->created_at->format('Y-m-d H:i:s'),
                'print_url' => route('admin.pos.print-receipt', $order->id)
            ]
        ]);
        
    } catch (\Exception $e) {
        DB::rollBack();
        
        return response()->json([
            'success' => false,
            'message' => 'Error processing order: ' . $e->getMessage()
        ], 500);
    }
}

    public function printReceipt($id)
{
    $order = Order::with('items')->findOrFail($id);
    return view('backend.pos.print_receipt', compact('order'));
}
    
    /**
     * Get orders history
     */
    public function orders()
    {
        $orders = Order::with('items')->orderBy('created_at', 'desc')->get();
        return view('backend.pos.orders', compact('orders'));
    }
    
    /**
     * View order details
     */
    public function orderDetails($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('backend.pos.order_details', compact('order'));
    }
}