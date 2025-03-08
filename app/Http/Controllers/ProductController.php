<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\ProductPurchaseHistory;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //This method will show product page
    public function index(){
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.list', [
            'products'=>$products
        ]);
    }
    //This method will show create product page
    public function create(){
        return view('products.create');
    }
    //This method will store a product in db
    public function store(Request $request){
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image properly
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        //Here we will store product in DB
        $product = New Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->availability = $request->availability;
        $product->country = $request->country;

        if($request->hasFile('image')){
            // Store New Image
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imagename);
    
            // Save Image Name in DB
            $product->image = $imagename;
        }
        $product->save();
        
        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }
    //This method will show edit product page
    public function edit($id){
        $product = Product::findorFail($id);
        return view('products.edit',[
            'product' => $product
        ]);
    }

    //This method will update a product
    public function update($id, Request $request){
        $product = Product::findorFail($id);
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image properly
        ];
        $validator = Validator::make($request->all(), $rules);        
        
        if($validator->fails()){
            return redirect()->route('products.edit', $id)->withInput()->withErrors($validator);
        }

        //Here we will store product in DB
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->availability = $request->availability;
        $product->country = $request->country;

        if ($request->hasFile('image')) {
            // Delete Old Image if Exists
            if (!empty($product->image) && File::exists(public_path('uploads/products/' . $product->image))) {
                File::delete(public_path('uploads/products/' . $product->image));
            }
    
            // Store New Image
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imagename);
    
            // Save Image Name in DB
            $product->image = $imagename;
        }
        $product->save();
        
        return redirect()->route('products.edit', $id)->with('success', 'Product updated successfully');
    }

    //This method will delete a product
    // public function destroy($id){
    //     $product = Product::findorFail($id);
    //     //Delete old file
    //     File::delete(public_path('uploads/products/'.$product->image));
    //     $product->delete();
    //     return redirect()->route('products.index', $product->id)->with('success', 'Product deleted successfully');
    // }

    public function getTopSoldProducts(){
        $topSoldProducts = ProductPurchaseHistory::select(
            'product_purchase_history.productid',
            'product.name as product_name',
            'user.name as username',
            DB::raw('COUNT(product_purchase_history.productid) as purchase_count')
        )
        ->join('product', 'product.id', '=', 'product_purchase_history.productid')
        ->join('user', 'user.id', '=', 'product_purchase_history.userid')
        ->where('product_purchase_history.purchase_status', 'completed') // Only count completed purchases
        ->groupBy('product_purchase_history.productid', 'product.name', 'user.name')
        ->orderByDesc('purchase_count') // Sort by max sold
        ->limit(10) // Fetch top 10 most sold products
        ->get();
        return response()->json([
            'status' => 'success',
            'data' => $topSoldProducts
        ]);
    }
}
