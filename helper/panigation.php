<?php
function panigation($st){
    echo "<center>";
    if($_GET['trang']!=""){
        if(ereg("&trang=",$_SERVER['REQUEST_URI'])){
            $_SERVER['REQUEST_URI']=str_replace("&trang=","",$_SERVER['REQUEST_URI']);
            $_SERVER['REQUEST_URI']=substr($_SERVER['REQUEST_URI'],0,-strlen($_GET['trang']));
            $lpt=$_SERVER['REQUEST_URI']."&trang=";
        }else{
            $lpt=$_SERVER['REQUEST_URI']."&trang=";
        }
    }else{
        $_SERVER['REQUEST_URI']=str_replace("&trang=","",$_SERVER['REQUEST_URI']);
        $lpt=$_SERVER['REQUEST_URI']."&trang=";
    }
    if($_GET['trang']!="" and $_GET['trang']!="1")
    {
        if($_GET['trang']=="" or $_GET['trang']==1){
            $k=1;
        }else{
            $k=$_GET['trang']-1;
        }
        $link_t=$lpt.$k;
        $link_d=$lpt."1";
        echo '<div class="button2-right">
                <div class="start"><a href="'.$link_d.'">Đầu</a></div></div>';
        echo '<div class="button2-right">
	<div class="prev"><a href="'.$link_t.'">Trước</a></div></div>';
    }
    if($_GET['trang']==""){
        $a=1;
    }else{
        $a=$_GET['trang'];
    }
    $b_1=$_GET['trang']-5;
    $n_1=$b_1;
    if($b_1<1){
        $b_1=1;
    }
    $b_2=$_GET['trang']+5;
    if($b_2>=$st){
        $n_2=$b_2;
        $b_2=$st;
    }
    if($n_1<0){
        $v=(-1)*$n_1;
        $b_2=$b_2+$v;
    }
    if($n_2>=$st){
        $v_2=$n_2-$st;
        $b_1=$b_1-$v_2;
    }
     echo '<div class="button2-left">
            <div class="page">';
    if($b_1>1){
        echo "<a href='$link_d' >1</a>";
        echo '<span style="font-weight: normal;"> ... </span>';
    }
    for($i=$b_1;$i<=$b_2;$i++){
        $lpt_1=$lpt.$i;
        if($i>0 && $i<=$st){
            if($i!=$a){
                echo "<a href='$lpt_1'>$i</a> ";
            }else{
                 echo "<span>$i</span> ";
            }
        }
    }
    $link_cuoi=$lpt.$st;
    if($b_2<$st){
        echo '<span style="font-weight: normal;"> ... </span>';
        echo "<a href='$link_cuoi' class='pt3'>$st</a>";
    }
    echo "</div></div>";
    if($_GET['trang']!=$st && $st!=1){
        if($_GET['trang']==$st)
        {
            $k=$st;
        }
        else
        {
            $k=$_GET['trang']+1;
            if($_GET['trang']==""){
                $k=2;
            }
        }
        $link_s=$lpt.$k;
        echo '<div class="button2-left">
            <div class="end"><a href="'.$link_s.'">Sau</a></div></div>';
        echo '<div class="button2-left">
	<div class="end"><a href="'.$link_cuoi.'">Cuối</a></div></div>';
    }
    echo "</center>";
}
function partition( $list, $p ) {
	$listlen = count( $list );
	$partlen = floor( $listlen / $p );
	$partrem = $listlen % $p;
	$partition = array();
	$mark = 0;
	for ($px = 0; $px < $p; $px++) {
		$incr = ($px < $partrem) ? $partlen + 1 : $partlen;
		$partition[$px] = array_slice( $list, $mark, $incr );
		$mark += $incr;
	}
	return $partition;
}
?>