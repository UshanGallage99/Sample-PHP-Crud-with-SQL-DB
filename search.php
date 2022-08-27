<?php

$id = $fname = $lname = $gender = $appdate = $dob = $error = "";
$conn = mysqli_connect("localhost", "root", "", "emp_db");
$isvalid = false;

//button clicked
if (isset($_POST['search'])) {

    $id =  $_POST['searchempid']; //get input id
    $select = mysqli_query($conn, "SELECT * FROM employees"); 
 
    if ($select) {
        while ($row = mysqli_fetch_assoc($select)) {
            // id check
            if ($id == $row['Emp_id']) {
                $isvalid = true;
            }
        }
    }
    
    if ($isvalid == false) {
        //print error message
        $error = "Invalid Employee ID";
    } 
     
    else { 
        // function to search 
        function printoutput($conn, $id){
            $sql = "SELECT * FROM employees WHERE Emp_id='$id'";
            $result = mysqli_query($conn, $sql);

            if ($result) { 
                $row = mysqli_fetch_assoc($result); 
                $id = $row['Emp_id'];
                $dob = $row['DoB'];
                $fname = $row['First_name'];
                $lname = $row['Last_name'];
                $gender = $row['Gender'];
                $appdate = $row['App_date'];

                $male = $gender == 'Male' ? 'checked' : '';
                $female = $gender == 'Female' ? 'checked' : ''; 
                // output
                echo '
                        <div class="mb-3">
                            <label for="empid" class="form-label">Employee ID</label>
                            <input type="number" value="' . $id . '" class="form-control" name="empid" id="empid">
                        </div>

                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" id="dob" value="' . $dob . '">
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="fname" class="form-control" value="' . $fname . '">
                                </div>
                                <div class="col">
                                    <input type="text" name="lname" class="form-control" value="' . $lname . '">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label>

                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="male" name="gender" ' . $male . '>
                                <label class="form-check-label" for="male">Male</label>
                            </div>

                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="female" name="gender" ' . $female . '>
                                <label class="form-check-label" for="male">Female</label>
                            </div>
                        </div>
            
                        <div class="mb-3">
                            <label for="appdate" class="form-label">Appointment Date</label>
                            <input type="date" class="form-control" name="appdate" id="appdate" value="' . $appdate . '">
                        </div>
            
            
                    ';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Search</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="rcd position-absolute mx-5">
        <a href="index.html" class="btn btn-primary">Add Employee</a>
    </div>

    <div class="container wrapper mb-5">
        <!-- form start -->
        <form action="search.php" method="post" id="form">

            <h2 class="w-100 text-center mb-4">Search Employee</h2> 
            
            <div class="mb-3">
                <label for="searchempid" class="form-label">Enter Employee ID </label>
                <input type="number" class="form-control" name="searchempid" id="searchempid" placeholder="Search By ID" required>
                <label class="mt-2 text-danger fst-italic" for="" id="empiderr"><?php echo $error; ?></label>
            </div>

            <!-- search button -->
            <div class="mt-2 mb-1">
                <button type="submit" name="search" class="submit-btn btn btn-primary w-100">Search</button>
            </div> 
            <?php
            if ($isvalid == true) { 
                printoutput($conn, $id);
            }
            ?>

        </form>
    </div>
</body>

</html>