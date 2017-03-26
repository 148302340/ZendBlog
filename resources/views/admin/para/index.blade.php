@extends('admin.public.index')
@section('title','后台文章列表页面')
@section('header','文章列表')
@section('con')
<div class="container-fluid text-center">
  <div class="panel panel-info text-left">
    <div class="panel-heading">文章管理/文章列表</div>
    <table class="table table-hover text-center">
        <tr>
          <th class="text-center">文章标题</th>
          <th class="text-center">文章内容</th>
          <th class="text-center">添加时间</th>
          <th class="text-center">修改时间</th>
          <th class="text-center">操作</th>
        </tr>
      @foreach($blogs as $k=>$v)
        <tr>
          <td>{{$v->title}}</td>
          <td>{{$v->content}}</td>
          <td>{{date('Y-m-d H:i:s',time())}}</td>
          <td>2014-05-08 15:13:19</td>
          <td>
          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg">编辑</button>
          <button type="button" class="btn btn-danger btn-xs delete" onClick="return confirm('确认删除？')"><a href="del?id={{$v->id}}" class="delBlog" sid='{{$v->id}}'>删除</a></button></td>
        </tr>
      @endforeach
    </table>
  </div><!--end panel panel-info-->
  <div class="row">
    <div class="col-sm-6">
        {!! $blogs->appends($all)->render() !!}
    </div>
    <!-- /.table-responsive -->
  </div>
</div><!--end container text-center--> 
<!--弹出层 模态框-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">当前位置：文章列表>>编辑
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
      </div><!--end modal-header-->
      <div class="modal-body">
        <form role="form" class="form-horizontal" action='/admin/para/update' method='post'>
          <input type="hidden" name='id' value='{{$v->id}}'>
          <div class="form-group">
            <label class="col-sm-2 control-label">文章标题</label>
            <div class="col-sm-3">
              <input type="text" name="title" class=" form-control" required value='{{$v->title}}'/>
            </div>
          </div><!--end form-group-->
          <div class="form-group">
            <label class="col-sm-2 control-label">文章内容</label>
            <div class="col-sm-5">
              <textarea class="form-control" name="content" rows="8" cols="4" value='{{$v->content}}'></textarea>
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
    $('.delBlog').click(function(){
        var id = $(this).attr('sid');
        var links = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //发送ajax
        $.post('/admin/para/delete',{id:id},function(data){
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