// BugsPatrol Options scripts

jQuery(document).ready(function(){
	"use strict";

	BUGSPATROL_STORAGE['to_media_frame'] = [];
	
	// Init fields and groups
	//----------------------------------------------------------------
	bugspatrol_options_init(jQuery('.bugspatrol_options_body'));

	// Check top section for fixed position
	//----------------------------------------------------------------
	bugspatrol_options_fix_scroll_menu();

	// Override menu
	//----------------------------------------------------------------
	jQuery('.bugspatrol_options').on('click', '.bugspatrol_options_override_title', function (e) {
		jQuery(this).toggleClass('opened').parents('.bugspatrol_options_title').find('.bugspatrol_options_override_menu').slideToggle();
		e.preventDefault();
		return false;
	});

	// Save options
	//----------------------------------------------------------------
	jQuery('.bugspatrol_options').on('click', '.bugspatrol_options_button_save', function (e) {
		"use strict";
		// Save editors content
		if (typeof(tinymce) != 'undefined') {
			var editor = tinymce.activeEditor;
			if ( editor!=null && 'mce_fullscreen' == editor.id )
				tinymce.get('content').setContent(editor.getContent({format : 'raw'}), {format : 'raw'});
			tinymce.triggerSave();
		}
		// Prepare data
		var data = {
			action: 'bugspatrol_options_save',
			nonce: BUGSPATROL_STORAGE['ajax_nonce'],
			data: jQuery(".bugspatrol_options_form").serialize(),
			override: BUGSPATROL_STORAGE['to_override'],
			slug: BUGSPATROL_STORAGE['to_slug'],
			mode: "save"
		};
		setTimeout(function(){
			bugspatrol_message_info(BUGSPATROL_STORAGE['to_override']=='customizer' ? BUGSPATROL_STORAGE['to_strings']['recompile_styles'] : '', BUGSPATROL_STORAGE['to_strings']['wait'], 'spin3 animate-spin', 60000);
		}, 600);
		jQuery.post(BUGSPATROL_STORAGE['ajax_url'], data, function(response) {
			"use strict";
			bugspatrol_message_success(BUGSPATROL_STORAGE['to_override']=='customizer' ? BUGSPATROL_STORAGE['to_strings']['reload_page'] : '', BUGSPATROL_STORAGE['to_strings']['save_options']);
			if (BUGSPATROL_STORAGE['to_override']=='customizer') setTimeout(function() { location.reload(); }, 3000);
		});
		e.preventDefault();
		return false;
	});

	
	// Reset options
	//----------------------------------------------------------------
	jQuery('.bugspatrol_options').on('click', '.bugspatrol_options_button_reset', function (e) {
		"use strict";
		bugspatrol_message_confirm(BUGSPATROL_STORAGE['to_strings']['reset_options_confirm'], BUGSPATROL_STORAGE['to_strings']['reset_options'], function(btn) {
			"use strict";
			if (btn != 1) return;
			var data = {
				action: 'bugspatrol_options_save',
				nonce: BUGSPATROL_STORAGE['ajax_nonce'],
				override: BUGSPATROL_STORAGE['to_override'],
				slug: BUGSPATROL_STORAGE['to_slug'],
				mode: "reset"
			};
			setTimeout(function(){
				bugspatrol_message_info(BUGSPATROL_STORAGE['to_override']=='customizer' ? BUGSPATROL_STORAGE['to_strings']['recompile_styles'] : '', BUGSPATROL_STORAGE['to_strings']['wait'], 'spin3 animate-spin', 60000);
			}, 600);
			jQuery.post(BUGSPATROL_STORAGE['ajax_url'], data, function(response) {
				"use strict";
				bugspatrol_message_success(BUGSPATROL_STORAGE['to_strings']['reset_options_complete']+'<br>'+BUGSPATROL_STORAGE['to_strings']['reload_page'], BUGSPATROL_STORAGE['to_strings']['reset_options']);
				setTimeout(function() { location.reload(); }, 3000);
			});
			
		});
		e.preventDefault();
		return false;
	});


	// Export options
	//----------------------------------------------------------------
	jQuery('.bugspatrol_options').on('click', '.bugspatrol_options_button_export,.bugspatrol_options_button_import', function (e) {
		"use strict";
		var action = 'import';
		if (jQuery(this).hasClass('bugspatrol_options_button_export')) {
			action = 'export';
			// Save editors content
			if (typeof(tinymce) != 'undefined') {
				var editor = tinymce.activeEditor;
				if ( editor!=null && 'mce_fullscreen' == editor.id )
					tinymce.get('content').setContent(editor.getContent({format : 'raw'}), {format : 'raw'});
				tinymce.triggerSave();
			}
		}
		// Prepare dialog
		var html = '<div class="bugspatrol_options_export_set_name">'
			+'<form>'
			+(action=='import' 
				? ''
				: '<div class="bugspatrol_options_export_name_area">'
					+'<label for="bugspatrol_options_export_name">'+BUGSPATROL_STORAGE['to_strings']['export_options_label']+'</label>'
					+'<input id="bugspatrol_options_export_name" name="bugspatrol_options_export_name" class="bugspatrol_options_export_name" type="text">'
					+'</div>');
		var export_list = BUGSPATROL_STORAGE['to_export_list'];
		if (export_list.length > 0) { 
			html += '<div class="bugspatrol_options_export_name2_area">'
				+'<label for="bugspatrol_options_export_name2">'+(action=='import' ? BUGSPATROL_STORAGE['to_strings']['export_options_label'] : BUGSPATROL_STORAGE['to_strings']['export_options_label2'])+'</label>'
				+'<select id="bugspatrol_options_export_name2" name="bugspatrol_options_export_name2" class="bugspatrol_options_export_name2">'
				+'<option value="">'+BUGSPATROL_STORAGE['to_strings']['export_options_select']+'</option>';
			for (var i=0; i<export_list.length; i++) {
				html += '<option value="'+export_list[i]+'">'+export_list[i]+'</option>';
			}
			html += '</select>'
				+'</div>';
		} else if (action=='import') {
			html += '<div class="bugspatrol_options_export_empty">'+BUGSPATROL_STORAGE['to_strings']['export_empty']+'</div>';
		}
		if (action=='import') {
			html += '<div class="bugspatrol_options_export_textarea">'
				+'<label for="bugspatrol_options_export_data">'+BUGSPATROL_STORAGE['to_strings']['import_options_label']+'</label>'
				+'<textarea id="bugspatrol_options_export_data" name="bugspatrol_options_export_data" class="bugspatrol_options_export_data"></textarea>'
				+'</div>';
		}
		html += '</form>'
			+'</div>';

		// Show Dialog popup
		var export_popup = bugspatrol_message_dialog(html, action=='import' ? BUGSPATROL_STORAGE['to_strings']['import_options_header'] : BUGSPATROL_STORAGE['to_strings']['export_options_header'],
			function(popup) {
				"use strict";
				// Init code
			},
			function(btn, popup) {
				"use strict";
				if (btn != 1) return;

				var val2 = export_popup.find('#bugspatrol_options_export_name2').val();

				if (action=='import') {			// Import settings
					
					var text = export_popup.find('#bugspatrol_options_export_data').val();

					if (val2=='' && text=='') {
						bugspatrol_message_warning(BUGSPATROL_STORAGE['to_strings']['import_options_error'], BUGSPATROL_STORAGE['to_strings']['import_options_header']);
						return;
					}
					
					var data = {
						action: 'bugspatrol_options_import',
						nonce: BUGSPATROL_STORAGE['ajax_nonce'],
						name2: val2,
						text: text,
						override: BUGSPATROL_STORAGE['to_override'],
						slug: BUGSPATROL_STORAGE['to_slug']
					};
					jQuery.post(BUGSPATROL_STORAGE['ajax_url'], data, function(response) {
						"use strict";
						var rez = {};
						try {
							rez = JSON.parse(response);
						} catch (e) {
							rez = { error: BUGSPATROL_STORAGE['ajax_error'] };
							console.log(response);
						}
						if (rez.error === '') {
							bugspatrol_options_import_values(rez.data);
							bugspatrol_message_success(BUGSPATROL_STORAGE['to_strings']['import_options'], BUGSPATROL_STORAGE['to_strings']['import_options_header']);
						} else {
							bugspatrol_message_warning(BUGSPATROL_STORAGE['to_strings']['import_options_failed'], BUGSPATROL_STORAGE['to_strings']['import_options_header']);
						}
					});
					

				} else {						// Export settings

					var val = export_popup.find('#bugspatrol_options_export_name').val();
					if (val=='' && val2=='') {
						bugspatrol_message_warning(BUGSPATROL_STORAGE['to_strings']['export_options_error'], BUGSPATROL_STORAGE['to_strings']['export_options_header']);
						return;
					}
					// Prepare data
					var form = null;
					if (jQuery("form.bugspatrol_options_form").length === 1) {		// Main theme options
						form = jQuery("form.bugspatrol_options_form");
					} else if (jQuery("form#addtag").length === 1 ) {				// Options for the category (add new)
						form = jQuery("form#addtag");
					} else if (jQuery("form#edittag").length === 1 ) {				// Options for the category (edit)
						form = jQuery("form#edittag");
					} else if (jQuery("form#post").length === 1 ) {					// Options for the post or page
						form = jQuery("form#post");
					}
					var data = {
						action: 'bugspatrol_options_save',
						nonce: BUGSPATROL_STORAGE['ajax_nonce'],
						data: form.serialize(),
						name: val,
						name2: val2,
						mode: 'export',
						override: BUGSPATROL_STORAGE['to_override'],
						slug: BUGSPATROL_STORAGE['to_slug']
					};
					jQuery.post(BUGSPATROL_STORAGE['ajax_url'], data, function(response) {
						"use strict";
						var rez = {};
						try {
							rez = JSON.parse(response);
						} catch (e) {
							rez = { error: BUGSPATROL_STORAGE['ajax_error'] };
							console.log(response);
						}
						bugspatrol_message_success(BUGSPATROL_STORAGE['to_strings']['export_options']+'<br>'+BUGSPATROL_STORAGE['to_strings']['export_link'].replace('%s', '<br><a target="_blank" href="'+rez.link+'">'+BUGSPATROL_STORAGE['to_strings']['export_download']+'</a>'), BUGSPATROL_STORAGE['to_strings']['export_options_header']);
						if (val!='') {
							if (val2!='') {
								for (var i=0; i<BUGSPATROL_STORAGE['to_export_list'].length; i++) {
									if (BUGSPATROL_STORAGE['to_export_list'][i] == val2) {
										BUGSPATROL_STORAGE['to_export_list'][i] = val;
										break;
									}
								}
							} else
								BUGSPATROL_STORAGE['to_export_list'].push(val);
						}
					});
				}
			});
		e.preventDefault();
		return false;
	});

});


