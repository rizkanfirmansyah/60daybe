<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard layouts based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <link rel="shortcut icon" href="/assets/images/logo.png" type="image/x-icon">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, layouts, responsive, css, sass, html, theme, front-end, ui kit, web">
    <meta name="csrf-token" data-token="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Regalia Dashboard</title>

    @include('includes.style')

    @stack('style')
    <link rel="stylesheet" href="/assets/css/pages/page.css">

</head>

<body>
    <div class="wrapper">

        @include('layouts.sidebar')

        <div class="main">

            @include('layouts.navbar')

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="d-flex justify-content-between">
                        <h1 class="h3">{{ $title }}</h1>
                        <div class="">
                            <button class="btn" disabled id="addData"><i class="align-middle"
                                    data-feather="plus"></i>
                                <span class="align-middle"> Tambah Data</span></button>
                            <button class="btn" disabled id="deleteData"><i class="align-middle"
                                    data-feather="trash"></i> <span class="align-middle"> Hapus Data</span></button>
                        </div>
                    </div>

                    <ul class="nav my-3" id="content-parameter">
                        <li class="nav-item text-center w-25 d-none" id="allTabList">
                            <a class="nav-link text-dark text-bold active" aria-current="page" href="#">All (<span id="allTab">0</span>)</a>
                        </li>
                        <li class="nav-item text-center w-25 d-none" id="activeTabList">
                            <a class="nav-link text-dark text-bold" href="#">Active (<span id="activeTab">0</span>)</a>
                        </li>
                        <li class="nav-item text-center w-25 d-none" id="inactiveTabList">
                            <a class="nav-link text-dark text-bold" href="#">Inactive (<span id="inactiveTab">0</span>)</a>
                        </li>
                        <li class="nav-item text-center w-25 d-none" id="trashTabList">
                            <a class="nav-link text-dark text-bold" href="#">Trash (<span id="trashTab">0</span>)</a>
                        </li>
                    </ul>
                    @yield('content')
                </div>
            </main>

            @include('layouts.footer')
        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalEvent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEventLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEventLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @stack('modal')
                </div>
            </div>
        </div>
    </div>

    @stack('another-modal')

    @include('includes.script')

    <script src="/assets/js/services/service-helper.js"></script>
    <script src="/assets/js/services/service-crud.js"></script>
    <script src="/assets/js/event/script.js"></script>

    @stack('script')

</body>


</html>
