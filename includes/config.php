<?php
	require 'paypal/autoload.php';

	define('Url_Site', 'http://localhost/CompuCord');

	$apiContext = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential(
			'AcAjn85CB4gYtc_6FEQDMuM92L1n1YSxJlOr5RnG-SCcV1L4SdrqJ3RcLsYKi21sEP-6A8sMxbz4LD99', /* Client ID */
			'EKX6yuYG379unO6DMJtCaNMU9fijCEFBWcN9YuZsz2KdHBsmKE_jtx7IDN6HMGNHGaLuGZEvLwUGgylK'/* Secret */
		)
	)
?>