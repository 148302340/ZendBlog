@extends('admin.public.index')
@section('title','后台网络设置')
@section('header','基本设置')
@section('con')
<div class="container-fluid text-center">
  <div class="panel panel-info text-left">
    <div class="panel-heading">网站管理/基本设置</div>
    <div class="panel-body">
      <form role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label">网站名称</label>
          <div class="col-sm-3">
            <input type="text" name="name" class=" form-control" required />
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <label class="col-sm-2 control-label">网站标题</label>
          <div class="col-sm-3">
            <input type="text" name="title" class=" form-control" required />
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <label class="col-sm-2 control-label">网站关键词</label>
          <div class="col-sm-3">
            <input type="text" name="little" class=" form-control" required />
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <label class="col-sm-2 control-label">网站描述</label>
          <div class="col-sm-3">
            <textarea class="form-control" name="description"></textarea>
          </div>
        </div><!--end form-group-->
        <div class="form-group text-center">
          <button type="submit" class="btn btn-info">保存设置</button>
        </div><!--end form-group text-center-->
      </form>
    </div><!--end panel-body-->
  </div><!--end panel panel-info text-left-->
</div><!--end container text-center--> 
@endsection