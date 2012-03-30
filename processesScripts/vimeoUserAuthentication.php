<?php
require_once('../scripts/vimeo.php');
session_start();

//unset($_SESSION['vimeo_state']);
//unset($_SESSION['oauth_request_token']);
//unset($_SESSION['oauth_access_token']);

// Create the object and enable caching
$vimeo = new phpVimeo('9', 'j');
$vimeo->enableCache(phpVimeo::CACHE_FILE, './cache', 300);


// Set up variables
$state = $_SESSION['vimeo_state'];
$request_token = $_SESSION['oauth_request_token'];
$access_token = $_SESSION['oauth_access_token'];

// Coming back
if ($_REQUEST['oauth_token'] != NULL && $_SESSION['vimeo_state'] === 'start') {
    $_SESSION['vimeo_state'] = $state = 'returned';
}

// If we have an access token, set it
if ($_SESSION['oauth_access_token'] != null) {
    $vimeo->setToken($_SESSION['oauth_access_token'], $_SESSION['oauth_access_token_secret']);
}

switch ($_SESSION['vimeo_state']) {
    default:

        // Get a new request token
        $token = $vimeo->getRequestToken();

        // Store it in the session
        $_SESSION['oauth_request_token'] = $token['oauth_token'];
        $_SESSION['oauth_request_token_secret'] = $token['oauth_token_secret'];
        $_SESSION['vimeo_state'] = 'start';

        // Build authorize link
        $authorize_link = $vimeo->getAuthorizeUrl($token['oauth_token'], 'write');
		
		header("Location: ".$authorize_link."");

        break;

    case 'returned':

        // Store it
        if ($_SESSION['oauth_access_token'] === NULL && $_SESSION['oauth_access_token_secret'] === NULL) {
            // Exchange for an access token
            $vimeo->setToken($_SESSION['oauth_request_token'], $_SESSION['oauth_request_token_secret']);
            $token = $vimeo->getAccessToken($_REQUEST['oauth_verifier']);

            // Store
            $_SESSION['oauth_access_token'] = $token['oauth_token'];
            $_SESSION['oauth_access_token_secret'] = $token['oauth_token_secret'];
            $_SESSION['vimeo_state'] = 'done';

            // Set the token
            $vimeo->setToken($_SESSION['oauth_access_token'], $_SESSION['oauth_access_token_secret']);
        }

        // Update database
        require_once('../includes/mysqli_connect.php');
	   
	  	$query="insert into vimeo (token, secret, uid)
	  
	  			 values('" . $_SESSION['oauth_access_token'] . "','" . $_SESSION['oauth_access_token_secret'] . "','".$_SESSION['uid']."')";
	  
	  	$results = mysqli_query($dbc,$query);
		
		$query="UPDATE user SET videoActive='true'
				WHERE uid=".$_SESSION['uid'].";";
		
		$results = mysqli_query($dbc,$query);
	  
		mysqli_close($dbc);
		
		$_SESSION['videoActive']= 'true';
	  
		header("Location: ../index.php");
		
        break;
}


	?>	
		