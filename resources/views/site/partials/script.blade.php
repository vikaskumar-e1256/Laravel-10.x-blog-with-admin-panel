<!-- jQuery -->
<script src="{{ asset('site_assets') }}/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('site_assets') }}/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="{{ asset('site_assets') }}/js/jqBootstrapValidation.js"></script>
<script src="{{ asset('site_assets') }}/js/contact_me.js"></script>

<!-- Theme JavaScript -->
<script src="{{ asset('site_assets') }}/js/clean-blog.min.js"></script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@stack('scripts')
