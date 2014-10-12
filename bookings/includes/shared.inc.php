<?php
function bookings_create_api_key($namespace = '') {
	$key = '';
	$uid = uniqid(home_url(), false);
	$data = $namespace;
	$data=serialize($_SERVER);
	$hash = strtoupper(hash('ripemd128', $uid . $key . md5($data)));
	$key = substr($hash,  0,  8) .
            '-' .
	substr($hash,  8,  4) .
            '-' .
	substr($hash, 12,  4) .
            '-' .
	substr($hash, 16,  4) .
            '-' .
	substr($hash, 20, 12);
	return $key;
}

function bookings_create_secret($namespace = '') {
	$secret = '';
	$uid = uniqid(home_url(), false);
	$data = $namespace;
	$data=serialize($_SERVER);
	$secret = hash('crc32', $uid . $secret . md5($data));
	return $secret;
}

function bookings_sanitize($var,$type=null){
	$flags = NULL;
	switch($type)
	{
		case 'url':
			$filter = FILTER_SANITIZE_URL;
			break;
		case 'int':
			$filter = FILTER_SANITIZE_NUMBER_INT;
			break;
		case 'float':
			$filter = FILTER_SANITIZE_NUMBER_FLOAT;
			$flags = FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND;
			break;
		case 'email':
			$var = substr($var, 0, 254);
			$filter = FILTER_SANITIZE_EMAIL;
			break;
		case 'string':
		default:
			$filter = FILTER_SANITIZE_STRING;
			$flags = FILTER_FLAG_NO_ENCODE_QUOTES;
			break;

	}
	$output = filter_var($var, $filter, $flags);
	return($output);
}