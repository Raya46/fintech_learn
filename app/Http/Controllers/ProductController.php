<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $date = now()->format('dmYHis');
        $photoPath = "/photos/$date.png";
        if ($request->hasFile('photo')) {
            $request->file('photo')->move('photos/', "$date.png");
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo' => $photoPath,
            'description' => $request->description,
            'categories_id' => $request->categories_id,
            'stand' => $request->stand,
        ]);

        return redirect()->back()->with('status', 'success create product');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $date = now()->format('dmYHis');
        $photoPathToDelete = $product->photo;

        if ($request->hasFile('photo')) {
            $request->file('photo')->move('photos/', "$date.png");
            if (!unlink(public_path($photoPathToDelete))) {
                Storage::delete($product->photo);
            } else {
                Storage::delete($product->photo);
            }
            $photoPath = "/photos/$date.png";
        } else {
            $photoPath = $product->photo;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo' => $photoPath,
            'description' => $request->description,
            'categories_id' => $request->categories_id,
            'stand' => $request->stand,
        ]);

        return redirect()->back()->with('status', 'success update product');
    }


    public function destroy($id)
    {
        $product = Product::find($id);

        if (!is_null($product)) {
            $photoPath = $product->photo;

            if (!empty($photoPath)) {
                if (!unlink(public_path($photoPath))) {
                    Storage::delete($product->photo);
                } else {
                    Storage::delete($product->photo);
                }
            }
            $product->delete();
        }
        return redirect()->back()->with('status', 'success delete product');
    }
}
