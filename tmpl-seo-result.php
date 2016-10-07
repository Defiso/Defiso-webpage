<?php /* Template Name: SEO-Result Page*/ ?>


<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php get_template_part( 'template-parts/elements/element', 'jumbotron' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">

        <div class="seo-target">
					<div id="loader">
						<img src="<?php echo get_template_directory_uri();?>/inc/seoTool/src/img/svg-loaders/puff.svg">
						<h3 id="timeLeft">Snart klar</h3>
						<h2>Analyserar din hemsida</h2>
					</div>
        </div>

				<div class="modal" id="modal-opener">
		      <input class="modal-state" id="seo-modal" type="checkbox">
		      <div class="modal-fade-screen">
		        <div class="modal-inner">
		          <div class="modal-close" for="seo-modal"></div>
							<div class="modal-image">
								<img src="<?php echo get_template_directory_uri(); ?>/illustrations/moon-landing.svg" alt="Månlandning">
							</div>
							<div class="modal-form">
								<h2>Vill du öka din synlighet på Google och andra sökmotorer? Låt oss kontakta dig!</h2>
								<?php echo do_shortcode('[contact-form-7 id="279" title="CTA formulär, leads för telefonnummer"]'); ?>
							</div>
		        </div>
		      </div>
		    </div>

				<div class="contact-cta">
					<div class="inner">
						<div class="header">
							<h3>Vill du förbättra din närvaro på nätet? Kontakta oss!</h3>
						</div>
						<?php echo do_shortcode('[contact-form-7 id="279" title="CTA formulär, leads för telefonnummer"]'); ?>
					</div>
				</div>

      </div>
    </article>
  </main>
</div>

<?php get_footer(); ?>
<script>
  $(document).ready(function () {
    var url = "<?php echo (isset($_POST["url"])) ? $_POST["url"] :"";?>";
    var keywords = "<?php echo (isset($_POST["keywords"])) ? $_POST["keywords"] :"";?>";
    var email = "<?php echo (isset($_POST["email"])) ? $_POST["email"] :"";?>";
    var inputs = {
      "url": url,
      "keywords": keywords,
      "email": email
    };
		var loader = $("#loader");
		var timeLeft = $("#timeLeft");

    loader.css("display", "block");
		setTimeout(function(){
		  timeLeft.text('Vänta lite till');
		}, 5000);

	 $.ajax({
      method: "POST",
      url: "<?php echo get_template_directory_uri();?>/inc/seoTool/analyze.php",
      data: inputs,
      success: function (data){
        $("#loader").hide();
        $(".seo-target").html(data);
      },
      error: function (xhr, status, error){
        console.log(error);
        console.log(status);
        $("#loader").hide();
      },
      complete: function (data) {}
    })

		// SEO modal
	  var triggeredModalOnce = false

	  if (!triggeredModalOnce) {
	    $(window).scroll(openModal);
	  }

	  function openModal() {
	    console.log(triggeredModalOnce);
	    if ( ($('#modal-opener').isOnScreen() == true ) && (!triggeredModalOnce) ) {
	      $("body").addClass("modal-open");
	      $('#seo-modal').prop('checked', true);
	      triggeredModalOnce = true;
	    }
	  }

	  $('#seo-modal').on('change', function() {
	    if ($(this).is(':checked')) {
	      $('body').addClass('modal-open');
	    } else {
	      $('body').removeClass('modal-open');
	    }
	  });

	  $('.modal-fade-screen, .modal-close').on('click', function() {
	    $('.modal-state:checked').prop('checked', false).change();
	  });

	  $('.modal-inner').on('click', function(e) {
	    console.log('clickededd');
	    e.stopPropagation();
	  });

	  $.fn.isOnScreen = function(){
	    var win = $(window);
	    var viewport = {
	      top : win.scrollTop(),
	      left : win.scrollLeft()
	    };
	    viewport.right = viewport.left + win.width();
	    viewport.bottom = viewport.top + win.height();
	    var bounds = this.offset();
	    bounds.right = bounds.left + this.outerWidth();
	    bounds.bottom = bounds.top + this.outerHeight();
	    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
	  };
  });
</script>
