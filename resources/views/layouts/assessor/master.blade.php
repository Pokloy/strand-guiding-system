<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="{{ asset('assets/img/Logo/icon.ico') }}" rel="shortcut icon" type="image/x-icon" />
        <title>StrandGuide | @yield('title')</title>
        <!-- Favicon-->
        <!-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> -->
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/manual.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/sidebar/css/styles.css') }}">

        <!-- datatables -->
        <link rel="stylesheet" href="{{ asset('assets/DataTables/css/dataTables.bootstrap4.min.css') }}">
        @yield('page_styles')
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">
                    <span class="text-primary font-weight-bold">ACT</span><span class="text-secondary">StrandGuide</span>
                </div>
                <div class="list-group list-group-flush">
                    {{-- <a class="list-group-item p-3 text-center" href="#" style="text-decoration: none">
                        <span class="ml-2 font-weight-bold text-primary">Admin Panel</span>
                    </a> --}}
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->is('home') ? 'active_item' : '' }}" href="{{ route('home.load') }}">
                        <i class="fas fa-home {{ request()->is('home') ? 'text-dark' : 'text-secondary' }}"></i>
                        <span class="ml-2 {{ request()->is('home') ? 'text-dark' : 'text-secondary' }}">Home</span>
                    </a>

                    <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->is('strands') || request()->is('view-strand/*') ? 'active_item' : '' }}" href="{{ route('strand.load') }}">
                        <i class="fas fa-book {{ request()->is('strands') || request()->is('view-strand/*') ? 'text-dark' : 'text-secondary' }}"></i>
                        <span class="ml-2 {{ request()->is('strands') || request()->is('view-strand/*') ? 'text-dark' : 'text-secondary' }}">Strands</span>
                    </a>
                    @if(Session::get('utype') == "admin")
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->is('users') ? 'active_item' : '' }}" href="{{ route('users.load') }}">
                        <i class="fas fa-users {{ request()->is('users') ? 'text-dark' : 'text-secondary' }}"></i>
                        <span class="ml-2 {{ request()->is('users') ? 'text-dark' : 'text-secondary' }}">Users</span>
                    </a>
                    @endif
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->is('account-settings') || request()->is('security-settings') ? 'active_item' : '' }}" href="{{ route('account.settings.load') }}">
                        <i class="fas fa-cog {{ request()->is('account-settings') || request()->is('security-settings') ? 'text-dark' : 'text-secondary' }}"></i>
                        <span class="ml-2 {{ request()->is('account-settings') || request()->is('security-settings') ? 'text-dark' : 'text-secondary' }}">Settings</span>
                    </a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#" data-toggle="modal" data-target="#loginModal">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="ml-2">Logout</span>
                    </a>
                    <!-- <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">User Story</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Iteration</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Department</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Overview</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Events</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Profile</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Status</a> -->
                </div>
            </div>
            <!-- Page content wrapper-->
            @php

                use App\Models\UserModel;
                
                $user_id = Session::get('user_id');
                $current_user = UserModel::where('user_id', $user_id)->first();

            @endphp
            <div id="page-content-wrapper" style="background-color: #f7f7f7">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-default" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> --}}
                        <span class="ml-3 font-weight-bold text-primary">{{ Session::get('utype') == "admin" ? "Admin" : "Staff" }}</span>
                        <span class="mx-3 text-secondary">|</span>
                        <span>
                            @if(Session::get('utype') == "admin")
                                <i class="fas fa-user-shield"></i>
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                            &nbsp;&nbsp;<span onclick="goToSettings()" title="Go to Account Settings" class="underline_text">{{ $current_user->fname." ".$current_user->lname }}</span>
                        </span>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            {{-- <ul class="navbar-nav ms-auto mt-2 mt-lg-0 mx-4">
                                <li class="nav-item active"><a class="nav-link" href="#!"></a></li>
                                <li class="nav-item"><a class="nav-links" href="#!">Link</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cariel Jay Apao</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!">Action</a>
                                        <a class="dropdown-item" href="#!">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal">Logout</a>
                                    </div>
                                </li>
                            </ul> --}}
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid">
                    @yield('page_content')
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Confirm Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('logout_user') }}" method="post">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/bootstrap/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/popper.js') }}"></script>

        <!-- popover libraries -->
        <script src="{{ asset('assets/popover/bootstrap.bundle.min.js') }}"></script>

        <!-- datatable -->
        <script src="{{ asset('assets/DataTables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/DataTables/js/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Core theme JS-->
        <script src="{{ asset('assets/sidebar/js/scripts.js') }}"></script>

        <script>
            function goToSettings()
            {
                window.location = "{{ route('account.settings.load') }}";
            }
        </script>
        
        @yield('page_scripts')
    </body>
</html>