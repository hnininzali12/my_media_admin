@extends('admin.layouts.app')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>View Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $item)
                            <tr>
                                <td>{{ $item['post_id'] }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td><img @if ($item['image'] == null) src="{{ asset('defaultImage/default.jpg') }}"
                                    @else
                                        src="{{ asset('postImage/' . $item['image']) }}" @endif
                                        width="150px" class=" img-thumbnail rounded"></td>
                                <td><i class="fa-solid fa-eye"></i><span>{{ $item['post_count'] }}</span></td>
                                <td>
                                    <a href="{{ route('admin#detailsTrendPost', $item['post_id']) }}"><button
                                            class="btn btn-sm bg-warning text-black"><i
                                                class="fa-solid fa-file-lines"></i></button></a>
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
