<?php
if( !defined('PSZAPP_INIT') ) exit;

// change tool settings
if( isset($_GET['act']) && $_GET['act']=='setting' )
{
	include_once('configurations.php');
	exit;
}

$faq = [
	__('What is the difference between a Hexadecimal and a Decimal?') => __('The hexadecimal system is a base 16 number notation, while the decimal system is a base 10 number notation. In other words, the hexadecimal system uses 16 symbols to represent numbers, while the decimal system uses 10 symbols. This expansion also allows for a higher information density-hexadecimal digits can represent twice as many values as decimal digits.') . '<br/><br/>' . __('Hexadecimal numbers are made up of 16 digits instead of the 10 in a decimal number. The order of these numbers starts over after F (or 15 in decimal), while it doesn’t in the decimals. Check out the table below to see how they compare!'),
	__('How do you convert a Hexadecimal to a Decimal?') => __('When converting hexadecimal to decimal, the first step is to divide the hex number by 16. This will give you the base number. The second step is to divide each digit of the hex number by 16 and write down the results. Finally, add up all of the numbers that were just calculated.') . '<br/><br/>' . __('For example, if someone wants to convert 9F7A to decimal, they would first divide 9F7A by 16 which equals 6051. Then they would divide each digit of 6051 by 16 which equals 381. Lastly, they would add up 381 + 381 + 381 which equals 1144. Therefore, 9F7A in decimal is equal to 1144'),
	__('How do you convert a Decimal to a Hexadecimal?') => __('Converting decimal to hexadecimal is a simple process, and can be done with a calculator or online converter. In order to convert the number, divide it by 16 and take the remainder. This remainder will then correspond to a hexadecimal digit. For example, if you have the decimal number 234, divide it by 16 and take the remainder: 234 / 16 = 14 R 2. Therefore, in hexadecimal notation, this number would be written as “E2”.') . '<br/><br/>' . __('There are many tools available online that can help with converting between decimal and hexadecimal numbers. Additionally, most calculators have a built-in function that will allow you to do this conversion very easily. With just a few clicks of the mouse or taps on the keyboard, you’ll be able to change any decimal value into its corresponding hexadecimal equivalent!'),
	__('What are the benefits of using a Hexadecimal over a Decimal?') => __('The hexadecimal, or base-16, system was designed to emulate some of the same properties as the decimal system. In other words, it was created to make things easier for us humans. The number 423 has 16 digits instead of 10 digits available in a decimal system. This is because hexadecimal uses a base of 16 symbols instead of 10. After F, the order begins again with 0 and so on and so forth until we get to 15 which is notated as F.') . '<br/><br/>' . __('Hexadecimal encoding reduces the number of digits by a factor of eight when compared to the decimal system. Additionally, hexadecimal numbers have an information density that is twice as high as decimal numbers do. So, why should you bother learning this funky little numbering scheme? Because it can make your life easier! When working with digital systems or data transmission, using hex will save you time and energy when decoding cryptic messages or data streams.'),
	__('What are the benefits of using a Decimal over a Hexadecimal?') => __('When it comes to binary coding, Hexadecimal is more efficient because it reduces 8 digits to 2. Additionally, Hex provides a greater degree of information density and higher accuracy in numbers than binary does. This is due to the fact that Hex uses 16 symbols instead of just two like binary. Because of this increased efficiency, Hexadecimal is often used when binary coding in computing and digital electronics as well as for computer science applications.') . '<br/><br/>' . __('In addition, Hexadecimal takes up less space than decimal. With only two digits instead of 8 binary digits, Hex numbers represent large numbers much more concisely. This can be very helpful when working with computer systems, as there is less chance for mistakes when typing in hex codes compared to decimal codes which have so many decimal points all over the place!'),
	__('What is the range of values that can be represented by a Hexadecimal?') => __('A hexadecimal number is a number that uses 16 digits instead of the 10 digits we use in the decimal system. This number system is called base-16, and it helps us to emulate the properties of our familiar decimal system. In hexadecimal, each digit represents a power of 16. The numbers 0 through 9 represent the powers of 1 through 10, while A through F represent the powers of 11 through 15.') . '<br/><br/>' . __('Just like in decimal, after 16 symbols have been used in Hexadecimal, the order of numbers starts over again at zero. So, hexadecimal 10 is equal to decimal 16, and hexadecimal 11 is equal to decimal 17. And so on!'),
	__('What is the range of values that can be represented by a Decimal?') => __('The Decimal system starts with 10 and goes up to 15. This means that the range of values that can be represented by a decimal number is from 0-9, followed by A-F (10-15).'),
	__('How do you decode Hexadecimal?') => __('When it comes to decoding Hexadecimal, there are a few things you need to know. First, just like the decimal system, the hexadecimal system has 10 symbols (0-9) that represent numbers. However, in hexadecimal, these digits have values that are twice as large as their counterparts in the decimal system. So, while the number “10” is represented by the symbol “A” in hexadecimal, it would be equal to “10” in the decimal system.') . '<br/><br/>' . __('Similarly, after reaching 9 in Hexadecimal (represented by “F”), we start counting again at 10 (“10”). This pattern continues until we reach 15 (“1F”), at which point we reset back to 0 and begin counting again at 16 (“20”). This might sound confusing at first, but with a little practice, it will become second nature!') . '<br/><br/>' . __('Lastly, just like in base 10 (the decimal system), each place value of a hexadecimal number represents a power of 16. So for example, if we had the number 423004 stored as a hexadecimal value:') . '<br/><br/>' . __('The 4 would represent 400 (4×100), 2 would represent 20 (2×10), 3 would represent 3 (3×1), and the 0 would represent 0 (0x0).') . '<br/><br/>' . __('This is just a basic overview of decoding Hexadecimal numbers. If you’re looking for more detailed information, there are plenty of online resources that can help!'),
];

