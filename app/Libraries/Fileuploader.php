<?php
namespace App\Libraries;

class Fileuploader {
    private $sFundingUpFolder;
    function __construct($arg=array()) {
        $this->sFundingUpFolder = $arg[0]?$arg[0]:UPLOAD_DIR;
    }
    function fileImgUpload($fileData, $psTitleName, $pbIsImgFile = true, $wantExtensions='') { 
        
        $PR_file = "";
        $PR_file_org = "";
    
        if ($fileData['tmp_name']){
    
            if($fileData['error']) {
                $this->fileAllDelete();
                return array("status" => -1, "msg" => "파일 업로드 중 에러가 발생했습니다.(".$fileData['error'].")");
            }

            if($pbIsImgFile || $wantExtensions) {
                $res=$this->_cFile_ext_check($fileData['name'], $psTitleName, $wantExtensions);
                if($res) return $res;
            }
    
            $iPos = strrpos(basename($fileData['name']), ".");
            $extension = substr(basename($fileData['name']), $iPos); 
            
            // == 파일 이름 생성
            $iCount = 0;
            $iNameLen = 40;
            while(true) {
                $sFileName_temp = $this->_cRandomCharacter_get("numberEngAll", $iNameLen) . $extension;
                if(!file_exists($this->sFundingUpFolder .'/'. $sFileName_temp)) {
                    break;
                }
                if($iCount > 10000) $iNameLen++;
                $iCount++;
            }		
    
            $result = copy($fileData["tmp_name"], $this->sFundingUpFolder .'/'. $sFileName_temp ) ;
    
            if(!$result) {
                $this->fileAllDelete();
                return array("status" => -1, "msg" => "파일 업로드 중 에러가 발생했습니다.(directory path)");
            }
    
            $PR_file = $this->sFundingUpFolder.'/'.$sFileName_temp;
            $PR_file = str_replace('/home/sol/public_html', '', $PR_file);
            $PR_file = str_replace($_SERVER['DOCUMENT_ROOT'], '', $PR_file);
            $PR_file = str_replace('//', '/', $PR_file);

            $PR_file_org = $fileData['name']; // 한글파일인 경우 인코딩 하기   
        }
        
        return array('file_name'=>$PR_file, 'file_name_org'=>$PR_file_org);
    }
    
    
    function fileMultyUpload($fileData, $psTitleName, $existsFiles, $existsFilesOrg=array(), $pbIsImgFile = true, $wantExtensions='') {    
        $sResultName = array();
        $sResultNameOrg = array();
    
        for($i1 = 0; $i1 < count($fileData['tmp_name']); $i1 ++) {
            
            if ($fileData['tmp_name'][$i1]){
    
                if($fileData['error'][$i1]) {
                    $this->fileAllDelete();
                    return array("status" => -1, "msg" => "파일 업로드 중 에러가 발생했습니다.(".$fileData['error'][$i1].")");
                    break;
                }
    
                if($pbIsImgFile || $wantExtensions) {
                    $res=$this->_cFile_ext_check($fileData['name'][$i1], $psTitleName, $wantExtensions);
                    if($res) {
                        return $res;
                        break;
                    }
                }
    
    
                $iPos = strrpos(basename($fileData['name'][$i1]), ".");
                $extension = substr(basename($fileData['name'][$i1]), $iPos); 
    
    
                // == 파일 이름 생성
                $iCount = 0;
                $iNameLen = 40;
                while(true) {
                    $sFileName_temp = $this->_cRandomCharacter_get("numberEngAll", $iNameLen) . $extension;
                    if(!file_exists($this->sFundingUpFolder .'/'. $sFileName_temp)) {
                        break;
                    }
                    if($iCount > 10000) $iNameLen++;
                    $iCount++;
                }		
    
                $result = copy($fileData["tmp_name"][$i1], $this->sFundingUpFolder .'/'. $sFileName_temp ) ;
    
                if(!$result) {
                    $this->fileAllDelete();
                    return array("status" => -1, "msg" => "파일 업로드 중 에러가 발생했습니다(copy).");
                    break;
                }
    
                $PR_file = $this->sFundingUpFolder.'/'.$sFileName_temp;
                $PR_file = str_replace('/home/sol/public_html', '', $PR_file);
                $PR_file = str_replace($_SERVER['DOCUMENT_ROOT'], '', $PR_file);
                $PR_file = str_replace('//', '/', $PR_file);
                $sResultName[] = $PR_file;
                $sResultNameOrg[] = $fileData['name'][$i1]; // 한글파일인 경우 인코딩 하기    
            }
            else if($existsFiles[$i1]!="") {
                $sResultName[] = $existsFiles[$i1];
                $sResultNameOrg[] = $existsFilesOrg[$i1];
            }
        }
        
        // if(count($sResultName) > 0) {
        //     $sResultName = json_encode($sResultName, JSON_UNESCAPED_UNICODE);
        //     $sResultNameOrg = json_encode($sResultNameOrg, JSON_UNESCAPED_UNICODE);
        // }else{
        //     $sResultName = "";
        //     $sResultNameOrg = "";
        // }
    
        return array('file_name'=>$sResultName, 'file_name_org'=>$sResultNameOrg);
    }
    
