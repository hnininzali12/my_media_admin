@extends('admin.layouts.app')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="col-sm-3 offset-9 mt-2">
                @if (Session::has('deleteSuccess'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('deleteSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="card-header">
                <h3 class="card-title">
                    Admin List
                </h3>

                <div class="card-tools">
                    <form action="{{ route('admin#searchAdminList') }}" method="get">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="adminSearchKey" class="form-control float-right"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark">
                                    <i class="fas fa-search text-warning"></i>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($emptyStatus == 0)
                            <tr>
                                <td colspan="7" class=" text-danger">There is no data.</td>
                            </tr>
                        @else
                            @foreach ($userData as $user)
                                <tr>
                                    <td>{{ $user['id'] }}</td>
                                    <td>
                                        @if ($user['id'] == Auth()->user()->id)
                                            {{ $user['name'] }} <span class="text-bold">(My Account)</span>
                                        @else
                                            {{ $user['name'] }}
                                        @endif
                                    </td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['phone'] }}</td>
                                    <td>{{ $user['gender'] }}</td>
                                    <td>{{ $user['address'] }}</td>
                                    <td>
                                        <a
                                            @if (count($userData) == 1) href="#"
                                    @else
                                         href="{{ route('admin#deleteAcc', $user['id']) }}" @endif>
                                            @if ($user['id'] != auth()->user()->id && count($userData) !== 1)
                                                <button class="btn btn-sm bg-danger text-white"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            @endif
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
