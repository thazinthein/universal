var wootabs_unsaved_tabs = false,
	wt_textEditor;

window.onbeforeunload = function(e) {

	"use strict";

	if( wootabs_unsaved_tabs ){
		
		return wtAdminJsObj.texts.unsaved_tabs_msg;		
	}
};

(function ( $ ) {

	"use strict";

	$(function () {

		wootabs_saveTabs();

		jQuery('.wootabs-settings-save').on("click", function(){

			jQuery('.wootabs-settings-form').submit();
		});

		wootabs_init_global_tabs();

		
	});

}(jQuery));

function wootabs_getNewTab_html(){

	'use strict';

	var add_TabNum, id, nTab_title, $h, $ret;

	add_TabNum = jQuery('.wt-tab').length + 1;	

	id = 'tarea_' + (Math.random() + '').replace('0.', '');

	if( parseInt( jQuery('#wootabs_are_global').val(), 10 ) ){

		nTab_title = wtAdminJsObj.texts.global_tab_no + add_TabNum;
	}
	else{

		nTab_title = wtAdminJsObj.texts.product_tab_no + add_TabNum;
	}
	
	$h = '<li class="wt-tab">';
	$h += '<h4 class="wt-tabs-title"><i>' + nTab_title + '</i><div class="wootabs-handlediv"><br></div></h4>';
	$h += '<input type="button" class="button remove-tab-button" value="' + wtAdminJsObj.texts.remove + '" />';
	
	if( jQuery('.wootabs-avail-def-lang-html').length ){

		$h += '<select name="global-tab-language-' + add_TabNum + '" id="global-tab-language-' + add_TabNum + '" class="gtabs_lang_selection">';
		$h += jQuery('.wootabs-avail-def-lang-html').html();
		$h += '</select>';
	}

	$h += '<select class="enabled-global-tab green" name="enabled-global-tab_' + add_TabNum + '">\
				<option value="1" selected="selected">' + wtAdminJsObj.texts.enabled + '</option>\
				<option value="0">' + wtAdminJsObj.texts.disabled + '</option>\
			</select>\
			<div class="wt-tab-content">\
			<label for="inpt_' + add_TabNum + '" class="wtab-label">' + wtAdminJsObj.texts.tab_title + '</label>';
	$h += '	<input type="text" name="inpt_' + add_TabNum + '" id="inpt_' + add_TabNum + '" value="' + nTab_title + '" class="wtab-inputt">';
	$h += '<textarea id="' + id + '" name="' + id + '" class="wtab-textarea"></textarea>';
	$h += '</div>\
			</li>';


	
	
	$ret = {
		'html' 	: $h,
		'id'	: id
	};

	return $ret;
}

function wootabs_isChecked(e) {

	'use strict';

	var $r;

    if ( e.attr("checked") !== undefined ) {
        $r = 1;
    }
    else {
        $r = 0;
    }

    return $r;
}

function wootabs_init_global_tabs(){

	'use strict';

	init_sortableTabs();

	wootabs_globalTabs_toggle();

	init_tabsRemoval();

	init_saveTab_action();

	init_tabsAddition();

	wootabs_initGTabs_cats();

	jQuery('#wootabs-use-global-tabs').on("change", function(){
		
		wootabs_globalTabs_toggle();
	});

	jQuery('.wtab-textarea, .wtab-inputt').on("change", function(){
		
		wootabs_unsaved_tabs = true;

		if( jQuery(this).hasClass('wtab-inputt') ){

			jQuery(this).parents('.wt-tab').find('.wt-tabs-title').html( jQuery.trim( jQuery(this).val() ) );
		}

	});

	jQuery('.gtabs-title').live("click", function(){
		
		wootabs_allTabs_toggle( this );
	});

	jQuery('.wt-tab .wootabs-handlediv').live("click", function(){

		wootabs_tabContent_toggle( jQuery(this).parents('.wt-tabs-title') );
	});

	init_enableTab_action();
}

function wootabs_initGTabs_cats(){

	jQuery('.gt_all_cats').each(function(){

		if( jQuery(this).is(":checked") === true ){

			jQuery(this).parents('.gtcs-wrapper').find('.sep-g-wootabs-cats').hide('fast');
		}
	});	

	wootabs_onGTabs_cats_change();
}

function wootabs_onGTabs_cats_change(){

	jQuery('.gt_all_cats').unbind('change').on('change', function(){

		if( jQuery( this ).is(":checked") === true ){

			jQuery(this).parents('.gtcs-wrapper').find('.sep-g-wootabs-cats').slideUp();
		}
		else{

			jQuery(this).parents('.gtcs-wrapper').find('.sep-g-wootabs-cats').slideDown();
		}

	});
}