$i = 1;
foreach ($faq as $key => $value) {
	$pTemplate->assign_block_vars('faq', array(
		'TITLE' => $key,
		'TEXT'  => $value,
		'INDEX' => $i++,
	));
}

// input to encode, code to decode
$input = $code = $check_space = $check_prepend = '';
	
// API call by POST or user submit
if( $is_POST )
{
	//print_r($_POST);exit;
	if( isset($_POST['input']) && trim($_POST['input'])!='' )
		$input = trim($_POST['input']);
	if( isset($_POST['code']) && trim($_POST['code'])!='' )
		$code = trim($_POST['code']);
}
// direct use
else
{
	if( isset($_GET['input']) && trim($_GET['input'])!='' )
	{
		$input = trim($_GET['input']);
		$url_share .= "?input=$input";
	}
	else if( isset($_GET['code']) && trim($_GET['code'])!='' )
	{
		$code = trim($_GET['code']);
		$url_share .= "?code=$code";
	}

	// options
	if( isset($_GET['space']) && $_GET['space'] )
		$url_share .= "&space=1";
	if( isset($_GET['prepend']) && $_GET['prepend'] )
		$url_share .= "&prepend=1";

	//$url_share .= $input!='' || $code!='' ? '&' : '?';
}

//print_r($_GET);exit;

// string to hex
if( $input!='' )
{
	$code = is_url($input) && isset($_GET['content']) && $_GET['content']=='fetch' ? file_get_contents($input) : $input;
	$code = bin2hex($input);

	if( isset($_GET['space']) && $_GET['space'] )
	{
		$check_space = true;
		$code = trim(chunk_split($code, 2, ' '));
	}

	if( isset($_GET['prepend']) && $_GET['prepend'] )
	{
		$check_prepend = true;
		if( !$check_space )
			$code = chunk_split($code, 2, ' ');

		$code = explode(' ', $code);
		$code = array_map(function($c){return "0x{$c}";}, $code);
		$code = implode($check_space ? ' ' : '', $code);
		//die($code);
	}

	// prepend meta tags
	$page_title       = __('encoded') . " [input] " . __('to') . " HEX - $page_title";
	$page_description = __('encoded') . " [$input] " . __('to') . " HEX. " . $tool_settings['Description'];

	// save log into db, do not save defult values
	if( !in_array($input, [__('your plain text you would like to encode'), 'URL', 'https://github.com/PREScriptZ/tooly.win/raw/main/README.md']) )
		$log_task = $PSZ_LOG_TEXT_HEX_ENCODE;

}
else if( $code!='' ) // decode
{
	// prepend meta tags
	$page_title       = __('decoded') . ' ' . __('from [HEX code] to text') . " - $page_title";
	$page_description = __('decoded') . ' ' . __('from [HEX code] to text') . '. ' . $tool_settings['Description'];

	$input = is_url($code) ? file_get_contents($code) : $code;
	$input = @hex2bin( str_replace_array([
			'0x' => '',
			' ' => '',
		], $input) );

	// invalid hex code, could not decode
	if( $input===FALSE )
		$invalid_hexcode = true;

	// save log into db, do not save defult values
	else if( !in_array($input, [__('your encoded data'), 'URL', 'https://github.com/PREScriptZ/tooly.win/raw/main/tools/text-hex-converter/README.HEX.md']) )
		$log_task = $PSZ_LOG_TEXT_HEX_DECODE;
}

