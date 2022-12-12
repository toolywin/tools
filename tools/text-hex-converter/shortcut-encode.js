javascript:
	// detect if user select a text
	var text = '' + 
	(window.getSelection ? window.getSelection() : 
		(document.getSelection ? document.getSelection() : document.selection.createRange().text));

	// if no selected text, ask user to enter the text
	var p = !text||text=='' ? prompt('_lang{Please enter the text to encode into hexadecimal string}') : [text];
	window.open('https://[=PSZ_APP_SITE_DOMAIN=]/[=TOOL_SLUG=].html?lang=[=CURRENT_LANGUAGE_CODE=]&input=' + p);

	void(0); // this void prevents direction of current page
