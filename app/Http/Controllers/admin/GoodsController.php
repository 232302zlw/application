<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\admin\Goods;
use App\admin\Brand;
use App\admin\Cate;
use App\admin\Specs;
use App\admin\Key;

class GoodsController extends Controller
{
    /** 商品列表视图 */
    public function list()
    {
        $goods = Goods::get()->toArray();
        $brand = Brand::where('is_show',1)->get()->toArray();
        $cate = Cate::where('is_show',1)->get()->toArray();
        foreach ($goods as $k => $v) {
            foreach ($brand as $key => $value) {
                if ($v['b_id'] == $value['b_id']) {
                    $goods[$k]['b_name'] = $value['b_name'];
                }
            }
        }
        foreach ($goods as $k => $v) {
            foreach ($cate as $key => $value) {
                if ($v['c_id'] == $value['c_id']) {
                    $goods[$k]['c_name'] = $value['c_name'];
                }
            }
        }
        return view('admin.goods.list',['data'=>$goods]);
    }

    /** 商品详情视图 */
    public function detail($id)
    {
        $goods = Goods::where('g_id',$id)->get()->toArray();
        $goods[0]['g_imgs'] = json_decode($goods[0]['g_imgs'],1);
        $brand = Brand::get()->toArray();
        $cate = Cate::get()->toArray();
        foreach ($goods as $k => $v) {
            foreach ($brand as $key => $value) {
                if ($v['b_id'] == $value['b_id']) {
                    $goods[$k]['b_name'] = $value['b_name'];
                }
            }
        }
        foreach ($goods as $k => $v) {
            foreach ($cate as $key => $value) {
                if ($v['c_id'] == $value['c_id']) {
                    $goods[$k]['c_name'] = $value['c_name'];
                }
            }
        }
        $specs = Specs::where('g_id',$id)->get()->toArray();
        $key = Key::where('c_id',$specs[0]['c_id'])->get()->toArray();
        if (!isset($key[2]['key_name'])) {
            $key_name = [
                'k_name1' => $key[0]['key_name'],
                'k_name2' => $key[1]['key_name'],
            ];
        }
        $key_name = [
            'k_name1' => $key[0]['key_name'],
            'k_name2' => $key[1]['key_name'],
            'k_name3' => $key[2]['key_name'],
        ];
        return view('admin.goods.detail',['data'=>$goods,'specs'=>$specs,'key_name'=>$key_name]);
    }

    /** 商品添加视图 */
    public function create()
    {
        $brand = Brand::where('is_show',1)->get()->toArray();
        $cate = Cate::where('is_show',1)->get()->toArray();
        return view('admin.goods.create',['brand'=>$brand,'cate'=>$cate]);
    }

