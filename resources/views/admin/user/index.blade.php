@extends('admin.public.index')
@section('title','后台用户列表页面')
@section('header','用户列表')
@section('con')
<div class="container-fluid text-center">
  <div class="panel panel-info text-left">
    <div class="panel-heading">用户管理/用户列表</div>
    <div class="panel-body">
      <form class="form-inline" action="index" method="get">
        <div class="col-sm-6">
            <div class="dataTables_length" id="dataTables-example_length">
                <label>显示 <select name="num" aria-controls="dataTables-example" class="form-control input-sm">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select> 条</label>
            </div>
        </div>
        <input type="text" class="form-control input-sm" placeholder="用户名" name="keyword" />
        <button type="submit" class="btn btn-primary btn-sm" id="filter">搜索</button>
      </form>
    </div><!--end panel-body-->
    <table class="table table-hover text-center">
        <tr>
          <th class="text-center">用户名</th>
          <th class="text-center">签名</th>
          <th class="text-center">邮箱</th>
          <th class="text-center">手机</th>
          <th class="text-center">注册时间</th>
          <th class="text-center">退出时间</th>
          <th class="text-center">权限</th>
          <th class="text-center">状态</th>
          <th class="text-center">操作</th>
        </tr>
      @foreach($users as $k=>$v)
        <tr>
          <td>{{$v->name}}</td>
          <td>发的发的说法</td>
          <td>{{$v->email}}</td>
          <td>{{$v->phone}}</td>
          <td>{{date('Y-m-d H:i:s',time())}}</td>
          <td>2014-05-29 12:32:37</td>
          <td>{{($v->auth == 1)?'管理员':'普通会员'}}</td>
          <td>{{($v->status == 1)?'正常':'禁用'}}</td>
          <td>
          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg">修改</button>
          <button type="button" class="btn btn-danger btn-xs delete" onClick="return confirm('确认删除？')"><a href="del?id={{$v->id}}" class="delUser" sid='{{$v->id}}'>删除</a></button></td>
        </tr>
      @endforeach
    </table>
  </div><!--end panel panel-info-->
  <div class="row">
    <div class="col-sm-6">
        {!! $users->appends($all)->render() !!}
    </div>
    <!-- /.table-responsive -->
  </div>
</div><!--end container text-center--> 
<!--弹出层 模态框-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">当前位置：用户列表>>编辑
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
      </div><!--end modal-header-->
      <div class="modal-body">
        <form role="form" class="form-horizontal" action='/admin/user/update' method='post'>
          <input type="hidden" name='id' value='{{$v->id}}'>
          <div class="form-group">
            <label class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-5">
              <input type="text" name="name" class=" form-control" value="{{$v->name}}" readonly />
            </div>
          </div><!--end form-group-->
          <div class="form-group">
            <label class="col-sm-2 control-label">签名</label>
            <div class="col-sm-5">
              <input type="text" name="motto" class=" form-control" value="" readonly/>
            </div>
          </div><!--end form-group-->
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">手机</label>
            <div class="col-sm-5">
              <input type="num" name="phone" class="col-sm-2 form-control" value="{{$v->phone}}" />
            </div><!--col-sm-5-->
          </div><!--end form-group-->
          <div class="form-group">
            <label class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-5">
              <input type="email" name="email" class="col-sm-2 form-control" value="{{$v->email}}"/>
            </div>
          </div><!--end form-group-->
          <div class="form-group">
            <label class="col-sm-2 control-label">权限</label>
            <div class="col-sm-5">
              <select class="form-control" name="auth">
                <option value='0'>普通用户</option>
                <option value='1'>管理员</option>
              </select>
            </div>
          </div><!--end form-group-->
          <div class="form-group">
            <label class="col-sm-2 control-label">状态</label>
            <div class="col-sm-5">               
              <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio1" value="1"> 正常
              </label>
              <label class="radio-inline">
                <input type="radio" name="status" id="inlineRadio2" value="2"> 禁用
              </label>  
            </div>
          </div><!--end form-group-->
          {{ csrf_field() }}
          <div class="form-group text-center">
            <button type="" class="btn btn-info">保存</button>
          </div><!--end form-group text-center-->
        </form>
      </div><!--end modal-body-->
    </div><!--end modal-content-->
  </div><!--end modal-dialog modal-lg-->
</div><!--end modal fade bs-example-modal-lg-->
<div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">当前位置：用户列表>>编辑</div>
      <div class="modal-body"></div>
    </div> <!--end modal-content--> 
  </div><!--end modal-dialog modal-lg-->
</div><!--end modal fade bs-example-modal-lg1-->  
@endsection
@section('js')
    <script type="text/javascript">
    //给所有的删除链接绑定事件
    $('.delUser').click(function(){
        var id = $(this).attr('sid');
        var links = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //发送ajax
        $.post('/admin/user/delete',{id:id},function(data){
            if(data == 1){
              //获取提醒信息
              $('#successMessage').text('删除成功').show(1000);
              setTimeout(function(){
                $('#successMessage').hide(1000);
              },2000);
              links.parents('tr').remove();
            }
        });
        return false;
    })
    </script>
@endsection