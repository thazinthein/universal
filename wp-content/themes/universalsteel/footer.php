<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
?>

<footer class="footerwrapper">
        <div class="container">
          <div class="row">

            <div class="col-md-10">              
                  <p>Contact Us<br><br>

20 Ang Mo Kio Industrial Park 2A, #01-18/19, AMK Techlink Singapore 567761  Tel : (65) 6253 – 6001 Fax : (65) 6250 – 0071 SERVICE HOT LINE : (65) 6280 – 7333<br>
Copyright© 2015 Universal Steel Industries Pte Ltd. All right reserved
                  </p>                
            </div>
            
            <div class="col-md-2">
              <div class="social">
                <a href="#">  <img src="<?php bloginfo('template_directory');?>/images/facebook.png"> </a>
                <a href="#">  <img src="<?php bloginfo('template_directory');?>/images/google-plus.png"> </a>
                <a href="#">  <img src="<?php bloginfo('template_directory');?>/images/twitter.png"> </a>
              </div>
            </div>

          </div>
        </div>
      </footer>
</div>

	<?php wp_footer(); ?>


<!-- here comes the javascript -->

<!-- jQuery is called via the WordPress-friendly way via functions.php -->

<!-- this is where we put our custom functions -->
<script src="<?php bloginfo('template_directory'); ?>/functions.php"></script>

<script>

</script>

<!-- Asynchronous google analytics; this is the official snippet.
         Replace UA-XXXXXX-XX with your site's ID and domainname.com with your domain, then uncomment to enable.

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-XXXXXX-XX', 'domainname.com');
  ga('send', 'pageview');

</script>
-->

</body>

</html>
