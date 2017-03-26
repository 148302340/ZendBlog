@extends('admin.public.index')
@section('title','后台栏目列表')
@section('header','栏目列表')
@section('con')
<div class="container-fluid text-center">
  <div class="panel panel-info text-left">
    <div class="panel-heading">栏目管理/栏目列表</div>
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
          <th class="text-center">ID</th>
          <th class="text-center">PID</th>
          <th class="text-center">栏目名称</th>
          <th class="text-center">栏目路径</th>
          <th class="text-center">操作</th>
        </tr>
      @foreach($types as $k=>$v)  
        <tr>
          <td>{{$v->id}}</td>
          <td>{{$v->pid}}</td>
          <td>{{$v->type_name}}</td>
          <td>{{$v->path}}</td>
          <td>
          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg">编辑</button>
          <button type="button" class="btn btn-danger btn-xs delete" onClick="return confirm('确认删除？')"><a href="del?id={{$v->id}}" class="delCate" sid='{{$v->id}}'>删除</a></button></td>
        </tr>
      @endforeach
    </table>
  </div><!--end panel panel-info-->
  <div class="row">
    <div class="col-sm-6">
        {!! $types->appends($all)->render() !!}
    </div>
    <!-- /.table-responsive -->
  </div>
</div><!--end container text-center--> 
<!--弹出层 模态框-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">当前位置：栏目列表>>编辑
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
      </div><!--end modal-header-->
      <div class="modal-body">
        <form role="form" class="form-horizontal" action='/admin/cate/update' method='post'>
          <input type="hidden" name='id' value='{{$v->id}}'>
          <div class="form-group">
            <label class="col-sm-2 control-label">栏目名称</label>
            <div class="col-sm-3">
              <input type="text" name="type_name" class=" form-control" value="{{$v->type_name}}" />
            </div>
          </div><!--end form-group-->
          {{ csrf_field() }}
          <div class="form-group text-center">
            <button type="submit" class="btn btn-info">修改</button>
          </div><!--end form-group text-center-->
        </form>
      </div><!--end modal-body-->
    </div><!--end modal-content-->
  </div><!--end modal-dialog modal-lg-->
</div><!--end modal fade bs-example-modal-lg-->
@endsection
@section('js')
    <script type="text/javascript">
    //给所有的删除链接绑定事件
    $('.delCate').click(function(){
        var id = $(this).attr('sid');
        var links = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //发送ajax
        $.post('/admin/cate/delete',{id:id},function(data){
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