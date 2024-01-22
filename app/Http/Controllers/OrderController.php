<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list page

    public function list()
    {
        $order = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc')->paginate();
        $hasPendingOrders = $this->hasPendingOrders();
        return view('admin.orders.list', compact('order','hasPendingOrders'));
    }
    public function orderDetail($id)
    {
        $order = OrderList::select('order_lists.*', 'orders.total_price', 'products.name','orders.status')
            ->where('order_lists.order_code', $id)
            ->leftJoin('orders', 'orders.order_code', '=', 'order_lists.order_code')
            ->leftJoin('products', 'products.product_id', '=', 'order_lists.product_id')
            ->get();
        $total = $order->first()->total_price;
        $hasPendingOrders = $this->hasPendingOrders();
        return view('admin.orders.orderDetail', compact('order','total','hasPendingOrders'));
    }
    public function acceptDeny(Request $request,$id){
        if($request->desicion == 'accept'){
            Order::where('order_code',$id)->update([
                'status'=>'1'
            ]);
        }
        else{
            Order::where('order_code',$id)->update([
                'status'=>'2'
            ]);
        }
        return redirect()->route('admin#orderList');
    }

    private function hasPendingOrders()
    {
        $pendingOrdersCount = Order::where('status', '0')->count();
        return $pendingOrdersCount > 0;
    }
}
