"use strict";

document.addEventListener("DOMContentLoaded", function(e) {
	// show favorite icon if was in list
	// you do not need to run if use same button with class btn_mark_fav with child icon <i> tag
	/*if( localStorage.getItem("tool_fav")!==null && localStorage.getItem("tool_fav")!='' ) {
		var tool_fav = localStorage.getItem("tool_fav").split(',');
		if( $('.btn_mark_fav').length>0 && tool_fav.includes($('.btn_mark_fav').data('tool-id').toString()) ) {
			$('.btn_mark_fav i').attr('class', FA_CLASS + ' fa-heart-circle-minus fa_class_switcher fs-1 text-danger');
			changeTooltip(document.querySelector('.btn_mark_fav'), L_FAV_REMOVE);
		}
		$('#count_fav').text( tool_fav.length-2 );
    }*/

    // invalid hex code
    if( typeof is_INVALID_HEX_CODE !='undefined' && is_INVALID_HEX_CODE )
    {
		Swal.fire({
		    text: L_INVALID_HEX_CODE,
		    icon: "error",
		    buttonsStyling: false,
		    confirmButtonText: L_CLOSE,
		    customClass: {
		        confirmButton: "btn btn-danger"
		    }
		});
    }
    // highlight result
    else
    {
	    var highlight_element = '';
	    if( $('#preview').length>0 )
	    	highlight_element = '#preview';
	    else
	    {
	    	var param = new URLSearchParams(window.location.search);

	    	if( param.has('input') )
	    		highlight_element = '#code';
	    	else if( param.has('code') )
	    		highlight_element = '#input';
	    }
	    if( highlight_element!='' )
	    	$(highlight_element).pulsate({color:'#fff'});
	}

	// dynamically change decoded text
	$('#space, #prepend').on('change', function(e) {
		if( $('#code').val().trim()=='' ) return false;

		var code = $('#code').val().trim().replace(/0x/g, '').replace(/ /g, '').trim(),
			spaced = $('#space').is(':checked'),
			prepended = $('#prepend').is(':checked');

		// add spaces
		code = chunk_split(code, 2, ' ').trim();

		// explode
		code = code.split(' ');

		var d = '';
		if( $(this).attr('id')=='space' )
		{
			if( $(this).is(':checked') )
			{
				if( prepended )
					d += '0x';
				d += code.join(' ' + (prepended ? '0x' : ''));
			}
			else
				d += code.join( prepended ? '0x' : '' );

			// short
			/*if( $(this).is(':checked') )
				$('#code').val( (prepended ? '0x' : '') + code.join( ' ' + (prepended ? '0x' : '') ) );
			else
				$('#code').val( code.join( prepended ? '0x' : '' ) );*/
		}
		else {
			if( $(this).is(':checked') )
			{
				d += '0x';
				d += code.join((spaced ? ' ' : '') + '0x');
			}
			else
				d += code.join( spaced ? ' ' : '' );

			// short
			/*if( $(this).is(':checked') )
				$('#code').val( '0x' + code.join((spaced ? ' ' : '') + '0x') );
			else
				$('#code').val( code.join( spaced ? ' ' : '' ) );*/
		}
		$('#code').val( d.trim() ).trigger('change');
	});

	// apply options for code changed
	$('#code').on('change', function(e) {
		if( $('#code').val().trim()=='' ) return false;

		var d = $('#code').val().trim();

		$('#space').prop('checked', d.indexOf(' ')>1 ? true : false);
		$('#prepend').prop('checked', d.indexOf('0x')>-1 ? true : false);
	});

	// before form submitted
	$(document).on('submit', '#form_tool', function(e) {
		if( $(this).find("[type=submit]:focus" ).attr('id')=='encode' )
			$('#code').val('');
		else
			$('#input').val('');

		if( $('#input').val().trim()=='' && $('#code').val().trim()=='' )
		{
			Swal.fire({
			    text: L_ENTER_INPUT,
			    icon: "error",
			    buttonsStyling: false,
			    confirmButtonText: L_CLOSE,
			    customClass: {
			        confirmButton: "btn btn-danger"
			    }
			});
			return false;
		}

		// if length of inputs too large, change to POST
		if( $('#code').val().length>1950 || $('#input').val().length>1950 )
			$(this).attr('method', 'POST');
	});
});