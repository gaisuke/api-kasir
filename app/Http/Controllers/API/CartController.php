<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\GetCart;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        if (auth()->user()->cart) {
            return GetCart::collection(auth()->user()->cart->details);
        }
        return json_response(0, 'You dont have any item in cart');
    }

    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required|string|exists:products,slug',
            'quantity' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return json_response(0, $validator->messages());
        }
        $product = Product::where('slug', $request->product)->first();
        $quantity = $request->quantity;
        if ($quantity > $product->stock) {
            return json_response(0, 'Over quantity');
        }
        $cart = auth()->user()->cart ?? auth()->user()->cart()->create();
        if ($cart->details->where('product_id', $product->id)->first()) {
            $cart->details->where('product_id', $product->id)->first()->update([
                'quantity' => $quantity
            ]);
        } else {
            $cart->details()->create([
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
        }
        return json_response(1, 'Product added to cart');
    }

    public function deleteItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|string|exists:products,id',
        ]);
        if ($validator->fails()) {
            return json_response(0, $validator->messages());
        }
        $cart = auth()->user()->cart;
        $product = $cart->details->where('product_id', $request->product_id)->first();
        if ($product) {
            $product->delete();
            return json_response(1, 'Product deleted successfully');
        }
        return json_response(0, 'Product not found');
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'address' => 'required|string',
        ]);
        if ($validator->fails()) {
            return json_response(0, $validator->messages());
        }
        if (auth()->user()->cart) {
            if (count(auth()->user()->cart->details) < 1){
                return json_response(0, 'You dont have any item in cart');
            }
            $cart = auth()->user()->cart;
            $total = 0;
            foreach ($cart->details as $detail) {
                $total += $detail->quantity * $detail->product->price;
            }
            $order = auth()->user()->order()->create([
                'invoice' => $this->generateInvoiceId(),
                'total_price' => $total
            ]);
            foreach ($cart->details as $detail) {
                $product = Product::find($detail->product_id);
                $product->update([
                    'stock' => $product->stock -= $detail->quantity
                ]);
                $order->details()->create([
                    'product_id' => $detail->product_id,
                    'quantity' => $detail->quantity,
                    'price' => $detail->product->price
                ]);
            }
            auth()->user()->cart()->delete();
            return json_response(1, 'Checkout successfully');
        }
        return json_response(0, 'You dont have any item in cart');
    }

    public function generateInvoiceId()
    {
        $currentYear = Carbon::now()->year;
        $check = Order::whereYear('created_at', '=', $currentYear)->count();
        $counting = $check > 9 ? ($check + 1) : sprintf("%02d", ($check + 1));
        $invoice = 'INV' . $currentYear . $counting;
        return $invoice;
    }
}
