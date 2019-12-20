<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\admin\Cate;

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
        dd($data);
    }
}
