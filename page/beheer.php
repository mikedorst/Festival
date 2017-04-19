<?php
		if($LoggedIn == true)
		{
		if($Admin >=1337)
		{
			if(isset($_POST['delete'])) {
				$ID = $_POST['accountid'];
				mysqli_query($conn,"DELETE FROM user WHERE ID = $ID");
				header("Refresh:0");
			} 
			
			if(isset($_POST['edit'])){
				$dbID = $_POST['accountid'];
				$dbNaam = $_POST['accountname'];
				$dbDOB = $_POST['accountDOB'];
				$dbEmail = $_POST['accountemail'];
				$dbLand = $_POST['accountland'];
				$dbAdmin = $_POST['accountadmin'];
				$dbPass = $_POST['accountpass'];
				echo '<form method="POST">
						<table>
							<tr><td><input type="text" value="'.$dbID.'" name="accountid" hidden /><td></tr>
							<tr><td>Naam: <td> <input type="text" value="'.$dbNaam.'" name="NewName" /></td></tr>
							<tr><td>DOB: <td> <input type="text" value="'.$dbDOB.'" name="NewDOB" /></td></tr>
							<tr><td>Email: <td> <input type="text" value="'.$dbEmail.'" name="NewEmail" /></td></tr>
							<tr><td>Land: <td> <input type="text" value="'.$dbLand.'" name="NewLand" /></td></tr>
							<tr><td>Admin: <td> <input type="text" value="'.$dbAdmin.'" name="NewAdmin" /> </td></tr>
							<tr><td>Password: <td> <input type="text" name="NewPass" /> </td></tr>
							<tr><td><td><input type="submit" name="edituser" value="confirm"/></td></tr>
						</table>
					</form>';
			}
			if(isset($_POST['edituser'])){
				$ID = $_POST['accountid'];
				$NieuwNaam = $_POST['NewName'];
				$NieuwDOB = $_POST['NewDOB'];
				$NieuwEmail = $_POST['NewEmail'];
				$NieuwLand = $_POST['NewLand'];
				$NieuwAdmin = $_POST['NewAdmin'];
				$NieuwPass = hash('whirlpool', mysqli_real_escape_string($conn, $_POST['NewPass']));
				mysqli_query($conn, "UPDATE user SET login='$NieuwNaam' WHERE ID =$ID");
				mysqli_query($conn, "UPDATE user SET birthday='$NieuwDOB' WHERE ID =$ID");
				mysqli_query($conn, "UPDATE user SET email='$NieuwEmail' WHERE ID =$ID");
				mysqli_query($conn, "UPDATE user SET land='$NieuwLand' WHERE ID =$ID");
				mysqli_query($conn, "UPDATE user SET admin='$NieuwAdmin' WHERE ID =$ID");
				mysqli_query($conn, "UPDATE user SET password='$NieuwPass' WHERE ID =$ID");
				echo 'AANGEPAST';
				header("Refresh:1");
			}
			
			if(isset($_POST['BtnUser'])){
				echo '<div class="content_top"></div>
				<div class="content_title">User toevoegen</div>
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
				<tr><td>Admin level:</td>
					<td><input type="text" name="tbxAdmin" value="0"/></td></tr>
				<tr><td><td><input type="submit" value="Registreren" name="Registreer"/></td></td></tr>
				</form></table></div>
				<div class="content_bottom"></div>';
				
			}
			
			if(isset($_POST['Registreer'])){

				$Name = mysqli_real_escape_string($conn, $_POST['tbxVoornaam']);
				$Land = mysqli_real_escape_string($conn, $_POST['Land']);
				$DOB1 = $_POST['selDag'];
				$DOB2 = $_POST['selMaand'];
				$DOB3 = $_POST['selJaar'];
				$AdminLevel = $_POST['tbxAdmin'];
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
							mysqli_query($conn,"INSERT INTO user (login, email, birthday, password, land, admin) VALUES ('$Name','$Email','$birthday', '$Password', '$Land', '$AdminLevel')");
							echo '<div class="content_top"></div>
							<div class="content_title">User toevoegen</div>
							<div class="content_mid">User toegevoegt!</div>
							<div class="content_bottom"></div>';
							$Error = 0;
							header("Refresh:2");
						}
					}
				}else{
					$Errormsg = 'De twee wachtwoorden komen niet overeen!';
					$Error = 1;
				}
				if($Error == 1){
					echo '<div class="content_top"></div>
					<div class="content_title">User toevoegen</div>
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
					<tr><td>Admin level:</td>
					<td><input type="text" name="tbxAdmin"/></td></tr>
					<tr><td><td><input type="submit" value="Registreren" name="Registreer"/></td></td></tr>
					</form></table></div>
					<div class="content_bottom"></div>
					
					';
				}
			}
		
			echo '
				<div class="content_top"></div>
				<div class="content_mid">
				<form METHOD="POST">
					<table>
						<tr><td><input type="submit" value="User toevoegen" name="BtnUser"/></td></tr>
					</table>
				</form>
				</div>
				<div class="content_bottom"></div>';
				
		$query = mysqli_query($conn,"SELECT * FROM user");
		while($row = mysqli_fetch_array($query)){
			$dbNaam = $row['login'];
			$dbDOB = $row['birthday'];
			$dbEmail = $row['email'];
			$dbLand = $row['land'];
			$dbAdmin = $row['admin'];
			$dbID = $row['ID'];
			$dbPass = $row['password'];
			echo '<div class="content_top"></div>
				<div class="content_title"></div>
				<div class="content_mid">
				<form method="POST">
					<table>
						<tr><td>ID: <td>'.$dbID.' </td></td></tr>
						<tr><td>Naam: <td>'.$dbNaam.' </td></td></tr>
						<tr><td>DOB: <td>'.$dbDOB.' </td></td></tr>
						<tr><td>Email: <td>'.$dbEmail.' </td></td></tr>
						<tr><td>Land: <td>'.$dbLand.' </td></td></tr>
						<tr><td>Admin: <td>'.$dbAdmin.' </td></td></tr>';
						if($Admin >= 1)
						{
							echo '<tr><td><input type="text" value="'.$dbID.'" name="accountid" hidden /><input type="submit" name="delete" value="delete" />
							<input type="text" value="'.$dbNaam.'" name="accountname" hidden />
							<input type="text" value="'.$dbDOB.'" name="accountDOB" hidden />
							<input type="text" value="'.$dbEmail.'" name="accountemail" hidden />
							<input type="text" value="'.$dbLand.'" name="accountland" hidden />
							<input type="text" value="'.$dbAdmin.'" name="accountadmin" hidden />
							<input type="text" value="'.$dbPass.'" name="accountpass" hidden />
							<input type="submit" name="edit" value="edit" /></td></tr>';
						}
					echo'</table>
				</form>
				</div>
				<div class="content_bottom"></div>';
				
			
		} echo '<br><br>';
		}else{
			echo '<div class="content_top"></div>
			<div class="content_title">TE LAAG ADMIN LEVEL</div>
			<div class="content_mid"><font color="red"></font></div>
			<div class="content_bottom"></div>';
		}
		}else
		{
			echo '<div class="content_top"></div>
			<div class="content_title">GEEN TOEGANG</div>
			<div class="content_mid"><font color="red"></font></div>
			<div class="content_bottom"></div>';
		}
