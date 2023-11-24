<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Brand;

class CarController extends Controller
{
    const PATH_VIEW = 'admin.cars.';
    const PATH_UPLOAD = 'admin.car';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Car::query()
        ->with('brand')
        ->latest()
        ->paginate(5);
        return view(self::PATH_VIEW.__FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $brands = Brand::query()
        ->where('is_show', true)
        ->latest()
        ->pluck('name', 'id')
        ->all();


        return view(self::PATH_VIEW.__FUNCTION__, compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|unique:cars|max:255',
            'img_thumbnail' =>'nullable|image|max:5000',
            'describe' =>'nullable',
            'brand_id' => [
                'required',
                Rule::exists('brands','id')->where('is_show',true)
            ]


        ]);

        $data = $request->except('img_thumbnail');

        if($request->hasFile('img_thumbnail')){
            $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumbnail'));
        }
        Car::query()->create($data);

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
        return view(self::PATH_VIEW.__FUNCTION__, compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //

        $brands = Brand::query()
        ->where('is_show', true)
        ->latest()
        ->pluck('name', 'id')
        ->all();

        return view(self::PATH_VIEW.__FUNCTION__, compact('car','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
        $request->validate([
            'name' =>'required|max:255',
            'img_thumbnail' =>'nullable|image|max:5000',
            'describe' =>'nullable',
            'brand_id' => [
                'required',
                Rule::exists('brands','id')->where('is_show',true)
            ]


        ]);

        $data = $request->except('img_thumbnail');

        if($request->hasFile('img_thumbnail')){
            $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumbnail'));
        }
        // dd($car);
        $old = $car->img_thumbnail;

        $car->update($data);



        if($request->hasFile('img_thumbnail') || Storage::exists('img_thumbnail')){
            Storage::delete($old);
        }




        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
        $car->delete();
        if(Storage::has('img_thumbnail')){
            Storage::delete('img_thumbnail');
        }
        return back()->with('msg', 'Xóa thành công');
    }
}
