// JavaScript Document

$(document).ready(function(){

	//Navigation Menu
	$('ul.mainmenucontain li').hover(
		function(){
			$(this).children('div').css('display','table')
		},
		function(){	
			$(this).children('div').css('display','none')
		}
	);
	
	//Checkout steps
	$('.checkoutsteptitle').addClass('down').next('.checkoutstep').fadeIn()
	$('.checkoutsteptitle').on('click', function()
	{		
	
	$("select, input:checkbox, input:radio, input:file").css('display', 'blcok');	
		$(this).toggleClass('down').next('.checkoutstep').slideToggle()
	});	
	
    //To make dropdown actually work
    $("nav.subnav select").change(function() {
        window.location = $(this).find("option:selected").val();
     });
     
	//Fancybox 
	$('a.prettyphotpopup').prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false, allow_expand: false});	

	//Accrodian	
	$("#accrodian").collapse({toggle: false})

	//Accrodian	
	var $acdata = $('.accrodian-data'),
		$acclick = $('.accrodian-trigger');

	$acdata.hide();
	$acclick.first().addClass('active').next().show();	
	
	$acclick.on('click', function(e) {
		if( $(this).next().is(':hidden') ) {
			$acclick.removeClass('active').next().slideUp(300);
			$(this).toggleClass('active').next().slideDown(300);
		}
		e.preventDefault();
	});
	
	//Accrodian	
	var $acdata1 = $('.accrodian-data-faq'),
		$acclick1 = $('.accrodian-trigger-faq');

	$acdata1.hide();
	$acclick1.first().addClass('active').next().show();	
	
	$acclick1.on('click', function(e) {
		if( $(this).next().is(':hidden') ) {
			$acclick1.removeClass('active').next().slideUp(300);
			$(this).toggleClass('active').next().slideDown(300);
		}
		e.preventDefault();
	});

	//Toggle			
	$('.togglehandle').click(function()
	{
		$(this).toggleClass('active')
		$(this).next('.toggledata').slideToggle()
	});
	
	//Dropdowns
	$('.dropdown').hover(
		function(){$(this).addClass('open')			
		},
		function(){			
			$(this).removeClass('open')
		}
	 );
	 
	 //Messages
	 $('.alert .icon-remove').click(function (e) {
		$(this).parent('.alert').fadeOut();
	 })
			
	 // List & Grid View
	 $('#productlist .featureprojectwrap:first').show()
	 $('#list').click(function()
	 {	$(this).addClass ('btn-blue').children('i').addClass('icon-white')
		$('.grid').fadeOut()
		$('.list').fadeIn()
		$('#grid').removeClass ('btn-blue').children('i').removeClass('icon-white')
	 });
	 $('#grid').click(function()
	 {	$(this).addClass ('btn-blue').children('i').addClass('icon-white')
		$('.list').fadeOut()
		$('.grid').fadeIn()
		$('#list').removeClass ('btn-blue').children('i').removeClass('icon-white')
	 });
	
     //Tooltip	
	 $('.tooltip-test').tooltip();

     //Scroll top
	 $(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#gotop').fadeIn(500);
			} else {
				$('#gotop').fadeOut(500);
			}
	 });	
	 $('#gotop').click(function(){
				$("html, body").animate({ scrollTop: 0 }, 600);
	 })
});


// Window load Funcitons 

$(window).load(function() {
		// Home page Slider 10	
		function prevTimers() {
			return allTimers().slice( 0, $('.sliderindex10pager a.selected').index() );
		}
		function allTimers() {
			return $('.sliderindex10pager a span');
		}

		$(function() {
			$('#sliderindex10').carouFredSel({
				items: 1,
				responsive : true,
				auto: {
					pauseOnHover: 'resume',
					progress: {
						bar: '.sliderindex10pager a:first span'
					}
				},
				scroll: {
					fx: 'crossfade',
					duration: 300,
					timeoutDuration: 2000,
					onAfter: function() {
						allTimers().stop().width( 0 );
					//	prevTimers().width(  );
						$(this).trigger('configuration', [ 'auto.progress.bar', '.sliderindex10pager a.selected span' ]);
					}
				},
				pagination: {
					container: '.sliderindex10pager',
					anchorBuilder: false
				}
			});
		});			
}); 
	