function init_enableTab_action(){

	'use strict';

	jQuery('.enabled-global-tab').each(function(){
		
		if( parseInt( jQuery(this).val(), 10 ) === 1 ){

			jQuery(this).removeClass("red").addClass("green");
		}
		else{

			jQuery(this).removeClass("green").addClass("red");
		}

	});

	jQuery('.enabled-global-tab').unbind("change").on("change", function(){

		if( parseInt( jQuery(this).val(), 10 ) === 1 ){

			jQuery(this).removeClass("red").addClass("green");
		}
		else{

			jQuery(this).removeClass("green").addClass("red");
		}

		wootabs_unsaved_tabs = true;
	});
}

function wootabs_saveTabs(){

	'use strict';

	var tabsCounter = 0,
		tabsLength = jQuery('.wt-tab').length,
		saveTabs = {},
		empty_array = "no_tabs";

	if( tabsLength ){

		jQuery('.wt-tab').each(function(){

			var this_gtab, thisTitle, thisContent, thisOrder, thisEnabled, tTextareaId, t_cats = [];

			this_gtab = this;

			thisTitle = jQuery.trim( jQuery(this).find('.wtab-inputt').val() );

			tTextareaId = jQuery(this).find('textarea').attr('id');

			if( tinyMCE.get( tTextareaId ) && jQuery( "#wp-" + tTextareaId + "-wrap" ).hasClass('tmce-active') ){
				
				thisContent = jQuery.trim( tinyMCE.get( tTextareaId ).getContent() );
			}
			else{

				thisContent = jQuery( '#' + jQuery(this).find('textarea').attr('id') ).val();
			}

			thisOrder = parseInt( tabsCounter, 10 );
			thisEnabled = parseInt( jQuery(this).find('.enabled-global-tab').val(), 10 );

			jQuery('input[name="' + jQuery(this_gtab).find('.wootabs_products_categories').attr('name') + '"]').each(function(){

				if( jQuery(this).is(":checked") ){

					t_cats.push( jQuery(this).val() );
				}

			});
			
			saveTabs[tabsCounter] = {
				'title' 	: 	thisTitle,
				'content' 	: 	thisContent,
				'order' 	: 	thisOrder,
				'enabled' 	:	thisEnabled, 
				'categories': 	t_cats.join( ',' )
			}

			if( jQuery(this_gtab).find('.gtabs_lang_selection').length ){

				saveTabs[tabsCounter].lang = jQuery(this_gtab).find('.gtabs_lang_selection').val();
			}

			if( tabsCounter + 1 === jQuery('.wt-tab').length ){

				wootabs_f_saveTabs( saveTabs );
			}
			else{

				tabsCounter = tabsCounter + 1;
			}
		});
	}
	else{

		jQuery('.save-tab-button').fadeOut('fast');

		wootabs_f_saveTabs( empty_array );
	}
}

function wootabs_f_saveTabs( saveTabs ){

	'use strict';

	if( jQuery('#wootabs_are_global').length && parseInt( jQuery('#wootabs_are_global').val() ) ){	// Global tabs

		jQuery.ajax({
			type: "post",
			url: wtAdminJsObj.ajax_url,
			data: {
				action: 'wootabs_save_global_tabs',
				d: saveTabs
			},
			success:function(data, textStatus, XMLHttpRequest){

				jQuery('.loading-save-tabs').fadeOut();
				wootabs_unsaved_tabs = false;
			},
			error:function(data, textStatus, XMLHttpRequest){

				jQuery('.loading-save-tabs').fadeOut();
				console.log('error ajax - WooTabs save global tabs');
			}
		});
	}
	else{	// Product tabs

		jQuery.ajax({
			type: "post",
			url: wtAdminJsObj.ajax_url,
			dataType: 'json',
			data: {
				action: 'wootabs_save_product_tabs',
				d: saveTabs,
				id: jQuery('#wootabs_product_id').val()
			},
			success:function(data, textStatus, XMLHttpRequest){

				jQuery('.loading-save-tabs').fadeOut();
				wootabs_unsaved_tabs = false;

				if( parseInt( data.errors ) === 0 ){

					jQuery('#wootabs_product_tab_value').val( jQuery.trim( data.new_value ) );
				}

			},
			error:function(data, textStatus, XMLHttpRequest){

				jQuery('.loading-save-tabs').fadeOut();
				console.log('error ajax - WooTabs save product tabs');
			}
		});
	}
}

function init_saveTab_action(){

	'use strict';

	jQuery(".save-tab-button").unbind('click').on('click', function(){
		
		wootabs_saveTabs();

		jQuery('.loading-save-tabs').fadeIn();
	});
}

