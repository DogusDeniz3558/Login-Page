<?php 
session_start();
ob_start();
header('Content-Type: application/json');
require_once "baglanti.php";
$action = isset($_POST['action']) ? $_POST['action'] : "";

switch ($action) {
    case 'login': // index.php de giriş yapabilmesi için çalışan işlemler
        $email = isset($_POST['email']) ? Filtrele($_POST['email']) : '';
        $password = isset($_POST['password']) ? sha1(md5($_POST['password'])) : '';
       
        if(empty($email) || empty($password)){
            echo json_encode([
                'status' => "error",
                'message' => "Kullanıcı Adı  ve Şifre Boş Olamaz"
            ]);
        exit;
        }

        // Kullanıcıyı veritabanında kontrol et
        $Users = $baglanti->prepare("SELECT * FROM uyeler WHERE Email = ?");
        $Users->execute([$email]);
        $User = $Users->fetch(PDO::FETCH_ASSOC);
        if($User){
           
            $VTEmail = $User['Email'];
            $VTPassword = $User['Password'];

            if($VTEmail != $email || $VTPassword != $password){
                echo json_encode([
                    'status' => "EmailorPassError",
                    'message' => "Mail Adresi ya da Şifre Hatalı!"
                ]);
            }else{
                $_SESSION['email'] = $email;
                echo json_encode([
                    'status' => "success",
                    'message' => "Giriş Başarılı"
                ]);
            }

        }
    

        break;

        case 'Exit': // Anasayfa.php de yer alan Çıkış Yap butonunun işlemleri
            session_unset();
            session_destroy();
            
            echo json_encode([
                'status' => "success",
                'message' => "Çıkış Başarılı"
            ]);
            
            
            break;

            case 'Registry':
                $email = isset($_POST['email']) ? Filtrele($_POST['email']) : '';
                $password = isset($_POST['password']) ? sha1(md5($_POST['password'])) : '';
                $password2 = isset($_POST['password2']) ? sha1(md5($_POST['password2'])) : '';
                

                //Boş Veri Gönderme Engelleme
                if(empty($email) || empty($password) || empty($password2)){
                    echo json_encode([
                        'status' => "emailorpassorpass2empty",
                        'message' => "Kullanıcı Adı  ve Şifre Boş Olamaz"
                    ]);
                exit;
                }
                
                if($password != $password2){
                    echo json_encode([
                        'status' => "passwordnotmatch",
                        'message' => "Şifreler Uyuşmuyor"
                    ]);
                    exit;
                }

                // Kullanıcıyı veritabanında kontrol et
                $UserCheck = $baglanti->prepare("Select * from uyeler where Email = ?");
                $UserCheck->execute([$email]);
                $User = $UserCheck->fetch(PDO::FETCH_ASSOC);
                if($User){
                    echo json_encode([
                        'status' => 'UserExist',
                        'message' => 'Kullanıcı Adı Zaten Var'
                    ]);
                }else{
                   // Kullanıcıyı Veri Tabanına Kayıt Et
                   $UserAdd = $baglanti->prepare("INSERT INTO uyeler (Email, Password) values (?,?)");
                   $UserAdd->execute([$email, $password]);
                   echo json_encode([
                    'status' => 'insertSuccess',
                    'message' => 'Kayıt Başarılı'
                ]);
                
                }
            
                


                break;
    
    default:
    echo json_encode([
        'status' => 'error',
        'message' => 'Geçersiz işlem'
    ]);
    break;
        break;
}


















?>