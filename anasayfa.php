<?php session_start(); ob_start(); if(!isset($_SESSION['email'])){header("Location: index.php");} ?>
<!doctype html>
<html lang="tr-TR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anasayfa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <!-- Jquery -->
      <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    
  </head>
  <body>
    
  <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">Login Page Example</a>
    <form class="d-flex" role="search">
      <button class="btn btn-outline-success" id="exit" type="submit">Çıkış Yap</button>
    </form>
  </div>
</nav>

<center><h1 class="me-2 mt-5">Hoşgeldin <?php echo $_SESSION['email']; ?></h1></center>


    <script>
        $('#exit').on('click',function(e){
            e.preventDefault();
            $.ajax({
                url: "./Settings/api.php",
                type: "POST",
                data: {
                    action: "Exit"
                },
                success: function(response){
                    if(response.status == "success"){
                        window.location.href = "index.php"
                    }
                } 

            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>