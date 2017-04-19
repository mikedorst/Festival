<?php

		echo '<div class="content_top"></div>
			<div class="content_title">Contact</div>
			<div class="content_mid">Manager: Mike Dorst<br />
			Telefoonnummer: 0612345678</div>
			<div class="content_bottom"></div>';
		
		echo '<div class="content_top"></div>
			<div class="content_title">Locatie</div>
			<div class="content_mid">TechnoFesti 43<br />
			<a href="https://www.google.nl/maps/place/Waterlandsebos/@52.3478336,5.2722598,427m/data=!3m1!1e3!4m5!3m4!1s0x0:0xc4fe883f590b246!8m2!3d52.3451978!4d5.2703208">1358 Almere</a><br/>
			0765635684</div>
			<div class="content_bottom"></div>';
			if($LoggedIn == true)
			{
			if(isset($_POST['CSent']))
			{
			$Name = $_POST['CName'];
			$Email = $_POST['CEmail'];
			$Message = $_POST['CMessage'];
			$Datenow = date("Y-m-d H:i:s");
			mysqli_query($conn,"INSERT INTO contact (naam, email, message, date, user_id) VALUES ('$Name', '$Email', '$Message', '$Datenow', $AccountID)");
			echo '<div class="content_top"></div>
				<div class="content_title">Contact opnemen</div>
				<div class="content_mid">Bericht verzonden! u krijgt binnenkort een email terug!</div>
				<div class="content_bottom"></div>';
			
			}else{
				echo'<div class="content_top"></div>
				<div class="content_title">Contact opnemen</div>
				<div class="content_mid">
				<form method="POST">
					<table>
						<tr><td>Naam: <td><input type="text" name="CName" required/></td><tr>
						<tr><td>Email: <td><input type="email" name="CEmail" required /></td><tr>
						<tr><td>Bericht: <td><textarea rows="4" name="CMessage" style="width:500px;" maxlength="300"required></textarea></td></tr>
						<tr><td><td><i>Maximaal 300 woorden</i></td></td></tr>
						<tr><td><td><input type="submit" name="CSent"/></td><tr>
					</table>
				</form>
				</div>
				<div class="content_bottom"></div>';
			}
			}else{
				if(isset($_POST['CSent']))
			{
			$Name = $_POST['CName'];
			$Email = $_POST['CEmail'];
			$Message = $_POST['CMessage'];
			$Datenow = date("Y-m-d H:i:s");
			mysqli_query($conn,"INSERT INTO contact (naam, email, message, date, user_id) VALUES ('$Name', '$Email', '$Message', '$Datenow', '-1')");
			echo '<div class="content_top"></div>
				<div class="content_title">Contact opnemen</div>
				<div class="content_mid">Bericht verzonden! u krijgt binnenkort een email terug!</div>
				<div class="content_bottom"></div>';
			
			}else{
				echo'<div class="content_top"></div>
				<div class="content_title">Contact opnemen</div>
				<div class="content_mid">
				<form method="POST">
					<table>
						<tr><td>Naam: <td><input type="text" name="CName" required/></td><tr>
						<tr><td>Email: <td><input type="email" name="CEmail" required /></td><tr>
						<tr><td>Bericht: <td><textarea rows="4" name="CMessage" style="width:500px;" maxlength="300"required></textarea></td></tr>
						<tr><td><td><i>Maximaal 300 woorden</i></td></td></tr>
						<tr><td><td><input type="submit" name="CSent"/></td><tr>
					</table>
				</form>
				</div>
				<div class="content_bottom"></div>';
			}
			}
