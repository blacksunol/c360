<?php
//get String:
function gpc_getStringPost($name,$default='')
{
	$value=isset($_POST[$name])? $_POST[$name] : $default;
	//$value=htmlspecialchars($value);
	if(empty($value))$value=$default;
	return trim($value);
}

function gpc_getStringGet($name,$default=null)
{
	$value=isset($_GET[$name])? $_GET[$name] : $default;
	$value=htmlspecialchars($value);
	return $value;
}

//get Int
function gpc_getIntPost($name,$default=0)
{
	$value=isset($_POST[$name])? intval($_POST[$name]) : $default;
	return $value;
}

//get float:
function gpc_getFloatPost($name,$default=0)
{
	$value=isset($_POST[$name])? floatval($_POST[$name]) : $default;
	return $value;
}

function gpc_getIntGet($name,$default=0)
{
	$value=isset($_GET[$name])? intval($_GET[$name]) : $default;
	return $value;
}

//get File
function gpc_getFile($name,$default=false)
{
	$value=isset($_FILES[$name])? $_FILES[$name] : $default;
	return $value;
}
//get File Array
function gpc_getFileArray($name,$default=array())
{
	$value=isset($_FILES[$name])? $_FILES[$name] : $default;
	return $value;
}

//get String Array
function gpc_getStringArray($name,$default=array())
{
	$value=isset($_POST[$name])? $_POST[$name] : $default;
	if(!is_array($value))$value=$default;
	return $value;
}

//get Boolean
function gpc_getBoolPost($name,$default=false)
{
	if($default===0)
	{
		$value=isset($_POST[$name])? 1 : 0;
	}else
	{
		$value=isset($_POST[$name])? true : false;
	}
	return $value;
}

function gpc_getBoolGet($name,$default=false)
{
	if($default===false)
	{
		$value=isset($_GET[$name])? true : false;
	}else
	{
		$value=isset($_GET[$name])? 1 : 0;
	}
	return $value;
}

function gpc_setSession($name,$value)
{
	if(!session_id())session_start();
	$_SESSION[$name]=$value;
}

function gpc_getSession($name,$default=null)
{
	if(!session_id())session_start();
	return isset($_SESSION[$name])? $_SESSION[$name] : $default;
}
function gpc_removeSession($name)
{
	@session_unregister($name);
}

function gpc_setCookie($name, $value,$time=0,$stct=1,$path="")
{
	$_COOKIE[$name]=$value;
	$ip		= $_SERVER['REMOTE_ADDR'];
	$mainURL="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	$expire = ($time>0)? $time:(time() + 60 * 60 * 50);
	$secure = (($_SERVER['HTTPS'] == 'on' OR $_SERVER['HTTPS'] == '1') ? true : false);
	$p = parse_url($mainURL);
	if ($stct == 1 && $ip!='127.0.0.1') {

		if($path=="")
		{
			$dir=str_replace("\\","/",dirname($p['path']));
			$path = !empty($dir) ? $dir.'/' : '/';
			if($path=="//")$path="/";
		}
		$domain = $p['host'];
		@setcookie($name, $value, $expire, $path, $domain, $secure);
	}
	else @setcookie($name,$value,$expire);
}

function gpc_removeCookie($name)
{
	setcookie($name,"",time() - 60*60);
}

function gpc_getCookie($name,$default=null)
{
	return isset($_COOKIE[$name])? $_COOKIE[$name] : $default;
}

function gpc_setCookieArray($name,$value,$time=0,$stct=1,$path="")
{
	if(is_array($value))
	{
		$data=$value;
		$value='';
		foreach ($data as $key =>$vl)
		{
			$value.=$key.'|$^!'.$vl.'!^$|';
		}
	}
	gpc_setCookie($name, $value,$time,$stct,$path);
}

function gpc_getCookieArray($name)
{
	$value=isset($_COOKIE[$name])? $_COOKIE[$name] : '';
	$return=array();
	if(strlen($value)>0)
	{
		$arr=explode("!^$|",$value);
		foreach ($arr as $i=>$vl)
		{
			$arr2=explode("|$^!",$vl);
			if(count($arr2)>1)
			{
				$return[$arr2[0]]=$arr2[1];
			}
		}
	}
	return $return;
}

//date functions

function gpc_getDateNow($hasTime=false)
{
	global $language;
	$timetamp=time();
	$format="Y-m-d";
	if($hasTime)$format.=" H:i:s";
	$date=date($format,$timetamp);
	return  $date;
}

