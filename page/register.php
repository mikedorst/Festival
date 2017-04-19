		<?php
		if($LoggedIn == false)
		{
			if(isset($_POST['Registreer'])){

				$Name = mysqli_real_escape_string($conn, $_POST['tbxVoornaam']);
				$Land = mysqli_real_escape_string($conn, $_POST['Land']);
				$DOB1 = $_POST['selDag'];
				$DOB2 = $_POST['selMaand'];
				$DOB3 = $_POST['selJaar'];
				$Email = mysqli_real_escape_string($conn, $_POST['tbxE-mail']);
				$Password = hash('whirlpool', mysqli_real_escape_string($conn, $_POST['tbxWachtwoord']));
				$Password2 = hash('whirlpool', mysqli_real_escape_string($conn, $_POST['tbxWachtwoordB']));
				
				if($Password == $Password2){
					$query = mysqli_query($conn,"SELECT login FROM user WHERE login = '$Name'");
					if(mysqli_num_rows($query) == 1)
					{
						$Errormsg = 'Deze naam is al in gebruik';
						$Error = 1;
					}else{
						$query = mysqli_query($conn,"SELECT email FROM user WHERE email = '$Email'");
						if(mysqli_num_rows($query) == 1)
						{
							$Errormsg = 'Dit email word al gebruikt!';
							$Error = 1;
						}else{
							strtolower($Email);
							$birthday = ''.$DOB1.'/'.$DOB2.'/'.$DOB3.'';
							mysqli_query($conn,"INSERT INTO user (login, email, birthday, password, land) VALUES ('$Name','$Email','$birthday', '$Password', '$Land')");
							echo '<div class="content_top"></div>
							<div class="content_title">Register</div>
							<div class="content_mid">Registratie compleet!</div>
							<div class="content_bottom"></div>';
							$Error = 0;
						}
					}
				}else{
					$Errormsg = 'De twee wachtwoorden komen niet overeen!';
					$Error = 1;
				}
				if($Error == 1){
					echo '<div class="content_top"></div>
					<div class="content_title">Register</div>
					<div class="content_mid">
					<b>'.$Errormsg.'</b><br />
					<table><form method="post">
					<tr><td>Login naam: </td>
					<td><input type="text" name="tbxVoornaam" value="'.$Name.'"/></td></tr>
					<tr><td>Land:</td>
					<td><input type="text" name="Land" value="'.$Land.'"/></td></tr>
					<tr><td>Geboortedatum:</td>
					<td><Select name="selDag">';
					for($i = 1; $i <= 31; $i++){
						if($i == $DOB1){echo "<option value='$i' selected>$i</option>";}else{
							echo "<option value='$i'>$i</option>";
						}
						
					}	
					echo '</select>
					  
					<select name="selMaand">';
					for($i = 1; $i <= 12; $i++){
						if($i == $DOB2){echo "<option value='$i' selected>$i</option>";}else{
							echo "<option value='$i'>$i</option>";
						}
					}
					echo '</select>
						
					<select name="selJaar">';
					for($i = date("Y"); $i >= 1900 ; $i--){
						if($i == $DOB3){echo "<option value='$i' selected>$i</option>";}else{
							echo "<option value='$i'>$i</option>";
						}
					}
					echo '</select></td></tr>
					<tr><td>E-mail adres:</td>
					<td><input type="email" name="tbxE-mail" value="'.$Email.'"/></td></tr>
					<tr><td>Wachtwoord:</td>
					<td><input type="password" name="tbxWachtwoord"/></td></tr>
					<tr><td>Wachtwoord bevestigen:</td>
					<td><input type="password" name="tbxWachtwoordB"/></td></tr>
					<tr><td><td><input type="submit" value="Registreren" name="Registreer"/></td></td></tr>
					</form></table></div>
					<div class="content_bottom"></div>
					
					';
				}
			}else{
				echo '<div class="content_top"></div>
				<div class="content_title">Register</div>
				<div class="content_mid">
				<table><form method="post">
				<tr><td>Login naam: </td>
				<td><input type="text" name="tbxVoornaam" required/></td></tr>
				<tr><td>Land:</td>
				<td><input type="text" name="Land" required/></td></tr>
				<tr><td>Geboortedatum:</td>
				<td><Select name="selDag" required>';
				for($i = 1; $i <= 31; $i++){echo "<option value='$i'>$i</option>";}	
				echo '</select>
				  
				<select name="selMaand" required>';
				for($i = 1; $i <= 12; $i++){echo "<option value='$i'>$i</option>";}
				echo '</select>
					
				<select name="selJaar" required>';
				for($i = date("Y"); $i >= 1900 ; $i--){echo "<option value='$i'>$i</option>";}
				echo '</select></td></tr>
				<tr><td>E-mail adres:</td>
				<td><input type="email" name="tbxE-mail" required/></td></tr>
				<tr><td>Wachtwoord:</td>
				<td><input type="password" name="tbxWachtwoord" required /></td></tr>
				<tr><td>Wachtwoord bevestigen:</td>
				<td><input type="password" name="tbxWachtwoordB" required /></td></tr>
				<tr><td><td><input type="submit" value="Registreren" name="Registreer"/></td></td></tr>
				</form></table></div>
				<div class="content_bottom"></div>
				
				';
			}
		}else{
			echo '<div class="content_top"></div>
			<div class="content_title">U BENT AL INGELOGT!</div>
			<div class="content_mid"><font color="red"></font></div>
			<div class="content_bottom"></div>';
		}
		?>