<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="CRUD MVC">
    <meta name="author" content="">    

    <title>Pessoas</title>
    
    <link href="vendor/components/bootstrap/css/bootstrap.min.css" rel="stylesheet">    
    <link href="vendor/components/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">       
    <link href="assets/theme.css" rel="stylesheet">    
  
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">        
            <a class="navbar-brand" href="./">Tiago TKG</a>            
        </div>
    </nav>

    <div class="container theme-showcase" role="main">       
        <div class="jumbotron">
            <?php 
                if (isset($_GET['controller']) && isset($_GET['action'])) {
                $controller = $_GET['controller'];
                $action     = $_GET['action'];
                } else {
                $controller = 'pessoas';
                $action     = 'index';
                }      
                $run = new App\Routes($controller, $action);
            ?>
        </div>

    </div>   
    
    <script src="vendor/components/jquery/jquery.min.js"></script>    
    <script src="vendor/components/bootstrap/js/bootstrap.min.js"></script>        
    <script src="assets/scripts.js"></script>        
  </body>
</html>
