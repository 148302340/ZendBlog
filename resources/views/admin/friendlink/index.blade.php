@extends('admin.public.index')
@section('title','后台链接列表页面')
@section('header','链接列表')
@section('con')
<div class="container-fluid text-center">
  <div class="panel panel-info text-left">
    <div class="panel-heading">友情链接/链接列表</div>
    <table class="table table-hover text-center">
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">链接名称</th>
          <th class="text-center">链接地址</th>
          <th class="text-center">操作</th>
        </tr>
      @foreach($links as $k=>$v)
        <tr>
          <td>{{$v->id}}</td>
          <td>{{$v->title}}</td>
          <td>{{$v->url}}</td>
          <td>
          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg">编辑</button>
          <button type="button" class="btn btn-danger btn-xs delete" onClick="return confirm('确认删除？')"><a href="del?id={{$v->id}}" class="delLink" sid='{{$v->id}}'>删除</a></button></td>
        </tr>
      @endforeach
    </table>
  </div><!--end panel panel-info-->
  <div class="row">
    <div class="col-sm-6">
        {!! $links->appends($all)->render() !!}
    </div>
    <!-- /.table-responsive -->
  </div>
</div><!--end container text-center--> 
<!--弹出层 模态框-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">当前位置：链接列表>>编辑
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
      </div><!--end modal-header-->
      <div class="modal-body">
        <form role="form" class="form-horizontal" action='/admin/friendlink/update' method='post'>
        <input type="hidden" name='id' value='{{$v->id}}'>
        <div class="form-group">
          <label class="col-sm-2 control-label">链接名称</label>
          <div class="col-sm-3">
            <input type="text" name="title" class=" form-control" value="{{$v->title}}" />
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <label class="col-sm-2 control-label">链接地址</label>
          <div class="col-sm-3">
            <input type="text" name="url" class=" form-control" value="{{$v->url}}" />
          </div>
        </div><!--end form-group-->
        {{ csrf_field() }}
        <div class="form-group text-center">
          <button type="submit" class="btn btn-info">保存</button>
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
    $('.delLink').click(function(){
        var id = $(this).attr('sid');
        var links = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //发送ajax
        $.post('/admin/friendlink/delete',{id:id},function(data){
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