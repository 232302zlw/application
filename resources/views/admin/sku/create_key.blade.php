@extends('vendor.layout')
@section('title','购物车列表')
@section('content')
    <form class="layui-form" id="form">
        <div class="layui-form-item layui-col-md5">
            <label class="layui-form-label">类型</label>
            <div class="layui-input-block">
                <select name="c_id" lay-verify="required">
                    <option value=""></option>
                    @foreach($cate as $k => $v)
                        <option value="{{$v['c_id']}}">{{$v['c_name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item layui-col-md5">
            <label class="layui-form-label">属性</label>
            <div class="layui-input-block">
                <input type="text" name="key_name" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="启用">
                <input type="radio" name="status" value="2" title="禁用" checked>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn formDemo" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

    <script>
        $(function(){
            layui.use('form', function(){
                var form = layui.form;
            });

            //监听提交
            $('.formDemo').click(function(){
                var data = $('#form').serialize();
                console.log(data);
                return false;
            });
        });
    </script>
@endsection
