<?php
require __DIR__."/../../Tea-Messenger-API/init.php";

if ($_SERVER["REQUEST_METHOD"] === "GET"){
    $code = teaDecrypt($_GET["code"], APP_KEY);
    $pdo = DB::pdo();
    $st = $pdo->prepare("SELECT `id`, `email_id`, `expired_at` FROM `email_verification` WHERE `code` = :code LIMIT 1;");
    $st->execute([":code" => $code]); 
    $row = $st->fetch(PDO::FETCH_ASSOC);
    if(!$row){
        msg("Kode verifikasi tidak ditemukan!");
    }
    
    if($row['expired_at'] > date("Y-m-d H:i:s")){
        $pdo->prepare("UPDATE `emails` SET `verified` = 1 WHERE id = :email_id")->execute(["email_id" =>$row['email_id']]);
        $pdo->prepare("DELETE FROM `email_verification` WHERE `code` = :code ")->execute(["code" => $code]);
        msg("Email telah diverifikasi!");
    } else {
        $pdo->prepare("DELETE FROM `email_verification` WHERE `code` = :code ")->execute(["code" => $code]);
        msg("Kode verifikasi telah expired, silahkan meminta kode verifikasi yang baru melalui pengaturan akun Tea Messenge");
    }
}

function msg($msg){
    http_response_code(200);
    die(json_encode(["message" => $msg]));
}