//All Carousals	 - Flex plugin
(function() {  
	// store the slider in a local variable
	var $window = $(window),
		flexslider;
		
	// 5 COLUMN carousal
	function getGridSizecolumn5() {
		return  (window.innerWidth < 480) ? 1 :
				(window.innerWidth < 600) ? 2 :
				(window.innerWidth < 900) ? 3 : 5;
  	} 
	$window.load(function() {
		$('.column5').flexslider({
			animation: "slide",
			animationSpeed: 400,
			animationLoop: false,
			slideshow : false,
			itemWidth: 210,	
			itemMargin: 30,	
			minItems: getGridSizecolumn5(), // use function to pull in initial value
			maxItems: getGridSizecolumn5(), // use function to pull in initial value
			start: function(slider){
			$('body').removeClass('loading');
			flexslider = slider;
			}
		});
	})
	// 4 COLOUMN carosal
 
	// tiny helper function to add breakpoints
	function getGridSizecolumn4() {
		return  (window.innerWidth < 480) ? 1 :
				(window.innerWidth < 600) ? 2 :
				(window.innerWidth < 900) ? 3 : 4;
  	} 
	$window.load(function() {
		$('.column4').flexslider({
			animation: "slide",
			animationSpeed: 400,
			animationLoop: false,
			slideshow : false,
			itemWidth: 270,
			itemMargin: 33,
			minItems: getGridSizecolumn4(), // use function to pull in initial value
			maxItems: getGridSizecolumn4(), // use function to pull in initial value
			start: function(slider){
			$('body').removeClass('loading');
			flexslider = slider;
			}
		});
	})
	
	// 3 COLOUMN carosal
	// tiny helper function to add breakpoints
	function getGridSizecolumn3() {
		return  (window.innerWidth < 480) ? 1 :
				(window.innerWidth < 600) ? 2 :
				(window.innerWidth < 900) ? 3 : 3;
  	} 
	$window.load(function() {
		$('.column3').flexslider({
			animation: "slide",
			animationSpeed: 400,
			animationLoop: false,
			slideshow : false,
			itemWidth: 270,
			itemMargin: 34,
			minItems: getGridSizecolumn3(), // use function to pull in initial value
			maxItems: getGridSizecolumn3(), // use function to pull in initial value
			start: function(slider){
			$('body').removeClass('loading');
			flexslider = slider;
			}
		});
	})
	// 2 COLOUMN carosal
	function getGridSizecolumn2() {
	   return   (window.innerWidth < 480) ? 1 :
				(window.innerWidth < 600) ? 2 :
        		(window.innerWidth < 900) ? 2 : 2;
 	}	
	$window.load(function() {
	$('.column2').flexslider({
		animation: "slide",
		animationSpeed: 400,
		animationLoop: false,
		slideshow : false,
		itemWidth: 260,
		itemMargin: 30,
		minItems: getGridSizecolumn2(), // use function to pull in initial value
		maxItems: getGridSizecolumn2(), // use function to pull in initial value
		start: function(slider){
			$('body').removeClass('loading');
            flexslider = slider;
          }
        });		
	});
  }());
// Animation


$(document).ready(function() {	
  	$('.seodetails').bind('inview', function (event, visible) {
        if (visible == true) {
            $('.headingcenter, .metadetails').addClass("animated pulse time3");        
        }else{
            $('.headingcenter, .metadetails').removeClass("animated pulse time3");
        }
    });
	$('.ourprocess').bind('inview', function (event, visible) {
        if (visible == true) {
            $('.ourprocess').addClass("animated pulse time3");        
        }else{
            $('.ourprocess').removeClass("animated pulse time3");
        }
    });	
	$('.features, .features-home2, .features-home4, .features-home5').bind('inview', function (event, visible) {
        if (visible == true) {
            $('.features, .features-home2, .features-home4, .features-home5').addClass("animated fadeInUp time3");        
        }else{
            $('.features, .features-home2, .features-home4, .features-home5').removeClass("animated fadeInUp time3");
        }
    });		
	
	$('#footer').bind('inview', function (event, visible) {
        if (visible == true) {
            $('#footer .footersocial .container').addClass("animated fadeInUp time3");        
        }else{
            $('#footer .footersocial .container').removeClass("animated fadeInUp time3");
        }	
    });	
	$('.heading1').bind('inview', function (event, visible) {
        if (visible == true) {
            $(this).addClass("animated fadeInUp time3");        
        }else{
            $(this).removeClass("animated fadeInUp time3");
        }	
    });
	$('.heading2').bind('inview', function (event, visible) {
        if (visible == true) {
            $(this).addClass("animated fadeInUp time3");        
        }else{
            $(this).removeClass("animated fadeInUp time3");
        }	
    });	
	$('.titles').bind('inview', function (event, visible) {
        if (visible == true) {
            $(this).addClass("animated fadeInUp time3"); 
			$('.titles i').addClass("animated flip time3");          
        }else{
            $(this).removeClass("animated fadeInUp time3");
			$('.titles i').removeClass("animated flip time3"); 
        }	
    });

});
	 
	
       
 
	 
	

	
