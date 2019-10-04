$(function() {
	// Define sidebar height
	$('#sidebar').css({
		height : $(window).height() - $('#top').height() + 60
	});
	
	// Define content layer height
	$('#content').css({
		'min-height' : $(window).height() - $('#top').height() + 40
	});
	
	// Sticky sidebar
	$(window).resize(function() {
		$('#sidebar').css({
			'height' : $(window).height() - $('#top').height() - 2
		});
		$('#content').css({
			'min-height' : $(window).height() - $('#top').height() - 1
		});
		$('#sidebar .menu').css({
			'height' : $('#sidebar').height() - $('#sidebar .profile').height() - 22
		});
	});
	
	// Sticky Navigation toolbar
	$(window).scroll(function() {
		if ($('.pageNavigation').length > 0) {
			if ($(window).scrollTop() >= $('#top').outerHeight() + 12) {
				$('.pageNavigation').css({
					'position' : 'fixed',
					'top' : $('#top').outerHeight(),
					'width' : '100%',
					'right' : $('#sidebar').outerWidth() + 1
				});
				$('.pageNavigation+.wrapper').css({
					'margin-top' : $('.pageNavigation').outerHeight()
				});
			} else {
				$('.pageNavigation').css({
					'position' : 'static'
				});
				$('.pageNavigation+.wrapper').css({
					'margin-top' : 0
				});
			}

		}
	});
	
	// Scroll Sidebar Menu if needed
	$('#sidebar .menu').slimscroll({
		color : '#000',
		size : '5px',
		height : $('#sidebar').height() - $('#sidebar .profile').height() - 22
	});

	// Sidebar Menu and submenu animation
	$('#sidebar .menu ul li').has('ul').find('>a').click(function() {
		$.each($(this).parent().parent().find('li').has('ul'),function (i,d) {
			$(d).find('ul').slideUp('fast');
		});
		
		$(this).parent().find('ul').slideToggle();
		
		$.cookie('openSidebarMenu', $(this).parent().attr('id'));

		return false;
	});

	// $('#sidebar .menu ul li').has('ul').click(function(){
		
	// 	// $.cookie('openSidebarMenu', $(this).attr('id'));
	// 	$(this).parent().find('ul').slideDown();

	// });

	// $.cookie('openSidebarMenu', function(){
	// 	var menu = $.cookie('openSidebarMenu');
	// 	// alert(menu);
	// 	var test = $('#sidebar .menu ul li').find('#'+menu+' ul').slideDown();
	// 	alert(test);

	// });
	
	if ($.cookie('openSidebarMenu')) {

		// var menu = $.cookie('openSidebarMenu');

		// $(this).parent().find('ul').slideDown();
		// $('#'+menu+'ul').slideDown();
		// $('#sidebar_menu_pages ul').slideDown();
		
		
	}



	// Header icon tooltip
	$('#top ul li a').tipsy({
		gravity : 'w',
		title : function() {
			return $(this).text();
		},
		fade : true
	});

	// Message layer hider
	$('.message').click(function() {
		$(this).slideUp(500);
	});

	// Apply style to form fields
	$("select, .check, .check :checkbox, input:radio, input:file").uniform();

	// Confirm delete items
	$('[rel=delete]').click(function() {
		if (window.confirm('گزینه مورد نظر حذف خواهد شد. آیا مطمئن هستید؟')) {
			return true;
		} else {
			return false;
		}
	});

	// Tooltip for pictures in edit mode
	$('.editPic, .tooltip').tipsy({
		fade : true,
		gravity: 's'
	});

	
	// $('.tooltip, .tooltip').tipsy({
	// 	fade : true,
	// 	gravity: 's'
	// });

	// Sort Categories 
	$('.categorySort').change(function(){
		$('.loading').fadeIn();
		$('.sort').hide();
		var catSort = $(this).val();
		var catId	= $(this).parent().find('.categoryId').val();
		$.ajax({
			type: 'GET',
			url: 'categories', 
			data: 'catSort='+catSort + '&catId='+catId,
			success: function(){
				$('.loading').hide();
				$('.sort').show();
			}
		});
	});

	// Sort Menu Items 
	$('.menuSort').change(function(){
		$('.loading').fadeIn();
		$('.sort').hide();
		var menuSort = $(this).val();
		var menuId	= $(this).parent().find('.menuId').val();
		$.ajax({
			type: 'GET',
			url: 'menu', 
			data: 'menuSort='+menuSort + '&menuId='+menuId,
			success: function(){
				$('.loading').hide();
				$('.sort').show();
			}
		});
	});

	// Publish btn 
	$('.publish').click(function(){

		$('.loading').fadeIn();
		$('.sort').hide();

		var status  = $(this).parent().attr('id');
		var placeId	= $(this).attr('id');

		$.ajax({
			type: 'GET',
			url: 'places', 
			data: 'status='+status + '&placeId='+placeId,
			success: function(data){
				$('.loading').hide();
				$('.sort').show();
				window.location.reload();
				// $('.publish_status').load(' .publish_status');
			}
		});

	});

	// Place fields
	// add/remove inputs
	// $(function() {
 //        var wrapper = $('.formWrapper');
 //        var i = $('.formWrapper div').size() + 1;
 //        $('#addField').live('click', function() {
 //            $('<div class="formRow"><div class="grid2"><input type="text" id="fieldsTitle" name="fieldsTitle[]" placeholder="نام فیلد" /></div><div class="grid9"><input type="text" id="fieldsDesc" name="fieldsDesc[]" placeholder="توضیحات" /></div><a id="remField" href="#" class="right buttonLink icon-delete" title="حذف" alt="حذف" style="margin-top:4px;"></a><div class="clear"></div></div>').appendTo(wrapper);
 //            i++;
 //            return false;
 //        });
 //        $('#remField').live('click', function() { 
 //            if( i > 2 ) {
 //                $(this).parents('.formRow').remove();
 //                i--;
 //            }
 //            return false;
 //        });
	// });

	// Place Pictures Tipsy
	$('.tooltip').tipsy({
		gravity : 'e',
		title : function() {
			return $(this).text();
		},
		fade : true
	});

	// UserManager
	$('.role').click(function(){
		var role = $(this).text();
		var uid = $(this).attr('id');
		$.ajax({
			type: 	'GET',
			data: 	'role='+role+'&uid='+uid,
			success: function(data){
				window.location.reload();
			}

		});
	});


});




