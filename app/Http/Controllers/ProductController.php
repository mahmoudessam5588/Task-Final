<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function filterProduct(Request $request)
    {
        $query = Product::query();
        $categories = Category::all();
        if($request->ajax()){
           $products =  $query->where(['category_id' => $request->category])->get();
           return response()->json(['products'=>$products]);  
        }
        $products  = $query->get();
        return view('product', compact('categories','products'));

    }

}

