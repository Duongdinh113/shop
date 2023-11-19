<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{

    const PATH_VIEW = 'admin.brands.';
    const PATH_UPLOAD = 'brands';
    public function index()
    {

        $data = Brand::query()->latest()->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'))->with('title', 'Brand');
    }
    public function create()
    {

        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function store()
    {
        \request()->validate();

        $data = \request()->except('img');

        if (\request()->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, \request()->file('img'));
        };
        Brand::query()->create(\request()->all());
        return back()->with('msg', 'Thành công');
    }
    public function show(Brand $brand)
    {

        return view(self::PATH_VIEW . __FUNCTION__, compact('brand'));
    }
    public function edit(Brand $brand)
    {

        return view(self::PATH_VIEW . __FUNCTION__, compact('brand'));
    }
    public function update(Brand $brand)
    {
        \request()->validate();

        $data = \request()->except('img');

        if (\request()->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, \request()->file('img'));
        };
        $oldImg = $brand->img;
        $brand->update($data);
        if (\request()->hasFile('img') && Storage::exists($oldImg)) {
            Storage::delete($oldImg);
        }

        return back()->with('msg', 'Thành công');
    }
    public function delete(Brand $brand)
    {
        if (Storage::exists($brand->img)) {
            Storage::delete($brand->img);
        }
        return back()->with('msg', 'Thành công');
    }
    public function manyDelete()
    {
    }
}