// Init all elements
//-----------------------------------------------------------------
function bugspatrol_options_init(to_body) {
	"use strict";
	BUGSPATROL_STORAGE['to_body'] = to_body;

	// Init Dependencies
	//----------------------------------------------------------------
	// Add data-param to all editor areas
	to_body.find('.wp-editor-area').each(function() {
		"use strict";
		jQuery(this).attr('data-param', jQuery(this).attr('id'));
	});

	// Check dependencies
	to_body.on('change', '[data-param]', function() {
		"use strict";
		var cont = jQuery(this).parents('.bugspatrol_options_tab_content');
		if (cont.length==0) cont = jQuery(this).parents('.bugspatrol_options_partition_content');
		bugspatrol_options_check_dependency(cont);
	});
	
	// Popups init
	//----------------------------------------------------------------
	bugspatrol_options_popup_init(to_body);

	// Tabs and partitions init
	//----------------------------------------------------------------
	to_body.find('.bugspatrol_options_tab,.bugspatrol_options_partition').tabs({
		// Init options, which depends from width() or height() only after open it's parent tab or partition
		create: function(e, ui) {
			"use strict";
			if (ui.panel) {
				bugspatrol_options_init_hidden_elements(ui.panel);
				if (window.bugspatrol_init_hidden_elements) bugspatrol_init_hidden_elements(ui.panel);
			}
		},
		activate: function(e, ui) {
			"use strict";
			if (ui.newPanel) {
				bugspatrol_options_init_hidden_elements(ui.newPanel);
				if (window.bugspatrol_init_hidden_elements) bugspatrol_init_hidden_elements(ui.newPanel);
			}
		}
	});


	// Accordion init
	//----------------------------------------------------------------
	to_body.find('.bugspatrol_options_accordion').accordion({
		header: ".bugspatrol_options_accordion_header",
		collapsible: true,
		heightStyle: "content",
		// Init options, which depends from width() or height() only after open it's parent accordion
		create: function (e, ui) {
			if (ui.panel) {
				bugspatrol_options_init_hidden_elements(ui.panel);
				if (window.bugspatrol_init_hidden_elements) bugspatrol_init_hidden_elements(ui.panel);
			}
		},
		activate: function (e, ui) {
			if (ui.newPanel) {
				bugspatrol_options_init_hidden_elements(ui.newPanel);
				if (window.bugspatrol_init_hidden_elements) bugspatrol_init_hidden_elements(ui.newPanel);
			}
		}
	});


	// Toggles
	//----------------------------------------------------------------
	to_body.on('click', '.bugspatrol_options_toggle .bugspatrol_options_toggle_header', function () {
		"use strict";
		if (jQuery(this).hasClass('ui-state-active')) {
			jQuery(this).removeClass('ui-state-active');
			jQuery(this).siblings('div').slideUp();
		} else {
			jQuery(this).addClass('ui-state-active');
			jQuery(this).siblings('div').slideDown();
			bugspatrol_options_init_hidden_elements(jQuery(this));
			if (window.bugspatrol_init_hidden_elements) bugspatrol_init_hidden_elements(jQuery(this));
		}
	});

	// Masked input init
	//----------------------------------------------------------------
	to_body.find('.bugspatrol_options_input_masked').each(function () {
		"use strict";
		if (jQuery.mask) jQuery(this).mask(''+jQuery(this).data('mask'));
	});


	// Datepicker init
	//----------------------------------------------------------------
	to_body.find('.bugspatrol_options_input_date').each(function () {
		"use strict";
		var linked = jQuery(this).data('linked-field');
		var curDate = linked ? jQuery('#'+linked).val() : jQuery(this).val();
		jQuery(this).datepicker({
			dateFormat: jQuery(this).data('format'),
			numberOfMonths: jQuery(this).data('months'),
			gotoCurrent: true,
			changeMonth: true,
			changeYear: true,
			defaultDate: curDate,
			onSelect: function (text, ui) {
				var linked = jQuery(this).data('linked-field');
				if (!bugspatrol_empty(linked)) {
					jQuery('#'+linked).val(text).trigger('change');
				} else {
					ui.input.trigger('change');
				}
			}
		});
	});


	// Spinner arrows click
	//----------------------------------------------------------------
	to_body.on('click', '.bugspatrol_options_field_spinner .bugspatrol_options_arrow_up,.bugspatrol_options_field_spinner .bugspatrol_options_arrow_down', function () {
		"use strict";
		var field = jQuery(this).parent().siblings('input');
		var step = field.data('step') ? String(field.data('step')) : "1";
		var prec = step.indexOf('.')==-1 ? 0 : step.length - step.indexOf('.') - 1;
		step = Math.round((jQuery(this).hasClass('bugspatrol_options_arrow_up') ? 1 : -1) * parseFloat(step) * Math.pow(10, prec) ) / Math.pow(10, prec);
		var minValue = field.data('min');
		var maxValue = field.data('max');
		var newValue = Math.round( (isNaN(field.val()) ? 0 : parseFloat(field.val()) + step) * Math.pow(10, prec) ) / Math.pow(10, prec);
		if (!isNaN(maxValue) && newValue > maxValue) {
			newValue = maxValue;
		}
		if (!isNaN(minValue) && newValue < minValue) {
			newValue = minValue;
		}
		field.val(newValue).trigger('change');
	});

	
	// Tags
	//----------------------------------------------------------------
	to_body.find('.bugspatrol_options_field_tags .bugspatrol_options_field_content').sortable({
		items: "span",
		update: function(event, ui) {
			var tags = '';
			ui.item.parent().find('.bugspatrol_options_tag').each(function() {
				tags += (tags ? BUGSPATROL_STORAGE['to_delimiter'] : '') + jQuery(this).text();
			});
			ui.item.siblings('input[type="hidden"]').eq(0).val(tags).trigger('change');
		}
	}).disableSelection();
	to_body.on('keypress', '.bugspatrol_options_field_tags input[type="text"]', function (e) {
		"use strict";
		if (e.which===44) {
			bugspatrol_options_add_tag_in_list(jQuery(this));
			e.preventDefault();
			return false;
		}
	});
	to_body.on('keydown', '.bugspatrol_options_field_tags input[type="text"]', function (e) {
		"use strict";
		if (e.which===13) {
			bugspatrol_options_add_tag_in_list(jQuery(this));
			e.preventDefault();
			return false;
		}
	});
	function bugspatrol_options_add_tag_in_list(obj) {
		"use strict";
		if (obj.val().trim()!='') {
			var text = obj.val().trim();
			obj.before('<span class="bugspatrol_options_tag iconadmin-cancel">'+text+'</span>');
			var tags = obj.next().val();
			obj.next().val(tags + (tags ? BUGSPATROL_STORAGE['to_delimiter'] : '') + text).trigger('change');
			obj.val('');
		}
	}
	to_body.on('click', '.bugspatrol_options_field_tags .bugspatrol_options_field_content span', function (e) {
		"use strict";
		var text = jQuery(this).text();
		var tags = jQuery(this).siblings('input[type="hidden"]').eq(0).val()+BUGSPATROL_STORAGE['to_delimiter'];
		tags = tags.replace(text+BUGSPATROL_STORAGE['to_delimiter'], '');
		tags = tags.substring(0, tags.length-1);
		jQuery(this).siblings('input[type="hidden"]').eq(0).val(tags).trigger('change');
		jQuery(this).siblings('input[type="text"]').focus();
		jQuery(this).remove();
		e.preventDefault();
		return false;
	});
	to_body.on('click', '.bugspatrol_options_field_tags .bugspatrol_options_field_content', function (e) {
		"use strict";
		jQuery(this).find('input[type="text"]').focus();
		e.preventDefault();
		return false;
	});

	
	// Checkbox
	//----------------------------------------------------------------
	to_body.on('change', '.bugspatrol_options_field_checkbox input', function (e) {
		"use strict";
		jQuery(this).next('label').eq(0).toggleClass('bugspatrol_options_state_checked');
		if (jQuery(this).next('label').eq(0).hasClass('bugspatrol_options_state_checked'))
			jQuery(this).attr('checked', 'checked');
		else
			jQuery(this).removeAttr('checked');
		e.preventDefault();
		return false;
	});


	// Radio button
	//----------------------------------------------------------------
	to_body.on('change', '.bugspatrol_options_field_radio input[type="radio"]', function (e) {
		"use strict";
		jQuery(this).parent().parent().find('label').removeClass('bugspatrol_options_state_checked').find('span').removeClass('iconadmin-dot-circled');
		jQuery(this).parent().parent().find('input:checked').next('label').eq(0).addClass('bugspatrol_options_state_checked').find('span').addClass('iconadmin-dot-circled');
		jQuery(this).parent().parent().find('input[type="hidden"]').val(jQuery(this).parent().parent().find('input:checked').val()).trigger('change');
		e.preventDefault();
		return false;
	});


	// Switch button
	//----------------------------------------------------------------
	to_body.on('click', '.bugspatrol_options_field_switch .bugspatrol_options_switch_inner', function (e) {
		"use strict";
		var val = parseInt(jQuery(this).css('marginLeft'))==0 ? 2 : 1;
		var data = jQuery(this).find('span').eq(val-1).data('value');
		jQuery(this).parent().siblings('input[type="hidden"]').eq(0).val(data).trigger('change');
		jQuery(this).parent().toggleClass('bugspatrol_options_state_off', val==2)
		e.preventDefault();
		return false;
	});


	// Checklist
	//----------------------------------------------------------------
	to_body.on('click', '.bugspatrol_options_field_checklist .bugspatrol_options_listitem', function (e) {
		"use strict";
		var multiple = jQuery(this).parents('.bugspatrol_options_field_checklist').hasClass('bugspatrol_options_multiple');
		if (!multiple) {
			jQuery(this).siblings('.bugspatrol_options_listitem').removeClass('bugspatrol_options_state_checked');
		}
		jQuery(this).toggleClass('bugspatrol_options_state_checked');
		collectCheckedItems(jQuery(this).parent());
		e.preventDefault();
		return false;
	});
	to_body.find('.bugspatrol_options_field_checklist.bugspatrol_options_multiple .bugspatrol_options_field_content').sortable({
		update: function(event, ui) {
			"use strict";
			collectCheckedItems(ui.item.parent());
		}
	}).disableSelection();


	// Select, list, images, icons, fonts
	//----------------------------------------------------------------
	to_body.on('click', '.bugspatrol_options_field_select .bugspatrol_options_input,.bugspatrol_options_field_select .bugspatrol_options_field_after,.bugspatrol_options_field_images .bugspatrol_options_caption_image,.bugspatrol_options_field_icons .bugspatrol_options_caption_icon', function (e) {
		"use strict";
		jQuery(this).siblings('.bugspatrol_options_input_menu').slideToggle();
		e.preventDefault();
		return false;
	});

	to_body.on('click', '.bugspatrol_options_field .bugspatrol_options_menuitem', function (e) {
		"use strict";
		var multiple = jQuery(this).parents('.bugspatrol_options_field').hasClass('bugspatrol_options_multiple');
		if (!multiple) {
			jQuery(this).siblings('.bugspatrol_options_menuitem').removeClass('bugspatrol_options_state_checked');
			jQuery(this).addClass('bugspatrol_options_state_checked');
		} else {
			jQuery(this).toggleClass('bugspatrol_options_state_checked');
		}
		collectCheckedItems(jQuery(this).parent());
		if (!multiple && !jQuery(this).parent().hasClass('bugspatrol_options_input_menu_list'))
			jQuery(this).parent().slideToggle();
		e.preventDefault();
		return false;
	});

	to_body.find('.bugspatrol_options_field.bugspatrol_options_multiple .bugspatrol_options_input_menu').sortable({
		update: function(event, ui) {
			"use strict";
			collectCheckedItems(ui.item.parent());
		}
	}).disableSelection();

	// Collect checked items
	function collectCheckedItems(list) {
		"use strict";
		var val = '', caption = '', image = '', icon = '';
		list.find('.bugspatrol_options_menuitem,.bugspatrol_options_listitem').each(function() {
			"use strict";
			if (jQuery(this).hasClass('bugspatrol_options_state_checked')) {
				val += (val ? BUGSPATROL_STORAGE['to_delimiter'] : '') + jQuery(this).data('value');
				var img = jQuery(this).find('.bugspatrol_options_input_image');
				if (img.length > 0) {
					image = img.eq(0).data('src');
				} else if (jQuery(this).parents('.bugspatrol_options_field_icons').length > 0) {
					icon = jQuery(this).data('value');
				} else {
					caption += (caption ? BUGSPATROL_STORAGE['to_delimiter'] : '') + jQuery(this).html();
				}
			}
		});
		list.parent().find('input[type="hidden"]').eq(0).val(val).trigger('change');
		if (caption != '')
			list.parent().find('input[type="text"]').eq(0).val(caption);
		if (image != '')
			list.parent().find('.bugspatrol_options_caption_image span').eq(0).css('backgroundImage', 'url('+image+')'); //.attr('src', image);
		if (icon != '') {
			var field = list.parent().find('.bugspatrol_options_input_socials');
			if (field.length > 0) {
				var btn = field.next();
				var cls = btn.attr('class');
				cls = (cls.indexOf(' icon') > 0 ? cls.substr(0, cls.indexOf(' icon')) : cls) + ' ' + icon;
				btn.removeClass().addClass(cls).trigger('change');
			} else
				list.parent().find('.bugspatrol_options_caption_icon span').eq(0).removeClass().addClass(icon).trigger('change');
		}
	}



	// Color selector
	//----------------------------------------------------------------
	
	// Standard WP Color Picker
	if (to_body.find('.bugspatrol_options_input_color_wp').length > 0) {
		to_body.find('.bugspatrol_options_input_color_wp').wpColorPicker({
			// you can declare a default color here,
			// or in the data-default-color attribute on the input
			//defaultColor: false,
	
			// a callback to fire whenever the color changes to a valid color
			change: function(e, ui){
				jQuery(e.target).val(ui.color).trigger('change');
			},
	
			// a callback to fire when the input is emptied or an invalid color
			clear: function(e) {
				jQuery(e.target).prev().trigger('change')
			},
	
			// hide the color picker controls on load
			//hide: true,
	
			// show a group of common colors beneath the square
			// or, supply an array of colors to customize further
			//palettes: true
		});
	}
	
	// Tiny Color Picker
	if (to_body.find('.bugspatrol_options_input_color_tiny').length > 0) {
		to_body.find('.bugspatrol_options_input_color_tiny').colorPicker({
			animationSpeed: 0,
			margin: '1px 0 0 0',
			cssAddon: '.cp-color-picker { background-color: #ddd; z-index:1000; }',
			renderCallback: function($elm, toggled) {
				var colors = this.color.colors,
					rgb = colors.RND.rgb,
					clr = colors.alpha == 1 
							? '#'+colors.HEX 
							: 'rgba(' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ', ' + (Math.round(colors.alpha * 100) / 100) + ')';
				$elm.val(clr).data('last-color', clr);
			}
			
		});
	}

	// Internal Theme Color Picker
	if (to_body.find('.bugspatrol_options_input_color + .iColorPicker').length > 0) {
		bugspatrol_color_picker();
		to_body.find('.bugspatrol_options_input_color + .iColorPicker').each(function() {
			jQuery(this).on('click', function (e) {
				"use strict";
				bugspatrol_color_picker_show(null, jQuery(this), function(fld, clr) {
					"use strict";
					fld.css('backgroundColor', clr);
					fld.siblings('input').attr('value', clr).trigger('change');
				});
			});
			var prev_fld = jQuery(this).prev();
			var prev_val = prev_fld.val();
			if (prev_val!='') {
				jQuery(this).css('backgroundColor', prev_val);
			}
			prev_fld.on('change', function() {
				"use strict";
				jQuery(this).next().css('backgroundColor', jQuery(this).val());
			});
		});
	}

	// Clone buttons
	//----------------------------------------------------------------
	to_body.on('click', '.bugspatrol_options_clone_button_add', function (e) {
		"use strict";
		var clone_area = jQuery(this).parents('.bugspatrol_options_cloneable_area').eq(0);
		var clone_item = null;
		var max_num = 0;
		clone_area.find('.bugspatrol_options_cloneable_item').each(function() {
			"use strict";
			var cur_item = jQuery(this);
			if (clone_item == null) 
				clone_item = cur_item;
			var num = Number(cur_item.find('input[name*="_numbers[]"]').eq(0).val());
			if (num > max_num)
				max_num = num;
		});
		var clonedObj = clone_item.clone();
		clonedObj.find('input[type="text"],textarea').val('');
		clonedObj.find('input[name*="_numbers[]"]').val(max_num+1);
		jQuery(this).before(clonedObj);
		e.preventDefault();
		return false;
	});

	to_body.on('click', '.bugspatrol_options_clone_button_del', function (e) {
		"use strict";
		if (jQuery(this).parents('.bugspatrol_options_cloneable_item').parent().find('.bugspatrol_options_cloneable_item').length > 1)
			jQuery(this).parents('.bugspatrol_options_cloneable_item').eq(0).remove();
		else
			bugspatrol_message_warning(BUGSPATROL_STORAGE['to_strings']['del_item_error'], BUGSPATROL_STORAGE['to_strings']['del_item']);
		e.preventDefault();
		return false;
	});



	// Inherit buttons
	//----------------------------------------------------------------
	to_body.on('click', '.bugspatrol_options_button_inherit', function (e) {
		"use strict";
		var inherit = !jQuery(this).hasClass('bugspatrol_options_inherit_off');
		if (inherit) {
			jQuery(this).addClass('bugspatrol_options_inherit_off');
			jQuery(this).parents('.bugspatrol_options_field').find('.bugspatrol_options_content_inherit').fadeOut().find('input').val('');
		} else {
			jQuery(this).removeClass('bugspatrol_options_inherit_off');
			jQuery(this).parents('.bugspatrol_options_field').find('.bugspatrol_options_content_inherit').fadeIn().find('input').val('inherit');
		}
		e.preventDefault();
		return false;
	});
	to_body.on('click', '.bugspatrol_options_content_inherit', function (e) {
		"use strict";
		jQuery(this).parents('.bugspatrol_options_field').find('.bugspatrol_options_button_inherit').addClass('bugspatrol_options_inherit_off');
		jQuery(this).fadeOut().find('input').val('');
		e.preventDefault();
		return false;
	});
}


