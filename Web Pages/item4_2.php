<?php
include 'dbconnect.php';
$status=false;

if (isset($_POST['submit'])){
	$status=true;
	$isbn=$_POST['book_isbn'];
	$title=$_POST['book_title'];
	$author=$_POST['book_author'];
	$available_books=$_POST['book_nof_available'];
	$language=$_POST['book_language'];
	$edition=$_POST['book_edition'];
	$binding=$_POST['book_binding'];
	$book_type=$_POST['book_type'];
	$subject_area=$_POST['book_subject_area'];
	$description=$_POST['book_description'];
	$result=mysqli_query($link,"INSERT INTO  books_catalog ( isbn ,  title ,  author ,  available_books , LANGUAGE ,  edition ,  binding ,  book_type ,  subject_area ,  description ) VALUES (  '$isbn' , '$title' , '$author' , '$available_books' , '$language' , '$edition' , '$binding' , '$book_type' , '$subject_area' , '$description'  )")or die("Error: ".mysqli_error($link));	
	}
	 $_POST = array();
?>
<html>
<style>
button {
  background-color: #c50e29; 
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  
}

.button1 {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
}
.division{
	align: center;
	background-color: #1976d2;
	padding-top: 10px;
	padding-bottom: 10px;
	box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
.division_2{
	align: center;
	padding-top: 50px;
	padding-bottom: 6px;
	box-shadow: 5px 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
.division_3{
	padding-top: 5px;
	padding-bottom: 5px;
	box-shadow: 0 1px 1px 0 rgba(0,0,0,0.24),0 1px 1px 0 rgba(0,0,0,0.19);
}
table {
	width: 40%;
    margin-left: auto;
    margin-right: auto;
  border-collapse: collapse;
  align: center
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
		<h1 align="center" style="color:#ffffff;"> ADD NEW BOOK</h1>
	</div>
	<div class="division_2">
	<h4 align="center"><font color="red">*</font> indicates mandatory</h4>
	<?php
	$_POST = array();
    if( $status ) {
      if( $result ) {
		 
        echo "<script type='text/javascript'>alert('Data submitted successfully!')</script>";
	  }
      else
        echo "<script type='text/javascript'>alert('failed to Insert data!')</script>";
    }
	?>
	<table class="table">
		<form align="center" action="item4_2.php" method="post">
				<tr>
					<td><label> Book ISBN<font color="red">*</font></label></td>
					<td><input type="number" name="book_isbn" id="book_isbn" class="form-control" pattern="[1-9]{1}[0-9]{8}" required></td>					
				</tr>
				<tr>
					<td><label> Book Title<font color="red">*</font></label></td>
					<td><input type="text" name="book_title" id="book_title" class="form-control" required></td>					
				</tr>
				<tr>
					<td><label> Book Author<font color="red">*</font></label></td>
					<td><input type="text" name="book_author" id="book_author" class="form-control" required></td>					
				</tr>
				<tr>
					<td><label>No of available Books</label></td>
					<td><input type="number" name="book_nof_available" id="book_nof_available" class="form-control" required></td>					
				</tr>					
				<tr>
					<td><label>language</label></td>
					<td><input type="text" name="book_language" id="book_language" class="form-control" required></td>					
				</tr>					
				<tr>
					<td><label>Edition</label></td>
					<td><input type="number" name="book_edition" id="book_edition" class="form-control" required></td>					
				</tr>	
				<tr>
					<td><label>Binding (Softcover/ Hardcover)</label></td>
					<td><input type="text" name="book_binding" id="book_binding" class="form-control" required></td>					
				</tr>	
				<tr>
					<td><label>Book Type</label></td>
					<td><input type="text" name="book_type" id="book_type" class="form-control"></td>					
				</tr>			
				<tr>
					<td><label>Subject Area</label></td>
					<td><input type="text" name="book_subject_area" id="book_subject_area" class="form-control"></td>					
				</tr>
				<tr>
					<td><label>Description</label></td>
					<td><input type="text" name="book_description" id="book_description" class="form-control"></td>					
				</tr>

				<tr><td></td>
					<td><button class="button1" type="submit" name="submit" id="submit">Submit</button></td>
				</tr>
			
		</form>
		</table>
	</div>
	
</body>
</html>