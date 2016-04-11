

<?php include("autoloader.php"); ?>
<?php include("seoDOMChecker.php"); ?>

<?php 
class seoAnalyzer{
  
  public $status = "";
  
  /* Webpage properties */
  public $webpage;
  public $webpageCleanName;
  public $orignalName;
  public $webpageNameWithWWW;
  public $webpageNameWithoutWWW;
  public $webcontent;
  public $httpRequests;
  public $googleInsightKey = "AIzaSyDf3J3paf9YUPdZ-gXY-YqvPgTjWxNE5nI";
 // public $googleCustomSearchKey = "AIzaSyAcH0Gr-BCLvY92o_zAQyYMCCiBjvOai98";
  public $shareLink;
  public $punyWebbadress;
  
  public $isHTTP;
  public $isHTTPS;
  public $gotWWW;
  public $noHTTP;
  public $noHTTPS;
  public $absoluteURL;
  public $webpageWithoutWWW;
  
  /* Keywords properties */
  public $keywords = array();
  public $multipleKeywords;
  public $keywordsInSentence;

  /* Title properties */
  public $webTitle;
  public $titleExists;
  public $keywordsAppearsInTitle = false;
  public $keywordsDoNotAppearsInTitle = array();
  public $keywordsThatAppearsInTitle = array();
  public $keywordIsFirstWordInTitle = false;
  public $keywordsAppearsMoreThanTwice = false;
  public $titleIsOk = false;
  public $titleIsToLong = false;
  public $titleIsToShort = false;
  public $keywordSenteceExistsInTitle;
  public $titlePass;
  public $titleErrorCount = 0;
  

  /* Description properties */
  public $webDescription;
  public $descriptionExists;
  public $descriptionIsOk = false;
  public $descriptionIsToLong = false;
  public $descriptionIsToShort = false;
  public $descriptionContainsKeywordsMoreThanThreeTimes = false;
  public $keywordSenteceExistsInDescription;
  public $keywordDoNotAppearInDescription = array();
  public $keywordThatDoAppearInDescription = array();
  public $keywordsAppearsInDescription  = array();
  public $descriptionPass;
  public $descriptionErrorCount = 0;

  /* Images properties */
  public $imagesIsMissing;
  public $imageCount = 0;
  public $imagesMissingAltTagsCount = 0;
  public $imagesAltTagsContainingKeywords;
  public $imagesFilenameContainingKeywords;
  public $keywordsThatDoNotAppearInAnyAltTags = array();
  public $keywordsThatDoAppearInAnyAltTags = array();
  public $keywordsThatDoNotAppearInAnyFilename = array();
  public $keywordsThatDoAppearInAnyFilename = array();
  public $imagesPass;
  public $imagesErrorCount = 0;

  /* Headings properties */
  public $headingCount = 0;
  public $headingsMissing;
  public $keywordSenteceExistsInHeading;
  public $headingsOnWebpage = array("h1" => array(),"h2" => array(),"h3" => array(),"h4" => array(),"h5" => array(),"h6" => array());
  public $headingsContainOneOrMoreOfKeywords = false;
  public $H1TagContainsKeyword = false;
  public $keywordsThatDoNotAppearsInHeadings = array();
  public $keywordsThatDoAppearsInHeadings = array();
  public $headingsContainsOneH1Tag = false;
  public $headingsContainsMoreThenOneH1Tag = false;
  public $headingsContainsLessThenOneH1Tag = false;
  public $headingErrorCount = 0;
  public $semiHeadingsContainsKeywordCount = 0;

  /* Text properties */
  public $topFiveUsedWords = array();
  public $wordCount;
  public $keywordsAppearOnPage;
  public $keywordSenteceExistsInText;
  public $keywordsThatAppearOnPage = array();
  public $keywordsThatDoNotAppearsOnPage = array();
  public $keywordsAppearsMultipleTimesOnPage;
  public $keywordAppearenceCount = array();
  public $keywordDensity = array();
  public $emphasisedKeywords = array();
  public $allWordsOnWebpage = array();
  public $totalKeywordAppearenceCount;
  public $textErrorCount = 0;
  public $usualWords = array();

  /* Domain Properties */
  public $domainnameIsNotToLong;
  public $domainnameContainsKeyword;
  public $keywordSenteceExistsInDomainName;
  public $domainIsCanonical;
  public $domainChoosedCanonical;
  public $domainContainsSeperator;
  public $ageOfDomainYears;
  public $ageOfDomainDays;
 // public $domainAge;
  public $keywordDoAppearInDomainname = array();
  public $domainErrorCount = 0;

  /* CSS Properties */
  public $sourceCodeContainsCSS;
  public $sourceCodeContainsStyleTag;
  
  /* Meta properties */
  public $isUsingCMS;
  public $currentCMS = "Okänt";

  /* Speed Properties */
  public $sizeOfWebpage;
  public $timeToLoadPage;
  public $googleSpeedScore;
  public $pageLoadOk;
  public $loadTime;
  public $webpageIsResponsiveScore = 20;
  
