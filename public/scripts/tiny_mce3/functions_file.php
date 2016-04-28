<?php
function Trim_Url($url,$name='')
{
    $url=trim($url);
    if(empty($url))$url=$name;
	$url=gpc_utf8_to_ascii(trim($url));
	$url=preg_replace("([^a-zA-Z.0-9])","-",$url);
	$url=preg_replace("((-){2}|(-$))","",$url);
	$url=strtolower($url);
	return $url;
}
function TypeOfFile($name)
{
    $arr = split("\.",$name);
    $ext = strtolower($arr[count($arr)-1]);
    return $ext;
}
function Img_Crop_Size_Content($imgPath,$widthfix,$heightfix,$typeimage)
{
     if(strtolower($typeimage)=="image/gif")
     {
        $src = imagecreatefromgif($imgPath);
     }
     else if(strtolower($typeimage)=="image/jpeg")
     {
        $src = imagecreatefromjpeg($imgPath);
     }
     else if(strtolower($typeimage)=="image/jpg")
     {
        $src = imagecreatefromjpeg($imgPath);
     }
     else
     {
        $src = imagecreatefrompng($imgPath);
     }
     if($src){
         
        $width=imagesx($src);
        $height=imagesy($src);
        $newwidth=$widthfix;
        $newheight=floor($height*$newwidth/$width);
        if($heightfix>$newheight)
        {
                $newheight=$heightfix;
                $newwidth=floor($width*$newheight/$height);
        }

        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $newimg = imagecreatetruecolor($widthfix, $heightfix);
        $left=0;//($widthfix-$newwidth)/2;
        $top=0;//($heightfix-$newheight)/2;
        //resize image ~fix:
        imagecopyresized($thumb, $src, $left, $top, 0, 0, $newwidth, $newheight, $width, $height);
        //crop image =fix:
        imagecopyresized($newimg, $thumb, 0, 0, 0, 0, $widthfix, $widthfix, $widthfix, $widthfix);
        imagedestroy($src);
        imagedestroy($thumb);

        if(strtolower($typeimage)=="image/gif")
        {
            imagegif($newimg,$imgPath);
        }else if(strtolower($typeimage)=="image/jpeg")
        {
            imagejpeg($newimg,$imgPath);
        }else
        {
            imagepng($newimg,$imgPath);
        }
    }
}
/**
 * function : BuildFileList()
 * @param : $fileselect, $folder
 * @return: list file on select option html
 */
function BuildFileList($fileselect,$foldercategory)
{
	$list = "";
	$k = 0;
	$narray_file = array();
	$narray_file_lower = array();
	$InitDirectory = opendir($foldercategory);
	$list .= "<option value =''><b>...*...</b></option>";
	while ($file = readdir($InitDirectory))
	{
		if ( $file != "." && $file != ".." && is_file($foldercategory."/".$file) && $file!="Thumbs.db")
		{

				$narray_file["file"][$k]  = $file;
				$narray_file_lower["lower"][$k]  = strtolower($file);
				$k ++;
		}
	}
	if($narray_file["file"] != "")
	{
		array_multisort($narray_file_lower["lower"],SORT_ASC,SORT_STRING,$narray_file["file"]);
	}
	for ($i=0; $i < sizeof($narray_file["file"]) ;$i++)
	{
		if ($fileselect == $narray_file["file"][$i])
			{
				$list.= "<option selected ='".$narray_file["file"][$i]."' value ='".$narray_file["file"][$i]."'><b>".$narray_file["file"][$i]."</b></option>";
			}
			else
			{
				$list.= "<option value ='".$narray_file["file"][$i]."'><b>".$narray_file["file"][$i]."</b></option>";
			}
	}
	closedir($InitDirectory);
	return $list;
}
/**
 * function Check_File()
 * @param : $foldercategory,$fileselect
 * @return:
 */
