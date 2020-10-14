<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        //
    }

    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.create', compact('client','categories', 'orders'));
    }

    public function store(Request $request, Client $client)
    {
        $request->validate([
            'product_ids'=>'required|array',
            'quantities'=>'required|array',
        ]);
        $order = $client->orders()->create([]);
        $total_price = 0;

        foreach($request->product_ids as $index=>$product_id){

            $product = Product::FindOrFail($product_id);
            $total_price += $product->sale_price *  $request->quantities[$index];

            $order->products()->attach($product_id, ['quantity'=> $request->quantities[$index]]);
            
            $product->update([
                'stock' => $product->stock - $request->quantities[$index]
            ]);
        }
        $order->update([
            'total_price'=> $total_price
        ]);
        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');
        //dd($request->all());
    }

    public function show()
    {
        //
    }

    public function edit(Client $client, Order $order)
    {
        $orders = $client->orders()->with('products')->paginate(5);
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.edit', compact('client','order','categories', 'orders'));
        //return view('dashboard.clients.orders.create', compact('client','categories'));

    }

    public function update(Request $request, Client $client ,Order $order)
    {
        $request->validate([
            'product_ids'=>'required|array',
            //'quantities'=>'required|array',
        ]);
        session()->flash('success',__('site.updated_successfully'));
        return redirect()->route('dashboard.orders.index');
    }

    public function destroy(Client $client ,Order $order)
    {
        //
    }
}
