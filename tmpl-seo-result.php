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
								<h2>Vill du öka din synlighet på Google och andra sökmotorer? Kontakta oss!</h2>
								<form>
									<input type="text" name="name" placeholder="Namn">
									<input type="text" name="name" placeholder="Telefonnummer">
									<button type="button" name="button">Skicka</button>
								</form>
							</div>
		        </div>
		      </div>
		    </div>

				<div class="contact-cta">
					<div class="inner">
						<div class="header">
							<h3>Vill du förbättra din närvaro på nätet? Kontakta oss!</h3>
						</div>
						<form>
							<input type="text" name="name" placeholder="Namn">
							<input type="text" name="name" placeholder="Telefonnummer">
							<button type="button" name="button">Skicka</button>
						</form>
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
  });
</script>
