@extends('layouts.master')

@section('content')
    <h1>
        Thông tin chi tiết Car: {{ $Car->name }}</h1>

    <ul>
        <li>Title: {{ $Car->name }}</li>
        <li>image: <img src="{{ $Car->img }}" alt="" width="200px"></li>
        <li>Status:
            @if ($Car->is_show == '0')
                <span class="">🟤 Hidden</span>
            @else
                <span class="">🟢 Show</span>
            @endif
        </li>
    </ul>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-info mt-3">Trang danh sách</a>
@endsection
