<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\admin\Cate;
use App\admin\Goods;
use App\admin\Key;
use App\admin\Specs;

class AttributeController extends Controller
{
    /** 添加商品规格视图 */
    public function create($id)
    {
        $cate = Cate::where('p_id',0)->get()->toArray();
        return view('admin.attribute.create',['cate'=>$cate,'g_id'=>$id]);
    }

    /** 查询商品属性 */
    public function select()
    {
        $req = request()->all();
        $key = Key::where('c_id',$req['c_id'])->get()->toArray();
        $data = array();
        if(empty($key)){
            $data['data']=array();
            $data['success']=true;
            $data['msg']="";
        }else{
            $data['data']=$key;
            $data['success']=true;
            $data['msg']="";
        }
        echo json_encode($data);
    }

    /** 商品属性添加处理 */
    public function save()
    {
        $data = request()->all();
        $c_id = Goods::where('g_id',$data['g_id'])->value('c_id');
        if ($data['c_id'] != $c_id) {
            echo json_encode(['font'=>'商品类型不正确','code'=>2]);die;
        }
        $status = $data['status'];
        unset($data['status']);
        if (!isset($data['specs0']) | !isset($data['specs1'])) {
            echo json_encode(['font'=>'属性不能为空','code'=>2]);die;
        }
        if (!isset($data['stock'])) {
            echo json_encode(['font'=>'库存不能为空','code'=>2]);die;
        }
        if (!isset($data['price'])) {
            echo json_encode(['font'=>'价格不能为空','code'=>2]);die;
        }
        $result = Specs::where($data)->get()->toArray();
        if (!empty($result)) {
            echo json_encode(['font'=>'该属性已存在','code'=>2]);die;
        }
        $data['status'] = $status;
        $data['create_time'] = time();
        $res = Specs::insertGetId($data);
        if ($res == true) {
            echo json_encode(['font'=>'添加成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'请求超时','code'=>2]);
        }
    }

    /** 商品属性删除 */
    public function delete()
    {
        $gs_id = request()->gs_id;
        $res = Specs::where('gs_id',$gs_id)->delete();
        if ($res == true) {
            echo json_encode(['font'=>'删除成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'请求超时','code'=>2]);
        }
    }

    /** 商品属性修改视图 */
    public function edit($gs_id,$g_id)
    {
        $cate = Cate::where('p_id',0)->get()->toArray();
        $specs = Specs::where('gs_id',$gs_id)->get()->toArray();
        $key = Key::where('c_id',$specs[0]['c_id'])->get()->toArray();
        $key_name = [
            'k_name1' => $key[0]['key_name'],
            'k_name2' => $key[1]['key_name'],
            'k_name3' => $key[2]['key_name'],
        ];
        return view('admin.attribute.edit',['cate'=>$cate,'g_id'=>$g_id,'specs'=>$specs,'key_name'=>$key_name]);
    }

    /** 商品属性修改处理 */
    public function update()
    {
        $data = request()->all();
        $c_id = Goods::where('g_id',$data['g_id'])->value('c_id');
        if (!isset($data['specs2'])) {
            $sql = [
                'specs0' => $data['specs0'],
                'specs1' => $data['specs1'],
            ];
        }
        $sql = [
            'specs0' => $data['specs0'],
            'specs1' => $data['specs1'],
            'specs2' => $data['specs2']
        ];
        $result = Specs::where('gs_id','!=',$data['gs_id'])->where($sql)->get()->toArray();
        if (!empty($result)) {
            echo json_encode(['font'=>'此组合属性已存在','code'=>2]);die;
        }
        if (!empty($result)) {
            echo json_encode(['font'=>'该属性已存在','code'=>2]);die;
        }
        if ($data['c_id'] != $c_id) {
            echo json_encode(['font'=>'商品类型不正确','code'=>2]);die;
        }
//        unset($data['status']);
        if (!isset($data['specs0']) | !isset($data['specs1']) | !isset($data['specs2'])) {
            echo json_encode(['font'=>'属性不能为空','code'=>2]);die;
        }
        if (!isset($data['stock'])) {
            echo json_encode(['font'=>'库存不能为空','code'=>2]);die;
        }
        if (!isset($data['price'])) {
            echo json_encode(['font'=>'价格不能为空','code'=>2]);die;
        }
        $res = Specs::where('gs_id',$data['gs_id'])->update($data);
        if ($res == true) {
            echo json_encode(['font'=>'修改成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'未作修改','code'=>2]);
        }
    }
}
