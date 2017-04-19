		<div class="content_top"></div>
		<div class="content_title">Artiesten Festival</div>
		<div class="content_mid">
		Hieronder vindt u informatie over de DJ's die naar het Festival komen, ook vind u de tijden waarin ze draaien:<br><br>
		<tr><td><td><b>Vrijdag</b></td></td></tr>
			<?php
				$query = mysqli_query($conn,"SELECT * FROM dj WHERE datum='Vrijdag'");
				$count = 0;
				while($row = mysqli_fetch_array($query)){
						$DJ = $row['naam'];
						$Tijd = $row['tijd'];
						$Date = $row['datum'];
						$Web = $row['web'];
						$Image = $row['foto'];
						echo'<table>
								<tr><td><img src="'.$Image.'" height="200px;" width="200px;"/>
								<td><a href='.$Web.'>'.$DJ.'</a> '.$Tijd.'</td></td></tr>
							</table>';
					} ?>
				<tr><td><b>Zaterdag</b></td></tr>
				<?php
				$query = mysqli_query($conn,"SELECT * FROM dj WHERE datum='Zaterdag'");
				while($row = mysqli_fetch_array($query)){
						$DJ = $row['naam'];
						$Tijd = $row['tijd'];
						$Date = $row['datum'];
						$Web = $row['web'];
						$Image = $row['foto'];
						echo'<table>							
								<tr><td><img src="'.$Image.'" height="200px;" width="200px;"/>
								<td><a href='.$Web.'>'.$DJ.'</a> '.$Tijd.'</td></td></tr>
							</table>';
					}
			?>
		</div>
		<div class="content_bottom"></div>
		