    /** 商品添加处理 */
    public function save(Request $request)
    {
        $data = request()->all();
        dd($data);
        if (empty($data['g_name'])) {
            echo "<script>alert('名称不能为空');history.back();</script>";die;
        }
        if (empty($data['g_price'])) {
            echo "<script>alert('价格不能为空');history.back();</script>";die;
        }
        if (empty($data['g_stock'])) {
            echo "<script>alert('库存不能为空');history.back();</script>";die;
        }
        if (empty($data['b_id'])) {
            echo "<script>alert('品牌不能为空');history.back();</script>";die;
        }
        if (empty($data['c_id'])) {
            echo "<script>alert('分类不能为空');history.back();</script>";die;
        }
        if (empty($data['g_desc'])) {
            echo "<script>alert('描述不能为空');history.back();</script>";die;
        }
        if (empty($data['g_img'])) {
            echo "<script>alert('大图不能为空');history.back();</script>";die;
        }
        if (empty($data['g_imgs1']) && empty($data['g_imgs2']) && empty($data['g_imgs3'])) {
            echo "<script>alert('轮播图不能少于三张');history.back();</script>";die;
        }

//        $dir = '/upload/goods_img/';
//        if (!is_dir($dir)){
//            mkdir($dir,0,777);
//        }
        if(is_object($data['g_img'])) {
            //获取字段名
            $fileCharater = $request->file('g_img');
            //获取文件的扩展名
            $ext = $fileCharater->getClientOriginalExtension();
            //获取文件的绝对路径
            $path = $fileCharater->getRealPath();
            //定义文件名
            $filename = uniqid().time().".".$ext;
            //存入数据库的路径
            $g_img = "/upload/goods_img/" . $filename;
            //存储文件。disk里面的public。总的来说，就是调用disk模块里的public配置
            Storage::disk('goods_img')->put($filename, file_get_contents($path));
            $data['g_img'] = $g_img;
        }

//        $dir = '/upload/goods_imgs/';
//        if (!is_dir($dir)){
//            mkdir($dir,0,777);
//        }
        if(is_object($data['g_imgs1'])) {       // 轮播图一
            $fileCharater = $request->file('g_imgs1');
            $ext = $fileCharater->getClientOriginalExtension();
            $path = $fileCharater->getRealPath();
            $filename = uniqid().time().".".$ext;
            $g_imgs1 = "/upload/goods_imgs/" . $filename;
            Storage::disk('goods_imgs')->put($filename, file_get_contents($path));
        }
        if(is_object($data['g_imgs2'])) {       // 轮播图二
            $fileCharater = $request->file('g_imgs2');
            $ext = $fileCharater->getClientOriginalExtension();
            $path = $fileCharater->getRealPath();
            $filename = uniqid().time().".".$ext;
            $g_imgs2 = "/upload/goods_imgs/" . $filename;
            Storage::disk('goods_imgs')->put($filename, file_get_contents($path));
        }
        if(is_object($data['g_imgs3'])) {       // 轮播图三
            $fileCharater = $request->file('g_imgs3');
            $ext = $fileCharater->getClientOriginalExtension();
            $path = $fileCharater->getRealPath();
            $filename = uniqid().time().".".$ext;
            $g_imgs3 = "/upload/goods_imgs/" . $filename;
            Storage::disk('goods_imgs')->put($filename, file_get_contents($path));
        }
        $data['g_imgs'] = json_encode(['1' => $g_imgs1,'2' => $g_imgs2,'3' => $g_imgs3]);
        $data['create_time'] = time();
        unset($data['g_imgs1']);
        unset($data['g_imgs2']);
        unset($data['g_imgs3']);

        $res = Goods::insertGetId($data);
        if ($res == true) {
            echo "<script>alert('添加成功，前往添加属性');location='/admin/value/create/'+$res;</script>";
        }else{
            echo "<script>alert('请求超时');location='/admin/goods/create';</script>";
        }
    }

    /** 商品修改视图 */
    public function edit($id)
    {
        $goods = Goods::where('g_id',$id)->get()->toArray();
        $goods[0]['g_imgs'] = json_decode($goods[0]['g_imgs'],1);
//        foreach ($goods as &$val) {
//            $val['g_imgs']= json_decode($val['g_imgs'],true);
//        }
//        print_r($goods);die;
        $brand = Brand::where('is_show',1)->get()->toArray();
        $cate = Cate::where('is_show',1)->get()->toArray();
        return view('admin.goods.edit',['data'=>$goods,'brand'=>$brand,'cate'=>$cate]);
    }

