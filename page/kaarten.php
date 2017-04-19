		<?php
		
		if($LoggedIn == true)
		{
		echo '<div class="content_top"></div>
		<div class="content_title">Kaarten</div>
		<div class="content_mid">
		<body>
		<form method="POST">
			<table>
				<b>Dag kaart €50, Weekend kaart €85!</b>';
				$query = mysqli_query($conn,"SELECT * FROM kaarten");
				echo'<tr><td>Selecteer een datum:</td>
				<td><select name="Dagen">';
				while ($row = mysqli_fetch_array($query))
				{
					echo '<option font-size="17px" value="'.$row['prijs'].'||'.$row['datum'].'">'.$row['datum'].'</option>';
				}			
				echo '</select></td></tr>
				<tr><td>Aantal Kaarten:</td>';
				echo '<td><Select name="MaxKaarten">';
				
					for($i = 1; $i <= 6; $i++)
					{
					echo "<option value='$i'>$i</option>";
					}
				
				echo '</select>
				<tr><td>Voornaam:</td>
				<td><input type="text" name="Voornaam" required /></td></tr>
				<tr><td>Achternaam:</td>
				<td><input type="text" name="Achternaam"required /></td></tr>
				<tr><td>Postcode:</td>
				<td><input type="text" name="Postcode" maxlength="7" required /></td></tr>
				<tr><td>Woonplaats:</td>
				<td><input type="text" name="Woonplaats" required/></td></tr>
				<tr><td>Credit card:</td>
				<td><input type="text" maxlength="16"  name="creditcardnumber" required /></td></tr>
				<tr><td><td><i>Minimaal 16</i> <i><b>Cijfers</i></b></td></td></tr>
				<tr><td>CVV/CVC Code:</td>
				<td><input type="text" name="creditcheck" maxlength="3" required /></td></tr>
				<tr><td><td><input type="submit" value="Koop" name="btnKoop"/></td></td></td></tr>
			</table>
		</form>
		</body>
		</div>
		<div class="content_bottom"></div>';
		 
		if(isset ($_POST['btnKoop']))
			{ 
			
			$first_number = $_POST['Dagen'];
			$str = $first_number;
			$Data = explode('||', $str);
			$second_number = $_POST['MaxKaarten'];
			
			$sum_total = $second_number * $Data[0];		
			
		
			$Voornaam = $_POST['Voornaam'];
			$Achternaam = $_POST['Achternaam'];
			$Postcode = $_POST['Postcode'];
			$Woonplaats = $_POST['Woonplaats'];
			$Ticket = $Data[1];
			$Credit = $_POST['creditcardnumber'];
			$CVV = $_POST['creditcheck'];
			$Datenow = date("Y-m-d H:i:s");
			$Aantal = $_POST['MaxKaarten'];
			mysqli_query($conn,"INSERT INTO tickets (voornaam, achternaam, woonplaats, postcode, ticket, date, aantal, price, user_id, creditcard, CVV) VALUES ('$Voornaam','$Achternaam','$Woonplaats', '$Postcode', '$Ticket', '$Datenow', $Aantal, $sum_total, $AccountID, '$Credit', '$CVV')");
			echo '<div class="content_top"></div>
			<div class="content_title">Ticket</div>
			<div class="content_mid">Tickets besteld! <br> <i>Uw totale prijs is: </i>'.$sum_total.'</div>
			<div class="content_bottom"></div>';
			}	
		}else
		{
			echo '<div class="content_top"></div>
			<div class="content_title">U MOET EERST INLOGGEN</div>
			<div class="content_mid"><font color="red"></font></div>
			<div class="content_bottom"></div>';
		}
		
		
