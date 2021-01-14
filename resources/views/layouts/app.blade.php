<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css">

    <style>
        .result-set {
            margin-top: 1em
        }
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = {
            !!json_encode([
                'csrfToken' => csrf_token(),
            ]) !!
        };
    </script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ route('home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::check())
                        @can('view_users')
                        <li class="{{ Request::is('users*') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}">
                                <span class="text-info glyphicon glyphicon-user"></span> Users
                            </a>
                        </li>
                        @endcan

                        @can('view_posts')
                        <li class="{{ Request::is('posts*') ? 'active' : '' }}">
                            <a href="{{ route('posts.index') }}">
                                <span class="text-success glyphicon glyphicon-text-background"></span> Posts
                            </a>
                        </li>
                        @endcan
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                        <li class="nav-item">
                            <a href="/pos_device" class="nav-link">POS Devices</a>
                        </li>
                        <li class="nav-item">
                            <a href="/fastlink_number" class="nav-link">Fastlink Numbers</a>
                        </li>
                        <li class="nav-item">
                            <a href="/requisition" class="nav-link">Requisition</a>
                        </li>
                        @can('view_roles')
                        <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                            <a href="{{ route('roles.index') }}">
                                <span class="text-danger glyphicon glyphicon-lock"></span> Roles
                            </a>
                        </li>
                        @endcan

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false">
                                {{ Auth::user()->name }}
                                <span
                                    class="label label-success">{{ Auth::user()->roles->pluck('name')->first() }}</span>
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="glyphicon glyphicon-log-out"></i> Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div id="flash-msg">
                @include('flash::message')
            </div>
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

    <script>
        $(function () {
            // flash auto hide
            $('#flash-msg .alert').not('.alert-danger, .alert-important').delay(6000).slideUp(500);
        })
    </script>
</body>
<!-- bulk added for riqiuisition  -->
<script type="text/javascript">
    var i = 1;
    $("body").on("click", ".add", function () {

        var html = $("tr").last().clone();
        html.find('.subdisid').attr({
            name: 'addmore[' + i + '][sub_distributors_id]'
        });
        html.find('.sales_rep_id').attr({
            name: 'addmore[' + i + '][sales_rep_id]'
        }).val('');
        html.find('.dealer_id').attr({
            name: 'addmore[' + i + '][dealer_id]'
        }).val('');
        html.find('.type').attr({
            name: 'addmore[' + i + '][type]'
        }).val('');
        html.find('.status').attr({
            name: 'addmore[' + i + '][status]'
        }).val('');
        html.find('.remarks').attr({
            name: 'addmore[' + i + '][remarks]'
        }).val('');
        $("tr").last().after(html);

        i++;
        $(this).closest('tr').after(html);
        $('input[type="button"]', html).removeClass('add').addClass(
            'btn btn-danger RemoveRow').val('-');
    });
    $('table').on('click', '.RemoveRow', function () {
        $(this).closest('tr').remove();
    });

</script>

<!-- datepicker script input click -->
<script type="text/javascript">
    $(document).ready(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });

    //for hiding the alerts after few seconds
    setTimeout(function () {
        $('.alert').fadeOut('fast');
    }, 5000);

</script>
<script>
    // display a modal (medium modal)
    $(document).on('click', '#mediumButton', function (event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function () {
                $('#loader').show();
            },
            // return the result
            success: function (result) {
                $('#mediumModal').modal("show");
                $('#mediumBody').html(result).show();
                //datepicker js code inside model
                $("#date-picker").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd'
                });
            },
            complete: function () {
                $('#loader').hide();
            },
            error: function (jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        });

    });

    //uploading a file ajax code
    $(document).on('submit', '#FileUploadForm', function (event) {
        event.preventDefault();
        let href = $(this).attr('action');
        var data = new FormData($('#FileUploadForm')[0]);
        $.ajax({
            url: href,
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            dataType: "json",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
            },
            beforeSend: function () {
                $('#response').html('<span class="text-primary">Loading response...</span>');
            },
            success: function (data) {
                if (data.code == '422') {
                    errors = data.error;
                    $("#accstatus").html(errors.acc_status);
                    $("#accdocument").html(errors.acc_document);
                    $("#response").remove();
                }
                if (data.code == '200') {
                    $("#accstatus").remove();
                    $("#accdocument").remove();
                    $("#response").remove();
                    $("#smthgFound").remove();
                    $("#nothingFound").remove();
                    $("#successAlert").html('<div class="alert alert-success">' + data.status +
                        '</div>');

                    var value = data.value;
                    // $("#acc_status" + data.id).html(value.acc_status);
                    // $("#acc_document" + data.id).html(value.acc_document);
                    // $("#requestList").html(value);
                }
            },
            error: function (jqXHR, testStatus, error) {
                alert("Page " + href + " cannot open. Error:" + error);
            },
            timeout: 8000
        });
    });

</script>
</html>