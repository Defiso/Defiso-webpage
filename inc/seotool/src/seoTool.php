
<?php require_once("seoReport.php"); ?>
<?php require_once("seoAnalyzer.php"); ?>

<?php 

class seoTool{

    public $url;
    public $keywords = array();
    public $email;
    public $seoAnalyzer;
    public $seoReport;
  
   public function __construct(){
     $this->url = isset($_POST["url"]) ? $_POST["url"] : "";
     $this->email = isset($_POST["email"]) ? $_POST["email"] : ""; 
     if(isset($_POST["keywords"])){
       foreach($_POST["keywords"] as $word){
         array_push($this->keywords, $word);
      }
     }
    $this->seoAnalyzer = new seoAnalyzer();
    $this->seoReport = new seoReport();
   }
  
  public function StartAnalyze(){
    $this->seoAnalyzer->webpage = $this->url;
    $this->seoAnalyzer->keywords = $this->keywords;
    
    if($this->seoAnalyzer->Analyze() != false){
      $this->seoReport->Analyze =  $this->seoAnalyzer;
      $this->seoReport->recivierName = "Din SEO-Analys";
      $this->seoReport->recivierEmail = $this->email;
      //$this->seoReport->CreateHTMLReport();
      $this->seoReport->SendReport();
      echo $this->seoReport->finalReport;
    }else{
       $this->ReportFailure();
    }
  }

  
  /* if page not found, send error message */
  public function ReportFailure(){
    echo "<h1> Sidan kunde inte hittas </h1>";
  }

}

?>