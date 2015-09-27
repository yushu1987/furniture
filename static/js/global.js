$(function(){
    pathname = window.location.pathname;
	parr 	= pathname.split("/");
	if(parr.length <= 3){
		nav = parr.pop();
		$("#sw-nav-" + nav).addClass("active");
	}else{
		menu 	= parr.pop();
		nav 	= parr.pop();
		$("#sw-menu-" + menu).addClass("active");
		$("#sw-nav-" + nav).addClass("active");
	}

    $(document).delegate('.sw-show-catch', 'click', function() {
        $(this).parent().find(".sw-spamdata-catch").toggle(300);
    });

    //$(".sw-show-catch").each(function(){
    //    $(this).delegate("click" , function(){
    //        $(this).parent().find(".sw-spamdata-catch").toggle(300);
    //    });
    //})
})
var _GET = (function(){
     var url = window.document.location.href.toString();
	 url	 = url.replace(/#.*/ , "");//remove anchor
     var u = url.split("?");
     if(typeof(u[1]) == "string"){
          u = u[1].split("&");
          var get = {};
          for(var i in u){
               var j = u[i].split("=");
               get[j[0]] = j[1];
          }
          return get;
     } else {
          return {};
     }
})();
function append_url(obj){
	var url		= document.location.href;
	url     = url.replace(/#.*/ , "");//remove anchor
	var prefix  = "" , value = "";
	for( var key in obj){
		value  = obj[key];
		prefix = url.indexOf("?") > 0 ? "&" : "?";
		if(!_GET[key]){
			url	   = url + prefix + key + "=" + value;
		} else {
			//var reg = eval( "/"+key+"=\\w+/");
			var reg = eval( "/"+key+"=[^=&]+/");
			url	   = url.replace( reg , key + "=" + value); 
		}
	}
	return url;
}
function formatDate(date , no_time){
    var month 	= date.getMonth() + 1 , day = date.getDate() , hour =  date.getHours();
    month 		= month >= 10 ? month : ( "0" + month );
    day 		= day 	>= 10 ? day : ( "0" + day );
    hour 		= hour 	>= 10 ? hour : ( "0" + hour );
    var res 	= date.getFullYear() +  "-" + month + "-" + day 
	if(!no_time){
		res += " " + hour + ":00";
	}
    return res;
}

function make_alert_box(msg , type){
	var icon = (type == "success") ? 'glyphicon-ok' : 'glyphicon-remove';
	var cls  = (type == "success") ? 'sw-alert-success' : 'sw-alert-fail'; 

    var box = $("<div></div>");
    var icon  = $("<span class='glyphicon " + icon +  "'></span>");
    box.append(icon);

    box.append($("<span class='sw-alert-msg'>" + msg + "</span>"));
    var close = $("<button type='button' class='close' data-dismiss='alert' >×</button>");
    box.append(close);
	
	var stop = 100 + document.body.scrollTop;
	box.attr("style" , "top:" + stop + "px");
	
    box.addClass("sw-alert");
    box.addClass(cls);
	$("body").append(box);
}
function show_alert_success(msg , callback){
  	make_alert_box(msg , "success");
  	setTimeout(function(){
  		$(".sw-alert").remove();
      if(callback){
        eval( callback + "()" );
      }
  	},1000)
}
function show_alert_fail(msg , callback){
  make_alert_box(msg , "fail");
    setTimeout(function(){
        $(".sw-alert").remove();
        if(callback){
          eval( callback + "()" );    
        }
    },1500)
}
function n_show_alert_success(msg , callback){
    make_alert_box(msg , "success");
    setTimeout(function(){
        $(".sw-alert").remove();
        if(callback){
          eval( callback );
        }
    },1000)
}
