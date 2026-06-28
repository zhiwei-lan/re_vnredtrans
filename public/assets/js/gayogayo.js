$(function () {
	'use strict';
  if($('.main-banner').length>0){
    var mainBanner = new Swiper('.main-banner .swiper-container', {
      pagination: '.swiper-pagination',
      paginationClickable: true
    });
  }

  if($('.country-list').length>0){
    $('.country-list .country-name').click(function(){
      if($(this).parent().hasClass('open')){
        $(this).parent().removeClass('open')
      }else{
        $(this).parent().addClass('open')
      }
    })
  }

  if($('.detail-banner').length>0){
    var mainBanner = new Swiper('.detail-banner .swiper-container', {
      pagination: '.swiper-pagination',
      paginationClickable: true
    });
  }

  if($('.shop-info .info-o').length>0){
    $('.shop-info .info-o').click(function(){
      if($(this).hasClass('open')){
        $(this).removeClass('open')
      }else{
        $(this).addClass('open')
      }
    })
  }

  if($('.fixed-appt .btn').length>0){
    $('.fixed-appt .btn').click(function(){
      if($('.appt-popup').hasClass('open')){
        $('.appt-popup').removeClass('open')
      }else{
        $('.appt-popup').addClass('open')
      }
    })
    $('.appt-popup .hd .close').click(function(){
      $('.appt-popup').removeClass('open')
    })
    //select day & time
    const setTimeValue = function(){
      const daytext = $('.appt-popup .date .days .active .day').text()
      const day = daytext.split('.')
      const week = $('.appt-popup .date .days .active .week').text()
      const time = $('.appt-popup .date .days .active .time').text()
      $('.appt-submit .appttime').text(day[0]+'월'+day[1]+'일 '+week+' '+time)
    }
    $('.appt-popup .date .days .item').click(function(){
      $(this).addClass('active').siblings().removeClass('active')
      setTimeValue()
    })
    $('.appt-popup .date .tims .item').click(function(){
      $(this).addClass('active').siblings().removeClass('active')
      setTimeValue()
    })
    
    //select option
    //plus
    $('.appt-popup .select .btn.plus').click(function(){
      $(this).prev().text(parseInt($(this).prev().text()) + 1)
    })
    //minus
    $('.appt-popup .select .btn.minus').click(function(){
      if(parseInt($(this).next().text())>0){
        $(this).next().text(parseInt($(this).next().text()) - 1)
      }
    })
  }

  if($('.appt-services-popup').length>0){
    $('.order-detail .appt-ft .btn.appt-services').click(function(){
      if($('.appt-services-popup').hasClass('open')){
        $('.appt-services-popup').removeClass('open')
      }else{
        $('.appt-services-popup').addClass('open')
      }
    })
    $('.appt-services-popup .close.btn').click(function(){
      $('.appt-services-popup').removeClass('open')
    })
  }

  if($('.map-area .filter-cate').length>0){
    var categoryswiper = new Swiper('.map-area .filter-cate .swiper-container', {
      slidesPerView: 'auto',
      paginationClickable: true,
      spaceBetween: 5,
      freeMode: true
    });
  }
  
  if($('.map-shop-list .hd').length>0){
    $('.map-shop-list .hd').click(function(){
      if($('.map-shop-list').hasClass('open')){
        $('.map-shop-list').removeClass('open')
      }else{
        $('.map-shop-list').addClass('open')
      }
    })
  }

  if($('.map-shop-detail .contents .close').length>0){
    $('.map-shop-detail .contents .close').click(function(){
      $('.map-shop-detail').removeClass('open')
    })
  }

  if($('.shop-imgs').length>0){
    var shopimgsBanner = new Swiper('.shop-imgs .swiper-container', {
      pagination: '.swiper-pagination',
      paginationClickable: true
    });
    $('.map-shop-detail').click(function(){
      $('.map-shop-detail').removeClass('open')
    })
    $('.map-shop-detail .contents').click(function(){
      return false;
    })
  }
  

  if($('.copy').length>0){
    // toast
    let toastContainer = document.createElement("div");
    toastContainer.className = "toast-container";
    document.querySelector('.main-box-wrapper2').appendChild(toastContainer);
    function showToast(message, duration = 2000) {
      const toast = document.createElement("div");
      toast.className = "toast";
      toast.innerText = message;
      toastContainer.appendChild(toast);
      requestAnimationFrame(() => {
        toast.classList.add("show");
      });
      setTimeout(() => {
        toast.classList.remove("show");
        setTimeout(() => {
          toast.remove();
        }, 400);
      }, duration);
    }

    var copyText = function(text) {
      navigator.clipboard.writeText(text)
        .then(function() {
          showToast("복사되었습니다", 2000);
        })
        .catch(function(err) {
          console.error('Failed to copy text: ', err);
        });
    }
    $('.shop-detail .shop-info .info-l .copy ').click(function(){
      copyText($('.main-box-wrapper2 .shop-detail .shop-info .info-l .address').text())
    })

    $('.map-info .loc-item .col .copy').click(function(){
      copyText($(this).parent().prev().find('.v').text())
    })
    

  }
  




})