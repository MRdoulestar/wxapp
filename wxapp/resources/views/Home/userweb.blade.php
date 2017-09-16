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
                            <h3 class="panel-title">日期</h3>
                            <p class="panel-subtitle">{{date("Y-m-d ",time())}}</p>
                        </div>
                        <div class="panel-body">
                            <a href="useradd" class="btn btn-success">添加人员</a>
                            <div class="row">
                            <!-- 显示用户表 -->
                                <div class="col-md-12">
                                   <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>用户名</th>
                                            <th>密码</th>
                                            <th>级别</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key=>$value)
                                        <tr id="tr{{$key+1}}">
                                            <td>{{$key+1}}</td>
                                            <td>{{$value['name']}}</td>
                                            <td>{{$value['pass']}}</td>
                                        @if($value['level']==1)
                                            <td><b>管理员</b></td>
                                        @elseif($value['level']==2)
                                            <td>上传员</td>
                                        @else
                                            <td>审核员</td>
                                        @endif
                                            <td><a id="{{$value['name']}}" name="{{$value['level']}}" type="{{$key+1}}" class="btn btn-sm btn-danger del">删除</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                   </table>
                                    {!!$data->links()!!}
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
