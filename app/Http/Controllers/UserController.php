<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function manage(){
        return view('admin.user.manage', ['Users' => Customer::all()]);
    }

    public function delete($id){
        $this->orderdetails = OrderDetail::where('customer_id', $id)->get();
        foreach($this->orderdetails as $orderdetail){
            $orderdetail->delete();
        }

        $this->order = Order::where('customer_id', $id)->get();
        foreach($this->order as $orders){
            $orders->delete();
        }

        $this->customer = Customer::find($id);
        $this->customer->delete();

        return redirect('/manage-user')->with('message', 'User Info Delete Successfully');
    }

}
