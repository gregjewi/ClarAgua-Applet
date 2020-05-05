<?
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $file = '/tmp/sample-app.log';
  $message = file_get_contents('php://input');
  file_put_contents($file, date('Y-m-d H:i:s') . " Received message: " . $message . "\n", FILE_APPEND);
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
	<title>ClarAgua</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="web_app.css">
</head>
<body>	

	<script type="text/javascript">
		
		/* Toggle between showing and hiding the navigation menu links when the user clicks on the hamburger menu / bar icon */
		function toggleNavBar(id) {
		  var x = document.getElementById(id);
		  if (x.style.display === "block") {
		    x.style.display = "none";
		  } else {
		    x.style.display = "block";
		  }
		}

	</script>

	<!-- Top Navigation Menu -->
	<div class="topnav">
	  <a href="" class="active">ClarAgua</a>
	  <!-- Navigation links (hidden by default) -->
	  <div id="myLinks">
	  	<a href="./deployments/SCN0001/">SCN0001</a>
	  	<a href="./map/">Map</a>
	  	<a href="javascript:void(0);" onclick="toggleNavBar('About')">About</a>
	    <a href="javascript:void(0);" onclick="toggleNavBar('Contact')">Contact</a>
	  </div>


	  <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
	  <a href="javascript:void(0);" class="icon" onclick="toggleNavBar('myLinks')">
	  	<svg width="30" height="25">
	  		<rect style="fill:white;" height="5" width="30"></rect>
		  	<rect style="fill:white;" y="10" height="5" width="30"></rect>
		  	<rect style="fill:white;" y="20" height="5" width="30"></rect>
		</svg>
	  </a>
	  

	  
	</div>

	<div id="Landing">
		<h1>Smart Chlorinator Network</h1>
		<p>
			Welcome to the Smart Chlorinator Network mobile app: ClarAgua
		</p>
		<p>
			To view live data please navigate to the SCN0001 tab.
		</p>
		<p>
			The ClarAgua mobile app allows technicians and researchers alike to view data from the first Smart Chlorinator installed in La Sirena Nicaragua. This platform will eventually serve all of the Smart Chlorinators across Nicaragua and Honduras, giving technicians the capacity to communicate with and calibrate Smart Chlorinators.
		</p>
	</div>

	<div id="About" style="display: none">
		EOS International installs inline chlorination systems throughout Nicaragua and Honduras. In 2019, in partnership with EOS, a team of UIowa researchers outfitted one chlorinator in La Sirena with water quality sensors and cellular data transmission capacity to bring the chlorinator online. 
	</div>

	<div id="Contact" style="display: none">
		Contact
		<br>
		Graduate Student:
		<br>
		megan-lindmark@uiowa.edu
		<br>
		(913) 378-4505
		<br>
		Applet designed by (mostly) Greg Ewing + Megan Lindmark
	</div>

</body>
</html>
<? 
} 
?>