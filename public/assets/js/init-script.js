

$(function () {
	'use strict';

	$.bootsnav.event();
	$.bootsnav.navbarSticky();
	$.bootsnav.hoverDropdown();
	$.bootsnav.navbarScrollspy();
	
	//main-360
	if($('.main-360')){
	    setInterval(function() {
	        if( $('.banner_list ul li .show').index()<23){
	             $('.banner_list ul li .show').removeClass('show').next().addClass('show')
	        }else{
	            $('.banner_list ul li .show').removeClass('show')
	            $('.banner_list ul li .default').addClass('show')
	        }
        }, 200);
	}
	if($('.list360')){
	    $('.list360 .col-md-3').click(function(){
	        console.log($(this).index())
	        $('#modal360 .modal-body .img').eq($(this).index()).addClass('show').siblings().removeClass('show')
	        $('#modal360').modal({show:true})
	    })
	    setInterval(function() {
	        if( $('#modal360 .modal-body .img .show').index()<23){
	             $('#modal360 .modal-body .img .show').removeClass('show').next().addClass('show')
	        }else{
	            $('#modal360 .modal-body .img .show').removeClass('show')
	            $('#modal360 .modal-body .img .default').addClass('show')
	        }
        }, 200);
	}

	//back to top
	$('.back2top').click(function(){
		$("html,body").animate({
			scrollTop: "0px"
		}, 300);
	});

	
	//quick menu
	$('.quickmenu .openstatus .closebtn').click(function(){
		if(!$('.quickmenu .openstatus').hasClass('closed')){
			$('.quickmenu .openstatus').addClass('closed')
			$('.quickmenu .closestatus').removeClass('closed')
		}else{
			$('.quickmenu .closestatus').addClass('closed')
			$('.quickmenu .openstatus').removeClass('closed')
		}
	})
	$('.quickmenu .closestatus .openbtn').click(function(){
		if(!$('.quickmenu .closestatus').hasClass('closed')){
			$('.quickmenu .closestatus').addClass('closed')
			$('.quickmenu .openstatus').removeClass('closed')
		}else{
			$('.quickmenu .openstatus').addClass('closed')
			$('.quickmenu .closestatus').removeClass('closed')
		}
	})
	//portfolio
	$('.portfolio .list .item').click(function(){
		$('.modal-body img').attr('src',$(this).attr('bigimg'))
		$('.modal-title').text($(this).find('.title').text())
	})
	
	document.addEventListener('DOMContentLoaded', function() {
	    var form = document.getElementById('portfoliofrom'); 
	    document.getElementById('search').value = 'article_title'
	    var input = document.getElementById('searchportfolio'); 
	 
	    input.addEventListener('keydown', function(event) {
	        if (event.key === 'Enter') { 
	            console.log(document.getElementById('search').value)
	            
	            event.preventDefault(); 
	            form.submit(); 
	        }
	    });
	});
	//main project
	if($('.main-project').length > 0) {
		var setWorkSlide = function(element){
			element.owlCarousel({
				nav:false,
				loop:true,
				dots:false,
				margin:30,
				items:2,
				smartSpeed:500,
				mouseDrag:false
			});
			var elementIndex = 1;
			var elementCount = 3;
			element.on('next.owl.carousel', function(event) {
				console.log(event);
				if(elementIndex>2){
					elementIndex = 1
				}else{
					elementIndex++
				}
				$('.main-product .ft .slidernavi .num .active').text('0'+elementIndex);
				$('.main-product .ft .slidernavi .linenavi').removeClass('active1').removeClass('active2').removeClass('active3').addClass('active'+elementIndex);
				$('.main-product .bd .texttab .item').eq(elementIndex-1).addClass('active').siblings().removeClass('active');
			});
			
			element.on('prev.owl.carousel', function(event) {
				console.log(event);
				if(elementIndex<2){
					elementIndex = 3
				}else{
					elementIndex--
				}
				$('.main-product .ft .slidernavi .num .active').text('0'+elementIndex);
				$('.main-product .ft .slidernavi .linenavi').removeClass('active1').removeClass('active2').removeClass('active3').addClass('active'+elementIndex);
				$('.main-product .bd .texttab .item').eq(elementIndex-1).addClass('active').siblings().removeClass('active');
			});
			
			$('.main-product .ft .sliderctrl .prev').click(function(){
				element.trigger('prev.owl');
			})
			$('.main-product .ft .sliderctrl .next').click(function(){
				element.trigger('next.owl');
			})
			
			
			element.parents('.main-project').find('.next-btn').click(function(){
				element.trigger('next.owl');
			});
		};
		$('.main-project .owl-carousel').each(function(){
			setWorkSlide($(this));
		});
	} 
    
});

