<?php

require '../facebook/src/facebook.php';

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
if ($user) {
$gender = $user_profile['gender'];
if($gender = 'male'){$sex = '<img width=10 src=images/male-gender-sign.png />';}
else{$sex = '<img width=10 src=images/female-gender-sign.png />';}
$name = $user_profile['name'];//.''.$sex;
$avatar_url = 'http://graph.facebook.com/'.$user_profile['username'].'/picture';
$profile_url = 'https://www.facebook.com/'.$user_profile['username'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="https://www.facebook.com/2008/fbml xml:lang="en" lang="en">
<head>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>FOS</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />


	<script type="text/javascript">
	function UR_Start() 
	{
		UR_Nu = new Date;
		UR_Indhold = showFilled(UR_Nu.getHours()) + ":" + showFilled(UR_Nu.getMinutes()) + ":" + showFilled(UR_Nu.getSeconds());
		document.getElementById("server_time").innerHTML = UR_Indhold;
		setTimeout("UR_Start()",1000);
	}
	function showFilled(Value) 
	{
		return (Value > 9) ? "" + Value : "0" + Value;
	}
	</script>

</head>
<body onload="UR_Start()">
<div id="wrapper">
	<div id="header">
		<div id="logo">
		</div>
	</div>
	<div id="menu">
		<ul>
			<!--li class="current_page_item"><a href="#"></a></li-->
			
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
						<!--h2 class="title"><a href="#"></a></h2-->
						<p class="meta"><span class="user"><?php if($user){ echo '<img src="'.$avatar_url.'" width="29"/> '; echo $name.' '; echo $sex;}?></span><span class="server_time" id="server_time"></span></p>
						<div style="clear: both;">&nbsp;</div>
						<div id="cboxdiv" style="text-align: center; line-height: 0">
							<div><iframe frameborder="0" width="550" height="500" src="http://www6.cbox.ws/box/?boxid=245772&amp;boxtag=ctrcn9&amp;sec=main" marginheight="2" marginwidth="2" scrolling="auto" allowtransparency="yes" name="cboxmain6-245772" style="border: 0px solid;" id="cboxmain6-245772"></iframe></div>
							<div><iframe frameborder="0" width="550" height="75" src="http://www6.cbox.ws/box/?boxid=245772&amp;boxtag=ctrcn9&amp;sec=form&amp;nme=<?php echo ($name)?>&amp;nmekey=<?php echo md5('celmf76i5jccgmc2'.$name)?>&amp;pic=<?php echo urlencode($avatar_url)?>&amp;lnk=<?php echo urlencode($profile_url)?>&amp;ekey=<?php echo md5("celmf76i5jccgmc2"."\t".$avatar_url."\t".$profile_url)?>" marginheight="2" marginwidth="2" scrolling="no" allowtransparency="yes" name="cboxform6-245772" style="border: 0px solid;border-top:0px" id="cboxform6-245772"></iframe></div>

	
						
						
						</div>
					</div>
					<!--div class="post">
						<h2 class="title"><a href="#">Consecteteur hendrerit </a></h2>
						<p class="meta"><span class="date">June 01, 2010</span><span class="server_time">server_time by <a href="#">Someone</a></span></p>
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
							<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus <a href="#">dapibus semper urna</a>. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem.  Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>
							<p class="links"><a href="#">Read More</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Comments</a></p>
						</div>
					</div-->
					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<div id="sidebar">
					<ul>
						<li>
							<h2>Moderators:</h2>
							<?php echo $moderatorlist;?>
							<div style="clear: both;">&nbsp;</div>
						</li>
						<li>
							<ul>
								<li></li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
</div>
<div id="footer"><p>Copyright&copy; 2012-2013 | All right reserver <a href="">www.sunleoest.com</a></p>
</div>
<!-- end #footer -->
</body>
</html>