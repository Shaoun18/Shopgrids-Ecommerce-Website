<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    private $products;
    private $categories;
    private $customer;
    private $order;
    private $orderdetail;

    public function getAllTrendingProduct(){
        $this->products = Product::Where('status', 1)->orderBy('id', 'desc')->take('8')->get(['id','name','image','selling_price']);
        foreach($this->products as $product){
            $product->image = asset($product->image);
        }
        return response()->json($this->products);
    }

    public function getAllCategoryProduct(){
        $this->categories = Category::all();
        foreach($this->categories as $category){
            $category->subCategory = SubCategory::Where('category_id', $category->id)->get();
        }
        return response()->json($this->categories);
    }

    public function getAllCategoryProductID($id){
        $this->products = Product::Where('status', 1)->where('category_id', $id)->orderBy('id', 'desc')->take('8')->get(['id','name','image','selling_price']);
        foreach($this->products as $product){
            $product->image = asset($product->image);
        }
        return response()->json($this->products);
    }

	public function getProductByID($id){
		$this->products = Product::find($id);
		$this->products->image = asset($this->products->image);
		$this->products->category = Category::find($this->products->category_id)->name;
		$this->products->brand = Brand::find($this->products->brand_id)->name;
		return response()->json($this->products);
	}

	public function newOrder(Request $request){
		$this->customer = new Customer();
		$this->customer->name = $request->customer['name'];
		$this->customer->email = $request->customer['email'];
		$this->customer->password = bcrypt($request->customer['mobile']);
		$this->customer->mobile  = $request->customer['mobile'];
		$this->customer->address  = $request->customer['address'];
		$this->customer->token  = Str::random('25');
        $this->customer->save();

//        $this->order = new Order();
//        $this->order->customer_id = $this->customer->id;
//        $this->order->order_total = $request->ordertotal;
//        $this->order->tax_total = $request->Taxtotal;
//        $this->order->shipping_total = $request->ShippingCost;
//        $this->order->delivery_address = $request->customer['address'];
//        $this->order->order_date = date('Y-m-d');
//        $this->order->order_timestamp = strtotime(date('Y-m-d'));
//        $this->order->payment_method = $request->customer['PaymentMethod'];
//        $this->order->save();
//
//        foreach ($request->products as $product){
//            $this->orderdetail = new OrderDetail();
//            $this->orderdetail->order_id = $this->order->id;
//            $this->orderdetail->product_id = $product['id'];
//            $this->orderdetail->product_name = $product['name'];
//            $this->orderdetail->product_price = $product['price'];
//            $this->orderdetail->product_qty = $product['qty'];
//            $this->orderdetail->save();
//        }
        return response()->json([
            'success' => true,
            'id' => $this->customer->id,
            'name' => $this->customer->name,
            'token' => $this->customer->token,
        ]);
//        return response()->json($request->all());
	}
    public  function Logout(Request $request){
        Customer::where('token', $request->token)->first();
        if ($this->customer){
            $this->customer->token = '';
            $this->customer->save();

            return response()->json([
                'success' => true,
            ]);
        }
    }
}