  /* UX Properties */
  public $webpageIsResponsive;
  public $responsiveScreenshot;
  
  /* Google Analytic Check */
  public $googleAnalyticsExists;
  
  /* SpellChecker */
  public $misspelledWords = array();
      
  /* Get the webcontent and start analyze the content. */
  public function Analyze(){
    $this->FixKeywords();
    $this->FixUrl();
    $this->InitWebcontent();
    $this->SetUsualWords();
    
    if($this->webcontent != false){
      $this->CheckTitleOfWebpage(); // OK
      $this->CheckDescriptionOfWebpage(); // OK
      $this->CheckImagesOfWebpage();  // OK
      $this->CheckHeadingsOfWebpage(); // OK
      $this->CheckIfWebpageIsResponsive(); // OK
      $this->CheckIfWebpageContainsCSS(); // OK
      $this->CheckPageSpeedOfWebpage();  // OK
      $this->CheckDomainForWebpage(); // OK
      $this->CheckTextOfWebpage();  // OK
    }else{
      return false;
    }
    return true;
  }
  
  /* Fix incoming url. */
  private function FixUrl(){
   
    
    $this->webpage = (substr(strtolower($this->webpage), -1) == "/") ? strtolower(substr($this->webpage,0,-1)) : $this->webpage;
    $this->webpage = (substr(strtolower($this->webpage), -10) == "/index.asp") ? strtolower(substr($this->webpage,0,-10)) : $this->webpage;
    $this->webpage = (substr(strtolower($this->webpage), -11) == "/index.aspx") ? strtolower(substr($this->webpage,0,-11)) : $this->webpage;
    $this->webpage = (substr(strtolower($this->webpage), -11) == "/index.html") ? strtolower(substr($this->webpage,0,-11)) : $this->webpage;
    $this->webpage = (substr(strtolower($this->webpage), -10) == "/index.php") ? strtolower(substr($this->webpage,0,-10)) : $this->webpage;
    $this->webpage = (substr(strtolower($this->webpage), -4) == ".php") ? strtolower(substr($this->webpage,0,-4)) : $this->webpage;
    $this->webpage = (substr(strtolower($this->webpage), -4) == ".htm") ? strtolower(substr($this->webpage,0,-4)) : $this->webpage;
    $this->webpage = (substr(strtolower($this->webpage), -5) == ".html") ? strtolower(substr($this->webpage,0,-5)) : $this->webpage;
    $this->webpage = (substr(strtolower($this->webpage), -5) == ".aspx") ? strtolower(substr($this->webpage,0,-5)) : $this->webpage;
    $this->webpage = (substr(strtolower($this->webpage), -4) == ".asp") ? strtolower(substr($this->webpage,0,-4)) : $this->webpage;

    $this->noHTTP = (substr(strtolower($this->webpage), 0, 7) != "http://");
    $this->noHTTP = (substr(strtolower($this->webpage), 0, 8) != "https://");
    $this->isHTTP = (substr(strtolower($this->webpage), 0, 7) == "http://");
    $this->isHTTPS = (substr(strtolower($this->webpage), 0, 8) == "https://");
      
    if($this->isHTTP){
        $this->webpageCleanName = (substr(strtolower($this->webpage), 0, 7) == "http://") ? substr($this->webpage, 7) : $this->webpage;
    }elseif($this->isHTTPS){
        $this->webpageCleanName = (substr(strtolower($this->webpage), 0, 8) == "https://") ? substr($this->webpage, 8) : $this->webpage;
    }else{
        $this->webpageCleanName = $this->webpage;
    }
    
    $this->gotWWW = (substr(strtolower($this->webpage), 0, 11) == "http://www.");
    $this->gotWWW = ((substr(strtolower($this->webpage), 0, 12) == "https://www.") || $this->gotWWW == true);
    $this->gotWWW = ((substr(strtolower($this->webpage), 0, 4) == "www.") || $this->gotWWW == true);
  
     $http = ($this->isHTTPS && $this->noHTTPS == false) ? "https://" : "http://";    

     $this->orignalName = $this->webpageCleanName;
     $this->webpage = $http.$this->webpageCleanName;
     $this->webpage = strtolower($this->webpage);
     $this->webpageNameWithWWW = strtolower($http."www.".$this->webpageCleanName);
     $this->webpageNameWithoutWWW = strtolower($http.$this->webpageCleanName);
    
    /* Fix the Å Ä Ö Bugg */
      function utfFix($string){
       $replace = array('a', 'a', 'o');
       $search = array('å', 'ä', 'ö');
       $string = str_replace($search, $replace, trim($string));
       return $string;
      }
    
    $this->punyWebbadress = idn_to_ascii ($this->webpage); 
    $this->webpage = idn_to_ascii ($this->webpage); 
    $this->webpageWithWWW = idn_to_ascii ($this->webpageNameWithWWW); 
    $this->webpageCleanName = utfFix($this->webpageCleanName);
  
    
    $off =  strrchr($this->webpageCleanName,"/");
    $this->absoluteURL = (strlen($off) != 0) ? strtolower(substr($this->webpageCleanName,0,-(strlen($off)))) : $this->webpageCleanName;
    $this->absoluteURL = (substr($this->absoluteURL, 0, 4) == "www.") ? substr($this->absoluteURL, 4) : $this->absoluteURL;
    $this->absoluteURL = idn_to_ascii ($this->absoluteURL); 
  }
  
