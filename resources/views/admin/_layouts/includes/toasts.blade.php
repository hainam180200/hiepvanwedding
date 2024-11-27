@if(session()->has('success'))
    <script>
        $(function () {
            let msg = '{{session('success')}}';
            toastr.success(msg);
        });
    </script>
@endif
@if(session()->has('error'))
    <script>
        $(function () {
            let msg = '{{session('error')}}';
            toastr.error(msg);
        });
    </script>
@endif
@if(session()->has('warning'))
    <script>
        $(function () {
            let msg = '{{session('warning')}}';
            toastr.warning(msg);
        });
    </script>
@endif