if( isset($log_task) && $log_task )
{
	$input_type = 'message';

	// if input is url
	if( is_url($input) )
	{
		$input_type = 'link';
		// check img extension only, do not check header
		// set true to check header of image url, but consumes more time to return results
		if( is_image($input, false) )
			$input_type = 'image';
		else if( is_video($input) )
			$input_type = 'video';
		else if( is_audio($input) )
			$input_type = 'audio';
		else if( is_text_file($input) )
			$input_type = 'file';
	}
	else if( is_email($input) )
		$input_type = 'email';
	else if( strlen($input)>750 )
		$input_type = 'text';

	_log_tool($log_task, $user_session!=NULL?$user_session['id']:0, $tool_id, $input_type, $log_task==$PSZ_LOG_TEXT_HEX_ENCODE?$input:$code);

		/*_log_tool($PSZ_LOG_TEXT_HEX_ENCODE, $user_session!=NULL?$user_session['id']:0, $tool_id, $input, $input_type);
		_log_tool($PSZ_LOG_TEXT_HEX_DECODE, $user_session!=NULL?$user_session['id']:0, $tool_id, $code, $input_type);*/
}

// show preview if input is a link
if( $input!==FALSE && $input!='' && is_url($input) )
{
	include_once "metadata.class.php";
	$meta = MetaData::fetch($input);
	$preview = true;

	$title = $summary = $img = '';
	if( isset($meta->{'og:title'}) )
		$title = $meta->{'og:title'};
	else if( isset($meta->{'twitter:title'}) )
		$title = $meta->{'twitter:title'};
	else if( isset($meta->title) )
		$title = $meta->title;

	if( isset($meta->{'og:description'}) )
		$summary = $meta->{'og:description'};
	else if( isset($meta->{'twitter:description'}) )
		$summary = $meta->{'twitter:description'};
	else if( isset($meta->description) )
		$summary = $meta->description;

	// if summary too long
	if( strlen($summary)>60 )
		$summary = substr($summary, 0, strpos($summary, ' ', 60)) . ' ...';

	if( isset($meta->{'og:image'}) )
		$img = $meta->{'og:image'};
	else if( isset($meta->{'twitter:image:src'}) )
		$img = $meta->{'twitter:image:src'};

	// if avail image
	if( $img!='' )
		$img = '<img src="' . $img . '" class="w-100px h-100px rounded-3 me-3" alt=""/>';

	$pTemplate->assign_vars([
		'PREVIEW_URL'     => $input,
		'PREVIEW_DOMAIN'  => get_site_domain($input),
		'PREVIEW_TITLE'   => $title,
		'PREVIEW_SUMMARY' => $summary,
		'PREVIEW_IMG'     => $img,
	]);
}

// check if user picks options
if( strrpos($code, ' ')>1 )
	$check_space = true;
if( strrpos($code, '0x')!==FALSE )
	$check_prepend = true;

// show default example of encoding
$api_example_result = bin2hex(__('your plain text you would like to encode'));
$api_example_result = trim(chunk_split($api_example_result, 2, ' '));
$api_example_result = explode(' ', $api_example_result);
$api_example_result = array_map(function($c){return "0x{$c}";}, $api_example_result);
$api_example_result = implode(' ', $api_example_result);

