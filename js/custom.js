/* =====================================================================
 * DOCUMENT READY
 * =====================================================================
 */
$(document).ready(function(){
    $(window).resize(function(){
		Modernizr.addTest('ipad', function(){
			return !!navigator.userAgent.match(/iPad/i);
		});
		if(!Modernizr.ipad){	
			initializeMainMenu(); 
		}
	});
	initializeMainMenu();
    $('body').addClass('loaded');
    $('body').on('click', 'a[href^="#"]:not(a[href$="#"]):not(.popup-modal)', function(e){
        e.defaultPrevented;
        var obj = $(this);
        var target = obj.attr('href');
        $('html, body').animate({
            scrollTop: $(target).offset().top - parseInt($('body').css('padding-top'))
        }, 1400, 'easeInOutCirc');
        return false;
    });
    $('a.anchor-toggle').on('click', function(e){
        e.defaultPrevented;
        var obj = $(this);
        var target = obj.data('target');
        if($(target).hasClass('collapsed')) $(target).trigger('click');
        $('html, body').animate({
            scrollTop: $(target).offset().top - parseInt($('body').css('padding-top'))
        }, 1400, 'easeInOutCirc');
        return false;
    });
    $('a#toTop').on('click', function(e){
        e.defaultPrevented;
        $('html, body').animate({scrollTop: '0px'});
    });
    $('body').bind('touchmove', function(e){
        $(window).trigger('scroll');
    });
    $(window).on('onscroll scrollstart touchmove', function(){
        $(window).trigger('scroll');
    });
    $(window).scroll(function(){
        var scroll_1 = $('html, body').scrollTop();
        var scroll_2 = $('body').scrollTop();
        var scrolltop = scroll_1;
        if(scroll_1 == 0) scrolltop = scroll_2;
        
        //var scrolltop = isDesktop ? $('html, body').scrollTop() : $('body').scrollTop();
        
        if(scrolltop >= 200) $('a#toTop').css({bottom: '30px'});
        else $('a#toTop').css({bottom: '-40px'});
        if(scrolltop > 0) $('.navbar-fixed-top').addClass('fixed');
        else $('.navbar-fixed-top').removeClass('fixed');
    });
    $(window).trigger('scroll');

    /* =================================================================
     * COOKIES
     * =================================================================
     */
    if($('#cookies-notice').length){
        $('#cookies-notice button').on('click', function(){
            $.cookie('cookies_enabled', '1', {expires: 7});
            $('#cookies-notice').fadeOut();
        });
     }
    /* =================================================================
     * WEATHER
     * =================================================================
     */

    /* =================================================================
     * PRICE RANGE SLIDER
     * =================================================================
     */
    if($('.nouislider').length){
		$('.nouislider').each(function(){
			var slider = $(this);
			noUiSlider.create(slider.get(0), {
				start: slider.data('start'),
				connect: true,
				tooltips: false,
				step: slider.data('step'),
				range: {
					'min': slider.data('min'),
					'max': slider.data('max')
				},
				format: wNumb({
					decimals: 0,
					thousand: ''/*,
					prefix: slider.data('prefix'),*/
				})
			});
			slider.get(0).noUiSlider.on('update', function(values, handle){
				$('#'+slider.data('input')).val(values[0]+' - '+values[1]);
			});
		});
    }
    /* =================================================================
     * LIVE SEARCH
     * =================================================================
     */
   
    /* =================================================================
     * FACEBOOK LOGIN
     * =================================================================
     */
    /*function fblogout(){    
        FB.logout(function(){   
            window.location.reload();
        });    
    }
    window.fbAsyncInit = function(){
        FB.init({
            appId   : '194398910928420',    
            secret  : '646766d08dea2c372ce097269e363012',
            status  : true,    
            cookie  : true,    
            xfbml   : true    
        });    

        FB.Event.subscribe('auth.login', function() {    
            window.location.reload();    
        });    
    };  
    $(function(){
        var e = document.createElement('script');  
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';    
        e.async = true;    
        document.getElementById('fb-root').appendChild(e);
    });
    function fblogin(){    
        FB.login(function(response){    
            
            $.ajax({
                url: document.location.protocol + '//www.aaa.com/includes/php/fb_connect.php',
                type: 'POST',
                success: function(response){
                    if(response == 'ok'){
                        if(redirect_url != '') document.location.href = redirect_url; else document.location.reload();
                    }
                }
            });
            return false;
            
        }, {scope:'email,read_stream,publish_stream,offline_access'});    
    }
    $('a.fblogin').click(function(e){
        e.defaultPrevented;
        fblogin();
    });*/
    

    /*==================================================================
     * GOOGLE MAPS
     * =================================================================
     */
	if($('#mapWrapper').length){
		var gscript = document.createElement('script');
		gscript.type = 'text/javascript';
		gscript.src = '//maps.google.com/maps/api/js?callback=gmaps_callback';
		if($('meta[name="gmaps_api_key"]').length) gscript.src += '&key='+$('meta[name="gmaps_api_key"]').attr('content');
		document.body.appendChild(gscript);
	}
    /*==================================================================
     * ACTIV'MAP
     * =================================================================
     */
    if($('#activmap-wrapper').length){
        var script = document.createElement('script');
		script.type = 'text/javascript';
		script.src = '//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&sensor=false&callback=activmap_init';
		if($('meta[name="gmaps_api_key"]').length) script.src += '&key='+$('meta[name="gmaps_api_key"]').attr('content');
		document.body.appendChild(script);
    }
});

