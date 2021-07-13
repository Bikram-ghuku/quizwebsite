
<?php
$con = mysqli_connect("sql107.epizy.com","epiz_25341429","nMPF0SINcgSq","epiz_25341429_login");
$q = mysqli_real_escape_string($db,$_GET["q"]);
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,$q);

echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo  $row;
}
echo "</table>";

mysqli_close($con);
?>