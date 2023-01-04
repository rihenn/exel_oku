<?php
session_start();
require __DIR__.'/baglan.php';
$kullanici = $_SESSION["isim"];
$sql = "SELECT * FROM  giris_cikis";

$order = ['ad_soyad', 'DESC'];


$users = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$response = [];

$response['data']=[];




foreach ($users as $user){
    $response['data'][] = [
        'ad_Soyad'=> $user['ad_soyad'],
        'firma'=> $user['firma'],
        'firma_g_c'=> $user['firma_g_c'],
        'tarih'=> $user['tarih'],
        'saat'=> $user['saat'],
        'giris_cikis'=> $user['giris_cikis'],
    ];
}
echo json_encode($response);
?>
