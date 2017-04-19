
		<div class="content_top"></div>
		<div class="content_title">Welkom</div>
		<div class="content_mid">Welkom op de website van het dance festival 2017, op de site kunt u informatie vinden die met het fesival te maken heeft.<br>
		Als u vragen heeft kijk dan bij de contact pagina en neem contact op :) </div>
		<div class="content_bottom"></div>
		
		<div class="content_top"></div>
		<div class="content_title">Kaart verkoop</div>
		<div class="content_mid">Wilt u kaarten koopen voordat het festival begint? <br>
		Maak een <a href="index.php?p=register">account</a> aan en ga over naar <a href="index.php?p=kaarten">kaarten</a>.</div>
		<div class="content_bottom"></div>

		
		<div class="content_top"></div>
		<div class="content_title">Datum Festivals</div>
		<div class="content_mid">
			<table>
			<?php
				$query = mysqli_query($conn,"SELECT datum FROM kaarten ORDER BY Datetime DESC");
				while($row = mysqli_fetch_array($query)){
					$dbDate = $row['datum'];
					echo '<tr><td>'.$dbDate.'</td></tr>';
				}
			?>
			</table>
		</div>
		<div class="content_bottom"></div>
		
		