<?php
include 'dbconnect.php';
$query=mysqli_query($link,"Select isbn,title,author,available_books,edition,binding from books_catalog")or die("Error: ".mysqli_error($link));	
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
	<h1 align="center" style="color:#ffffff;">Books Catalog</h1>
	</div>
	<div class="division_2">
		<table  align="center" cellspacing="20" class="table">
			<tr align="center">
				<td><h3>ISBN</h3></td>
				<td><h3>Title</h3></td>
				<td><h3>Author</h3></td>
				<td><h3>No of copies Available</h3></td>
				<td><h3>Edition</h3></td>
				<td><h3>Binding Type</td></tr>
			<?php 
			while($row = mysqli_fetch_array ($query) ) {
			echo"
			<tr >
				<td>{$row['isbn']}</td>
				<td>{$row['title']}</td>
				<td>{$row['author']}</td>
				<td>{$row['available_books']}</td>
				<td>{$row['edition']}</td>
				<td>{$row['binding']}</td>
			</tr>";
			}
			?>
		</table>
	</div>


</body>
</html>