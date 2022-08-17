@extends('admin.layouts.app')
@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center text-secondary">Change Password</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form class="form-horizontal" method="post" action="{{ route('admin#updatePassword') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">
                                        <i class='bx bx-lock fs-3 text-secondary'></i>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="password" name="oldPassword" class="form-control" id="inputName"
                                            placeholder="Current Password">
                                        @error('oldPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @if (Session::has('fails'))
                                            <div class="text-danger">
                                                <p>{{ Session::get('fails') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">
                                        <i class='bx bx-key fs-3 text-secondary'></i>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="password" name="newPassword" class="form-control" id="inputEmail"
                                            placeholder="New password">
                                        @error('newPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">
                                        <i class='bx bx-key fs-3 text-secondary'></i>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="password" name="confirmPassword" class="form-control" id="inputEmail"
                                            placeholder="Re-type new password">
                                        @error('confirmPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-dark text-warning">Change
                                            Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <a href="{{ route('dashboard') }}">
                    <button class="btn btn-danger">Back</button>
                </a>
            </div>
        </div>
    </div>
@endsection
