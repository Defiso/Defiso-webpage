<?php /* Template Name: SEO-Result Page*/ ?>


  <?php get_header(); ?>


    <div class="seo-target">
          
          <img id="loader" src="<?php echo get_template_directory_uri();?>/inc/seoTool/src/img/svg-loaders/puff.svg">
          
          
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
            console.log(data);
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