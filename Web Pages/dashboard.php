<?php
include 'dbconnect.php';

?>
<html>
<style>
.button {
  background-color: #8c9eff; 
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

.button2:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
.division{
	align: center;
	background-color: #1976d2;
	padding-top: 10px;
	padding-bottom: 10px;
}
.division_2{
	padding-top: 30px;
	padding-bottom: 6px;
	box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
.division_3{
	align: right;
	padding-top: 10px;
	padding-bottom: 5px;
	padding-left: 20px;
	padding-right: 30px;
	box-shadow: 4px 5px 7px 0 rgba(0,0,0,0.24),0 5px 7px 0 rgba(0,0,0,0.19);
	
}
</style>
<Title>Dashboard</Title>
<head></head>
<body>
	<?php
	$query=mysqli_query($link,"Select * from books_catalog")or die("Error: ".mysqli_error($link));
	$result=mysqli_fetch_array( $query );
	//echo $result['isbn'];
	?>
	<div id="part_1" class="division" >
		<h1 align="center" style="color:#ffffff;">Database Systems</h1>
		<h3 align="center" style="color:#ffffff;">Project 3 Part 3</h3>
	</div>
	<div class="division_2">
		<!-- displaying details about item 2-->
		<div id="item_2" class="division_3">
			<div id="item2_content" >
				<h3 >2. Write queries to retrieve and print all the data you entered. Try to print the data so that it is easy to understand.
			</div>
			<div>
				<h4 align="right"><a href="item2.php"><button id="bt_item_2" class="button button1"> ITEM 2 >></button></a></h4>	
			</div>
		</div>
		<!-- displaying details about item 3-->
		<div id="item_3" class="division_3">
			<div id="item3_content" >
				<h3 >3. Write a query that will prepare a report for weekly Borrowing activity by Subject area, by Author, number of copies and number of days loaned out.
			</div>
			<div>
				<h4 align="right"><button id="bt_item_3" class="button button1"> ITEM 3 >></button></h4>	
			</div>
		</div>
		<!-- displaying details about item 4.1 -->
		<div id="item_41" class="division_3">
			<div id="item41_content" >
				<h3 >4.1  The first transaction is to add information about a new MEMBER.
			</div>
			<div>
				<h4 align="right"><a href="item4_1.php"><button id="bt_item_41" class="button button1"> ITEM 4.1 >></button></a></h4>	
			</div>
		</div>
		<!-- displaying details about item 4.2 -->
		<div id="item_42" class="division_3">
			<div id="item42_content" >
				<h3>4.2  The second transaction is to add all the information about a new BOOK.
			</div>
			<div>
				<h4 align="right"><a href="item4_2.php"><button id="bt_item_42" class="button button1"> ITEM 4.2 >></button></a></h4>	
			</div>
		</div>
		<!-- displaying details about item 4.3 -->
		<div id="item_43" class="division_3">
			<div id="item43_content" >
				<h3>4.3  The third transaction is to add all the information about a new BORROW (LOAN) (this must find the book from the catalog).
			</div>
			<div>
				<h4 align="right"><a href="item4_3.php"><button id="bt_item_43" class="button button1"> ITEM 4.3 >></button></a></h4>	
			</div>
		</div>
		<!-- displaying details about item 4.4 -->
		<div id="item_44" class="division_3">
			<div id="item44_content" >
				<h3>4.4  The fourth transaction is to handle the return of a book. This transaction should print a return receipt with the details of the book and days when it was borrowed and returned etc. 
			</div>
			<div>
				<h4 align="right"><a href="item4_4.php"><button id="bt_item_44" class="button button1"> ITEM 4.4 >></button></a></h4>	
			</div>
		</div>
		<!-- displaying details about item 4.5 -->
		<div id="item_45" class="division_3">
			<div id="item44_content" >
				<h3> 4.5  The fifth transaction is to renew the membership.
			</div>
			<div>
				<h4 align="right"><a href="item4_5.php"><button id="bt_item_45" class="button button1"> ITEM 4.5 >></button></a></h4>	
			</div>
		</div>
		
		
	</div>
	
	

</body>
</html>