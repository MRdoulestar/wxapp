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
                        <li><a href="userweb" class=""><i class="lnr lnr-chart-bars"></i> <span>权限管理</span></a></li>
                    @elseif(session('level') == 2)
                       <li><a href="commitweb" class="active"><i class="lnr lnr-code"></i> <span>提交审核</span></a></li>
                        <li><a href="nochkweb" class=""><i class="lnr lnr-code"></i> <span>查看审核</span></a></li>
                        <li><a href="historyweb" class=""><i class="lnr lnr-chart-bars"></i> <span>历史记录</span></a></li>
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
                            <h3 class="panel-title">日期</h3>
                            <p class="panel-subtitle">{{date("Y-m-d ",time())}}</p>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-download"></i></span>
                                        <p>
                                            <span id="a" class="number">{{$num}}</span>
                                            <span class="title">总数目</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                                        <p>
                                            <span id="b" class="number">{{$yesnum}}</span>
                                            <span class="title">通过</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-eye"></i></span>
                                        <p>
                                            <span id="c" class="number">{{$nonum}}</span>
                                            <span class="title">不通过</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-bar-chart"></i></span>
                                        <p>
                                            <span id="d" class="number">{{$nochknum}}</span>
                                            <span class="title">未审核</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-5 col-md-5">
                                <form enctype="multipart/form-data" method="post" name="uploadform" action="excel/import">
                                    <input  type="file" accept="application/vnd.ms-excel" name="excel" >
                                    <hr>
                                    <button type="submit" class="btn btn-lg btn-primary">导入审核条目</button>
                                </form>
                                </div>
                            </div>
                            <!-- 导入成功提示 -->
                            @if(session('msg'))
                            <div class="alert alert-success alert-dismissible col-md-2" role="alert">{{session('msg')}}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-times-circle"></i></div>
                            @endif
                            <!-- 导入成功提示 -->
                        </div>
                    </div>
                    <!-- END OVERVIEW -->
                    
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
@endsection