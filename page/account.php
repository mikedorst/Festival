<?php
		if($LoggedIn == true)
		{
			$Error = 0;
			if(isset($_POST['edituser'])){
				$ID = $_POST['accountid'];
				$NieuwNaam = $_POST['NewName'];
				$NieuwEmail = $_POST['NewEmail'];
				$NieuwLand = $_POST['NewLand'];
					mysqli_query($conn, "UPDATE user SET login='$NieuwNaam' WHERE ID =$ID");
					mysqli_query($conn, "UPDATE user SET email='$NieuwEmail' WHERE ID =$ID");
					mysqli_query($conn, "UPDATE user SET land='$NieuwLand' WHERE ID =$ID");
					echo 'AANGEPAST';
					header("Refresh:1");
			}
			
			if(isset($_POST['editPass'])){
				$ID = $_POST['accountid'];
				$NieuwPass = hash('whirlpool', mysqli_real_escape_string($conn, $_POST['NewPass']));
				$NieuwPass2 = hash('whirlpool', mysqli_real_escape_string($conn, $_POST['NewPass2']));
				if($NieuwPass == $NieuwPass2)
				{
					mysqli_query($conn, "UPDATE user SET password='$NieuwPass' WHERE ID =$ID");
					echo 'AANGEPAST';
					header("Refresh:1");
					$Error = 0;
				}else{
					$Error = 1;
				}
			}
			
			$query = mysqli_query($conn,"SELECT * FROM user WHERE id = $AccountID");
			if(mysqli_num_rows($query) == 1){
				while($row = mysqli_fetch_array($query)){
					$dbNaam = $row['login'];
					$dbDOB = $row['birthday'];
					$dbEmail = $row['email'];
					$dbLand = $row['land'];
					$dbAdmin = $row['admin'];
					$dbID = $row['ID'];
					$dbPass = $row['password'];
					echo '<div class="content_top"></div>
						<div class="content_title">Account Details</div>
						<div class="content_mid">
						<form method="POST">
							<table>
								<tr><td>Loginnaam: <td>'.$dbNaam.' </td></td></tr>
								<tr><td>Email: <td>'.$dbEmail.' </td></td></tr>
								<tr><td>Land: <td>'.$dbLand.' </td></td></tr>
							</table>
						</form>
						</div>
						<div class="content_bottom"></div>';
						
						echo '<div class="content_top"></div>
						<div class="content_title">Account Aanpassen</div>
						<div class="content_mid">
						<form method="POST">
							<table>
								<b>Alleen invullen wat u wilt veranderen!</b>
								<tr><td><input type="text" value="'.$dbID.'" name="accountid" hidden/>						
								<tr><td>Login-naam: <td> <input type="text" value="'.$dbNaam.'" name="NewName"/></td></tr>
								<tr><td>Email: <td> <input type="text" value="'.$dbEmail.'" name="NewEmail"/></td></tr>
								<tr><td>Land: <td> <input type="text" value="'.$dbLand.'" name="NewLand"/></td></tr>
								<tr><td><td><input type="submit" name="edituser" value="confirm"/></td></tr>
								</table></form>
								<br></br>';
				
					if($Error == 1)
					{
						echo '<form method="POST">
								<table>
									<tr><b>Alleen invullen als u het wachtwoord wilt wijzigen!</b></t</tr><br>
									<tr><b><font color="red">De twee wachtwoorden komen niet overeen!</font></b></tr>
									<tr><td>Wachtwoord: <td> <input type="text" name="NewPass" /> </td></tr>
									<tr><td>Herhaal:<td> <input type="text" name="NewPass2" /> </td></tr>
									<tr><td><td><input type="submit" name="editPass" value="confirm"/></td></tr>
								</table>
							</form>';
					}else{
						echo '<form method="POST">
								<table>
									<tr><b>Alleen invullen als u het wachtwoord wilt wijzigen!</b></tr>
									<tr><td>Wachtwoord: <td> <input type="text" name="NewPass" /> </td></tr>
									<tr><td>Herhaal:<td> <input type="text" name="NewPass2" /> </td></tr>
									<tr><td><td><input type="submit" name="editPass" value="confirm"/></td></tr>
								</table>
							</form>';
					}
					echo '</div>
					<div class="content_bottom"></div>';
				}
			}
			
			
			echo '<div class="content_top"></div>
			<div class="content_title">Aankopen</div>
			<div class="content_mid">
			<form method="POST">
			<table>';
			$count = 0;
			$query = mysqli_query($conn,"SELECT * from tickets where user_id = $AccountID");
			if(mysqli_num_rows($query) != 0){ // Kijkt of er een match is met de query, 0=geen matches met de query, 1= 1match, 2=2matches, etc.
				while($row = mysqli_fetch_array($query)){ //while loop die door alle matches gaat en hier de data uit extract.
					$User_id = $row['user_id'];
					$Tvoornaam = $row['voornaam'];
					$Tachternaam = $row['achternaam'];
					$Twoonplaats = $row['woonplaats'];
					$Tpostcode = $row['postcode'];
					$Tticket = $row['ticket'];
					$Tdate = $row['date'];
					$Tprice = $row['price'];
					$count++;
					echo '<tr><td><b>Naam:</b> <td> '.$Tvoornaam.' '."".' '.$Tachternaam.'</td></td></tr>
						<tr><td><b>Woonplaats:</b> <td> '.$Twoonplaats.'</td></td></tr>
						<tr><td><b>Postcode:</b> <td> '.$Tpostcode.'</td></td></tr>
						<tr><td><b>Ticket:</b> <td> '.$Tticket.'</td></td></tr>
						<tr><td><b>Prijs:</b> <td> '.$Tprice.'</td></td></tr>
						<tr><td><b>Datum:</b> <td> '.$Tdate.'</td></td></tr>';
					if($count != mysqli_num_rows($query)){
						echo '<tr><td><hr /></td></tr>';
					}
					
				}
			}else{echo 'U heeft nog geen aankopen gemaakt!';}
			
			echo'</table>
			</form>
			</div>
			<div class="content_bottom"></div>';
			
			echo '<div class="content_top"></div>
			<div class="content_title">Verzonden Emails</div>
			<div class="content_mid">
			<form method="POST">
			<table>';
			$query = mysqli_query($conn,"SELECT * from contact where user_id = $AccountID ORDER BY handled = 'Nee' DESC");
			$count = 0;
			if(mysqli_num_rows($query) != 0){
			while($row = mysqli_fetch_array($query)){
				$Enaam = $row['naam'];
				$Eemail = $row['email'];
				$Emessage = $row['message'];
				$Ehandled = $row['handled'];
				$count++;
					echo '<tr><td><b>Naam:</b> <td> '.$Enaam.'</td></td></tr>
						<tr><td><b>Uw Email:</b> <td> '.$Eemail.'</td></td></tr>
						<tr><td><b>Bericht: </b><td> <textarea rows="4" style="width:500px;" disabled>'.$Emessage.'</textarea></td></td></tr>
						<tr><td><b>Verwerkt?</b> <td> '.$Ehandled.'</td></td></tr>';
					if($count != mysqli_num_rows($query)){
						echo '<tr><td><hr /></td></tr>';
					}
					
				}
			}else{
				echo 'U heeft nog geen emails verzonden!';
			}
			
			echo'</table>
			</form>
			</div>
			<div class="content_bottom"></div>';
		}else{
			
			echo '<div class="content_top"></div>
			<div class="content_title">GEEN TOEGANG</div>
			<div class="content_mid"><font color="red"></font></div>
			<div class="content_bottom"></div>';
		}

		