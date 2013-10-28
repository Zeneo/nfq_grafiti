$(document).ready(function(){
	if($('.login_form .input input').attr('value') != ''){
		$('.login_form .input input').parent().children('label').hide();
	}
	$('.login_form .input input').focusin(function(){
		$(this).parent().children('label').hide();
		$(this).focusout(function(){
			if($(this).attr('value') == ''){
				$(this).parent().children('label').show();
			}
		});
	});
	if($('.login').length > 0){
		$('.login').click(function(){
			if($('.login').hasClass('act')){
				if($('#UserUsername').val() && $('#UserPassword').val()){
					login_submit();
				}else{
					$('.login_form').stop().animate({'marginTop': '0px'}, function(){
						$('.login_light').fadeIn(30).delay(150).fadeOut(100).delay(50).fadeIn(100);
						$('.login_form').animate({'marginTop': '-64px'});
						$('.login').removeClass('act');
					});
				}
			}else{
				$('.login_light').stop().fadeIn(30).delay(50).fadeOut(30).delay(50).fadeIn(30).delay(50).fadeOut(30, function(){
					$('.login').addClass('act');
					$('.login_form').animate({'marginTop': '0px'});
				});				
			}		
		});

	}
	$('a').click(function(event){
		if($(this).attr('href')  == '#' && !$(this).hasClass('login')){
			event.preventDefault();
			$('.lamp_on').fadeOut(50).delay(50).fadeIn(50).delay(100).fadeOut(50).delay(300).fadeIn(50);
			$('.lamp_off').fadeIn(50).delay(50).fadeOut(50).delay(100).fadeIn(50).delay(300).fadeOut(50);
		}
	});
	if($('#add_image').length > 0){
		$('#add_image').click(function(event){
			event.preventDefault();
			$.ajax({
				url: $('#add_image').attr('href'),
				type: 'POST',
				cache: false,
				dataType: 'json',
				success: function(msg){
					var htmlas = msg.html+'';
					htmlas = htmlas.replace('\\', ' ');
					$('body').append(htmlas);
					$('.fog, .close').click(function(event){
						if($(event.target).hasClass('close') || $(event.target).hasClass('fog')){
							$('.fog').remove();
						}
					});
				}
			});
		});
		// $('#GalleryAddImageForm .submit input').live('click',function(event){
			// event.preventDefault();
			// $.ajax({
				// url: $('#UserIndexForm').attr('action'),
				// type: 'POST',
				// cache: false,
				// data: getFormData($('#GalleryAddImageForm')),
				// dataType: 'json',
				// success: function(msg){
					// if(msg.successful){
						// window.location = msg.link;
					// }else{
						// var htmlas = msg.html+'';
						// $('.fog').remove();
						// htmlas = htmlas.replace('\\', ' ');
						// $('body').append(htmlas);
						// $('.fog, .close').click(function(event){
							// if($(event.target).hasClass('close') || $(event.target).hasClass('fog')){
								// $('.fog').remove();
							// }
						// });
					// }
				// }
			// });
		// });
	}
	function login_submit(){
		$.ajax({
			url: $('#UserIndexForm').attr('action'),
			type: 'POST',
			data: getFormData($('#UserIndexForm')),
			dataType: 'json',
			cache: false,
			success: function(msg){
				if(msg.auth == "true"){
					window.location = msg.link;
				}else{
					$('#UserIndexForm').html(msg.html);
					if($('.login_form .input input').attr('value') != ''){
						$('.login_form .input input').parent().children('label').hide();
					}
				}
			}
		});
	}
	function getFormData($form){
		var unindexed_array = $form.serializeArray();
		var indexed_array = {};

		$.map(unindexed_array, function(n, i){
			indexed_array[n['name']] = n['value'];
		});

		return indexed_array;
	}
});
$(window).load(function() {
	$('#slider').bxSlider({
    slideWidth: 320,
	// auto: true,
    minSlides: 2,
    maxSlides: 3,
    slideMargin: 10
  });
});