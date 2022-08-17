@extends('admin.layouts.app')
@section('content')
    <div class="col-12">
        <i class="fa-solid fa-arrow-left fs-4" onclick="history.back()"></i>
        <div class="card">
            <div class="card-header">
                <div class="text-center">
                    <h4>Post Title - {{ $post['title'] }}</h4>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body mt-3 table-responsive p-0">
                <div class="text-center">
                    <img style="width: 300px"
                        @if ($post['image'] == null) src="{{ asset('defaultImage/default.jpg') }}"
                    @else
                     src="{{ asset('postImage/' . $post['image']) }}" @endif>
                </div>
                <div class="m-5">
                    <strong>Description</strong>
                    <p class="my-3">{{ $post['description'] }}</p>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
