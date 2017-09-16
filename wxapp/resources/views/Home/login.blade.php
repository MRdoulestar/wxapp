<!doctype html>
<html lang="cn" class="fullscreen-bg">

<head>
    <title>登陆</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/vendor/linearicons/style.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="./assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <!-- <link rel="stylesheet" href="./assets/css/demo.css"> -->
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./assets/img/favicon.png">
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box ">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <div class="logo text-center"><img src="./assets/img/logo.png" alt="Klorofil Logo"></div>
                                <p class="lead">管理员、上传员登陆</p>
                            </div>
                            <form id="form" class="form-auth-small" action="{{route('login')}}" method="post">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input name="name" type="input" class="form-control" id="signin-email" value="{{old('name')}}" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label  for="signin-password" class="control-label sr-only">Password</label> 
                                    <input id="password" name="pass" type="password" class="form-control" id="signin-password" value="" placeholder="Password">
                                </div>
                            
                                <button id="commit" type="" class="btn btn-primary btn-lg btn-block">登陆</button>
                                <div class="bottom">
                                    <span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>
                                </div>

                                @if(!empty(session('msg')))
                                <!-- 登陆错误提示框 -->
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <i class="fa fa-times-circle"></i> {{session('msg')}}
                                </div>
                                @endif

                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <div class="overlay"></div>
                        <div class="content text">
                            <h1 class="heading">——忙碌的工作之余，最好的休憩时光</h1>
                            <p>莫过于午后的一缕阳光</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</body>
<script src="./assets/vendor/jquery/jquery.min.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="./assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="./assets/scripts/klorofil-common.js"></script>
<script src="./js/md5.js"></script>
<script>
    // 用户密码md5加密
    $("#commit").click(function(){
        pass = $("#password").val();
        pass = md5(pass);
        $("#password").val(pass);
    });
    </script>
</html>
