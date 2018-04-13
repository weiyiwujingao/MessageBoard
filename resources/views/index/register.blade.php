<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="YEOgpihzVkpb5z6vFremg0gBlmabWjuYF7oCWZDz">

    <title>注册</title>
    <meta name="description" content="留言板 - 记录下生活中的点点滴滴，给未来的自己写一份留言~" />
    <meta name="keywords" content="留言板" />
    <!-- Styles -->
    <link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">
    <link href="{{ url('/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('/css/x0popup.min.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="href="{{ url('/') }}"">
                    <img src="/img/logo.png" alt="logo" id="logo">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{{ url('/login') }}"><i class="fa fa-user"></i>&nbsp;登录</a></li>
                    <li><a href="{{ url('/register') }}"><i class="fa fa-user-plus"></i>&nbsp;注册</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" id="main">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">注册</div>
                    <div class="panel-body">
                        <form id="form" class="form-horizontal" role="form" method="POST" action="">
                            <input type="hidden" name="_token" value="YEOgpihzVkpb5z6vFremg0gBlmabWjuYF7oCWZDz">

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">用户名</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="user_name" value="" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">邮箱</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="user_email" value="" required>

                                </div>
                            </div>

                            <div class="form-group ">
                                <label  class="col-md-4 control-label">性别</label>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio"  value="1" name="user_gender"   required checked>男
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio"  value="2" name="user_gender"  required>女
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">密码</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" value="" name="user_password" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_password_confirmation" class="col-md-4 control-label">确认密码</label>

                                <div class="col-md-6">
                                    <input id="user_password_confirmation" type="password" value="" class="form-control" name="user_password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="javascript:;" onClick="formSub(this);" class="btn btn-primary">
                                        注册
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script type="text/javascript" src="{{ url('/js/app.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/x0popup.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/reglogin.js') }}"></script>
<script type="text/javascript">
    var url = "{{url('/register')}}";
    var baseurl = "{{url()}}";
    //表单提交按钮点击事件
    function formSub(){
        if($('#name').val().length <= 0){
            alert('用户名不为空');
            return false;
        }
        var regs = /\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/ig;
        if(!GetQuery($('#email').val(),regs)){
            alert('邮箱格式不正确');
            return false;
        }
        if($('#password').val() == '' || $('#user_password_confirmation').val() == ''){
            alert( '请输入密码!');
            return false;
        }else if($('#user_password_confirmation').val() != $('#password').val()){
            alert( '两次输入密码不相同!');
            return false;
        }
        $.ajax({
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: url ,//url
            data: $('#form').serialize(),//form 表单id值也可以用其他方式获取对象
            success: function (result) {
                console.log(result);
                if (result.Code == 200) {
                    alert("注册成功！");
                    window.location.href=baseurl;
                }else{
                    alert(result.msg);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                alert('网络繁忙,请稍后再试! 错误码:'+textStatus);
            }
        });


    }


    //绑定回车键
    document.body.onkeydown=function(e){
        e=e||window.event;
        if(e.keyCode==13){
            formSub();
        }
    }
    /*正则判断是否符合规则*/
    function GetQuery(text,regs)
    {
        var arrdate = regs.exec(text);
        if(arrdate){
            return arrdate[0];
        }else{
            return '';
        }
    }

</script>
<footer>
    <div class="container">
        <span>LiRecord V2.0</span><script>var _hmt=_hmt||[];(function(){var hm=document.createElement("script");hm.src="https://hm.baidu.com/hm.js?917b256ea229bae6b527971e3b0510e4";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm,s)})();</script>
    </div>
</footer>
</body>
</html>
