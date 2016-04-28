<?php
function cmsButton($name,$value = '#',$attribs = null,$options = null ){
    $iconDir = $attribs['iconDir'];
    if(empty($iconDir))$iconDir = "templates/images/toolbar/";
    
    $icon = $attribs['icon'];
    if(empty($icon)) $icon = 'icon-32-default.png';
    
    $src = $iconDir . $icon;

    $onclick='';
    if(!empty($attribs['onclick'])){
        $onclick = 'onclick="'.$attribs['onclick'].'"';
    }
    
    if($options['type']=='submit'){
            $value= "javascript:onSubmitForm('".$options['name']."','".$value."')";
    }
    $xhtml = 
        '<div class="toolbar-button" >
            <a href="' .  $value . '" '.$onclick.'><img src="' . $src . '"><br>' . $name . '
            <input type="hidden" name="submit_frm"/>    
            </a>
        </div>';
    return $xhtml;
}
function cmsIcon($name,$value = '#',$attribs = null,$options = null ){
    $iconDir = $attribs['iconDir'];
    if(empty($iconDir))$iconDir = "templates/images/";

    $icon = $attribs['icon'];
    if(empty($icon)) $icon = 'icon_info.png';

    $src = $iconDir . $icon;
    
    $onclick='';
    if(!empty($attribs['onclick'])){
        $onclick = 'onclick="'.$attribs['onclick'].'"';
    }
    $xhtml='<a href="' .  $value . '" '.$onclick.'>
        <img src="'.$src.'" title="'.$name.'" border="0"> 
    </a>';
    return $xhtml;
}