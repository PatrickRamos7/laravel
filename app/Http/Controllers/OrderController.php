<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client.doc_type' => 'required|integer',
            'client.doc_number' => 'required|string',
            'client.first_name' => 'required|string',
            'client.last_name' => 'required|string',
            'client.phone' => 'required|string',
            'client.email' => 'required|email',
            'items' => 'required|array',
            'items.*.book_id' => 'required|exists:pos_book,book_id',
            'items.*.quantity' => 'required|integer|min:1',
            'total' => 'required|numeric'
        ]);

        DB::beginTransaction();

        try {
            $client = Client::create($validatedData['client']);

            $order = Order::create([
                'client_id' => $client->client_id,
                'total' => $validatedData['total'],
                'doc_type' => $validatedData['client']['doc_type'],
                'doc_number' => $validatedData['client']['doc_number'],
            ]);

            foreach ($validatedData['items'] as $item) {
                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'book_id' => $item['book_id'],
                    'detail_price' => $item['current_price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Order created successfully', 'order_id' => $order->order_id], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error creating order', 'error' => $e->getMessage()], 500);
        }
    }
}