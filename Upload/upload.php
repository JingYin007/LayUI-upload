<?php


$status = 0;
$message = '';

if ($_POST) {
    //上传图片具体操作
    $file_name = $_FILES['file']['name'];
    //$file_type = $_FILES["file"]["type"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_error = $_FILES["file"]["error"];
    $file_size = $_FILES["file"]["size"];

    if ($file_error > 0) { // 出错
        $message = $file_error;
    } elseif($file_size > 1048576) { // 文件太大了
        $message = "上传文件不能大于1MB";
    }else{
        $file_name_arr = explode('.', $file_name);
        $new_file_name = date('YmdHis') . '.' . $file_name_arr[1];
        $file_path = "upload/" . $new_file_name;
        if (file_exists($file_path)) {
            $message = "此文件已经存在啦";
        } else {
            $upload_result = move_uploaded_file($file_tmp, $file_path); // 此函数只支持 HTTP POST 上传的文件
            if ($upload_result) {
                $status = 1;
                $message = $file_path;
            } else {
                $message = "文件上传失败，请稍后再尝试";
            }
        }
    }
} else {
    $message = "参数错误";
}
return showMsg($status, $message);





function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status' => $status,
        'message' =>$message,
        'data' =>$data
    );
    exit(json_encode($result));
}