
<?php
$connect = new PDO('sqlite:companies.db'); // First paramater stands for host, Second for Database-user, Third stand for Database-password, Forth Database-name.

if (!$connect) { //Connection is possible using above setting or not
 die('Could not connect to MySQL: ' . mysqli_error());
}
global $import_data;
$import_data = array();
global $s_no;
global $cin;
global $company;
global $code;
global $status;
global $state;
global $description;
global $aut_capital;
global $paid_capital;
global $address;
global $email;
global $date_of_reg;
global $roc;
global $month;
global $type;
global $category;
global $class;
$class="";
$message='';
$error=0;
$target_dir = dirname(__FILE__)."/Uploads/";
if(isset($_POST["import"]) && !empty($_FILES)) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if($fileType != "csv")  // here we are checking for the file extension. We are not allowing othre then (.csv) extension .
	{
		$message .= "Sorry, only CSV file is allowed.<br>";
		$error=1;
	}
	else
	{
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$message .="File uplaoded successfully.<br>";
 
			if (($getdata = fopen($target_file, "r")) !== FALSE) {
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
						
			   }
			 $import_data = implode(",", (array)$import_data);
			 $query = "INSERT INTO `company` (`s_no`, `cin`, `company`, `date_of_reg`, `month`, `state`, `roc`, `status`, `category`, `class`, `type`, `aut_capital`, `paid_capital`, `code`, `description`, `address`, `email`) VALUES  $import_data";
			 $result = mysqli_query($connect ,$query);
			 if($result!=0)
			 {
			 $message .="Data imported successfully.";
			 }
			 fclose($getdata);
			 
			}
 
		} else {
			$message .="Sorry, there was an error uploading your file.";
			$error=1;
		}
	}
}
$class="warning";
if($error!=1)
{
	$class="success";
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 
</head>
<body>

<div class="container" style="margin-top:20px; margin-bottom:20px;padding:10px;">
<?php
	if(!empty($message))
	{
?>
<div class="btn-<?php echo $class;?>" style="width:30%;padding:10px;margin-bottom:20px;">
<?php
		echo $message;
	
 ?>
</div>
<?php } ?>

<form role="form" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">
<fieldset class="form-group">
	<div class="form-group">
	<input type="file" name="fileToUpload" id="fileToUpload">
	<label for="image upload" class="control-label">Only .csv file is allowed. </label>
	</div>
	<div class="form-group">
    <input type="submit" class="btn btn-warning" value="Import Data" name="import">
	<input type="view" class="btn btn-warning" value="View Data" name="view" onClick="parent.location='view.php'">
	
</div>
	</fieldset>
</form>
</div>
</body>
</html>