    /** 商品修改处理 */
    public function update(Request $request)
    {
        $data = request()->all();
        if (empty($data['g_name'])) {
            echo "<script>alert('名称不能为空');history.back();</script>";
        }
//        if (empty($data['g_price'])) {
//            echo "<script>alert('价格不能为空');history.back();</script>";
//        }
//        if (empty($data['g_stock'])) {
//            echo "<script>alert('库存不能为空');history.back();</script>";
//        }
        if (empty($data['b_id'])) {
            echo "<script>alert('品牌不能为空');history.back();</script>";
        }
        if (empty($data['c_id'])) {
            echo "<script>alert('分类不能为空');history.back();</script>";
        }
        if (empty($data['g_desc'])) {
            echo "<script>alert('描述不能为空');history.back();</script>";
        }

        if (isset($data['g_img'])) {
//            $dir = '/upload/goods_img/';
//            if (!is_dir($dir)){
//                mkdir($dir,0,777);
//            }
            if(is_object($data['g_img'])) {     // 商品大图
                //获取字段名
                $fileCharater = $request->file('g_img');
                //获取文件的扩展名
                $ext = $fileCharater->getClientOriginalExtension();
                //获取文件的绝对路径
                $path = $fileCharater->getRealPath();
                //定义文件名
                $filename = uniqid().time().".".$ext;
                //存入数据库的路径
                $g_img = "/upload/goods_img/" . $filename;
                //存储文件。disk里面的public。总的来说，就是调用disk模块里的public配置
                Storage::disk('goods_img')->put($filename, file_get_contents($path));
                $data['g_img'] = $g_img;
            }
        }

        if (isset($data['g_imgs1'])) {
//            $dir = '/upload/goods_imgs/';
//            if (!is_dir($dir)){
//                mkdir($dir,0,777);
//            }
            if(is_object($data['g_imgs1'])) {       // 轮播图一
                $fileCharater = $request->file('g_imgs1');
                $ext = $fileCharater->getClientOriginalExtension();
                $path = $fileCharater->getRealPath();
                $filename = uniqid().time().".".$ext;
                $g_imgs1 = "/upload/goods_imgs/" . $filename;
                Storage::disk('goods_imgs')->put($filename, file_get_contents($path));
                $g_imgs = json_decode(Goods::where('g_id',$data['g_id'])->value('g_imgs'),1);
                $g_imgs[1] = $g_imgs1;
                $data['g_imgs'] = json_encode($g_imgs);
                unset($data['g_imgs1']);
            }
        }elseif (isset($data['g_imgs2'])) {
//            $dir = '/upload/goods_imgs/';
//            if (!is_dir($dir)){
//                mkdir($dir,0,777);
//            }
            if(is_object($data['g_imgs2'])) {       // 轮播图二
                $fileCharater = $request->file('g_imgs2');
                $ext = $fileCharater->getClientOriginalExtension();
                $path = $fileCharater->getRealPath();
                $filename = uniqid().time().".".$ext;
                $g_imgs2 = "/upload/goods_imgs/" . $filename;
                Storage::disk('goods_imgs')->put($filename, file_get_contents($path));
                $g_imgs = json_decode(Goods::where('g_id',$data['g_id'])->value('g_imgs'),1);
                $g_imgs[2] = $g_imgs2;
                $data['g_imgs'] = json_encode($g_imgs);
                unset($data['g_imgs2']);
            }
        }elseif (isset($data['g_imgs3'])) {
//            $dir = '/upload/goods_imgs/';
//            if (!is_dir($dir)){
//                mkdir($dir,0,777);
//            }
            if(is_object($data['g_imgs3'])) {       // 轮播图三
                $fileCharater = $request->file('g_imgs3');
                $ext = $fileCharater->getClientOriginalExtension();
                $path = $fileCharater->getRealPath();
                $filename = uniqid().time().".".$ext;
                $g_imgs3 = "/upload/goods_imgs/" . $filename;
                Storage::disk('goods_imgs')->put($filename, file_get_contents($path));
                $g_imgs = json_decode(Goods::where('g_id',$data['g_id'])->value('g_imgs'),1);
                $g_imgs[3] = $g_imgs3;
                $data['g_imgs'] = json_encode($g_imgs);
                unset($data['g_imgs3']);
            }
        }

        $res = Goods::where('g_id',$data['g_id'])->update($data);
        if ($res == true) {
            echo "<script>alert('添加成功');location='/admin/goods/list';</script>";
        }else{
            echo "<script>alert('未知错误，请尽快联系管理人员');history.back();</script>";
        }
    }

    /** 商品删除 */
    public function delete()
    {
        $data = request()->g_id;
        $res = Goods::where('g_id',$data)->delete();
        if ($res == true) {
            echo json_encode(['font'=>'删除成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'请求超时','code'=>2]);
        }
    }
}