// Standard actions
//-----------------------------------------------------------------

// Open Wordpress media manager window
function bugspatrol_options_action_media_upload(obj) {
	"use strict";
	var button = jQuery(obj);
	var field  = button.data('linked-field') ? jQuery("#"+button.data('linked-field')).eq(0) : button.siblings('input');
	var fieldId = field.attr('id');
	if ( BUGSPATROL_STORAGE['to_media_frame'][fieldId] ) {
		BUGSPATROL_STORAGE['to_media_frame'][fieldId]['field'] = field;
		BUGSPATROL_STORAGE['to_media_frame'][fieldId]['frame'].open();
		return;
	}
	BUGSPATROL_STORAGE['to_media_frame'][fieldId] = [];
	BUGSPATROL_STORAGE['to_media_frame'][fieldId]['field'] = field;
	BUGSPATROL_STORAGE['to_media_frame'][fieldId]['sizes'] = button.data('sizes');
	BUGSPATROL_STORAGE['to_media_frame'][fieldId]['multi'] = button.data('multiple');
	// Create media selector
	var media_args = {
		// Popup layout (if comment next row - hide filters and image sizes popups)
		frame: 'post',
		// Multiple choise
		multiple: BUGSPATROL_STORAGE['to_media_frame'][fieldId]['multi'] ? 'add' : false,
		// Set the title of the modal.
		title: button.data('caption-choose'),
		// Tell the modal to show only specified type 
		library: {
			type: button.data('type') ? button.data('type') : 'image',
		},
		// Customize the submit button.
		button: {
			// Set the text of the button.
			text: button.data('caption-update'),
			// Tell the button to close the modal
			close: true
		}
	};
	BUGSPATROL_STORAGE['to_media_frame'][fieldId]['frame'] = wp.media(media_args);			// = wp.media.frames.media_frame
	BUGSPATROL_STORAGE['to_media_frame'][fieldId]['frame'].on( 'insert select', function(e) {
		"use strict";
		var attachment = '', attachment_url = '', pos = -1, init = false;
		if (BUGSPATROL_STORAGE['to_media_frame'][fieldId]['multi']) {
			BUGSPATROL_STORAGE['to_media_frame'][fieldId]['frame'].state().get('selection').map( function( att ) {
				"use strict";
				attachment += (attachment ? "\n" : "") + att.toJSON().url;
			});
			var val = BUGSPATROL_STORAGE['to_media_frame'][fieldId]['field'].val();
			attachment_url = val + (val ? "\n" : '') + attachment;
		} else {
			var state = BUGSPATROL_STORAGE['to_media_frame'][fieldId]['frame'].state();
			var type = state.get('type');
			if (type!==undefined) {					// Insert from URL
				var attachment = state.props.toJSON();
			} else {
				var selection = state.get('selection');
				if (selection) {
					var attachment = selection.first().toJSON();
					var sizes_selector = jQuery('.media-modal-content .attachment-display-settings select.size');
					if (BUGSPATROL_STORAGE['to_media_frame'][fieldId]['sizes'] && sizes_selector.length > 0) {
						var size = bugspatrol_get_listbox_selected_value(sizes_selector.get(0));
						if (size != '') attachment_url = attachment.sizes[size].url;
					}
				}
			}
			if (attachment_url=='' && attachment!='' && attachment.url!='') attachment_url = attachment.url;
			if (attachment_url!='') {
				if (!button.data('linked-field')) {
					var output = '';
					if ((pos = attachment_url.lastIndexOf('.'))>=0) {
						var ext = attachment_url.substr(pos+1);
						output = '<a class="bugspatrol_options_image_preview" data-rel="popup" target="_blank" href="' + attachment_url + '">';
						if ('jpg,png,gif'.indexOf(ext)>=0) {
							output += '<img src="'+attachment_url+'" alt="" />';
							init = true;
						} else {
							output += '<span>'+attachment_url.substr(attachment_url.lastIndexOf('/')+1)+'</span>';
						}
						output += '</a>';
					}
					button.siblings('.bugspatrol_options_image_preview').remove();
					if (output != '') {
						button.parent().append(output);
						if (init) bugspatrol_options_popup_init(BUGSPATROL_STORAGE['to_body']);
					}
				}
			} else {
				alert('Undefined selection');
			}
		}
		BUGSPATROL_STORAGE['to_media_frame'][fieldId]['field'].val(attachment_url).trigger('change');
	});
	BUGSPATROL_STORAGE['to_media_frame'][fieldId]['frame'].open();
}

