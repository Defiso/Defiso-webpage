
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class seoHTMLTemplate{

  public $analyze = "";


  public function printHTMLReport(){

      $okMessage = "Allt ser bra ut!";
      $errorMessage = " fel.";
      $okImage = "/wp-content/themes/defisomedia/inc/seoTool/src/img/check.png";
      $errorImage = "/wp-content/themes/defisomedia/inc/seoTool/src/img/cross.png";
      $logo = "/wp-content/themes/defisomedia/inc/seoTool/src/img/logo.png";
      $keywordString = ($this->analyze->multipleKeywords) ? "Sökorden" : "Sökord";

      /* Dynamic parameters */

      /* Header */
      $url = $this->analyze->orignalName;
      $keywords = $this->analyze->keywordsInSentence;
      $loadingResult = ($this->analyze->timeToLoadPage < 3) ? 'Bra!' : 'Dålig';
      $domainAge = ($this->analyze->ageOfDomainYears != "Okänt" ) ? $this->analyze->ageOfDomainYears ."år ". $this->analyze->ageOfDomainDays ."d" : "Okänt";
      $domainAge = ($this->analyze->ageOfDomainYears == "Okänt" &&  $this->analyze->ageOfDomainDays > 0 ) ?  $this->analyze->ageOfDomainDays ."d"  : $domainAge;
      $mobileFriendly = ($this->analyze->webpageIsResponsive) ? 'Ja!' : 'Nej';
      $mobileScore =  $this->analyze->webpageIsResponsiveScore ."/100";
      $CMS = $this->analyze->currentCMS;

      /* Title */
      $titlePass["image"] = ($this->analyze->titleErrorCount == 0) ? $okImage : $errorImage;
      $titlePass["message"] = ($this->analyze->titleErrorCount == 0) ? $okMessage : $errorMessage;
      $titlePass["error"] = ($this->analyze->titleErrorCount == 0) ? "" : $this->analyze->titleErrorCount;

      $titleContainKeyword["image"] = ($this->analyze->keywordsAppearsInTitle) ? $okImage : $errorImage;
      $titleContainKeyword["message"] = ($this->analyze->keywordsAppearsInTitle) ? "Titeln innehåller det angivna sökordet" : "Titeln innehåller inte det angivna sökordet";
      $titleContainKeyword["image"] = ($this->analyze->keywordsAppearsMoreThanTwice) ? $errorImage : $titleContainKeyword["image"];
      $titleContainKeyword["message"] = ($this->analyze->keywordsAppearsMoreThanTwice) ? "Titeln innehåller sökordet mer än två gånger och riskerar att uppfattas som spammig." : $titleContainKeyword["message"];


      $titleNotToLong["image"] = ($this->analyze->titleIsOk) ? $okImage : $errorImage;

      $titleNotToLong["message"] = ($this->analyze->titleIsToShort) ? "Titeln är för kort. Man bör utnyttja det tillgängliga utrymmet maximalt och göra sin titel så informativ som möjligt." : "Längden på titeln är bra";
      $titleNotToLong["message"] = ($this->analyze->titleIsToLong) ? "Titeln är för lång. När den är över 60 tecken lång är risken stor att sökmotorn ”klipper av” texten och information går därmed förlorad." : $titleNotToLong["message"];
      $titleNotToLong["message"] = ($this->analyze->titleIsOk) ? "Längden på titeln är bra!" :  $titleNotToLong["message"];


      /* Description */
      $descriptionPass["image"] = ($this->analyze->descriptionErrorCount == 0) ? $okImage : $errorImage;
      $descriptionPass["message"] = ($this->analyze->descriptionErrorCount == 0) ? $okMessage: $errorMessage;
      $descriptionPass["error"] = ($this->analyze->descriptionErrorCount == 0) ? "" : $this->analyze->descriptionErrorCount;



      $descriptionContainsKeywords["image"] =  ($this->analyze->keywordsAppearsInDescription) ? $okImage : $errorImage;
      $descriptionContainsKeywords["message"] =  ($this->analyze->keywordsAppearsInDescription) ? "Webbplatsens beskrivning innehåller det angivna sökordet" :  "Webbplatsens beskrivning innehåller <u>inte</u> det angivna sökordet";

      $descriptionContainsKeywords["image"] =  ($this->analyze->descriptionContainsKeywordsMoreThanThreeTimes) ? $errorImage :  $descriptionContainsKeywords["image"] ;
      $descriptionContainsKeywords["message"] =  ($this->analyze->descriptionContainsKeywordsMoreThanThreeTimes) ? "Titeln innehåller sökordet mer än tre gånger och riskerar att uppfattas som spammig." :  $descriptionContainsKeywords["message"];

      $descriptionNoToLong["image"] =  ($this->analyze->descriptionIsOk) ? $okImage : $errorImage;
      $descriptionNoToLong["message"] =  ($this->analyze->descriptionIsToShort) ? "Description är för kort. Man bör utnyttja det tillgängliga utrymmet maximalt och göra sin description så informativ och säljande som möjligt." :  "Webbplatsens beskrivning är <u>längre än 50 tecken</u>";

      $descriptionNoToLong["message"] =  ($this->analyze->descriptionIsToLong) ? "Description är för lång. När den är över 155 tecken lång är risken stor att sökmotorn ”klipper av” texten och information går därmed förlorad." :  $descriptionNoToLong["message"];

      $descriptionNoToLong["message"] =  ($this->analyze->descriptionIsOk) ? "Längden på description är bra!" :  $descriptionNoToLong["message"];


      /* Images */
      $imagesPass["image"] = ($this->analyze->imagesErrorCount == 0) ? $okImage : $errorImage;
      $imagesPass["message"] = ($this->analyze->imagesErrorCount == 0) ? $okMessage : $errorMessage;
      $imagesPass["error"] = ($this->analyze->imagesErrorCount == 0) ? "" : $this->analyze->imagesErrorCount;

      $imagesAltContainsKeyword["image"] =  ($this->analyze->imagesAltTagsContainingKeywords) ? $okImage : $errorImage;
      $imagesAltContainsKeyword["message"] = ($this->analyze->imagesAltTagsContainingKeywords) ? "Sökordet finns med i någon ALT-tagg på sidan." :  "Sökordet finns inte med i någon ALT-tagg på sidan.";

      $imagesAltMissingCount["image"] =  ($this->analyze->imagesMissingAltTagsCount == 0) ? $okImage : $errorImage;
      $imagesAltMissingCount["message"] =  ($this->analyze->imagesMissingAltTagsCount == 0) ? "Ingen av bilderna saknar ALT-tagg" : "{$this->analyze->imagesMissingAltTagsCount} bild/er på sidan saknar ALT-tagg.";

      $imagesFilenameContainsKeyword["image"] =  ($this->analyze->imagesFilenameContainingKeywords) ? $okImage : $errorImage;
      $imagesFilenameContainsKeyword["message"] =  ($this->analyze->imagesFilenameContainingKeywords) ? "Sökordet finns med i minst ett filnamn på sidans bilder." : "Sökordet finns inte med i någon av bildernas filnamn på sidan.";



      /*Text*/
      $textPass["image"] = ($this->analyze->textErrorCount == 0) ? $okImage : $errorImage;
      $textPass["message"] = ($this->analyze->textErrorCount == 0) ? $okMessage : $errorMessage;
      $textPass["error"] = ($this->analyze->textErrorCount == 0) ? "" : $this->analyze->textErrorCount;

      $totalWordCount["image"] =  ($this->analyze->wordCount > 400) ? $okImage : $errorImage;
      $totalWordCount["message"] =  ($this->analyze->wordCount > 400) ? "Texten innehåller fler än 400 ord." : "Texten innehåller färre än 400 ord.";

      $keywordAppearsMoreThenFiveTimes["image"] =  (array_sum($this->analyze->keywordAppearenceCount) < 5 ) ? $okImage : $errorImage;
      $keywordAppearsMoreThenFiveTimes["message"] =  (array_sum($this->analyze->keywordAppearenceCount) < 5 ) ? "Sökorden förekommer inte fler än fem gånger i webbplatsens texter" : "Sökordet förekommer fler än fem gånger i webbplatsens texter";

      $keywordsAreNotEmphasized["image"] = ( count($this->analyze->emphasisedKeywords) > 0) ? $okImage : $errorImage;
      $keywordsAreNotEmphasized["message"] = ( count($this->analyze->emphasisedKeywords) > 0) ? "Sökordet är understruket, fetstilat och/eller kursiverat någonstans i brödtexten." : "Sökordet är varken understruket, fetstilat eller kursiverat någonstans i brödtexten.";

      $keywordsAppearsInText["image"] = ( $this->analyze->keywordsAppearOnPage) ? $okImage : $errorImage;
      $keywordsAppearsInText["message"] = ( $this->analyze->keywordsAppearOnPage) ? "Webbplatsens har en text som innehåller sökordet." : "Webbplatsens har <u>inte</u> en text som innehåller sökordet.";


      $keywordDensity = array_sum($this->analyze->keywordDensity);

      $density["image"] = ( $keywordDensity > 1 && $keywordDensity < 5 ) ? $okImage : $errorImage;
      $density["message"] = ( $keywordDensity < 1 ) ? "Sökordsdensiteten är för låg." : "";
      $density["message"] = ( $keywordDensity > 5 ) ? "Sökordsdensiteten är för hög och texten riskerar att uppfattas som spammig." : $density["message"];
      $density["message"] = ( $keywordDensity > 1 && $keywordDensity < 5  ) ? "Sökordsdensiteten är på en bra nivå." : $density["message"];

      $wordCount = $this->analyze->wordCount;
      $keywordAppearenceCount =  array_sum($this->analyze->keywordAppearenceCount);
      $topFiveWords = "";
      foreach($this->analyze->topFiveUsedWords as $word => $value){
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

      $headlinePass["image"] = ($this->analyze->headingErrorCount == 0) ? $okImage : $errorImage;
      $headlinePass["message"] = ($this->analyze->headingErrorCount == 0) ? $okMessage : $errorMessage;
      $headlinePass["error"] = ($this->analyze->headingErrorCount == 0) ? "" : $this->analyze->headingErrorCount;

      $pageContainsOnlyOneH1Tag["image"] = ($this->analyze->headingsContainsOneH1Tag ) ? $okImage : $errorImage;
      $pageContainsOnlyOneH1Tag["message"] = ($this->analyze->headingsContainsOneH1Tag) ? "Sidan innehåller en H1-rubrik." : "Sidan innehåller fler än en H1-rubrik.";

      $pageContainsOnlyOneH1Tag["image"] = ($this->analyze->headingsContainsLessThenOneH1Tag) ? $errorImage : $pageContainsOnlyOneH1Tag["image"];
      $pageContainsOnlyOneH1Tag["message"] = ($this->analyze->headingsContainsLessThenOneH1Tag) ? "Sidan saknar H1-rubrik." : $pageContainsOnlyOneH1Tag["message"];

      $pageContainsOnlyOneH1Tag["image"] = ($this->analyze->headingsContainsMoreThenOneH1Tag) ? $errorImage : $pageContainsOnlyOneH1Tag["image"];
      $pageContainsOnlyOneH1Tag["message"] = ($this->analyze->headingsContainsMoreThenOneH1Tag) ? "Sidan innehåller fler än en H1-rubrik" : $pageContainsOnlyOneH1Tag["message"];

      $H1TagsContainsKeyword["image"] = ($this->analyze->H1TagContainsKeyword) ? $okImage : $errorImage;
      $H1TagsContainsKeyword["message"] = ($this->analyze->H1TagContainsKeyword) ? "H1-rubriken innehåller det angivna sökordet" : "H1-rubriken innehåller inte det angivna sökordet";

      $keywordAppearsInHeadlines["image"] = (count($this->analyze->keywordsThatDoAppearsInHeadings) > 0) ?  $okImage : $errorImage;
      $keywordAppearsInHeadlines["message"] = (count($this->analyze->keywordsThatDoAppearsInHeadings) > 0) ? "Sökordet finns i en webbplatsens rubriker." : "Sökordet finns inte i någon av webbplatsens rubriker.";

      $keywordAppearsInSemiHeadlines["image"] = ($this->analyze->semiHeadingsContainsKeywordCount > 0 && $this->analyze->semiHeadingsContainsKeywordCount < 4) ?  $okImage : $errorImage;
      $keywordAppearsInSemiHeadlines["message"] = ($this->analyze->semiHeadingsContainsKeywordCount > 0 && $this->analyze->semiHeadingsContainsKeywordCount < 4) ? $this->analyze->semiHeadingsContainsKeywordCount." st mellanrubrik/er innehåller det angivna sökordet." : "Sökordet finns inte i någon utav webbplatsens mellanrubrik/er.";
      $keywordAppearsInSemiHeadlines["image"] = ($this->analyze->semiHeadingsContainsKeywordCount > 3) ?  $errorImage : $keywordAppearsInSemiHeadlines["image"];
      $keywordAppearsInSemiHeadlines["message"] = ($this->analyze->semiHeadingsContainsKeywordCount > 3) ? "Fler än tre rubriker på sidan innehåller det angivna sökordet, vilket riskerar att uppfattas som spammigt.": $keywordAppearsInSemiHeadlines["message"];

     /* $allHeadlines = "";

      foreach($this->analyze->headingsOnWebpage as $name => $group){
        if(count($group) > 0){
          foreach($group as $text){

            $allHeadlines .= "<h5><small>{$name} - {$text}.</small></h5>";


          }
        }
      }
      */


      /*Domain*/

      $domainPass["image"] = ($this->analyze->domainErrorCount == 0) ? $okImage : $errorImage;
      $domainPass["message"] = ($this->analyze->domainErrorCount == 0) ? $okMessage : $errorMessage;
      $domainPass["error"] = ($this->analyze->domainErrorCount == 0) ? "" : $this->analyze->domainErrorCount;

      //$domainNamePass["image"] = ($this->analyze->domainnameIsNotToLong) ?  $okImage : $errorImage;
      //$domainNamePass["message"] = ($this->analyze->domainnameIsNotToLong) ? "Domännamnet är inte längre än 15 tecken." : "Domännamnet är längre än 15 tecken.";


      $domainContainSeperator["image"] = (!$this->analyze->domainContainsSeperator) ?  $okImage : $errorImage;
      $domainContainSeperator["message"] = ($this->analyze->domainContainsSeperator) ? "Domännamnet innehåller bindestreck." : "Domännamnet innehåller inte ett bindestreck.";

      $domainNameContainsKeywords["image"] = ($this->analyze->domainnameContainsKeyword) ?  $okImage : $errorImage;
      $domainNameContainsKeywords["message"] = ($this->analyze->domainnameContainsKeyword) ? "Domänen innehållet det angivna sökordet." : "Domänen innehåller inte det angiva sökordet.";

      $canonicalPass["image"] = ($this->analyze->domainIsCanonical) ?  $okImage : $errorImage;
      $canonicalPass["message"] = ($this->analyze->domainIsCanonical) ? "Domännamnet är canonical-deklarerat." : "Domännamnet är inte canonical-deklarerat.";

      /*Result*/
      $resultTitle = "<h3>Det här gick ju bra!</h3>";
      $resultText  = "<p>Text om resultatet</p>";

      /* Gör något trevligt av detta */

      $html = <<<EOD
      <div class="seo-result content">

        <div class="seo-info">
          <div class="website">
            <h2>Hemsida</h2>
            <a href="http://{$url}" target="_blank">{$url}</a>
          </div>
          <div class="search-term">
            <h2>Sökord</h2>
            {$keywords}
          </div>
          {$loadingResult}
          {$domainAge}
          {$mobileFriendly}
          {$mobileScore}
          {$CMS}
        </div>

        <hr>

        <div class="seo-info">
          <div class="title">
            <header>
              <h2>Titel</h2>
              <div class="status">
                <img src="{$titlePass["image"]}" alt="Statusikon">
                {$titlePass["error"]}{$titlePass["message"]}
              </div>
            </header>
          </div>
          <div class="content">
            <div class="info">
              <p>
                Alla webbsidor ska ha en titel. I en sökmotors ögon är titeln det viktigaste för att bedöma vad en webbsida handlar om och för vilka sökord sidan ska rankas högt på. Titeln bör vara maximalt 60 tecken lång och innehålla sökordet, men maximalt två gånger. Sökordet bör komma så tidigt som möjligt i titeln.
              </p>
            </div>
            <div class="errors">
              <ul>
                <li><img src="{$pageContainsOnlyOneH1Tag["image"]}"> {$pageContainsOnlyOneH1Tag["message"]}</li>
                <li><img src="{$titleContainKeyword["image"]}"> {$titleContainKeyword["message"]}</li>
                <li><img src="{$titleNotToLong["image"]}">{$titleNotToLong["message"]}</li>
              </ul>
            </div>
          </div>
        </div>

        <hr>

        <div class="seo-info">
          <div class="title">
            <header>
              <h2>Meta description</h2>
              <div class="status">
                <img src="{$descriptionPass["image"]}" alt="Statusikon">
                {$descriptionPass["error"]}{$descriptionPass["message"]}
              </div>
            </header>
          </div>
          <div class="content">
            <div class="info">
              <p>
                Meta description är det första en potentiell kund läser om ditt företag och texten bör vara både informativ och säljande. Description är inte avgörande för optimeringen men man bör ändå ha med sökordet. Description bör vara maximalt 155 tecken lång.
              </p>
            </div>
            <div class="errors">
              <ul>
                <li><img src="{$descriptionContainsKeywords["image"]}"> {$descriptionContainsKeywords["message"]}</li>
                <li><img src="{$descriptionNoToLong["image"]}"> {$descriptionNoToLong["message"]}</li>
              </ul>
            </div>
          </div>
        </div>

        <hr>

        <div class="seo-info">
          <div class="title">
            <header>
              <h2>Rubriker</h2>
              <div class="status">
                <img src="{$headlinePass["image"]}" alt="Statusikon">
                {$headlinePass["error"]}{$headlinePass["message"]}
              </div>
            </header>
          </div>
          <div class="content">
            <div class="info">
              <p>
                Rubriker är en viktig signal till sökmotorer om vad en sida handlar om. Viktigast av allt är huvudrubriken, H1, som bör innehålla sökordet så tidigt som möjligt. Det är även bra om sökordet finns med i någon av underrubrikern (H2, H3, osv). Man bör dock inte spamma och använda sökordet i varenda rubrik.
              </p>
            </div>
            <div class="errors">
              <ul>
                <li><img src="{$pageContainsOnlyOneH1Tag["image"]}"> {$pageContainsOnlyOneH1Tag["message"]}</li>
                <li><img src="{$H1TagsContainsKeyword["image"]}"> {$H1TagsContainsKeyword["message"]}</li>
                <li><img src="{$keywordAppearsInHeadlines["image"]}"> {$keywordAppearsInHeadlines["message"]}</li>
                <li><img src="{$keywordAppearsInSemiHeadlines["image"]}"> {$keywordAppearsInSemiHeadlines["message"]}</li>
              </ul>
            </div>
          </div>
        </div>

        <hr>

        <div class="seo-info">
          <div class="title">
            <header>
              <h2>Brödtext</h2>
              <div class="status">
                <img src="{$textPass["image"]}" alt="Statusikon">
                {$textPass["error"]}{$textPass["message"]}
              </div>
            </header>
          </div>
          <div class="content">
            <div class="info">
              <p>
                En väloptimerad sida bör innehålla minst 400 ord relevant text kring sökordet man vill ranka på. Någon övre gräns finns egentligen inte. Exakt hur många gånger sökordet bör förekomma i texten går inte att säga, men texten måste vara naturligt skriven och inte spammig. Ha gärna sökordet i kursiv stil, fetstil eller understruket någon gång i texten.
              </p>
            </div>
            <div class="errors">
              <ul>
                <li><img src="{$totalWordCount["image"]}"> {$totalWordCount["message"]}</li>
                <li><img src="{$density["image"]}"> {$density["message"]}</li>
                <li><img src="{$keywordsAreNotEmphasized["image"]}"> {$keywordAppearsMoreThenFiveTimes["message"]}</li>
                <li><img src="{$keywordsAppearsInText["image"]}"> {$keywordsAppearsInText["message"]}</li>
              </ul>
            </div>
            <p>
              {$topFiveWords}
            </p>
          </div>
        </div>

        <hr>

        <div class="seo-info">
          <div class="title">
            <header>
              <h2>Bilder</h2>
              <div class="status">
                <img src="{$imagesPass["image"]}" alt="Statusikon">
                {$imagesPass["error"]}{$imagesPass["message"]}
              </div>
            </header>
          </div>
          <div class="content">
            <div class="info">
              <p>
                Att använda sig av ALT-tagg på bilder är viktigt för både bildsöket och det vanliga sökresultatet. Alla bilder på en sida bör ha ALT-tagg och sökordet bör finnas med i ALT-taggen på minst en av bilderna. Välj bild med omsorg då ALT-taggen ska beskriva bilden. Det är även ett plus om sökordet finns med i filnamnet på någon bild.
              </p>
            </div>
            <div class="errors">
              <ul>
                <li><img src="{$imagesAltContainsKeyword["image"]}"> {$imagesAltContainsKeyword["message"]}</li>
                <li><img src="{$imagesAltMissingCount["image"]}"> {$imagesAltMissingCount["message"]}</li>
                <li><img src="{$imagesFilenameContainsKeyword["image"]}"> {$imagesFilenameContainsKeyword["message"]}</li>
              </ul>
            </div>
          </div>
        </div>

        <hr>

        <div class="seo-info">
          <div class="title">
            <header>
              <h2>Domännamn</h2>
              <div class="status">
                <img src="{$domainPass["image"]}" alt="Statusikon">
                {$domainPass["error"]}{$domainPass["message"]}
              </div>
            </header>
          </div>
          <div class="content">
            <div class="info">
              <p>
                Domännamnet har en viss påverkan på optimeringen. Det bör inte vara för långt och krånligt och det får gärna innehålla det aktuella sökordet. Domännament bör helst inte innehålla bindestreck.
              </p>
            </div>
            <div class="errors">
              <ul>
                <li><img src="{$domainContainSeperator["image"]}"> {$domainContainSeperator["message"]}</li>
                <li><img src="{$domainNameContainsKeywords["image"]}"> {$domainNameContainsKeywords["message"]}</li>
                <li><img src="{$canonicalPass["image"]}"> {$canonicalPass["message"]}</li>
              </ul>
            </div>
          </div>
        </div>
    </div>

EOD;
      return $html;
  }


}
