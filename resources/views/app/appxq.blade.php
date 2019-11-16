@section('title', '应用列表')
<script src="/static/admin/js/jquery.min.js" type="text/javascript"></script>
@section('header')
@endsection

<style>
    .wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /*表示2列*/
        grid-template-rows: 1fr 1fr 1fr;
        /*第二行的高是第一行的2倍,我们现在可以设置行高之间的关系。如果我们把前面的行高设成 1fr ，最后一个则设置为 3fr，这意味着第二行的行高是第一行的 3 倍：*/
        grid-column-gap: 1px;
        /*列之间的线*/
        grid-row-gap: 1px;
        /*行之间的线隔*/
        background-color: rgb(117, 112, 112);
    }

    @media screen and (min-width: 500px) {
        /*超过500显示三列*/
        .wrapper {
            grid-template-columns: 1fr 1fr 1fr;
        }
    }

    @media screen and (min-width: 800px) {
        /*超过800四列*/
        .wrapper {
            grid-template-columns: 1fr 1fr 1fr 1fr;
        }
    }

    .letter {
        display: flex;
        justify-content: center;
        /*flex的相差属性居中对齐*/
        align-items: center;
        /*容器里元素垂直居中*/
        padding: 5px;
        background-color: #F2F2F2;
        font-size: 18px;
        color: #000000;
        line-height: 1;
        font-family: 'hobeaux-rococeaux-background', Helvetica;
        font-weight: 200;
        cursor: pointer;
        transition: all .3s ease;
    }
    input{
        background-color: #F2F2F2;
        border:none;
    }
    .role input[type='file']{opacity:0;}
    .role{border:1px solid #c9cccf;text-align:center;width:200px;height:200px;line-height:200px;font-size:18px;margin-top:15px;float:left;margin-left:5px;}


    .role img{width: 198px;height: 198px;display: none;}

    input[type="checkbox"]{
        display:none;
    }
    input + label{
        box-shadow:rgb(16, 75, 243) 0px 0px 0px 1px;
        width:60px;
        height:20px;
        display:inline-block;
        border-radius:20px;
        position:relative;
        overflow:hidden;
    }
    input + label:before{
        content:'';
        position:absolute;
        left:0px;
        width:20px;
        height:20px;
        display:inline-block;
        border-radius:20px;
        background-color:#4cd964;
        z-index:20;
        transition:all 0.5s;
    }
    input + label:after{
        content:'';
        position:absolute;
        border-radius:20px;
        left:-40px;
        width:60px;
        height:20px;
        display:inline-block;
        background-color:#4898ff;
        transition:all 0.5s;
    }
    input:checked + label:before{
        left:40px;
    }
    input:checked + label:after{
        left:0px;

    }
</style>
<div class="wrap-container welcome-container">
    <div class="row">
        <div class="welcome-left-container col-lg-9">

            <!--基本信息-->
            <div class="server-panel panel panel-default">
                <div class="panel-header">基础信息</div>
                <hr>
                <div class="panel-body clearfix" style="border: 1px solid #000000;">
                    <div class="col-md-3">
                        <p class="title">图标</p>
                        <div style="width: 235px;margin-left:13px;margin-top:5px;height: 30px;">
                            <img src="{{$data['icon']}}" style="width: 30px;height:30px;">
                            <form action="/apps/icon/{{$data['id']}}" method="post" enctype="multipart/form-data" style="width: 185px;margin-top: -32px;margin-left: 40px;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" style="display: none;">
                                <input type="file" name="file" style=" width:70px;display:inline-block;line-height:25px;margin-top:5px;border-radius:4px;height:25px; text-align:center; color: #4395FF;margin-left: 30px;border:1px solid #F2F2F2;">
                                 <input type="submit" value="提交" style=" width:70px;display:inline-block;line-height:25px;border-radius:4px;height:25px; text-align:center;letter-spacing: 3px;border:none;border:1px dashed #8f94a1;cursor:pointer; color: #ffffff;background-color:  #4395FF;">


                            </form>
                        </div>
                    </div>
                    <div class="col-md-3" onclick="apptitle({{$data['id']}})">
                        <p class="title">应用名称</p>
                        {{--<span class="info">{{$data['app_title']}}</span>--}}
                        <span id="bbb12{{$data['id']}} "class="info" >{{$data['app_title']}}</span>
                        <input type="text" value="{{$data['app_title']}}" style="display: none;" id="aaa12{{$data['id']}}"
                               onblur="apptitles({{$data['id']}})">
                        <script>
                            function apptitle(id){
                                document.getElementById('aaa12'+id).style.display='block';//显示input
                                document.getElementById('bbb12'+id).innerHTML="";//span标签的值设置为空
                            }
                            function apptitles(id){
                                var username = document.getElementById('aaa12'+id).value;//获取文本框的值
                                $.ajax({
                                    type:'GET',//请求方式
                                    data:{'id':id,'username':username},//传递参数
                                    url:"{{url('/apps/apptitles')}}",//地址
                                    success:function(e){//回调
                                        if(e==1){
                                            document.getElementById('aaa12'+id).style.display = 'none';//如果修改成功,input隐藏
                                            document.getElementById('bbb12'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                        }else{
                                            alert('修改失败');
                                            window.location.reload();
                                        }
                                    }

                                })
                            }
                        </script>
                    </div>

                    <div class="col-md-2">
                        <p class="title"> 应用ID</p>
                        <span class="info">{{$data['app_id']}}</span>
                    </div>
                    <div class="col-md-1">
                        <p class="title">版本</p>
                        <span class="info">{{$data['edition']}}</span>
                    </div>
                    <div class="col-md-1">
                        <p class="title"> Build版本</p>
                        <span class="info">{{$data['build_edition']}}</span>
                    </div>

                    <div class="col-md-1">
                        <p class="title">系统版本</p>
                        <span class="info">{{$data['sys_edition']}}</span>
                    </div>
                    <div class="col-md-1">
                        <p class="title">文件大小</p>
                        <span class="info">{{$data['filesize']}} MB</span>
                    </div>
                </div>
            </div>

            <!--附加信息-->
            <div class="server-panel panel panel-default">
                <div class="panel-header">附加信息</div>
                <hr>
                <div class="panel-body clearfix" style="border: 1px solid #000000;">
                    <div class="wrapper">
                        <div class="letter" style="padding: 8px;">
                            副标题
                        </div>

                        <div class="letter"style="padding: 8px;"  onclick="saveuser({{$data['id']}})">

                            <span id="bbb{{$data['id']}}" style="background-color: #f2f2f2;">{{$data['f_title']}}</span>
                            <input type="text" value="{{$data['f_title']}}" style="display:none"width: 200px; id="aaa{{$data['id']}}"
                                   onblur="edituser({{$data['id']}})">
                        </div>

                        <div class='letter'style="padding: 8px;">
                            适用年龄
                        </div>
                        <div class='letter'style="padding: 8px;" onclick="saveage({{$data['id']}})">
                            <span id="bbb1{{$data['id']}}" style="background-color: #f2f2f2;" >{{$data['f_age']}}</span>
                            <input type="text" value="{{$data['f_age']}}" style="display: none;width: 200px;" id="aaa1{{$data['id']}}"
                                onblur="age({{$data['id']}})">
                        </div>

                        <script>
                            function saveage(id){
                                document.getElementById('aaa1'+id).style.display='block';//显示input
                                document.getElementById('bbb1'+id).innerHTML="";//span标签的值设置为空
                            }
                            function age(id){
                                var username = document.getElementById('aaa1'+id).value;//获取文本框的值
                                $.ajax({
                                    type:'GET',//请求方式
                                    data:{'id':id,'username':username},//传递参数
                                    url:"{{url('/apps/fage')}}",//地址
                                    success:function(e){//回调
                                        console.log(e);
                                        if(e==1){
                                            document.getElementById('aaa1'+id).style.display = 'none';//如果修改成功,input隐藏
                                            document.getElementById('bbb1'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                        }else{
                                            alert('修改失败');
                                            window.location.reload();
                                        }
                                    }

                                })
                            }
                        </script>
                        <div class="letter"style="padding: 8px;">
                            分类
                        </div>

                        <div class="letter"style="padding: 8px;" onclick="saveclass({{$data['id']}})">
                            <span id="bbb2{{$data['id']}}" style="background-color: #f2f2f2;">{{$data['f_class']}}</span>
                            <input type="text" value="{{$data['f_class']}}" style="display: none;width: 200px;" id="aaa2{{$data['id']}}"
                                   onblur="clas({{$data['id']}})">
                            <script>
                                function saveclass(id){
                                    document.getElementById('aaa2'+id).style.display='block';//显示input
                                    document.getElementById('bbb2'+id).innerHTML="";//span标签的值设置为空
                                }
                                function clas(id){
                                    var username = document.getElementById('aaa2'+id).value;//获取文本框的值
                                    $.ajax({
                                        type:'GET',//请求方式
                                        data:{'id':id,'username':username},//传递参数
                                        url:"{{url('/apps/clas')}}",//地址
                                        success:function(e){//回调
                                            if(e==1){
                                                document.getElementById('aaa2'+id).style.display = 'none';//如果修改成功,input隐藏
                                                document.getElementById('bbb2'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                            }else{
                                                alert('修改失败');
                                                window.location.reload();
                                            }
                                        }

                                    })
                                }
                            </script>
                        </div>

                        <div class='letter'style="padding: 8px;">
                            排名
                        </div>
                        <div class='letter'style="padding: 8px;" onclick="rlaking({{$data['id']}})">
                            <span id="bbb3{{$data['id']}}" style="background-color: #f2f2f2;">{{$data['f_ranking']}}</span>
                            <input type="text" value="{{$data['f_ranking']}}" style="display: none;width: 60px;" id="aaa3{{$data['id']}}"
                                   onblur="rlak({{$data['id']}})">
                            <script>
                                function rlaking(id){
                                    document.getElementById('aaa3'+id).style.display='block';//显示input
                                    document.getElementById('bbb3'+id).innerHTML="";//span标签的值设置为空
                                }
                                function rlak(id){
                                    var username = document.getElementById('aaa3'+id).value;//获取文本框的值
                                    $.ajax({
                                        type:'GET',//请求方式
                                        data:{'id':id,'username':username},//传递参数
                                        url:"{{url('/apps/rlak')}}",//地址
                                        success:function(e){//回调
                                            if(e==1){
                                                document.getElementById('aaa3'+id).style.display = 'none';//如果修改成功,input隐藏
                                                document.getElementById('bbb3'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                            }else{
                                                alert('修改失败');
                                                window.location.reload();
                                            }
                                        }

                                    })
                                }
                            </script>
                        </div>
                        <div class="letter"style="padding: 8px;">
                            评分星级
                        </div>

                        <div class="letter" style="padding: 8px;" onclick="scoress({{$data['id']}})">
                            <span id="bbb4{{$data['id']}}" style="background-color: #f2f2f2;">{{$data['f_score']}}</span>
                            <input type="text" value="{{$data['f_score']}}" style="display: none;width: 70%;" id="aaa4{{$data['id']}}"
                                   onblur="score({{$data['id']}})">
                            <script>
                                function scoress(id){
                                    document.getElementById('aaa4'+id).style.display='block';//显示input
                                    document.getElementById('bbb4'+id).innerHTML="";//span标签的值设置为空
                                }
                                function score(id){
                                    var username = document.getElementById('aaa4'+id).value;//获取文本框的值
                                    $.ajax({
                                        type:'GET',//请求方式
                                        data:{'id':id,'username':username},//传递参数
                                        url:"{{url('/apps/score')}}",//地址
                                        success:function(e){//回调
                                            if(e==1){
                                                document.getElementById('aaa4'+id).style.display = 'none';//如果修改成功,input隐藏
                                                document.getElementById('bbb4'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                            }else{
                                                alert('修改失败');
                                                window.location.reload();
                                            }
                                        }

                                    })
                                }
                            </script>
                        </div>

                        <div class='letter'style="padding: 8px;">
                            评分数量
                        </div>
                        <div class='letter'style="padding: 8px;" onclick="numsc({{$data['id']}})">
                            <span id="bbb5{{$data['id']}}" style="background-color: #f2f2f2;">{{$data['f_score_num']}}</span>
                            <input type="text" value="{{$data['f_score_num']}}" style="display: none;width: 70%;" id="aaa5{{$data['id']}}"
                                   onblur="nums({{$data['id']}})">
                            <script>
                                function numsc(id){
                                    document.getElementById('aaa5'+id).style.display='block';//显示input
                                    document.getElementById('bbb5'+id).innerHTML="";//span标签的值设置为空
                                }
                                function nums(id){
                                    var username = document.getElementById('aaa5'+id).value;//获取文本框的值
                                    $.ajax({
                                        type:'GET',//请求方式
                                        data:{'id':id,'username':username},//传递参数
                                        url:"{{url('/apps/nums')}}",//地址
                                        success:function(e){//回调
                                            if(e==1){
                                                document.getElementById('aaa5'+id).style.display = 'none';//如果修改成功,input隐藏
                                                document.getElementById('bbb5'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                            }else{
                                                alert('修改失败');
                                                window.location.reload();
                                            }
                                        }

                                    })
                                }
                            </script>

                        </div>
                        <div class='letter'style="padding: 8px;">
                            描述
                        </div>
                        <div class='letter' style="width: 294%;padding: 8px;" onclick="briefs({{$data['id']}})">

                            <span id="bbb6{{$data['id']}}" style="background-color: #f2f2f2;width: 100%;
                                                                    height: 72px;
                                                                    text-overflow: ellipsis;
                                                                    -webkit-line-clamp: 4;
                                                                    display: -webkit-box;
                                                                    overflow: hidden;
                                                                    -webkit-box-orient: vertical;">{{$data['f_brief']}}</span>
                            <input type="text" value="{{$data['f_brief']}}" style="display: none;height: 60px;" id="aaa6{{$data['id']}}"
                                   onblur="brief({{$data['id']}})">
                            <script>
                                function briefs(id){
                                    document.getElementById('aaa6'+id).style.display='block';//显示input
                                    document.getElementById('bbb6'+id).innerHTML="";//span标签的值设置为空
                                }
                                function brief(id){
                                    var username = document.getElementById('aaa6'+id).value;//获取文本框的值
                                    $.ajax({
                                        type:'GET',//请求方式
                                        data:{'id':id,'username':username},//传递参数
                                        url:"{{url('/apps/brief')}}",//地址
                                        success:function(e){//回调
                                            if(e==1){
                                                document.getElementById('aaa6'+id).style.display = 'none';//如果修改成功,input隐藏
                                                document.getElementById('bbb6'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                            }else{
                                                alert('修改失败');
                                                window.location.reload();
                                            }
                                        }

                                    })
                                }
                            </script>
                        </div>

                    </div>

                </div>

            <script>
                function saveuser(id){
                    document.getElementById('aaa'+id).style.display='block';//显示input
                    document.getElementById('bbb'+id).innerHTML="";//span标签的值设置为空
                }
            </script>
            <script>
                function edituser(id){
                    var username = document.getElementById('aaa'+id).value;//获取文本框的值
                    $.ajax({
                        type:'GET',//请求方式
                        data:{'id':id,'username':username},//传递参数
                        url:"{{url('/apps/editj')}}",//地址
                        success:function(e){//回调
                            console.log(e);
                            if(e==1){
                                document.getElementById('aaa'+id).style.display = 'none';//如果修改成功,input隐藏
                                document.getElementById('bbb'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                            }else{
                                alert('修改失败');
                                window.location.reload();
                            }
                        }

                    })
                }
            </script>
            </div>

            <!-- 预览图    。。-->
            <div class="server-panel panel panel-default">
                <div class="panel-header">预览图</div>
                <hr>
                <div class="panel-body clearfix" style="border: 1px solid #000000;background-color: #f2f2f2;">

                    <div style="width: 100%;">
                        <div  style="width: 260px;height: 120px;border-radius: 4px;margin-right: 10px; ">
                            <form method="post" enctype="multipart/form-data" action="/apps/uploadsimgs/{{$data['id']}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" style="display: none;">
                                <img src="{{$data['img']}}" alt=""  class="file" style="width: 100%;" >
                                <div class="role" onclick="file(this)">
                                    <img src="" alt="" id="goods_1" class="file" style="width: 100%;"  >
                                    <span style="color: #ccc;">上传图像</span>
                                    <input type="file"  name="goods_imgs[]" class="file" value="" id="goods1" onchange="le(this)">
                                </div>
                                <div class="role" style="display: none" onclick="file(this)">
                                    <img src="" alt="" id="goods_2"  class="file" style="width: 100%;>
                                    <span style="color: #cccccc;">上传图像</span>
                                    <input type="file"  name="goods_imgs[]" class="file" value="" id="goods2" onchange="le(this)">
                                </div>

                                <div class="role" onclick="copy(this)">
                                    <span style="color: #ccc;">+</span>
                                </div>
                                <button type="submit">提交</button>
                            </form>
                            {{--<img src="{{$data['img']}}" style="width: 240px;height: 120px;">
                            <img src="{{$data['img1']}}" style="width: 240px;height: 120px;margin-left: 255px;margin-top: -120px;">
                            <form action="/apps/imgs/{{$data['id']}}" method="post" enctype="multipart/form-data" style="width: 185px;margin-top: -32px;margin-left: 40px;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" style="display: none;">
                                <input type="file"  name="file"  style=" width:70px;display:inline-block;line-height:25px;margin-top:-50px;border-radius:4px;height:25px; text-align:center; color: #4395FF;margin-left: 470px;border:1px solid #F2F2F2;">
                                <input type="submit"  value="提交" style=" width:70px;display:inline-block;line-height:25px;border-radius:4px;height:25px; text-align:center;letter-spacing: 3px;margin-left:470px;margin-top:-14px;nborder:none;border:1px dashed #8f94a1;cursor:pointer; color: #ffffff;background-color:  #4395FF;">
                            </form>--}}
                            <script>
                                //点击圆框时上传图片
                                function file(evn) {
                                    var img_obj = $(evn).children(".file")
                                    var file_id = $(img_obj[1]).attr("id")
                                    document.getElementById(file_id).click()
                                }
                                //点击时复制角色框
                                function copy(evn) {
                                    var obj = $(evn).prev();
                                    var num =  $(".role").length
                                    console.log(num)
                                    $(obj).clone().insertBefore(evn);
                                    $(obj).css("display","block")
                                    var img_obj = $(obj).children(".file")
                                    console.log(img_obj)
                                    var img_id = $(img_obj[0]).attr("id","goods_"+num)
                                    var file_id = $(img_obj[1]).attr("id","goods"+num)
                                }
                                //左侧图像点击时显示图像
                                function le(evn){
                                    var id = $(evn).attr('id');//获取id
                                    var num = "goods_"+id.substr(5,1);
                                    var file = event.target.files[0];
                                    if (window.FileReader) {
                                        var reader = new FileReader();
                                        reader.readAsDataURL(file);
                                        //监听文件读取结束后事件
                                        reader.onloadend = function (e) {
                                            var divObj= $(evn).prev()  //获取div的DOM对象
                                            $(divObj).html("") //插入文件名
                                            $("#"+num).css("display","block");
                                            $("#"+num).attr("src",e.target.result);    //e.target.result就是最后的路径地址


                                        };
                                    }

                                }
                            </script>
                        </div>
                    </div>

                </div>
            </div>

            <!--安装信息-->
            <div class="server-panel panel panel-default">
                <div class="panel-header">安装信息</div>
                <hr>
                <div class="panel-body clearfix" style="border: 1px solid #000000;">
                    <div class="wrapper">
                        <div class="letter" style="padding: 8px;">
                            标题
                        </div>

                        <div class="letter"style="padding: 8px;"  onclick="atitle({{$data['id']}})" >
                            <span id="bbb7{{$data['id']}}" style="background-color: #f2f2f2;">{{$data['a_title']}}</span>
                            <input type="text" value="{{$data['a_title']}}" style="display: none;" id="aaa7{{$data['id']}}"
                                   onblur="atitlea({{$data['id']}})">
                            <script>
                                function atitle(id){
                                    document.getElementById('aaa7'+id).style.display='block';//显示input
                                    document.getElementById('bbb7'+id).innerHTML="";//span标签的值设置为空
                                }
                                function atitlea(id){
                                    var username = document.getElementById('aaa7'+id).value;//获取文本框的值
                                    $.ajax({
                                        type:'GET',//请求方式
                                        data:{'id':id,'username':username},//传递参数
                                        url:"{{url('/apps/atitle')}}",//地址
                                        success:function(e){//回调
                                            if(e==1){
                                                document.getElementById('aaa7'+id).style.display = 'none';//如果修改成功,input隐藏
                                                document.getElementById('bbb7'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                            }else{
                                                alert('修改失败');
                                                window.location.reload();
                                            }
                                        }

                                    })
                                }
                            </script>
                        </div>

                        <div class='letter'style="padding: 8px;">
                            组织名称
                        </div>
                        <div class='letter'style="padding: 8px;" onclick="aname({{$data['id']}})">
                            <span id="bbb8{{$data['id']}}" style="background-color: #f2f2f2;">{{$data['a_name']}}</span>
                            <input type="text" value="{{$data['a_name']}}" style="display: none; width: 200px;" id="aaa8{{$data['id']}}"
                                   onblur="anames({{$data['id']}})">
                            <script>
                                function aname(id){
                                    document.getElementById('aaa8'+id).style.display='block';//显示input
                                    document.getElementById('bbb8'+id).innerHTML="";//span标签的值设置为空
                                }
                                function anames(id){
                                    var username = document.getElementById('aaa8'+id).value;//获取文本框的值
                                    $.ajax({
                                        type:'GET',//请求方式
                                        data:{'id':id,'username':username},//传递参数
                                        url:"{{url('/apps/aname')}}",//地址
                                        success:function(e){//回调
                                            if(e==1){
                                                document.getElementById('aaa8'+id).style.display = 'none';//如果修改成功,input隐藏
                                                document.getElementById('bbb8'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                            }else{
                                                alert('修改失败');
                                                window.location.reload();
                                            }
                                        }

                                    })
                                }
                            </script>
                        </div>

                        <div class="letter" style="padding: 8px;">
                            下载设备数量
                        </div>

                        <div class="letter"style="padding: 8px;"  >
                            <span  style="background-color: #f2f2f2;">{{$data['a_down']?$data['a_down']:'0'}} 次</span>

                        </div>

                        <div class="letter" style="padding: 8px;">
                            下载设备限制
                        </div>

                        <div class="letter"style="padding: 8px;" onclick="limitnum({{$data['id']}})" >
                            <span id="bbb9{{$data['id']}}" style="background-color: #f2f2f2;">{{$data['a_down_limit']?$data['a_down_limit']:'0'}}次</span>
                            <input type="text" value="{{$data['a_down_limit']}}" style="display: none; width: 200px;" id="aaa9{{$data['id']}}"
                                   onblur="limitnums({{$data['id']}})">
                            <script>
                                function limitnum(id){
                                    document.getElementById('aaa9'+id).style.display='block';//显示input
                                    document.getElementById('bbb9'+id).innerHTML="";//span标签的值设置为空
                                }
                                function limitnums(id){
                                    var username = document.getElementById('aaa9'+id).value;//获取文本框的值
                                    $.ajax({
                                        type:'GET',//请求方式
                                        data:{'id':id,'username':username},//传递参数
                                        url:"{{url('/apps/limitnum')}}",//地址
                                        success:function(e){//回调
                                            if(e==1){
                                                document.getElementById('aaa9'+id).style.display = 'none';//如果修改成功,input隐藏
                                                document.getElementById('bbb9'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                            }else{
                                                alert('修改失败');
                                                window.location.reload();
                                            }
                                        }

                                    })
                                }
                            </script>
                        </div>


                        <div class='letter'style="padding: 8px;">
                            描述
                        </div>
                        <div class='letter' style="width: 294%;padding: 8px;" onclick="adesc({{$data['id']}})">
                            <span id="bbb11{{$data['id']}}" style="background-color: #f2f2f2;width: 100%;
                                                                     height: 72px;
                                                                     text-overflow: ellipsis;
                                                                     -webkit-line-clamp: 4;
                                                                     display: -webkit-box;
                                                                     overflow: hidden;
                                                                     -webkit-box-orient: vertical;">{{$data['a_desc']}}</span>
                            <input type="text" value="{{$data['a_desc']}}" style="display: none;height: 60px;" id="aaa11{{$data['id']}}"
                                   onblur="adescs({{$data['id']}})">
                            <script>
                                function adesc(id){
                                    document.getElementById('aaa11'+id).style.display='block';//显示input
                                    document.getElementById('bbb11'+id).innerHTML="";//span标签的值设置为空
                                }
                                function adescs(id){
                                    var username = document.getElementById('aaa11'+id).value;//获取文本框的值
                                    $.ajax({
                                        type:'GET',//请求方式
                                        data:{'id':id,'username':username},//传递参数
                                        url:"{{url('/apps/adesc')}}",//地址
                                        success:function(e){//回调
                                            if(e==1){
                                                document.getElementById('aaa11'+id).style.display = 'none';//如果修改成功,input隐藏
                                                document.getElementById('bbb11'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                            }else{
                                                alert('修改失败');
                                                window.location.reload();
                                            }
                                        }

                                    })
                                }
                            </script>

                        </div>

                    </div>
                </div>
                <script>
                    function saveuser(id){
                        document.getElementById('aaa'+id).style.display='block';//显示input
                        document.getElementById('bbb'+id).innerHTML="";//span标签的值设置为空
                    }
                    function edituser(id){
                        var username = document.getElementById('aaa'+id).value;//获取文本框的值
                        $.ajax({
                            type:'GET',//请求方式
                            data:{'id':id,'username':username},//传递参数
                            url:"{{url('apps/editj')}}",//地址
                            success:function(e){//回调
                                if(e==1){
                                    document.getElementById('aaa'+id).style.display = 'none';//如果修改成功,input隐藏
                                    document.getElementById('bbb'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                }else{
                                    alert('修改失败');
                                    window.location.reload();
                                }
                            }

                        })
                    }
                </script>
            </div>

            <!-- 软件管理-->
            <div class="server-panel panel panel-default">
                <div class="panel-header">软件信息</div>
                <hr>
                <div class="panel-body clearfix" style="border: 1px solid #000000;">
                    <div class="wrapper">
                        <div class="letter" style="padding: 8px;">
                            安装地址
                        </div>

                        <div class="letter"style="padding: 8px;"  >
                            <p style="width: 100px;height: 25px;border:1px solid #4395FF;font-size: 16px;border-radius: 4px;text-align: center;line-height: 25px;color: red; height: 25px;">
                                <a href="/{{$data['id']}}" target="_blank" style="color: #4395FF;"> 打开</a></p>
                        </div>

                        <div class='letter'style="padding: 8px;">
                            二维码
                        </div>
                        <div class='letter'style="padding: 8px;">
                            <div style="width: 235px;margin-left:13px;margin-top:5px;height: 30px;">
                                <img src="{{$data['a_qr']}}" style="width: 30px;height:30px;">
                                <form action="/apps/eq/{{$data['id']}}" method="post" enctype="multipart/form-data" style="width: 185px;margin-top: -32px;margin-left: 40px;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" style="display: none;">
                                    <input type="file" name="file" style=" width:70px;display:inline-block;line-height:25px;margin-top:5px;border-radius:4px;height:25px; text-align:center; color: #4395FF;margin-left: 30px;border:1px solid #F2F2F2;">
                                    <input type="submit" value="提交" style=" width:70px;display:inline-block;line-height:25px;border-radius:4px;height:25px; text-align:center;letter-spacing: 3px;border:none;border:1px dashed #8f94a1;cursor:pointer; color: #ffffff;background-color:  #4395FF;">


                                </form>
                            </div>
                        </div>

                        <div class="letter" style="padding: 8px;">
                            使用邀请码
                        </div>

                        <div class="letter"style="padding: 8px;"  >

                            <div class="letter layui-form-radio ">
                                @if($data['a_c_ation']==1)
                                    <input type="checkbox" name="sex" id="male" />
                                    <label for="male"></label>
                                @else
                                    <input type="checkbox" name="sex" id="male" />
                                    <label for="male"></label>
                                @endif

                                {{-- <input type="text" value="{{$info['status'] or '1'}}" name="status" placeholder="当状态值为1的时候正常，0为停用" autocomplete="off" class="layui-input">--}}
                            </div>
                        </div>

                        <div class="letter" style="padding: 8px;">
                            查看邀请码
                        </div>

                        <div class="letter"style="padding: 8px;"  >
                            <p style="width: 100px;height: 25px;border:1px solid #4395FF;font-size: 16px;border-radius: 4px;text-align: center;line-height: 25px;color: #width: 100px;height: 25px;border:1px solid #4395FF;">
                                <a href="" style="color: #4395FF;">查看</a></p>
                        </div>

                        <div class="letter" style="padding: 8px;">
                            更新
                        </div>

                        <div class="letter"style="padding: 8px;"  >
                            <p style="width: 100px;height: 25px;border:1px solid #4395FF;font-size: 16px;border-radius: 4px;text-align: center;line-height: 25px;color: #width: 100px;height: 25px;border:1px solid #4395FF;">
                                <a href="" style="color: #4395FF;"> 更新软件</a></p>

                        </div>

                        <div class="letter" style="padding: 8px;">
                            删除
                        </div>

                        <div class="letter"style="padding: 8px;"  >
                             <p style="width: 100px;height: 25px;border:1px solid red;font-size: 16px;border-radius: 4px;text-align: center;line-height: 25px;color: red; height: 25px;">
                                 <a href="/apps/del/{{$data['id']}}" style="color: red;"> 删除软件</a></p>
                        </div>
                    </div>

                </div>
                <script>
                    function saveuser(id){
                        document.getElementById('aaa'+id).style.display='block';//显示input
                        document.getElementById('bbb'+id).innerHTML="";//span标签的值设置为空
                    }
                    function edituser(id){
                        var username = document.getElementById('aaa'+id).value;//获取文本框的值
                        $.ajax({
                            type:'GET',//请求方式
                            data:{'id':id,'username':username},//传递参数
                            url:"{{url('apps/editj')}}",//地址
                            success:function(e){//回调
                                if(e==1){
                                    document.getElementById('aaa'+id).style.display = 'none';//如果修改成功,input隐藏
                                    document.getElementById('bbb'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                                }else{
                                    alert('修改失败');
                                    window.location.reload();
                                }
                            }

                        })
                    }
                </script>
            </div>


        </div>
        {{--<div class="welcome-edge col-lg-3">
            <!--联系-->
            <div class="panel panel-default contact-panel">
                <div class="panel-header">联系我</div>
                <div class="panel-body">
                    <p>QQ：</p>
                    <p>E-mail:@qq.com</p>
                </div>
            </div>
        </div>--}}
    </div>
</div>


@section('js')
@endsection
@extends('common.list')