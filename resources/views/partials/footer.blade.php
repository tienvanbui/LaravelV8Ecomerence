
   <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('/css/admin/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/js/admin/js/app-style-switcher.js')}}"></script>
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="{{asset('/js/admin/js/waves.js')}}"></script>
     <script>
         CKEDITOR.replace('ckeditor');
        //  ckeditor of product
         CKEDITOR.replace('ckeditor_product_add');
         CKEDITOR.replace('ckeditor_product_edit');
        //  ckeditor of blog
         CKEDITOR.replace('ckeditor_blog_add');
         CKEDITOR.replace('ckeditor_blog_edit');
        // ckeditor of banner 
        CKEDITOR.replace('ckeditor_banner_add');
        CKEDITOR.replace('ckeditor_banner_edit');
        // ckeditor of slider
        CKEDITOR.replace('ckeditor_slider_create');
        CKEDITOR.replace('ckeditor_slider_edit');
        // ckeditor of user role
        CKEDITOR.replace('ckeditor_user_role_create');
        CKEDITOR.replace('ckeditor_user_role_edit');
        CKEDITOR.replace('ckeditor_user_role_show');
        // ckeditor of about
        CKEDITOR.replace('ckeditor_about_create');
        CKEDITOR.replace('ckeditor_about_quote_create');
        CKEDITOR.replace('ckeditor_about_edit');
        CKEDITOR.replace('ckeditor_about_quote_edit');

     </script>
    <!--Menu sidebar -->
    <script src="{{asset('/js/admin/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('/js/admin/js/custom.js')}}"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="{{asset('/plugins/bower_components/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{asset('/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{asset('/js/admin/js/pages/dashboards/dashboard1.js')}}"></script>
    @yield('js')
</body>
    
</html>