/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Varien
 * @package     js
 * @copyright   Copyright (c) 2006-2016 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

/**
 * @classDescription simple Navigation with replacing old handlers
 * @param {String} id id of ul element with navigation lists
 * @param {Object} settings object with settings
 */
var mainNav = function() {

    var main = {
        obj_nav :   $(arguments[0]) || $("nav"),

        settings :  {
            show_delay      :   0,
            hide_delay      :   0,
            _ie6            :   /MSIE 6.+Win/.test(navigator.userAgent),
            _ie7            :   /MSIE 7.+Win/.test(navigator.userAgent)
        },

        init :  function(obj, level) {
            obj.lists = obj.childElements();
            obj.lists.each(function(el,ind){
                main.handlNavElement(el);
                if((main.settings._ie6 || main.settings._ie7) && level){
                    main.ieFixZIndex(el, ind, obj.lists.size());
                }
            });
            if(main.settings._ie6 && !level){
                document.execCommand("BackgroundImageCache", false, true);
            }
        },

        handlNavElement :   function(list) {
            if(list !== undefined){
                list.onmouseover = function(){
                    main.fireNavEvent(this,true);
                };
                list.onmouseout = function(){
                    main.fireNavEvent(this,false);
                };
                if(list.down("ul")){
                    main.init(list.down("ul"), true);
                }
            }
        },

        ieFixZIndex : function(el, i, l) {
            if(el.tagName.toString().toLowerCase().indexOf("iframe") == -1){
                el.style.zIndex = l - i;
            } else {
                el.onmouseover = "null";
                el.onmouseout = "null";
            }
        },

        fireNavEvent :  function(elm,ev) {
            if(ev){
                elm.addClassName("over");
                elm.down("a").addClassName("over");
                if (elm.childElements()[1]) {
                    main.show(elm.childElements()[1]);
                }
            } else {
                elm.removeClassName("over");
                elm.down("a").removeClassName("over");
                if (elm.childElements()[1]) {
                    main.hide(elm.childElements()[1]);
                }
            }
        },

        show : function (sub_elm) {
            if (sub_elm.hide_time_id) {
                clearTimeout(sub_elm.hide_time_id);
            }
            sub_elm.show_time_id = setTimeout(function() {
                if (!sub_elm.hasClassName("shown-sub")) {
                    sub_elm.addClassName("shown-sub");
                }
            }, main.settings.show_delay);
        },

        hide : function (sub_elm) {
            if (sub_elm.show_time_id) {
                clearTimeout(sub_elm.show_time_id);
            }
            sub_elm.hide_time_id = setTimeout(function(){
                if (sub_elm.hasClassName("shown-sub")) {
                    sub_elm.removeClassName("shown-sub");
                }
            }, main.settings.hide_delay);
        }

    };
    if (arguments[1]) {
        main.settings = Object.extend(main.settings, arguments[1]);
    }
    if (main.obj_nav) {
        main.init(main.obj_nav, false);
    }
};