  /* Set current webcontent. */
  private function InitWebcontent(){   
    if($this->webpage != false){
      $file = $this->webpage;
      $file_headers = @get_headers($file);
      $callback = $file_headers[0];
      $miss = isset($file_headers[16]) ? $file_headers[16] : "";
      if(strpos($miss, "404") != true){
        if(strpos($callback, "301") == true || strpos($callback, "200") == true) {
            if($this->webpage != "http://" || $this->webpage = "" || count($this->keywords) == 0){
              $start = microtime(true);
              $this->webcontent = file_get_html($this->webpage);
              $end = microtime(true);
              $this->loadTime =   $end - $start;
          }
        }else{
          $this->webcontent = false;
        }
      }else{
        $this->webcontent = false;
      }
    }
    
    if($this->webcontent == false){
      $file = $this->webpageWithWWW;
      $file_headers = @get_headers($file);
      $callback = $file_headers[0];
      $miss = isset($file_headers[16]) ? $file_headers[16] : "";
      if(strpos($miss, "404") != true){
        if(strpos($callback, "301") == true || strpos($callback, "200") == true) {
          $this->webcontent = file_get_html($this->webpageWithWWW);
        }
      }
    }
  } 
  
  /* Fix keywords. */
  private function FixKeywords(){
    if(count($this->keywords) > 1){
      $this->multipleKeywords = true;
      $this->keywordsInSentence = "";
      foreach($this->keywords as $word => $index){
        if(!trim($index) == ''){
          $this->keywordsInSentence .= $index;
          $this->keywordsInSentence .= " ";
        }else{
          unset($this->keywords[$word]);
        }
      }
     $this->keywordsInSentence = substr($this->keywordsInSentence, 0, -1);
    }else{
     $this->multipleKeywords = false;
     $this->keywordsInSentence = $this->keywords[0];
    }
  }
  
  
  
  
  /* ANALYZE FUNCTIONS */
  
  /* Analyze the title of the current webpage. */
  private function CheckTitleOfWebpage(){
    	
    $html = $this->webcontent->find('title');
    $this->titleExists = (count($html) < 1) ? false : true; 
    foreach($html as $element){
      $this->webTitle = $element->plaintext;
      if(preg_match('/\s/',$this->webTitle)){
        $this->webTitle = str_replace(".","", $this->webTitle);
        $this->webTitle = str_replace(",","",$this->webTitle);
      }
      
      $titleWords = explode(" ", strtolower($this->webTitle));
      
      foreach($this->keywords as $keyword){
          $this->keywordIsFirstWordInTitle = (strtolower($titleWords[0]) == strtolower($keyword)) ? true : false;
        }  
    
      foreach($titleWords as $keyword){
  
        if(in_array(strtolower($keyword), $this->keywords)){
          array_push($this->keywordsThatAppearsInTitle, strtolower($keyword));
        }else{
          array_push($this->keywordsDoNotAppearsInTitle, strtolower($keyword));
        }

     }
       
    }
    function fixutf($string){
       $replace = array('a', 'a', 'o');
       $search = array('å', 'ä', 'ö');
       $string = str_replace($search, $replace, trim($string));
       return $string;
      }
    $title = trim(fixutf($this->webTitle));
    $this->titleIsOK = (strlen( $title) < 61 && strlen( $title) > 30) ? true : false;
    $this->titleIsToLong = (strlen($title) > 60) ? true : false; 
    $this->titleIsToShort = (strlen($title) < 30) ? true : false; 
    $this->keywordsAppearsInTitle = (count($this->keywordsThatAppearsInTitle)) ? true : false;
    

    if($this->multipleKeywords){    
      if (strpos(strtolower($this->webTitle), strtolower($this->keywordsInSentence)) !== false){
        $this->keywordSenteceExistsInTitle = true;
      }else{
        $this->keywordSenteceExistsInTitle = false;
      }
    }else{
      $this->keywordSenteceExistsInTitle = $this->keywordsAppearsInTitle;
    }
    $this->keywordsAppearsMoreThanTwice = (count($this->keywordsThatAppearsInTitle) != count(array_unique($this->keywordsThatAppearsInTitle))) ? true : false;
    $this->keywordsThatAppearsInTitle = array_unique($this->keywordsThatAppearsInTitle);
    $this->keywordsDoNotAppearsInTitle = array_unique($this->keywordsDoNotAppearsInTitle);
    $this->titlePass = ( $this->titleExists && $this->keywordsAppearsInTitle && $this->titleIsOK) ? true : false;
    $this->titleErrorCount = ( $this->keywordsAppearsInTitle ) ? $this->titleErrorCount :  $this->titleErrorCount += 1;
    $this->titleErrorCount =  ( $this->titleIsOk ) ? $this->titleErrorCount :  $this->titleErrorCount += 1;
  }
	
  
  
  
  
