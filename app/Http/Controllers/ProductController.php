<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list(){
        $searchKey = request('key'); // Retrieve the search key

        $products = Product::select('products.*','categories.name as category_name')->when($searchKey, function($query) use ($searchKey){
            $query->where('name', 'like', '%'.$searchKey.'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at', 'desc')->paginate(4);

        $products->appends(request()->all());
        $hasPendingOrders = $this->hasPendingOrders();
        return view('admin.product.pizza_list', compact('products', 'searchKey','hasPendingOrders')); // Pass 'searchKey' to the view
    }


    //direct product create page

    public function createPage(){
        $categories = Category::select('id','name')->get();
        $hasPendingOrders = $this->hasPendingOrders();
        return view('admin.product.create',compact('categories','hasPendingOrders'));
    }

    //product creation

    public function createProduct(Request $request){
        $this->productValidationCheck($request);
        $data = $this->getProductData($request);
            $fileName = uniqid().$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public',$fileName);
            $data['image']= $fileName;

        Product::create($data);
        return redirect()->route('product#list');
    }
    //product deletion

    public function deleteProduct($id){
        $product_delete = Product::where('product_id',$id)->first();
        Storage::delete('public/'.$product_delete->image);
        Product::where('product_id',$id)->delete();

        return back()->with(['deleteSuccess'=>'Deletion Success']);
    }

    //product edit

    public function editPage($id){
        $categories = Category::select('id','name')->get();
        $product = Product::where('product_id',$id)->first();
        $hasPendingOrders = $this->hasPendingOrders();
        return view('admin.product.product_edit',compact('product','categories','hasPendingOrders'));
    }
    //update post function
    public function update($id,Request $request){
        $this->productUpdateValidationCheck($request,$id);
        $data = $this->getProductData($request);
        if($request->hasFile('image')){
            $product_delete = Product::where('product_id',$id)->first();
            Storage::delete('public/'.$product_delete->image);
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        Product::where('product_id',$id)->update($data);
        return redirect()->route('product#list');

    }

    public function detailPage($id){
        $product = Product::select('products.*','categories.name as category_name')
        ->where('product_id',$id)
        ->leftJoin('categories','products.category_id','categories.id')
        ->first();
        $hasPendingOrders = $this->hasPendingOrders();
        return view('admin.product.product_detail',compact('product','hasPendingOrders'));
    }




    //private functions
    private function getProductData($request){
        return [
            'name' => $request-> productName,
            'category_id' => $request-> productCategory,
            'description' => $request-> productDescription,
            'price' => $request-> price
        ];
    }

    private function productValidationCheck($request){
        Validator::make($request->all(),
            [
                'productName' => 'required | min:3 |unique:products,name',
                'productCategory'=>'required',
                'productDescription'=>'required',
                'productImage'=>'required',
                'price' => 'required| min:3'
            ])->validate();
    }

    private function productUpdateValidationCheck($request,$id){
        Validator::make($request->all(),
            [
                'productName' => 'required | min:3 | unique:products,name,'.$id.',product_id',
                'productCategory'=>'required',
                'productDescription'=>'required',
                'price' => 'required| min:3'
            ])->validate();
    }
    private function hasPendingOrders()
    {
        $pendingOrdersCount = Order::where('status', '0')->count();
        return $pendingOrdersCount > 0;
    }
}
