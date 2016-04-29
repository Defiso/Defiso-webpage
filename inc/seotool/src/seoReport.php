
<?php require('phpmailer/PHPMailerAutoload.php')?>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class seoReport{
  
  public $Analyze;
  public $subject = 'Här är din SEO-Analys';
  public $senderEmail = 'info@limeloop.se';
  public $senderName = 'Limeloop';
  public $recivierEmail;
  public $recivierName = 'Seorapport';
  public $mailObject;
  public $finalReport;
  
 
  private function SetMailSettings(){
    $this->mailObject->isSMTP();                               // Set mailer to use SMTP
    $this->mailObject->Host = 'mail.citynetwork.se';         // Specify main and backup SMTP servers
    $this->mailObject->SMTPAuth = true;                               // Enable SMTP authentication
    $this->mailObject->Username = 'jonas@limeloop.se';                 // SMTP username
    $this->mailObject->Password = 'jonas000';                           // SMTP password
    $this->mailObject->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $this->mailObject->Port = 587;                                    // TCP port to connect to
    $this->mailObject->isHTML(true);                                  // Set email format to HTML
    $this->mailObject->CharSet = 'UTF-8';
  }
  
  /* Sends the report */
  public function SendReport(){
    $this->mailObject = new PHPMailer();
    $this->SetMailSettings(); 
    $this->mailObject->Subject = $this->subject;
    $this->mailObject->Body = "Mail";
    $this->mailObject->MsgHTML( $this->CreateHTMLReport());
    
   // $this->mailObject->AddStringAttachment($this->CreateReportPDF(), 'seorapport', 'base64', 'application/pdf');
    $this->mailObject->IsHTML(true);  
    $this->mailObject->From = $this->senderEmail;
    $this->mailObject->FromName = $this->senderName;
    $this->mailObject->addAddress($this->recivierEmail, $this->recivierName);     // Add a recipient
    $this->mailObject->addReplyTo($this->senderEmail, 'Replyto: ');
    
    if(!$this->mailObject->send()) {
      $callback['success'] = false;
    } else {
      $callback['success'] = true; 
    }
    //unset($this->mailObject);
    //unset($this->finalReport);
  }
    
  private function CreateEmail(){
    return '<h1> Ett Email med SEO rapport!</h1>';  
  }
  
  /* Create a HTML version of the report */
  public function  CreateReportPDF(){
        $mpdf = new mPDF(); 
        $mpdf->allow_output_buffering = true;
      //  $stylesheet = file_get_contents('report-header.html');
       // $stylesheet = file_get_contents('chartcss.css');
      //  $mpdf->WriteHTML($stylesheet, 1);
      //  $mpdf->myvariable = file_get_contents('check.png');


        $mpdf->WriteHTML($this->CreateHTMLReport());
        $mpdf->showImageErrors = true;
        return $mpdf->Output('', 'S');
    //    $mpdf->Output(" ","S");

        
  }
    
  
    public function CreateHTMLReport(){
      
      $okMessage = "Allt ser bra ut!";
      $errorMessage = " fel.";
      $okImage = __DIR__."/img/check.png";
      $errorImage = __DIR__."/img/cross.png";
      $logo = __DIR__."/img/logo.png";
      $keywordString = ($this->Analyze->multipleKeywords) ? "Sökorden" : "Sökord";
      
      /* Dynamic parameters */
      
      
      
      /* Header */
      
      $url = $this->Analyze->orignalName;
      $keywords = $this->Analyze->keywordsInSentence;
      $loadingResult = ($this->Analyze->timeToLoadPage < 3) ? 'Bra!' : 'Dålig';
      $domainAge = ($this->Analyze->ageOfDomainYears != "Okänt" ) ? $this->Analyze->ageOfDomainYears ."år ". $this->Analyze->ageOfDomainDays ."d" : "Okänt";
      $domainAge = ($this->Analyze->ageOfDomainYears == "Okänt" &&  $this->Analyze->ageOfDomainDays > 0 ) ?  $this->Analyze->ageOfDomainDays ."d"  : $domainAge;
      $mobileFriendly = ($this->Analyze->webpageIsResponsive) ? 'Ja!' : 'Nej';
      $mobileScore =  $this->Analyze->webpageIsResponsiveScore ."/100";
      $CMS = $this->Analyze->currentCMS;
      
      /* Title */
      $titlePass["image"] = ($this->Analyze->titleErrorCount == 0) ? $okImage : $errorImage;
      $titlePass["message"] = ($this->Analyze->titleErrorCount == 0) ? $okMessage : $errorMessage;
      $titlePass["error"] = ($this->Analyze->titleErrorCount == 0) ? "" : $this->Analyze->titleErrorCount;
      
      $titleContainKeyword["image"] = ($this->Analyze->keywordsAppearsInTitle) ? $okImage : $errorImage;
      $titleContainKeyword["message"] = ($this->Analyze->keywordsAppearsInTitle) ? "Titeln innehåller det angivna sökordet" : "Titeln innehåller inte det angivna sökordet"; 
      $titleContainKeyword["image"] = ($this->Analyze->keywordsAppearsMoreThanTwice) ? $errorImage : $titleContainKeyword["image"];
      $titleContainKeyword["message"] = ($this->Analyze->keywordsAppearsMoreThanTwice) ? "Titeln innehåller sökordet mer än två gånger och riskerar att uppfattas som spammig." : $titleContainKeyword["message"];
      
      
      $titleNotToLong["image"] = ($this->Analyze->titleIsOk) ? $okImage : $errorImage;
      
      $titleNotToLong["message"] = ($this->Analyze->titleIsToShort) ? "Titeln är för kort. Man bör utnyttja det tillgängliga utrymmet maximalt och göra sin titel så informativ som möjligt." : "Längden på titeln är bra";
      $titleNotToLong["message"] = ($this->Analyze->titleIsToLong) ? "Titeln är för lång. När den är över 60 tecken lång är risken stor att sökmotorn ”klipper av” texten och information går därmed förlorad." : $titleNotToLong["message"];
      $titleNotToLong["message"] = ($this->Analyze->titleIsOk) ? "Längden på titeln är bra!" :  $titleNotToLong["message"];
      
      
      /* Description */
      $descriptionPass["image"] = ($this->Analyze->descriptionErrorCount == 0) ? $okImage : $errorImage; 
      $descriptionPass["message"] = ($this->Analyze->descriptionErrorCount == 0) ? $okMessage: $errorMessage;
      $descriptionPass["error"] = ($this->Analyze->descriptionErrorCount == 0) ? "" : $this->Analyze->descriptionErrorCount;
      
      
      
      $descriptionContainsKeywords["image"] =  ($this->Analyze->keywordsAppearsInDescription) ? $okImage : $errorImage;
      $descriptionContainsKeywords["message"] =  ($this->Analyze->keywordsAppearsInDescription) ? "Webbplatsens beskrivning innehåller det angivna sökordet" :  "Webbplatsens beskrivning innehåller <u>inte</u> det angivna sökordet"; 
      
      $descriptionContainsKeywords["image"] =  ($this->Analyze->descriptionContainsKeywordsMoreThanThreeTimes) ? $errorImage :  $descriptionContainsKeywords["image"] ;
      $descriptionContainsKeywords["message"] =  ($this->Analyze->descriptionContainsKeywordsMoreThanThreeTimes) ? "Titeln innehåller sökordet mer än tre gånger och riskerar att uppfattas som spammig." :  $descriptionContainsKeywords["message"];  
      
      $descriptionNoToLong["image"] =  ($this->Analyze->descriptionIsOk) ? $okImage : $errorImage;
      $descriptionNoToLong["message"] =  ($this->Analyze->descriptionIsToShort) ? "Description är för kort. Man bör utnyttja det tillgängliga utrymmet maximalt och göra sin description så informativ och säljande som möjligt." :  "Webbplatsens beskrivning är <u>längre än 50 tecken</u>";
      
      $descriptionNoToLong["message"] =  ($this->Analyze->descriptionIsToLong) ? "Description är för lång. När den är över 155 tecken lång är risken stor att sökmotorn ”klipper av” texten och information går därmed förlorad." :  $descriptionNoToLong["message"];
      
      $descriptionNoToLong["message"] =  ($this->Analyze->descriptionIsOk) ? "Längden på description är bra!" :  $descriptionNoToLong["message"];
      
      
      /* Images */
      $imagesPass["image"] = ($this->Analyze->imagesErrorCount == 0) ? $okImage : $errorImage;
      $imagesPass["message"] = ($this->Analyze->imagesErrorCount == 0) ? $okMessage : $errorMessage;
      $imagesPass["error"] = ($this->Analyze->imagesErrorCount == 0) ? "" : $this->Analyze->imagesErrorCount;
      
      $imagesAltContainsKeyword["image"] =  ($this->Analyze->imagesAltTagsContainingKeywords) ? $okImage : $errorImage;
      $imagesAltContainsKeyword["message"] = ($this->Analyze->imagesAltTagsContainingKeywords) ? "Sökordet finns med i någon ALT-tagg på sidan." :  "Sökordet finns inte med i någon ALT-tagg på sidan.";  
      
      $imagesAltMissingCount["image"] =  ($this->Analyze->imagesMissingAltTagsCount == 0) ? $okImage : $errorImage;
      $imagesAltMissingCount["message"] =  ($this->Analyze->imagesMissingAltTagsCount == 0) ? "Ingen av bilderna saknar ALT-tagg" : "{$this->Analyze->imagesMissingAltTagsCount} bild/er på sidan saknar ALT-tagg.";
      
      $imagesFilenameContainsKeyword["image"] =  ($this->Analyze->imagesFilenameContainingKeywords) ? $okImage : $errorImage;
      $imagesFilenameContainsKeyword["message"] =  ($this->Analyze->imagesFilenameContainingKeywords) ? "Sökordet finns med i minst ett filnamn på sidans bilder." : "Sökordet finns inte med i någon av bildernas filnamn på sidan.";
      

      
      /*Text*/
      $textPass["image"] = ($this->Analyze->textErrorCount == 0) ? $okImage : $errorImage;
      $textPass["message"] = ($this->Analyze->textErrorCount == 0) ? $okMessage : $errorMessage;
      $textPass["error"] = ($this->Analyze->textErrorCount == 0) ? "" : $this->Analyze->textErrorCount;
      
      $totalWordCount["image"] =  ($this->Analyze->wordCount > 400) ? $okImage : $errorImage;
      $totalWordCount["message"] =  ($this->Analyze->wordCount > 400) ? "Texten innehåller fler än 400 ord." : "Texten innehåller färre än 400 ord.";  
      
      $keywordAppearsMoreThenFiveTimes["image"] =  (array_sum($this->Analyze->keywordAppearenceCount) < 5 ) ? $okImage : $errorImage;
      $keywordAppearsMoreThenFiveTimes["message"] =  (array_sum($this->Analyze->keywordAppearenceCount) < 5 ) ? "Sökorden förekommer inte fler än fem gånger i webbplatsens texter" : "Sökordet förekommer fler än fem gånger i webbplatsens texter";  
      
      $keywordsAreNotEmphasized["image"] = ( count($this->Analyze->emphasisedKeywords) > 0) ? $okImage : $errorImage;
      $keywordsAreNotEmphasized["message"] = ( count($this->Analyze->emphasisedKeywords) > 0) ? "Sökordet är understruket, fetstilat och/eller kursiverat någonstans i brödtexten." : "Sökordet är varken understruket, fetstilat eller kursiverat någonstans i brödtexten.";
      
      $keywordsAppearsInText["image"] = ( $this->Analyze->keywordsAppearOnPage) ? $okImage : $errorImage;
      $keywordsAppearsInText["message"] = ( $this->Analyze->keywordsAppearOnPage) ? "Webbplatsens har en text som innehåller sökordet." : "Webbplatsens har <u>inte</u> en text som innehåller sökordet.";
      
      
      $keywordDensity = array_sum($this->Analyze->keywordDensity);
      
      $density["image"] = ( $keywordDensity > 1 && $keywordDensity < 5 ) ? $okImage : $errorImage;
      $density["message"] = ( $keywordDensity < 1 ) ? "Sökordsdensiteten är för låg." : "";
      $density["message"] = ( $keywordDensity > 5 ) ? "Sökordsdensiteten är för hög och texten riskerar att uppfattas som spammig." : $density["message"];
      $density["message"] = ( $keywordDensity > 1 && $keywordDensity < 5  ) ? "Sökordsdensiteten är på en bra nivå." : $density["message"];
      
      $wordCount = $this->Analyze->wordCount;
      $keywordAppearenceCount =  array_sum($this->Analyze->keywordAppearenceCount);
      $topFiveWords = "";
      foreach($this->Analyze->topFiveUsedWords as $word => $value){
       // $topFiveWords .= "<li data-ejeX='{$word}'><i>{$value}</i></li>";
      
        $x = ($value < 50) ? 3 : 12;
        $x = ($value < 40) ? 4 : $x;
        $x = ($value < 30) ? 5 : $x;
        $x = ($value < 20) ? 6 : $x;
        $x = ($value < 10) ? 6 : $x;
        $x = ($value < 5) ? 6 : $x;
     
        $width = $x * $value;
        
        $topFiveWords .= '
            <dt style="float: left; font-weight: 700; padding: 4px; width: 100px;">'.trim($word).'</dt>
              <dd>
                <div id="data-one" class="bar" style="width: '.$width.'px; margin-bottom: 10px; margin-left: 110px; color: #fff; text-align: center; background: #fdc689; padding: 4px;" align="center">
                '.$value.'
                </div>
             </dd>';
      }  
      
      /*Headinlines*/
      
      $headlinePass["image"] = ($this->Analyze->headingErrorCount == 0) ? $okImage : $errorImage;
      $headlinePass["message"] = ($this->Analyze->headingErrorCount == 0) ? $okMessage : $errorMessage;
      $headlinePass["error"] = ($this->Analyze->headingErrorCount == 0) ? "" : $this->Analyze->headingErrorCount;
      
      $pageContainsOnlyOneH1Tag["image"] = ($this->Analyze->headingsContainsOneH1Tag ) ? $okImage : $errorImage;
      $pageContainsOnlyOneH1Tag["message"] = ($this->Analyze->headingsContainsOneH1Tag) ? "Sidan innehåller en H1-rubrik." : "Sidan innehåller fler än en H1-rubrik.";
      
      $pageContainsOnlyOneH1Tag["image"] = ($this->Analyze->headingsContainsLessThenOneH1Tag) ? $errorImage : $pageContainsOnlyOneH1Tag["image"];
      $pageContainsOnlyOneH1Tag["message"] = ($this->Analyze->headingsContainsLessThenOneH1Tag) ? "Sidan saknar H1-rubrik." : $pageContainsOnlyOneH1Tag["message"]; 
      
      $pageContainsOnlyOneH1Tag["image"] = ($this->Analyze->headingsContainsMoreThenOneH1Tag) ? $errorImage : $pageContainsOnlyOneH1Tag["image"];
      $pageContainsOnlyOneH1Tag["message"] = ($this->Analyze->headingsContainsMoreThenOneH1Tag) ? "Sidan innehåller fler än en H1-rubrik" : $pageContainsOnlyOneH1Tag["message"]; 
      
      $H1TagsContainsKeyword["image"] = ($this->Analyze->H1TagContainsKeyword) ? $okImage : $errorImage; 
      $H1TagsContainsKeyword["message"] = ($this->Analyze->H1TagContainsKeyword) ? "H1-rubriken innehåller det angivna sökordet" : "H1-rubriken innehåller inte det angivna sökordet"; 
      
      $keywordAppearsInHeadlines["image"] = (count($this->Analyze->keywordsThatDoAppearsInHeadings) > 0) ?  $okImage : $errorImage;
      $keywordAppearsInHeadlines["message"] = (count($this->Analyze->keywordsThatDoAppearsInHeadings) > 0) ? "Sökordet finns i en webbplatsens rubriker." : "Sökordet finns inte i någon av webbplatsens rubriker.";
      
      $keywordAppearsInSemiHeadlines["image"] = ($this->Analyze->semiHeadingsContainsKeywordCount > 0 && $this->Analyze->semiHeadingsContainsKeywordCount < 4) ?  $okImage : $errorImage;
      $keywordAppearsInSemiHeadlines["message"] = ($this->Analyze->semiHeadingsContainsKeywordCount > 0 && $this->Analyze->semiHeadingsContainsKeywordCount < 4) ? $this->Analyze->semiHeadingsContainsKeywordCount." st mellanrubrik/er innehåller det angivna sökordet." : "Sökordet finns inte i någon utav webbplatsens mellanrubrik/er.";
      $keywordAppearsInSemiHeadlines["image"] = ($this->Analyze->semiHeadingsContainsKeywordCount > 3) ?  $errorImage : $keywordAppearsInSemiHeadlines["image"];
      $keywordAppearsInSemiHeadlines["message"] = ($this->Analyze->semiHeadingsContainsKeywordCount > 3) ? "Fler än tre rubriker på sidan innehåller det angivna sökordet, vilket riskerar att uppfattas som spammigt.": $keywordAppearsInSemiHeadlines["message"];
  
     /* $allHeadlines = "";
      
      foreach($this->Analyze->headingsOnWebpage as $name => $group){
        if(count($group) > 0){   
          foreach($group as $text){
       
            $allHeadlines .= "<h5><small>{$name} - {$text}.</small></h5>";
            
            
          }
        } 
      }
      */
         
      
      /*Domain*/
    
      $domainPass["image"] = ($this->Analyze->domainErrorCount == 0) ? $okImage : $errorImage;
      $domainPass["message"] = ($this->Analyze->domainErrorCount == 0) ? $okMessage : $errorMessage;
      $domainPass["error"] = ($this->Analyze->domainErrorCount == 0) ? "" : $this->Analyze->domainErrorCount;
    
      //$domainNamePass["image"] = ($this->Analyze->domainnameIsNotToLong) ?  $okImage : $errorImage;
      //$domainNamePass["message"] = ($this->Analyze->domainnameIsNotToLong) ? "Domännamnet är inte längre än 15 tecken." : "Domännamnet är längre än 15 tecken."; 
            

      $domainContainSeperator["image"] = (!$this->Analyze->domainContainsSeperator) ?  $okImage : $errorImage;
      $domainContainSeperator["message"] = ($this->Analyze->domainContainsSeperator) ? "Domännamnet innehåller bindestreck." : "Domännamnet innehåller inte ett bindestreck."; 
    
      $domainNameContainsKeywords["image"] = ($this->Analyze->domainnameContainsKeyword) ?  $okImage : $errorImage;
      $domainNameContainsKeywords["message"] = ($this->Analyze->domainnameContainsKeyword) ? "Domänen innehållet det angivna sökordet." : "Domänen innehåller inte det angiva sökordet.";                               

      $canonicalPass["image"] = ($this->Analyze->domainIsCanonical) ?  $okImage : $errorImage;
      $canonicalPass["message"] = ($this->Analyze->domainIsCanonical) ? "Domännamnet är canonical-deklarerat." : "Domännamnet är inte canonical-deklarerat.";
      
      /*Result*/
      $resultTitle = "<h3>Det här gick ju bra!</h3>";
      $resultText  = "<p>Text om resultatet</p>";
    
      $html = <<<EOD
<table class="body" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; height: 100%; width: 100%; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;">
  <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
    <td class="center" align="center" valign="top" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: center; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;">
      <center style="width: 100%; min-width: 580px;">
        <table class="row header" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; background: #252259; padding: 0px;" bgcolor="#252259">
          <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
            <td class="center" align="center" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: center; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" valign="top">
              <center style="width: 100%; min-width: 580px;">
                <table class="container" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: inherit; width: 650px; margin: 0 auto; padding: 0;">
                  <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                    <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                      <table class="twelve columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 650px; margin: 0 auto; padding: 0;">
                        <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                          <td class="six sub-columns" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; min-width: 0px; width: 50%; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 10px 10px 0px;" align="left" valign="top">
                            <img src="{$logo}" width="200" height="60" style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />
                          </td>
                          <td class="six sub-columns last" style="text-align: right; vertical-align: middle; word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; min-width: 0px; width: 50%; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="right" valign="middle">
                            <span class="template-label" style="color: #ffffff; font-weight: bold; font-size: 11px;">SEO-ANALYS</span>
                          </td>
                          <td class="expander" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top"></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </center>
            </td>
          </tr>
        </table>  
        <table class="container" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: inherit; width: 580px; margin: 0 auto; padding: 0;">
          <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
            <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top">
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                    <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                      <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                        <td class="wrapper" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 20px 0px 0px;" align="left" valign="top">
                          <table class="six columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 280px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                             
                             <h2 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 32px; margin: 0; padding: 0;" align="left">Hemsida</h2>
                              
                              <p class="lead" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: left; line-height: 21px; font-size: 18px; margin: 0 0 10px; padding: 0;" align="left">{$url}</p>
                              
                              </td>
                              <td class="expander" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top"></td>
                            </tr>
                          </table>
                        </td>
                        <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                          <table class="six columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 280px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                               
                               <h2 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 32px; margin: 0; padding: 0;" align="left">Sökord</h2>
                               
                               <p class="lead" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: left; line-height: 21px; font-size: 18px; margin: 0 0 10px; padding: 0;" align="left">{$keywords}</p>
                                
                              </td>
                              <td class="expander" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              
              
              
              
              
              
              
              <hr style="color: #d9d9d9; height: 1px; background: #d9d9d9; border: none; margin-top: 20px;" />
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                    <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                      <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                        <td class="wrapper" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 20px 0px 0px;" align="left" valign="top">
                          <table class="three columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 130px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td class="center" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: center; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="center" valign="top">
                                <center style="width: 100%; min-width: 130px;">
                                  <h6 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 18px; margin: 0; padding: 0;" align="left">Laddningstid</h6>
                                  <h3 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">{$loadingResult}</h3>
                                </center>
                              </td>
                              <td class="expander" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top"></td>
                            </tr>
                          </table>
                        </td>
                        <td class="wrapper" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 20px 0px 0px;" align="left" valign="top">
                          <table class="three columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 130px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td class="center" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: center; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="center" valign="top">
                                <center style="width: 100%; min-width: 130px;">
                              
                              <h6 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 18px; margin: 0; padding: 0;" align="left">Domänålder</h6>
                               
                               <h3 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">{$domainAge}</h3>
                               
                                </center>
                              </td>
                              <td class="expander" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top"></td>
                            </tr>
                          </table>
                        </td>
                        <td class="wrapper" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 20px 0px 0px;" align="left" valign="top">
                          <table class="three columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 130px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td class="center" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: center; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="center" valign="top">
                                <center style="width: 100%; min-width: 130px;">
                                
                                <h6 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 18px; margin: 0; padding: 0;" align="left">Mobilvänlig</h6>
                                
                                <h3 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">{$mobileFriendly}</h3>
                                
                                </center>
                              </td>
                              <td class="expander" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top"></td>
                            </tr>
                          </table>
                        </td>
                        <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                          <table class="three columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 130px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td class="center" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: center; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="center" valign="top">
                                <center style="width: 100%; min-width: 130px;">
                                 
                                 <h6 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 18px; margin: 0; padding: 0;" align="left">CMS</h6>
                                
                                <h3 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">{$CMS}</h3>
                                  
                                </center>
                              </td>
                              <td class="expander" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              
              
              
              
            
              <hr style="color: #d9d9d9; height: 1px; background: #d9d9d9; border: none; margin-top: 20px;" />
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                    <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                      <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                        <td class="wrapper" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 20px 0px 0px;" align="left" valign="top">
                          <table class="eight columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 380px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                             
                             <h3 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">Titel</h3>
                             
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                          <table class="four columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 250px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                                
                                <p class="title answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; float: right; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$titlePass["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" /> {$titlePass["error"]} {$titlePass["message"]}</p>
                                
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table> 
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top">
                   
                   <p style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 14px; margin: 0 0 10px; padding: 0;" align="left">Alla webbsidor ska ha en titel. I en sökmotors ögon är titeln det viktigaste för att bedöma vad en webbsida handlar om och för vilka sökord sidan ska rankas högt på. Titeln bör vara maximalt 60 tecken lång och innehålla sökordet, men maximalt två gånger. Sökordet bör komma så tidigt som möjligt i titeln.</p>
                   
									 <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$titleNotToLong["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />  {$titleNotToLong["message"]}</p>
									 
                   <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$titleContainKeyword["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />  {$titleContainKeyword["message"]}</p>
          
                  
                  </td>
                </tr>
              </table>
              
              
              
              <hr style="color: #d9d9d9; height: 1px; background: #d9d9d9; border: none; margin-top: 20px;" />
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                    <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                      <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                        <td class="wrapper" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 20px 0px 0px;" align="left" valign="top">
                          <table class="eight columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 380px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                             
                             <h3 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">Meta description</h3>
                             
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                          <table class="four columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 250px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                              
                              <p class="title answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; float: right; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$descriptionPass["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$descriptionPass["error"]} {$descriptionPass["message"]}</p>
                              
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              
              
              
              
              
              
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top">
                   
                   <p style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 14px; margin: 0 0 10px; padding: 0;" align="left">Meta description är det första en potentiell kund läser om ditt företag och texten bör vara både informativ och säljande. Description är inte avgörande för optimeringen men man bör ändå ha med sökordet. Description bör vara maximalt 155 tecken lång.</p>
                   
                   <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$descriptionContainsKeywords["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$descriptionContainsKeywords["message"]}</p>
                    <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$descriptionNoToLong["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$descriptionNoToLong["message"]}</p>
                
                </td>
                </tr>
              </table>
              
              
              <hr style="color: #d9d9d9; height: 1px; background: #d9d9d9; border: none; margin-top: 20px;" />
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                    <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                      <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                        <td class="wrapper" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 20px 0px 0px;" align="left" valign="top">
                          <table class="eight columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 380px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                               
                               <h3 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">Rubriker</h3>
                               
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                          <table class="four columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 250px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                             
                             <p class="title answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; float: right; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$headlinePass["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$headlinePass["error"]} {$headlinePass["message"]}</p>
                             
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top">
                   
                   <p style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 14px; margin: 0 0 10px; padding: 0;" align="left">Rubriker är en viktig signal till sökmotorer om vad en sida handlar om. Viktigast av allt är huvudrubriken, H1, som bör innehålla sökordet så tidigt som möjligt. Det är även bra om sökordet finns med i någon av underrubrikern (H2, H3, osv). Man bör dock inte spamma och använda sökordet i varenda rubrik.</p>
                   
                    <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$pageContainsOnlyOneH1Tag["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$pageContainsOnlyOneH1Tag["message"]}</p>
                   
                   <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$keywordAppearsInHeadlines["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$keywordAppearsInHeadlines["message"]}</p>
                   
                   <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$H1TagsContainsKeyword["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$H1TagsContainsKeyword["message"]}</p>  
                   
                   <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$keywordAppearsInSemiHeadlines["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$keywordAppearsInSemiHeadlines["message"]}</p>
                   
                  </td>
                </tr>
              </table>
              
              
      
              
              
              
              
              <hr style="color: #d9d9d9; height: 1px; background: #d9d9d9; border: none; margin-top: 20px;" />
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                    <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                      <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                        <td class="wrapper" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 20px 0px 0px;" align="left" valign="top">
                          <table class="eight columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 380px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                               
                               <h3 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">Brödtext</h3>
                               
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                          <table class="four columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 250px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                               
                               <p class="title answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; float: right; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$textPass["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$textPass["error"]} {$textPass["message"]}</p>
                               
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              
            <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
            <tr>
              <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                
								<table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
									<tr>
										<td>
											<p style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 14px; margin: 0 0 10px; padding: 0;" align="left">En väloptimerad sida bör innehålla minst 400 ord relevant text kring sökordet man vill ranka på. Någon övre gräns finns egentligen inte. Exakt hur många gånger sökordet bör förekomma i texten går inte att säga, men texten måste vara naturligt skriven och inte spammig. Ha gärna sökordet i kursiv stil, fetstil eller understruket någon gång i texten. </p>
										</td>
									</tr>
								</table>
								
								<table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                  <tr>
                    <td class="wrapper">
											
                      <table class="six columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 280px; margin: 0 auto; padding: 0;">
                        <tr>
                          <td>
                            <h6 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 18px; margin: 0; padding: 0;" align="left">Antal ord p&aring; sidan</h6>
                           
                               <h3 style="color: #fdc689; padding-bottom: 15px; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">{$wordCount}</h3><br>
                            <h6 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 18px; margin: 0; padding: 0;" align="left">S&ouml;kord f&ouml;rekommer i texten</h6>
                               <h3 style="color: #fdc689; padding-bottom: 15px; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">{$keywordAppearenceCount} g&aring;nger</h3><br>
                            <h6 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 18px; margin: 0; padding: 0;" align="left">S&ouml;kordsdensitet</h6>
                            
                               <h3 style="color: #fdc689; padding-bottom: 15px; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">{$keywordDensity}%</h3><br>
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                      <table class="six columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 280px; margin: 0 auto; padding: 0;">
                        <tr>
                          <td>
                            <h6 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 18px; margin: 0; padding: 0;" align="left">Top fem ord</h6>
                            <dl style="width: 300px;">
                              {$topFiveWords}
                            </dl>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
              
              
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top">
                   
                   <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$totalWordCount["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$totalWordCount["message"]}</p>
                   
                    
                    <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$density["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$density["message"]}</p>
                    
                    <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$keywordsAreNotEmphasized["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$keywordsAreNotEmphasized["message"]}</p>
                    
                    <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$keywordsAppearsInText["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$keywordsAppearsInText["message"]}</p>
                    
                  </td>
                </tr>
              </table>
              
              
              
              
              <hr style="color: #d9d9d9; height: 1px; background: #d9d9d9; border: none; margin-top: 20px;" />
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                    <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                      <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                        <td class="wrapper" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 20px 0px 0px;" align="left" valign="top">
                          <table class="eight columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 380px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                              
                              <h3 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">Bilder</h3>
                              
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                          <table class="four columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 250px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                              
                              <p class="title answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; float: right; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$imagesPass["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$imagesPass["error"]} {$imagesPass["message"]}</p>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top">
                 
                 <p style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 14px; margin: 0 0 10px; padding: 0;" align="left">Att använda sig av ALT-tagg på bilder är viktigt för både bildsöket och det vanliga sökresultatet. Alla bilder på en sida bör ha ALT-tagg och sökordet bör finnas med i ALT-taggen på minst en av bilderna. Välj bild med omsorg då ALT-taggen ska beskriva bilden. Det är även ett plus om sökordet finns med i filnamnet på någon bild.</p>
                   
                   <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$imagesAltContainsKeyword["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$imagesAltContainsKeyword["message"]}</p>
                  
                  <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$imagesAltMissingCount["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$imagesAltMissingCount["message"]}</p>
                  
                  <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$imagesFilenameContainsKeyword["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$imagesFilenameContainsKeyword["message"]}</p>
                 
                 </td>
                </tr>
              </table>
              
              
              
              
              
              <hr style="color: #d9d9d9; height: 1px; background: #d9d9d9; border: none; margin-top: 20px;" />
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                    <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                      <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                        <td class="wrapper" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 20px 0px 0px;" align="left" valign="top">
                          <table class="eight columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 380px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                            
                            <h3 style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 1.3; word-break: normal; font-size: 30px; margin: 0; padding: 0;" align="left">Domännamn</h3>
                            
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                          <table class="four columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 250px; margin: 0 auto; padding: 0;">
                            <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                              <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                               
                               <p class="title answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; float: right; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$domainPass["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$domainPass["error"]} {$domainPass["message"]}</p>
                               
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
							
							<table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
									<tr>
										<td>
											<p style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 14px; margin: 0 0 10px; padding: 0;" align="left">Domännamnet har en viss påverkan på optimeringen. Det bör inte vara för långt och krånligt och det får gärna innehålla det aktuella sökordet. Domännament bör helst inte innehålla bindestreck.</p>
										</td>
									</tr>
								</table>
							
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top">
                 
                 
                    <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$domainContainSeperator["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$domainContainSeperator["message"]}</p>
                 
                 <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$domainNameContainsKeywords["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$domainNameContainsKeywords["message"]}</p>
                  
                  <p class="answer" style="color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 700; text-align: left; line-height: 22px; font-size: 14px; vertical-align: middle; margin: 0 0 10px; padding: 0;" align="left"><img src="{$canonicalPass["image"]}" width="24" height="24" style="vertical-align: middle; padding-right: 10px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: auto; max-width: 100%; float: left; clear: both; display: block;" align="left" />{$canonicalPass["message"]}</p>
                  </td>
                </tr>
              </table>
              
              
              
              
              
              
              
              
              
              <hr style="color: #d9d9d9; height: 1px; background: #d9d9d9; border: none; margin-top: 20px;<" />
              <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;">
                <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                  <td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">
                    <table class="twelve columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 580px; margin: 0 auto; padding: 0;">
                      <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
                        <td align="center" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" valign="top">
                          <center style="width: 100%; min-width: 580px;">
                            <p style="text-align: center; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0 0 10px; padding: 0;" align="center"><a href="#" style="color: #2ba6cb; text-decoration: none;">http://www.defiso.se</a> | <a href="#" style="color: #2ba6cb; text-decoration: none;">08-410 344 35</a> | <a href="#" style="color: #2ba6cb; text-decoration: none;">info@defiso.se</a></p>
                          </center>
                        </td>
                        <td class="expander" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top"></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              <!-- container end below -->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
</table>
EOD;
      $emailHTML = <<<EOD
      <!-- Inliner Build Version 4380b7741bb759d6cb997545f3add21ad48f010b -->
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
        <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <meta name="viewport" content="width=device-width" />
        </head>
  <body style="width: 100% !important; min-width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 14px; margin: 0; padding: 0;">
EOD;
      
      /* To remove header and body tags, only the $html tag is returned to parent class */
      
      $emailHTML .= $html;
      $emailHTML .= "</body></html>"; //Dynamisk String
      $this->finalReport = $html; 
      unset($html); // Free memory
      return $emailHTML;
      
    }
 
}

?>