<?php
		if($LoggedIn == true)
		{
			if($Admin >=1)
			{
				if(isset($_POST['Add']))
				{
						$Date = $_POST['TicketD'];
						$Prijs = $_POST['TicketP'];
						$Datenow = date("Y-m-d H:i:s");
						mysqli_query($conn,"INSERT INTO kaarten (datum, prijs, datetime) VALUES ('$Date', $Prijs, '$Datenow')");
						echo 'Toegevoegt!';
						header("refresh:1");
				}
				if(isset($_POST['delete'])) {
					$ID = $_POST['kaartID'];
					mysqli_query($conn,"DELETE FROM kaarten WHERE ID = $ID");
					
				} 

				echo '<div class="content_top"></div>
								<div class="content_title"></div>
								<div class="content_mid">
								<form method="POST">
									<table>
										<tr><td>Datum: <td><input type="text" name="TicketD" required/></td><td/><tr>
										<tr><td>Prijs: <td><input type="text" name="TicketP" required/></td></td></tr>
										<tr><td><td><input type="submit" name="Add" value="Add" /></td></tr>
									</table>
								</form>
								</div>
								<div class="content_bottom"></div>';
			
				$query = mysqli_query($conn,"SELECT * FROM kaarten ORDER BY Datetime DESC");
						while($row = mysqli_fetch_array($query)){
							$dbDate = $row['datum'];
							$dbPrijs = $row['prijs'];
							$dbID = $row['ID'];
							echo '<div class="content_top"></div>
								<div class="content_title"></div>
								<div class="content_mid">
								<form method="POST">
									<table>
										<tr><td>Datum: <td>'.$dbDate.' </td></td></tr>
										<tr><td>Prijs: <td>'.$dbPrijs.' </td></td></tr>
										<tr><td><input type="text" value="'.$dbID.'" name="kaartID" hidden /><input type="submit" name="delete" value="delete" />
									</table>
								</form>
								</div>
								<div class="content_bottom"></div>';
				}
			}else
			{
				echo '<b><font color="red">GEEN TOEGANG, TE LAAG ADMIN LEVEL</font></b>';
			}
		}else
			{
				echo '<div class="content_top"></div>
				<div class="content_title">GEEN TOEGANG</div>
				<div class="content_mid"><font color="red"></font></div>
				<div class="content_bottom"></div>';
			}
		