document.observe("dom:loaded", function() {
    //run navigation without delays and with default id="#nav"
    //mainNav();

    //run navigation with delays
    mainNav("nav", {"show_delay":"100","hide_delay":"100"});
});
// Ponemos el menú
jQuery(window).load(function() {
    var body   = document.body || document.getElementsByTagName('body')[0],
    newpar = document.createElement('div');
	newpar.innerHTML = '<button type="button" class="menu-burguer navbar-toggle collapsed" onclick="burguer();"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <i class="glyphicon glyphicon-menu-hamburger"></i> </button>';
	body.insertBefore(newpar,body.childNodes[0]);
	
	var ancho = parseInt(jQuery(window).width());
	
	// Checamos si el archivo es diferente al index, para aplicar el estilo al campo de search
		var pagePathName = window.location.pathname;
		var archivo = pagePathName.substring(pagePathName.lastIndexOf("/") + 1);
		if(archivo != "index.php" && archivo != ""){
			// Escondemos buscador
			if(ancho < 768){
				jQuery('form#search_mini_form').attr('style','display:none');
				jQuery('div.form-search').attr('style','');
				jQuery('ul.nav.navbar-nav').attr('style','');
				jQuery('.logo-top > img').attr('style','position:absolute;top:0;left:36%;');
			}else{
				jQuery('form#search_mini_form').attr('style','');
				jQuery('div.form-search').attr('style','top: -100px;left: 79%;position: relative;z-index: 2;');
				jQuery('ul.nav.navbar-nav').attr('style','padding-right: 120px;');
			}
		}else{
			// Por default
				jQuery('div.presales-section-izq').addClass('hidden-xs');
				jQuery('div.presales-section-izq').addClass('hidden-sm');
				// Escondemos buscador
				if(ancho < 768){
					jQuery('form#search_mini_form').attr('style','display:none');
					jQuery('div.form-search').attr('style','');
					jQuery('div.col-md-4.polo-text.PreciousSansLightItalic').attr('style','margin-bottom: 50px;');
					jQuery('div.col-md-4.polo-text.PreciousSansMedium').attr('style','margin-bottom: 50px;');
				}else{
					jQuery('form#search_mini_form').attr('style','');
					jQuery('div.form-search').attr('style','top:44px;left:79%');
					jQuery('div.col-md-4.polo-text.PreciousSansLightItalic').attr('style','');
					jQuery('div.col-md-4.polo-text.PreciousSansMedium').attr('style','');
				}
				
				jQuery('div.row.PreciousSansMedium.fondo-blanco').html('');
				html = '<div class="col-md-3"> <div id="myCarousel1" data-ride="carousel" class="carousel slide"> <div class="carousel-inner">';
				
				jQuery.ajax({
					url: "leer_imagenes.php",
					type: 'POST',
					data: {numero: 1},
					dataType: "json",
					success: function (data){
						jQuery.each(data, function(i,filename) {
							if(i == 1){
								html = html + '<div class="col-md-3 heredar-tamano item active"><span> <img alt="" src="carrusel/1/'+filename+'"> </span></div>';
							}else{
								html = html + '<div class="col-md-3 heredar-tamano item"><span> <img alt="" src="carrusel/1/'+filename+'"> </span></div>';
							}
							
						});
						html = html + '<a class="left carousel-control" href="#myCarousel1" data-slide="prev"><</a> <a class="right carousel-control" href="#myCarousel1" data-slide="next">></a></div></div></div>';console.log(html);
						jQuery('div.row.PreciousSansMedium.fondo-blanco').append(html);
					}
				});
			html2 = '<div class="col-md-3"> <div id="myCarousel2" data-ride="carousel" class="carousel slide"> <div class="carousel-inner">';
				
				jQuery.ajax({
					url: "leer_imagenes.php",
					type: 'POST',
					data: {numero: 2},
					dataType: "json",
					success: function (data){
						jQuery.each(data, function(i,filename) {
							if(i == 1){
								html2 = html2 + '<div class="col-md-3 heredar-tamano item active"><span> <img alt="" src="carrusel/2/'+filename+'"> </span></div>';
							}else{
								html2 = html2 + '<div class="col-md-3 heredar-tamano item"><span> <img alt="" src="carrusel/2/'+filename+'"> </span></div>';
							}
							
						});
						html2 = html2 + '<a class="left carousel-control" href="#myCarousel2" data-slide="prev"><</a> <a class="right carousel-control" href="#myCarousel2" data-slide="next">></a></div></div></div>';console.log(html2);
						jQuery('div.row.PreciousSansMedium.fondo-blanco').append(html2);
					}
				});
			texto = '<div class="col-md-3 polo-text PreciousSansMedium text-center about-text"><span> <img style="width: 50px;" alt="" src="http://kreativeco.com/cfm/media/wysiwyg/about-us/blue.png"> </span> <h2><span class="PreciousSansMedium" style="color: #1e2c47;">ALL ABOUT US</span></h2> <br><span> <a class="PreciousSansMedium" href="http://kreativeco.com/cfm/our-story.html"> <span> HELLO</span> </a> </span></div>';
			html3 = texto + '<div class="col-md-3"> <div id="myCarousel3" data-ride="carousel" class="carousel slide"> <div class="carousel-inner">';
				
				jQuery.ajax({
					url: "leer_imagenes.php",
					type: 'POST',
					data: {numero: 3},
					dataType: "json",
					success: function (data){
						jQuery.each(data, function(i,filename) {
							if(i == 1){
								html3 = html3 + '<div class="col-md-3 heredar-tamano item active"><span> <img alt="" src="carrusel/3/'+filename+'"> </span></div>';
							}else{
								html3 = html3 + '<div class="col-md-3 heredar-tamano item"><span> <img alt="" src="carrusel/3/'+filename+'"> </span></div>';
							}
							
						});
						html3 = html3 + '<a class="left carousel-control" href="#myCarousel3" data-slide="prev"><</a> <a class="right carousel-control" href="#myCarousel3" data-slide="next">></a></div></div></div>';console.log(html3);
						jQuery('div.row.PreciousSansMedium.fondo-blanco').append(html3);
					}
				});	
				jQuery('#Carousel1').carousel({
					interval: 2000
				});
				jQuery('#Carousel2').carousel({
					interval: 2000
				});
				jQuery('#Carousel3').carousel({
					interval: 2000
				});
		}
});
function burguer(){
	jQuery("div#bs-example-navbar-collapse-1").toggle();
	if(jQuery("div#bs-example-navbar-collapse-1").is(":visible")){
		jQuery('ul.navbar-nav').attr('style','position: fixed;background: rgba(202,200,179,0.8);box-shadow: 0px 2px 5px 2px #b9b9b9;');
	}else{
		jQuery('ul.navbar-nav').attr('style','style','top:-10px;right:74%');
	}
}
// Esconder buscador si es pantalla media o chica
jQuery(window).resize(function() {
	var ancho = parseInt(jQuery(window).width());
	var pagePathName = window.location.pathname;
	var archivo = pagePathName.substring(pagePathName.lastIndexOf("/") + 1);
		if(archivo != "index.php" && archivo != ""){
			// Escondemos buscador
			if(ancho < 768){
				jQuery('form#search_mini_form').attr('style','display:none');
				jQuery('div.form-search').attr('style','');
				jQuery('ul.nav.navbar-nav').attr('style','');
				jQuery('a.logo > img').attr('style','position:absolute;top:0;left:36%;');
			}else{
				jQuery('form#search_mini_form').attr('style','');
				jQuery('div.form-search').attr('style','top: -100px;left: 79%;position: relative;z-index: 2;');
				jQuery('ul.nav.navbar-nav').attr('style','padding-right: 120px;');
			}
		}else{
			// Por default
			jQuery('div.presales-section-izq').addClass('hidden-xs');
			jQuery('div.presales-section-izq').addClass('hidden-sm');
			// Escondemos buscador
			if(ancho < 768){
				jQuery('form#search_mini_form').attr('style','display:none');
				jQuery('div.form-search').attr('style','');
				jQuery('div.col-md-4.polo-text.PreciousSansLightItalic').attr('style','margin-bottom: 50px;');
				jQuery('div.col-md-4.polo-text.PreciousSansMedium').attr('style','margin-bottom: 50px;');
			}else{
				jQuery('form#search_mini_form').attr('style','');
				jQuery('div.form-search').attr('style','top:44px;left:79%');
				jQuery('div.col-md-4.polo-text.PreciousSansLightItalic').attr('style','');
				jQuery('div.col-md-4.polo-text.PreciousSansMedium').attr('style','');
			}
		}
});