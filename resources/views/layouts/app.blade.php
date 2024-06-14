<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.png') }}" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

</head>

<body>
    <main>
        @yield('content')
    </main>




    <script src="{{ URL::asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>

    <script src="{{ URL::asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ URL::asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ URL::asset('assets/js/misc.js') }}"></script>
    <script src="{{ URL::asset('assets/js/settings.js') }}"></script>
    <script src="{{ URL::asset('assets/js/todolist.js') }}"></script>

    <script src="{{ URL::asset('assets/js/file-upload.js') }}"></script>
    <script src="{{ URL::asset('assets/js/typeahead.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>








</body>

</html>
