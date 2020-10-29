<footer>
  <div class="container">
    <div class="footer-widget">
      <?php dynamic_sidebar('footer'); ?>
    </div>
    <p>Copyright &copy;<?php bloginfo('name') ?> All Rights Reserved</p>
    <div class="footer-widget">
      <?php dynamic_sidebar('footer-bottom'); ?>
    </div>
  </div>
</footer>
<!--スクロールトップへ-->
<div class="scroll-top">
  <div class="scroll-top-icon"><i class="fas fa-chevron-up"></i></div>
</div>
<div class="drawer drawer--right menu-res-box">
  <button type="button" class="drawer-toggle drawer-hamburger">
    <span class="sr-only">toggle navigation</span>
    <span class="drawer-hamburger-icon"></span>
  </button>
  <nav class="drawer-nav">
    <?php wp_nav_menu(array('menu'=>'navigation','menu_class'=>'drawer-menu menu-res','container'=> false,)); ?>
  </nav>
</div>
<?php wp_footer(); ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>

<script src="https://kit.fontawesome.com/1f08502233.js" crossorigin="anonymous"></script>
</body>

</html>
