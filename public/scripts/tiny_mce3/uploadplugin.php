<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
{
    ob_start("ob_gzhandler");
}
define('uploadimg','ta#adfadf');

include("config.php");
include("gpc_function.php");
include "functions_file.php" ;
include("../../../define.php");

$public = FILE_URL;
//config:
if(!isset($folder_img_upload))
{
	$folder_img_upload='upload/';
}

$act			= strtolower(gpc_getStringGet("opt","idx"));
$page  			= gpc_getIntGet("page",1);

$folderP		= trim(gpc_getStringPost("folderP"));
$folderP		= preg_replace("((.*)/(.*)/UP Folder(.*))","$1",$folderP);
$folderP		= preg_replace("((.*)/UP Folder(.*))","",$folderP);
$folderP		= str_replace("..","",$folderP);

if(substr($folderP,strlen($folderP)-1)!="/" &&!empty($folderP))$folderP.="/";
$full_path		= "../../files/".$folder_img_upload.$folderP;

switch($act)
{
	case "listfolder":
		Listfolder($full_path);
		break;

	case "createfolder":
		Creatfolder($full_path);
		break;

	case "upload":
		uploadimg($full_path);
		break;

	case "deletefile":
		deletefile($full_path);
		break;

	case "deletefolder":
		deleteFolder($full_path);
		break;
}

function Listfolder($full_path)
{
global $folder_img_upload,$folderP,$folder_path_root,$public;
global $img_thumb_width, $img_thumb_height;
	$max_height=100;
	$max_width=120;

	$listfolder	= ListFolderByPath($full_path);
	$listfile	= ListFolderByPath($full_path,"file");
    
        sort($listfolder);
    
	echo "(*_*)";
	echo $public.$folder_path_root.$folder_img_upload;
	echo "(*_*)";
	echo $folderP;
	echo "(*_*)";
	if(!empty($folderP))
	{
		echo "UP Folder|";
	}
	foreach($listfolder as $i => $f)
	{
		echo $f."|";
	}
	echo "(*_*)";
	foreach($listfile as $i => $f)
	{
		$pathimg_th=$full_path."thumbs/".$f;
		if(!is_file($pathimg_th))
		{
			@createthumb($full_path.$f,"",$img_thumb_width, $img_thumb_height);
		}
		list($width, $height) =@getimagesize($pathimg_th);
		if($width==0 || $height==0)
		{
			$width=1;
			$height=1;
		}else {
			$ratioh = $max_height/$height;
			$ratiow = $max_width/$width;
			$ratio = min($ratioh, $ratiow);
			// New dimensions
			$width = intval($ratio*$width);
			$height = intval($ratio*$height);
		}

		echo $f."^^".$width."^^".$height."|";
	}
	echo "(*_*)";
}

function Creatfolder($full_path)
{
	$newname	= trim(gpc_getStringPost("foldercreate"));
	$newname	= preg_replace("[\W]","_",$newname);
	$full_path.=$newname;
	if(!is_dir($full_path))
	{
		if(@mkdir($full_path)==false)
		{
			echo '<script>parent.creatfolsuccess(false,"Can not create folder");</script>';
		}else
		{
			echo '<script>parent.creatfolsuccess(true);</script>';
			return true;
		}
	}else
	{
		echo '<script>parent.creatfolsuccess(false,"Folder ('.$newname.') is Exist!");</script>';
	}
	return false;
}
function uploadimg($full_path)
{
global $function_error;

	$ImgFile	= gpc_getFileArray("ImgFile");
	$newname	= gpc_getStringArray("newname");

	$count=0;
	$error_return="";
	for($i=0;$i<count($ImgFile['name']);$i++)
	{
		$imagefile["name"]     = (!empty($newname[$i]))? $newname[$i] : $ImgFile["name"][$i];
		$imagefile["type"]     = $ImgFile["type"][$i];
		$imagefile["size"]     = $ImgFile["size"][$i];
		$imagefile["tmp_name"] = $ImgFile["tmp_name"][$i];

		if(empty($imagefile["name"]))continue;
		$count++;
		if($namefile=upImage($imagefile,$full_path))
		{
			$error_return.=$imagefile["name"]."|ok|Upload Success^^";
		}else
		{
			$error_return.=$imagefile["name"]."|false|$function_error^^";
		}
	}
	if($count==0)
	{
		echo '<script>parent.uploadsuccess(false,"Please choose file to upload!");</script>';
		exit;
	}else
	{
		echo '<script>parent.uploadsuccess(true,"'.$error_return.'");</script>';
		exit;
	}
}

function deletefile($full_path)
{
	$filename	= trim(gpc_getStringPost("file"));
	$path=$full_path.$filename;
	$path_thumb=$full_path."thumbs/".$filename;
	if(is_file($path))
	{
		@unlink($path);
		@unlink($path_thumb);
		echo "(*_*)ok(*_*)Delete file success!(*_*)";
	}else
	{
		echo "(*_*)false(*_*)File not exist!(*_*)";
	}
}

function deleteFolder($full_path)
{
	$fname	= trim(gpc_getStringPost("fname"));
	$path=$full_path.$fname;
        
	if(is_dir($path))
	{
                
                @rmdir($path."/thumbs/");
                if(@rmdir($path))
		{
			echo "(*_*)ok(*_*)Delete Folder $fname success!(*_*)";
			return true;
		}else{
			$listfolder	= ListFolderByPath($path);
                        if(count($listfolder)>0)
                        {
                                echo "(*_*)false(*_*)Can't delete $fname. Folder has child folder!(*_*)";
                                return false;
                        }
                        $listfile	= ListFolderByPath($path,"file");
                        if(count($listfile)>0)
                        {
                                echo "(*_*)false(*_*)Can't delete $fname. Folder has child file!(*_*)";
                                return false;
                        }
		}      
	}else
	{
		echo "(*_*)false(*_*)Folder $fname not exist!(*_*)";
	}
	return false;
}
?>