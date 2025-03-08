<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request){
        $userid = $request->userid;

        hao@blitzy.com

        $products = DB:table('Product')
        ->join('products', 'users.id=products.user_id')
        ->join('purchase_history', 'purchase.')
        ->where('products.status', "purchased")
        ->orderBy('products.status', "purchased")
        ->limit(10)
        ->get();
        return response()->json($products);
    } 
}
