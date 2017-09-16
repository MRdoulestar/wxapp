@extends("common.base")
@section('main')
<!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <li><a href="index" class=""><i class="lnr lnr-home"></i> <span>首页</span></a></li>
                    @if(session('level') == 1)
                        <li><a href="dataweb" class=""><i class="lnr lnr-code"></i> <span>数据导出</span></a></li>
                        <li><a href="userweb" class="active"><i class="lnr lnr-chart-bars"></i> <span>权限管理</span></a></li>
                    @elseif(session('level') == 2)
                       <li><a href="commitweb" class=""><i class="lnr lnr-code"></i> <span>提交审核</span></a></li>
                        <li><a href="getweb" class=""><i class="lnr lnr-code"></i> <span>查看审核</span></a></li>
                        <li><a href="historyweb class=""><i class="lnr lnr-chart-bars"></i> <span>历史记录</span></a></li>
                    @endif
                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <!-- OVERVIEW -->
                    <div class="panel panel-headline">
                        <div class="panel-heading">
                            <h3 class="panel-title">Weekly Overview</h3>
                            <p class="panel-subtitle">{{date("Y-m-d ",time())}}</p>
                        </div>
                        <div class="panel-body">
                            <a href="useradd" class="btn btn-success">添加人员</a>
                            <hr>
                            <div class="row">
                            <!-- 显示添加人员表 -->
                                <div class="col-md-offset-4 col-md-4 text-center">
                                    <div class="header">
                                    <div class="logo text-center"><img src="./assets/img/logo-dark.png" alt="Klorofil Logo"></div>
                                    <p class="lead">人员添加</p>
                                    </div>
                                <form class="form-auth-small" action="useradd" method="post">
                                    <div class="form-group">
                                        <label for="signin-email" class="control-label sr-only">Name</label>
                                        <input name="name" type="input" class="form-control" id="signin-email" value="{{old('name')}}" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="signin-password" class="control-label sr-only">Password</label> 
                                        <input name="pass" type="password" class="form-control" id="signin-password" value="" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="signin-password" class="control-label sr-only">Repassword</label> 
                                        <input name="repass" type="password" class="form-control" id="signin-password" value="" placeholder="Repassword">
                                    </div>
                                    <div class="form-group">
                                        <label><input name="level" type="radio" value="1" />管理员 </label>
                                        <label><input name="level" type="radio" value="2" />上传员 </label>
                                        <label><input name="level" type="radio" value="3" />审核员 </label>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">添加</button>

                                    @if(!empty($msg))
                                    <!-- 添加人员提示框 -->
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <i class="fa fa-times-circle"></i> {{$msg}}
                                    </div>
                                    @endif
                                </form>
                                </div>
                            </div>

                            <!-- 返回删除信息 -->
                            <div id="delinfo" ></div>
                             <!-- 返回删除信息 -->
                        </div>
                    </div>
                    <!-- END OVERVIEW -->
                    
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
@endsection
