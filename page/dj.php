<?php
		if($LoggedIn == true && $Admin >= 1)
		{
			if(isset($_POST['DJadd']))
			{
				$dbDJnaam = $_POST['DJnaam'];
				$dbDJtijd = $_POST['DJtijd'];
				$dbDate = $_POST['DJdatum'];
				$dbWeb = $_POST['DJweb'];
				$dbPhoto = $_POST['DJPhoto'];
				
				$query = mysqli_query($conn,"INSERT INTO dj (naam, tijd, datum, web, foto) VALUES ('$dbDJnaam', '$dbDJtijd', '$dbDate', '$dbWeb', '$dbPhoto')");
				echo 'Toegevoegt';
				header("refresh:1");
			}
			
			if(isset($_POST['DJdelete']))
			{
				$dbID = $_POST['DJid'];
				$query = mysqli_query($conn,"DELETE FROM dj WHERE ID = '$dbID'");
				header("refresh:0");
			}


			echo '<div class="content_top"></div>
				<div class="content_title">DJ toevoegen</div>
				<div class="content_mid">
				<form method="POST">
					<table>
							<tr><td>DJ Naam: <td> <input type="text" name="DJnaam"/></td></td></tr>
							<tr><td>Tijd optreden: <td> <input type="text" name="DJtijd"/></td></td></tr>
							<tr><td>DJ website: <td> <input type="text" name="DJweb"/></td></td></tr>
							<tr><td>DJ Foto: <td> <input type="text" name="DJPhoto"/></td></td></tr>
							<tr><td>Dag: <td> <input type="text" name="DJdatum"/></td></td></tr>
							<tr><td><td><input type="Submit" value="Toevoegen" name="DJadd"/></td></td></tr>
					</table>
				</form>
				
				</div>
				<div class="content_bottom"></div>';
				
			$query = mysqli_query($conn,"SELECT * from dj");
			while($row = mysqli_fetch_array($query)){
				$DJ = $row['naam'];
				$Tijd = $row['tijd'];
				$Date = $row['datum'];
				$Web = $row['web'];
				$ID = $row['ID'];
				
				echo '<div class="content_top"></div>
					<div class="content_title"></div>
					<div class="content_mid">
					<form method="POST">
						<table>
								<tr><td><input type="text" value='.$ID.' name="DJid" hidden/> </td></tr>
								<tr><td>DJ Naam: <td> <a href='.$Web.'>'.$DJ.'</a> </td></td></tr>
								<tr><td>Tijd optreden: <td> '.$Tijd.'</td></td></tr>
								<tr><td>Datum optreden: <td> '.$Date.'</td></td></tr>
								<tr><td><td><input type="Submit" value="Delete" name="DJdelete"/></td></td></tr>
						</table>
					</form>
					
					</div>
					<div class="content_bottom"></div>';
			}
		}
		else{
			echo '<div class="content_top"></div>
			<div class="content_title">GEEN TOEGANG</div>
			<div class="content_mid"><font color="red"></font></div>
			<div class="content_bottom"></div>';
		}