<?php
$connect = mysqli_connect('localhost','root','','data'); // First paramater stands for host, Second for Database-user, Third stand for Database-password, Forth Database-name.
if (!$connect) { //Connection is possible using above setting or not
 die('Could not connect to MySQL: ' . mysqli_error());
}

$filepath = "C:\xampp\htdocs\data\importdata\september_csv.csv"; 

if (($getdata = fopen($filepath, "r")) !== FALSE) {
			   fgetcsv($getdata);   
			   while (($data = fgetcsv($getdata)) !== FALSE) {
					$fieldCount = count($data);
					for ($c=0; $c < $fieldCount; $c++) {
					  $columnData[$c] = $data[$c];
					}
			  $s_no = mysqli_real_escape_string($connect ,$columnData[0]);
			 $cin = mysqli_real_escape_string($connect ,$columnData[1]);
			 $company = mysqli_real_escape_string($connect ,$columnData[2]);
			 $date_of_reg = mysqli_real_escape_string($connect ,$columnData[3]);
			 $month = mysqli_real_escape_string($connect ,$columnData[4]);
			 $state = mysqli_real_escape_string($connect ,$columnData[5]);
			 $roc = mysqli_real_escape_string($connect ,$columnData[6]);
			 $status = mysqli_real_escape_string($connect ,$columnData[7]);
			 $category = mysqli_real_escape_string($connect ,$columnData[8]);
			 $class = mysqli_real_escape_string($connect ,$columnData[9]);
			 $type = mysqli_real_escape_string($connect ,$columnData[10]);
			 $aut_capital = mysqli_real_escape_string($connect ,$columnData[11]);
			 $paid_capital = mysqli_real_escape_string($connect ,$columnData[12]);
			 $code = mysqli_real_escape_string($connect ,$columnData[13]);
			 $description = mysqli_real_escape_string($connect ,$columnData[14]);
			 $address = mysqli_real_escape_string($connect ,$columnData[15]);
			 $email = mysqli_real_escape_string($connect ,$columnData[16]);
			 $import_data[]="('".$s_no."','".$cin."','".$company."','".$date_of_reg."','".$month."','".$state."','".$roc."','".$status."','".$category."','".$class."','".$type."','".$aut_capital."','".$paid_capital."','".$code."','".$description."','".$address."','".$email."')";
			// SQL Query to insert data into DataBase			
	
			
			 }
			  $import_data = implode(",", (array)$import_data);
			 $query = "INSERT INTO `company`(`s_no`, `cin`, `company`, `date_of_reg`, `month`, `state`, `roc`, `status`, `category`, `class`, `type`, `aut_capital`, `paid_capital`, `code`, `description`, `address`, `email`) VALUES  $import_data";
			 $result = mysqli_query($connect ,$query);
			 $message .="Data imported successfully.";
			 fclose($getdata);
		
}
echo "Data imported successfully.";
?>