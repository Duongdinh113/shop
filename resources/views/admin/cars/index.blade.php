@extends('layouts.master')

@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Danh sách bài viết</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">Thêm item</a>
        <div class="">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách bài viết</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>name</th>
                                    <th>brand</th>
                                    <th>img_thumbnail</th>
                                    <th>describe</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <body>
                                @foreach ($data as $item)
                                    {{-- @dd($item->toArray()) --}}

                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->brand->id . ' - ' . $item->brand->name}}</td>

                                        <td>
                                            <img src="{{ \Storage::url($item->img_thumbnail) }}" alt="" width="50px">
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.cars.show', $item) }}" class="btn btn-info">show</a>
                                            <a href="{{ route('admin.cars.edit', $item) }}" class="btn btn-success">Sửa</a>
                                            <form id="item-{{ $item->id }}"
                                                action="{{ route('admin.cars.destroy', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="button"
                                                    onclick="
                                                if (confirm('Bạn có chắc chắn không')){
                                                    document.getElementById('item-{{ $item->id }}').submit();
                                                }
                                                ">xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </body>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
