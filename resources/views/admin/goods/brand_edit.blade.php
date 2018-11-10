<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加品牌</title>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/style.css"/>       
        <link rel="stylesheet" href="/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
        <link href="/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
	    <script src="js/jquery-1.9.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/typeahead-bs2.min.js"></script>
         <script src="assets/layer/layer.js" type="text/javascript"></script>
        <script type="text/javascript" src="Widget/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="Widget/swfupload/swfupload.queue.js"></script>
        <script type="text/javascript" src="Widget/swfupload/swfupload.speed.js"></script>
        <script type="text/javascript" src="Widget/swfupload/handlers.js"></script>

    <style>
        .clearfix{
            margin-left:180px;
        }
    </style>
</head>

<body>
<div class="clearfix">
 <div id="add_brand" class="clearfix">
   <h1>修改品牌</h1>
   <form action="{{route('brand_update',['id'=>$brand->id]) }}" method="post" enctype="multipart/form-data">
   @csrf
   <ul class="add_conent">
    <li class=" clearfix"><label class="label_name"><i>*</i>品牌名称：</label> <input name="name" type="text" value="{{$brand->name}}" class="add_text"/></li>
   
    <li class=" clearfix"><label class="label_name">品牌图片：</label>
           <div class="demo l_f">
           <div class="img_preview">      
                <img src="{{Storage::url($brand->logo) }}"  width="200"alt="">    
           </div>
	           
              <input type="file" name="logo" class="preview">
            
            </div>	        
     </li>
         <li class=" clearfix"><label class="label_name"><i>*</i>所属地区：</label> <input name="address" type="text" class="add_text" value="{{$brand->address}}" style="width:120px"/></li>
         <li class=" clearfix"><label class="label_name">品牌描述：</label> <textarea name="describe" cols="" rows="" class="textarea" value="" onkeyup="checkLength(this);">{{$brand->describe}}</textarea><span class="wordage">剩余字数：<span id="sy" style="color:Red;">500</span>字</span></li>
         <li class=" clearfix"><label class="label_name"><i>*</i>显示状态：</label> 
         <label><input type="radio" name="static" value="启用"  @if($brand->static=='启用')checked @endif class="ace"><span class="lbl">显示</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <label><input type="radio" name="static" value="禁用" @if($brand->static=='禁用')checked @endif class="ace"><span class="lbl">不显示</span></label>
         </li>
   </ul>
   <div class="button_brand">
       <input type="submit" class="btn btn-warning" >
   </div>
   </form>

</div>
</body>
</html>
<script src="/js/img_preview.js"></script>
