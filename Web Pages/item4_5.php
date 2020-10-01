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
		<h1 align="center" style="color:#ffffff;"> Renew Membership</h1>
	</div>
		<div class="division_2">
		<h4 align="center"><font color="red"></font> </h4>
			<table class="table">
				<form align="center" id="form_1" method="post">
					<tr>
						<td><label> Enter the Card Number of Member to be renewed<font color="red"></font></label></td>
						<td><input type="number" name="member_cardno" id="member_cradno" class="form-control" pattern="[1-9]{1}[0-9]{8}" placeholder="Member Card Number" required></td>					
					</tr>
					<tr>
						<td></td>
						<td><input class="button1" type="submit" name="submit" id="submit"></td>
					</tr>			
				</form>
				<form align='center' method='post'>
				<?php
				if(isset($_POST['member_cardno'])){
						
					$card_no= $_POST['member_cardno'];
					//getting the cardno and books isbn.
					//getting ssn associated with taht card no
					$card_result=mysqli_query($link,'SELECT * FROM card WHERE card_no= \''.$card_no.'\'') or die ("Error: ".mysqli_error($link));
						$match_ssn=mysqli_fetch_array($card_result);
						
					//getting details about that member through his ssn in MEMBERS table
					$member_result=mysqli_query($link,'SELECT * FROM members WHERE ssn= \''.$match_ssn['mssn'].'\'') or die ("Error: ".mysqli_error($link));
						$member= mysqli_fetch_array($member_result);
					
					if($card_result->num_rows == 1 ){
							$card_expiry_date=$match_ssn['expiry_date'];
							$current_date=date('Y-m-d');
							$ts1 = strtotime($current_date);
							$ts2 = strtotime($card_expiry_date);

							$year1 = date('Y', $ts1);
							$year2 = date('Y', $ts2);
							
							$month1 = date('m', $ts1);
							$month2 = date('m', $ts2);
							
							$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
							if($diff<2){
								$expiry_date_card=date('Y-m-d', strtotime('+4 years'));
								$update_card=mysqli_query($link,"UPDATE card SET issuse_date= '$current_date', expiry_date= '$expiry_date_card' WHERE card_no= $card_no ")or die("Error: ".mysqli_error($link));
								 echo"	<tr>								
									<td colspan='3'><h3><font color='green'>CARD RENEWED SUCCESFULLY.</td>							
								</tr>
								<tr>
									<td>Card no:</td>
									<td>{$card_no}</td>
								</tr>
								
								<tr>
									<td>Member Name</td>
									<td>{$member['NAME']}</td>
								</tr>
								<tr>
									<td>Renewed Date</td>
									<td>{$current_date}</td>
								</tr>
								
								<tr>
									<td>New Expiry Date</td>
									<td>{$expiry_date_card}</td>
								</tr>";
							}else echo"	<tr>								
									<td colspan='3'><h3><font color='red'>Cannot renew now your card is still valid.</td>							
								</tr>
									<tr>								
									<td colspan='3'><h3><font color='red'>Retry when there is less than one month to expire.</td>							
								</tr>";
						}else 
						echo"	<tr>								
									<td colspan='3'><h3><font color='red'>Invalid Card number.</td>							
								</tr>";
				}
				$_POST = array();
				?>	
				</form>
			</table>
		</div>
		
	
</body>
</html>