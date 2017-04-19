<?php	
		if($LoggedIn == true)
		{
			if($Admin >=1)
			{
				if(isset($_POST['delete'])) {
					$ID = $_POST['ticketID'];
					mysqli_query($conn,"DELETE FROM tickets WHERE ID = $ID");
					
				} 


				$query = mysqli_query($conn,"SELECT * FROM tickets ORDER BY date DESC ");
				while($row = mysqli_fetch_array($query)){
					$dbID = $row['ID'];
					$dbVoornaam = $row['voornaam'];
					$dbAchternaam = $row['achternaam'];
					$dbWoonplaats = $row['woonplaats'];
					$dbPostcode = $row['postcode'];
					$dbTicket = $row['ticket'];
					$dbDate = $row['date'];
					$dbAantal = $row['aantal'];
					$dbPrice = $row['price'];
					
					echo '<div class="content_top"></div>
						<div class="content_title"></div>
						<div class="content_mid">
						<form method="POST">
							<table>
								<tr><td>Naam: <td>'.$dbVoornaam.' '.$dbAchternaam.' </td></td></tr>
								<tr><td>Woonplaats: <td>'.$dbWoonplaats.' </td></td></tr>
								<tr><td>Postcode: <td>'.$dbPostcode.' </td></td></tr>
								<tr><td>Ticket: <td>'.$dbTicket.' </td></td></tr>
								<tr><td>Aantal: <td>'.$dbAantal.' </td></td></tr>
								<tr><td>Price: <td>'.$dbPrice.' </td></td></tr>
								<tr><td>Datum: <td>'.$dbDate.' </td></td></tr>
								<tr><td><input type="text" value="'.$dbID.'" name="ticketID" hidden /><input type="submit" name="delete" value="delete" /></td></tr>
							</table>
						</form>
						</div>
						<div class="content_bottom"></div>';	
				}
			}else{
				echo '<b><font color="red">GEEN TOEGANG, TE LAAG ADMIN LEVEL</font></b>';
			}
		}else
		{
			
		}
		
