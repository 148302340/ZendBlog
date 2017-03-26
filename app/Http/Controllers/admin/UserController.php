<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\UserPostRequest;

class UserController extends Controller
{
    // 用户列表
    public function getIndex(Request $request)
    {
        //每页显示条数
        $num = $request->input('num',10);

        if($request->input('keyword')){
            $users = DB::table('user')
            ->where('name','like','%'.$request->input('keyword').'%')
            ->paginate($num);
        }else{
            $users = DB::table('user')->paginate($num);
        }
        // 提取用户所有数据
        // $users = DB::table('user')->get();
        // dd($users);

        // 获取所有参数
        $all = $request->all();

        //解析模板
        return view('admin.user.index',['users'=>$users,'all'=>$all]);
    }

    // 用户添加
    public function getAdd()
    {
        //显示用户添加页面
        return view('admin.user.add');
    }

    // 执行用户添加
    public function postInsert(UserPostRequest $request)
    {   
        // 获取用户提交数据
        $data = $request->except(['_token','ctime']);
        // dd($request->all());

        // 数据验证和缓存
        if(empty($data['password'])){
            return back()->withInput();
        }

        // 进行密码加密   Hash::check(); 进行解密
        $data['password'] = Hash::make($data['password']);

        // 执行数据入库操作
        $res = DB::table('user')->insertGetId($data);

        if($res){
            return redirect('admin/user/index')->with('success','用户添加成功');
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
        $res = DB::table('user')->where('id',$id)->delete();

        if($res){
            return redirect('admin/user/index')->with('success','用户删除成功');
        }else{
            return redirect('admin/user/index')->with('error','用户删除失败');
        }
    }

    //ajax删除
    public function postDelete(Request $request)
    {
        $id = $request->input('id');

        $res = DB::table('user')->where('id',$id)->delete();
        echo $res;
    }

    //执行用户修改
    public function postUpdate(Request $request)
    {   
        // 获取ID
        $id = $request->input('id');

        // 获取用户提交数据
        $data = $request->except(['_token','id','motto']);
        // dd($data);

        // 执行修改
        $res = DB::table('user')->where('id',$id)->update($data);
        // dd($res);
        if($res){
            return redirect('admin/user/index')->with('success','用户修改成功');
        }else{
            return back()->withInput()->with('error','用户修改失败');
        }
    }
}
