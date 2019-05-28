<?php /*a:2:{s:84:"/Users/liangfei/Public/project/origin/application/admin/view/user/edit_password.html";i:1558678201;s:75:"/Users/liangfei/Public/project/origin/application/admin/view/base/base.html";i:1558678201;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo htmlentities($site_config['value']['title']); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all"/>
    <link rel="stylesheet" href="/css/public.css" media="all"/>
    
</head>
<body class="childrenBody">

<form id="form" method="post" class="layui-form layui-form-pane" action="<?php echo url('/admin/editPassword'); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">原密码</label>
        <div class="layui-input-block">
            <input type="password" name="oldpassword" value="" placeholder="请输入原密码" class="layui-input"
                   lay-verify="required|password">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">新密码</label>
        <div class="layui-input-block">
            <input type="password" name="password" value="" id="password" placeholder="请输入新密码" class="layui-input"
                   lay-verify="required|password">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">确认密码</label>
        <div class="layui-input-block">
            <input type="password" name="password1" value="" placeholder="请输入确认密码" class="layui-input"
                   lay-verify="required|password|recheck">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>

<script type="text/javascript" src="/layui/layui.js"></script>

<script>
    layui.use(['form', 'layer', 'jquery'], function () {
        var form = layui.form, $ = layui.jquery, layer = layui.layer;
        //表单验证
        form.verify({
            password: [
                /^[\w\W]{6,25}$/
                , '密码长度必须6到25位'
            ],
            recheck: function (value) {
                var password = $('#password').val();
                if (value != password) {
                    return '两次密码不一致';
                }
            }

        });
        //登录按钮
        form.on("submit(*)", function (data) {
            var obj = $(this);
            obj.attr("disabled", "disabled").addClass("layui-disabled");
            $.post(data.form.action, data.field, function (data) {
                var icon = 5;
                if (data.code) {
                    icon = 6;
                }
                layer.msg(data.msg, {icon: icon, time: 1500}, function () {   //提示的插件，可以使用alert代替
                    if (data.code) {
                        setTimeout(function () {
                            //刷新父页面
                            parent.location.href = data.url;
                        }, 500);
                    } else {
                        obj.removeAttr("disabled").removeClass("layui-disabled");
                    }
                });
            }, 'json');
            return false;
        });
    });


</script>

</body>
</html>