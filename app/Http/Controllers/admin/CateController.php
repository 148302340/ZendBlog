<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\UserPostRequest;

class cateController extends Controller
{
  // 分类列表
  public function getIndex(Request $request)
  {
    //每页显示条数
    $num = $request->input('num',10);

    if($request->input('keyword')){
        $types = DB::table('type')
        ->where('type_name','like','%'.$request->input('keyword').'%')
        ->paginate($num);
    }else{
        $types = DB::table('type')->paginate($num);
    }
    // 提取分类所有数据
    // $types = DB::table('type')->get();
    // dd($types);

    // 获取所有参数
    $all = $request->all();

    //解析模板
    return view('admin.cate.index',['types'=>$types,'all'=>$all]);
  }

  // 分类添加
  public function getAdd()
  {
      //查询所有分类
      $types = DB::table('type')->get();

      // 显示添加表单
      return view('admin.cate.add',['types'=>$types]);
  }

  // 执行分类添加
  public function postInsert(Request $request)
  {
      //提取数据
      $data = $request->only(['type_name','pid']);
      // dd($data);

      if($data['pid'] == 0){
          $data['path'] = '0';
      }else{
          //获取父级path信息
          $res = DB::table('type')->where('id',$data['pid'])->first();
          $data['path'] = $res->path.','.$data['pid'];
      }

      //执行数据插入
      $res = DB::table('type')->insert($data);
      // dd($res);

      if($res){
          return redirect('admin/cate/index')->with('success','分类添加成功');
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
      $res = DB::table('type')->where('id',$id)->delete();

      if($res){
          return redirect('admin/cate/index')->with('success','分类删除成功');
      }else{
          return redirect('admin/cate/index')->with('error','分类删除失败');
      }
  }

  //ajax删除
  public function postDelete(Request $request)
  {
      $id = $request->input('id');

      // 查询分类中是否有子类
      $res = DB::table('type')->where('id',$id)->first();
      
      $res1 = DB::table('type')->where('id',$id)->delete();
      echo $res1;
  }

  //执行分类修改
  public function postUpdate(Request $request)
  {
      // 获取ID
      $id = $request->input('id');

      // 获取分类提交数据
      $data = $request->except(['_token','id']);
      // dd($data);

      // 执行修改
      $res = DB::table('type')->where('id',$id)->update($data);
      // dd($res);
      if($res){
          return redirect('admin/cate/index')->with('success','分类修改成功');
      }else{
          return back()->withInput()->with('error','分类修改失败');
      }
  }
}