function activmap_init(){
	var elm = $('#activmap-wrapper');
	elm.activmap({
		places: locations,
		icon: elm.data('icon'),
		icon_center: elm.data('icon_center'),
		lat: elm.data('lat'),        //latitude of the center
		lng: elm.data('lng'),        //longitude of the center
		radius: 0,
		cluster: true,
		country: null,
		posPanel: 'right',
		mapType: 'roadmap',
		request: 'large',
		allowMultiSelect: true,
		zoom: elm.data('zoom'),
		show_center: true,
		locationTypes: ['geocode','establishment']
	});
}

function gmaps_callback(){
    
    /* =================================================================
     * GEOLOCATION
     * =================================================================
     */
    if($('meta[name="autogeolocate"]').length){
        //Geolocation error handler
        function handleNoGeolocation(errorFlag){
            if(errorFlag == true)
                console.log('Geolocation service failed.');
            else
                console.log('Your browser doesn\'t support geolocation.');
        }
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                
                var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'latLng': latlng }, function (results, status){
                    if(status == google.maps.GeocoderStatus.OK){
                    
                        if(results[1]){
                            for(var i = 0; i < results[0].address_components.length; i++){
                                for(var j = 0; j < results[0].address_components[i].types.length; j++){
                                    if(results[0].address_components[i].types[j] == 'country'){
                                        var countryCode = results[0].address_components[i].short_name;
                                        
                                        $.getJSON('https://restcountries.eu/rest/v2/alpha/'+countryCode)
                                        .done(function(data){
                                            if(data.currencies[0]){
                                                var code = data.currencies[0].code;
                                                //if($('.currency-'+code).length) $('.currency-'+code).trigger('click');
                                            }
                                        });
                                        
                                        break;
                                    }
                                }
                            }
                        }
                     } 
                });
            }, function(){
                handleNoGeolocation(true);
            });
        }else
            handleNoGeolocation(false);
    }
    /* =================================================================
     * GMAPS INIT
     * =================================================================
     */
    var gmaps_id = 'mapWrapper';
    if($('#'+gmaps_id).length){
        var overlayTitle = 'Agencies';
        /*var locations = [
            ['Big Ben', 'London SW1A 0AA','51.500729','-0.124625']
        ];*/
        
        var image = $('#'+gmaps_id).attr('data-marker');
        var map = new google.maps.Map(document.getElementById(gmaps_id),{
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            zoomControl: true,
            zoomControlOptions:{
                style: google.maps.ZoomControlStyle.LARGE,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl:true,
            scaleControl:false,
            zoom: 12,
            styles:[
                {
                    'featureType': 'water',
                    'stylers': [
                    {
                        'color': '#AAC6ED'
                    },
                    ]
                },
                {
                    'featureType': 'road',
                    'elementType': 'geometry.fill',
                    'stylers': [
                    {
                        'color': '#FCFFF5'
                    },
                    ]
                },
                {
                    'featureType': 'road',
                    'elementType': 'geometry.stroke',
                    'stylers': [
                    {
                        'color': '#808080'
                    },
                    {
                        'lightness': 54
                    }
                    ]
                },
                {
                    'featureType': 'landscape.man_made',
                    'elementType': 'geometry.fill',
                    'stylers': [
                    {
                        'color': '#D5D8E0'
                    }
                    ]
                },
                {
                    'featureType': 'poi.park',
                    'elementType': 'geometry.fill',
                    'stylers': [
                    {
                        'color': '#CBDFAB'
                    }
                    ]
                },
                {
                    'featureType': 'road',
                    'elementType': 'labels.text.fill',
                    'stylers': [
                    {
                        'color': '#767676'
                    }
                    ]
                },
                {
                    'featureType': 'road',
                    'elementType': 'labels.text.stroke',
                    'stylers': [
                    {
                        'color': '#ffffff'
                    }
                    ]
                },
                {
                    'featureType': 'road.highway',
                    'elementType': 'geometry.fill',
                    'stylers': [
                    {
                        'color': '#888888'
                    }
                    ]
                },
                {
                    'featureType': 'landscape.natural',
                    'elementType': 'geometry.fill',
                    'stylers': [
                    {
                        'visibility': 'on'
                    },
                    {
                        'color': '#efefef'
                    }
                    ]
                },
                {
                    'featureType': 'poi.park',
                    'stylers': [
                    {
                        'visibility': 'on'
                    }
                    ]
                },
                {
                    'featureType': 'poi.sports_complex',
                    'stylers': [
                    {
                        'visibility': 'on'
                    }
                    ]
                },
                {
                    'featureType': 'poi.medical',
                    'stylers': [
                    {
                        'visibility': 'on'
                    }
                    ]
                },
                {
                    'featureType': 'poi.business',
                    'stylers': [
                    {
                        'visibility': 'simplified'
                    }
                    ]
                }
            ]
        });
        var myLatlng;
        var marker, i;
        var bounds = new google.maps.LatLngBounds();
        var infowindow = new google.maps.InfoWindow({ content: 'loading...' });
        for(i = 0; i < locations.length; i++){ 
            if(locations[i][2] !== undefined && locations[i][3] !== undefined){
                var content = '<div class="infoWindow">'+locations[i][0]+'<br>'+locations[i][1]+'</div>';
                (function(content){
                    myLatlng = new google.maps.LatLng(locations[i][2], locations[i][3]);
                    marker = new google.maps.Marker({
                        position: myLatlng,
                        icon:image,	
                        title: overlayTitle,
                        map: map
                    });
                    google.maps.event.addListener(marker, 'click',(function(){
                        return function(){
                            infowindow.setContent(content);
                            infowindow.open(map, this);
                        };
                    })(this, i));
                    if(locations.length > 1){
                        bounds.extend(myLatlng);
                        map.fitBounds(bounds);
                    }else{
                        map.setCenter(myLatlng);
                    }
                })(content);
            }else{
                var geocoder	= new google.maps.Geocoder();
                var info	= locations[i][0];
                var addr	= locations[i][1];
                var latLng = locations[i][1];
                (function(info, addr){
                    geocoder.geocode({
                        'address': latLng
                    }, function(results){
                        myLatlng = results[0].geometry.location;
                        marker = new google.maps.Marker({
                            position: myLatlng,
                            icon:image,	
                            title: overlayTitle,
                            map: map
                        });
                        var $content = '<div class="infoWindow">'+info+'<br>'+addr+'</div>';
                        google.maps.event.addListener(marker, 'click',(function(){
                            return function(){
                                infowindow.setContent($content);
                                infowindow.open(map, this);
                            };
                        })(this, i));
                        if(locations.length > 1){
                            bounds.extend(myLatlng);
                            map.fitBounds(bounds);
                        }else{
                            map.setCenter(myLatlng);
                        }
                    });
                })(info, addr);
            }
        }
    }
}
/* =====================================================================
 * MAIN MENU
 * =====================================================================
 */
