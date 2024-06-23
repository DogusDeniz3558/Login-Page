
<div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <form id="form">
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" name="email1" id="email1" placeholder="name@example.com" required>
                                            <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i> Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password1" id="password1" placeholder="Password" required>
                                            <label for="password" class="form-label"><i class="fa-solid fa-unlock-keyhole"></i> Şifre</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password2" id="password2" placeholder="Password Tekrar" required>
                                            <label for="password2" class="form-label"><i class="fa-solid fa-unlock-keyhole"></i> Şifre Tekrar</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button class="btn btn-primary btn-lg" id="registerBtn" type="submit"><i class="fa-solid fa-user-plus"></i> Kayıt Ol</button>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                                        <div class="card-body p-3 p-md-4 p-xl-2">
                                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Parola Koşulları</h2>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item" id="sayi">En az 6 karakter uzunluğunda olmalıdır.</li>
                                                <li class="list-group-item" id="buyukKarakter">En az bir büyük harf içermelidir.</li>
                                                <li class="list-group-item" id="kucukKarakter">En az bir küçük harf içermelidir.</li>
                                                <li class="list-group-item" id="rakam">En az bir rakam içermelidir.</li>
                                                <li class="list-group-item" id="ozelKarakter">En az bir özel karakter içermelidir.</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
       
                <script>
                   $(document).ready(function() {
                    $('#email1').on('input', function(){
                        var email = $(this).val();
                        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (emailRegex.test(email)) {
                            $(this).addClass('is-valid');
                            $(this).removeClass('is-invalid');
                        } else {
                            $(this).addClass('is-invalid');
                            $(this).removeClass('is-valid');
                        }
                    });


                    //Password1 ve password2 eşleşme kontrolü
                    $('#password1, #password2').on('input', function() {
                        if ($('#password1').val() !== $('#password2').val()) {
                            $('#password1, #password2').addClass('is-invalid');
                            $('#registerBtn').attr('disabled', true);
                        } else {
                            $('#password1, #password2').removeClass('is-invalid');
                            $('#password1, #password2').addClass('is-valid');
                            $('#registerBtn').attr('disabled', false);
                        }
                    });
                    
                    $('#password1').on('input', function() {
                        var password = $(this).val();
                        if(password.length >= 6){
                            $('#sayi').attr('style', 'color: green; text-decoration: line-through;');
                        }else{
                            $('#sayi').attr('style', 'color: red;');
                        }

                        if(password.match(/[A-Z]/)){
                            $('#buyukKarakter').attr('style', 'color: green; text-decoration: line-through;');
                        }else{
                            $('#buyukKarakter').attr('style', 'color: red;');
                            
                        }

                        if(password.match(/[a-z]/)){
                            $('#kucukKarakter').attr('style', 'color: green; text-decoration: line-through;');
                        }else{
                            $('#kucukKarakter').attr('style', 'color: red;');
                            
                        }

                        if(password.match(/[0-9]/)){
                            $('#rakam').attr('style', 'color: green; text-decoration: line-through;');
                        }else{
                            $('#rakam').attr('style', 'color: red;');
                            
                        }

                        if(password.match(/[^A-Za-z0-9]/)){
                            $('#ozelKarakter').attr('style', 'color: green; text-decoration: line-through;');
                        }else{
                            $('#ozelKarakter').attr('style', 'color: red;');
                            
                        }
                    });


                    $('#registerBtn').on('click', function(e) {
                    e.preventDefault(); // Formun normal gönderimini engelle

                $.ajax({
                    url: "./Settings/api.php",
                    type: "POST",
                    data: {
                        action:"Registry",
                        email: $('#email1').val(),
                        password: $('#password1').val(),
                        password2: $('#password2').val(),
                    },
                    success: function(response) {
                        if(response.status === "emailorpassorpass2empty"){
                            setTimeout(function() {
                            Toastify({
                                text: "Lütfen Tüm Alanları Doldurunuz!",
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
                        }else if(response.status === "UserExist"){
                            setTimeout(function() {
                            Toastify({
                                text: "Bu E-posta Adresi Zaten Kullanılıyor",
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
                        
                        }else if(response.status === "passwordnotmatch"){
                            setTimeout(function() {
                            Toastify({
                                text: "Parolalar Eşleşmiyor!",
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
                        }else if(response.status === "insertSuccess"){
                            $('#exampleModal').modal('hide');
                            setTimeout(function() {
                            Toastify({
                                text: "Kaydınız Başarıyla Gerçekleşti! Lütfen Giriş Yapınız!",
                                gravity: "top", // Toast bildiriminin konumu
                                position: 'center', // Toast bildiriminin yerleşeceği pozisyon
                                duration: 2000, // Toast bildiriminin ekranda kalma süresi (2 saniye)
                                stopOnFocus: true,
                                ariaLive: 'polite',
                                style: {
                                    background: '#00ff00', // Toast arka plan rengi
                                    color: '#fff',
                                    cursor:"default"
                                }
                            }).showToast();
                        }, 500);
                        }else{
                            setTimeout(function() {
                            Toastify({
                                text: "Kayıt İşlemi Sırasında Bir Hata Oluştu!",
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
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX error: ", status, error);
                    }
                });
            });


                   });
                </script>