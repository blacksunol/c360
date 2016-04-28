<?php
    require_once("templates/include/header_login.php");
?>
	<div id="element-box">
		<div class="t">
			<div class="t">
				<div class="t"></div>
			</div>
		</div>
	
		<div class="m">
			<!-- BEGIN: ELEMENT BOX -->
			<div id="adminfieldset">
				<div class="adminheader">Detail</div>
				<div class="error" align="center"> 
					Bạn không có quyền truy cập vào chức năng này <a href='javascript:;' onclick='goBack()'> Quay lại</a>
				</div>	
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
</form>                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
        </div>
<div id="border-bottom"><div><div></div></div></div>
<script type="text/javascript">
function goBack()
{
window.history.back()
}
</script> 
<?php
require_once("templates/include/footer.php");
ob_end_flush();
?>