<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/css/style.css" />
  <link href="/assets/css/codemirror.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/ace.min.css" />
  <link rel="stylesheet" href="/font/css/font-awesome.min.css" />
  <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
  <script src="/js/jquery-1.9.1.min.js"></script>
  <script src="/assets/layer/layer.js" type="text/javascript"></script>
  <script src="/assets/laydate/laydate.js" type="text/javascript"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/typeahead-bs2.min.js"></script>
  <script src="/assets/js/jquery.dataTables.min.js"></script>
  <script src="/assets/js/jquery.dataTables.bootstrap.js"></script>

  <title>个人信息管理</title>
</head>

<body>
  <div class="clearfix">
   
      <div class="admin_modify_style" id="Personal">

       <h1>修改管理员信息</h1>

        <div class="xinxi">
          <form action="{{route('admin_update',['id'=>$data->id])}}" method="post">
            @csrf

            <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">用户名：
              </label>
              <div class="col-sm-9"><input type="text" name="username" id="website-title" value="{{$data->username}}"
                  class="col-xs-7 text_info">
              </div>

            </div>
            <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">性别：
              </label>
              <div class="col-sm-9">
                <span class="sex"></span>
                <div class="add_sex">
                  <label><input name="sex" type="radio" value="保密" class="ace" @if($data->sex='保密') checked @endif><span
                      class="lbl">保密</span></label>&nbsp;&nbsp;
                  <label><input name="sex" type="radio" value="男" class="ace" @if($data->sex='男') checked @endif><span
                      class="lbl">男</span></label>&nbsp;&nbsp;
                  <label><input name="sex" type="radio" value="女" class="ace" @if($data->sex='女') checked @endif><span
                      class="lbl">女</span></label>
                </div>
              </div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">年龄：
              </label>
              <div class="col-sm-9"><input type="text" name="age" id="website-title" value="{{$data->age}}" class="col-xs-7 text_info"></div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">移动电话：
              </label>
              <div class="col-sm-9"><input type="text" name="mobile" id="website-title" value="{{$data->mobile}}" class="col-xs-7 text_info"></div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">电子邮箱：
              </label>
              <div class="col-sm-9"><input type="text" name="email" id="website-title" value="{{$data->email}}" class="col-xs-7 text_info"></div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">QQ：
              </label>
              <div class="col-sm-9"><input type="text" name="QQ" id="website-title" value="{{$data->QQ}}" class="col-xs-7 text_info"> </div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label no-padding-right" for="form-field-1">权限：
              </label>
              <div class="col-sm-9"> <span>{{$data->role_name}}</span></div>
              <select name="role_id" id="">
                @foreach($role as $v)
                @if($role_id->role_id == $v->id)
                 <option value="{{$v->id}}" selected="selected">{{$v->role_name}}</option>
                @else
                 <option value="{{$v->id}}">{{$v->role_name}}</option>
                @endif
                
                @endforeach
              </select>
            </div>
           

            <div class="Button_operation clearfix">

              <input type="submit" value="保存修改" class="btn btn-danger radius">
            </div>
          </form>
        </div>

    

      
    </div>
  </div>
 
</body>

</html>
