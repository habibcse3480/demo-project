<?php
session_start();
$conn = new mysqli("localhost","root","","login");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$registerMessage = '';
$registerUserName = '';
$registerFirstName = '';
$registerLastName = '';
$registerEmail = '';
$registerPassword = '';
$registerRetypePassword = '';
$registerDOB = '';
$registerGender = '';
$registerAgree = '';

$registerUserNameError = '';
$registerFirstNameError = '';
$registerEmailError = '';
$registerPasswordError = '';
$registerRetypePasswordError = '';
$registerDOBError = '';
$registerGenderError = '';
$registerImageError = '';
$registerAgreeError = '';

if(isset($_POST['register_submit'])){

    $registerUserName = strtolower($_POST['username']);
    $registerFirstName = $_POST['first_name'];
    $registerLastName = $_POST['last_name'];
    $registerEmail = $_POST['email_address'];
    $registerPassword = $_POST['password'];
    $registerRetypePassword = $_POST['retype_password'];
    $registerDOB = $_POST['date_of_birth'];
    if(isset($_POST['gender'])){
        $registerGender = $_POST['gender'];
    }
    if(isset($_POST['agree'])){
        $registerAgree = $_POST['agree'];
    }



    $error = false;

    if(strlen($registerUserName) < 4 || strlen($registerUserName) > 20){
        $error = true;
        $registerUserNameError = 'Username must be greater than 3 characters and less than 21 characters.';
    }
    if($registerFirstName == ''){
        $error = true;
        $registerFirstNameError = 'Please enter your first name.';
    }

    $expEmail = explode('@', $registerEmail);
    if(!isset($expEmail[1]) && empty($expEmail[1])){
        $error = true;
        $registerEmailError = 'Please enter your valid email address.';
    }

//    Password
    if(strlen($registerPassword) < 6 || strlen($registerPassword) > 64){
        $error = true;
        $registerPasswordError = 'Password must be greater than 5 characters and less than 65 characters.';
    }
    if(!preg_match_all('/[A-Z]/', $registerPassword, $matches, PREG_OFFSET_CAPTURE) || !preg_match_all('/[0-9]/', $registerPassword, $matches, PREG_OFFSET_CAPTURE)){
        $error = true;
        $registerPasswordError = 'Password must contains at least 1 Capital letter and 1 number.';
    }
    if($registerPassword != $registerRetypePassword){
        $error = true;
        $registerRetypePasswordError = 'Retype password must be same as password.';
    }

    if($registerDOB != ''){
        if (DateTime::createFromFormat('Y-m-d', $registerDOB) !== false) {
            $now = strtotime(date("m/d/Y"));
            $thisDate = strtotime($registerDOB);
            $subDate = $now - $thisDate;
            $year = date('Y', $subDate);
            if($year < 18){
                $error = true;
                $registerDOBError = 'Age must be greater than 17 years.';
            }

        }
        else {
            $error = true;
            $registerDOBError = 'Please enter valid date of birth.';
        }
    }
    else {
        $error = true;
        $registerDOBError = 'Please provide your date of birth.';
    }

//    Image Validation
    if(isset($_FILES["image"]["tmp_name"])){
        $allowed =  array('gif','png' ,'jpg', 'jpeg', 'bmp');
        $filename = $_FILES["image"]["tmp_name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
//        if(!in_array(strtolower($ext),$allowed) ) {
//            $error = true;
//            $registerImageError = 'Please provide valid image file.';
//        }
        if($_FILES['image']['size'] > 1048576){
            $error = true;
            $registerImageError = 'Image size must be less than 1MB.';
        }

    }
    else{
        $error = true;
        $registerImageError = 'Please provide your profile image.';
    }

    if($registerAgree == ''){
        $error = true;
        $registerAgreeError = 'Please agree with terms and conditions.';
    }

    if($error == false){

        $target_dir = "images/upload/";
        $registerImage = rand(99, 99999) . '___' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $registerImage;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $sql = "INSERT INTO users (uname, fname, lname, email, pass, dob, gender, image, agree)
                            VALUES ('".$registerUserName."', '".$registerFirstName."', '".$registerLastName."', '".$registerEmail."', '".md5($registerPassword)."', '".$registerDOB."', '".$registerGender."', '".$registerImage."', '".$registerAgree."')";

        if ($conn->query($sql) === TRUE) {
            $registerMessage = "<p class='text-success'>You have successfully registered.</p>";

        } else {
            $registerMessage = "<p class='text-danger'>Error: ". $sql . "<br> ". $conn->error."</p>";
        }
    }



}


//Login part
$loginUserName = '';

if(isset($_POST['login_submit'])){
    $loginUserName = strtolower($_POST['user_name']);

    $sql = "SELECT id, uname, email FROM users where uname = '".$_POST['user_name']."' and pass = '".md5($_POST['password'])."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION['id'] = $row["id"];
            $_SESSION['uname'] = $row["uname"];
            $_SESSION['email'] = $row["email"];
        }
        $newURL = 'http://localhost/demo-project/dashboard.php';
        header('Location: '.$newURL);
    }
    $conn->close();
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Login and Register</title>
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
    <!-- Menu Bar Start Here -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-info">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="images/task-manager-logo.png" alt="" style="width: 160px; height: 50px;" />
            </a>

            <div class="collapse navbar-collapse" id="mainMenu">
                <ul class="navbar-nav mr-auto" style="padding-left: 40px;">
                    <li class="font-weight-bold  pl-3"><a href="#" data-toggle="modal" data-target="#modal" class="nav-link">About</a></li>
                    <li class="font-weight-bold  pl-3"><a href="#" data-toggle="modal" data-target="#modal-contact" class="nav-link">Contact</a></li>
                </ul>
                <ul class="navbar-nav ">
                    <li class="font-weight-bold"><a href="#" class="nav-link">Login</a></li>
                    <li class="font-weight-bold"><a href="#" class="nav-link">Signup</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Menu Bar End Here -->
    <!-- Login and Registration Part Start from Here-->
        <!--Login Part Start Here-->
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                    <h6 class="pt-5 text-center">If you have already account with us</h6>
                    <h2 class="text-center">Login Here</h2><br />
                    <form action="#" method="post">
                        <div class="form-group">
                            <label>Username *</label>
                            <input type="text" name="user_name" value="<?php echo $loginUserName; ?>" required placeholder="Username" class="form-control" />
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label>Email Address *</label>-->
<!--                            <input type="email" name="email_address" placeholder="Email address" required class="form-control" />-->
<!--                        </div>-->

                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" placeholder="Password" required class="form-control" />
                        </div>

                        <div class="form-group">
                            <button type="submit" name="login_submit" value="Submit" class="btn btn-success btn-block">Login</button>
                        </div>

                    </form>
                </div>
                <!--Login Part End-->
                <!--Blank Div Start-->
                <div class="col-sm-2">
                    <p class="divider"></p>
                </div>
                <!--Blank Div End-->
                <!--Registration Part Start Here-->
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                     <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
                        <?php if($registerMessage != ''): ?>
                         <h6 class="pt-5 text-center"> <?php echo $registerMessage; ?></h6>
                         <?php endif ; ?>
                        <h6 class="pt-5 text-center">Don't have account?? Create Now .....</h6>
                        <h2 class="text-center">Register Now</h2><br />
                         <div class="form-group">
                             <label>Username *</label>
                             <input type="text" name="username" value="<?php echo $registerUserName; ?>" placeholder="Username"  class="form-control" />
                             <span class="help-block <?php echo $registerUserNameError != '' ? 'text-danger' : ''; ?>"><?php echo $registerUserNameError; ?></span>
                         </div>

                         <div class="form-group">
                            <label for="firstName">First Name *</label>
                            <input type="text" name="first_name" id="firstName" value="<?php echo $registerFirstName; ?>" placeholder="First name"  class="form-control" />
                             <span class="help-block <?php echo $registerFirstNameError != '' ? 'text-danger' : ''; ?>"><?php echo $registerFirstNameError; ?></span>
                        </div>

                         <div class="form-group">
                             <label for="lirstName">Last Name</label>
                             <input type="text" name="last_name" id="lirstName" value="<?php echo $registerLastName; ?>" placeholder="Last name" class="form-control" />
                         </div>

                         <div class="form-group">
                             <label>Email Address *</label>
                             <input type="email" name="email_address" value="<?php echo $registerEmail; ?>" placeholder="Email address"  class="form-control" />
                             <span class="help-block <?php echo $registerEmailError != '' ? 'text-danger' : ''; ?>"><?php echo $registerEmailError; ?></span>
                         </div>

                         <div class="form-group">
                             <label>Password *</label>
                             <input type="password" name="password" value="<?php //echo $registerPassword; ?>" placeholder="Password"  class="form-control" />
                             <span class="help-block <?php echo $registerPasswordError != '' ? 'text-danger' : ''; ?>"><?php echo $registerPasswordError; ?></span>
                         </div>

                         <div class="form-group">
                             <label>Retype Password *</label>
                             <input type="password" name="retype_password" value="<?php //echo $registerRetypePassword; ?>" placeholder="Type password once again"  class="form-control" />
                             <span class="help-block <?php echo $registerRetypePasswordError != '' ? 'text-danger' : ''; ?>"><?php echo $registerRetypePasswordError; ?></span>
                         </div>

                         <div class="form-group">
                             <label>Date of Birth *</label>
                             <input type="date" name="date_of_birth" value="<?php echo $registerDOB; ?>"  class="form-control" placeholder="YYYY-MM-DD" />
                             <span class="help-block <?php echo $registerDOBError != '' ? 'text-danger' : ''; ?>"><?php echo $registerDOBError; ?></span>
                         </div>
                         <div class="form-check">
                             <label class="form-check-label">
                                 <input class="form-check-input" name="gender" type="radio" value="male" <?php echo $registerGender == 'male' ? 'checked' : '';?>> Male
                             </label>

                             <label class="form-check-label">
                                 <input class="form-check-input" name="gender"  type="radio" value="female" <?php echo $registerGender == 'female' ? 'checked' : '';?>> Female
                             </label>
                         </div>
                         <div class="form-group">

                             <input type="file" name="image" accept="image/*"  class="form-control" />
                             <span class="help-block <?php echo $registerImageError != '' ? 'text-danger' : ''; ?>"><?php echo $registerImageError; ?></span>
                         </div>
                         <div class="form-check form-check-inline">
                             <label class="form-check-label">
                                 <input class="form-check-input" type="checkbox" name="agree" value="agree" <?php echo $registerAgree == 'agree' ? 'checked' : '';?> > I agree with the terms and condition. * <br/>
                                 <span class="help-block <?php echo $registerAgreeError != '' ? 'text-danger' : ''; ?>"><?php echo $registerAgreeError; ?></span>
                             </label>
                         </div>

                         <div class="form-group">
                             <br /> <button type="submit" name="register_submit" value="Submit" class="btn btn-success btn-block">Sign Up</button>
                         </div>
                    </form>
                </div>
                <!--Registration Part End-->
            </div>
        </div>
    <!-- Login and Registration Part End-->
    <!-- About Modal Start -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="modal fade" id="modal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>About the System</h3>
                                <button class="close" data-dismiss="modal"> &Cross; </button>
                            </div>
                            <div class="modal-body">
                                <P class="text-justify">This is a basic level <strong>Task Management System</strong> which is designed to meet the growing demand of Modern Organization's requirement to create, read, update, delete, assign daily tasks and generate reports.</P>
                                <p class="text-justify">It has several features like Create Client, Create Employee, Add Projects, Add Modules (to separate parts of the main project), Assign Tasks to Employee etc.. </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                                    <span aria-hidden="true">Close</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Modal End -->
    <!-- Contact Modal Start -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="modal fade" id="modal-contact">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>Contact for Support</h3>
                                <button class="close" data-dismiss="modal"> &Cross; </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                            <form action="#" method="post">
                                                <div class="form-group">
                                                    <label>Full Name *</label>
                                                    <input type="text" name="full_name" required placeholder="Your Full Name" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Contact Email *</label>
                                                    <input type="email" name="contact_email" placeholder="Your Email address" required class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Purpose of Contact *</label>
                                                    <select class="form-control">
                                                        <option selected>General Support</option>
                                                        <option>Billing</option>
                                                        <option>Feedback</option>
                                                        <option>Report a Bug</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" name="website" placeholder="Website URL" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Message *</label>
                                                    <textarea class="form-control" required></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" name="submit" value="Submit" class="btn btn-success btn-block">Send Message</button>
                                                </div>

                                            </form>
                                        </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                                    <span aria-hidden="true">Close</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Modal End -->





            <script src="js/jquery-3.2.1.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
            <script src="js/bootstrap.js"></script>
    </body>
</html>