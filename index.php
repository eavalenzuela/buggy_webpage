
<!--
Take-home test material, 10/6/2017
Eric Valenzuela, eavalenzuela7@gmail.com
-->

<html>
<head>
	<title>PingMe!</title>
</head>
<body>

<?php 
$ping = "default";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$ping = $_POST["ping"];
}
?>

<form
action= ""
method= "POST" >

Ping: <input type="text" name="ping" />
<br>
<input type="submit" name="submit" value="Submit" />
</form>

<?php
///Command Injection:
echo "Pinging: " . $_REQUEST["ping"] . " \n ";
$pingit = "ping -c 4 $ping";
///echo 'pingit: ' . $pingit;
echo shell_exec($pingit);
?>

<br>
<br>

<form
action = ""
method = "POST" >

Comment: <input type="text" name="comment" />
<br>
<input type="submit" name="submit" value="Submit" />
</form>

<?php
///Reflected XSS:
echo "Comment: " . $_REQUEST["comment"] . " \n ";

?>

<br>
<br>

<p>Am I an admin?</p>
<form
action = ""
method = "POST" >
<input type="submit" name="check" value="Check" />
</form>

<?php
if (!isset($_COOKIE["user"]))
{
	echo "You're not an admin.\n";
	echo "Creating appropriate cookie.\n";
	$cs = base64_encode("non-admin");
	///echo $cs;
	setcookie("user", $cs, time() + (86400), "/");
}
elseif (base64_decode($_COOKIE["user"]) != "admin")
{
	echo "You're not an admin.";
}
else
{
	echo "You ARE an admin!";
}
?>

</body>
</html>





