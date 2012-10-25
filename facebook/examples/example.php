<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require '../src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '156710537703668',
  'secret' => 'b8b3fbc7674987f1d71733ce25600be7',
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
    $loginUrl = $facebook->getLoginUrl(array(
	'scope' => 'email, user_about_me, user_likes, user_hometown, user_status, user_birthday, user_photos, read_stream, publish_stream, photo_upload, user_online_presence',
	'display' => 'popup',
	'req_perms' => 'read_stream,publish_stream,photo_upload,user_photos,user_photo_video_tags,user_online_presence')
	);
}

// This call will always work since we are fetching public data.
$naitik = $facebook->api('/naitik');

?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <h1>php-sdk</h1>

    <?php if ($user): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>

    <h3>PHP Session</h3>
    <pre><?php print_r($_SESSION['name']); ?></pre>
    <?php if ($user): ?>
<?php
$uid = $user_profile['id'];
echo $accesstoken = $facebook->getAccessToken();
echo '<br>';
$ol = $facebook->api(array
(
    'access_token'  => $accesstoken,
    'method'        => 'fql.query',
    'query'     => "SELECT name, online_presence FROM user WHERE uid = me()"
));
$fql = "SELECT online_presence FROM user WHERE uid IN ( SELECT uid2 FROM friend WHERE uid1 = '".$uid."')";
$active = $facebook->api(array(
  'method' => 'fql.query',
  'query' => $fql
));
print_r($ol);
echo '<br>';
foreach($ol as $key => $value){
echo $value['online_presence'];
}
echo '<br>';


?>
      <h3>You</h3>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

      <h3>Your User Object (/me)</h3>
      <pre><?php print_r($user_profile); 
	  echo $user_profile['id']['languages'];
	  echo $user_profile['name']['languages'];
	  ?>
	  </pre>
	  
    <?php else: ?>
      <strong><em>

	  </em></strong>
    <?php endif ?>

  </body>
</html>
