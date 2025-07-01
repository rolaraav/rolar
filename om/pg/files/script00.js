$(document).ready(function(){

	var href = window.location.href;
	var hrefIndex = href.indexOf('?');
	if(hrefIndex != -1){
		var hrefEnd = href.slice(hrefIndex+1);
	}

	$('.fone_block a').on('click', function(){
		$('.modal-window').fadeIn(500);
		$('.okno_3').fadeIn(500);
		return false;
	})

	$('.okno_top_off').on('click', function(){
		$('.modal-window').fadeOut(500);
		$(this).parent().parent().fadeOut(500);
		document.location.replace("index.html");
		return false;
	})

	$('.okno3_top_off').on('click', function(){
		$('.modal-window').fadeOut(500);
		$(this).parent().parent().fadeOut(500);
		return false;
	})


// -------- CallBack --------
	$('.o_3_img_img_r').on('click', function(){
		$('.number-form3').attr('value', '');
		return false;
	})


	$('.o_3_butt').on('click', function(){
		var number = $('.number-form3').val();
		if(number.slice(-1) == '_' || number.slice(-1) == '') {
			$('.o_3_inp_block').css('outline', '3px solid #EECCCB');
			$('.number-form3').focus();
		} else {
			$('#callback-form').submit();
		}
		return false;
	})

	if(hrefEnd == 'callback'){
		$('.modal-window').fadeIn(500);
		$('.okno_4').fadeIn(500);
	}

	$('.o_4_but').on('click', function(){
		$('.modal-window').fadeOut(500);
		$(this).parent().parent().fadeOut(500);
		document.location.replace("index.html");
		return false;
	})

	$('.foot_fone a').on('click', function(){
		$('.fone_block a').trigger('click');
		return false;
	})
// -------- END CallBack --------


// -------- Order Share --------

	if(hrefEnd == 'share'){
		$('.modal-window').fadeIn(500);
		$('.okno_6').fadeIn(500);
	}

	$('.z_inp_1_bg .z_inp').on('focus',function(){
		$('.incorrect-icon.share1').css('display', 'none');
		$('.z_inp_1_bg').css('outline', '3px solid #D2E7A6');
	})

	$('.z_inp_1_bg .z_inp').on('blur', function(){
		$('.incorrect-icon.share1').css('display', 'none');
		$('.correct-icon.share1').css('display', 'none');

		$('.z_inp_1_bg').css('outline', '0');
		if($('.z_inp_1_bg .z_inp').val() ==  '') {
//			if($(this).val() == '') $('.z_inp_1_bg').css('outline', '3px solid #EECCCB');
			$('.incorrect-icon.share1').css('display', 'block');
		} else {
			$('.correct-icon.share1').css('display', 'block');
		}
	})

	$('.z_inp_2_bg .z_inp').on('focus',function(){
		$('.incorrect-icon.share2').css('display', 'none');
		$('.z_inp_2_bg').css('outline', '3px solid #D2E7A6');
	})

	$('.z_inp_2_bg .z_inp').on('blur', function(){
		$('.incorrect-icon.share2').css('display', 'none');
		$('.correct-icon.share2').css('display', 'none');

		$('.z_inp_2_bg').css('outline', '0');
		if($('.z_inp_2_bg .z_inp').val() ==  '' || $('.z_inp_2_bg .z_inp').val().slice(-1) == '_') {
//			$('.z_inp_2_bg').css('outline', '3px solid #EECCCB');
			$('.incorrect-icon.share2').css('display', 'block');
		} else {
			$('.correct-icon.share2').css('display', 'block');
		}
	})



	$('.z_inp_3_bg .z_inp').on('focus',function(){
		$('.incorrect-icon.share3').css('display', 'none');
		$('.z_inp_3_bg').css('outline', '3px solid #D2E7A6');
	})

	$('.z_inp_3_bg .z_inp').on('blur', function(){
		$('.incorrect-icon.share3').css('display', 'none');
		$('.correct-icon.share3').css('display', 'none');

		$('.z_inp_3_bg').css('outline', '0');
		if($('.z_inp_3_bg .z_inp').val() ==  '') {
			$('.z_inp_3_bg').css('outline', '3px solid #EECCCB');
			$('.incorrect-icon.share3').css('display', 'block');
		} else {
			$('.correct-icon.share3').css('display', 'block');
		}
	})




	$('.zayvka').on('submit', function(){
		if($('.incorrect-icon.share1').css('display') == 'block' || $('.z_inp_1_bg .z_inp').val() ==  '') {
			$('.z_inp_1_bg .z_inp').focus();
			return false;
		}

		if($('.incorrect-icon.share2').css('display') == 'block' || $('.z_inp_2_bg .z_inp').val() ==  '') {
			$('.z_inp_2_bg .z_inp').focus();
			return false;
		}

		if($('.incorrect-icon.share3').css('display') == 'block' || $('.z_inp_3_bg .z_inp').val() ==  '') {
			$('.z_inp_3_bg .z_inp').focus();
			return false;
		}
	})

// -------- END Order Share --------

// -------- Order --------

	$('.okno5_top_off').on('click', function(){
		$('.modal-window').fadeOut(500);
		$('.okno_5').css('display', 'none');
		return false;
	})


	$('.z_inp_1_bg-order .z_inp-order').on('focus',function(){
		$('.incorrect-icon.order1').css('display', 'none');
		$('.z_inp_1_bg-order').css('outline', '3px solid #D2E7A6');
	})

	$('.z_inp_1_bg-order .z_inp-order').on('blur', function(){
		$('.incorrect-icon.order1').css('display', 'none');
		$('.correct-icon.order1').css('display', 'none');

		$('.z_inp_1_bg-order').css('outline', '0');
		if($('.z_inp_1_bg-order .z_inp-order').val() ==  '') {
			if($(this).val() == '') $('.z_inp_1_bg-order').css('outline', '3px solid #EECCCB');
			$('.incorrect-icon.order1').css('display', 'block');
		} else {
			$('.correct-icon.order1').css('display', 'block');
		}
	})

	$('.z_inp_2_bg-order .z_inp-order').on('focus',function(){
		$('.incorrect-icon.order2').css('display', 'none');
		$('.z_inp_2_bg-order').css('outline', '3px solid #D2E7A6');
	})

	$('.z_inp_2_bg-order .z_inp-order').on('blur', function(){
		$('.incorrect-icon.order2').css('display', 'none');
		$('.correct-icon.order2').css('display', 'none');

		$('.z_inp_2_bg-order').css('outline', '0');
		if($('.z_inp_2_bg-order .z_inp-order').val() ==  '' || $('.z_inp_2_bg-order .z_inp-order').val().slice(-1) == '_') {
			$('.z_inp_2_bg-order').css('outline', '3px solid #EECCCB');
			$('.incorrect-icon.order2').css('display', 'block');
		} else {
			$('.correct-icon.order2').css('display', 'block');
		}
	})


	$('.o_5_inp_block .z_inp-order').on('focus',function(){
		$('.incorrect-icon.order3').css('display', 'none');
		$('.o_5_inp_block').css('outline', '3px solid #D2E7A6');
	})

	$('.o_5_inp_block .z_inp-order').on('blur', function(){
		$('.incorrect-icon.order3').css('display', 'none');
		$('.correct-icon.order3').css('display', 'none');

		$('.o_5_inp_block').css('outline', '0');
		if($('.o_5_inp_block .z_inp-order').val() ==  '' || $('.o_5_inp_block .z_inp-order').val().slice(-1) == '_') {
			$('.o_5_inp_block').css('outline', '3px solid #EECCCB');
			$('.incorrect-icon.order3').css('display', 'block');
		} else {
			$('.correct-icon.order3').css('display', 'block');
		}
	})



	$('.o_5_but').on('click', function(){
		if($('.incorrect-icon.order1').css('display') == 'block' || $('.z_inp_1_bg-order .z_inp-order').val() ==  '') {
			$('.z_inp_1_bg-order .z_inp-order').focus();
			return false;
		}

		if($('.incorrect-icon.order2').css('display') == 'block' || $('.z_inp_2_bg-order .z_inp-order').val() ==  '') {
			$('.z_inp_2_bg-order .z_inp-order').focus();
			return false;
		}

		if($('.incorrect-icon.order3').css('display') == 'block' || $('.o_5_inp_block .z_inp-order').val() ==  '') {
			$('.o_5_inp_block .z_inp-order').focus();
			return false;
		}

		$('#order-form').submit();
		return false;
	})
// -------- END Order --------


// -------- Comment --------


	if(hrefEnd == 'comment'){
		$('.modal-window').fadeIn(500);
		$('.okno_2').fadeIn(500);
	}


	$('.com_link').on('click', function(){
		$('.modal-window').fadeIn(500);
		$('.okno_1').css('display', 'block');
		return false;
	})


	$('.okno1_top_off').on('click', function(){
		$('.modal-window').fadeOut(500);
		$('.okno_1').css('display', 'none');
		return false;
	})

	$('.okno2_top_off').on('click', function(){
		$('.modal-window').fadeOut(500);
		$('.okno_2').css('display', 'none');
		return false;
	})


	$('.o_1_link').on('click', function(){
		$('.okno1_top_off').trigger('click');
		return false;
	})

	$('.o_2_link').on('click', function(){
		$('.okno2_top_off').trigger('click');
		return false;
	})





	$('.comment-name').on('focus',function(){
		$('.incorrect-icon.comment1').css('display', 'none');
		$('.o_inp_block').css('outline', '3px solid #D2E7A6');
	})

	$('.comment-name').on('blur', function(){
		$('.incorrect-icon.comment1').css('display', 'none');
		$('.correct-icon.comment1').css('display', 'none');

		$('.o_inp_block').css('outline', '0');
		if($('.comment-name').val() ==  '') {
			if($(this).val() == '') $('.o_inp_block').css('outline', '3px solid #EECCCB');
			$('.incorrect-icon.comment1').css('display', 'block');
		} else {
			$('.correct-icon.comment1').css('display', 'block');
		}
	})

	$('.comment-text').on('focus',function(){
		if($(this).val() == 'Текст сообщения') $(this).val('');
		$('.incorrect-icon.comment2').css('display', 'none');
		$('.o_ta_block').css('outline', '3px solid #D2E7A6');
	})

	$('.comment-text').on('blur', function(){
		$('.incorrect-icon.comment2').css('display', 'none');
		$('.correct-icon.comment2').css('display', 'none');

		$('.o_ta_block').css('outline', '0');
		if($('.comment-text').val() ==  '' || $('.comment-text').val().slice(-1) == '_') {
			$('.o_ta_block').css('outline', '3px solid #EECCCB');
			$('.incorrect-icon.comment2').css('display', 'block');
		} else {
			$('.correct-icon.comment2').css('display', 'block');
		}
	})

	$('.o_butt').on('click', function(){
		if($('.incorrect-icon.comment1').css('display') == 'block' || $('.comment-name').val() ==  '') {
			$('.comment-name').focus();
			return false;
		}

		if($('.incorrect-icon.comment2').css('display') == 'block' || $('.comment-text').val() ==  '' || $('.comment-text').val() ==  'Текст сообщения') {
			$('.comment-text').focus();
			return false;
		}

		$('#comment-form').submit();
		return false;
	})


	$('.o_2_but').on('click', function(){
		$('.okno2_top_off').trigger('click');
		return false;
	})

// -------- END Comment --------



// -------- LittleCountDown --------

var date = new Date();
var minutes = date.getMinutes() + 10;
date.setMinutes(minutes);

var interval = setInterval(function(){
	var secondsLeft = Math.round((date - new Date())/1000);
	var minutesLeft = Math.floor(secondsLeft/60);
	var secondsInMinute = Math.round(secondsLeft - minutesLeft*60);

	if(secondsLeft <= 0) clearInterval(interval);

	if(secondsInMinute == 60) {
		secondsInMinute == 59;
		minutesLeft--;
	} 

	if(!String(secondsInMinute).charAt(1)) {
		$('.o_6_tim_block').eq(2).html('0');
		$('.o_6_tim_block').eq(3).html(String(secondsInMinute).charAt(0));
	} else {
	$('.o_6_tim_block').eq(1).html(minutesLeft);
	$('.o_6_tim_block').eq(2).html(String(secondsInMinute).charAt(0));
	$('.o_6_tim_block').eq(3).html(String(secondsInMinute).charAt(1));
	}
}, 1000)

// -------- END LittleCountDown --------



// -------- BigCountDown --------

var bigDate = new Date();
var year = bigDate.getFullYear();
var month = bigDate.getMonth();
var bigDate = bigDate.getDate() + 1;
var future = new Date(year, month, bigDate, 0, 0, 0, 0);

var bigInterval = setInterval(function(){
	var secondsLeft = Math.round((future - new Date())/1000);
	var minutesLeft = Math.floor(secondsLeft/60);
	var hoursLeft = Math.floor(minutesLeft/60);

	var secondsInMinute = Math.round(secondsLeft - minutesLeft*60);
	var minutesInHour = Math.round(minutesLeft - hoursLeft*60);

	if(secondsLeft <= 0) clearInterval(bigInterval);

	if(secondsInMinute == 60) {
		secondsInMinute == 59;
		minutesLeft--;
	} 

	if(minutesInHour == 60) {
		minutesInHour == 59;
		hoursLeft--;
	} 

	if(!String(hoursLeft).charAt(1)) {
		hoursLeft = '0' + hoursLeft;
	}

	if(!String(minutesInHour).charAt(1)) {
		minutesInHour = '0' + minutesInHour;
	}

	if(!String(secondsInMinute).charAt(1)) {
		secondsInMinute = '0' + secondsInMinute;
	}

	$('.hours-end').html(hoursLeft);
	$('.minutes-end').html(minutesInHour);
	$('.seconds-end').html(secondsInMinute);

	$('.tim_block').eq(0).html(String(hoursLeft).charAt(0));
	$('.tim_block').eq(1).html(String(hoursLeft).charAt(1));
	$('.tim_block').eq(2).html(String(minutesInHour).charAt(0));
	$('.tim_block').eq(3).html(String(minutesInHour).charAt(1));
	$('.tim_block').eq(4).html(String(secondsInMinute).charAt(0));
	$('.tim_block').eq(5).html(String(secondsInMinute).charAt(1));


}, 1000)
// -------- END BigCountDown --------

// -------- Calendar --------

var months = ['января ', 'февраля ', 'марта ', 'апреля ', 'мая ', 'июня ', 'июля ', 'августа ', 'сентября ', 'октября ', 'ноября ', 'декабря '];

var calendDate = new Date();
calendDate.setDate(calendDate.getDate() + 1);
var calendDay = calendDate.getDate();
var calendMonth = calendDate.getMonth();

var backDate = new Date();
backDate.setDate(calendDate.getDate() - 13);
backDay = backDate.getDate();
backMonth = backDate.getMonth();

$('.old-date').html(backDay);
$('.new-date').html(calendDay);
$('.new-month').html(months[calendMonth]);

if(backMonth != calendMonth) $('.old-month').html(months[backMonth]);

// -------- END Calendar --------


// -------- Carousel --------

	createCarousel({
		btn: $('.com_but'),
		ul: $('.comment_block'),
		speed: 500
	})

	function createCarousel(options){
	var btn = options.btn;
	var ul = options.ul;
	var speed = options.speed;
	var maxKoef = Math.round(heighthUl/heightScroll);
	var currentComm = 0;


	var li = ul.find('li');
	var heightScroll = ul.parent().height();
	var countLi = ul.find('li').length;
	var heighthUl = ul.height();

// Add Handler
	btn.bind('click', scroll);
	
	btn.bind('selectstart dragstart', false);



	function scroll(e) {
		// var margin = parseInt(ul.css('margin-top'));
		// var koef = Math.round(Math.abs(margin/heightScroll));

		// if(koef == maxKoef) {
		// 	koef = 0;
		// }

		currentComm++;
		if(currentComm == countLi-1) currentComm = 0;
		var scrollValue = li.eq(currentComm).position().top;
		var margin = parseInt(ul.css('margin-top'));

		animate({
			delay: 10,
			duration: speed,
			delta: function(progress) {return progress},
			step: function(delta){
				ul.css('margin-top', Math.round(margin-scrollValue*delta) + 'px');
			}
		})
		return false;
	}
	
	function animate(opts){
		btn.unbind('click');
		var date = new Date;
		var time = setInterval(function(){
			var progress = (new Date - date)/opts.duration;
			if(progress > 1) progress = 1;
			opts.step(opts.delta(progress));
			if(progress == 1){
				btn.bind('click', scroll);
				clearInterval(time);
			}
		}, opts.delay || 10);
	}
}

// -------- END Carousel --------


	letJS['data-let-phone'] = function puttForm(event, unchanged) {
		var self = this;
	    if (!this.value) {
	        this.value = event.rule;
	    }

	    $('.o_3_img_img_r').on('click', function(){
	    	self.value = event.rule;
	    	self.focus();
		})

	    if (unchanged) {
	        if (event.type === 'blur') {
	            if (this.value === event.rule) {
	               this.value = '';
	            }
	            return;
	        } else {
	            this.focus();
	        }
	    } else if (event.insertValue) {
	        var parts = event.insertValue.split('');
	        for(var i = 0; i < parts.length; i++) {
	            this.value = this.value.replace(/^([^_]+)_/, '$1' + parts[i]);
	        }
	    } else if (event.cropValue) {
	        this.value = this.value.replace(/(\+7.*)\d([^\d]*)$/, '$1_$2');
	    }
	    var pos = this.value.indexOf('_');
	    event.selection(pos > 0 ? pos : this.value.length);
	    return false;
	};



	$("#selo").click (function (){
		$('.modal-window').fadeIn(500);
		$('.okno_2').css('display', 'block');
		return false;
	});
	
	$("#nclear").click (function (){
		$('input[name=uphone]').val ('');
		$('input[name=uphone]').focus ();
		return false;
	});



})