    function fileCryptoEncode($fileData) {    
        $sResultName = "";
        $sResultKey = "";
        $sResultNameOrg = "";
        
        if ($fileData['tmp_name']){
    
            if($fileData['error']) {
                $this->fileAllDelete();
                return array("status" => -1, "msg" => "파일 업로드 중 에러가 발생했습니다.(".$fileData['error'].")");
            }
            $sFileContent = addslashes(file_get_contents($fileData["tmp_name"]));
            
            $sResultName= $sFileContent;
            $sResultKey =$this->_cRandomCharacter_get("numberEngAll", 40);
            $sResultNameOrg = $fileData['name']; // 한글파일인 경우 인코딩 하기
        }
        
        return array('file_name'=>$sResultName, 'file_name_org'=>$sResultNameOrg);
    }
    
    
    function fileCryptoMultyEncode($fileData) {    
        $sResultName = "";
        $sResultKey = "";
        $sResultNameOrg = "";
        
        for($i1 = 0; $i1 < count($fileData['tmp_name']); $i1 ++) {
            if ($fileData['tmp_name'][$i1]){
    
                if($fileData['error'][$i1]) {
                    $this->fileAllDelete();
                    return array("status" => -1, "msg" => "파일 업로드 중 에러가 발생했습니다.(".$fileData['error'][$i1].")");
                }
                
               
                $sFileContent = addslashes(file_get_contents($fileData["tmp_name"][$i1]));
    
                //$sResultName= cenfunc($sFileContent);
                $sResultName .= $sFileContent . "|@|";
                $sResultKey .=$this->_cRandomCharacter_get("numberEngAll", 40) . "|@|";
                $sResultNameOrg  .= $fileData['name'][$i1] . "|@|"; // 한글파일인 경우 인코딩 하기
            }
        }
        
        $sResultName = substr($sResultName, 0, strlen($sResultName) - 3);
        $sResultKey = substr($sResultKey, 0, strlen($sResultKey) - 3);
        $sResultNameOrg = substr($sResultNameOrg, 0, strlen($sResultNameOrg) - 3);
    
    
        return array('file_name'=>$sResultName, 'file_name_org'=>$sResultNameOrg);
    }
    
    function fileAllDelete($fileData='') {
        return true;
        global $GCApp_ProfileImg, $GCApp_BusinessRegFile, $GCApp_ProjectMainImg;
        global $GCApp_ProjectImg, $GCApp_ProjectFile;
    
    
        @unlink($this->sFundingUpFolder .'/'.$GCApp_ProfileImg);
        @unlink($this->sFundingUpFolder .'/'.$GCApp_BusinessRegFile);
        @unlink($this->sFundingUpFolder .'/'.$GCApp_ProjectMainImg);
        
        if($GCApp_ProjectImg) {
            $GCApp_ProjectImg_arr = json_decode($GCApp_ProjectImg);
            for($i1 = 0; $i1 < count($GCApp_ProjectImg_arr); $i1 ++) {
                @unlink($this->sFundingUpFolder .'/'.$GCApp_ProjectImg_arr[$i1]);
            }
        }
        
        if($GCApp_ProjectFile) {
            $GCApp_ProjectFile_arr = json_decode($GCApp_ProjectFile);
            for($i1 = 0; $i1 < count($GCApp_ProjectFile_arr); $i1 ++) {
                @unlink($this->sFundingUpFolder .'/'.$GCApp_ProjectFile_arr[$i1]);
            }
        }
    }
    
    /**
    * 랜덤한 문자를 리턴합니다..
    */
    function _cRandomCharacter_get($psType, $piTotalLen) {
        $aNumber = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
        $aEngBig = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        $aEngSmall = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
        
    
        $aUseCharacter = array();
        if($psType == "number") {
            $aUseCharacter = $aNumber;
        }elseif($psType == "numberEngBig") {
            $aUseCharacter = array_merge ($aNumber, $aEngBig);
        }elseif($psType == "numberEngAll") {
            $aUseCharacter = array_merge ($aNumber, $aEngBig, $aEngSmall);
        }
    
        $i1 = 0;
        $sValue = "";
        for($i1 = 0; $i1 < $piTotalLen; $i1 ++) {
            $sValue .= $aUseCharacter[mt_rand(0, count($aUseCharacter) - 1)];
        }
    
        return $sValue;
    }
    
    
    /**
    * 파일 확장자 체크
    * -기본 파일이 이미지인지 체크합니다..
    *  
    */
    function _cFile_ext_check($psUploadName, $psTitleName, $wantExtensions='') {
        
        $aImgAllowExtension = array("jpg", "jpeg", "png", "gif"); 
        if($wantExtensions) $aImgAllowExtension = $wantExtensions;
    
        $i1 = strrpos($psUploadName, ".");
    
        if($i1 === false) {
            $this->fileAllDelete();
            return array("status" => -1, "msg" => addslashes("'" . $psTitleName . "'는 (".implode(', ', $aImgAllowExtension).") 파일만 가능합니다."));
        }
    
        $sImgExtension = substr($psUploadName, $i1 + 1); // '확장자' 를 저장합니다.
    
        $b1 = false;
        for($i1 = 0; $i1 < count($aImgAllowExtension); $i1 ++) {
            if($aImgAllowExtension[$i1] == strtolower($sImgExtension)) {
                $b1 = true;
                break;
            }
        }
    
        if(!$b1) {
            $this->fileAllDelete();
            return array("status" => -1, "msg" => addslashes("'" . $psTitleName . "'는 (".implode(', ', $aImgAllowExtension).") 파일만 가능합니다."));
        }
        return false;
    }
}