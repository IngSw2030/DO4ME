<?php  if(isset($_SESSION['d4m_adminid'])){?>	<script type="text/javascript">		var loginObj={'site_url':'<?php echo SITE_URL;?>'};		var login_url=loginObj.site_url;		window.location=login_url+"admin/calendar.php";	</script><?php }?>