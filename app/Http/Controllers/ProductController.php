<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPackage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productsByVendor() {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'products' => $user->products,
            'packages' => $user->productpackages,
        ]);
    }

    public function add(Request $request) {
        $request->validate([
            'item' => 'required',
            'rate' => 'numeric|min:0',
            'package' => 'nullable',
            'description' => 'string|nullable',
            'package_name' => 'string|nullable',
            'package_details' => 'string|nullable',
        ]);

        $pkgId = $request->package;

        if($request->package == 'new') {
            $pkg = ProductPackage::create([
                'client_id' => Auth::user()->id,
                'name' => $request->package_name,
                'details' => $request->package_details,
            ]);

            $pkgId = $pkg->id;
        }

        if(Product::create([
            'client_id' => Auth::user()->id,
            'package_id' => $pkgId,
            'item' => $request->item,
            'rate' => $request->rate,
            'description' => $request->description
        ])) {
            return $this->productsByVendor();
        }

        return response()->json('Error.', 500);
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required|exists:products,id',
            'item' => 'required',
            'rate' => 'numeric|min:0',
            'package' => 'nullable',
            'description' => 'string|nullable',
            'package_name' => 'string|nullable',
            'package_details' => 'string|nullable',
        ]);

        $pkgId = $request->package;

        if($request->package == 'new') {
            $pkg = ProductPackage::create([
                'client_id' => Auth::user()->id,
                'name' => $request->package_name,
                'details' => $request->package_details,
            ]);

            $pkgId = $pkg->id;
        }

        $product = Product::find($request->id);

        if($product->update([
            'package_id' => $pkgId,
            'item' => $request->item,
            'rate' => $request->rate,
            'description' => $request->description
        ])) {
            return $this->productsByVendor();
        }
        return response()->json('Error.', 500);
    }

    public function flag(Product $product, $status) {
        $user = Auth::user();

        foreach($user->products as $p) {
            $p->update(['flag' => null]);
        }

        $product->update(['flag' => $status]);
        return $this->productsByVendor();
    }

    public function delete(Product $product) {
        $product->delete();
        return $this->productsByVendor();
    }
}