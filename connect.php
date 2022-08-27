<?php

$conn = mysqli_connect("localhost", "root", "", "emp_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
else {

    // insert data in to the employee table
    $sql = "INSERT INTO employees(Emp_id,DoB,First_name,Last_name,Gender,App_date) 
    VALUES
        (
            '$_POST[id]' ,
            '$_POST[dob]' , 
            '$_POST[fname]' ,
            '$_POST[lname]' , 
            '$_POST[gender]' , 
            '$_POST[appdate]' 
            
        )";


    if (mysqli_query($conn, $sql)) {
        header('location:index.html');
    } 
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    //connection close
    mysqli_close($conn);
}
