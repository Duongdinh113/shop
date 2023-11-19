@extends('layouts.master');

@section('content')
<a href="{{route('products.create')}}" class="btn btn-success ">add product</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Thumbnail</th>
                <th>Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($data as $item)
            <tr>
            <td>{{$item->id}}</td>
            <td>
                <img src="{{\Storage::url($item->thumbnail)}}" alt="" width="50px">
            </td>
            <td>{{$item->name}}</td>
            <td>{{$item->price}}</td>
            <td>
                @if ($item->status == 'có')
                <i>🟢</i>
                @else
                <i>🔴</i>
                @endif
            </td>
            <td>{{$item->created}}</td>
            <td>
               <form action="{{route('products.destroy',$item->id)}}" method="POST">
                @csrf
                @method('DELETE')

                <a class="btn btn-primary" href="{{route('products.edit',$item->id)}}">Edit</a>
                <a class="btn btn-info " href="{{route('products.show',$item->id)}}">show</a>
                <button class="btn btn-danger " onclick="return confirm('bạn có chắc muốn xóa không')">delete</button>
            </form>
            </td>
        </tr>
            @endforeach

        </tbody>
    </table>
    {{$data->links()}}
@endsection
