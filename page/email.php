<?php
		
		if($LoggedIn == true)
		{
			if($Admin == 1337)
			{
				if(isset($_POST['Submit']))
				{
					$ID = $_POST['BerichtID'];
					$query = mysqli_query($conn,"UPDATE contact SET handled ='Ja' WHERE ID = $ID");
					header("Refresh:0");
				}



				$query = mysqli_query($conn,"SELECT * from contact WHERE handled = 'Nee' ORDER BY date DESC");
				while ($row = mysqli_fetch_array($query)){
					$dbID = $row['ID'];
					$dbName = $row['naam'];
					$dbEmail = $row['email'];
					$dbBericht = $row['message'];
				echo' <div class="content_top"></div>
				<div class="content_title">Emails</div>
				<div class="content_mid">
				<form method="POST">
					<table>
						<tr><td><input type="text" value="'.$dbID.'" name="BerichtID" hidden /></td></td><tr>
						<tr><td>Naam: <td> '.$dbName.' </td></tr>
						<tr><td>Email: <td> '.$dbEmail.' </td></tr>
						<tr><td>Bericht: <td> <textarea disabled rows="4" style="width:500px;">'.$dbBericht.'</textarea></td></td></tr>
						<tr><td><td><input type="Submit" name="Submit" value="Done" /></td></td></tr>
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
			echo '<div class="content_top"></div>
			<div class="content_title">GEEN TOEGANG</div>
			<div class="content_mid"><font color="red"></font></div>
			<div class="content_bottom"></div>';
		}
		