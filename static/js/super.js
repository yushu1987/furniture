function loadapp(packages) {
	var product = $("#product").prop('selectedOptions')[0].textContent;
	
	$("#package").empty();
	$.each(packages[product] , function(key, val) {
		$("#package").append('<option value=' + key + '>' + val + '</option>');
	});
}

function checksense(obj) {
	
	var sense_size = $("#selected-table tr").length;
	var version_size = $("input[name='versions[]']:checked").length;
	if(sense_size > 1 && version_size > 1) {
		obj.checked=false;
		alert('too more version');
	}
}

function loadversion() {
	var appId = arguments[0] ;
	var type = arguments[1] ? arguments[1] : 0;
	var product = $("#product").val();
	var os = $("#os").val();
	var app = $("#package").val();
	id = 1000 * product + os * 100 + app * 1;
	id = "" + id;

	$("#version").empty();
	if(type == 0) {
		$.each(appId[id], function(key,val) {
			$("#version").append(
				'<label class="radio-label" onclick = checksense(this)>' +
				'<input type=checkbox id=version' + key +  ' name=versions[]  onclick= checksense(this) ' +
				'value="' + val + '" />' + val +
				'</label>'
			);
		});
	}else {
		$.each(appId[id], function(key,val) {
            $("#version").append(
                '<label class="radio-label" onclick = checksense(this)>' +
	            '<input type=radio id=version' + key +  ' name=version  onclick= checksense(this) ' +
			    'value="' + val + '" />' + val +
		        '</label>'
		     );  
		 });
	}
}

function loadpackage(package) {
	var product = $("#product").prop('selectedOptions')[0].textContent;

	$("#package").empty();
	$.each(package[product], function(key,val) {
		$("#package").append('<option value=' + key+'>' + val + '</option>');
	});
}

function submitCompare() {
	 var version_size = $("input[name='versions[]']:checked").length;
     var sense_size = $("#selected-table tr").length;
	 var attr_size = $("input[name='attrs[]']:checked").length;

	 if(version_size == 0 || sense_size == 0 ||version_size + sense_size == 2 || attr_size == 0) {
		alert("choose param error");
		return false;
	 }else {
		localStorage.setItem("product", $("#product").val());
		localStorage.setItem("package", $("#package").val());
	    localStorage.setItem("os", $("#os").val());
		var versions =[], senses=[], attrs=[];
	    $("input[name='versions[]']:checked").each(function(){
			versions.push($(this).val());
		});
	    localStorage.setItem("versions", JSON.stringify(versions));
		$("#selected-table").find("tr").each(function(){
			senses.push($(this).find('td').eq(0).html());
		});
		localStorage.setItem("senses", JSON.stringify(senses));
		$("input[name='attrs[]']:checked").each(function(){
            attrs.push($(this).val());
        });
	    localStorage.setItem("attrs", JSON.stringify(attrs)); 
	 }
}

function submitInfo() {
	var version_size = $("input[name='version']:checked").length;
	var senses = [], attrs=[];

	if(version_size == 0 ) {
		alert("choose param error");
		return false;		
	}else {
		localStorage.setItem("product" , $("#product").val());
		localStorage.setItem("package", $("#package").val());
		localStorage.setItem("os", $("#os").val());
		var val = $("input[name='version']:checked").val();
		localStorage.setItem("version", val);
		$("#selected-table").find("tr").each(function(){
            senses.push($(this).find('td').eq(0).html());
        });
        localStorage.setItem("senses", JSON.stringify(senses));	
		$("input[name='attrs[]']:checked").each(function(){
            attrs.push($(this).val());
        });
        localStorage.setItem("attrs", JSON.stringify(attrs));
		
	}
}

function showDetail(i) {
	localStorage.setItem("product" , $("#product").val());
	localStorage.setItem("package", $("#package").val());
	localStorage.setItem("os", $("#os").val());
	var val = $("input[name='version']:checked").val();
	localStorage.setItem("version", val);
	localStorage.setItem("sense", $("#senses").val());
	localStorage.setItem("attr", $("#attr").val());
}

/*
function showDetail(detail) {
	if(!detail){
		$("#detailcontent").html("<p>任务结果为空</p>");
	} else {

		var theadFilled = false, head = '<tr><th></th>';

		$.each(detail, function(key, val){
			var info = "<tr><td>" + key +"</td>";
			$.each(val, function(k, v){
				if (!theadFilled) {
					head += '<th>' + k + '</th>';
				}
				info += "<td>" +JSON.stringify(v) + "</td>";
			});
			info +="</tr>";
			if (!theadFilled) {
				theadFilled = true;
				head += '</tr>';
				$('#detailcontent thead').html(head);
			}
			$('#detailcontent tbody').append(info);
		});
	}
	$('#detail').modal('show');
}
*/
