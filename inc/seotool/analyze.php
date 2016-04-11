<?php header("Access-Control-Allow-Origin: *"); ?>

<?php include("src/seoTool.php"); ?>
<?php 
    $seoTool = new seoTool();
    $seoTool->StartAnalyze();
?>