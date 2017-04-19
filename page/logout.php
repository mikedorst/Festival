	<?php 
	if($LoggedIn == true)
	{
		$_SESSION = array();
		session_destroy();

			echo '<div class="content_top"></div>
			<div class="content_title">Logout</div>
			<div class="content_mid">U bent nu uitgelogt!
			<br><br />
			U wordt automatisch doorgestuurd!
			<br><br />
			<div id="progress" style="width:500px;border:1px solid #ccc;"></div>
			<div id="information" style="width"></div>
			</div>
			<div class="content_bottom"></div>';
			header( "refresh:1;url=index.php" );
			// Total processes
			$total = 5;
			// Loop through process
			for($i=1; $i<=$total; $i++){
			  // Calculate the percentation
			  $percent = intval($i/$total * 100)."%";
			  // Javascript for updating the progress bar and information
			  echo '<script language="javascript">
			  document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-color:#ddd;\">&nbsp;</div>";
			  document.getElementById("information").innerHTML=" ";
			  </script>';
			  // This is for the buffer achieve the minimum size in order to flush data
			  echo str_repeat(' ',1024*64);
			  // Send output to browser immediately
			  flush();
			  // Sleep one second so we can see the delay
			  sleep(1);
			}
			
			// Tell user that the process is completed
			echo '<script language="javascript">document.getElementById("information").innerHTML=" "</script>';
	}else
	{
		echo '<div class="content_top"></div>
			<div class="content_title">U BENT NIET INGELOGT</div>
			<div class="content_mid"><font color="red"></font></div>
			<div class="content_bottom"></div>';
	}
	
		
		?>
	