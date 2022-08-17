@extends('admin.layouts.app')
@section('content')
    <div class="col-5 mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Category Creation
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin#categoryUpdate', $editData['category_id']) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class=" form-control" name="categoryName"
                            value="{{ old('categoryName', $editData['title']) }}" placeholder="Category Name">
                        @error('categoryName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="categoryDescription" placeholder="Description" cols="30" rows="10">{{ old('categoryDescription', $editData['description']) }}</textarea>
                        @error('categoryDescription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-dark text-warning">Update</button>
                        <a href="{{ route('admin#category') }}">
                            <input type="button" value="Create" class="btn btn-danger">
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-7 mt-3">
        @if (Session::has('deleteSuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('deleteSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Category List
                </h3>

                <div class="card-tools">
                    <form action="{{ route('admin#categorySearch') }}" method="post">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="categorySearch" class="form-control float-right"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $item)
                            <tr>
                                <td>{{ $item['category_id'] }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ $item['description'] }}</td>
                                <td>
                                    <a href="{{ route('admin#categoryEdit', $item['category_id']) }}"
                                        class=" text-decoration-none">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#categoryDelete', $item['category_id']) }}">
                                        <button class="btn btn-sm bg-danger text-white"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
