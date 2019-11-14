@section('title', '应用展示')

@section('header')

    <div class="layui-inline" style="width: 100%;height: 32px;border-radius: 3px;">
        <div style="border:1px dashed #C9C9C9;border-radius: 5px;width: 1025px;margin:auto;">
            <button class="layui-btn layui-btn-small layui-btn-normal " style="margin-left: 480px;background-color: #ffffff;"  data-desc="添加用户" data-url="{{url('/apps/uploads')}}">
                {{--<i class="layui-icon" style="margin: auto;">&#xe654;</i>--}}
                <b style="text-align:center;color: #0C0C0C;">+ </b><span style="color: #000000;"><a href="/apps/uploads">添加</a></span>
            </button>
            <button class="layui-btn layui-btn-small layui-btn-warm freshBtn" style="background-color: #fff;    kground-color: #ffffff;">
                {{--<i class="layui-icon">&#x1002;</i>--}}
                <b style="color:#0C0C0C;">ひ </b><span style="color: #0C0C0C;">刷新</span>
            </button>
        </div>


    </div>
    <div style="width: 100%;height:auto;float: left;padding-left: 8px; padding-bottom: 10px;">
        @foreach($data as $v)
            <a href="/apps/list/{{$v['id']}}">
            <div style="width: 31%;height: 100px;margin-top:15px;margin-right: 20px;border:1px solid #AFAFAF;border-radius:4px;float: left;">
                <div style="width: 100%;height: 65px; ">
                    <div style="float:left;width:45px;height: 45px;margin-left:25px;margin-top:10px;border:1px solid #FFD700;border-radius: 5px;">
                        <img src="{{$v['icon']}}" style="width: 45px;height: 45px">
                    </div>
                    <div style="width:70%;float: left;margin-top: 13px;margin-left:10px;">
                        <p style="font-weight: bold;font-size: 16px;letter-spacing: 2px;">{{$v['app_title']}}</p>
                        <p style="margin-top: 5px;color: red;">{{$v['edition']}}</p>
                    </div>
                </div>
                <div>
                    <hr style="background-color: #C9C9C9;margin: 5px 0;">
                    <span style="color:#8C8A8C; text-align: center;margin-left: 50px;">已使用的设备：{{$v['a_down']}} &nbsp;&nbsp;剩余设备：{{$v['a_down_limit']-$v['a_down']}}</span>
                </div>
            </div>
            </a>
        @endforeach
    </div>
@endsection

@section('js')
    {{--<script src="/static/admin/layui/layui.js"></script>
    <script src="/static/admin/layui/lay/modules/jquery.js"></script>--}}
    <script>
        layui.use(['form', 'jquery','laydate', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate = layui.laydate,
                layer = layui.layer
            ;
            laydate({istoday: true});
            form.render();
            form.on('submit(formDemo)', function(data) {
                console.log(data);
            });

        });
     /*   layer.open({

            type: 2,

            area:["500px","400px"],

            content: "list.html"

        })*/
    </script>
@endsection
@extends('common.list')
