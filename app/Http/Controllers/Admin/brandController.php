<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{

    const PATH_VIEW = 'admin.brands.';
    const PATH_UPLOAD = 'admin.brands';
    public function index()
    {

        $data = Brand::query()->latest()->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'))->with('title', 'brand');
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
    public function show(Brand $Brand)
    {

        return view(self::PATH_VIEW . __FUNCTION__, compact('Brand'));
    }
    public function edit(Brand $Brand)
    {

        return view(self::PATH_VIEW . __FUNCTION__, compact('Brand'));
    }
    public function update(Brand $Brand)
    {
        \request()->validate();

        $data = \request()->except('img');

        if (\request()->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, \request()->file('img'));
        };
        $oldImg = $Brand->img;
        $Brand->update($data);
        if (\request()->hasFile('img') && Storage::exists($oldImg)) {
            Storage::delete($oldImg);
        }

        return back()->with('msg', 'Thành công');
    }
    public function delete(Brand $Brand)
    {
        $Brand->delete();
        if (Storage::exists($Brand->img)) {
            Storage::delete($Brand->img);
        }
        return back()->with('msg', 'Thành công');
    }
    public function manyDelete()
    {
    }
}
