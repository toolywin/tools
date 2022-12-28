<?php
if( !defined('PSZAPP_INIT') ) exit;

// each log type must be unique number
$PSZ_LOG_TEXT_HEX_ENCODE = 500;
$PSZ_LOG_TEXT_HEX_DECODE = 501;

/********************************
Required Files:
	index.php		: where to process your tool
	settings.php	: global settings of your tool
	logos			: folder to contain various logos of your tool
		16.png			: to display on the browser's title bar
		180.png			: tool logo
	sharing.jpg		: used to sharing on socials

$tool_settings		:	Unchangable variable name
	Version			:	Required
	Name			:	Required
	Description		:	Required
	Keyword			:	optional
	Developer		:	Required
		Name			:	Required
		Contact			:	Required, website or email
		Source			:	optional, links to open source sites
		Donate			:	optional, links to donations
			Paypal			:	link to paypal donation
			BTC				:	link to BTC donation
			Ethereum		:	link to ETH donation
	Date			:	Required, created date; format: Y-MM-d, 2022-11-17

	Changelog		:	optional - used to store changelog
********************************/

$tool_settings = [
	'Version'     => '1.1.0',
	'Name'        => __('Text & HEX Converter'),
	'Description' => __('Simple, free, easy and powerful tool to convert between a string and hexadecimal, may enter a link, video or image to encode/decode; even you may do with the remote URLs or upload your own files, also download as well or share your friends directly with their own languages.'),
	'Keyword'     => __('string to hexadecimal, string to hex, text to hex, text to hex converter, word to hexadecimal converter,word to hex converter, text to hexadecimal generator, text to hex online, plain text to hex converter, translate english to hexadecimal, convert file to hex, convert url to hex, decode video from hex, decode link from hex, hex code from url'),
	'Developer'   => [
		'Name'    	=> 'PreScriptZ.com',
		'Contact' 	=> 'https://www.prescriptz.com/',
		'Source'	=> [
			'GitHub'    => 'http://github.com/PREScriptZ/tooly.win/blob/main/tools/text-hex-converter/',
		],
		'Donate'  	=> [
			'Paypal'   => 'https://www.paypal.me/PREScriptZ',
			'BTC'      => 'https://blockchain.info/address/1FNvqxG5T6P5UFtLvq5hdGir6LnS1zJQ6m',
			'Ethereum' => 'https://etherscan.io/address/0x85469855fd24498418e58ff9ad0298f0c498b4e8',
			'LTC'      => 'https://live.blockcypher.com/ltc/address/LY6ADMcfUejoeExifh2ngMXpHM5z8CXxuq',
		],
	],
	'Date'      => '2022-11-17', // created date
	'Changelog' => [

		'2022-12-27'	=> [
			'v1.1.0',

			[
				__('Added') => [
					__('Link to GitHub'),
				],
				__('Fixed') => [
					__('Layout issue on small screen devices'),
					__('Make text easier to read'),
				]
			]
		],
	],
];