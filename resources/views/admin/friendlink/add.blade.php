@extends('admin.public.index')
@section('title','后台链接添加页面')
@section('header','添加链接')
@section('con')
<div class="container-fluid text-center">
  <div class="panel panel-info text-left">
    <div class="panel-heading">友情链接/添加链接</div>
    <div class="panel-body">
      <form role="form" class="form-horizontal" action='{{url('/admin/friendlink/insert')}}' method='post'>
        <div class="form-group">
          <label class="col-sm-2 control-label">链接名称</label>
          <div class="col-sm-3">
            <input type="text" name="title" class=" form-control" value="{{old('title')}}" required />
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <label class="col-sm-2 control-label">链接地址</label>
          <div class="col-sm-3">
            <input type="text" name="url" class=" form-control" value="{{old('url')}}" required />
          </div>
        </div><!--end form-group-->
        {{ csrf_field() }}
        <div class="form-group text-center">
          <button type="submit" class="btn btn-info">添加链接</button>
        </div><!--end form-group text-center-->
      </form>
    </div><!--end panel-body-->
  </div><!--end panel panel-info text-left-->
</div><!--end container text-center-->
@endsection
