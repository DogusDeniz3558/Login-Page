<?php 
session_start(); ob_start();
if(isset($_SESSION['email'])){ header("location:anasayfa.php");}?>
<!doctype html>
<html lang="en" class="bg-light">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page - Ajax</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/002f26f40a.js" crossorigin="anonymous"></script>

    <!-- Tostify Stil -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
  <body>
    

    <!-- Login 13 - Bootstrap Brain Component -->
<section class="bg-light py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
        <div class="card border border-light-subtle rounded-3 shadow-sm">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <div class="text-center mb-3">
              <a href="index.php">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTD3NvJ9s-o-b2N6R-Rcn_OGVMSROEisVwLfg&s" alt="BootstrapBrain Logo" width="175" height="140">
              </a>
            </div>
            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Hesabına Giriş Yap</h2>
            <form id="myForm">
              <div class="row gy-2 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                    <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i> Email</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                    <label for="password" class="form-label"><i class="fa-solid fa-unlock-keyhole"></i> Şifre</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-flex gap-2 justify-content-between">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" name="rememberMe" id="rememberMe">
                      <label class="form-check-label text-secondary" id="RememberMe" for="rememberMe">
                        Beni Hatırla
                      </label>
                    </div>
                    <a href="#!" onclick="alert('Burayı Sana Bıraktım!')" class="link-primary text-decoration-none">Parolamı Unuttum?</a>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-grid my-3">
                    <button class="btn btn-primary btn-lg" id="Login" type="submit"><i class="fa-solid fa-right-to-bracket"></i> Giriş Yap</button>
                  </div>
                </div>
                <div class="col-12">
                  <p class="m-0 text-secondary text-center">Bir Hesabın Yok Mu? <a href="#!" class="link-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal">Kayıt Ol</a></p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Kayıt Ol</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- İçerik buraya yüklenecek -->
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
     $(document).ready(function(){
            $('#exampleModal').on('show.bs.modal', function(){
                $('.modal-body').load('kayitol.php');
            });

            $('#RememberMe').on('click', function(){
                alert("Burayı Sana Bıraktım!");
            });


            $('#Login').on('click', function(e){
                e.preventDefault();

                $.ajax({
                    url: './Settings/api.php', // PHP dosyanızın URL'si
                    type: 'POST',
                    data: {
                        action:'login',
                        email: $('#email').val(),
                        password: $('#password').val(),
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.href = "anasayfa.php"//giriş Başarılı olursa direkt yönlendirir.
                        } else if(response.status == "EmailorPassError") {
                            setTimeout(function() {
                            Toastify({
                                text: "Mail Adresi ya da Şifre Hatalı!",
                                gravity: "top", // Toast bildiriminin konumu
                                position: 'center', // Toast bildiriminin yerleşeceği pozisyon
                                duration: 2000, // Toast bildiriminin ekranda kalma süresi (2 saniye)
                                stopOnFocus: true,
                                ariaLive: 'polite',
                                style: {
                                    background: '#6a1a1a', // Toast arka plan rengi
                                    color: '#fff',
                                    cursor:"default"

                                }
                            }).showToast();
                        }, 500);
                        }
                        else{
                            setTimeout(function() {
                            Toastify({
                                text: "Kullanıcı Adı ya da Şifre Boş Olamaz!",
                                gravity: "top", // Toast bildiriminin konumu
                                position: 'center', // Toast bildiriminin yerleşeceği pozisyon
                                duration: 2000, // Toast bildiriminin ekranda kalma süresi (2 saniye)
                                stopOnFocus: true,
                                ariaLive: 'polite',
                                style: {
                                    background: '#FF6A1A', // Toast arka plan rengi
                                    color: '#fff',
                                    cursor:"default"

                                }
                            }).showToast();
                        }, 500);
                        }
                    },
                    error: function() {
                        setTimeout(function() {
                        Toastify({
                        text: "Bir Hata oluştu!",
                        gravity: "top",
                        position: 'center',
                        duration: 2000,
                        style: {
                        background: '#0f3443',
                        color:'#fff',
                        cursor:"default"
                        }
                        }).showToast();
                        }, 1000);
                    }
                });
            });



        });
    </script>

  </body>
</html>
