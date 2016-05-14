<?php
    $table = 'cauhinh';
    $module = $_GET['module'];
    $sql = select($table,'').  where(array('id'=>1));
    $data = fetchRow($sql);
    if(isset($_POST['submit_frm'])){
        $arrSet = array(
			'facebook'=>$_POST['facebook'],
		);
		if($_GET['act']=='edit'){
			$sql = update($table,$arrSet).where(array('id'=>1));
		}else{
			$sql = insert($table,$arrSet);
		}
		mysql_query($sql);
		header("location:index.php?module=$module&act=edit");
        exit();	
    }
    
?>
<div id="content-box">
    <div class="border">
        <div class="padding">
            <form name="appForm" id="appForm" method="post" action="">
                <?php
                    require_once ("modules/$module/include/toolbar.php");
                ?>	

                <!-- BEGIN: CONTENT -->
                <div id="element-box">
                    <div class="t">
                        <div class="t">
                            <div class="t"></div>
                        </div>
                    </div>
                    <div class="m">
                        <!-- BEGIN: ELEMENT BOX -->
                        <div id="adminfieldset">
                            <div class="adminheader">Thông tin</div>
                            
                            <div id="row">
                                <div class="label">Facebook:</div>
                                <input type="text" name="facebook" value="<?php echo $data['facebook'];?>" class="txtlong">
                            </div>
                            <div class="clr"></div>
                        </div>
                        <!-- END: ELEMENT BOX -->	
                        <div class="clr"></div>
                    </div>
                    <div class="b">
                        <div class="b">
                            <div class="b"></div>
                        </div>
                    </div>
                </div>
                <!-- END: 	CONTENT -->
            </form>
            </div>
        <div class="clr"></div>
    </div>
</div>
<div id="border-bottom"><div><div></div></div></div>
            