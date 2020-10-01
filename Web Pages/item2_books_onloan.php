<?php
include 'dbconnect.php';
$query=mysqli_query($link,"Select m_ssn, book_isbn,book_issue_date,book_expiry_date,return_flag from books_onloan")or die("Error: ".mysqli_error($link));	
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
	<h1 align="center" style="color:#ffffff;">Books On Loan</h1>
	</div>
	<div class="division_2">
		<table  align="center" cellspacing="20" class="table">
			<tr align="center">
				<td><h3>MEMBER SSN</h3></td>
				<td><h3>BOOK ISBN</h3></td>
				<td><h3>BOOK ISSUE DATE</h3></td>
				<td><h3>BOOK EXPIRY DTAE</h3></td>
				<td><h3>BOOK RETURN STATUS</h3></td>
			<?php 
			while($row = mysqli_fetch_array ($query) ) {
				if($row['return_flag']==1) $status="Returned";
				else $status="Not Returned";
				$temp_iss=new DateTime($row['book_issue_date']);
				$temp_ex=new DateTime($row['book_expiry_date']);
			$display_expiry=$temp_ex->format('Y-d-m');
			$display_issue=$temp_iss->format('y-d-m');
			echo"
			<tr >
				<td>{$row['m_ssn']}</td>
				<td>{$row['book_isbn']}</td>
				<td>{$display_issue}</td>
				<td>{$display_expiry}</td>
				<td>{$status}</td>
			</tr>";
			}
			?>
		</table>
	</div>


</body>
</html>