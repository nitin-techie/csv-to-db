<?php

$connect = mysqli_connect('localhost','root','','data');
$sqlSelect = "SELECT * FROM company";
$result = mysqli_query($connect, $sqlSelect);
            
if (mysqli_num_rows($result) > 0) {
?>
<style>
table, th, td {
   border: 1px solid black;
}
</style>
<table id='userTable'>
    <thead>
        <tr>
            <th>S_no</th>
            <th>Cin</th>
            <th>Company</th>
            <th>Date_of_reg</th>
			<th>Month</th>
			<th>State</th>
			<th>Roc</th>
			<th>Status</th>
			<th>Category</th>
			<th>Class</th>
			<th>Type</th>
			<th>Aut_Capital</th>
			<th>Paid_Capital</th>
			<th>Code</th>
			<th>Description</th>
			<th>Address</th>
			<th>Email</th>
	
        </tr>
    </thead>
    <?php
	while ($row = mysqli_fetch_array($result)) {
    ?>

    <tbody>
        <tr>
            <td><?php  echo $row['s_no']; ?></td>
            <td><?php  echo $row['cin']; ?></td>
            <td><?php  echo $row['company']; ?></td>
			<td><?php  echo $row['date_of_reg']; ?></td>
            <td><?php  echo $row['month']; ?></td>
			<td><?php  echo $row['state']; ?></td>
			<td><?php  echo $row['roc']; ?></td>
			<td><?php  echo $row['status']; ?></td>
			<td><?php  echo $row['category']; ?></td>
			<td><?php  echo $row['class']; ?></td>
			<td><?php  echo $row['type']; ?></td>
			<td><?php  echo $row['aut_capital']; ?></td>
			<td><?php  echo $row['paid_capital']; ?></td>
			<td><?php  echo $row['code']; ?></td>
			<td><?php  echo $row['description']; ?></td>
			<td><?php  echo $row['address']; ?></td>
			<td><?php  echo $row['email']; ?></td>
			
        </tr>
     <?php
     }
     ?>
	  </tbody>
</table>
<?php } ?>
