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
          <img id="loader" src="<?php echo get_template_directory_uri();?>/inc/seoTool/src/img/svg-loaders/puff.svg">
        </div>

      </div>
    </article>
  </main>
</div>

<?php get_footer(); ?>
<script>
  $(document).ready(function () {
    var url = "<?php echo (isset($_POST["url"])) ? $_POST["url"] :"";?>";
    var keywords = "<?php echo (isset($_POST["keywords"])) ? $_POST["keywords"] :"";?>"
    var email = "<?php echo (isset($_POST["email"])) ? $_POST["email"] :"";?>";
    var inputs = {
      "url": url,
      "keywords": keywords,
      "email": email
    };
     $("#loader").css("display", "block");
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
