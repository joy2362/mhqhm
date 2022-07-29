    <script src="{{asset('admin/js/jquery-3.6.0.min.js')}}"></script>
    @vite('resources/js/app.js')
    <script src="{{asset('admin/js/app.js')}}"></script>
    <script src="{{asset('admin/js/custom.js')}}"></script>
    <script src="{{asset('admin/js/datatables.min.js')}}"></script>
    <script src="{{asset('admin/js/toastr.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin/js/additional-methods.min.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        @if(Session::has('status'))
            notification('success','{{Session::get('status')}}')
        @endif

        @if(Session::has('messege'))
            const type = "{{Session::get('alert-type','info')}}";
            notification(type,'{{Session::get('messege')}}')
        @endif

    });
</script>