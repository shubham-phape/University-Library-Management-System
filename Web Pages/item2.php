
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
	align: center;
	padding-top: 50px;
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
	
}</style>
<head></head>
<body>
	<div id="part_1" class="division" >
		<h1 align="center" style="color:#ffffff;">ITEM 2</h1>
		
	</div>
	<div class="division_3">
		<h3 align="center" style="color:#1976d2;">Click on the table name to view the loaded Data</h3>
	</div>
	<div class="division_2">
		<table  align="center" cellspacing="60">
			<tr>
				<td><a href="item2_books_catlog.php"><button id="bt_item_3" class="button button1"> BOOKS CATALOG</button></a></td>
				<td><a href="item2_members.php"><button id="bt_item_3" class="button button1"> MEMBERS </button></a></td>
				<td><a href="item2_cards.php"><button id="bt_item_3" class="button button1"> CARDS </button></a></td>
				<td><a href="item2_books_onloan.php"><button id="bt_item_3" class="button button1"> BOOKS ON LOAN </button></a></td>
			</tr>
		</table>
	</div>
</body>
	
</html>
