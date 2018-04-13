<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="51mJEtu1mZTOfdOeCqxoAEWpREov49hwSzRtgSsg">

    <title>首页</title>
    <meta name="description" content="留言板 - 记录下生活中的点点滴滴，给未来的自己写一份留言~" />
    <meta name="keywords" content="留言板,开源" />
    <link rel="shortcut icon" href="/img/favicon.ico">
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
                    <li><a onclick="outlogin()"><i class="fa fa-user-plus"></i>&nbsp;退出登录</a></li>
                    <li><a href="{{ url('/register') }}"><i class="fa fa-user-plus"></i>&nbsp;注册</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" id="main">
        <div class="notice">
            <i class="fa fa-volume-up"></i>
            <a  href="javascript:;" id="user_login_now">登录发言</a>
        </div>
        <!--留言区域-->
        <div id="edit">
            <div class="edit">
                <form action="" class="form" method="post" id="SendForm">
                    <input type="hidden" name="_token" value="R6jukoBNmJ1NgtK6Ih9oNlbPaxciR2umsInTDpzX">
                    <div class="form-group">
                        <textarea class="form-control"  name="text" id="text" rows="5"></textarea>
                    </div>
                    <div class="utils float-left">
                    </div>
                    <div class="form-group text-right float-right">
                        <a href="javascript:;" onClick="formSub(this);" class="btn btn-info">
                            登录后发言
                        </a>
                    </div>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
        <!--留言列表-->
        <div id="comments"><!--提示-->
            <div class="tips">
            </div>
            <!--列表-->
            <div class="comments-list">

            </div>
            <!--分页-->
            <div class="page-split text-right">
                <ul class="pagination">
                    <ul class="pagination" id="pagination">

                    </ul>

                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script type="text/javascript" src="{{ url('/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ url('/js/jquery.cookie.js')}}"></script>
