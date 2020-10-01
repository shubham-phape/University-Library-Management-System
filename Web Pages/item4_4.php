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
		<h1 align="center" style="color:#ffffff;"> Return a Book</h1>
	</div>
		<div class="division_2">
		<h4 align="center"><font color="red"></font> </h4>
			<table class="table">
				<form align="center" id="form_1" method="post">
					<tr>
						<td><label> Enter the ISBN of the Book to be returned.<font color="red"></font></label></td>
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
					//getting the cardno and books isbn.
					//getting ssn associated with taht card no
					$card_result=mysqli_query($link,'SELECT mssn FROM card WHERE card_no= \''.$card_no.'\'') or die ("Error: ".mysqli_error($link));
						$match_ssn=mysqli_fetch_array($card_result);
					//getting details about that member through his ssn in MEMBERS table
					$member_result=mysqli_query($link,'SELECT * FROM members WHERE ssn= \''.$match_ssn['mssn'].'\'') or die ("Error: ".mysqli_error($link));
						$member= mysqli_fetch_array($member_result);
					$result=mysqli_query($link,'SELECT * FROM books_onloan WHERE book_isbn= \''.$isbn.'\' AND m_ssn=\''.$member['ssn'].'\'') or die ("Error: ".mysqli_error($link));
						$loan_details= mysqli_fetch_array($result);
					$get_book=mysqli_query($link,'SELECT * FROM books_catalog WHERE isbn= \''.$isbn.'\'') or die ("Error: ".mysqli_error($link));
						$row= mysqli_fetch_array($get_book);
					if($result->num_rows == 1 ){
						if($member['books_onloan']>0){
							$count_books=$member['books_onloan']-1;
							$enter_ssn=$member['ssn'];
							$enter_isbn=$row['isbn'];
							$inc_books_catalog=$row['no_books_on_loan']-1;
							//updatequery
								$updtae_books_onloan=mysqli_query($link,"UPDATE books_onloan SET return_flag=1 WHERE  book_isbn= $enter_isbn AND m_ssn= $enter_ssn ")or die("Error: ".mysqli_error($link));
							//updatequery
								$update_members=mysqli_query($link,"UPDATE members SET books_onloan= '$count_books' WHERE ssn= $enter_ssn  ")or die("Error: ".mysqli_error($link));
							//updatequery
								$update_books_catalog=mysqli_query($link,"UPDATE books_catalog SET no_books_on_loan= '$inc_books_catalog' WHERE isbn= $enter_isbn ")or die("Error: ".mysqli_error($link));
						
						 	echo"<tr><td  colspan='5'>";	
							
							echo"<tr>								
								<td colspan='3' align='center'><h3> Return Summary: <br></td>
								<td></td>
							</tr>
							<tr>
								<td> Book ISBN: </td>
								<td>{$loan_details['book_isbn']}</td>
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
								<td>Edition: </td>
								<td>{$row['edition']}</td>
								<td>Binding:</td>
								<td>{$row['binding']}</td>
							</tr>";
											
							echo"</td><td colspan='5'>
								<tr>
									<td colspan='3'><h3>Member Details</td>
								</tr>
								<tr>
									<td>Member Name:</td>
									<td>{$member['NAME']}</td>
								</tr>
								<tr>
									<td>Member Type</td>
									<td>{$member['member_type']}</td>
								
									<td>Current Books On loan</td>
									<td>{$member['books_onloan']}</td>
								</tr></td>";
								$date=date('Y-d-m');
								$temp_display_issuse=new DateTime($loan_details['book_issue_date']);
								$display_issuse=$temp_display_issuse->format('Y-d-m');
								$temp_display_return=new DateTime($date);
								$display_return=$temp_display_return->format('Y-d-m');
								
							echo"<td>
									<tr>
										<td colspan='3'><h3>Book Loan details</td>
									</tr>
									<tr>
										<td colspan='2'>Book Borrow Date</td>
										<td colspan='2'>{$display_issuse}</td>
									</tr><tr>
										<td colspan='2'>Book Return Date</td>
										<td colspan='2'>{$display_return}</td>
									</tr>
							</td></tr>
							<tr><td colspan='5'>
								<h3 align='center'><font color='green'>BOOK HAS BEEN RETURNED SUCCESSFULLY
							<td><tr>";			
						
					}
					else echo"	<tr>								
									<td colspan='3'><h3><font color='red'>NO BOOKS ON LOAN FOR THIS MEMBER</td>							
								</tr>";	
					}else 
						echo"	<tr>								
									<td colspan='3'><h3><font color='red'>Invalid ISBN or Card no or no such borrow record exist.</td>							
								</tr>";
				}
				$_POST = array();
				?>	
				</form>
			</table>
		</div>
		
	
</body>
</html>