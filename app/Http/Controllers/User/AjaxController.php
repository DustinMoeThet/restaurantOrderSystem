<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{

    //return product list
    public function productList(Request $request)
    {
        if ($request->status == 'desc') {
            $data = Product::orderBy('created_at', 'desc')->get();
        } else if ($request->status == 'asc') {
            $data = Product::orderBy('created_at', 'asc')->get();
        }

        return $data;
    }

    public function productFilter($id)
    {
        $products = Product::select('products.*', 'categories.id')
            ->where('category_id', $id)
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->get();
        return response()->json($products);
    }

    //return cart
    public function addToCart(Request $request)
    {
        $data = $this->getOrderData($request);
        Cart::create($data);
        return response()->json($data);
    }

    //order
    public function order(Request $request)
    {
        $total = 0;

        foreach ($request->orderList as $item) {
            OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);

            $total += $item['total'];
        }

        $total += 3000;

        Cart::where('user_id', Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $request->orderList[0]['order_code'], // Assuming the order_code is the same for all items
            'total_price' => $total,
        ]);

        Cart::where('user_id', $request->user_id)->delete();

        return response()->json(['message' => 'Order saved successfully']);
    }

    public function orderFilter(Request $request)
    {
        // Validate the request
        $request->validate([
            'status' => 'nullable|in:0,1,2', // Assuming the status values are 0, 1, and 2
        ]);

        // Get filtered orders based on the selected status
        $status = $request->input('status');
        $orders = Order::select('orders.*', 'users.name as user_name')
            ->when($status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc') // Add this line for sorting by creation date in descending order
            ->get();

        // Return the filtered and sorted orders as JSON
        return response()->json(['orders' => $orders]);
    }

    public function increaseViewCount(Request $request){
        $product = Product::where('product_id',$request->product_id)->first();
        $viewCount = ([
            'view_count'=>$product->view_count + 1
        ]);
        Product::where('product_id',$request->product_id)->update($viewCount);
    }








    //private functions
    private function getOrderData($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->count
        ];
    }

    private function getOrderListData($request)
    {
        //    return [
        //             'user_id'=>Auth::user()->id,
        //             'order_code'=>$data['order_code'],
        //             'total_price'=>$total,
        //    ];
    }
}
