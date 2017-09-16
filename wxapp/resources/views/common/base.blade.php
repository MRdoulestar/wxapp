<!doctype html>
<html lang="zh">

<head>
    <title>管理和上传</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="./assets/vendor/chartist/css/chartist-custom.css">
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
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="index"><img src="./assets/img/logo.png" alt="Doublestar Logo" class="img-responsive logo"></a>
            </div>
            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
                </div>
                
             
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="./assets/img/user.png" class="img-circle" alt="Avatar"> <span>{{session("name")}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                @if(session('level')==1)
                                    <li><a href="#"><i class="lnr lnr-cog"></i> <span>管理员</span></a></li>
                                @else
                                    <li><a href="#"><i class="lnr lnr-cog"></i> <span>上传员</span></a></li>
                                @endif
                                <li><a href="{{route('logout')}}"><i class="lnr lnr-exit"></i> <span>退出</span></a></li>
                            </ul>
                        </li>
                        <!-- <li>
                            <a class="update-pro" href="#downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->

        @yield('main')
        
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; 2017 <a href="#" target="_blank">Doublesta</a>. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="./assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="./assets/vendor/chartist/js/chartist.min.js"></script>
    <script src="./assets/scripts/klorofil-common.js"></script>
    <script>
    $(function() {
        var data, options;

        // headline charts
         data = {
            labels: ['总数', '通过', '不通过', '待审'],
            series: [
                [{{$num}}, {{$nonum}}, {{$yesnum}}, {{$nochknum}}],
                [{{$num}}, {{$nonum}}, {{$yesnum}}, {{$nochknum}}],
            ]
        };
        // data = {
        //     labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        //     series: [
        //         [23, 29, 24, 40, 25, 24, 35],
        //         [14, 25, 18, 34, 29, 38, 44],
        //     ]
        // };

        options = {
            height: 300,
            showArea: false,
            showLine: true,
            showPoint: true,
            fullWidth: true,
            axisX: {
                showGrid: false
            },
            lineSmooth: true,
        };

        new Chartist.Line('#headline-chart', data, options);
        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

    });
    
    // 删除用户
    $(".del").click(function(){
        $.post('userdel',{'name':this.id,'level':this.name},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
        {   
            $("#delinfo").html('<div class="alert alert-danger alert-dismissible col-md-2" role="alert">'+data['msg'] +'3秒后刷新<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-times-circle"></i></div>');
            setTimeout(function(){window.location.href = "userweb"}, 3000);
        })
    })
    //撤回指定条目
    $(".back").click(function(){
        $.post('itemdel',{'id':this.id},function(data)
        {   
            $("#delinfo").html('<div class="alert alert-danger alert-dismissible col-md-2" role="alert">'+data['msg'] +'3秒后刷新<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-times-circle"></i></div>');
            setTimeout(function(){window.location.href = "nochkweb"}, 3000);
        })
    })
    </script>
</body>

</html>
