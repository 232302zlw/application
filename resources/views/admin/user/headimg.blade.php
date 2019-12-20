@extends('vendor.layout')
@section('title','更改头像')
@section('content')
<form class="layui-form" action="headimg_do" method="post" enctype="multipart/form-data">
    <div class="layui-form-item layui-col-md5">
        <div class="layui-input-block">

        </div>
    </div>
    <div class="layui-form-item layui-col-md5">
        <label class="layui-form-label">上传头像</label>
        <div class="layui-input-block">
            <input type="file" name="headimg" id="file">
        </div>
    </div>
    <div class="layui-form-item layui-col-md5">
        <label class="layui-form-label"></label>
        <div class="layui-input-block">
        </div>
    </div>
    <div class="layui-form-item layui-col-md5">
        <label class="layui-form-label">当前头像</label>
        <div class="layui-input-block">
            @if($headimg['headimg']=='') 请上传图片 @else <img width="200" src="{{$headimg['headimg']}}"> @endif
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn formDemo" lay-submit lay-filter="formDemo">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
@endsection