// Clear media field
function bugspatrol_options_action_media_reset(obj) {
	"use strict";
	var button = jQuery(obj);
	var field  = button.data('linked-field') ? jQuery("#"+button.data('linked-field')).eq(0) : button.siblings('input');
	button.siblings('.bugspatrol_options_image_preview').remove();
	field.val('').trigger('change');
}

// Clear color field
function bugspatrol_options_action_color_reset(obj) {
	"use strict";
	var button = jQuery(obj);
	var field  = button.data('linked-field') ? jQuery("#"+button.data('linked-field')).eq(0) : button.siblings('input');
	field.val('').css('backgroundColor', '#ffffff').trigger('change');
}

// Select fontello icon
function bugspatrol_options_action_select_icon(obj) {
	"use strict";
	var button = jQuery(obj);
	var field  = button.data('linked-field') ? jQuery("#"+button.data('linked-field')).eq(0) : button.siblings('input[type="hidden"]').eq(0);
	button.siblings('.bugspatrol_options_input_menu').slideToggle();
}

// Select menu (dropdown list)
function bugspatrol_options_action_show_menu(obj) {
}


// Popup init
function bugspatrol_options_popup_init(to_body) {
	"use strict";
	to_body.find("a[data-rel='popup']:not(.inited)").each(function() {
		"use strict";
		if (BUGSPATROL_STORAGE['to_popup']=='pretty') {
			jQuery(this).addClass('inited').prettyPhoto({
				social_tools: '',
				theme: 'facebook',
				deeplinking: false
			});
		} else if (BUGSPATROL_STORAGE['to_popup']=='magnific') {
			jQuery(this).addClass('inited').magnificPopup({
				type: 'image',
				mainClass: 'mfp-img-mobile',
				closeOnContentClick: true,
				closeBtnInside: true,
				fixedContentPos: true,
				midClick: true,
				//removalDelay: 500, 
				preloader: true,
				image: {
					verticalFit: true
				}
			});
		}
	});
}


