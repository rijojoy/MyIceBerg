<?php
ini_set("display_errors","on");
require elgg_get_plugins_path().'create_contact/vendors/facebookauth/src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '194467560664484',
  'secret' => '123ad69116cffe0e0360e3aadad23f7c',
));
// See if there is a user from a cookie
$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
   $user_profile = $facebook->api('/me/friends');
	
	//$user_profile = $facebook->api(array('method' => 'fql.query', 'query' => 'SELECT proxied_email FROM user WHERE uid = me()'));
  } catch (FacebookApiException $e) {
    echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
    $user = null;
  }
}

?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <body>
    <?php if ($user) { ?>
      Your user profile is
      <pre>
        <?php 
		//print htmlspecialchars(print_r($user_profile, true)); 
		foreach ($user_profile['data'] as $contacts)
		{
		   $user_profile = $facebook->api(array('method' => 'fql.query', 'query' => 'SELECT first_name,last_name,proxied_email,contact_email FROM user WHERE uid ='.$contacts['id']));
		   echo '<pre>';
		   print_r($user_profile);
		   
		   /*echo $user_profile['first_name'].' | ';
		   echo $user_profile['last_name'].' | ';
		   echo $user_profile['proxied_email'].'<br>';*/
		} 
		
		
		?>
      </pre>
    <?php } else { ?>
      <fb:login-button></fb:login-button>
    <?php } ?>
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId: '<?php echo $facebook->getAppID() ?>',
          cookie: true,
          xfbml: true,
          oauth: true
        });
        FB.Event.subscribe('auth.login', function(response) {
          window.location.reload();
        });
        FB.Event.subscribe('auth.logout', function(response) {
          window.location.reload();
        });
      };
      (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
  </body>
</html>
