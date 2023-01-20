<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\GetOrder;
use App\Http\Resources\Order\ShowOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->order;
        $data = [
            'status' => true,
            'message' => 'All order fetched successfully',
        ];
        return GetOrder::collection($orders)->additional($data);
    }

    public function show($invoice)
    {
        $order = auth()->user()->order()->where('invoice', $invoice)->first();
        if (!$order) {
            return json_response(0, 'Order Not Found');
        }
        $data = [
            'status' => true,
            'message' => "Order $invoice fetched successfully",
        ];
        return ShowOrder::make($order)->additional($data);
    }
}