  /* Analyze the description tag of the current webpage.  */
  private function CheckDescriptionOfWebpage(){
    /* check if not exists */
    $html = $this->webcontent->find('meta');
    foreach($html as $element){
      if($element->name == "description"){
        $this->webDescription = $element->content;
        break;
      }
    }
    if(!isset($this->webDescription) || (strlen($this->webDescription) < 1)){
      $this->descriptionExists = false;
    }else{
      $this->descriptionExists = true;
    }
    
    $description = strtolower($this->webDescription);
    $description = str_replace(".","", $description);
    $description = str_replace(",","",$description);
    $descriptionWords = explode(" ", $description);
    
    foreach($descriptionWords as $word){
      
      if(in_array(strtolower($word), $this->keywords)){
        array_push($this->keywordThatDoAppearInDescription, $word);
      }else{
        array_push($this->keywordDoNotAppearInDescription, $word);
      }
    }
    
    $this->keywordsAppearsInDescription = (count($this->keywordThatDoAppearInDescription) > 0) ? true : false;
    
    if(count($this->keywordThatDoAppearInDescription) > 0){
      $words = array_count_values ($this->keywordThatDoAppearInDescription);
      foreach($words as $word => $value){
        if($value > 2){
            $this->descriptionContainsKeywordsMoreThanThreeTimes = true;
        }
      }
    }
    
    
    if($this->multipleKeywords){      
      if (strpos(strtolower($this->webDescription), strtolower($this->keywordsInSentence)) !== false){
        $this->keywordSenteceExistsInDescription = true;
      }else{
        $this->keywordSenteceExistsInDescription = false;
      }
    }else{
      $this->keywordSenteceExistsInDescription = $this->keywordsAppearsInDescription;
    }
    
    $replace = array('a', 'a', 'o');
    $search = array('&aring;', '&auml;', '&ouml');
    $description = str_replace($search, $replace, trim($description));
    $description = str_replace(";","", $description);
    $description = utf8_encode($description);
    $description = strip_tags($description);
    $descriptionLength =  mb_strlen(strip_tags($description));
    
    
    $this->descriptionIsOk = ($descriptionLength > 50 && $descriptionLength < 155) ? true : false; 
    $this->descriptionIsToShort = ($descriptionLength < 50) ? true : false; 
    $this->descriptionIsToLong = ($descriptionLength > 155) ? true : false; 
    $this->keywordDoNotAppearInDescription = array_unique($this->keywordDoNotAppearInDescription);
    $this->descriptionPass = (  $this->descriptionIsOk &&  $this->keywordsAppearsInDescription) ? true : false;
          
    $this->descriptionErrorCount =  ( $this->descriptionIsOk ) ? $this->descriptionErrorCount :  $this->descriptionErrorCount += 1;
    $this->descriptionErrorCount =  ( $this->keywordsAppearsInDescription ) ? $this->descriptionErrorCount :  $this->descriptionErrorCount += 1;

  }