// Init previously hidden elements
//-----------------------------------------------------------------------------------
function bugspatrol_options_init_hidden_elements(container) {
	"use strict";
	// Fields visibility
	bugspatrol_options_check_dependency(container);
	// Range sliders
	container.find('.bugspatrol_options_field_range').each(function () {
		"use strict";
		var obj = jQuery(this);
		var scale = obj.find('.bugspatrol_options_range_scale');
		//var scaleWidth = obj.width() - parseInt(scale.css('left')) - parseInt(scale.css('right'));
		var scaleWidth = scale.width();
		if (scaleWidth <= 0) return;
		var step = parseFloat(obj.find('.bugspatrol_options_input_range').data('step'));
		var prec = Math.pow(10, step.toString().indexOf('.') < 0 ? 0 : step.toString().length - step.toString().indexOf('.') - 1);
		var field = obj.find('.bugspatrol_options_input_range input[type="hidden"]').eq(0);
		var val = field.val().split(BUGSPATROL_STORAGE['to_delimiter']);
		var rangeMin = parseFloat(obj.find('.bugspatrol_options_range_min').html());
		var rangeMax = parseFloat(obj.find('.bugspatrol_options_range_max').html());
		var scaleStep = scaleWidth / ((rangeMax - rangeMin) / step);
		var i = 0;
		obj.find('.bugspatrol_options_range_slider').each(function () {
			"use strict";
			var fill = val.length==1 || i==1 ? 'width' : 'left';
			jQuery(this).css('left', (val[i]-rangeMin)*scaleStep/step+'px');
			scale.find('span').css(fill, ((val[i]-rangeMin)*scaleStep/step-(i==1 ? (val[0]-rangeMin)*scaleStep/step : 0))+'px');
			i++;
		});
		if (!obj.hasClass('inited')) {
			obj.addClass('inited').find('.bugspatrol_options_range_slider').draggable({
				axis: 'x',
				grid: [scaleStep, scaleStep],
				containment: '.bugspatrol_options_input_range',
				scroll: false,
				drag: function (e, ui) {
					"use strict";
					var field = obj.find('.bugspatrol_options_input_range input[type="hidden"]').eq(0);
					var val = field.val().split(BUGSPATROL_STORAGE['to_delimiter']);
					var slider = ui.helper;
					var idx = slider.index()-1;
					var newVal = Math.min(rangeMax, Math.max(rangeMin, Math.round(ui.position.left / scaleStep * step * prec) / prec + rangeMin));
					if (val.length==2) {
						if (idx==0 && newVal > val[1]) {
							newVal = val[1];
							ui.position.left = (newVal-rangeMin)*scaleStep/step;
						}
						if (idx==1 && newVal < val[0]) {
							newVal = val[0];
							ui.position.left = (newVal-rangeMin)*scaleStep/step;
						}
					}
					if (val[idx] != newVal) {
						slider.find('.bugspatrol_options_range_slider_value').html(newVal);
						val[idx] = newVal;
						field.val(val.join(BUGSPATROL_STORAGE['to_delimiter'])).trigger('change');
						if (val.length==2)
							scale.find('span').css('left', (val[0]-rangeMin)*scaleStep/step+'px');
						scale.find('span').css('width', ((val[val.length==2 ? 1 : 0]-rangeMin)*scaleStep/step-(val.length==2 ? (val[0]-rangeMin)*scaleStep/step : 0))+'px');
					}
				}
			});
		}
	});
}


