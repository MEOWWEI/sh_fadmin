@section('title', '用户添加')
@section('content')
    <div class="layui-form-item">
        <label class="layui-form-label">开发者账户：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['email'] or ''}}" name="email" required lay-verify="required|email" placeholder="请输入正确格式邮箱" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">csr：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['csr'] or ''}}" name="csr" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">IssuerID：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['IssuerID'] or ''}}" name="IssuerID" autocomplete="off" class="layui-input">
        </div>
       {{-- <div class="layui-input-block">
            <select name="user_role" lay-verify="required">
                <option value=""></option>
                @foreach($roles as $role)
                    <option
                            @if(isset($info)&&$info)
                            @foreach($info->roles as $uRole)
                            @if($role->id == $uRole->id)
                            {{ 'selected' }}
                            @endif
                            @endforeach
                            @endif
                            value="{{ $role->id }}">{{ $role->display_name }}
                    </option>
                @endforeach
            </select>
        </div>--}}
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密钥ID：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['miyaoID'] or ''}}" name="miyaoID" autocomplete="off" class="layui-input">
        </div>
        {{--<div class="layui-input-block">
            <input type="number" value="{{$info['mobile'] or ''}}" name="tel" required lay-verify="required|phone" placeholder="请输入手机号码" autocomplete="off" class="layui-input">
        </div>--}}
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">p8：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['p8'] or ''}}" name="p8" autocomplete="off" class="layui-input">
        </div>
        {{--<div class="layui-input-block">
            <input type="radio" name="sex" value="1" title="男"
                   @if(!isset($info['sex']))
                   checked
                   @elseif(isset($info['sex'])&&$info['sex'])
                   checked
            @else
                    @endif>
            <input type="radio" name="sex" value="0" title="女" {{isset($info['sex'])&&!$info['sex']?'checked':''}}>
        </div>--}}
    </div>
{{--    <div class="layui-form-item">
        <label class="layui-form-label">密码：</label>
        <div class="layui-input-block">
            <input type="password" name="pwd" lay-verify="pwd" placeholder="请输入6-12位数字加字母密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">确认密码：</label>
        <div class="layui-input-block">
            <input type="password" name="pwd_confirmation" lay-verify="pwd_confirmation" placeholder="请确认密码" autocomplete="off" class="layui-input">
        </div>
    </div>--}}
    <div class="layui-form-item">
        <label class="layui-form-label">是否停用：</label>
        <div class="layui-unselect layui-form-radio">
            @if($info['status']==1)
                <input type="radio" id="defualtAdd1" name="status" value="1" chcked title="启用中" checked >启用中
                <input type="radio" id="defualtAdd" name="status" value="0"  title="停用">启用中
            @else
                <input type="radio" id="defualtAdd1" name="status" value="1"  title="启用">启用
                <input type="radio" id="defualtAdd" name="status" value="0"  title="已停用" checked>已停用
            @endif

           {{-- <input type="text" value="{{$info['status'] or '1'}}" name="status" placeholder="当状态值为1的时候正常，0为停用" autocomplete="off" class="layui-input">--}}
        </div>
        {{--<div class="layui-input-block">
            <input type="number" value="{{$info['mobile'] or ''}}" name="tel" required lay-verify="required|phone" placeholder="请输入手机号码" autocomplete="off" class="layui-input">
        </div>--}}
    </div>
    <input type="hidden" name="id" value="{{$info['id']}}">
@endsection
@section('id',$id)
@section('js')
    <script>
        layui.use(['form','jquery','laypage', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery;
            form.render();
            var layer = layui.layer;
            form.verify({
                user_name: [/^[a-zA-Z]{2,12}$/, '用户名必须2到12位字母'],
                pwd:function(value){
                    if(value&&!/^(?!([a-zA-Z]+|\d+)$)[a-zA-Z\d]{6,12}$/.test(value)){
                        return '密码必须6到12位数字加字母';
                    }
                },
                pwd_confirmation: function(value) {
                    if($("input[name='pwd']").val() && $("input[name='pwd']").val() != value) {
                        return '两次输入密码不一致';
                    }
                },
            });
            form.on('submit(formDemo)', function(data) {
                $.ajax({
                    url:"{{url('/users/userup')}}",
                    data:$('form').serialize(),
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        if(res.status == 'success'){
                            layer.msg(res.msg,{icon:6});
                            var index = parent.layer.getFrameIndex(window.name);
                            setTimeout('parent.layer.close('+index+')',1500);

                        }else{
                            layer.msg(res.msg,{shift: 6,icon:5});
                            return false;
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        layer.msg('异常，请重新提交', {time: 1000});
                    }
                });
                return false;
            });
        });

    </script>
@endsection
@extends('common.edit')