  /* Check images of the webcontent. */
  private function CheckImagesOfWebpage(){
    $html = $this->webcontent->find('img');
    $this->imagesIsMissing = (count($html) < 1) ? true : false; 
   
    if(!$this->imagesIsMissing){
      foreach($html as $element){
        $alt = $element->alt;
        $this->imageCount++;
        $filename = substr(strrchr($element->src, "/"), 1);
        if(!isset($alt) || strlen($alt)< 1){
          $this->imagesMissingAltTagsCount++;
        }

      foreach($this->keywords as $keyword){
        if (strpos(strtolower($alt), strtolower($keyword)) !== false){
            $this->imagesAltTagsContainingKeywords = true;
            array_push($this->keywordsThatDoAppearInAnyAltTags, $keyword);
        }else{
            $this->imagesAltTagsContainingKeywords = ($this->imagesAltTagsContainingKeywords) ? true : false;
            array_push($this->keywordsThatDoNotAppearInAnyAltTags, $keyword);

        }

        if(strpos(strtolower($filename), strtolower($keyword)) !== false){
          $this->imagesFilenameContainingKeywords = true;
          array_push($this->keywordsThatDoAppearInAnyFilename, strtolower($keyword));
        }else{
            $this->imagesFilenameContainingKeywords = ($this->imagesFilenameContainingKeywords) ? true : false;
            array_push($this->keywordsThatDoNotAppearInAnyFilename, strtolower($keyword));

        }
      }
    }
    }else{
      foreach($this->keywords as $keyword){
          $this->imagesFilenameContainingKeywords = false;
          array_push($this->keywordsThatDoNotAppearInAnyFilename, $keyword);
          array_push($this->keywordsThatDoNotAppearInAnyAltTags, $keyword);
        
         if(!in_array(strtolower($keyword), $this->keywordsThatDoAppearInAnyAltTags)){
            array_push($this->keywordsThatDoNotAppearInAnyAltTags, $keyword);
        }
        if(!in_array(strtolower($keyword), $this->keywordsThatDoAppearInAnyFilename)){
            array_push($this->keywordsThatDoNotAppearInAnyFilename, $keyword);
        }
      }
    }
    
    $this->keywordsThatDoAppearInAnyFilename = array_unique($this->keywordsThatDoAppearInAnyFilename);
    $this->keywordsThatDoAppearInAnyAltTags = array_unique($this->keywordsThatDoAppearInAnyAltTags);
    $this->keywordsThatDoNotAppearInAnyAltTags = array_unique($this->keywordsThatDoNotAppearInAnyAltTags);
    $this->keywordsThatDoNotAppearInAnyFilename = array_unique($this->keywordsThatDoNotAppearInAnyFilename);
    $this->imagesErrorCount =  ( $this->imagesAltTagsContainingKeywords ) ? $this->imagesErrorCount :  $this->imagesErrorCount += 1;
    $this->imagesErrorCount =  ( $this->imagesMissingAltTagsCount > 0 ) ? $this->imagesErrorCount += 1 :$this->imagesErrorCount;
    $this->imagesErrorCount =  ($this->imagesFilenameContainingKeywords) ? $this->imagesErrorCount :  $this->imagesErrorCount += 1;
  }

  /* Analyze the headings of the webbpage. */
  private function CheckHeadingsOfWebpage(){
    
    foreach($this->headingsOnWebpage as $heading => $array){
      $html = $this->webcontent->find($heading);
      if(count($html) > 0){
        foreach($html as $element){
          $this->headingCount++;
          $this->headingsOnWebpage[$heading][] = $element->plaintext;
          $headingArray =  strtolower($element->plaintext);
          $headingArray = str_replace(".","", $headingArray);
          $headingArray = str_replace(",","",$headingArray);
          $headingArray = explode(" ", $headingArray);
          $headingArray = array_map('strtolower', $headingArray);
          $containedKeyword = false;
          foreach($headingArray as $word){
            if (in_array(strtolower($word), $this->keywords)){
                array_push($this->keywordsThatDoAppearsInHeadings, $word);
                $containedKeyword = true;
            }
        }
        if($containedKeyword && $heading != "h1"){
          $this->semiHeadingsContainsKeywordCount++;
         }
      }
      foreach($this->keywords as $keyword){
        if(!in_array($keyword,$this->keywordsThatDoAppearsInHeadings)){
            array_push($this->keywordsThatDoNotAppearsInHeadings, $keyword);
        }

        if(count($this->headingsOnWebpage["h1"]) > 0){
          foreach($this->headingsOnWebpage["h1"] as $headline){
              if ( (strpos(strtolower($headline), strtolower($keyword)) !== false)) {
              //if (preg_match("~\b".strtolower($keyword)."\b~", strtolower($headline))){
                 $this->H1TagContainsKeyword = true;
            }
          } 
        }
       }
      }
    }
    $this->headingsContainsOneH1Tag = (count($this->headingsOnWebpage["h1"]) == 1) ? true : false;
    $this->headingsContainsLessThenOneH1Tag = (count($this->headingsOnWebpage["h1"]) < 1) ? true : false;
    $this->headingsContainsMoreThenOneH1Tag = (!empty($this->headingsOnWebpage["h1"]) && count($this->headingsOnWebpage["h1"]) > 1) ? true : false;
    $this->headingsContainOneOrMoreOfKeywords = (count($this->keywordsThatDoAppearsInHeadings) > 0) ? true : false;

     if($this->multipleKeywords){
       foreach($this->headingsOnWebpage as $headingType){
         foreach($headingType as $heading){
           if ( (strpos(strtolower($heading), strtolower($this->keywordsInSentence)) !== false)) {
              $this->keywordSenteceExistsInHeading = true;
              break;
            } else {
              $this->keywordSenteceExistsInHeading = false;
            }
         }
         if($this->keywordSenteceExistsInHeading){
            break;
         }
      }
    }else{
      $this->keywordSenteceExistsInHeading = $this->headingsContainOneOrMoreOfKeywords;
    }
    $this->keywordsThatDoAppearsInHeadings = array_unique($this->keywordsThatDoAppearsInHeadings);
    $this->keywordsThatDoNotAppearsInHeadings = array_unique($this->keywordsThatDoNotAppearsInHeadings);
   
    $this->headingErrorCount = ($this->headingsContainsMoreThenOneH1Tag || $this->headingsContainsLessThenOneH1Tag) ? $this->headingErrorCount += 1 : $this->headingErrorCount;
    $this->headingErrorCount = (count($this->keywordsThatDoAppearsInHeadings) > 0 ) ? $this->headingErrorCount : $this->headingErrorCount += 1;
    $this->headingErrorCount = ( $this->H1TagContainsKeyword ) ? $this->headingErrorCount : $this->headingErrorCount += 1;
    $this->headingErrorCount = ($this->semiHeadingsContainsKeywordCount > 0 && $this->semiHeadingsContainsKeywordCount < 4 ) ? $this->headingErrorCount : $this->headingErrorCount += 1;

  }
  
