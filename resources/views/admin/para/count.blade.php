@extends('admin.public.index')
@section('title','后台统计页面')
@section('header','文章统计')
@section('con')
<div class="container-fluid text-center">
  <div class="col-sm-12"><table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
    <thead>
        <tr>
          <th>今日浏览</th>
          <th>浏览统计</th>
          <th>关注量</th>
        </tr>
    </thead>
    <tbody>
      <tr class="gradeA odd" role="row">
        <td class="center">Win 98+ </td>
        <td class="center">1.7</td>
        <td class="center">A</td>
      </tr>
    </tbody>
  </table></div>     
</div><!--end container text-center--> 
@endsection
