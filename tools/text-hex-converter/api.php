<?php
if( !defined('PSZAPP_INIT') ) exit;
header('Content-Type: application/json; charset=utf-8');

$no_api = [
	'status'  => 0,
	'message' => __('This tool currently does not support the GET method'),
];

// not POST
if( !$is_POST )
	die(json_encode($no_api));

$input = $code = '';

// detect inputs
if( isset($_POST['input']) && trim($_POST['input'])!='' )
	$input = trim($_POST['input']);
if( isset($_POST['code']) && trim($_POST['code'])!='' )
	$code = trim($_POST['code']);

if( $input=='' && $code=='' )
{
	$no_api['message'] = __('Missing input');
	die(json_encode($no_api));
}

$return_api = [
	'status'  => 1,
	'message' => '',
];

// load global var
include_once("$PSZ_DIR_TOOL/$slug/settings.php");

/** 
* predefined functions
* */
// $api=true; increase usage count only, do not log content
// function _log_tool($log_type, $user_id = 1, $tool_id, $input_type, $input, $api = false)

if( $input!='' )
{
	// fetch content if URL and paramter content
	// or process as text
	$code = is_url($input) && isset($_POST['content']) && $_POST['content']=='fetch' ? file_get_contents($input) : $input;

	// covert to hex
	$code = bin2hex($input);

	if( isset($_POST['space']) && $_POST['space'] )
	{
		$check_space = true;
		$code = trim(chunk_split($code, 2, ' '));
	}

	if( isset($_POST['prepend']) && $_POST['prepend'] )
	{
		$check_prepend = true;
		if( !$check_space )
			$code = chunk_split($code, 2, ' ');

		$code = explode(' ', $code);
		$code = array_map(function($c){return "0x{$c}";}, $code);
		$code = implode($check_space ? ' ' : '', $code);
		//die($code);
	}

	$return_api['result'] = $code;

	// log counts only, do not log content, do not save defult values
	if( !in_array($input, [__('your plain text you would like to encode'), 'URL', 'https://raw.githubusercontent.com/PREScriptZ/gomymobiBSB/master/README.md']) )
		_log_tool($PSZ_LOG_TEXT_HEX_ENCODE, 0, $tool_id, $input, true);
}
else if( $code!='' ) // decode
{
	//$input = is_url($code) ? file_get_contents($code) : $code;
	$input = hex2bin( str_replace_array([
			'0x' => '',
			' ' => '',
		], $code) );

	$return_api['result'] = $input;

	// log counts only, do not log content, do not save defult values
	if( !in_array($input, [__('your encoded data'), 'URL', 'https://raw.githubusercontent.com/PREScriptZ/gomymobiBSB/master/README.HEX']) )
		_log_tool($PSZ_LOG_TEXT_HEX_DECODE, 0, $tool_id, $code, true);
}

// return result
die(json_encode($return_api));