<script type="text/javascript">
    var url = "{{url('/content')}}";
    var ajaxurl = "{{url('/comment')}}";
    var suburl = "{{url('/sub')}}";
    var subreviewurl = "{{url('/subreview')}}";
    var baseurl = "{{url('/')}}";
    var html = '';
    if($.cookie('user_name')){
        $('#user_login_now').html('用户：'+$.cookie('user_name'));
    }
    function outlogin(){
        $.removeCookie('user_name');
        $.removeCookie('user_type');
        $.removeCookie('user_id');
        window.location.href=baseurl;
    }
    //表单提交按钮点击事件
    function formSub(){
        var username = '',text='',flag=1;
        username = $.cookie('user_name');
        if(!username){
            alert('登录用户才可以发言');
            return false;
        }
        if($('#text').val() == ''){
            alert( '请输入留言内容!');
            return false;
        }
        if(flag==0){
            return false;
        }else{
            flag =0;
        }
        $.ajax({
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: url ,//url
            data: $('#SendForm').serialize(),//form 表单id值也可以用其他方式获取对象
            success: function (result) {
                flag = 1;
                if (result.Code == 200) {
                    alert("发言成功！");
                    change_page(1);
                }else{
                    alert(result.msg);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                flag = 1;
                alert('网络繁忙,请稍后再试! 错误码:'+textStatus);
            }
        });


    }
    change_page(1);
    //表单提交按钮点击事件
    function change_page(page=1){
        data = {
            page:page
        };
        $.ajax({
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: ajaxurl ,//ajaxurl
            data: data,//form 表单id值也可以用其他方式获取对象
            success: function (result) {
                html = '',totalhtml='',pagehtml='',last='',next='';
                if (result.data ) {
                    for(var i=0;i<result['data'].length;i++){
                        html += '<div id="comments-'+result['data'][i]['id']+'" >';
                        html += '<div class="avatar float-left"><img class="img-circle" src="//secure.gravatar.com/avatar/babaf6450edcbc40b292ba6e5fe500e8" title="admin" alt="admin"></div>';
                        html += '<div class="username float-left">'+result['data'][i]['user_name']+'</div>';
                        html += '<div class="issue-time float-right"><i class="fa fa-clock-o"></i>&nbsp;<span>'+getLocalTime(result['data'][i]['time'])+'</span></div>';
                        html += '<div class="gender float-left"><span class="fa  fa-mars"></span></div><div class="vip float-left vip_1"><span>活跃达人.Lv1</span></div><div class="clear"></div>';
                        html += '<p class="comments-text">'+result['data'][i]['content']+'</p>';
                        html += '<div class="info text-right">'
                        html += ' <a class="reply cursor-pointer hover-default reply_tips_off" onclick="huifu('+result['data'][i]['id']+')"><i class="fa fa-comments-o"></i>&nbsp;<span>回复</span></a>';
                        html += ' <a class="reply cursor-pointer hover-default reply_tips_off" onclick="comment('+result['data'][i]['number']+','+result['data'][i]['id']+')"><i class="fa fa-comments-o"></i>&nbsp;<span>回复数量（'+result['data'][i]['number']+'）</span></a>';
                        html += '<p hidden="hidden" id="comment_'+result['data'][i]['id']+'" >0</p>';
                        html += '</div></div>';
                    }
                    totalhtml = '<span><i class="fa fa-leaf"></i>&nbsp;一共有<b class="comment-count">'+result['total']+'</b>条留言，当前为第<b class="page-now-number">'+result['current_page']+'</b>页</span>';
                    $('.comments-list').html(html);
                    $('.tips').html(totalhtml);
                    last =  result['current_page']-1;
                    next =  result['current_page']+1;
                    for(var j=1;j<=result['last_page'];j++){
                        if(j==1 && result['current_page']==1){
                            pagehtml += '<li class="disabled"><span>«</span></li>';
                            pagehtml += '<li class="active"><span>'+j+'</span></li>';
                        }else if(j==1 && result['current_page']>1){
                            pagehtml += '<li><a onclick="change_page('+last+')" rel="next">«</a></li>';
                            pagehtml += '<li class=""><a onclick="change_page('+j+')">'+j+'</a></li>';
                        }else if(j==result['current_page']){
                            pagehtml += '<li class="active"><span>'+result['current_page']+'</span></li>';
                        }else if((result['current_page']-j<4 || j-result['current_page']<4) && j<result['last_page']){
                            pagehtml += '<li><a onclick="change_page('+j+')">'+j+'</a></li>';
                        }else if((result['last_page']-result['current_page'])>4 && result['last_page']==j){
                            pagehtml += '<li class="disabled"><span>...</span></li>';
                            pagehtml += '<li><a onclick="change_page('+j+')">'+j+'</a></li>';
                            pagehtml += '<li><a onclick="change_page('+next+')" rel="next">»</a></li>';
                        }else if(result['last_page']==j){
                            pagehtml += '<li><a onclick="change_page('+j+')">'+j+'</a></li>';
                            pagehtml += '<li><a onclick="change_page('+next+')" rel="next">»</a></li>';
                        }
                        //alert(j);
                    }
                   //alert(result['last_page']);
                    $('#pagination').html(pagehtml);
                }

            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                alert('网络繁忙,请稍后再试! 错误码:'+textStatus);
            }
        });
    }
    function  comment(num,id) {
        if(num<1){
            return false;
        }
        if(id<1){
            return false;
        }
        if($('#comment_'+id).html()=='1'){
            return false;
        }
        data = {
            id:id
        };
        var obj = '#comments-'+id;
        $.ajax({
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: subreviewurl ,//ajaxurl
            data: data,//form 表单id值也可以用其他方式获取对象
            success: function (result) {
                html = $(obj).html();
                if (result.data) {
                    for(var i=0;i<result['data'].length;i++){
                        html += '<div id="comments-'+result['data'][i]['id']+'" class="comments-child">';
                        html += '<div class="avatar float-left"><img class="img-circle" src="//secure.gravatar.com/avatar/babaf6450edcbc40b292ba6e5fe500e8" title="admin" alt="admin"></div>';
                        html += '<div class="username float-left">'+result['data'][i]['user_name']+'</div>';
                        html += '<div class="issue-time float-right"><i class="fa fa-clock-o"></i>&nbsp;<span>'+getLocalTime(result['data'][i]['time'])+'</span></div>';
                        html += '<div class="gender float-left"><span class="fa  fa-mars"></span></div><div class="vip float-left vip_1"><span>活跃达人.Lv1</span></div><div class="clear"></div>';
                        html += '<p class="comments-text">'+result['data'][i]['content']+'</p>';
                        html += '<div class="info text-right">';
                        html += '</div></div>';
                    }
                    $(obj).html(html);
                    $('#comment_'+id).html(1);
                }

            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                alert('网络繁忙,请稍后再试! 错误码:'+textStatus);
            }
        });
    }
    function huifu(id){
        var username = '',text='',flag=1;
        username = $.cookie('user_name');
        if(!username){
            alert('登录用户才可以回复');
            return false;
        }
        text = prompt("请输入你的回复内容:","");
        if(!$.trim(text)){
            alert( '请输入留言内容!');
            return false;
        }
        if(flag=0){
            return false
        }else{
            flag = 0;
        }
        data = {
            text:text,
            id:id,
        };
        $.ajax({
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: suburl ,//url
            data: data,//form 表单id值也可以用其他方式获取对象
            success: function (result) {
                flag = 1;
                if (result.Code == 200) {
                    alert("发言成功！");
                    change_page($('.active span').html());
                }else{
                    alert(result.msg);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                flag = 1;
                alert('网络繁忙,请稍后再试! 错误码:'+textStatus);
            }
        });
        ;
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
    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().substr(0,17)
    }
</script>
</body>
</html>
