<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\UserPostRequest;

class LinkController extends Controller
{
    // 链接列表
    public function getIndex(Request $request)
    {
        //每页显示条数
        $num = $request->input('num',10);

        if($request->input('keyword')){
            $links = DB::table('friendlink')
            ->where('title','like','%'.$request->input('keyword').'%')
            ->paginate($num);
        }else{
            $links = DB::table('friendlink')->paginate($num);
        }
        // 提取链接所有数据
        // $friendlinks = DB::table('friendlink')->get();
        // dd($friendlinks);

        // 获取所有参数
        $all = $request->all();

        //解析模板
        return view('admin.friendlink.index',['links'=>$links,'all'=>$all]);
    }

    // 链接添加
    public function getAdd()
    {
        //显示链接添加页面
        return view('admin.friendlink.add');
    }

    // 执行链接添加
    public function postInsert(Request $request)
    {   
        // 获取链接提交数据
        $data = $request->except(['_token']);

        // 执行数据入库操作
        $res = DB::table('friendlink')->insert($data);
        // dd($res);

        if($res){
            return redirect('admin/friendlink/index')->with('success','链接添加成功');
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
        $res = DB::table('friendlink')->where('id',$id)->delete();

        if($res){
            return redirect('admin/friendlink/index')->with('success','链接删除成功');
        }else{
            return redirect('admin/friendlink/index')->with('error','链接删除失败');
        }
    }

    //ajax删除
    public function postDelete(Request $request)
    {
        $id = $request->input('id');

        $res = DB::table('friendlink')->where('id',$id)->delete();
        echo $res;
    }

    //执行链接修改
    public function postUpdate(Request $request)
    {   
        // 获取ID
        $id = $request->input('id');

        // 获取链接提交数据
        $data = $request->except(['_token','id']);
        // dd($data);

        // 执行修改
        $res = DB::table('friendlink')->where('id',$id)->update($data);
        // dd($res);
        if($res){
            return redirect('admin/friendlink/index')->with('success','链接修改成功');
        }else{
            return back()->withInput()->with('error','链接修改失败');
        }
    }
}