function Check_File($foldercategory,$fileselect)
{
	$count = 0;
	$InitDirectory = @opendir($foldercategory);
	while ($file = @readdir($InitDirectory))
	{
		if ( $file != "." && $file != ".." && is_file($foldercategory."/".$file) && $file != "Thumbs.db")
		{
			if ($fileselect == $file)
			{
				$count ++;
			}
		}
	}
    @closedir($InitDirectory);
	if($count > 0) return true;
	else return false;

}

// xu ly up file anh:
function upImage($imagefile,$folder,$pagetr=false,$widthmax=0,$heightmax=0,$thumbWidth=0, $thumbHeight=0)
{
global $img_max_width, $img_max_height;
global $img_thumb_width, $img_thumb_height;
global $function_error;

	if($thumbWidth==0 || $thumbHeight==0)
	{
		$widthmax	= intval($img_max_width);
		$heightmax	= intval($img_max_height);
	}
	if($thumbWidth==0 || $thumbHeight==0)
	{
		$thumbWidth	= $img_thumb_width;
		$thumbHeight= $img_thumb_height;
	}
	if(!is_dir($folder))@mkdir($folder);

	$imageName  = $imagefile["name"];
	$imageName	= Trim_Url($imageName);
	$typeimage  = $imagefile['type'];
	$size       = $imagefile['size'];
	$temp_name  = $imagefile['tmp_name'];
	if(substr($folder,strlen($folder)-1,1)!="/")$folder.="/";
	if(!empty($imageName))
	{
		$arrname=explode(".",$imageName);
		$ename=$arrname[count($arrname)-1];
		$fname=substr($imageName,0,strlen($imageName)-strlen($ename)-1);

		$i=1;
		while(file_exists($folder.$imageName))
		{
			$imageName=$fname."_".$i.".".$ename;
			$i++;
		}
		$typeimage=strtolower($typeimage);
		if (strpos($typeimage,"image/")===false && strpos($typeimage,"application/x-shockwave-flash")===false)
		{
			$function_error = "Not support images format :".$typeimage;
			if($pagetr==false)return false;
			page_transfer($function_error,$pagetr);
			exit();
		}

		if(! move_uploaded_file($temp_name,$folder.$imageName))
		{
			$function_error = "Can not copy file ! !";
			if($pagetr==false)return false;
			page_transfer($function_error,$pagetr);
			exit();
		}
		$imageName=@changeTypeImage($folder,$imageName);
		if($thumbWidth>1 && $thumbHeight>1)
		{
			@createthumb($folder.$imageName,"", $thumbWidth, $thumbHeight);
		}
		if($widthmax>1 && $heightmax>1)
		{
			//@createthumb($folder.$imageName,$folder.$imageName, $widthmax, $heightmax);
		}
		return $imageName;
	}
	return false;
}

function changeTypeImage($folder,$imageName)
{
	$arr = explode(".",$imageName);
    $ext = strtolower($arr[count($arr)-1]);
    $name=str_replace(".".$ext,"",$imageName);

	if($ext!="bmp")
	{
		return $imageName;
	}
	$img_s=@imagecreatefrombmp($folder.$imageName);
	if($img_s)
	{
		$new_name=$name.".jpg";
		list($width, $height) =@getimagesize($folder.$imageName);
		$img_d=@imagecreatetruecolor($width, $height);
		$rs=@imagecopyresampled($img_d, $img_s, 0,0,0,0, $width, $height,$width,$height);
		$rs=@imagejpeg($img_d, $folder.$new_name);
		if($rs)
		{
			$imageName=$new_name;
			@unlink($folder.$imageName);
		}
		@imagedestroy($img_s);
    	@imagedestroy($img_d);
	}
	return $imageName;
}

