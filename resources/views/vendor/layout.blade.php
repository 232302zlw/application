<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title')</title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('/static/layui/css/layui.css')}}">
    <script src="{{asset('/static/layui/layui.js')}}"></script>
    <script src="{{asset('/static/jquery.js')}}"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <!-- 头部 -->
    <div class="layui-header">
        <div class="layui-logo">国产小青蛙</div>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a>
                    @if(session('userinfo')['headimg']=='')
                        <img src="/img/head.jpg" class="layui-nav-img">
                    @else
                        <img src="{{session('userinfo')['headimg']}}" class="layui-nav-img">
                    @endif
                    {{--                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">--}}
                </a>
                <dl class="layui-nav-child">
                    <dd><a class="headimg" href="javascript:;">更换头像</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item out"><a href="javascript:;">退出</a></li>
        </ul>
    </div>

    <!-- 左侧 -->
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item layui-nav-itemed">
                    <a class="" href="/admin/index">&ensp;&ensp;主&ensp;页</a>
                </li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">用户管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/user/list">&emsp;&emsp;用户列表</a></dd>
                       <dd><a href="/admin/user/edit">&emsp;&emsp;修改信息</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">品牌管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/brand/list">&emsp;&emsp;品牌列表</a></dd>
                        <dd><a href="/admin/brand/create">&emsp;&emsp;品牌添加</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">分类管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/cate/list">&emsp;&emsp;分类列表</a></dd>
                        <dd><a href="/admin/cate/create">&emsp;&emsp;分类添加</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">商品管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/goods/list">&emsp;&emsp;商品列表</a></dd>
                        <dd><a href="/admin/goods/create">&emsp;&emsp;商品添加</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">商品属性管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/sku/list_key">&emsp;&emsp;商品属性列表</a></dd>
                        <dd><a href="/admin/sku/create_key">&emsp;&emsp;商品属性添加</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">广告管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/advent/list">&emsp;&emsp;广告列表</a></dd>
                        <dd><a href="/admin/advent/create">&emsp;&emsp;广告添加</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">订单管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/friend/list">&emsp;&emsp;订单列表</a></dd>
                        <dd><a href="/admin/friend/create">&emsp;&emsp;订单添加</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">购物车管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/notice/list">&emsp;&emsp;购物车列表</a></dd>
                        <dd><a href="/admin/notice/create">&emsp;&emsp;购物车添加</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">R B A C</a>
                    <dl class="layui-nav-child">
                        <dd><a href="/admin/rbac/r_create">&emsp;&emsp;角色添加</a></dd>
                        <dd><a href="/admin/rbac/r_list">&emsp;&emsp;角色列表</a></dd>
                        <dd><a href="/admin/rbac/a_create">&emsp;&emsp;权限添加</a></dd>
                        <dd><a href="/admin/rbac/a_list">&emsp;&emsp;权限列表</a></dd>
                        <dd><a href="/admin/rbac/gra_create">&emsp;&emsp;角色权限添加</a></dd>
                        <dd><a href="/admin/rbac/gra_list">&emsp;&emsp;角色权限列表</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>

    <!-- 内容主体区域 -->
    <div class="layui-body">
        <div style="padding: 15px;">@yield('content')</div>
    </div>

    <!-- 底部固定区域 -->
    <div class="layui-footer">
        <!-- © layui.com - 底部固定区域 -->
    </div>
</div>

<script>
    $(function(){
        // 左侧栏位使用
        layui.use('element', function(){
            var element = layui.element;
        });
        // layui引用
        layui.use('form', function(){
            var form = layui.form;
        });


        // 更换头像
        $('.headimg').click(function(){
            location.href='/admin/headimg';
        });

        // 退出登录
        $('.out').click(function(){
            var data = {};
            $.post(
                '/admin/out',
                data,
                function(res){
                    layer.msg(res.font,{icon:res.code,time:1500},function(){
                        location.href='/';
                    });
                },
                'json'
            );
        });
    });
</script>
</body>
</html>
