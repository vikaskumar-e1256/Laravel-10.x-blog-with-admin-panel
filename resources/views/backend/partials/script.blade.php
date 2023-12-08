<!-- jQuery 2.2.3 -->
<script src="{{ asset("admin_assets") }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset("admin_assets") }}/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset("admin_assets") }}/dist/js/app.min.js"></script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')