  /* Analyze the text of the webpage.  */
  private function CheckTextOfWebpage(){
    $html = $this->webcontent->find('body');
/*    $html = array_merge($html , $this->webcontent->find('h1'));
    $html = array_merge($html , $this->webcontent->find('h2'));
    $html = array_merge($html , $this->webcontent->find('h3'));
    $html = array_merge($html , $this->webcontent->find('h4'));
    $html = array_merge($html , $this->webcontent->find('h5'));
    $html = array_merge($html , $this->webcontent->find('h5'));
   // $html = array_merge($html , $this->webcontent->find('li'));
    $html = array_merge($html , $this->webcontent->find('a'));*/

    $empashedHTML = $this->webcontent->find('b');
    $empashedHTML = array_merge($empashedHTML , $this->webcontent->find('u'));
    $empashedHTML = array_merge($empashedHTML , $this->webcontent->find('em'));
    $empashedHTML = array_merge($empashedHTML , $this->webcontent->find('i'));
    $empashedHTML = array_merge($empashedHTML , $this->webcontent->find('strong'));
    $empashedHTML = array_merge($empashedHTML , $this->webcontent->find('blockquote'));
    
    foreach($empashedHTML as $element){
      foreach($this->keywords as $keyword){        
        if (preg_match("~\b".strtolower($keyword)."\b~", strtolower($element->plaintext))){
            array_push($this->emphasisedKeywords, $keyword);
        }
      }
    }
    
    
    
    $allText = array();
    $allWords = array();
    $finalWords = array();
    
    foreach($html as $textObject){
      $sentenceFound = false;
      
      $text = strtolower($textObject->plaintext);
      $text = str_replace(".","", $text);
      $text = str_replace(",","",$text);
      $allWords = array_count_values(explode(' ', $textObject->plaintext));
    
       foreach($allWords as $name => $count){
        $word = $name;
        $word = strip_tags($word);
        $word = preg_replace('/\s+/', '', $word);
        $word = str_replace(' ', '', $word);
        $word = str_replace("-"," ",$word);
        $word = str_replace('&nbsp', '', $word);
        $word = str_replace(".","", $word);
        $word = str_replace(",","",$word); 
        $word = trim(html_entity_decode($word));
        $replace = array('a', 'a', 'o');
        $search = array('ä', 'å', 'ö');
        $search = array('&aring;', '&auml;', '&ouml');
        $utfWord = str_replace($search, $replace, trim($word));
        $utfWord = str_replace(";","", $word);
        $utfWord = utf8_encode($word);
        $wordLength =  mb_strlen(strip_tags($utfWord));

      if($wordLength < 1){
          unset($allWords[$name]);
      }else{
      //  if(!preg_match_all("/[0-9]/", strtolower($word))){
         
          $key  = strtolower($word);
          $key = trim($key);
          $key = str_replace(".","", $key);
          $key = str_replace(",","", $key);
          
          if(array_key_exists(strtolower($word), $finalWords)){
            if(isset($finalWords[$key])){
             $finalWords[$key] += $count;
            }else{
             $finalWords[$key] = $count;
            }
          }else{
             $finalWords[$key] = $count;
          }
      //  }else{
      //    unset($allWords[$name]);
       // }
      }
    }
      
      $this->wordCount = array_sum($finalWords);
      $alltext= strtolower(trim(strip_tags($textObject->plaintext)));
      
      /* Check all words againt keywords */   
      foreach($this->keywords as $keyword){
        $keywordFound = array_key_exists(strtolower($keyword), $finalWords);
        if($keywordFound){
          $this->totalKeywordAppearenceCount += $finalWords[strtolower($keyword)];
          array_push($this->keywordsThatAppearOnPage, $keyword);
          $this->keywordAppearenceCount[$keyword] = $finalWords[strtolower($keyword)];
        }else{
          array_push($this->keywordsThatDoNotAppearsOnPage, $keyword);
        }
      if(!$sentenceFound){
        if($this->multipleKeywords){
          // if (strpos(strtolower(strip_tags($textObject->innertext)), strtolower($this->keywordsInSentence)) !== false) {
          if (substr_count(strtolower($alltext), strtolower(($this->keywordsInSentence)))) {
              $senteceFound = true;
              $this->keywordSenteceExistsInText = true;
          } else {
              $this->keywordSenteceExistsInText = ($this->keywordSenteceExistsInText) ? true : false;
            }
          }
         }
       }
      }
    
    
    

    
    
    if ($this->totalKeywordAppearenceCount > 0 &&  $this->totalKeywordAppearenceCount <= 5 ){
        $this->keywordsAppearsMultipleTimesOnPage = true;
    }else{
        $this->keywordsAppearsMultipleTimesOnPage = false;
    }
   // $this->wordCount = count($this->allWordsOnWebpage);
    $this->keywordsAppearOnPage = (count($this->keywordsThatAppearOnPage) > 0) ? true : false;
    $this->keywordSenteceExistsInText = (!$this->multipleKeywords) ? $this->keywordsAppearOnPage : $this->keywordSenteceExistsInText;
    arsort($finalWords); // Sort it to get the most occurence on top
    foreach($finalWords as $word => $value){
      if(in_array($word, $this->usualWords) || strpos($word, '@') !== false || htmlentities($word) == "&nbsp;"){
          unset($finalWords[$word]);
      }
    }
    
    $this->topFiveUsedWords = array_slice($finalWords, 0, 5, true);
    foreach($this->keywordAppearenceCount as $keyword => $value){
        $density = ((intval($value) / intval($this->wordCount)) * 100);
        $this->keywordDensity[$keyword] = round($density,2);
    }
        
    $this->keywordsThatAppearOnPage = array_unique($this->keywordsThatAppearOnPage);
    $this->emphasisedKeywords = array_unique($this->emphasisedKeywords);
    $this->keywordsThatDoNotAppearsOnPage = array_unique($this->keywordsThatDoNotAppearsOnPage);
    
    $this->textErrorCount = ( array_sum($this->keywordDensity) > 1 && array_sum($this->keywordDensity) < 5) ? $this->textErrorCount : $this->textErrorCount += 1;
    $this->textErrorCount = ( $this->wordCount > 400) ? $this->textErrorCount : $this->textErrorCount += 1;
    //$this->textErrorCount = ( array_sum($this->keywordAppearenceCount) < 5) ? $this->textErrorCount : $this->textErrorCount += 1;
    $this->textErrorCount = ( count($this->emphasisedKeywords) > 0) ? $this->textErrorCount : $this->textErrorCount += 1;
    $this->textErrorCount = ($this->keywordsAppearOnPage) ? $this->textErrorCount : $this->textErrorCount += 1;
  }
  
