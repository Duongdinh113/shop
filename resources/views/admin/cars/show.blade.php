@extends('layouts.master')

@section('content')
<div class="container ">
    <h2>detail car</h2>
    <li>{{ $car->name }}</li>
    <li>{{ $car->brand_id }}</li>
    <li><img width="100px" src="{{ Storage::url($car->img_thumbnail) }}" alt=""></li>
    <li>{{ $car->describe }}</li>
</div>
@endsection

