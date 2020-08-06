<?php
include_once "path.php";
require_once __DIR__ . '/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => $api[facebook_appid], // Replace {app-id} with your app id
  'app_secret' => $api[facebook_appsecret],
  'default_graph_version' => 'v2.6',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl($nfor[http_url]."/facebook_callback.php", $permissions);

$nfor[facebook_login_href] = htmlspecialchars($loginUrl);
?>