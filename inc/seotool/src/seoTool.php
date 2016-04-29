<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__.'/seoReport.php');
include(__DIR__.'/seoAnalyzer.php');
include(__DIR__.'/seoHTMLTemplate.php');

class seoTool{
    public $url;
    public $keywords = array();
    public $email;
    public $seoAnalyzer;
    public $seoReport;
  
   public function __construct(){
     $this->url = isset($_POST["url"]) ? $_POST["url"] : "";
     $this->email = isset($_POST["email"]) ? $_POST["email"] : ""; 
     $keywords = isset($_POST["keywords"]) ? explode(" ", $_POST["email"]) : array();
     if($keywords){
       foreach($keywords as $word){
         array_push($this->keywords, $word);
      }
     }
    $this->seoAnalyzer = new seoAnalyzer();
    $this->seoReport = new seoReport();
   }
  
  public function StartAnalyze(){
    $this->seoAnalyzer->webpage = $this->url;
    $this->seoAnalyzer->keywords = $this->keywords;

    if($this->seoAnalyzer->Analyze() != false && (strpos(strtolower($this->url), 'defiso') == false)){
      $this->seoReport->Analyze =  $this->seoAnalyzer;
      //unset($this->seoAnalyzer);
      $this->seoReport->recivierName = "Din SEO-Analys";
      $this->seoReport->recivierEmail = $this->email;
      $this->seoReport->CreateHTMLReport();
      $this->seoReport->SendReport();
      $html = new seoHTMLTemplate();
      $html->analyze =  $this->seoReport->Analyze;
      echo $html->printHTMLReport();
    
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