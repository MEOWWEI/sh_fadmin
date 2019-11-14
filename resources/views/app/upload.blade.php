@section('title', '上传应用')

@section('header')
@endsection


<div class="wrap-container welcome-container">
    <div class="row">
        <div class="welcome-left-container col-lg-9">

            <!--基本信息-->
            <div class="server-panel panel panel-default">
                <div class="panel-header">基础信息</div>
                <hr>
                <div class="panel-body clearfix">

                        <div style="width: 100%;height: 100px; border:1px dashed  #C9C9C9;">
                            <img src="/static/admin/images/upload.jpg" style="margin-left: 46%;margin-top:15px;width: 50px;height: 50px;">

                            <form method="post" action="/apps/file" enctype="multipart/form-data" >
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="file" name="picture">
                                <button type="submit"> 提交 </button>
                            </form>
                            
                        </div>
                    </form>
                </div>
            </div>


    </div>
</div>


@section('js')
@endsection
@extends('common.list')