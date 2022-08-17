@extends('admin.layouts.app')
@section('content')
    <div class="col-lg-5 col-sm-12 mt-3">
        @if (Session::has('updateSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('updateSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Post Edition
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin#postUpdate', $postData['post_id']) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Post Title</label>
                        <input type="text" name="postTitle" value="{{ old('postTitle', $postData['title']) }}"
                            placeholder="Post Title" class=" form-control">
                        @error('postTitle')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="postDescription" placeholder="Description" class="form-control" cols="30" rows="10">{{ old('postDescription', $postData['description']) }}</textarea>
                        @error('postDescription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Post Image</label>
                        <img @if ($postData['image'] == null) src="{{ asset('defaultImage/default.jpg') }}"
                        @else
                            src="{{ asset('postImage/' . $postData['image']) }}" @endif
                            width="100%" class="rounded shadow">
                        <input type="file" name="postImage" placeholder="Post Title" class="mt-2 form-control">
                        @error('postImage')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Category options</label>
                        <select name="postCategory" class="form-control">
                            <option value="">Choose category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item['category_id'] }}"
                                    @if ($item['category_id'] == $postData['category_id']) selected @endif>
                                    {{ $item['title'] }}</option>
                            @endforeach
                        </select>
                        @error('postTitle')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-dark text-warning">Update</button>
                        {{-- <a href="{{ route('admin#postCreate') }}"><input type="button" value="Create"
                                class="btn btn-danger"></a> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-sm-12 mt-3">
        @if (Session::has('deleteSuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('deleteSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Post
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
                            <th>Post Title</th>
                            <th>Image</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if ($emptyStatus == 0)
                            <tr>
                                <td colspan="4" class="text-danger">There is no data.</td>
                            </tr>
                        @else --}}
                        @foreach ($post as $item)
                            <tr>
                                <td>{{ $item['post_id'] }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>
                                    <img @if ($item['image'] == null) src="{{ asset('defaultImage/default.jpg') }}"
                                    @else
                                        src="{{ asset('postImage/' . $item['image']) }}" @endif
                                        width="150px" class=" img-thumbnail rounded">
                                </td>
                                <td>
                                    <a href="{{ route('admin#postEdit', $item['post_id']) }}"
                                        class=" text-decoration-none">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#postDelete', $item['post_id']) }}">
                                        <button class="btn btn-sm bg-danger text-white"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        {{-- @endif --}}
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
