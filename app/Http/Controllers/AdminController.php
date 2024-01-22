<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage(){
        $hasPendingOrders = $this->hasPendingOrders();
        return view('admin.account.changePassword',compact('hasPendingOrders'));
    }

    //change password
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

     //direct admin details page

     public function details(){
        $hasPendingOrders = $this->hasPendingOrders();
        return view('admin.account.details',compact('hasPendingOrders'));
     }

     //edit and update admin account

     public function edit(){
        $hasPendingOrders = $this->hasPendingOrders();
        return view ('admin.account.edit',compact('hasPendingOrders'));
     }

     public function update(Request $request){


        $data= $this->getAdminData($request);
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
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Account Update Successful']);
     }
     //Admin list

     public function list(){
        $admin = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%' )
                    ->orWhere('email','like','%'.request('key').'%' )
                    ->orWhere('phone','like','%'.request('key').'%' );
        })
        ->where('role','admin')->paginate(3);
        $admin->appends(request()->all());
        $hasPendingOrders = $this->hasPendingOrders();
        return view('admin.account.list',compact('admin','hasPendingOrders'));
     }

     public function delete($id){
        User::where('id',$id)->delete();
        return back();
     }

     public function changeRole($id){
        $data['role'] = 'user';
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
     }


     //customer list
     public function userList(){
        $user = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%' )
                    ->orWhere('email','like','%'.request('key').'%' )
                    ->orWhere('phone','like','%'.request('key').'%' );
        })
        ->where('role','user')->paginate(3);
        $user->appends(request()->all());
        $hasPendingOrders = $this->hasPendingOrders();
        return view('admin.account.userList',compact('user','hasPendingOrders'));
     }

     public function userChangeRole($id){
        $data['role'] = 'admin';
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
     }




     //private functions
        //password validation check
        private function passwordValidationCheck($request){
            Validator::make($request->all(),[
                'oldPassword'=>'required|min:6',
                'newPassword'=>'required|min:6',
                'confirmPassword'=>'required|min:6|same:newPassword'
            ])->validate();
        }

        //password change request
        private function passwordChangeRequest($request){

            return [
                'password'=> Hash::make($request->newPassword)
            ];
        }

        //Admin data update request
        private function accountValidationCheck($request){
            Validator::make($request,[
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'phone' => 'required'
            ])->validate();
        }

        private function getAdminData($request){
            return [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ];
        }
        private function hasPendingOrders()
    {
        $pendingOrdersCount = Order::where('status', '0')->count();
        return $pendingOrdersCount > 0;
    }

}
