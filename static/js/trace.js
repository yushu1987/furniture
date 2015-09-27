var sw_trace_data = {
	FRAME_ID: "sw-question-frame" , //追查结果展示frame的ID
	USER_FRAME_ID : "sw-user-frame" , 

	PC : {
		_qid_url : "/spamwork/pc/question?qid=" ,	
		_en_q_url : "/spamwork/pc/question?encode_qid=" ,

		_u_q_list : "/spamwork/pc/uclist?type=0&user_tmp=",
		_u_a_list : "/spamwork/pc/uclist?type=1&user_tmp=",

		_operate_url : "/spamwork/api/spamer?from=pc",//删除或恢复问题url
	},
	NA : {
		_qidpc_url : "/spamwork/mapi/question?qidpc=" , 
		_qid_url : "/spamwork/mapi/question?qid=" , 
		
		_u_q_list : "/spamwork/mapi/uclist?type=5&user_tmp=",
		_u_a_list : "/spamwork/mapi/uclist?type=6&user_tmp=",
		_operate_url : "/spamwork/api/spamer?from=na",
	},
	HK : {//作业帮
		_qidpc_url:"/spamwork/napi/question?qidpc=" , 
		_qid_en_url:"/spamwork/napi/question?encode_qid=" , 
		_qid_url:"/spamwork/napi/question?qid=",
		
		_u_q_list : "/spamwork/napi/uqlist?type=0&user_tmp=",
		_u_a_list : "/spamwork/napi/uqlist?type=1&user_tmp=",
		_operate_url : "/spamwork/api/spamer?from=wzy",
	},
	AHK : {//学生圈
		_qid_en_url:"/spamwork/napi/article?encode_qid=" , 
		_qid_url:"/spamwork/napi/article?qid=",
		
		_u_q_list : "/spamwork/napi/ualist?type=0&user_tmp=",
		_u_a_list : "/spamwork/napi/ualist?type=1&user_tmp=",

		_operate_url : "/spamwork/api/spamer?from=xsq",  
	},
	BABY :{
		_qidpc_url:"/spamwork/baby/question?qidpc=" , 
		_qid_en_url:"/spamwork/baby/question?encode_qid=" , 
		_qid_url:"/spamwork/baby/question?qid=",
		
		_u_q_list : "/spamwork/baby/uqlist?type=0&user_tmp=",
		_u_a_list : "/spamwork/baby/uqlist?type=1&user_tmp=",

		_operate_url : "/spamwork/api/spamer?from=bbq",
		
	},
    MUM :{//妈妈圈
		_qid_en_url:"/spamwork/baby/article?encode_qid=" , 
		_qid_url:"/spamwork/baby/article?qid=",
		
		_u_q_list : "/spamwork/baby/ualist?type=0&user_tmp=",
		_u_a_list : "/spamwork/baby/ualist?type=1&user_tmp=",

		_operate_url : "/spamwork/api/spamer?from=mmw",
    },
};
/*判断qid是否加密*/
function is_encode( qid ){
	if( qid.toString().replace("@" , "").length > 10){
		return true;
	}
	return false;
}
function sw_pc_trace( val_id ){
    var qid = $("#" + val_id).val();
	if(is_encode(qid)){
		$("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.PC._en_q_url + qid);
	} else {
		$("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.PC._qid_url + qid);	
	}
}
function sw_na_trace( val_id ){
    var qid = $("#" + val_id).val();
	//主APP只区分小库和大库
	if( qid.toString().indexOf("@") >= 0){
		qid = qid.toString().replace("@" , "");
		$("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.NA._qidpc_url + qid);
	} else {
		//小库查询
		$("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.NA._qid_url + qid);
	}
}
//作业帮
function sw_hk_trace( val_id ){
    	var qid = $("#" + val_id).val();
        if(is_encode( qid )){
            //加密qid
        	$("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.HK._qid_en_url + qid);
        } else{
            //非加密
			//大库
    		if( qid.toString().indexOf("@") >= 0){
				qid = qid.toString().replace("@" , "");
        		$("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.HK._qidpc_url + qid);
			} else {
				//小库
        		$("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.HK._qid_url + qid);
			}
        }
}
//学生圈,无小库和大库
function sw_ahk_trace( val_id ){
    var qid = $("#" + val_id).val();
    if(is_encode( qid )){
          //加密qid
          $("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.AHK._qid_en_url + qid);
     } else{
          //非加密
          $("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.AHK._qid_url + qid);
     }
}
//母婴
function sw_baby_trace( val_id ){
        var qid = $("#" + val_id).val();
        if(is_encode( qid )){
            //加密qid
            $("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.BABY._qid_en_url + qid);
        } else{
            //非加密
            //大库
            if( qid.toString().indexOf("@") >= 0){
                qid = qid.toString().replace("@" , "");
                $("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.BABY._qidpc_url + qid);
            } else {
                //小库
                $("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.BABY._qid_url + qid);
            }
        }
}
//妈妈圈
function sw_mum_trace( val_id ){
    var qid = $("#" + val_id).val();
    if(is_encode( qid )){
          //加密qid
          $("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.MUM._qid_en_url + qid);
     } else{
          //非加密
          $("#" + sw_trace_data.FRAME_ID ).attr("src" , sw_trace_data.MUM._qid_url + qid);
     }
}
//source = pc , na , hk ,ahk
//子页面调用，点击title时，左侧展现qid追查结果
function sw_qid_trace( qid , source){
	$("#" + sw_trace_data.FRAME_ID).attr("src" , sw_trace_data[source]._qid_url + qid)
}

/*用户提问列表查询，输入uname或者@uid*/
function show_user_qlist_by_item_id(user_item_id , source){
	var user = $.trim($("#" + user_item_id).val());
	show_user_qlist(user , source);
}
function show_user_qlist(uparam , source){
	var utype = "uname";
	if(uparam.indexOf("@") >= 0){
		utype = "uid";
		uparam = uparam.replace("@" , "");
	}
	var url = sw_trace_data[source]._u_q_list;
	uparam = encodeURIComponent(uparam);
	url = url.replace("user_tmp" , utype) + uparam;
	if( $("#" + sw_trace_data.USER_FRAME_ID).length > 0 ){
		$("#" + sw_trace_data.USER_FRAME_ID).attr("src" , url);
	} else {
		window.location.href = url;
	}
}

/*用户回答列表*/
function show_user_alist(uparam , source){
    var utype = "uname";
    if(uparam.indexOf("@") >= 0){
        utype = "uid";
        uparam = uparam.replace("@" , "");
    }
    var url = sw_trace_data[source]._u_a_list;
	uparam = encodeURIComponent(uparam);//某些用户名带#
    url = url.replace("user_tmp" , utype) + uparam;
	if( $("#" + sw_trace_data.USER_FRAME_ID).length > 0 ){
		$("#" + sw_trace_data.USER_FRAME_ID).attr("src" , url);
	} else {
		window.location.href = url;
	}
}

/*恢复和删除问题*/
function operate_qa(act  , source , qid , rid){
	var url = sw_trace_data[source]._operate_url;
	var act_arr = { "del" : 1 , "rec" : 0, };
	if(!confirm("确定删除/恢复该问题/回答?")) return ;

	if(url){
		var param_act = act_arr[act];
		url = url + "&act=" + param_act + "&qid=" + qid;
		if(rid){
			url = url + "&rid=" + rid;
		}
		$.get(url , function(res){
			console.log(url);
			console.log(res);
			alert("操作成功");
		})
		
	} else {
		alert("config error , check url");
	}
	//"/spamwork/api/spamer?from=xsq", 
	//http://beta.zhidao.baidu.com/spamwork/api/spamer?from=na&act=1&qid=31334&rid=530630
}
/*左侧菜单下拉*/
$(function(){
	$(".sw-trace-menu-head").bind("click" , function(){
		var head = $(this);
		var co	 = head.parent().find(".sw-trace-menu-content");
		co.toggle(300 , function(){
			if (co.css("display") == "block"){
				head.find(".glyphicon").removeClass("glyphicon-chevron-down");
				head.find(".glyphicon").addClass("glyphicon-chevron-up");
			} else {
				head.find(".glyphicon").removeClass("glyphicon-chevron-up");
				head.find(".glyphicon").addClass("glyphicon-chevron-down");
			} 
		});
	});
})


