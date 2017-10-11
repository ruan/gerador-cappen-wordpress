<?php get_template_part('templates/layouts/main-footer'); ?>

<?php wp_footer(); ?>

<script>var baseDir = '<?php echo get_template_directory_uri();?>/';</script>
<script>var baseUrl = '<?php echo bloginfo("url");?>/';</script>
<script>var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';</script>

<!-- process:remove:build  -->
<!-- build:js scripts/vendor.js -->
<!-- bower:js -->

<!-- endbower -->
<!-- endbuild -->
<!-- build:js scripts/main.js -->
<!-- fileblock:js app -->

<!-- endfileblock -->
<!-- endbuild -->
<!-- /process -->

<!-- fileblock:js js -->
<!-- endfileblock -->

</body>
</html>
