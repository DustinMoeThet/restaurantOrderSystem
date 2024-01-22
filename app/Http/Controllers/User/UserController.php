<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $category = Category::get();
        $product = Product::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('product','category','cart'));
    }

    //changePassword
    public function changePasswordPage(){
        return view('user.account.passwordChange');
    }

    public function changePassword(Request $request){
        /*
        1. all field must be filled
        2. new password and confirm password length must be greater than 6
        3. new password and confirm password must be same
        4. client old password = password in db
        if all of the above are correct
        5. change password
        */
        $this->passwordValidationCheck($request);

        $currentUserId =Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        $dbPassword= $user->password;
        $inputPassword = $request->oldPassword;
        if(Hash::check($inputPassword, $dbPassword)){
        $data = $this->passwordChangeRequest($request);
        User::where('id',$currentUserId)->update($data);

        Auth::logout();
        return redirect()->route('auth#loginPage')->with(['passwordChangedSuccessful'=>'Password changed successfully. Please log in again']);
        }
        else{
            return back()->with(['notMatch'=>'The old password and new password does not match. Try Again']);
        }
    }

    public function accountDetailChangePage(){
        return view('user.account.detailChange');
    }

    public function update(Request $request){


        $data= $this->getUserData($request);
        $this->accountValidationCheck($data);

        //check image
        if($request->hasFile('image')){
            // check if user have original image
            // if user has original image, delete that image.
            // update and store the image

            $dbImage = User::where('id',Auth::user()->id)->first();
            $dbImage = $dbImage->image;

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);

            $data['image'] = $fileName;

            if($dbImage!=null){
                Storage::delete('public/'.$dbImage);
            }

        }
        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('user#home')->with(['updateSuccess'=>'User Account Update Successful']);
     }
     //cart
     public function cartList(){
        $cartList = Cart::select('carts.*','products.name as product_name','products.price as product_price')
        ->leftJoin('products','products.product_id','carts.product_id')
        ->where('user_id',Auth::user()->id)
        ->get();
        $totalPrice = 0;
        foreach ($cartList as $item) {
            $totalPrice += ($item->product_price * $item->qty);
        }
        return view('user.main.cart',compact("cartList",'totalPrice'));
     }

     public function cartListDelete($id){
        Cart::where('cart_id',$id)->delete();
        return redirect()->route('user#cartList');
     }
     public function cartDelete(){
        Cart::where('user_id',Auth::user()->id)->delete();
        return redirect()->route('user#cartList');
     }

     //history page
     public function history(){
        $data = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(4);
        return view('user.main.history',compact('data'));
     }



    // private functions
    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6',
            'newPassword'=>'required|min:6',
            'confirmPassword'=>'required|min:6|same:newPassword'
        ])->validate();
    }

    public function productDetail($productId){
        $product = Product::where('product_id',$productId)->first();
        $productList = Product::get();
        return view('user.main.detail',compact('product','productList'));
    }

    //password change request
    private function passwordChangeRequest($request){

        return [
            'password'=> Hash::make($request->newPassword)
        ];
    }

    //User data update request
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
        ];
    }

    //User data update validate
    private function accountValidationCheck($request){
        Validator::make($request,[
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ])->validate();
    }

}
