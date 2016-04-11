<!doctype HTML>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="main.css">
  </head>
  <body>
      <div class="form-container">
        <div class="row">
          <h1 class="text-center"> SEO-Analys </h1>
        
          
          <!-- SEO FORM -->           
          <form role="form" class="text-center" onsubmit="return false;" method="POST">
            <div class="form-group">
              <input id="url-input" type="text" value="http://" name="url" class="form-control" placeholder="Domän" required>
              <input id="keyword-input" type="text" name="keywords" class="form-control" placeholder="Sökord" required>
              <input id="email-input" type="email" name="email" class="form-control" placeholder="Email" required>
              <button class="btn" onclick="analyze()">Analysera</button>
              <p class="error-text"></p>
            </div>
          </form>
          <!-- SEO FORM  -->
          
          
          
          
        </div>
        <div class="row result_row">
          <div class="loader-placeholder">
          <img src="img/svg-loaders/puff.svg" id="loader"/>
          <h2 class="text-center loader-text"></h2>
          </div>
        </div>
      </div>
      <div class="result"> </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="main.js"></script>
</html>