function initializeMainMenu(){
	'use strict';
	var $mainMenu = $('#mainMenu').children('ul');
	if(Modernizr.mq('only all and(max-width: 991px)')){
		// Responsive Menu Events
		var addActiveClass = false;
		$('a.hasSubMenu').unbind('click');
		$('li',$mainMenu).unbind('mouseenter mouseleave');
		$('a.hasSubMenu').on('click', function(e){
			e.defaultPrevented;
			addActiveClass = $(this).parent('li').hasClass('Nactive');
			if($(this).parent('li').hasClass('primary'))
				$('li', $mainMenu).removeClass('Nactive');
			else
				$('li:not(.primary)', $mainMenu).removeClass('Nactive');
			
			if(!addActiveClass)
				$(this).parents('li').addClass('Nactive');
			else
				$(this).parent().parent('li').addClass('Nactive');
			
			return;
			
		});
	}else if(Modernizr.mq('only all and(max-width: 1024px)') && Modernizr.touch){	
		$('a.hasSubMenu').attr('href', '');
		$('a.hasSubMenu').on('touchend',function(e){
			e.defaultPrevented;
			var $li = $(this).parent(),
			$subMenu = $li.children('.subMenu');
			if($(this).data('clicked_once')){
				if($li.parent().is($(':gt(1)', $mainMenu))){
					if($subMenu.css('display') == 'block'){
						$li.removeClass('hover');
						$subMenu.css('display', 'none');
					}else{
						$('.subMenu').css('display', 'none');
						$subMenu.css('display', 'block'); 
					}
				}else
					$('.subMenu').css('display', 'none');
				$(this).data('clicked_once', false);	
			}else{
				$li.parent().find('li').removeClass('hover');	
				$li.addClass('hover');
				if($li.parent().is($(':gt(1)', $mainMenu))){
					$li.parent().find('.subMenu').css('display', 'none');
					$subMenu.css('left', $subMenu.parent().outerWidth(true));
					$subMenu.css('display', 'block');
				}else{
					$('.subMenu').css('display', 'none');
					$subMenu.css('display', 'block');
				}
				$('a.hasSubMenu').data('clicked_once', false);
				$(this).data('clicked_once', true);
				
			}
			return false;
		});
		window.addEventListener('orientationchange', function(){
			$('a.hasSubMenu').parent().removeClass('hover');
			$('.subMenu').css('display', 'none');
			$('a.hasSubMenu').data('clicked_once', false);
		}, true);
	}else{
		$('li', $mainMenu).removeClass('Nactive');
		$('a', $mainMenu).unbind('click');
		$('li',$mainMenu).hover(
			function(){
				var $this = $(this),
				$subMenu = $this.children('.subMenu');
				if($subMenu.length ){
					$this.addClass('hover').stop();
				}else{
					if($this.parent().is($(':gt(1)', $mainMenu))){
						$this.stop(false, true).fadeIn('slow');
					}
				}
				if($this.parent().is($(':gt(1)', $mainMenu))){
					$subMenu.stop(true, true).fadeIn(200,'easeInOutQuad'); 
					$subMenu.css('left', $subMenu.parent().outerWidth(true));
				}else
					$subMenu.stop(true, true).delay(300).fadeIn(200,'easeInOutQuad');
                    
			},
            function(){
				var $nthis = $(this),
				$subMenu = $nthis.children('ul');
				if($nthis.parent().is($(':gt(1)', $mainMenu))){
					$nthis.children('ul').hide();
					$nthis.children('ul').css('left', 0);
				}else{
					$nthis.removeClass('hover');
					$('.subMenu').stop(true, true).delay(300).fadeOut();
				}
				if($subMenu.length ){$nthis.removeClass('hover');}
            }
        );
	}
}