function imagecreatefrombmp( $filename )
{
    $file = fopen( $filename, "rb" );
    $read = fread( $file, 10 );
    while( !feof( $file ) && $read != "" )
    {
        $read .= fread( $file, 1024 );
    }
    $temp = unpack( "H*", $read );
    $hex = $temp[1];
    $header = substr( $hex, 0, 104 );
    $body = str_split( substr( $hex, 108 ), 6 );
    if( substr( $header, 0, 4 ) == "424d" )
    {
        $header = substr( $header, 4 );
        // Remove some stuff?
        $header = substr( $header, 32 );
        // Get the width
        $width = hexdec( substr( $header, 0, 2 ) );
        // Remove some stuff?
        $header = substr( $header, 8 );
        // Get the height
        $height = hexdec( substr( $header, 0, 2 ) );
        unset( $header );
    }
    $x = 0;
    $y = 1;
    $image = imagecreatetruecolor( $width, $height );
    foreach( $body as $rgb )
    {
        $r = hexdec( substr( $rgb, 4, 2 ) );
        $g = hexdec( substr( $rgb, 2, 2 ) );
        $b = hexdec( substr( $rgb, 0, 2 ) );
        $color = imagecolorallocate( $image, $r, $g, $b );
        imagesetpixel( $image, $x, $height-$y, $color );
        $x++;
        if( $x >= $width )
        {
            $x = 0;
            $y++;
        }
    }
    return $image;
}


function createThumbs( $pathToImages, $pathToThumbs="", $thumbWidth=0, $thumbHeight=0,$border=false)
{
global $img_max_width, $img_max_height;
global $img_thumb_width, $img_thumb_height;

	if(substr($pathToImages,strlen($pathToImages)-1)!="/")
	{
		$pathToImages.="/";
	}
	if(empty($pathToThumbs))
	{
		$pathToThumbs=$pathToImages."thumbs/";
	}
	if(!is_dir($pathToThumbs))@mkdir($pathToThumbs);

	if($thumbWidth==0 || $thumbHeight==0)
	{
		$thumbWidth	= $img_thumb_width;
		$thumbHeight= $img_thumb_height;
	}
	// open the directory
	$dir = @opendir( $pathToImages );
	// loop through it, looking for any/all JPG files:
	while (false !== ($fname = @readdir( $dir )))
	{
		if(!is_file($pathToImages.$fname))continue;
		if($thumbWidth>1 && $thumbHeight>1)
		{
			createthumb($pathToImages.$fname, $pathToThumbs.$fname, $thumbWidth, $thumbHeight, $border);
		}
		if($img_max_height>1 && $img_max_height>1)
		{
			createthumb($pathToImages.$fname,$pathToImages.$fname, $img_max_width, $img_max_height);
		}
	}
	@closedir($dir);
}

