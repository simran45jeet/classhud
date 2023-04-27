<?php
function fileUpload($path, $type=IMAGE_UPLOAD_TYPES, $filename, $size="",$resize_image=true,$upload_name=""){   
    $type=empty($type)?IMAGE_UPLOAD_TYPES:$type;
    $path = rtrim($path,'/');
    $ci =& get_instance();
    $Imagesize['width']=explode(',', $size)[0];
    $Imagesize['height']=explode(',', $size)[1];
    
    $ext = pathinfo($_FILES[$filename]['name'], PATHINFO_EXTENSION);
    if($ext=='jpeg' && false) {
        if( empty($upload_name) ){
            $file_name = time().rand(3,6).str_replace('.'.$ext, '', $_FILES[$filename]['name']);
        }else{
            $file_name = $upload_name;
        }
        convertImage($ext, $_FILES[$filename]['tmp_name'], './'.$path.'/'.$file_name.'.png', 9);
        return ['success'=> 'true','filename'=>$file_name.'.png', 'oldname' => $_FILES[$filename]['name']];
    } else {
        if (!is_dir($path)) {
            $old_umask = umask(0);
            mkdir('./'.$path, 0775, true);
            umask($old_umask);
        }
        $maxFileSize = 1048576 * MAX_FILE_UPLOAD_SIZE ;//Mb in bytes
        $fileSize = $_FILES[$filename]['size'];
        $config=[
            'upload_path'=> './'.$path,
            'allowed_types'=> $type,
            'encrypt_name'=>true,
        ];
        if( !empty($upload_name) ) {
            $config['file_name'] = $upload_name;
            $config['encrypt_name'] = false;
            $config['overwrite'] = true;
        }

        $imageQality = 0;
        if($fileSize > $maxFileSize)
        {
            $percentDiff =  ($maxFileSize / $fileSize) * 100;
            $imageQality =   $percentDiff;
        }
        $ci->load->library('upload');
        $ci->upload->initialize($config);
        if($ci->upload->do_upload($filename)){
            $fileInfo = $ci->upload->data('file_name');

            /*
            $upload_data = $ci->upload->data();

            $config2['image_library'] = 'GD2';
            $config2['source_image'] = $_FILES[$filename]['tmp_name'];
            // $config2['create_thumb'] = TRUE;
            // $config2['maintain_ratio'] = TRUE;
            $config2['width'] = $Imagesize['width'];
            $config2['height'] = $Imagesize['height'];
            $ci->load->library('image_lib', $config2); 

            $resizeImage = $ci->image_lib->resize();
            if($imageQality)
            {
                compress('./'.$path.'/'.$fileInfo, './'.$path.'/'.$fileInfo, $imageQality);
            }
            if($resize_image) {
                createDiffSizedImages($path, $fileInfo);
            }
            */
            return ['success'=> 'true','filename'=> $fileInfo, 'oldname' => $_FILES[$filename]['name']];
        }else{
            return ['error'=> $ci->upload->display_errors()];
        }
    }
}

function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);
    if($image)
    {
        imagejpeg($image, $destination, $quality);
    }

    return $destination;
}

function convertImage($ext, $source, $outputImage, $quality)
{
    if (preg_match('/jpg|jpeg/i',$ext))
        $imageTmp=imagecreatefromjpeg($source);
    else if (preg_match('/gif/i',$ext))
        $imageTmp=imagecreatefromgif($source);
    else if (preg_match('/bmp/i',$ext))
        $imageTmp=imagecreatefrombmp($source);
    else
        return 0;
    // quality is a value from 0 (worst) to 9 (best)
    imagepng($imageTmp, $outputImage, $quality);
    imagedestroy($imageTmp);

    return 1;
}

function fileDelete($filePath)
{
    //$filePath = './'.$filePath;
    $return = False;
    if(is_file($filePath))
    {
        try{
            unlink($filePath);
            $return = true;
        }
        catch(Exception $e )
        {
            
        }
    }
    return $return;
}

function createDiffSizedImages($path, $image){
    $ci =& get_instance();
    $ci->load->library('image_lib');
    foreach(StaticArrays::$imageSizes as $name=>$size){
        $resize_config = array(
            'image_library' => 'gd2',
            'source_image'  => './'.$path.$image,
            'new_image'     => './'.$path.$size[0].'x'.$size[1].'_'.$image,
            'maintain_ratio' => TRUE,
            'width' => $size[0],
            'height' => $size[1],
        ); 
        $ci->image_lib->initialize($resize_config);
        $ci->image_lib->resize();
        $ci->image_lib->clear();
    }
}


function fileUploadFromUrl($imagePath,$path){
    $imgName = preg_replace('/^.+[\\\\\\/]/', '', $imagePath); 
    $ext = pathinfo($imagePath, PATHINFO_EXTENSION); 
    $file_name = time().rand(3,6). $imgName;
    $file_name1 = time().rand(3,6).str_replace('.'.$ext, '', $imgName);  
    $img =  './'.$path.'/'.$file_name;
    $result =  file_put_contents($img, file_get_contents($imagePath));  
    $size = filesize( $img );
    $files =  ['name'=>$file_name,'type'=>$ext,'tmp_name'=>$img,'error'=>0,'size'=>$size];
    $fileTYpes = explode('|',IMAGE_UPLOAD_TYPES);
    if(!in_array($ext, $fileTYpes)){
        return ['success'=> 'false','error'=>'wrong file fromat']; 
    }  
    if($ext=='jpg' || $etx == 'jpeg') {
        $file_name = $file_name1;
        convertImage($ext,  $files['tmp_name'], './'.$path.'/'.$file_name.'.png', 9);
        return ['success'=> 'true','filename'=>$file_name.'.png'];
    }
    else {
        if (!is_dir($path)) {
            $old_umask = umask(0);
            mkdir('./'.$path, 0775, true);
            umask($old_umask);
        }
        $maxFileSize = 1048576 * MAX_FILE_UPLOAD_SIZE ;//Mb in bytes
        $fileSize = $files['size'];
       
        $imageQality = 0;
        if($fileSize > $maxFileSize)
        {
            $percentDiff =  ($maxFileSize / $fileSize) * 100;
            $imageQality =   $percentDiff;
        }
        
        $fileInfo =  $file_name;
            if($imageQality)
            {
                compress('./'.$path.'/'.$fileInfo, './'.$path.'/'.$fileInfo, $imageQality);
            }
            createDiffSizedImages($path, $fileInfo);
            return ['success'=> 'true','filename'=>$fileInfo];
            
    
    }
}


function tempUpload($type, $filename, $size=""){
    $tempUpload = fileUpload(TEMP_UPLOAD_FOLDER, $type, $filename, $size="");
    if(!empty($tempUpload['success'])){
        $response['flag'] = 1;
        $response['oldname'] = $tempUpload['oldname'];
        $response['file'] = $tempUpload['filename'];
        $response['path'] = TEMP_UPLOAD_FOLDER.$tempUpload['filename'];
        $response['message'] = 'successfully uploaded.';
    }else{
        $response['flag'] = 0;
        $response['message'] = $tempUpload['error'];
    }
    return $response;
}