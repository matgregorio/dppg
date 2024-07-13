<?php

    include_once('includes/config2.php');
					
	$busca_banner = mysql_query("select * from banner");
	
	$cont_banner = mysql_num_rows($busca_banner);
	
	//testa existe algum banner cadastrado
	if($cont_banner!=0) {
?>


<!DOCTYPE html>
<html>
<head>

	<meta content="charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
	
	<script src="js/flexsliderv2.1.js"></script>
	
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery('.flexslider').flexslider();
		});
	</script>
	
</head>
<body>
	<div id="box5">
		<div class="flexslider">
	    <ul class="slides">
	    	<?php
					while( $banner = mysql_fetch_array($busca_banner) ) {
						echo '
						<li>
								<a href="'.$banner[link_banner].'" target="_blank">
									<img src="images/banner/'.$banner[arquivo_banner].'" width="100%" height="120"/>
								</a>
						</li>';								
					}		
			?>
	    </ul>
	  </div>
	</div>	
</body>
</html>

 <?php	
 	}
	  		mysql_close($conexao);
 ?>	

