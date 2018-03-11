<?php
include('connection.php');
$con = getdb();


   if(isset($_POST["Import"])){		
		echo $filename=$_FILES["file"]["tmp_name"];	

		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
	           $sql = "INSERT into employees(id,name,address,salary) values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."')";
	           $result = mysqli_query($con, $sql);
			    // var_dump(mysqli_error_list($con));
			    // exit();
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
							
						  </script>";		
				}
				else {
					  echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
				}
	         }
			
	         fclose($file);	
		 }
	}	 
	
	 if(isset($_POST["Export"])){
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('id', 'name',  'address', 'salary'));  
      $query = "SELECT * from employees ORDER BY id DESC";  
      $result = mysqli_query($con, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
	
function get_all_records(){
    $con = getdb();

    $Sql = "SELECT * FROM employees";
    $result = mysqli_query($con, $Sql);  

    if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
     <thead>
     <tr>
     					<th>ID</th>
				  		<th>Name</th>
				  		
				  		<th>address</th>
				  		<th>salary</th>
                        </tr></thead><tbody>";

     while($row = mysqli_fetch_assoc($result)) {


         echo "<tr><td>" . $row['id']."</td>
                   
                   <td>" . $row['name']."</td>
                   <td>" . $row['address']."</td>
                   <td>" . $row['salary']."</td></tr>";
         
     }
	//  echo "<tr> <td><a href='' class='btn btn-danger' id='status_btn' data-loading-text='Changing Status..'>Export</a></td></tr>";
     echo "</tbody></table></div>";
	 
} else {
     echo "you have no employee details";
}
}



?>