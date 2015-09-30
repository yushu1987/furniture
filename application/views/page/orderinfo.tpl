{%extends file="page/base.tpl" %}
{%block name="title"%}订单详情{%/block%}
{%block name="content"%}
<div id="content" class="container" >
  <div>
  	 <div class="form-group">
	    <label class="col-sm-2 control-label" for="uname">客户姓名</label>
	    <div class="col-sm-4">
			<span id='uname' name='uname' class="form-control">{%$data.uname%}</span>
	    </div>
	    <label class="col-sm-2 control-label" for="phone">手机</label>
	    <div class="col-sm-4">
			<span id='phone' name='phone' class="form-control">{%$data.phone%}</span>
	    </div>
		<label class="col-sm-2 control-label" for="address">地址</label>
	    <div class="col-sm-4">
			<span id='address' name='address' class="form-control">{%$data.address%}</span>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label" for="amount">总额</label>
	    <div class="col-sm-4">
			<span id='amount' name='amount' class="form-control">{%$data.amount%}</span>
	    </div>
	    <label class="col-sm-2 control-label" for="pids">产品</label>
	    <div class="col-sm-4">
			<span id='pids' name='pids' class="form-control">
			{%foreach from=$data.pinfo key=subk item=subv%}
				<a href="/product/pcinfo?pid={%$subv.id%}" target='_blank'>{%$subv.name%}&nbsp;</a>
            {%/foreach%}
			</span>
	    </div>
		<label class="col-sm-2 control-label" for="operator">接单人</label>
	    <div class="col-sm-4">
			<span id='operator' name='operator' class="form-control">{%$data.operator%}</span>
	    </div>
	  </div>
	   <div class="form-group">
	    <label class="col-sm-2 control-label" for="amount">订单状态</label>
	    <div class="col-sm-4">
			{%assign var='color' value=array('#CD0000','#6B6B6B','#7D26CD','#CD853F','#32CD32')%}
            <span style="font-size:12px;backgroud-color:{%$color[$data.status]%}" id='status' class="label-info">{%$data.status%}</span>
	    </div>
	    <label class="col-sm-2 control-label" for="time">订单时间</label>
	    <div class="col-sm-4">
			<span id='time' name='time' class="form-control">{%$data.crreateTime|date_format:"Y-m-d H:i:s"%}</span>
	    </div>
	  </div>
  </div>
  <div>
	<table class=" table table-bordered table-hover" id="product_list" style="">
		<thead>
			<tr>
				<th>id</th>
				<th>产品</th>
				<th>类型</th>
				<th>系列</th>
				<th>价格</th>
				<th>销量</th>
				<th>颜色</th>
				<th>图片</th>
				<th>上架时间</th>
			</tr>
		</thead>
		<tbody>
			{%foreach from=$data.pinfo key=k item=v%}
			<tr id="tr{%$k+ 1 %}">
				<td>{%$k +1%}</td>
				{%if $v.hot==1%}
					<td title='热销'><a href="/product/pcinfo?pid={%$v.id%}">{%$v.name%}</a><span style="color:red">[热]</span></i></td>
				{%else%}
					<td><a href="/product/pcinfo?pid={%$v.id%}">{%$v.name%}</a></td>
				{%/if%}
				<td>{%$v.type%}</td>
				<td>{%$v.series%}</td>
				<td>{%$v.price%}</td>
				<td>{%$v.sold%}</td>
				<td>{%$v.color%}</td>
				<td>{%$v.picture%}</td>
				<td>{%$v.createTime|date_format:'%m-%d %H:%M'%}</td>
			</tr>
			{%/foreach%}
		</tbody>
	</table>
  </div>
</div>
</div>
</div>
{%/block%}
