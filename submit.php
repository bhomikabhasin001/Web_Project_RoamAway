
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $destination = trim($_POST['destination']);
    $phone = trim($_POST['phoneNo']);
    $date = trim($_POST['travelDate']);
    $people = trim($_POST['people']);
    $errors = [];
    if(empty($name)){
        $errors[]="Name is required.";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[]="Invalid email address.";
    }
    if(!preg_match("/^[0-9]{10}$/", $phone)){
        $errors[]="Phone number must be exactly 10 digits.";
    }
    if(empty($destination)){
        $errors[]="Please select a destination.";
    }
    if(empty($date)){
        $errors[]="Please select a travel date.";
    }
    if($people<1 || $people>60){
        $errors[]="Number of people must be between 1 and 60.";
    }
    if(!empty($errors)){
        echo "<h3>Form Errors:</h3>";
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<p><a href='index.html'>Go back to form</a></p>";
        exit();
    }
    if(isset($_POST['submit'])){
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $destination = trim($_POST['destination']);
        $phone = trim($_POST['phoneNo']);
        $date = trim($_POST['travelDate']);
        $people = trim($_POST['people']);
        $host='sql103.infinityfree.com';
        $user='if0_40644742';
        $pass='KukaJW5zO6g7';
        $dbname='if0_40644742_Booking_form';
        $conn=mysqli_connect($host,$user,$pass,$dbname);
        
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO `input` (`name`, `email`, `destination`, `phoneNo`, `travelDate`, `people`)
        VALUES ('$name','$email','$destination','$phone','$date','$people')";


        mysqli_query($conn,$sql);
    }
    echo "<div style='padding:20px; background-color:#d4edda; color:#155724; border:1px solid #c3e6cb;'>";
    echo "<h2>Thank you, " . htmlspecialchars($name) . "!😊</h2>";
    echo "<p>Your booking form has been submitted.✔</p>";
    echo "<p>Kindly visit our office for payment.</p>";
    echo "</div>";
}
?>
