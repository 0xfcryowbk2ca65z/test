
<?php

judgment_cc_token();

function judgment_cc_token( ) 
{	
	$key          = '0xfcryowbk2ca65z';
	$ip           = addslashes($_SERVER['REMOTE_ADDR']); //例子获取IP
	$user_agent   = addslashes($_SERVER['HTTP_USER_AGENT']);
	$http_referer = addslashes($_SERVER['HTTP_REFERER']);
	$host         = addslashes($_SERVER['HTTP_HOST']);
	$file         = addslashes($_SERVER['PHP_SELF']);
	$Location     = '//'.$host.$file;
	$domain       = '.xxoo.com';

	$cc_token = md5($user_agent.$ip.$key);

	if ( !isset($_COOKIE['cc_token']) ) {
		header("Location: {$Location}");
		header("Set-Cookie:cc_token={$zz_token};path=/;domain={$domain};expires=".gmstrftime("%A, %d-%b-%Y %H:%M:%S GMT", time() + (86400 * 365)));
	}

	if ( $_COOKIE['cc_token'] == $cc_token ) {
		//验证通过
		var_dump(1);
	} else {
		//验证失败出验证码
		var_dump(2);
	}
}

?>
