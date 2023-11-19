<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    const PATH_VIEW = 'products.';
    const PATH_UPLOAD = 'products';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Product::query()->latest()->paginate(5);
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view(self::PATH_VIEW.__FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'thumbnail' => 'required|image|max:5000',
            'name' => 'required|unique:products|max:50',
            'price' => 'required',
            'created' =>'required',
            'status' => [
                'required',
                Rule::in([
                    Product::STATUS_YES,
                    Product::STATUS_NO,
                ])
            ],
        ]);

        $data = $request->except('thumbnail');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('thumbnail'));
        }
        // dd($data);
        Product::query()->create($data);

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        return view(self::PATH_VIEW.__FUNCTION__,compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        return view(self::PATH_VIEW.__FUNCTION__, compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $data = $request->except('thumbnail');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('thumbnail'));
        }

        $oldPathImg = $product->thumbnail;

        $product->update($data);

        if ($request->hasFile('thumbnail')) {
            Storage::delete($oldPathImg);
        }

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        if( Storage::exists($product->thumbnail)){
            Storage::delete($product->thumbnail);
        }
        return back()->with('msg','xóa thành công');
    }
}
