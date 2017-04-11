<footer id="footer-site">
    <?php  include(locate_template('templates/components/social-media.php')); ?>
    <a href="http://cappen.com/" target="_blank" class="assinatura wow fadeInUp" data-wow-delay="0.8">Site by Cappen</a>
</footer>

<?php wp_footer(); ?>

<!-- process:[src]:build <?=get_template_directory_uri();?>/scripts/ -->
<!-- build:js scripts/vendor.js -->
<!-- bower:js -->

<!-- endbower -->
<!-- endbuild -->
<script>var baseDir = '<?php echo get_template_directory_uri();?>/';</script>
<script>var baseUrl = '<?php echo bloginfo("url");?>/';</script>
<script>var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';</script>
<!-- build:js scripts/main.js -->
<!-- fileblock:js app -->
<script src="scripts/main.js"></script>
<!-- endfileblock -->
<!-- endbuild -->
<!-- /process -->

</body>
</html>