  /* Check if webpage is responsive. */
  private function CheckIfWebpageIsResponsive(){
    
    $page = $this->webpage;
    $url = "https://www.googleapis.com/pagespeedonline/v3beta1/mobileReady?key=".$this->googleInsightKey."&url=".$page."&strategy=mobile";
    //$url = "https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url='.$this->webpage.'&key='.$this->googleInsightKey.'";
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $url,
    ));
    $result = curl_exec($curl);
    curl_close($curl);
    //result as an array
    $result = json_decode($result);
    if($result != false){
      if(isset($result->ruleGroups->USABILITY)){
        if($result->ruleGroups->USABILITY != false){
          $this->webpageIsResponsive = ($result->ruleGroups->USABILITY->pass == 1) ? true : false;
          $this->webpageIsResponsiveScore = $result->ruleGroups->USABILITY->score;
        }else{
          $this->webpageIsResponsive = false;
          $this->webpageIsResponsiveScore = 40;
        }
      }else{
          $this->webpageIsResponsive = false;
          $this->webpageIsResponsiveScore = 40;
      }
      
      
      $this->currentCMS  =  (isset($result->pageStats->cms)) ? $result->pageStats->cms : "Okänt";
      $this->isUsingCMS = (isset($result->pageStats->cms)) ? true : false;
    }    
  }
  
  /* Check speed for webpage. */
  private function CheckPageSpeedOfWebpage(){
    
    $http = ($this->isHTTP) ? "https://" : "http://";    
    $page = $this->webpage;
    $url = "https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=".$page;
    //$url = "https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=http://".$this->webpageCleanName."&strategy=desktop&key=".$this->googleInsightKey."";
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $url,
        ));
    $result = curl_exec($curl);
    curl_close($curl);
    //result as an array
    $result = json_decode($result);

    if(isset($result->formattedResults)){
    if($result->formattedResults->ruleResults != false){
        $this->timeToLoadPage = $result->formattedResults->ruleResults->MainResourceServerResponseTime->ruleImpact;
    }else{
        $this->timeToLoadPage = "Gick inte att mäta tiden för att ladda sidan";
    }
      
    if($result->ruleGroups->SPEED != false){
        $this->googleSpeedScore = $result->ruleGroups->SPEED->score;
    }else{
        $this->googleSpeedScore = 0;
    }
    
    $this->pageLoadOk = ($this->timeToLoadPage < 2) ? true : false;
    
    }else{
        $this->timeToLoadPage = "Gick inte att mäta tiden för att ladda sidan";
        $this->googleSpeedScore = 0;
    }
  }
       
  /* Analyze the domain. */
  private function CheckDomainForWebpage(){
    $domainChecker = new seoDomainChecker();  
    $this->domainContainsSeperator = (strpos($this->webpageCleanName, "-") !== false) ? true : false;    
    $this->domainnameIsNotToLong = (mb_strlen($this->webpageCleanName) < 15) ? true : false;
    
    
    foreach($this->keywords as $keyword){
      if (strpos(strtolower(  $this->webpageCleanName), strtolower($keyword)) !== false){
        $this->domainnameContainsKeyword = true;
        array_push($this->keywordDoAppearInDomainname, $keyword);
      }else{
        $this->domainnameContainsKeyword = false;
      }
    }
    
    if($this->multipleKeywords){
      if (strpos(strtolower(strip_tags($this->webpageCleanName)), strtolower($this->keywordsInSentence)) !== false) {
        $this->keywordSenteceExistsInDomainName = true;
      } else {
        $this->keywordSenteceExistsInDomainName = ($this->keywordSenteceExistsInDomainName) ? true : false;
      }
    }else{
      $this->keywordSenteceExistsInDomainName = $this->domainnameContainsKeyword;
    }

    $remove = (substr(strtolower($this->webpageCleanName), 0, 11) == "http://www.") ?  11 : false;
    $remove = (substr(strtolower($this->webpageCleanName), 0, 12) == "https://www.") ? 12 : $remove;
    $remove = (substr(strtolower($this->webpageCleanName), 0, 4) == "www.") ? 4 : $remove;

    $domainNameFixed = ($remove != false) ? (substr($this->webpageCleanName, $remove)) : $this->webpageCleanName;
    $domainNameFixed = idn_to_ascii( $domainNameFixed  ); // Fixar å ä ö.

  
    $ageOfDomain = $domainChecker->GetAgeOfDomain($this->absoluteURL);
    
    $this->ageOfDomainYears = (isset($ageOfDomain["years"])) ? $ageOfDomain["years"] : "Okänt";
    $this->ageOfDomainYears = ($this->ageOfDomainYears < 30) ?  $this->ageOfDomainYears : "Okänt";
    $this->ageOfDomainDays = (isset($ageOfDomain["days"])) ? $ageOfDomain["days"] : $ageOfDomain["days"];

    $html = $this->webcontent->find('link');
    foreach($html as $element){
      if($element->rel == "canonical"){
        $canonical = (substr(strtolower( $element->href), -1) == "/") ? strtolower(substr( $element->href,0,-1)) : $element->href;
        $this->domainIsCanonical = ($this->webpageNameWithWWW === $canonical || $this->webpageNameWithWWW === $canonical ) ? "it is" : "its not";
        $this->domainChoosedCanonical = $element->href;
        break;
      }else{
        $this->domainIsCanonical = false;
      }
    }

   // $this->domainErrorCount =  ($this->domainnameIsNotToLong) ? $this->domainErrorCount : $this->domainErrorCount += 1;
    $this->domainErrorCount =  ($this->domainnameContainsKeyword) ? $this->domainErrorCount : $this->domainErrorCount += 1;
    $this->domainErrorCount =  ($this->domainContainsSeperator) ?  $this->domainErrorCount += 1 : $this->domainErrorCount;
    $this->domainErrorCount =  ($this->domainIsCanonical) ? $this->domainErrorCount : $this->domainErrorCount += 1;
  }
  
  /* Check if webpage contains intern css  */
  private function CheckIfWebpageContainsCSS(){
    $styleTag = $this->webcontent->find("style");
    $allTags = $this->webcontent->outertext;
    
    foreach($styleTag as $element){
      $this->sourceCodeContainsStyleTag = (strlen($element->innertext) > 0) ? true : false;
      if($this->sourceCodeContainsStyleTag){ break; }
    }
      
    $this->sourceCodeContainsCSS =  (strpos(strtolower($allTags), 'style="')) ? true : false;
  
  }
  
  /* Set words that should be excluded from top five words */
  private function SetUsualWords(){
    $this->usualWords = array(
      "oss", "vi", "i", "och", "om", "eller", "kontakta", "ska", "vill","er","kan","på", "är", "ett", "en", "ni", "har", "då", "till","för", "det","vår", "som","att","man", "du","av","med","alla","så","mer","*","obligatorisk","fyll","våra","inte","den","ab","AB","från","-","här","efter","de", "." ,"nu" , "--","–", "gör","gjort" ,"+","•", "år", "när", "nära", "nya", "både", "dig", "icke", "din", "tid", "gäller", "har", "vad", "ditt", "egna", "eget", "via", "detta", "a", "á" ,"hat", "top", "mot", "jag","|", " ", "  ", "   ", "&nbsp;");
  
  }
  
}


?>