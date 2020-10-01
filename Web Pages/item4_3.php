<?php
include 'dbconnect.php';
$status= false;
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
<?php
	
    if( $status ) {
      if( $result ) {
		 
        echo "<script type='text/javascript'>alert('Data submitted successfully!')</script>";
	  }
      else
        echo "<script type='text/javascript'>alert('failed to Insert data!')</script>";
    }
	?>
	<div class="division">
		<h1 align="center" style="color:#ffffff;"> Borrow a Book</h1>
	</div>
		<div class="division_2">
		<h4 align="center"><font color="red">Search Book</font> </h4>
			<table class="table">
				<form align="center" id="form_1" method="post">
					<tr>
						<td><label> Enter the ISBN of the Book to be borrowed.<font color="red"></font></label></td>
						<td><input type="number" name="book_isbn" id="book_isbn"  class="form-control" pattern="[1-9]{1}[0-9]{8}" placeholder=" BOOK ISBN" required></td>					
					</tr>
					<tr>
						<td><label> Enter the Card Number of Member<font color="red"></font></label></td>
						<td><input type="number" name="member_cardno" id="member_cradno" class="form-control" pattern="[1-9]{1}[0-9]{8}" placeholder="Member Card Number" required></td>					
					</tr>
					<tr>
						<td></td>
						<td><input class="button1" type="submit" name="submit" id="submit"></td>
					</tr>			
				</form>
				<form align='center' method='post'>
				<?php
				if(isset($_POST['book_isbn'])){
					$isbn=	$_POST['book_isbn'];				
					$card_no= $_POST['member_cardno'];
					$result=mysqli_query($link,'SELECT * FROM books_catalog WHERE isbn= \''.$isbn.'\'') or die ("Error: ".mysqli_error($link));
					$card_result=mysqli_query($link,'SELECT mssn FROM card WHERE card_no= \''.$card_no.'\'') or die ("Error: ".mysqli_error($link));
					$match_ssn=mysqli_fetch_array($card_result);
					$row= mysqli_fetch_array($result);
					
					$member_result=mysqli_query($link,'SELECT * FROM members WHERE ssn= \''.$match_ssn['mssn'].'\'') or die ("Error: ".mysqli_error($link));
					$member= mysqli_fetch_array($member_result);
					if($result->num_rows == 1 ){
						 
						
							
							echo"<tr>								
								<td><h3> Book details: <br></td>
								<td></td>
							</tr>
							<tr>
								<td>ISBN: </td>
								<td>{$row['isbn']}</td>
							</tr>
							<tr>
								<td>Title: </td>
								<td>{$row['title']}</td>
							</tr>
							<tr>
								<td>Author: </td>
								<td>{$row['author']}</td>
							</tr>
							<tr>
								<td>Available copies: </td>
								<td>{$row['available_books']}</td>
								<td>Language:</td>
								<td>{$row['LANGUAGE']}</td>
							</tr>
							<tr>
								<td>Edition: </td>
								<td>{$row['edition']}</td>
								<td>Binding:</td>
								<td>{$row['binding']}</td>
							</tr>
							<tr>
								<td>Description</td>
								<td>{$row['description']}</td>
							</tr>";
							$cur_books=$row['available_books']-$row['no_books_on_loan'];
								if($cur_books>0)
									echo"
										<tr>
											<td colspan='2'><h4><font color='green'>This book is avialable to Borrow.
										</td></tr>";
								else echo"
									<tr>
										<td colspan='2'><font color='red'>This book cannot be Issued. Not enough copies available</td>
									</tr>";
							echo"
								<tr>
									<td><h3>Member Details</td>
								</tr>
								<tr>
									<td>Member Name:</td>
									<td>{$member['NAME']}</td>
								</tr>
								<tr>
									<td>Member Type</td>
									<td>{$member['member_type']}</td>
								</tr>
								<tr>
									<td>Current Books On loan</td>
									<td>{$member['books_onloan']}</td>
								</tr>
							";
							if($member['books_onloan']<5 && $cur_books>0 ){
							
								$date1=date("Y-m-d");
								$random= rand(1000,9999);
								$expiry_date=date('Y-m-d', strtotime("+1 months", strtotime($date1)));
								$enter_isbn=$row['isbn'];
								$enter_ssn=$member['ssn'];
								$fklib=mysqli_fetch_array(mysqli_query($link,"SELECT l_emp_id FROM library_staff WHERE l_emp_id=4000"));
								$fklib_value=$fklib['l_emp_id'];
								if($member_result->num_rows==1){
									$result_insert_loan=mysqli_query($link,"INSERT INTO books_onloan(m_ssn,loan_id,cos_emp_id, book_isbn, book_issue_date, book_expiry_date) VALUES('$enter_ssn','$random','$fklib_value','$enter_isbn','$date1','$expiry_date')")or die("Error: ".mysqli_error($link));
									if($result_insert_loan){
										$count_books=$member['books_onloan']+1;
										$result_incr_loancounter=mysqli_query($link,"UPDATE members SET books_onloan= '$count_books' WHERE ssn= $enter_ssn  ")or die("Error: ".mysqli_error($link));
										$inc_books_catalog=$row['no_books_on_loan']+1;
										$incr_book_onloan_incatalog=mysqli_query($link,"UPDATE books_catalog SET no_books_on_loan= '$inc_books_catalog' WHERE isbn= $enter_isbn ")or die("Error: ".mysqli_error($link));
										echo"
											<tr><td colspan='2'><font color='green'><h2>Member has been issued this Book.</td>
											</tr>";	
										}	
								}
								else echo"Invalid SSN";			
							}
							else echo"
								<tr>
									<td colspan='4'><h4><font color='red'>Member has already borrowed 5 books OR Copy of book not available in Library</td>
								</tr>
								<tr><td colspan='4'><font color='red'>MEMBER CANNOT BORROW THIS BOOK</td></tr>";				
						
						
					}else 
						echo"	<tr>								
									<td colspan='3'><h3>INVALID ISBN</td>							
								</tr>";
				}
				$_POST = array();
				?>	
				</form>
			</table>
		</div>
		
	
</body>
</html>