		<?php
		
		if($LoggedIn == true)
		{
		
			if(isset($_POST['delete'])) {
				$ID = $_POST['newsid'];
				mysqli_query($conn,"DELETE FROM nieuws WHERE ID = $ID");
				header("Refresh:0");
			}
			if(isset($_POST['editchange'])){
				$ID = $_POST['newsid'];
				$dbOpmerkingChange = $_POST['Opmerkingedit'];
				mysqli_query($conn, "UPDATE nieuws SET opmerking='$dbOpmerkingChange' WHERE ID =$ID");
				echo 'AANGEPAST';
				header("Refresh:1");
				
			}
		
			if(isset($_POST['editchange'])){
				$ID = $_POST['newsid'];
				$dbOpmerkingChange = $_POST['Opmerkingedit'];
				mysqli_query($conn, "UPDATE nieuws SET opmerking='$dbOpmerkingChange' WHERE ID =$ID");
				echo 'AANGEPAST';
				header("Refresh:1");
			}
		
			if(isset($_POST['edit'])){
				$dbID = $_POST['newsid'];
				echo '<form method="POST">
					<tr><td><input type="text" value="'.$dbID.'" name="newsid" hidden /></td></tr>
					<tr><td>EDIT HERE: <td> <textarea rows="4" name="Opmerkingedit" style="width:180px;" maxlength="200" required></textarea></td></td></tr>
					<tr><td><input type="submit" name="editchange" value="confirm"/></td></tr>
					</form>';
			}
			
			if(isset($_POST['btnPost'])){

				$Naam = mysqli_real_escape_string($conn, $_POST['NieuwsNaam']);
				$Opmerking = mysqli_real_escape_string($conn, $_POST['NieuwsOpmerking']);
				$Datenow = date("Y-m-d H:i:s");
				
				mysqli_query($conn,"INSERT INTO nieuws (naam, opmerking, user_id, date) VALUES ('$Naam','$Opmerking',$AccountID, '$Datenow')");
				echo '<div class="content_top"></div>
				<div class="content_title">Nieuws</div>
				<div class="content_mid">Nieuws post opgeslagen!</div>
				<div class="content_bottom"></div>';
				header("Refresh:2");
				
			}else{
				echo '<div class="content_top"></div>
				<div class="content_title">Nieuws Posten</div>
				<div class="content_mid">
				<form method="POST">
					<table>
						<tr><td>Naam:</td>
						<td><input type="text" name="NieuwsNaam" style="width:180px;" required/></td></tr>
						<tr><td>Opmerking:</td>
						<td><textarea rows="4" name="NieuwsOpmerking" style="width:180px;" maxlength="200" required></textarea></td></tr>
						<tr><td><td><i>Maximaal 200 woorden</i></td></td></tr>
						<td><td><input type="submit" value="Post" name="btnPost"/></td></td>
					</table>
				</form>
				</div>
				<div class="content_bottom"></div>';

			}
			
		}else{
				echo '	<div class="content_top"></div>
					<div class="content_title">Nieuws Posten</div>
					<div class="content_mid">U moet inloggen om nieuws te kunnen posten!
					</div>
					<div class="content_bottom"></div>';
			}
			
		$query = mysqli_query($conn,"SELECT * FROM nieuws ORDER BY date DESC LIMIT 5");
			while($row = mysqli_fetch_array($query)){
				$dbNaam = $row['naam'];
				$dbOpmerking = $row['opmerking'];
				$dbID = $row['ID'];
				$dbDate = $row['date'];
				$dbUser = $row['user_id'];
				echo '<div class="content_top"></div>
					<div class="content_title"></div>
					<div class="content_mid">
					<form method="POST">
						<table>
							<tr><td>Naam: <td>'.$dbNaam.' </td></td></tr>
							<tr><td>Opmerking: <td> <textarea disabled font-size="17px;" rows="4" style="width:500px;">'.$dbOpmerking.'</textarea></td></td></tr>
							<tr><td>Datum: <td>'.$dbDate.' </td></td></tr>';
							if($LoggedIn == true)
							{
							if($dbUser == $AccountID)
							{
								echo '<tr><td><input type="text" value="'.$dbID.'" name="newsid" hidden /><input type="submit" name="delete" value="delete" />
								<input type="submit" name="edit" value="edit" /></td></tr>';
							}
							if($Admin >= 1)
							{
								echo '<tr><td><input type="text" value="'.$dbID.'" name="newsid" hidden /><input type="submit" name="delete" value="delete" />
								<input type="submit" name="edit" value="edit" /></td></tr>';
							}
							}
						echo'</table>
					</form>
					</div>
					<div class="content_bottom"></div>';
			}	
		
		

		