function gpc_add_date($givendate,$day=0,$mth=0,$yr=0,$hasTime=false)
{
	$cd = strtotime($givendate);
	$format="Y-m-d";
	if($hasTime)$format.=" H:i:s";
	$newdate = date($format, mktime(date('h',$cd),
	date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
	date('d',$cd)+$day, date('Y',$cd)+$yr));
	return $newdate;
}


function gpc_DisplayDate($datetime,$default=null,$hasTime=false)
{
	global $language;

	$ps=date_parse($datetime);

	switch ($language)
	{
		case "vn":
			$return=gpc_addZero($ps['day']).'/'.gpc_addZero($ps['month']).'/'.($ps['year']);
			break;
		default:
			$return=($ps['year']).'/'.gpc_addZero($ps['month']).'/'.gpc_addZero($ps['day']);
	}
	if($hasTime==true)
	{
		$return.=' '.gpc_addZero($ps['hour']).':'.gpc_addZero($ps['minute']);
	}
	if(empty($ps['day']))$return=$default;
	return $return;
}

function gpc_DisplayDate2($date,$format='d M Y')
{
	global $language;

	$ps=date_parse($date);
    if(intval($ps['month'])==0)return '';
	return date($format, mktime(0, 0, 0, $ps['month'], $ps['day'], $ps['year']));
}

function gpc_addZero($num,$count=2)
{
	$repeat=$count-strlen($num);
	if($repeat>0)
	{
		$num=str_repeat("0",$repeat).$num;
	}
	return $num;
}

function gpc_DisplayMonthCount($month)
{
	$year=intval($month/12);
	$return=$month." ".Month;
	if($year>0)
	{
		$month=$month%12;
		$return=$year." ".Year;
		if($month>0)$return.=" ".$month." ".Month;
	}
	return $return;
}

function gpc_Md5($code)
{
	$hash="twr";
	$code=$code.$hash;
	$md5=md5($hash.md5($code));
	return $md5;
}
function gpc_randPass($count=8)
{
	$arr[1]=array(48,57);
	$arr[2]=array(65,90);
	$arr[3]=array(97,122);
	$pass='';
	for($i=0;$i<$count;$i++)
	{
		$j=rand(1,3);
		$pass.=chr(rand($arr[$j][0],$arr[$j][1]));
	}
	return $pass;
}

function gpc_utf8_to_ascii($str) {
	$chars=array(
			'a' => array(7845,7847,7849,7851,7853,7844,7846,7848,7850,7852,7855,7857,7859,7861,7863,7854,7856,7858,7860,7862,225,224,7843,227,7841,226,259,193,192,7842,195,7840,194,258),
			'e' => array(7871,7873,7875,7877,7879,7870,7872,7874,7876,7878,233,232,7867,7869,7865,234,201,200,7866,7868,7864,202,),
			'i' => array(237,236,7881,297,7883,205,204,7880,296,7882),
			'o' => array(7889,7891,7893,7895,7897,7888,7890,7892,212,7896,7899,7901,7903,7905,7907,7898,7900,7902,7904,7906,243,242,7887,245,7885,244,417,211,210,7886,213,7884,212,416),
			'u' => array(7913,7915,7917,7919,7921,7912,7914,7916,7918,7920,250,249,7911,361,7909,432,218,217,7910,360,7908,431,),
			'y' => array(253,7923,7927,7929,7925,221,7922,7926,7928,7924),
			'd' => array(273,272),
			'' => array(8364),
			);
	foreach ($chars as $key => $arr)
		foreach ($arr as $val)
		{
			$code=mb_convert_encoding(pack('n', $val), 'UTF-8', 'UTF-16BE');
			$str = str_replace($code,$key,$str);
		}
	return $str;
}

function gpc_RadioYesNo($name,$select=1)
{
	$values=array(No,Yes);
	$return='';
	foreach ($values as $key => $vl)
	{
		$return.='<label for="'.$name.$key.'">';
		$return.='<input type="radio" name="'.$name.'" id="'.$name.$key.'" value="'.$key.'" ';
		$return.=($select==$key)? ' checked ' : '';
		$return.='/> '.$vl.'</label>';
	}
	return $return;
}
function gpc_getBrowser()
{
    $browser=strtolower($_SERVER['HTTP_USER_AGENT']);
    if(strpos($browser,"opera")!==false)
    {
    	$browser="opera";
    }
    else if(strpos($browser,"firefox")!==false)
    {
    	$browser="firefox";
    }
    else if(strpos($browser,"msie")!==false)
    {
    	$browser="ie";
    }
    else if(strpos($browser,"safari")!==false)
    {
    	$browser="safari";
    }
    return $browser;
}
?>
