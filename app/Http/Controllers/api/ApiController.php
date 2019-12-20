<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\cate;
class ApiController extends Controller
{
    /**
     * 定级分类分类
     * 查询商品分类信息接口
     */
    public function cate()
    {
        $cateone = cate::where('p_id','=',0)->get()->toArray();
        return json_encode(['msg'=>'查询成功','code'=>200,'cateone'=>$cateone],JSON_UNESCAPED_UNICODE);
    }
}
