@extends('layouts.master')

@section('content')
    <h1>Form tạo mới Post</h1>

    @if(\Session::has('msg'))
        <div class="alert alert-success">
            {{ \Session::get('msg') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="image">Thumbnail</label>
        <input type="file" class="form-control" name="thumbnail" id="title">

        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="title">

        <label for="price">Price</label>
        <input type="text" class="form-control" name="price" id="title">



        <label for="status" class="mt-3">Status</label> <br>

        <input type="radio" name="status" id="status-1" value="{{ \App\Models\Product::STATUS_YES }}">
        <label for="status-1">Có</label>

        <input type="radio" name="status" id="status-2" value="{{ \App\Models\Product::STATUS_NO}}">
        <label for="status-2">không</label><br>

        <label for="created">Created</label>
        <input type="text" class="form-control" name="created" id="title">

        <br>
        <a href="{{ route('products.index') }}" class="btn btn-info mt-3">Trang danh sách</a>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
@endsection
