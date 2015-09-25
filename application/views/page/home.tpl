{extends file="page/base.tpl" }
{block name="title"}家具后台{/block}
{block name="content"}
<div id="content" class="container">
	<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/product/add" >
	  <div class="control-group">
	    <label class="control-label" for="upload">上传图片:</label>
	    <div class="controls">
	      <input type="file" class="input-small" id="upload" name="upload" accept=".jpg,.png,.gif,.jpeg,.bmp" required placeholder="文件路径">
	    </div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="name">名称:</label>
			<div class="controls">
				<input type="text" id="name" name="name" placeholder="茶几" required >
			</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="type">类型:</label>
			<div class="controls">
				<input type="text" id="type" name="type" placeholder="" required >
			</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="standard">规格:</label>
			<div class="controls">
				<input type="text" id="standard" name="standard" placeholder="" required >
			</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="model">型号:</label>
			<div class="controls">
				<input type="text" id="model" name="model" placeholder="1.8*2.0" required >
			</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="price">价格:</label>
			<div class="controls">
				<input type="text" id="price" name="price" placeholder="价格" required >
			</div>
	  </div>
	  <div class="control-group">
        <label class="control-label" for="color">颜色:</label>
	      <div class="controls">
			    <input type="text" id="color" name="color" placeholder="颜色" required >
		  </div>
	  </div>
	  <div class="control-group">
        <label class="control-label" for="material">材质:</label>
	      <div class="controls">
			    <input type="text" id="material" name="material" placeholder="材质" required >
		  </div>
	  </div>
	  <div class="control-group">
        <label class="control-label" for="series">系列:</label>
	      <div class="controls">
			    <input type="text" id="series" name="series" placeholder="系列" required >
		  </div>
	  </div>
	  <div class="control-group">
	    <div class="controls">
	      <button type="submit" class="btn" style="margin-left:20px">上传</button>
	    </div>
	  </div>
	</form>
</div>
{/block}
