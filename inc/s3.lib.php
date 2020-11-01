<?php
include_once(ROOTPATH.'inc/s3_lib/aws-autoloader.php');

define('S3_Key', 'OWb4dNrsyEwkbdh9rKvm');        //Access Key ID
define('S3_Secret_Key', 'YytQmmZacUnMSur0NAhWXQtZic4P93FLdN7FIhhc');    //Secret Key
define('S3_Region', 'kr-standard');        //S3 버킷의 리전.
define('S3_Bucket', 'isupport');            //버킷의 이름.


use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Aws\S3\Model\MultipartUpload\UploadBuilder;

/**
 * org_path : $_FILES['temp']['name']?
 * s3_path : 저장경로 및 파일명(sol2/upload/test.jpg)
 */
function s3_upload($org_path,  $s3_path,  $s3_bucket = S3_Bucket  , $org_filr_del=false ){

	$source = $org_path;
	$target = $s3_path;

    $config = array(
        'credentials' => array(
									'key' => S3_Key,
									'secret' => S3_Secret_Key
								),
        'region' => S3_Region,
		'endpoint' => 'https://kr.object.ncloudstorage.com',
        'version' => 'latest');
 
    $client = S3Client::factory($config);
    
    $result = $client->putObject(array(
            'Bucket'     => $s3_bucket,
            'SourceFile' => $source,
            'Key'        => $target,
			'ACL'    => 'public-read'
    ));
	
	if($org_filr_del){
		@unlink($source);
	}
	return $result;

}

function s3_del( $s3_path,  $s3_bucket = S3_Bucket  ){

	$objectName = $s3_path ;

    $config = array(
        'credentials' => array(
									'key' => S3_Key,
									'secret' => S3_Secret_Key
								),
        'region' => S3_Region,
		'endpoint' => 'https://kr.object.ncloudstorage.com',
        'version' => 'latest');
 
    $client = S3Client::factory($config);

	$obj = array('Bucket' => $s3_bucket, 'Key' => $objectName);
    $result = $client->deleteObject($obj);
	return $result;

}

function s3_getfile( $s3_path ){

//	$objectName = $s3_path.$filename;
    $objectName = $s3_path;

    $config = array(
        'credentials' => array(
                                    'key' => S3_Key,
                                    'secret' => S3_Secret_Key
                                ),
        'region' => S3_Region,
        'endpoint' => 'https://kr.object.ncloudstorage.com',
        'version' => 'latest');
    
    $client = S3Client::factory($config);

    $result = $client->getObject([
        'Bucket' => S3_Bucket,
        'Key'    => $objectName
    ]);


//	header("Content-Type: {$result['ContentType']}");
//    echo $result['Body'];
//	
//	if($result['Body']){
//		$return_text = "data:".$result['ContentType'].";base64,".base64_encode($result['Body']);
//	}else{
//		$return_text = 0;
//	}
//
//	return $return_text;

    return $result;

}

function s3_getfile_b( $s3_path ){

    $objectName = $s3_path.$filename;

    $config = array(
        'credentials' => array(
                                    'key' => S3_Key,
                                    'secret' => S3_Secret_Key
                                ),
        'region' => S3_Region,
        'endpoint' => 'https://kr.object.ncloudstorage.com',
        'version' => 'latest');
    
    $client = S3Client::factory($config);

    $result = $client->getObject([
        'Bucket' => S3_Bucket,
        'Key'    => $objectName
    ]);

    return $result;

//	header("Content-Type: {$result['ContentType']}");
//    echo $result['Body'];

}

// 업로드 파일명 및 확장자 체크
function getAWSFileName($file_name, $isImg=true, $wantExt=array()) {
    $exp_file=explode('.', $file_name);
    $ext = array_pop($exp_file);
    $result=array();
    if(count($wantExt)>0) {
        if(!in_array($ext, $wantExt)) $result['err_msg']="다음 확장자만 업로드 가능합니다.<br>(".implode(",", $wantExt).")";
    }
    else if($isImg) {
        $imgExt=array('jpg', 'jpeg', 'png', 'gif');
        if(!in_array($ext, $imgExt)) $result['err_msg']="이미지 확장자만 업로드 가능합니다.<br>(".implode(",", $imgExt).")";
    }
    $str_random='';
    $strs='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $len=5;
    while($len--) {
        $str_random .= $strs[mt_rand(0, strlen($strs)-1)];
    }
    $result['file']=AWS_UPLOAD_DIR.'/'.$str_random.time().'.'.$ext;
    return $result;
}
    
?>