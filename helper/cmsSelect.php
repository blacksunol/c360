<?php
function cmsSelect($name,$value = null,$attribs = null,$options = null ){
    $strAttribs = '';
    if(count($attribs)>0){

            foreach ($attribs as $key => $val){
                    $strAttribs .= ' ' . $key . '="' . $val . '" ';
            }
    }		
    $xhtml = '<select name="' . $name . '" id="' . $name . '" ' . $strAttribs . '>';
    foreach ($options as $key => $val){
            $name = $val['ten'];

            if($val['level'] == 1){
                    $name = '+' . $val['ten'];
            }else{
                    $str = '- - ';
                    $name = ' ' . str_repeat($str, $val['level'] - 1) . $val['ten'];
            }
            $selected = '';
            if($val['id'] == $value){
                    $selected = ' selected="selected" ';
            }
            $xhtml .= '<option value="' . $val['id'] . '" ' . $selected . ' >' . $name . '</option>';
    }
    $xhtml .= '</select>';

    return $xhtml;
}
?>
