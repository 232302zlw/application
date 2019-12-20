<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\admin\Brand;
class BrandController extends Controller
{
    /**
     * 品牌添加视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $data = Brand::get()->toArray();
//        print_r($data);die;
        return view('admin.brand.list',['data'=>$data]);
    }

    /**
     * 品牌添加视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * 品牌添加处理
     */
    public function save()
    {
        $req=request()->all();
        if (isset(array_keys($req)[3])) {
            echo json_encode(['font'=>'非法提交被阻止','code'=>2]);die;
        }
        if ($req['b_name'] == '') {
            echo json_encode(['font'=>'品牌名不能为空','code'=>2]);die;
        }
        if (strlen($req['b_name']) > 18) {
            echo json_encode(['font'=>'品牌名过长','code'=>2]);die;
        }
        if ($req['b_url'] == '') {
            echo json_encode(['font'=>'网址不能为空','code'=>2]);die;
        }
        $url = "/^http(s)?:\\/\\/.+/";
        if (!preg_match($url,$req['b_url'])) {
            echo json_encode(['font'=>'网址要以http:// 或 https:// 开始','code'=>2]);die;
        }
        if (strlen($req['b_url']) > 50) {
            echo json_encode(['font'=>'网址过长','code'=>2]);die;
        }
        if ($req['is_show'] == '') {
            echo json_encode(['font'=>'是否展示不能为空','code'=>2]);die;
        }

        $res = Brand::insert($req);

        if ($res == true) {
            echo json_encode(['font'=>'添加成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'请求超时','code'=>2]);
        }
    }

    /**
     * 品牌修改视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = Brand::where('b_id',$id)->get()->toArray();
        return view('admin.brand.edit',['data'=>$data]);
    }

    /** 品牌修改处理 */
    public function update()
    {
        $req = request()->all();
        if (isset(array_keys($req)[4])) {
            echo json_encode(['font'=>'非法提交被阻止','code'=>2]);die;
        }
        if ($req['b_name'] == '') {
            echo json_encode(['font'=>'品牌名不能为空','code'=>2]);die;
        }
        if (strlen($req['b_name']) > 18) {
            echo json_encode(['font'=>'品牌名过长','code'=>2]);die;
        }
        if ($req['b_url'] == '') {
            echo json_encode(['font'=>'网址不能为空','code'=>2]);die;
        }
        $url = "/^http(s)?:\\/\\/.+/";
        if (!preg_match($url,$req['b_url'])) {
            echo json_encode(['font'=>'网址要以http:// 或 https:// 开始','code'=>2]);die;
        }
        if (strlen($req['b_url']) > 50) {
            echo json_encode(['font'=>'网址过长','code'=>2]);die;
        }
        if ($req['is_show'] == '') {
            echo json_encode(['font'=>'是否展示不能为空','code'=>2]);die;
        }
        $result = Brand::where('b_name',$req['b_name'])->where('b_id','!=',$req['b_id'])->get()->toArray();
        if (!empty($result)) {
            echo json_encode(['font'=>'品牌名已存在','code'=>2]);die;
        }
        $res = Brand::where('b_id',$req['b_id'])->update($req);
        if ($res == true) {
            echo json_encode(['font'=>'修改成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'未作修改','code'=>2]);
        }
    }

    public function delete()
    {
        $req = request()->all();
        $res = Brand::where('b_id',$req['b_id'])->delete();
        if ($res == true) {
            echo json_encode(['font'=>'删除成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'请求超时','code'=>2]);
        }
    }
}
