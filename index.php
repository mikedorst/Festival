<?php
session_start();
require_once("assets/include/config.php");

if(!empty($_SESSION['Username']) && !empty($_SESSION['AccountID'])){
	$LoggedIn = true;
	$Username = $_SESSION['Username'];
	$AccountID = $_SESSION['AccountID'];
	$Admin = $_SESSION['Admin'];
}else{
	$LoggedIn = false;
}

?>

<?php
date_default_timezone_set('Europe/Amsterdam');
$Timezone = date_default_timezone_get();
$Datenow = date('m/d/Y h:i:s a', time());
?>

<!DOCTYPE html>
<html lang="nl"> 
<head> 
<meta charset="utf-8">
<meta name="Author" content="Mike Dorst">
<meta name="Keywords" content="Keywords" />
<meta name="Description" content="Description" />
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="assets/img/Icon.jpg" type="image/vnd.microsoft.icon" />
<?php
if(isset($_GET['p']) && $_GET['p'] != "")
{ 
	$p = $_GET['p'];
	$p2 = ucfirst($p);
}else{ $p2= 'Home';}
echo '<title>Zomer Dancefestival &bull; '.$p2.'</title>';
?>
</head>
<body>

<div id="container">
	<div id="header"></div>
	<div id="nav">
		<ul>
		<?php
			if($p2 == "Home"){ echo '<li><a class="active" href="?p=home"><strong>Home</strong></a></li>'; }
			else{ echo '<li><a href="?p=home"><strong>Home</strong></a></li>'; }
			if($p2 == "Over"){ echo '<li><a class="active" href="?p=over">Over ons</a></li>'; }
			else{ echo '<li><a href="?p=over">Over ons</a></li>'; }
			if($p2 == "Artiesten"){ echo '<li><a class="active" href="?p=artiesten">Artiesten</a></li>'; }
			else{ echo '<li><a href="?p=artiesten">Artiesten</a></li>'; } 
				if($p2 == "Nieuws/Reviews"){ echo '<li><a class="active" href="?p=Nieuws">Nieuws/Reviews</a></li>'; }
			else{ echo '<li><a href="?p=Nieuws">Nieuws/Reviews</a></li>'; }
			if($LoggedIn == true){
				if($p2 == "Kaarten"){ echo '<li><a class="active" href="?p=kaarten">Kaarten</a></li>'; }
				else{ echo '<li><a href="?p=kaarten">Kaarten</a></li>'; } 
			}			
			if($p2 == "Contact"){ echo '<li><a class="active" href="?p=contact">Contact</a></li>'; }
			else{ echo '<li><a href="?p=contact">Contact</a></li>'; }
			
		
			
			if($LoggedIn == false){
				if($p2 == "Register"){ echo '<li style="float:right"><a class="active" href="?p=register">Register</a></li>'; }
				else{ echo '<li style="float:right"><a href="?p=register">Register</a></li>'; }
				if($p2 == "Login"){ echo '<li style="float:right"><a class="active" href="?p=login">Login</a></li>'; }
				else{ echo '<li style="float:right"><a href="?p=login">Login</a></li>'; }
				echo '<li style="float:right">Welkom Gast!</li>'; 
			}else{
				echo '<li style="float:right"><a href="?p=logout">Logout</a></li>';
				if($p2 == "Account"){ echo '<li style="float:right"><a class="active" href="?p=account">Account</a></li>'; }
				else{ echo '<li style="float:right"><a href="?p=account">Account</a></li>'; } 
				if($Admin >= 1)
				{
					if($p2 == "Aankopen"){ echo '<li style="float:right"><a class="active" href="?p=aankopen">Aankopen</a></li>'; }
					else{ echo '<li style="float:right"><a href="?p=aankopen">Aankopen</a></li>'; }
					if($p2 == "Tickets"){ echo '<li style="float:right"><a class="active" href="?p=tickets">Tickets</a></li>'; }
					else{ echo '<li style="float:right"><a href="?p=tickets">Tickets</a></li>'; }
					if($p2 == "DJ's"){ echo '<li style="float:right"><a class="active" href="?p=dj">DJ</a></li>'; }
					else{ echo '<li style="float:right"><a href="?p=dj">DJ</a></li>'; }
				}
				if($Admin == 1337)
				{
					if($p2 == "Emails"){ echo '<li style="float:right"><a class="active" href="?p=email">Emails</a></li>'; }
					else{ echo '<li style="float:right"><a href="?p=email">Emails</a></li>'; }
				if($Admin >= 2)	
				{
					if($p2 == "Beheer"){ echo '<li style="float:right"><a class="active" href="?p=beheer">Beheer</a></li>'; }
					else{ echo '<li style="float:right"><a href="?p=beheer">Beheer</a></li>'; }
					echo '<li class="text" style="float:right"><img src="assets/img/crown_gold.gif"/> Welkom '.$Username.'!</li>'; 
				}
				
				}
				if($Admin == 1)
				{
					echo '<li class="text" style="float:right"><img src="assets/img/crown_silver.gif"/> Welkom '.$Username.'!</li>'; 
				}
				if($Admin == 0)
				{
					echo '<li class="text" style="float:right"><img src="assets/img/crown_green.gif"/> Welkom '.$Username.'!</li>'; 
				}
			}					
				
			
			
		?>
		</ul>
	</div>
	<div id="content">
	<?php
		if(isset($_GET['p']) && $_GET['p'] != ""){
			$p = $_GET['p'];
			$p = "page/".$p.".php";
			if(file_exists($p)){ include("$p"); }
			else include("page/error.php");				
		}else include("page/home.php");
	?>
	</div>
</div>
<div id="footer">Copyright 2017-2017 @Mike Dorst</div>
</body>
</html>