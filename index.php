<<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>


<div class="container">
<h1>Excel Upload</h1>


<form method="POST" action="excelUpload.php" enctype="multipart/form-data">
    <div class="form-group">
            <label>Upload Excel File</label>
            <input type="file" name="file" class="form-control">
    </div>
    <div class="form-group">
            <button type="submit" name="Submit" class="btn btn-success">Upload</button>
    </div> 
</form>
</div>
</body>
</html>	