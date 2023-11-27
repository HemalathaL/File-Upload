<?php
$conn=mysqli_connect('localhost','root','','upload');
if($conn)
{
    require('C:\xampp\htdocs\fileupload\spreadsheet-reader-master\library\php-excel-reader\excel_reader2.php');
    require('C:\xampp\htdocs\fileupload\spreadsheet-reader-master\library\SpreadsheetReader.php');
    if(isset($_POST['Submit']))
    {
        $mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet'];
        if(in_array($_FILES["file"]["type"],$mimes))
          {
            
            $uploadFilePath = 'C:\xampp\htdocs\fileupload\upload'.basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);
            $Reader = new SpreadsheetReader($uploadFilePath);
            $totalSheet = count($Reader->sheets());
            echo "You have total ".$totalSheet." sheets<br>".
            $Reader->ChangeSheet(0);
            echo "count=" .count($Reader)." added <br>";
            $count = 0;
            foreach ($Reader as $Row)
            {

                    $count++;
                    $name = isset($Row[0]) ? $Row[0] : '';
                    $class = isset($Row[1]) ? $Row[1] : '';
                    $total = isset($Row[2]) ? $Row[2] : '';
                    if($count == 1)   continue;   //  skips titles from excel file while inserting
                    $query = "INSERT INTO `excelupload`(`Name`, `Class`, `Total`) VALUES ('".$name."','".$class."','".$total."')";
                    
                    $result = mysqli_query($conn,$query);
            }

            echo "<br />Data Inserted in dababase";
         }
else 
    { 
        die("<br/>Sorry, File type error. Only Excel file allowed."); 
    }

mysqli_close($conn);
  }
  
}
 else 
{
     echo "Database Not Connected";
}
//if($conn)
//{
//    require('C:\xampp\htdocs\fileupload\spreadsheet-reader-master\library\php-excel-reader\excel_reader2.php');
//    require('C:\xampp\htdocs\fileupload\spreadsheet-reader-master\library\SpreadsheetReader.php');
//    $fileName=$_FILES['file']['name'];
//    $fileExtension=explode('.',$fileName);
//    $fileExtension=  strtolower(end($fileExtension));
//    $newfile=date("Y.m.d") . "-" . $fileExtension;
//    $targetdirectory="C:\xampp\htdocs\fileupload\upload".$newfile;
//    move_uploaded_file($_FILES['file']['name'],$targetdirectory);
//    error_reporting(0);
//    ini_set('display_errors',0);
//    $reader=new SpreadsheetReader($targetdirectory);
//     $count = 0;
//    foreach($reader as  $Row)
//    {
//       $count++;
//       $name = isset($Row[0]) ? $Row[0] : '';
//       $class = isset($Row[1]) ? $Row[1] : '';
//       $total = isset($Row[2]) ? $Row[2] : '';
//       if($count == 1)   continue;   //  skips titles from excel file while inserting
//       $query = "INSERT INTO `excelupload`(`Name`, `Class`, `Total`) VALUES ('".$name."','".$class."','".$total."')";
//       $result = mysqli_query($conn,$query); 
//    }
//       echo "<br />Data Inserted in database";
//}
//else
//{
//    echo "Database Not Connected";
//}
?>