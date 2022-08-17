<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Media </title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/953e0f59ae.js" crossorigin="anonymous"></script>
    {{-- box icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.2/css/boxicons.min.css"
        integrity="sha512-AGmpdsTqvAh2GvTWzVhhJ9VqQb1eAXwOM7uiWtv0DzcnGaGWy98K51z2cK5OG3gp4NB1HbMaD7p0MeO9kE7E3w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="hold-transition sidebar-mini">
    <div class=" wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <div class="brand-link">
                <i class="fa-solid fa-hashtag text-warning"></i>
                <span class="brand-text font-weight-light">My Media </span>
            </div>
            <div class="brand-link">
                <i class='bx bxs-user-account text-warning'></i>
                <span class="brand-text font-weight-light"> User Name- <span
                        class=" text-warning">{{ Auth()->user()->name }}</span>
                </span>
            </div>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column"data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class='nav-item mb-2'>
                            <a href="{{ route('dashboard') }}" class="nav-link text-light">
                                <i class="fa-solid fa-user text-warning"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class='nav-item mb-2'>
                            <a href="{{ route('admin#list') }}" class="nav-link text-light">
                                <i class="fa-solid fa-users-gear text-warning"></i>
                                <p>Admin List</p>
                            </a>
                        </li>
                        <li class='nav-item mb-2'>
                            <a href="{{ route('admin#category') }}" class="nav-link text-light"><i
                                    class="fas fa-list text-warning"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class='nav-item mb-2'>
                            <a href="{{ route('admin#post') }}" class="nav-link text-light"><i
                                    class="fa-solid fa-newspaper text-warning"></i>
                                <p>Posts</p>
                            </a>
                        </li>
                        <li class='nav-item mb-2'>
                            <a href="{{ route('admin#trend_post') }}" class="nav-link text-light"><i
                                    class="fa-solid fa-arrow-trend-up text-warning"></i>
                                <p>Trend Posts</p>
                            </a>
                        </li>
                        <li class='nav-item mb-2 text-center'>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-secondary text-warning w-100 brand-text"> <i
                                        class="fa-solid fa-arrow-right-from-bracket me-2"></i>Log out</button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row text-secondary mt-4">
                        @yield('content')
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
</body>
<!-- JavaScript Bundle with Popper -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>

</html>
