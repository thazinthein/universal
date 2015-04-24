<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
?>

     <div class="footerwrapper">
        <div class="container">
          <div class="row">

            <div class="col-xs-10">              
                  <p>Contact Us<br><br>
20 Ang Mo Kio Industrial Park 2A, #01-18/19, AMK Techlink Singapore 567761  Tel : (65) 6253 – 6001 Fax : (65) 6250 – 0071 SERVICE HOT LINE : (65) 6280 – 7333<br>
Copyright© 2015 Universal Steel Industries Pte Ltd. All right reserved
                  </p>                
            </div>
            
            <div class="col-xs-2">
              <div class="social">
                <a href="#">  <img src="<?php bloginfo('template_directory');?>/images/facebook.png"> </a>
                <a href="#">  <img src="<?php bloginfo('template_directory');?>/images/google-plus.png"> </a>
                <a href="#">  <img src="<?php bloginfo('template_directory');?>/images/twitter.png"> </a>
              </div>
            </div>

          </div>
        </div>
      </div>
</div>

	<?php wp_footer(); ?>


<!-- here comes the javascript -->

<!-- jQuery is called via the WordPress-friendly way via functions.php -->

<!-- this is where we put our custom functions -->

<script src="<?php bloginfo('template_directory'); ?>/functions.php"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"><\/script>');</script>
<script src="<?php bloginfo('template_directory'); ?>/js/modernizr.min.js"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<script type='text/javascript'>//<![CDATA[ 

  $(document).ready(function () {
        // number of records per page
        var pageSize = 8;
        // reset current page counter on load
        $("#hdnActivePage").val(1);
        // calculate number of pages
        var numberOfPages = $('table tr').length / pageSize;
        numberOfPages = numberOfPages.toFixed();
        // action on 'next' click
        $("a.next").on('click', function () {
            // show only the necessary rows based upon activePage and Pagesize
            $("table tr:nth-child(-n+" + (($("#hdnActivePage").val() * pageSize) + pageSize) + ")").show();
            $("table tr:nth-child(-n+" + $("#hdnActivePage").val() * pageSize + ")").hide();
            var currentPage = Number($("#hdnActivePage").val());
            // update activepage
            $("#hdnActivePage").val(Number($("#hdnActivePage").val()) + 1);
            // check if previous page button is necessary (not on first page)
            if ($("#hdnActivePage").val() != "1") {
                $("a.previous").show();
                $("span").show();
            }
            // check if next page button is necessary (not on last page)
            if ($("#hdnActivePage").val() == numberOfPages) {
                $("a.next").hide();
                $("span").hide();
            }
        });
        // action on 'previous' click
        $("a.previous").on('click', function () {
            var currentPage = Number($("#hdnActivePage").val());
            $("#hdnActivePage").val(currentPage - 1);
            // first hide all rows
            $("table tr").hide();
            // and only turn on visibility on necessary rows
            $("table tr:nth-child(-n+" + ($("#hdnActivePage").val() * pageSize) + ")").show();
            $("table tr:nth-child(-n+" + (($("#hdnActivePage").val() * pageSize) - pageSize) + ")").hide();
            // check if previous button is necessary (not on first page)
            if ($("#hdnActivePage").val() == "1") {
                $("a.previous").hide();
                $("span").hide();
            } 
            // check if next button is necessary (not on last page)
            if ($("#hdnActivePage").val() < numberOfPages) {
                $("a.next").show();
                $("span").show();
            } 
            if ($("#hdnActivePage").val() == 1) {
                $("span").hide();
            }
        });
    });    
//]]>  

</script>
<script>
$('#target').click(function() {
   localStorage.setItem('counter', ++counter);
    $('#output').html(function(i, val) { return val*1+1 });
});
</script>

<script>


$('table.paginated').each(function() {
    var currentPage = 0;
    var numPerPage = 5;
    var $table = $(this);
    $table.bind('repaginate', function() {
        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
    });
    $table.trigger('repaginate');
    var numRows = $table.find('tbody tr').length;
    var numPages = Math.ceil(numRows / numPerPage);
    var $pager = $('<div class="pager"></div>');
    var $previous = $('<span class="previous"><<</spnan>');
    var $next = $('<span class="next">>></spnan>');
    for (var page = 0; page < numPages; page++) {
        $('<span class="page-number"></span>').text(page + 1).bind('click', {
            newPage: page
        }, function(event) {
            currentPage = event.data['newPage'];
            $table.trigger('repaginate');
            $(this).addClass('active').siblings().removeClass('active');
        }).appendTo($pager).addClass('clickable');
    }
    $pager.insertBefore($table).find('span.page-number:first').addClass('active');
    $previous.insertBefore('span.page-number:first');
    $next.insertAfter('span.page-number:last');
});
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
