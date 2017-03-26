@extends('admin.public.index')
@section('title','后台添加页面')
@section('header','用户添加')
@section('con')
<div class="container-fluid text-center">
  <div class="panel panel-info text-left">
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel-heading">用户管理/添加用户</div>
    <div class="panel-body">
      <form role="form" class="form-horizontal" action='{{url('/admin/user/insert')}}' method='post'>
        <div class="form-group">
          <label class="col-sm-2 control-label">用户名称</label>
          <div class="col-sm-3">
            <input type="text" name="name" class="form-control" value="{{old('name')}}"/>
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <label class="col-sm-2 control-label">用户邮箱</label>
          <div class="col-sm-3">
            <input type="email" name="email" class="form-control" value="{{old('email')}}"/>
          </div>
        </div><!--end form-group--> 
        <div class="form-group">
          <label class="col-sm-2 control-label">用户密码</label>
          <div class="col-sm-3">
            <input type="password" name="password" class="form-control" value="{{old('password')}}"/>
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <label class="col-sm-2 control-label">用户手机号</label>
          <div class="col-sm-3">
            <input type="text" name="phone" class="form-control" value="{{old('phone')}}"/>
          </div>
        </div><!--end form-group-->
        <input type="hidden" name="ctime" value='{{time()}}'>
        <div class="form-group">
          <label class="col-sm-2 control-label">用户状态</label>
          <div class="col-sm-3">
            <label class="radio-inline">
              <input type="radio" name="status" id="inlineRadio1" value="1"> 正常
            </label>
            <label class="radio-inline">
              <input type="radio" name="status" id="inlineRadio2" value="2"> 禁用
            </label>
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <label class="col-sm-2 control-label">用户权限</label>
          <div class="col-sm-3">
            <select class="form-control" name="auth">
              <option value='0'>普通用户</option>
              <option value='1'>管理员</option>
            </select>
          </div>
        </div><!--end form-group-->
        {{ csrf_field() }}
        <div class="form-group text-center">
          <button type="submit" class="btn btn-info">添加</button>
        </div><!--end form-group text-center-->
      </form>
    </div><!--end panel-body-->
  </div><!--end panel panel-info text-left-->
</div><!--end container text-center--> 
@endsection