// Check dependencies
function bugspatrol_options_check_dependency(cont) {
	"use strict";
	if (cont.parents('.bugspatrol_shortcodes_body').length==1) {
		if (typeof BUGSPATROL_SHORTCODES_DATA == 'undefined') return;
		var sc_name = BUGSPATROL_STORAGE['shortcodes_current_idx'];
		if (sc_name == '') return;
		var sc = BUGSPATROL_SHORTCODES_DATA[sc_name];
	} else if (cont.parents('.bugspatrol_options_body').length==1) {
		if (typeof BUGSPATROL_OPTIONS_DATA == 'undefined') return;
		var sc = BUGSPATROL_OPTIONS_DATA;
	} else {
		return;
	}
	var popup = cont.parents('.bugspatrol_options_tab');
	if (popup.length==0) popup = cont;
	//var cont = jQuery('.bugspatrol_shortcodes_body');
	cont.find('[data-param]').each(function() {
		"use strict";
		var field = jQuery(this);
		var param = field.data('param');
		var value = field.attr('type') != 'checkbox' || field.get(0).checked ? field.val() : '';
		var depend = false;
		if (typeof sc.params != 'undefined' && typeof sc.params[param] != 'undefined' && typeof sc.params[param].dependency != 'undefined')
			depend = sc.params[param].dependency;
		if (depend === false && typeof sc.children != 'undefined' && typeof sc.children.params != 'undefined' && typeof sc.children.params[param] != 'undefined' && typeof sc.children.params[param].dependency != 'undefined')
			depend = sc.children.params[param].dependency;
		if (depend === false && typeof sc[param] != 'undefined' && typeof sc[param].dependency != 'undefined')
			depend = sc[param].dependency;
		if (depend) {
			var dep_cnt = 0, dep_all = 0;
			var dep_cmp = typeof depend.compare != 'undefined' ? depend.compare.toLowerCase() : 'and';
			var fld=null, val='';
			for (var i in depend) {
				if (i == 'compare') continue;
				dep_all++;
				fld = cont.find('[data-param="'+i+'"]');
				if (fld.length==0) fld = popup.find('[data-param="'+i+'"]');
				if (fld.length > 0) {
					val = fld.attr('type') != 'checkbox' || fld.get(0).checked ? fld.val() : '';
					for (var j in depend[i]) {
						if ( 
							   (depend[i][j]=='not_empty' && val!='') 										// Main field value is not empty - show current field
							|| (depend[i][j]=='is_empty' && val=='')										// Main field value is empty - show current field
							|| (depend[i][j]=='refresh' && bugspatrol_options_refresh_field(field, i, val))	// Main field value changed - refresh current field
							|| (val!='' && val.indexOf(depend[i][j])==0)									// Main field value equal to specified value - show current field
						) {
							dep_cnt++;
							break;
						}
					}
				}
				if (dep_cnt > 0 && dep_cmp == 'or')
					break;
			}
			if ((dep_cnt > 0 && dep_cmp == 'or') || (dep_cnt == dep_all && dep_cmp == 'and')) {
				field.parents('.bugspatrol_options_field').show().removeClass('bugspatrol_options_no_use');
			} else {
				field.parents('.bugspatrol_options_field').hide().addClass('bugspatrol_options_no_use');
			}
		}
	});
}

