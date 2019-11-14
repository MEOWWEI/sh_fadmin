@section('title', '设备列表')
@section('header')
    <h3>设备列表</h3>
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">


        <tbody>
        @foreach($data as $value)
            <div style="width: 5px;height: 5px;">
                <td style="border-radius: 50%;text-align:center;line-height:5px;padding:3px 3px;background: #F72029;color: #ffffff;">{{$value['id']}}</td>
            </div>
                <td style="color: #6B6A6B;">{{$value['device']}}</td>

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