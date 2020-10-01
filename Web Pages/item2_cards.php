<?php
include 'dbconnect.php';
$query=mysqli_query($link,"Select card_no, issuse_date, expiry_date, mssn from card")or die("Error: ".mysqli_error($link));	
?>
<html>
<style>
.division{
	align: center;
	background-color: #1976d2;
	padding-top: 10px;
	padding-bottom: 10px;
}
.division_2{
	align: center;
	padding-top: 40px;
	padding-bottom: 6px;
	box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
table {
  border-collapse: collapse;
}
th,
td {
  border-bottom: 1px solid #cecfd5;
  padding: 10px 15px;
}
</style>
<head></head>
<body>
	<div class="division">
	<h1 align="center" style="color:#ffffff;">Members Card</h1>
	</div>
	<div class="division_2">
		<table  align="center" cellspacing="20" class="table">
			<tr align="center">
				<td><h3>CARD NO</h3></td>
				<td><h3>MEMBER SSN</h3></td>
				<td><h3>CARD ISSUE DATE</h3></td>
				<td><h3>CARD EXPIRY DTAE</h3></td>
			<?php 
			while($row = mysqli_fetch_array ($query) ) {
				$temp_iss=new DateTime($row['issuse_date']);
				$temp_ex=new DateTime($row['expiry_date']);
				$display_expiry=$temp_ex->format('Y-d-m');
				$display_issue=$temp_iss->format('y-d-m');
			echo"
			<tr >
				<td>{$row['card_no']}</td>
				<td>{$row['mssn']}</td>
				<td>{$display_issue}</td>
				<td>{$display_expiry}</td>
			</tr>";
			}
			?>
		</table>
	</div>


</body>
</html>