

$(function () {
	'use strict';
	
	
	// search function
	const keywords = [
		'중국취업비자 서류', '중국현지비자 서류', '중국 결혼서류', '부동산 소송 서류', '유학/기타개인 서류', '법인 민원서류', 
	'중국 현지서류', '베트남 비자', '베트남 통번역', '베트남 회사설립', '베트남화장품 위생허가', '상표등록대리', '베트남 부동산 임대', '베트남 공증 및 영사인증', 
	'쿠웨이트', 'uae', '대만대표부', '태국', '그외국가', '전세계 아포스티유', '번역 공증', '사실 공증', '미국', '캐나다'
	];

	if($('#searchInput').length>0){
		const searchInput = document.getElementById('searchInput');
	const suggestionsList = document.getElementById('suggestions');
	let activeIndex = -1;

	// 显示建议列表
	function showSuggestions(results) {
		suggestionsList.innerHTML = '';
		activeIndex = -1;
		if (!results.length || !searchInput.value) {
			suggestionsList.style.display = 'none';
			return;
		}
		results.forEach((word, index) => {
			const li = document.createElement('li');
			const matchIndex = word.toLowerCase().indexOf(searchInput.value.toLowerCase());
			
			if (matchIndex > -1) {
				li.innerHTML = `
					${word.substring(0, matchIndex)}
					<span class="highlight">${word.substr(matchIndex, searchInput.value.length)}</span>
					${word.substring(matchIndex + searchInput.value.length)}
				`;
			} else {
				li.textContent = word;
			}
			li.addEventListener('click', () => selectSuggestion(word));
			li.addEventListener('mouseover', () => setActiveItem(index));
			suggestionsList.appendChild(li);
		});
		suggestionsList.style.display = 'block';
	}

	// 选择建议项
	function selectSuggestion(value) {
		searchInput.value = value;
		suggestionsList.style.display = 'none';
		searchInput.focus();
	}

	// 设置当前激活项
	function setActiveItem(index) {
		const items = suggestionsList.children;
		if (activeIndex > -1) items[activeIndex].classList.remove('active');
		activeIndex = index;
		if (items[index]) {
			items[index].classList.add('active');
			items[index].scrollIntoView({ block: 'nearest' });
		}
	}

	// 输入处理（带防抖）
	let timeoutId;
	searchInput.addEventListener('input', function(e) {
		clearTimeout(timeoutId);
		timeoutId = setTimeout(() => {
			const input = this.value.toLowerCase();
			const results = keywords.filter(word => 
				word.toLowerCase().includes(input)
			).slice(0, 10); // 最多显示10条
			showSuggestions(results);
		}, 200);
	});

	// 键盘导航
	searchInput.addEventListener('keydown', (e) => {
		const items = suggestionsList.children;
		if (items.length === 0) return;
		switch(e.key) {
			case 'ArrowDown':
				e.preventDefault();
				setActiveItem((activeIndex + 1) % items.length);
				break;
			case 'ArrowUp':
				e.preventDefault();
				setActiveItem((activeIndex - 1 + items.length) % items.length);
				break;
			case 'Enter':
				if (activeIndex > -1) {
					e.preventDefault();
					selectSuggestion(items[activeIndex].textContent);
				}
				break;
			case 'Escape':
				suggestionsList.style.display = 'none';
				break;
		}
	});

	// 点击外部区域关闭
	document.addEventListener('click', (e) => {
		if (!e.target.closest('.container')) {
			suggestionsList.style.display = 'none';
		}
	});

	// 初始隐藏下拉框
	suggestionsList.style.display = 'none';

	}
	

	
    //首页幻灯片
    //main slide
		if($('#main-banner-slide')){
			var mainslideImgList = []
			var mainSlideIndex = 1;
			var mainSlideCount = 0;
			var masinSlideType = 'next'
			$('#main-banner-slide .item').each((index,item)=>{
				mainslideImgList.push(item.getAttribute('url'))
				mainSlideCount++
			})
			$('#main-banner-slide-control .current .total').html(mainslideImgList.length)
			
			var mainSlide = $('#main-banner-slide');
			mainSlide.owlCarousel({
					loop:true,
					margin:0,
					items:1,
					autoplay:false,
					autoplayTimeout:5000,
					autoplayHoverPause:false,
					animateOut: 'fadeOut',
					animateIn:'fadeIn',
					mouseDrag:false,
					touchDrag:false,
					dots:true,
			});
			$('#main-banner-slide-control .next').click(function(){
				masinSlideType = 'next'
				mainSlide.trigger('next.owl.carousel');
			});
			$('#main-banner-slide-control .prev').click(function(e){
				masinSlideType = 'prev'
				if(mainSlideIndex>1){
					mainSlideIndex--
				}else{
					mainSlideIndex = mainSlideCount
				}
				mainSlide.trigger('prev.owl.carousel');
			});
			mainSlide.on('changed.owl.carousel', function(event) {
				if(masinSlideType==='next'){
					if(mainSlideIndex<mainSlideCount){
						mainSlideIndex++
					}else{
						mainSlideIndex = 1
					}
				}
				$('#main-banner-slide-control .current .active').html(mainSlideIndex)
				$('#main-banner-slide-control .current .total').html(mainSlideCount)
				masinSlideType = 'next'
			})
		}



	$('.back2top').click(function(){
		$("html,body").animate({
			scrollTop: "0px"
		}, 300);
	});
	let currentZoom = 100;

	$('.zoom-font #plus').click(function(){
		currentZoom += 10;
	 	 $("body").css("zoom", currentZoom + "%");
	})
	$('.zoom-font #minus').click(function(){
		currentZoom -= 10;
	 	 $("body").css("zoom", currentZoom + "%");
	})
	
	if($('.main-banner').length > 0) {
			var setWorkSlide = function(element){
				element.owlCarousel({
					nav:false,
					loop:true,
					dots:false,
					autoplay:true,
					autoplayTimeout:3000,
					margin:0,
					items:1,
					smartSpeed:500,
					mouseDrag:false
				});
				var elementIndex = 1;
				var elementCount = 4;
				//on change
				element.on('change.owl.carousel', function(event) {
					$('.main-banner .ft .slidernavi .num .active').text('0'+event.item.index);
					let linebarwidth = $('.linenavi').width()/elementCount
					$('.main-banner .ft .slidernavi .linenavi span').css('left',linebarwidth*event.item.index-linebarwidth);
				});
				//on next
				element.on('next.owl.carousel', function(event) {
					if(elementIndex>3){
						elementIndex = 1
					}else{
						elementIndex++
					}
					let linebarwidth = $('.linenavi').width()/elementCount
					$('.main-banner .ft .slidernavi .num .active').text('0'+elementIndex);
					$('.main-banner .ft .slidernavi .linenavi span').css('left',linebarwidth*elementIndex-linebarwidth);
				});
				//on prev
				element.on('prev.owl.carousel', function(event) {
					if(elementIndex<2){
						elementIndex = 4
					}else{
						elementIndex--
					}
					$('.main-banner .ft .slidernavi .num .active').text('0'+elementIndex);
					$('.main-banner .ft .slidernavi .linenavi span').css('left',45*elementIndex-45);
				});
				//prev slide
				$('.main-banner .ft .sliderctrl .prev').click(function(){
					element.trigger('prev.owl');
				})
				//next slide 
				$('.main-banner .ft .sliderctrl .next').click(function(){
					element.trigger('next.owl');
				})
				//pause
				$('.main-banner .ft .sliderctrl .pause').click(function(){
					element.trigger('stop.owl.autoplay');
					$(this).addClass('hide')
					$('.main-banner .ft .sliderctrl .play').removeClass('hide')
				})
				//play
				$('.main-banner .ft .sliderctrl .play').click(function(){
					element.trigger('play.owl.autoplay');
					$(this).addClass('hide')
					$('.main-banner .ft .sliderctrl .pause').removeClass('hide')
				})
				//show all
				$('.main-banner .ft .sliderctrl .all').click(function(){
					if($('.main-banner-modal').hasClass('show')){
						$('.main-banner-modal').removeClass('show')
					}else{
						$('.main-banner-modal').addClass('show')
					}
				})
				//hide all
				$('.modal .close').click(function(){
					if($('.modal').hasClass('show')){
						$('.modal').removeClass('show')
					}else{
						$('.modal').addClass('show')
					}
				})
			};
			$('.main-banner .owl-carousel').each(function(){
				setWorkSlide($(this));
			});
		} 

	//mian-itme2
	if($('.cate-group').length > 0) {
			var setCateSlide = function(element){
				element.owlCarousel({
					nav:false,
					loop:true,
					dots:false,
					margin:0,
					items:1,
					smartSpeed:500,
					mouseDrag:false
				});
				let index = 0
				//prev slide
				$('.cate-group .sliderctrl .prev').click(function(){
					element.trigger('prev.owl');
					if(index>0){
						index--
					}else{
						index=5
					}
					$('.main-left .item-2 .bd .cate ul li').eq(index).addClass('active').siblings().removeClass('active');
				})
				//next slide 
				$('.cate-group .sliderctrl .next').click(function(){
					element.trigger('next.owl');
					if(index<5){
						index++
					}else{
						index=0
					}
					$('.main-left .item-2 .bd .cate ul li').eq(index).addClass('active').siblings().removeClass('active');
				})
				$('.main-left .item-2 .bd .cate ul li').click(function(){
					$(this).addClass('active').siblings().removeClass('active');
					element.trigger('to.owl.carousel',[$(this).index()]);
					index = $(this).index()
				})
			};
			$('.cate-group .owl-carousel').each(function(){
				setCateSlide($(this));
			});
		} 
	//review
	if($('.subpage .review .bd').length > 0) {
		var setCateSlide = function(element){
			element.owlCarousel({
				nav:false,
				loop:true,
				autoplay:true,
				autoplayTimeout:3000,
				dots:false,
				margin:0,
				items:1,
				smartSpeed:500,
				mouseDrag:false,
				touchDrag:false
			});
		};
		$('.subpage .review .bd .owl-carousel').each(function(){
			setCateSlide($(this));
		});
	} 
	//mian-itme3
	if($('.main-left .item-3').length > 0) {
			var setCateSlide = function(element){
				element.owlCarousel({
					nav:false,
					loop:true,
					autoplay:true,
					autoplayTimeout:3000,
					dots:false,
					margin:0,
					items:2,
					smartSpeed:500,
					mouseDrag:false,
					touchDrag:false
				});
				let index = 0
				//prev slide
				$('.main-left .item-3 .sliderctrl .prev').click(function(){
					element.trigger('prev.owl');
				})
				//next slide 
				$('.main-left .item-3 .sliderctrl .next').click(function(){
					element.trigger('next.owl');
				})
			};
			$('.main-left .item-3 .owl-carousel').each(function(){
				setCateSlide($(this));
			});
		} 
	//item-4 
	if($('.item-4 .swiper')){
		var mainitem4swiper = new Swiper(".item-4 .swiper", {
			direction: "vertical",
			slidesPerView: 7,
			spaceBetween: 0,
			loop:true,
			autoplay:true,
			delay:500,
			touchDrag:false,
			mousewheel: false,
		});
	}
	//item-8
	if($('.item-8 .swiper')){
		var mainitem8swiper = new Swiper(".item-8 .swiper", {
			direction: "vertical",
			slidesPerView: 1,
			spaceBetween: 15,
			loop:true,
			autoplay:true,
			delay:500,
			touchDrag:false,
			mousewheel: false,
		});
	}
	//item-9
	if($('.item-9 .swiper')){
		var mainitem9swiper = new Swiper(".item-9 .swiper", {
			direction: "vertical",
			slidesPerView: 7,
			spaceBetween: 0,
			loop:true,
			autoplay:true,
			delay:500,
			touchDrag:false,
			mousewheel: false,
		});
	}
	//item-10
	if($('.main-item10').length > 0) {
		var setCateSlide = function(element){
			element.owlCarousel({
				nav:false,
				loop:true,
				autoplay:true,
				autoplayTimeout:3000,
				dots:false,
				margin:15,
				items:4,
				smartSpeed:500,
				mouseDrag:false,
				touchDrag:false
			});
		};
		$('.main-item10 .owl-carousel').each(function(){
			setCateSlide($(this));
		});
	} 
	
    $('#navi .navbar-toggle').click(function(){
        if($('nav').hasClass('open')){
            $('nav').removeClass('open')
        }else{
            $('nav').addClass('open')
        }
    })


    //pricetype
    const pricetype = function(number,n){
        if(n != 0 ){
        n = (n > 0 && n <= 20) ? n : 2; 
        }
        number = parseFloat((number + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";  
        var sub_val = number.split(".")[0].split("").reverse(); 
        var sub_xs = number.split(".")[1];  
        var show_html = "";  
        for (var i = 0; i < sub_val.length; i++){  
        show_html += sub_val[i] + ((i + 1) % 3 === 0 && (i + 1) !== sub_val.length ? "," : "");  
        }  
        if(n === 0 ){
        return show_html.split("").reverse().join("");  
        }else{
        return show_html.split("").reverse().join("") + "." + sub_xs;  
        }
    }


	if($('.services-list').length>0){
		let price = 0
		let serviceslist = []
	
		//add & del products to order list 
		$('.services-list tbody tr').click(function(){
			if($(this).attr('disabled')) return false
			if($(this).hasClass('active')){
				$(this).removeClass('active')
				price -= parseInt($(this).find('td').eq(7).attr('data-product-price'))
				serviceslist = serviceslist.filter((item)=>{
					if(item.name!==$(this).find('td').eq(1).text()) return true
				})
			}else{
				$(this).addClass('active')
				serviceslist.push({
					id:$(this).attr('data-product-id'),
					name:$(this).find('td').eq(1).text(),
					time:$(this).find('td').eq(2).text(),
					content:$(this).find('td').eq(3).text(),
					link1:$(this).find('td').eq(4).text(),
					link2:$(this).find('td').eq(5).text(),
					link3:$(this).find('td').eq(6).text(),
					price:$(this).find('td').eq(7).attr('data-product-price')
				})
				price += parseInt($(this).find('td').eq(7).attr('data-product-price'))
			}
			updOrderList()
		})
	
		//update order list 
		const updOrderList = function(){
			let html = ''
			serviceslist.forEach((item)=>{
				html += '<div class="order-bar" data-id="'
				html += item.id
				html += '"><div class="hd"><div class="txt">'
				html += item.name
				html += '</div><div class="del"><img src="/resource/home/ko/assets/images/m/icon_del.png"></div></div>'
				html += '<div class="bd"><table><tbody><tr><td>포함 사항</td><td>'
				html += item.content
				html += '</td></tr><tr><td>소요 기간</td><td>'
				html +=	item.time
				html += '</td></tr></tbody></table><div class="ctrl"><div class="item"><div class="label">금액</div><div class="price">'
				html += pricetype(item.price,0)+'원'
				html += '</div></div></div></div><div class="ft"><div class="item"><a target="_blank" href="'
				html += item.link1
				html += '"><img src="/resource/home/ko/assets/images/m/m_06.png"></a></div><div class="item"><a target="_blank" href="'
				html += item.link2
				html += '"><img src="/resource/home/ko/assets/images/m/m_08.png"></a></div><div class="item"><a donwload="'
				html += item.link3
				html += '" href="'
				html += item.link3
				html += '"><img src="/resource/home/ko/assets/images/m/m_03.png"></a></div></div></div>'
			})
			$('.order-board').html(html)
			console.log(price)
			$('.item-4 .order-price .price').html(pricetype(price,0)+'원')
			//del service 
			$('.order-board .order-bar .del').click(function(){
				let id = $(this).parents('.order-bar').attr('data-id')
				serviceslist = serviceslist.filter((item)=>{
					if(item.id!==id){
						return true
					}else{
						price -= item.price
						$('.services-list tbody tr[data-product-id='+item.id+']').removeClass('active')
					}
				})
				updOrderList()
			})
		}
		
		//submit order
		$('.order-price .submit').click(function(){
			if(serviceslist.length>0){
				let data = ''
				serviceslist.forEach((item)=>{ 
					data += item.id+','
				})
				var keyword = $(this).attr('data-keyword');
				if(keyword){
					window.location.href = $(this).attr('data-url') +'?keyword='+keyword+'&id='+data.slice(0, -1);	
				}else{
					window.location.href = $(this).attr('data-url') +'?id='+data.slice(0, -1);	
				}
				// window.location.href = $(this).attr('data-url') +'?id='+data.slice(0, -1);
			}else{
				swal({
					icon: "error",
					title: "신청 항목 선택하십시오.",
					button: "OK",
					closeOnClickOutside: false,
				})
			}
		})

		// hide fixed order bar
		let orderbar2top = $('footer').offset().top
		$(window).scroll(function(e) {   
			let scrolltop = $(window).scrollTop()
			if(scrolltop+550 >= orderbar2top){
				$('.subpage .item-4').removeClass('fixed')
			}else{
				$('.subpage .item-4').addClass('fixed')
			}
		})
	
	}
	if($('.item-3.order-board').length>0){
		//update price
		const updatePrice = function(){
			//update products price
			let productPrice = 0
			$('.item-3.order-board .order-bar').each(function(){
				let unitPrice =  parseInt($(this).find('.price').attr('price'))
				let amount = parseInt($(this).find('.number').text())
				productPrice += unitPrice * amount
				$(this).find('.price').text(pricetype(unitPrice * amount,0))
			})
			//update total price
			if($('#form-order').length>0){
				let documntsTypePrice = []
				let postTypePrice = []
				if($('select[name=documenttype] option').length>0){
					$('select[name=documenttype] option').each(function(){
						documntsTypePrice.push(parseInt($(this).attr('price')))
					})
					let documentPrice = documntsTypePrice[parseInt($('select[name=documenttype]').val())] * parseInt($('input[name=documents-num]').val())
					$('input[name=documents-price]').val(pricetype(documentPrice,0)+'원')
					productPrice += documentPrice
				}
				$('select[name=posttype] option').each(function(){
					postTypePrice.push(parseInt($(this).attr('price')))
				})
				productPrice += postTypePrice[parseInt($('select[name=posttype]').val())]
				$('.item-6 .order-board .price').html(pricetype(productPrice,0)+'원')
			}
		}

		updatePrice()

		//click plus button
		$('.item-3.order-board .plus').click(function(){
			let number = parseInt($(this).prev().text())
			$(this).prev().text(number+1)
			updatePrice()
		})
		//click minus button
		$('.item-3.order-board .minus').click(function(){
			let number = parseInt($(this).next().text())
			if(number>1){
				$(this).next().text(number-1)
				updatePrice()
			}
		})

		//check product list
		let checkProductList = function(){
			let html = ''
			$('.item-4.order-list table tbody tr').each(function(){
				html += '<div class="item" data-product-id="'+$(this).attr('data-product-id')+'">'+$(this).find('.name').text()+'</div>'
			})
			$('.order-board .hd .value').html(html)
		}

		//delete product
		$('.item-3.order-board .del').click(function(){
			if($('.item-3.order-board .order-bar').length>1){
				$(this).parents('.order-bar').remove()
				updatePrice()
			}
			if($('#form-order').length>0){
				checkProductList()
			}
		})

	
		//change documents num
		$('input[name=documents-num]').change(function(){
			updatePrice()
		})
		//change documentype
		$('select[name=documenttype]').change(function(){
			updatePrice()
		})
		//change posttype
		$('select[name=posttype]').change(function(){
			updatePrice()
			switch($(this).val()){
				case '0':
					$('.input-name').show()
					$('.input-phone').show()
					$('.input-address').show()
					$('.input-address-full').show()
					$('.input-post-type').hide()
					$('.english').hide()
					break;
				case '1':
					$('.input-name').show()
					$('.input-phone').show()
					$('.input-address').show()
					$('.input-address-full').show()
					$('.input-post-type').hide()
					$('.english').hide()
					break;
				case '2':
					$('.input-name').show()
					$('.input-phone').show()
					$('.input-address').show()
					$('.input-address-full').hide()
					$('.input-post-type').show()
					$('.english').show()
					break;
				case '3':
					$('.input-name').hide()
					$('.input-phone').hide()
					$('.input-address').hide()
					$('.input-address-full').hide()
					$('.input-post-type').hide()
					$('.english').hide()
					break;
			}
		})
		//checkProductList()

		//validate
		$( "#form-order").validate({
			rules: {
				// 'number': {
				// 	required: true, 
				// 	minlength: 2 
				// },
				'name': {
					required: true, 
					minlength: 2 
				},
				'phone': {
					required: true
				},
				'address': {
					required: true
				},
				'address-full':{
					required: true
				},
				'post-number':{
					required: true
				}
			},
			errorElement: "em",
			errorPlacement: function ( error, element ) {
				errorPlacementCustom( error, element);
			},
			success: function ( label, element ) {
				successCustom(label, element);
			},
			highlight: function ( element, errorClass, validClass ) {
				highlightCustom( element, errorClass, validClass);
			},
			unhighlight: function ( element, errorClass, validClass ) {
				unhighlightCustom(element, errorClass, validClass);
			},
			submitHandler: function(form) {
				var $form    = $(form),
						formData = new FormData(),
						params   = $form.serializeArray();
						
				$.each(params, function(i, val) {
					formData.append(val.name, val.value);
				});
				var docid = []
				var docamount = []
				$('.item-3.order-board').each(function(){
					docid.push($(this).attr('data-product-id'))
					docamount.push($(this).find('.number').text())
				})
				formData.append('docid',docid)
				formData.append('docamount', docamount)

				$.ajax({
					url : sendForm, 
					type : "post",
					dataType : "html",
					data: formData,
					contentType: false,
					processData: false,
					// beforeSend: function(){  
					// 	swal({
					// 		icon: "success",
					// 		className: "alertloading",
					// 		button:false,
					// 		closeOnClickOutside: false,
					// 	});
					// },
					success : function(result) {
						var result = JSON.parse(result);
						if(result.code === 200) {
							swal({
								icon: "success",
								title: "Success",
								button: "OK",
								closeOnClickOutside: false,
							}).then(function(){
								window.location.href="/mobile/mypage_services";
							});
						} else {
							swal({
								icon: "error",
								title: result.msg,
								button: "OK",
								closeOnClickOutside: false,
							}).then(function(){
								//window.location.reload();
							});
						}
					}
				});
			},
			invalidHandler: function(form, validator) {  
				return false;
			}
		});
	}

	//vietnam main  item-13 
	if($('.vietnam .item-13').length>0){
		$('.vietnam .item-13 .hd .item').click(function(){
			$(this).addClass('active').siblings().removeClass('active')
			$('.vietnam .item-13 .bd .cont').eq($(this).index()).addClass('active').siblings().removeClass('active')
		})
	}
	
	//vienam sub2-5-2 
	if($('.subpage .qna').length>0){
		$('.qna .item').click(function(){
			if(!$(this).hasClass('active')){
				$(this).addClass('active').siblings().removeClass('active')
			}else{
				$(this).removeClass('active')
			}
		})
		
	}
	

	//search-area 
	if($('.search-area').length>0){
		$('.search-area input').on('input',function(){
			console.log($(this).val())
			var value = $(this).val()
			$('.search-area .bd tbody tr td b').each(function(){
				if($(this).text()===value){
					$('.search-area .bd tbody tr td b').removeClass('active')
					$(this).addClass('active')
				}
			})
		})
	}
	//show modal 
	$('button[data-toggle="modal"]').click(function(){
		if($(this).attr('data-target').hasClass('in')){
			$($(this).attr('data-target')).removeClass('in')
		}else{
			$($(this).attr('data-target')).addClass('in')
		}
	})


	if($('.login').length>0){

		
		

		//check agreements
		$('#allagree').click(function(){
			if($(this).prop('checked')){
				$('input[name=agreement1]').prop('checked',true)
				$('input[name=agreement2]').prop('checked',true)
			}else{
				$('input[name=agreement1]').prop('checked',false)
				$('input[name=agreement2]').prop('checked',false)
			}
		})
		var checkAllChecked = function(){
			if($('input[name=agreement1]').prop('checked')&&$('input[name=agreement2]').prop('checked')){
				$('#allagree').prop('checked',true)
			}else{
				$('#allagree').prop('checked',false)
			}
		}
		$('input[name=agreement1]').click(function(){
			checkAllChecked()
		})
		$('input[name=agreement2]').click(function(){
			checkAllChecked()
		})
		//open&close agreement
		$('#agreements01').click(function(){
			$('.agreements01').removeClass('hide')
			return false
		})
		$('.agreements01 .rbtn').click(function(){
			$('.agreements01').addClass('hide')
			return false
		})
		$('#agreements02').click(function(){
			$('.agreements02').removeClass('hide')
			return false
		})
		$('.agreements02 .rbtn').click(function(){
			$('.agreements02').addClass('hide')
			return false
		})
	}

	//tabnavi
	if($('.mypage .services').length>0){
		$('.tabnavi .item').click(function(){
			if(!$(this).hasClass('active')){
				$(this).addClass('active').siblings().removeClass('active')
			}
			$('.tabcont .tabitem').eq($(this).index()).addClass('active').siblings().removeClass('active')
		})
	}
	
	//form contact
	if($('#form-contact').length>0){
		$( "#form-contact").validate({
			rules: {
				'company': {
					required: true
				},
				'location': {
					required: true
				},
				'name': {
					required: true
				},
				'phone': {
					required: true
				},
				'email':{
					required: true
				},
				'services':{
					required: true
				},
				'contents':{
					required: true
				},
				'agree':{
					required: true
				}
			},
			errorElement: "em",
			errorPlacement: function ( error, element ) {
				errorPlacementCustom( error, element);
			},
			success: function ( label, element ) {
				successCustom(label, element);
			},
			highlight: function ( element, errorClass, validClass ) {
				highlightCustom( element, errorClass, validClass);
			},
			unhighlight: function ( element, errorClass, validClass ) {
				unhighlightCustom(element, errorClass, validClass);
			},
			submitHandler: function(form) {
				var $form    = $(form),
						formData = new FormData(),
						params   = $form.serializeArray();
						
				$.each(params, function(i, val) {
					formData.append(val.name, val.value);
				});
				$.ajax({
					url : '/mobile/insertContact', 
					type : "post",
					dataType : "html",
					data: formData,
					contentType: false,
					processData: false,
					// beforeSend: function(){  
					// 	swal({
					// 		icon: "success",
					// 		className: "alertloading",
					// 		button:false,
					// 		closeOnClickOutside: false,
					// 	});
					// },
					success : function(result) {
						var result = JSON.parse(result);
						if(result.code === 200) {
							swal({
								icon: "success",
								title: "Success",
								button: "OK",
								closeOnClickOutside: false,
							}).then(function(){
								window.location.reload();
							});
						} else {
							swal({
								icon: "error",
								title: "ERROR",
								button: "OK",
								closeOnClickOutside: false,
							}).then(function(){
								//window.location.reload();
							});
						}
					}
				});
			},
			invalidHandler: function(form, validator) {  
				return false;
			}
		});
	}


});