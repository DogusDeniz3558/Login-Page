<?php 
try {
    $baglanti = new PDO("mysql:host=localhost;dbname=kullanici_ornek", "root","");
    // echo "Bağlantı OK";
} catch (PDOException $e) {
    echo $e->getMessage();
}


function Filtrele($data){
     $a = trim($data);
     $b = strip_tags($a);
     $c = htmlspecialchars($b, ENT_QUOTES,'UTF-8');
     return $c;
}

?>