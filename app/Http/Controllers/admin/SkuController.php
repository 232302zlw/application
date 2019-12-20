<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\admin\Cate;
use App\admin\Key;

class SkuController extends Controller
{
    /** 商品固有属性添加视图 */
    public function create_key()
    {
        $cate = Cate::where('p_id',0)->get()->toArray();
        return view('admin.sku.create_key',['cate'=>$cate]);
    }

    /** 商品固有属性添加处理 */
    public function save_key()
    {
        $data = request()->all();
//        if ($data['c_id']='') {
//            echo json_encode(['font'=>'类型必选','code'=>2]);die;
//        }
//        if ($data['key_name']='') {
//            echo json_encode(['font'=>'属性不能为空','code'=>2]);die;
//        }
//        if (strlen($data['key_name'] >15)) {
//            echo json_encode(['font'=>'属性过长','code'=>2]);die;
//        }
//        if ($data['status']='') {
//            echo json_encode(['font'=>'状态不能为空','code'=>2]);die;
//        }
        $data['create_time'] = time();
        $result = Key::where(['c_id'=>$data['c_id'],'key_name'=>$data['key_name']])->get()->toArray();
        if (!empty($result)) {
            echo json_encode(['font'=>'此属性已存在','code'=>2]);die;
        }
        $res = Key::insertGetId($data);
        if ($res == true) {
            echo json_encode(['font'=>'添加成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'请求超时','code'=>2]);
        }
    }
}
