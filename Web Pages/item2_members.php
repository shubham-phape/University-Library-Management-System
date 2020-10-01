<?php
include 'dbconnect.php';
$query=mysqli_query($link,"Select ssn, NAME, member_type, books_onloan from members")or die("Error: ".mysqli_error($link));	
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
	<h1 align="center" style="color:#ffffff;">Members</h1>
	</div>
	<div class="division_2">
		<table  align="center" cellspacing="20" class="table">
			<tr align="center">
				<td><h3>SSN</h3></td>
				<td><h3>NAME</h3></td>
				<td><h3>MEMBER TYPE</h3></td>
				<td><h3>No of Books on loan</h3></td>
			<?php 
			while($row = mysqli_fetch_array ($query) ) {
			echo"
			<tr >
				<td>{$row['ssn']}</td>
				<td>{$row['NAME']}</td>
				<td>{$row['member_type']}</td>
				<td>{$row['books_onloan']}</td>
			</tr>";
			}
			?>
		</table>
	</div>


</body>
</html>