// Fix header on scroll
jQuery(window).scroll(function () {
	"use strict";
	bugspatrol_options_fix_scroll_menu();
});

// Fix/unfix top panel
function bugspatrol_options_fix_scroll_menu() {
	"use strict";
	var scroll_offset = jQuery(window).scrollTop();
	var adminbar_height = Math.max(0, jQuery('#wpadminbar').height());
	var header = jQuery('.bugspatrol_options_form .bugspatrol_options_header');
	if (header.length > 0) {
		if (header.data('wrap') != 1) {
			header.wrap('<div class="bugspatrol_options_header_wrap" style="height:'+header.height()+'px;"></div>' );
			header.attr('data-wrap', '1');
		}
		var wrap = header.parent();
		var wrap_offset = wrap.offset().top;
		var wrap_h = wrap.height();
		var h = header.height();
		if (scroll_offset + adminbar_height > wrap_offset + wrap_h - 30) {
			jQuery('.bugspatrol_options_header').addClass('bugspatrol_options_header_fixed');
		} else {
			jQuery('.bugspatrol_options_header').removeClass('bugspatrol_options_header_fixed');
		}
	}
}


// Import values
function bugspatrol_options_import_values(data) {
	"use strict";
	var msg = '', res = '';
	for (var opt in data) {
		if ((res = bugspatrol_options_set_value(opt, data[opt])) != '') {
			msg += (msg!='' ? ',<br>' : '') + res;
		}
	}
	if (msg != '') {
		bugspatrol_message_warning(BUGSPATROL_STORAGE['to_strings']['import_options_broken']+'<br>'+msg, BUGSPATROL_STORAGE['to_strings']['import_options_header']);
	}
}

