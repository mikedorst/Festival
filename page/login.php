		<?php
		if(isset($_POST['BLogin'])){
			$Username = mysqli_real_escape_string($conn, $_POST['LoginNaam']);
			$Password = hash('whirlpool', mysqli_real_escape_string($conn, $_POST['LoginPass']));
			if($Username && $Password){
				$query = mysqli_query($conn,"SELECT * FROM user WHERE login = '$Username'");
				if(mysqli_num_rows($query) == 1){
					while($row = mysqli_fetch_array($query)){
						$dbID = $row['ID'];
						$dbUsername = $row['login'];
						$dbPass = $row['password'];
						$dbAdmin = $row['admin'];
					}
					if($Password == $dbPass){
						$_SESSION['Username'] = $dbUsername;
						$_SESSION['AccountID'] = $dbID;
						$_SESSION['Admin'] = $dbAdmin;
						
						echo '<div class="content_top"></div>
						 <div class="content_title">Login</div>
						 <div class="content_mid">Login successful!
						 <br><br />
						 U wordt automatisch door gestuurd.
						<br><br />
						<div id="progress" style="width:500px;border:1px solid #ccc;"></div>
						<div id="information" style="width"></div></div>
						<div class="content_bottom"></div>';
						$Error = 0;
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
						echo '<script language="javascript">document.getElementById("information").innerHTML=""</script>';
					}else{
						$Errormsg = "Login naam of Wachtwoord is fout!";
						$Error = 1;
					}
				}else{
					$Errormsg = "Login naam of Wachtwoord is fout!";
					$Error = 1;
				}
			}else{
				$Errormsg = "Login naam of Wachtwoord is fout!";
				$Error = 1;
			}

			if($Error == 1){
				echo '<div class="content_top"></div>
				<div class="content_title">Login</div>
				<div class="content_mid">
				<b>'.$Errormsg.'</b><br />
				<form method="POST"><table>
				<tr><td>Login naam:</td>
				<td><input type="text" name="LoginNaam" required/></td></tr>
				<tr><td>Wachtwoord:</td>
				<td><input type="password" name="LoginPass" required/></td></tr>
				<td><td><input type="submit" value="Login" name="BLogin"/></td></td>
				</div>
				</table>
				</form></div>
				<div class="content_bottom"></div>
				
				';
			}	
		}else{
			echo '<div class="content_top"></div>
			<div class="content_title">Login</div>
			<div class="content_mid">
			<form method="POST"><table>
			<tr><td>Login naam:</td>
			<td><input type="text" name="LoginNaam" required/></td></tr>
			<tr><td>Wachtwoord:</td>
			<td><input type="password" name="LoginPass" required/></td></tr>
			<td><td><input type="submit" value="Login" name="BLogin"/></td></td>
			</div>
			</table>
			</form></div>
			<div class="content_bottom"></div>
			
			';
		}
		?>