@extends('admin.layouts.app')
@section('content')
    <div class="col-lg-5 col-sm-12 mt-3">
        @if (Session::has('createSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('createSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Category Creation
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin#categoryCreate') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="categoryName" placeholder="Category Name" class=" form-control">
                        @error('categoryName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="categoryDescription" placeholder="Description" class="form-control" cols="30" rows="10"></textarea>
                        @error('categoryDescription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-dark text-warning">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-sm-12 mt-3">
        @if (Session::has('updateSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('updateSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
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
                        @if ($emptyStatus == 0)
                            <tr>
                                <td colspan="4" class="text-danger">There is no data.</td>
                            </tr>
                        @else
                            @foreach ($category as $item)
                                <tr>
                                    <td>{{ $item['category_id'] }}</td>
                                    <td>{{ $item['title'] }}</td>
                                    <td>{{ $item['description'] }}</td>
                                    <td>
                                        <a href="{{ route('admin#categoryEdit', $item['category_id']) }}"
                                            class=" text-decoration-none">
                                            <button class="btn btn-sm bg-dark text-white"><i
                                                    class="fas fa-edit"></i></button>
                                        </a>
                                        <a href="{{ route('admin#categoryDelete', $item['category_id']) }}">
                                            <button class="btn btn-sm bg-danger text-white"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
