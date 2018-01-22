<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>LayUI 上传图片</title>
    <script type="text/javascript" src="layui/layui.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="layui/css/layui.css" />
</head>
<style>

    body{
        margin: 100px 30px;
    }
    body h1{
        text-align:center;
        margin: 100px auto;
    }
    .layui-upload img{
        display: block;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        margin-left: 100px;
        -webkit-border-radius: 50%;
        border: 4px solid #44576B;
    }
</style>
<body>

    <h1>LayUI 上传图片 示例 </h1>


    <div class="layui-form-item">
        <div class="layui-upload">
            <button type="button" name="img_upload" class="layui-btn btn_upload_img">
                <i class="layui-icon">&#xe67c;</i>上传图片
            </button>
            <img class="layui-upload-img img-upload-view" src="upload/dog.jpg">
            <p id="demoText"></p>
        </div>
    </div>
    <!--如果使用的是Laravel框架，打开下面这句话！-->
    <!--<input type="hidden" name="_token" class="tag_token" value="<?php /*echo csrf_token(); */?>">-->

</body>

<script type="text/javascript">
    layui.use('upload', function(){
        var upload = layui.upload;
        var tag_token = $(".tag_token").val();
        //普通图片上传
        var uploadInst = upload.render({
            elem: '.btn_upload_img'
            ,type : 'images'
            ,exts: 'jpg|png|gif' //设置一些后缀，用于演示前端验证和后端的验证
            //,auto:false //选择图片后是否直接上传
            //,accept:'images' //上传文件类型
            ,url: 'upload.php'
            ,data:{'_token':tag_token}
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('.img-upload-view').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.status == 1){
                    return layer.msg('上传成功');
                }else{//上传成功
                    layer.msg(res.message);
                }
            }
            ,error: function(){
                //演示失败状态，并实现重传
                return layer.msg('上传失败,请重新上传');
            }
        });
    });
</script>

</html>