function wtabs_remove_temp_editor(){

	'use strict';

	if( jQuery('#wtabs-temp-editor').length ){

		tinymce.remove('#wttemp');
		jQuery('#wttemp').remove();
		
		setTimeout(function(){
			jQuery('#wtabs-temp-editor').remove();	
		},500);

	}
	else{

		wootabs_saveTabs();
	}
}

function init_tabsAddition(){

	'use strict';

	wtabs_remove_temp_editor();

	setTimeout(function(){
	
		wt_textEditor = jQuery('#grab-editor').html();

		jQuery('.add-tab-button').on( "click", function(){

			jQuery('.loading-add-tab').fadeIn();

			var x = wootabs_getNewTab_html();			

			jQuery.ajax({	
				type: "post",
				dataType: "html",
				url: wtAdminJsObj.ajax_url,
				data: {
					action: 'wootabs_get_new_tab_asynch',
					textarea_name: x.id,
					id : x.id,
					content: ""
				},
				success:function(data, textStatus, XMLHttpRequest){

					if( jQuery("#wt-tab-wrapper").append( x.html ) ){

						if( jQuery( '#' + x.id ).replaceWith(data) ){

							tinyMCE.init(tinyMCEPreInit.mceInit[x.id]);

						    tinyMCEPreInit.qtInit[x.id] = JSON.parse( JSON.stringify(tinyMCEPreInit.qtInit[ x.id ] ) );
						    tinyMCEPreInit.qtInit[x.id].id = x.id;
						    
						    setTimeout(function(){
							    new QTags(tinyMCEPreInit.qtInit[ x.id ]);
							    QTags._buttonsInit();
							    switchEditors.go( x.id, 'html' );
							}, 1000);
						}

						wootabs_unsaved_tabs = true;

						wootabs_onGTabs_cats_change();
						init_enableTab_action();
						init_tabsRemoval();
						init_saveTab_action();

						jQuery('.loading-add-tab').fadeOut();
						jQuery('.save-tab-button').fadeIn();
					}						

				},
				error:function(data, textStatus, XMLHttpRequest){

					console.log('error ajax - WooTabs create tab');
					jQuery('.loading-add-tab').fadeOut();
				}
			});

		});

	}, 1000);
}

function init_tabsRemoval(){

	'use strict';

	jQuery('.remove-tab-button').unbind('click').on( "click", function(){

		var r = confirm( wtAdminJsObj.remove_tab_confirm_msg );

		if( r === true ){

			jQuery(this).parents('.wt-tab').slideUp( 'fast', function(){

				jQuery(this).remove();

				wootabs_saveTabs();
			});
		}
	});
}

function init_sortableTabs(){

	'use strict';

	var textareaID;

	jQuery( "#wt-tab-wrapper" ).sortable({
		cursor: "move",
		scroll: false,
		start:function( event, ui ){
			tinymce.remove();
		},
		stop:function( event, ui ){

			jQuery('.wtab-textarea').each(function(){

				textareaID = jQuery(this).attr('id');
				switchEditors.go( textareaID, tinyMCEPreInit.mceInit[textareaID].mode );
			});

			wootabs_unsaved_tabs = true;
		},
		handle: ".wt-tabs-title",
		placeholder: "wootabs-sortable-placeholder",
	    opacity: '0.8'
	});
}

function wootabs_globalTabs_toggle(){

	'use strict';

	if( wootabs_isChecked( jQuery('#wootabs-use-global-tabs') ) ){

		jQuery('.wootabs-asw.gtabs, .wt-gpos').removeClass('hidden');
	}
	else{

		jQuery('.wootabs-asw.gtabs, .wt-gpos').addClass('hidden');
	}
}

function wootabs_allTabs_toggle(e){

	'use strict';

	if( jQuery(e).parents('.handle-tabs').hasClass('open') ){

		jQuery(e).parents('.handle-tabs').removeClass('open');
	}
	else{

		jQuery(e).parents('.handle-tabs').addClass('open');
	}
}

function wootabs_tabContent_toggle(e){
	
	'use strict';

	if( jQuery(e).parents('.wt-tab').hasClass('wt-open') ){

		jQuery(e).parents('.wt-tab').removeClass('wt-open');
	}
	else{

		var tid = jQuery(e).parents('.wt-tab').find('textarea').attr('id');

		jQuery(e).parents('.wt-tab').addClass('wt-open');
		
		if(  tinyMCE.get( tid ) ){

	    	tinyMCE.get( tid ).getBody().focus();
	    }
	    else if( jQuery( '#' + tid ).length ){

	    	jQuery( '#' + tid ).focus();
	    }

	}
}