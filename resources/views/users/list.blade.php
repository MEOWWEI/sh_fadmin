@section('title', '账户列表')
@section('header')
    <div class="layui-inline">
        <div style="border:1px dashed #C9C9C9;border-radius: 5px;width: 1025px;margin:auto;">
            <button class="layui-btn layui-btn-small layui-btn-normal addBtn" style="margin-left: 480px;background-color: #ffffff;"  data-desc="添加用户" data-url="{{url('/users/0/edit')}}">
                {{--<i class="layui-icon" style="margin: auto;">&#xe654;</i>--}}
                <b style="text-align:center;color: #0C0C0C;">+ </b><span style="color: #000000;">添加<span>
            </button>
            <button class="layui-btn layui-btn-small layui-btn-warm freshBtn" style="background-color: #fff;    kground-color: #ffffff;">
                {{--<i class="layui-icon">&#x1002;</i>--}}
                <b style="color:#0C0C0C;">ひ </b><span style="color: #0C0C0C;">刷新</span>
            </button>
        </div>


    </div>
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="50">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="150">
            <col>
            <col class="hidden-xs" width="150">
            <col width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs"></th>
            <th class="hidden-xs">账号</th>
            <th class="hidden-xs" style="width: 550px;">创建时间</th>
         {{--   <th>可用数量</th>
            <th class="hidden-xs">类型</th>--}}
            <th ></th>
            <th ></th>
            <th >操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)

                <td class="hidden-xs">{{$info['id']}}</td>
                {{--<td class="hidden-xs">{{$info['roles'][0]['display_name'] or '已删除'}}</td>--}}
                <td>{{$info['email']}}</td>
                <td class="hidden-xs">{{$info['created_at']}}</td>
                {{--<td class="hidden-xs">{{$info['mobile']}}</td>--}}

                <td>
                    @if($info['status'] <= '0')
                        <div style="width:78px;height: 30px;">
                            <span style="border: 1px solid #FFD5BE;background-color: #FFF3EF;line-height:30px;color:#FF642C;border-radius:4px;margin:auto;display: inline;">账户已停用</span>
                        </div>
                    @elseif($info['status']=='1')

                    @endif

                </td>
                <td>
                    <div style="width:60px;height: 30px;">
                        <span style="line-height:30px;color:#1892FF;margin:auto;display: inline; float: right"><a href="/devices" style="color:#1E95FF">设备列表</a></span>
                    </div>
                </td>
                <td>
                    <div class="layui-inline" style="width: 100px;padding:0;height: 30px;">
                        <a class="layui-btn layui-btn-small layui-btn-normal edit-btn" data-id="{{$info['id']}}" data-desc="修改用户" data-url="{{url('/users/'. $info['id'] .'/edit')}}"><i class="layui-icon">&#xe642;</i></a>
                        <button class="layui-btn layui-btn-small layui-btn-danger del-btn" data-id="{{$info['id']}}" data-url="{{url('/users/'.$info['id'])}}"><i class="layui-icon">&#xe640;</i></button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
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