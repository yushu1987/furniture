(function(){
	localStorage.clear();
	localStorage.setItem('more', 1);
	$(document).delegate('.sw-btn-show-ra', 'click', function() {
		var rid = this.id.replace("btn-ra-" , "");
		$("#ranswer-" + rid).toggle(300);
	});
	$(".sw-uname a").each(function(){
		$(this).attr("href" , "javascript:void(0)");
	});
})();
$(window).scroll(function(){
　　var scrollTop = $(this).scrollTop();
　　var scrollHeight = $(document).height();
　　var windowHeight = $(this).height();
　　if(scrollTop + windowHeight >= scrollHeight-100) {
		var url = window.location.href;
		var uri = window.location.search;
		var data_from = "PC";
		var qid_match_arr = uri.match(/qid=(\w+)/);

		
		if(parseInt(localStorage.getItem('more')) != 1) {
			return;
		}
		if(qid_match_arr && qid_match_arr >= 2){
	       var qid = pn_match_arr[1];
	    }
		var pc_flag =0;
		if(url.indexOf('/pc/') > 0) {
			pc_flag = 1;
		}else if(url.indexOf('/napi/article') >0) {
			data_from = "AHK";
		}else if(url.indexOf('/napi/question') >0) {
			data_from = "HK";
		}else if(url.indexOf('/mapi/question') >0) {
			data_from = "NA";
		}else if(url.indexOf('/baby/question') >0) {
			data_from = "BABY";
		}else if(url.indexOf('/baby/article') >0) {
			data_from = "MUM";
		}
		var pn =localStorage.getItem("pn")==null?0:localStorage.getItem("pn");
		var rn = pc_flag > 0 ? 25 :10;
		pn= parseInt(pn) + rn;
		localStorage.setItem("pn",pn);
		$.get(
			url,
			{
				'qid' : qid,
				'rn'  : rn,
				'pn'  : pn,
				'api' : 1
			},
			function(data) {
				qinfo  = JSON.parse(data);
				if (qinfo.normal_replys.length > 0) {
					$.each(qinfo.normal_replys,function(key ,val) {
						if(pc_flag) {	
							objtime = new  Date(parseInt(val.create_time) * 1000);
							time = objtime.getFullYear() + '-' +(objtime.getMonth()+1) + '-' +objtime.getDate()+" "+ objtime.getHours()+ ":" + objtime.getMinutes()+":"+objtime.getSeconds();
						}else {
							time = val.createTime;
						}
						child = '<div class="reply">' +
								'<div class="reply-body">' +
								'<div class="reply-head">' +
								'<span class="sw-uname">' + 
								'<a onclick=parent.show_user_alist("@'+parseInt(val.uid)+'","'+data_from+'"); href="javascript:void()">'+val.uname +'</a>('+ val.uid +')|</span>';
								if(val.from) {
									child +='<span class="source"> 来源: ['+val.from.psource+']['+val.from.source+']</span>';
								}
								if(val.source) {
									child +='<span class="source"> 来源: '+val.source+'</span>';
								}
								child +=
								'<span class="crtime">'+time+'</span>' +
								'<span class="sw-uip">'+val.uip +'</span>' + 
								'<div class="clear"> </div></div>' +
								'<div class="content">' +
								'<div>(Rid:' +val.rid+')' + val.content+ '</div>';
						if(val.ranswer&& val.ranswer.length >0 ) {
							child += '<button class="btn btn-primary btn-xs sw-btn-show-ra" id="btn-ra-'+val.rid+'">追问追答</button>'+
									  '<div class="sw-ranswer" id="ranswer-'+val.rid+ '">';
							$.each(val.ranswer, function(k, v){
								child += '<div>' ;
								if(v.uid == val.uid) {
									child += '<span class="zwtag f-12">追答</span>';
								}else {
									child += '<span class="zdtag f-12">追问</span>';
								}
								child += '<span class="zwzdcontent f-15">';
								if(v.bit_pack && v.bit_pack.content_rich_flag ==1) {
									child += v.contentRich;
								}else {
									child += v.content;
								}
								child += '</span>';
								if(pc_flag) {
									objtime = new  Date(parseInt(v.create_time) * 1000);
			                        rtime = objtime.getFullYear() + '-' +(objtime.getMonth()+1) + '-' +objtime.getDate()+" "+ objtime.getHours()+":" + objtime.getMinutes()+":"+objtime.getSeconds();
								}else {
									rtime =v.createTime;
								}
								child +='<span class="crtime">'+rtime+'</span></div>';
							});
							child +='</div>';
						}

						//作弊数据
						if(val.deleted > 0) {
							child += '<div class="sw-spamdata">';
							if(!val.spamdata.spamtime) {
								child += '<span class="sw-deleted">已删除</span>';
							}
							if(val.spamdata.opname) {
								child += '最后操作人:<span class="sw-deleted">' + val.spamdata.opname +'</span>';
							}
							if(val.spamdata.spamtime) {
								child += '删除时间:<span class="sw-deleted">'+val.spamdata.spamtime +'</span>';
							}
							if(val.spamdata.spaminfo) {
								child += '<button class="btn btn-default btn-xs btn-primary sw-show-catch">命中策略</button>'+
										'<div class="sw-spamdata-catch">'+
										'<table class="table table-bordered">';
								spaminfo = JSON.parse(val.spamdata.spaminfo);
								$.each(spaminfo, function(k, v){
									child +='<tr><td>'+ k +'</td><td>';
									$.each(v, function(k1, v1){	
										child += v1;
									});
									child += '</td></tr>';
								});
								child += '</table></div></div>';
							}
						}
						child += '</div>';
						child += '<div class="separator"></div>';
						$("#rinfo").append(child);
					});
				}else {
					localStorage.setItem('more', 0);			
				}
			}
		)
	}
});

