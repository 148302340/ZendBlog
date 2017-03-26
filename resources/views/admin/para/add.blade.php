@extends('admin.public.index')
@section('title','后台文章添加页面')
@section('header','添加文章')
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
    <div class="panel-heading">文章管理/添加文章</div>
    <div class="panel-body">
      <form role="form" class="form-horizontal" action='{{url('/admin/para/insert')}}' method='post'>
        <div class="form-group">
          <label class="col-sm-2 control-label">文章标题</label>
          <div class="col-sm-3">
            <input type="text" name="title" class=" form-control" value="{{old('title')}}" required />
          </div>
        </div><!--end form-group-->
        <input type="hidden" name="ctime" class=" form-control" value='{{time()}}' />
        <div class="form-group">
          <label class="col-sm-2 control-label">文章内容</label>
          <div class="col-sm-5">
            <textarea class="form-control" name="content" rows="8" cols="4" value="{{old('content')}}"></textarea>
          </div>
        </div><!--end form-group-->
        {{ csrf_field() }}
        <div class="form-group text-center">
          <button type="submit" class="btn btn-info">添加文章</button>
        </div><!--end form-group text-center-->
      </form>
    </div><!--end panel-body-->
  </div><!--end panel panel-info text-left-->
</div><!--end container text-center--> 
@endsection
