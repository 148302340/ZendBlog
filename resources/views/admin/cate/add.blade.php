@extends('admin.public.index')
@section('title','后台栏目添加')
@section('header','栏目添加')
@section('con')
<div class="container-fluid text-center">
  <div class="panel panel-info text-left">
    <div class="panel-heading">栏目管理/添加栏目</div>
    <div class="panel-body">
      <form role="form" class="form-horizontal" method="post" action="{{url('/admin/cate/insert')}}">
        <div class="form-group">
          <label class="col-sm-2 control-label">选择栏目</label>
          <div class="col-sm-3">
            <select class="form-control" name="pid">
                <option value="0">顶级分类</option>
            @foreach($types as $k=>$v)
                <option value="{{$v->id}}">{{$v->type_name}}</option>
            @endforeach
            </select>
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <label class="col-sm-2 control-label">栏目名称</label>
          <div class="col-sm-3">
            <input type="text" name="type_name" class=" form-control" required />
          </div>
        </div><!--end form-group-->
        {{ csrf_field() }}
        <div class="form-group text-center">
          <button type="submit" class="btn btn-info">添加栏目</button>
        </div><!--end form-group text-center-->
      </form>
    </div><!--end panel-body-->
  </div><!--end panel panel-info text-left-->
</div><!--end container text-center--> 
@endsection