<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function add(Request $request) {
        $request->validate([
            'item' => 'required',
            'rate' => 'numeric|min:0',
            'package' => 'nullable|exists:product_packages,id',
            'description' => 'string|nullable'
        ]);

        if($product = Product::create([
            'client_id' => Auth::user()->id,
            'package_id' => $request->package,
            'item' => $request->item,
            'rate' => $request->rate,
            'description' => $request->description
        ])) {
            return response()->json('Successfully added.');
        }

        return response()->json('Error.', 500);
    }
}