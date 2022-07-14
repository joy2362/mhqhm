<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('meta')


<link rel="shortcut icon" href="{{asset('admin/img/icons/icon-48x48.png')}}" />

@yield('title')

<link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
<link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('admin/css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/css/toastr.min.css') }}" rel="stylesheet">
@vite('resources/css/app.css')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
