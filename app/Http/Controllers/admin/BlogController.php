<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\UserPostRequest;

class BlogController extends Controller
{
  // 文章列表
  public function getIndex(Request $request)
  {
    //每页显示条数
    $num = $request->input('num',10);

    if($request->input('keyword')){
        $blogs = DB::table('blog')
        ->where('title','like','%'.$request->input('keyword').'%')
        ->paginate($num);
    }else{
        $blogs = DB::table('blog')->paginate($num);
    }
    // 提取文章所有数据
    // $blogs = DB::table('blog')->get();
    // dd($blogs);

    // 获取所有参数
    $all = $request->all();

    //解析模板
    return view('admin.para.index',['blogs'=>$blogs,'all'=>$all]);
  }

  // 文章添加
  public function getAdd()
  {
      // 获取用户ID
      $uid = DB::table('user')->value('id');
      // 获取板块ID
      $tid = DB::table('type')->value('id');
      // 显示添加表单
      return view('admin.para.add');
  }

  // 执行文章添加
  public function postInsert(Request $request)
  {
      //提取数据
      $data = $request->except(['_token']);
      // dd($data);

      //执行数据插入
      $res = DB::table('blog')->insert($data);
      // dd($res);

      if($res){
          return redirect('admin/para/index')->with('success','文章添加成功');
      }else{
          return back()->withInput();
      }
  }

  //删除操作
  public function getDel(Request $request)
  {
      // 获取ID
      $id = $request->input('id');

      // 执行删除
      $res = DB::table('blog')->where('id',$id)->delete();

      if($res){
          return redirect('admin/para/index')->with('success','文章删除成功');
      }else{
          return redirect('admin/para/index')->with('error','文章删除失败');
      }
  }

  //ajax删除
  public function postDelete(Request $request)
  {
      $id = $request->input('id');

      // 查询文章中是否有子类
      $res = DB::table('blog')->where('id',$id)->first();
      
      $res1 = DB::table('blog')->where('id',$id)->delete();
      echo $res1;
  }

  //执行文章修改
  public function postUpdate(Request $request)
  {
      // 获取ID
      $id = $request->input('id');

      // 获取文章提交数据
      $data = $request->except(['_token','id']);
      // dd($data);

      // 执行修改
      $res = DB::table('blog')->where('id',$id)->update($data);
      // dd($res);
      if($res){
          return redirect('admin/para/index')->with('success','文章修改成功');
      }else{
          return back()->withInput()->with('error','文章修改失败');
      }
  }
}