function createthumb($name, $newname, $new_w, $new_h, $border=false, $transparency=true, $base64=false)
{
    if(file_exists($newname) && $name!=$newname)
	{
        @unlink($newname);
	}
	if(empty($newname))
	{
		$newname=preg_replace("(^(.*)/(.*).([a-zA-Z]{3})$)","$1/thumbs/$2.$3",$name);
		$folderthumb=preg_replace("(^(.*)/(.*).([a-zA-Z]{3})$)","$1/thumbs/",$name);
		if(!is_dir($folderthumb))
		{
			@mkdir($folderthumb);
		}
	}
    if(!file_exists($name))
    {
        return false;
    }
    $arr = explode(".",$name);
    $ext = strtolower($arr[count($arr)-1]);

    if($ext=="jpeg" || $ext=="jpg"){
        $img = @imagecreatefromjpeg($name);
    } elseif($ext=="png"){
        $img = @imagecreatefrompng($name);
    } elseif($ext=="gif") {
        $img = @imagecreatefromgif($name);
    }
    if(!$img)
    {
        return false;
    }
    $old_x = imageSX($img);
    $old_y = imageSY($img);

    if($old_x < $new_w && $old_y < $new_h) {
        $thumb_w = $old_x;
        $thumb_h = $old_y;
    } elseif ($old_x > $old_y) {
        $thumb_w = $new_w;
        $thumb_h = floor(($old_y*($thumb_w/$old_x)));
    } elseif ($old_x < $old_y) {
		$thumb_h = $new_h;
        $thumb_w = floor($old_x*($thumb_h/$old_y));
    } elseif ($old_x == $old_y) {
        $thumb_w = $new_w;
        $thumb_h = $new_h;
    }
    $thumb_w = ($thumb_w<1) ? 1 : $thumb_w;
    $thumb_h = ($thumb_h<1) ? 1 : $thumb_h;
    $new_img = imagecreatetruecolor($thumb_w, $thumb_h);

    if($transparency) {
        if($ext=="png") {
            imagealphablending($new_img, false);
            $colorTransparent = imagecolorallocatealpha($new_img, 0, 0, 0, 127);
            imagefill($new_img, 0, 0, $colorTransparent);
            imagesavealpha($new_img, true);
        } elseif($ext=="gif") {
            $trnprt_indx = imagecolortransparent($img);
            if ($trnprt_indx >= 0) {
                //its transparent
                $trnprt_color = imagecolorsforindex($img, $trnprt_indx);
                $trnprt_indx = imagecolorallocate($new_img, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                imagefill($new_img, 0, 0, $trnprt_indx);
                imagecolortransparent($new_img, $trnprt_indx);
            }
        }
    } else {
        Imagefill($new_img, 0, 0, imagecolorallocate($new_img, 255, 255, 255));
    }

    imagecopyresampled($new_img, $img, 0,0,0,0, $thumb_w, $thumb_h, $old_x, $old_y);
    if($border) {
        $black = imagecolorallocate($new_img, 111,77,66);
        imagerectangle($new_img,0,0, $thumb_w-1, $thumb_h-1, $black);
		imagerectangle($new_img,0,0, $thumb_w, $thumb_h, $black);
    }
    if($base64) {
        ob_start();
        imagepng($new_img);
        $img = ob_get_contents();
        ob_end_clean();
        $return = base64_encode($img);
    } else {
        if($name==$newname)
        {
                @unlink($newname);
        }
        if($ext=="jpeg" || $ext=="jpg"){
            imagejpeg($new_img, $newname);
            $return = true;
        } elseif($ext=="png"){
            imagepng($new_img, $newname);
            $return = true;
        } elseif($ext=="gif") {
            imagegif($new_img, $newname);
            $return = true;
        }
    }
    imagedestroy($new_img);
    imagedestroy($img);
    return $return;
}

function ListFolderByPath($path,$type="folder")
{
    $dir	= @opendir($path);
    $list	= array();

    while(($child=@readdir($dir))!==false)
    {
            if($child=="." || $child==".." || $child=="Thumbs.db" || $child=="thumbs" || $child==".htaccess" || $child=="index.htm")continue;
            if(($type=="folder" && is_dir($path."/".$child."/")) || ($type=="file" && is_file($path."/".$child)))
            {
                    $list[]	=	$child;
            }
    }
    return $list;
}

function BuildFolderList($path,$folderselect)
{
    global $k;
    $type = "dir";
    $narray = array();
    $narray_lower = array();
    $return = "<option value =''><b>Select Folder</b></option>";
    if (@is_dir($path))
    {
        if (@opendir($path)) {
                $dh = opendir($path);
                $k = 0;
                while(($file = readdir($dh)) !== false)
                {
                    $pathfile=$file;
                    if($type!="dir")$pathfile=$path."/".$file;

                    if(is_dir($file))
                    {
                        continue;
                    }
                    if(@filetype($path ."/". $file) == $type && $file!="." && $file!="..")
                    {
                        $narray["folder"][$k]  = $file;
                        $narray_lower["lower"][$k]  = strtolower($file);
                        $k ++;

                    }

                }

                array_multisort($narray_lower["lower"],SORT_ASC,SORT_STRING,$narray["folder"]);
                for ($i=0; $i < sizeof($narray["folder"]) ;$i++)
                {
                    if($folderselect == $narray["folder"][$i])
                    {
                        $return.="<option selected = '".$narray["folder"][$i]."' value='".$narray["folder"][$i]."'>".$narray["folder"][$i]."</option>";
                    }
                    else
                    {
                        $return.="<option value='".$narray["folder"][$i]."'>".$narray["folder"][$i]."</option>";
                    }
                }
            }
    }
    closedir($dh);
    return $return;
}

?>