// Set new value for one field
function bugspatrol_options_set_value(opt, val) {
	"use strict";
	var result = '';
	var suffix = (typeof val == 'object' ? '[]' : '');
	var fld = jQuery('[name="'+opt+suffix+'"]');
	if (fld.length == 0) return false;
	var parent = fld.parents('.bugspatrol_options_field');
	var type = bugspatrol_options_get_type(parent);
	var clone_area = fld.parents('.bugspatrol_options_cloneable_area');
	var clone_item = null;
	if (clone_area.length > 0) {
		clone_area.find('.bugspatrol_options_cloneable_item').each(function(idx) {
			if (idx == 0) {
				clone_item = jQuery(this);
				fld.eq(0).val('');
				jQuery(this).find('[name="'+opt+'_numbers[]"]').val(0);
				if (type=='socials') jQuery(this).find('[name="'+opt+'_icon[]"]').val('');
			} else
				jQuery(this).remove();
		});
	}
	if (typeof val != 'object' || typeof val[0] == 'undefined')
		val = [val];
	var cnt = 0;
	for (var i in val) {
		if (BUGSPATROL_STORAGE['to_override']!='general') {
			if (val[i] != 'inherit') {
				parent.find('.bugspatrol_options_button_inherit').addClass('bugspatrol_options_inherit_off');
				parent.find('.bugspatrol_options_content_inherit').fadeOut().find('input').val('');
			} else {
				parent.find('.bugspatrol_options_button_inherit').removeClass('bugspatrol_options_inherit_off');
				parent.find('.bugspatrol_options_content_inherit').fadeIn().find('input').val('inherit');
			}
		}
		if (cnt > 0 && clone_area.length > 0) {
			var clonedObj = clone_item.clone();
			clonedObj.find('input[name*="_numbers[]"]').val(i);
			clone_area.find('.bugspatrol_options_clone_button_add').before(clonedObj);
			fld = jQuery('[name="'+opt+'[]"]');
		}
		if (BUGSPATROL_STORAGE['to_override']=='general' || val[i] != 'inherit') {
			if (type=='text' || type=='textarea' || type=='hidden' || type=='spinner') {
				fld.eq(cnt).val(val[i]).trigger('change');
			} else if (type=='editor') {
				fld.eq(cnt).val(val[i]).trigger('change');
				if (typeof(tinymce) != 'undefined' && typeof(tinymce.editors[opt])!='undefined') {
					tinymce.editors[opt].setContent(val[i]);
				}
			} else if (type=='date') {
				parent.datepicker( "setDate", val[i] );
				fld.eq(cnt).val(val[i]).trigger('change');
			} else if (type=='tags') {
				fld.eq(cnt).val(val[i]).trigger('change');
				fld.eq(cnt).parent().find('.bugspatrol_options_tag').remove();
				fld.eq(cnt).prev().val('');
				var tags = val[i].split(BUGSPATROL_STORAGE['to_delimiter']);
				for (var j=0; j<tags.length; j++)
					fld.eq(cnt).prev().before('<span class="bugspatrol_options_tag iconadmin-cancel">'+tags[j]+'</span>');
			} else if (type=='checkbox') {
				fld.eq(cnt).next('label').eq(0).toggleClass('bugspatrol_options_state_checked', val[i]=='true');
				if (val[i]=='true')
					fld.eq(cnt).attr('checked', 'checked');
				else
					fld.eq(cnt).removeAttr('checked');
			} else if (type=='radio') {
				fld.eq(cnt).removeAttr('checked').parent().parent().find('label').removeClass('bugspatrol_options_state_checked').find('span').removeClass('iconadmin-dot-circled');
				fld.eq(cnt).parent().parent().find('input[value="'+val[i]+'"]').attr('checked', 'checked').next('label').eq(0).addClass('bugspatrol_options_state_checked').find('span').addClass('iconadmin-dot-circled');
				fld.eq(cnt).parent().parent().find('input[type="hidden"]').val(val[i]).trigger('change');
			} else if (type=='switch') {
				fld.eq(cnt).val(val[i]).trigger('change');
				var idx = fld.siblings('.bugspatrol_options_switch').find('[data-value="'+val[i]+'"]').index();
				fld.eq(cnt).siblings('.bugspatrol_options_switch').toggleClass('bugspatrol_options_state_off', idx==1);
			} else if (type=='checklist') {
				fld.eq(cnt).val(val[i]).trigger('change');
				fld.eq(cnt).siblings('.bugspatrol_options_listitem').removeClass('bugspatrol_options_state_checked');
				var items = val[i].split(BUGSPATROL_STORAGE['to_delimiter']);
				for (var j=0; j<items.length; j++)
					fld.eq(cnt).siblings('.bugspatrol_options_listitem[data-value="'+items[j]+'"]').addClass('bugspatrol_options_state_checked');
			} else if (type=='media') {
				fld.eq(cnt).val(val[i]).trigger('change');
				fld.eq(cnt).siblings('.bugspatrol_options_image_preview').remove();
				if (val[i]!='') {
					var file = val[i].split('/').pop();
					if (file!='') {
						var parts = file.split('.');
						var fname = parts[0];
						var ext = parts.length > 1 ? parts[1] : '';
						fld.eq(cnt).after('<a class="bugspatrol_options_image_preview" data-rel="popup" target="_blank" href="'+val[i]+'">'+('jpg,png,gif'.indexOf(ext)>=0 ? '<img src="'+val[i]+'" alt="" />' : '<span>'+fname+'</span>')+'</a>');
					}
				}
			} else if (type=='range') {
				fld.eq(cnt).val(val[i]).trigger('change');
				var scale = parent.find('.bugspatrol_options_range_scale');
				var step = parseInt(parent.find('.bugspatrol_options_input_range').data('step'));
				var rangeMin = parseInt(parent.find('.bugspatrol_options_range_min').html());
				var rangeMax = parseInt(parent.find('.bugspatrol_options_range_max').html());
				var scaleWidth = scale.width();
				var scaleStep = scaleWidth / (rangeMax - rangeMin) * step;
				var items = val[i].split(BUGSPATROL_STORAGE['to_delimiter']);
				for (var j=0; j<items.length; j++) {
					var slider = fld.eq(cnt).siblings('.bugspatrol_options_range_slider').eq(j);
					slider.find('.bugspatrol_options_range_slider_value').html(items[j]);
					var fill = items.length==1 || j==1 ? 'width' : 'left';
					slider.css('left', (items[j]-rangeMin)*scaleStep+'px');
					scale.find('span').css(fill, ((items[j]-rangeMin)*scaleStep-(j==1 ? (items[0]-rangeMin)*scaleStep : 0))+'px');
				}
			} else if (type=='select' || type=='images' || type=='icons') {
				fld.eq(cnt).val(val[i]).trigger('change');
				fld.eq(cnt).siblings('.bugspatrol_options_input_menu').find('.bugspatrol_options_menuitem').removeClass('bugspatrol_options_state_checked');
				var items = val[i].split(BUGSPATROL_STORAGE['to_delimiter']);
				for (var j=0; j<items.length; j++) {
					fld.eq(cnt).siblings('.bugspatrol_options_input_menu').find('.bugspatrol_options_menuitem[data-value="'+items[j]+'"]').addClass('bugspatrol_options_state_checked');
					if (type=='images') {
						var src = fld.eq(cnt).siblings('.bugspatrol_options_input_menu').find('.bugspatrol_options_menuitem[data-value="'+items[j]+'"]').find('span').data('src');
						fld.eq(cnt).siblings('.bugspatrol_options_caption_image').find('span').css('backgroundImage', 'url('+src+')');
					} else if (type=='icons') {
						var cls = fld.eq(cnt).siblings('.bugspatrol_options_caption_icon').find('span').attr('class');
						cls = (cls.indexOf(' icon') > 0 ? cls.substr(0, cls.indexOf(' icon')) : cls) + ' ' + items[i];
						fld.eq(cnt).siblings('.bugspatrol_options_caption_icon').find('span').removeClass().addClass(cls);
					} else {
						var caption = fld.eq(cnt).siblings('.bugspatrol_options_input_menu').find('.bugspatrol_options_menuitem[data-value="'+items[j]+'"]').text();
						fld.eq(cnt).siblings('.bugspatrol_options_input').val(caption);
					}
				}
			} else if (type=='socials') {
				fld.eq(cnt).val(val[i].url).trigger('change');
				fld.eq(cnt).siblings('[name="social_icons_icon[]"]').val(val[i].icon);
				fld.eq(cnt).siblings('.bugspatrol_options_input_menu').find('.bugspatrol_options_menuitem').removeClass('bugspatrol_options_state_checked');
				fld.eq(cnt).siblings('.bugspatrol_options_input_menu').find('.bugspatrol_options_menuitem[data-value="'+val[i].icon+'"]').addClass('bugspatrol_options_state_checked');
				var subtype = parent.hasClass('bugspatrol_options_field_images') ? 'images' : 'icons';
				if (subtype=='images') {
					fld.eq(cnt).siblings('.bugspatrol_options_caption_image').find('span').css('backgroundImage', 'url('+val[i].icon+')');
				} else if (subtype=='icons') {
					var cls = fld.eq(cnt).siblings('.bugspatrol_options_field_after').attr('class');
					cls = (cls.indexOf(' icon') > 0 ? cls.substr(0, cls.indexOf(' icon')) : cls) + ' ' + val[i].icon;
					fld.eq(cnt).siblings('.bugspatrol_options_field_after').removeClass().addClass(cls);
				}
			} else if (type=='color') {
				fld.eq(cnt).val(val[i]).trigger('change');
			} else {
				fld.eq(cnt).val(val[i]).trigger('change');
				if (!result) result = opt+' ('+type+') = '+val[i];
			}
		}
		cnt++;
	}
	return result;
}

// Return type of the field
function bugspatrol_options_get_type(fld) {
	"use strict";
	var classes = fld.attr('class').split(' ');
	var type = 'text';
	for (var i=0; i < classes.length; i++) {
		if (classes[i].indexOf('bugspatrol_options_field_')==0) {
			type = classes[i].split('_').pop();
			break;
		}	
	}
	return type;
}

// Refresh field then main field changed
function bugspatrol_options_refresh_field(fld, main_name, main_val) {
	"use strict";
	if (main_name == 'post_type') {
		if (fld.data(main_name)==undefined)
			fld.data(main_name, main_val);
		else if (fld.data(main_name)!=main_val) {
			var cat_field = fld;
			var cat_list = cat_field.prev().slideToggle();
			var cat_lbl = cat_list.parent().prev();
			cat_lbl.append('<span class="sc_refresh iconadmin-spin3 animate-spin"></span>');
			// Prepare data
			var data = {
				action: 'bugspatrol_admin_change_post_type',
				nonce: BUGSPATROL_STORAGE['ajax_nonce'],
				post_type: main_val
			};
			jQuery.post(BUGSPATROL_STORAGE['ajax_url'], data, function(response) {
				"use strict";
				var rez = {};
				try {
					rez = JSON.parse(response);
				} catch (e) {
					rez = { error: BUGSPATROL_STORAGE['ajax_error'] };
					console.log(response);
				}
				if (rez.error === '') {
					var cat_str = '';
					for (var i in rez.data.ids) {
						cat_str += '<span class="bugspatrol_options_menuitem ui-sortable-handle" data-value="'+rez.data.ids[i]+'">'+rez.data.titles[i]+'</span>';
					}
					cat_field.data(main_name, main_val).val('');
					cat_list.empty().html(cat_str).slideToggle();
					cat_lbl.find('span').remove();
				}
			});
		}
	}
	return true;
}
