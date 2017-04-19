		<?php			
			echo '	<div class="content_top"></div>
					<div class="content_title">Nieuws Posten</div>
					<div class="content_mid">U moet inloggen om nieuws te kunnen posten!
					</div>
					<div class="content_bottom"></div>';
					
		$query = mysqli_query($conn,"SELECT * FROM nieuws ORDER BY date DESC LIMIT 5");
		while($row = mysqli_fetch_array($query)){
						$dbNaam = $row['naam'];
						$dbOpmerking = $row['opmerking'];
						$dbDate = $row['date'];
						echo '<div class="content_top"></div>
							<div class="content_title"></div>
							<div class="content_mid">
							<table>
							<tr><td>Naam: <td>'.$dbNaam.' </td></td></tr>
							<tr><td>Opmerking: <td>'.$dbOpmerking.' </td></td></tr>
							<tr><td>Datum: <td>'.$dbDate.' </td></td></tr>
							</table>
							</div>
							<div class="content_bottom"></div>
							';
		}

		