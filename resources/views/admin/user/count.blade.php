@extends('admin.public.index')
@section('title','后台统计页面')
@section('header','用户统计')
@section('con')
<div class="container-fluid text-center">
  <div class="col-sm-12"><table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
    <thead>
        <tr>
          <th>最近访客</th>
          <th>访问时间</th>
          <th>今日访客</th>
          <th>访客统计</th>
          <th>关注量</th>
          <th>被关注量</th>
        </tr>
    </thead>
    <tbody>
      <tr class="gradeA odd" role="row">
        <td class="sorting_1">Gecko</td>
        <td class="center">Firefox 1.0</td>
        <td class="center">Win 98+ </td>
        <td class="center">1.7</td>
        <td class="center">A</td>
        <td class="center">A</td>
      </tr>
    </tbody>
  </table></div>     
</div><!--end container text-center--> 
@endsection