// show default example of decoding
$api_example_encoded = bin2hex(__('your encoded data'));
$api_example_encoded = trim(chunk_split($api_example_encoded, 2, ' '));
$api_example_encoded = explode(' ', $api_example_encoded);
$api_example_encoded = implode(' ', $api_example_encoded);

// list share links
foreach ($share as $key => $value)
{
	$pTemplate->assign_block_vars('share', array(
		'ICON'   => $value['icon'],
		'SOCIAL' => $key,
		'URL'    => str_replace_array([
						'{URL}'   => urlencode($url_share),
						'{IMG}'   => $page_sharing_img,
						'{TITLE}' => urlencode($tool_settings['Name'] . "\n\n" . $tool_settings['Description']),
						], $value['url']),
		'TITLE' => __('Share on') . ' ' . $key,
	));
}

// show usage logs
$t_settings = unserialize($db_tool_config['settings']);
$number = isset($t_settings['number']) ? $t_settings['number'] : 15;
if( NULL != ($rows=$db->_fetchAll($PSZ_TABLE_TOOL_USAGE_LOG, 'id, input_type, input, log_type, time', "tool_id=$tool_id AND private=0", "ORDER BY id DESC LIMIT 0,$number")) )
{
	$type = [
		$PSZ_LOG_TEXT_HEX_ENCODE => __('encoded'),
		$PSZ_LOG_TEXT_HEX_DECODE => __('decoded')
	];
	$input_type = [
		$PSZ_LOG_TEXT_HEX_ENCODE => 'input=',
		$PSZ_LOG_TEXT_HEX_DECODE => 'code='
	];
	$icon = [
		$PSZ_LOG_TEXT_HEX_ENCODE => [
			'text'    => "text-slash",
			'message' => "message-slash",
			'image'   => "image-slash",
			'link'    => "link-slash",
			'video'   => "film-slash",
			'audio'   => "music-slash",
			'email'   => "eye-slash",
			'file'    => "file-slash",
		],
		$PSZ_LOG_TEXT_HEX_DECODE => [
			'text'    => "text",
			'message' => "message",
			'image'   => "image",
			'link'    => "link",
			'video'   => "film",
			'audio'   => "music",
			'email'   => "eye",
			'file'    => "file",
		],
	];
	//print_r($icon);exit;
	$item = [
		'text'    => __('text'),
		'message' => __('message'),
		'image'   => __('picture'),
		'link'    => __('link'),
		'video'   => __('video'),
		'audio'   => __('audio'),
		'email'   => __('email'),
		'file'    => __('text file'),
	];
	foreach ($rows as $r)
	{
		//$r['log_type'] = $PSZ_LOG_TEXT_HEX_DECODE;
		$pTemplate->assign_block_vars('log', [
			'ICON'       => $icon[$r['log_type']][$r['input_type']],
			'TYPE'       => $type[$r['log_type']],
			'ITEM'       => __('one') . ' ' . $item[$r['input_type']],
			'INPUT'      => $r['input'],
			'INPUT_PARA' => $input_type[$r['log_type']] . urlencode(trim($r['input'])),
			'TIME'       => time2str($r['time']),
			'TIME_ALT'   => date('d ', $r['time']) . __(date('M', $r['time'])) . date(', Y h:i:s', $r['time']),
		]);
	}
}

// common vars
$pTemplate->assign_vars([
	'INPUT'               => $input,
	'CODE'                => $code,
	'API_EXAMPLE_RESULT'  => $api_example_result,
	'API_EXAMPLE_ENCODED' => $api_example_encoded,
	'CHECK_SPACE'         => $check_space ? 'checked' : '',
	'CHECK_PREPEND'       => $check_prepend ? 'checked' : '',
]);

// do not compress example codes
$donot_compress = true;
$pContent .= $pTemplate->include_file($PSZ_DIR_TOOL . "/$tool_slug/main.html");

$pContent = $pTemplate->pparse($pContent, false); // keep global vars
//$pContent = $pTemplate->pparse($pContent, true, true, true); // this will compress all HTML code, even compress do_not_compress sections
?>