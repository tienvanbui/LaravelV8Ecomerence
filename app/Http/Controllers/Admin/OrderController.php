<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{   
    private $order;
    public function __construct(Order $order)
    {
         $this->order = $order;        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->order->latest()->paginate(30);
        return  view('admin.order.list',['orders'=>$orders]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {  

       $productInOrder = $order->products()->get();
       return view('admin.order.show')->with('order',$order)->with('productsInOrder',$productInOrder);
    }

    public function update_status_order(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status,
        ]);
        return  redirect()->route('ordercheck.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return  redirect()->route('ordercheck.index')->with('message','Order deleted successfully!');
    }
}
