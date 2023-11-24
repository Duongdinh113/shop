@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        @if (Session::has('msg'))
            <div class="alert alert-success">
                {{ Session::get('msg') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sửa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.cars.update',$car->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="name" name="name" value="{{ $car->name }}">
                        </div>
                        <div class="form-group">
                            <label>Brand_id</label>
                            <select class="form-control" name ="brand_id">
                                @foreach ($brands as $id => $name)
                                    <option value="{{ $id }}" @if ($car->brand_id == $id)
                                    selected
                                    @endif>{{ $id }}.{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Image</label> <br>
                            <input type="file" class="" placeholder="image" name="img_thumbnail"><br>
                            <img style="width: 100px" src="{{ Storage::url($car->img_thumbnail) }}" alt="">
                        </div>
                        <div>
                            <label>Describe</label> <br>
                            <textarea name="describe" id="describe" cols="30" rows="10">{{ $car->describe }}</textarea>
                        </div>
                        <a class="btn btn-primary" href="{{ route('admin.cars.index') }}">back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection

