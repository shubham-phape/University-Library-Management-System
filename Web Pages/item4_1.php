<?php
include 'dbconnect.php';
$status=false;
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
	padding-top: 80px;
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
		<h1 align="center" style="color:#ffffff;"> ADD NEW MEMBER</h1>
	</div>
	<div class="division_2">
	<h4 align="right"><font color="red">*</font> indicates mandatory</h4>
	<?php
	
    if( $status ) {
      if( $result ) {
		 
        echo "<script type='text/javascript'>alert('Data submitted successfully!')</script>";
	  }
      else
        echo "<script type='text/javascript'>alert('failed to Insert data!')</script>";
    }
	?>
	<table class="table">
		<form align="center" action="item4_1.php" method="post">
				<tr>
					<td><label> Member SSN<font color="red">*</font></label></td>
					<td><input type="text" name="member_ssn" id="member_ssn" class="form-control" pattern="[1-9]{1}[0-9]{8}" required></td>					
				</tr>
				<tr>
					<td><label> Member Name<font color="red">*</font></label></td>
					<td><input type="text" name="member_name" id="member_name" class="form-control" required></td>					
				</tr>
				<tr>
					<td><label> Member Home Address<font color="red">*</font></label></td>
					<td><input type="text" name="member_home_add" id="member_home_add" class="form-control" required></td>					
				</tr>
				<tr>
					<td><label> Member Campus Address</label></td>
					<td><input type="text" name="member_camp_add" id="member_camp_add" class="form-control"></td>					
				</tr>					
				<tr><td></td>
					<td><button class="button1" type="submit" name="submit" id="submit">Submit</button></td>
				</tr>
			
		</form>
		<?php
			if (isset($_POST['submit'])){
	$status=true;
	$ssn=$_POST['member_ssn'];
	$name=$_POST['member_name'];
	$camp_add=$_POST['member_camp_add'];
	$home_add=$_POST['member_home_add'];
	$member_type="Student";
	$random_card_no=rand(100000000,999999999);
	$issue_date=date('Y-m-d');
	$expiry_date_card=date('Y-m-d', strtotime('+4 years'));
	
	$temp_expiry_date_card=date('Y-m-d', strtotime('+4 years'));
	$date = new DateTime($temp_expiry_date_card);
	$date=$date->modify('-1 month');
	$notice_date=$date->format('Y-m-d');

	$result=mysqli_query($link,"INSERT INTO members(ssn, NAME, campus_address, home_address, member_type) VALUES('$ssn' , '$name' , '$camp_add' , '$home_add' , '$member_type')")or die("Error: ".mysqli_error($link));	
	$card_insert=mysqli_query($link,"INSERT INTO  card ( card_no ,  issuse_date ,  expiry_date ,  notice_date  ,  mssn)  VALUES ( '$random_card_no' , '$issue_date' , '$expiry_date_card' , '$notice_date' , '$ssn' )")or die("Error: ".mysqli_error($link));
	
	if($result){
		echo"
		<tr><td colspan='5'><h3><font color='green'>Congratulation you are a member now.</td></tr>
		<tr>
			<td>Member Name: </td>
			<td>{$name}</td>
		</tr>		
		<tr>
			<td>Card no: </td>
			<td>{$random_card_no}</td>
		</tr>
		<tr>
			<td>Card Expiry Date</td>
			<td>{$expiry_date_card}</td>
		</tr>
		";
	}
	
	
	
	
	}
	
		
		?>
		</table>
	</div>
	
</body>
</html>