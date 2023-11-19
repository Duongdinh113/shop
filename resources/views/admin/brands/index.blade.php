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
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Thêm item</a>
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
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <body>
                                @foreach ($data as $item)
                                    {{-- @dd($item->toArray()) --}}

                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <img src="{{ asset($item->img) }}" alt="" width="50px">
                                        </td>
                                        <td>
                                            @if ($item->is_show == '0')
                                                <span class="">🟤</span>
                                            @else
                                                <span class="">🟢</span>
                                            @endif
                                            {{-- {{ $item->is_show }} --}}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.brands.show', $item) }}" class="btn btn-info">show</a>
                                            <a href="{{ route('admin.brands.edit', $item) }}"
                                                class="btn btn-success">Sửa</a>
                                            <form id="item-{{ $item->id }}"
                                                action="{{ route('admin.brands.delete', $item) }}" method="POST">
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
