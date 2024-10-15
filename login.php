<?php
    ob_start();
    session_start();

    // Check previous session untill is destroyed
    if (isset($_SESSION['username'])) {
        // logged in
        header('Location: settings.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Credit Card</title>

	<!-- Load all static files -->
	<link rel="stylesheet" type="text/css" href="assets/BS/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <style>
                        * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }

                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                }

                .container-form {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding:100px 40px;
                    max-width: 1200px;
                    margin: 50px auto;
                    background-color: white;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }

                .text-section {
                    flex: 1;
                    margin-right: 20px;
                }

                .text-section h1 {
                    color: #5cb85c;
                    margin-bottom: 20px;
                }

                .text-section p {
                    line-height: 1.6;
                    color: #333;
                }

                .form-section {
                    flex: 1;
                }

                .form-section form {
                    display: flex;
                    flex-direction: column;
                }

                .form-group {
                    margin-bottom: 15px;
                }

                .form-group label {
                    margin-bottom: 5px;
                    font-weight: bold;
                }

                .form-group input {
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    font-size: 16px;
                }

                .submit-button {
                    background-color: #5cb85c;
                    color: white;
                    padding: 10px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 16px;
                }

                .submit-button:hover {
                    background-color: #4cae4f;
                }

    </style>
</head>
<body class="container">
    <!-- Config included -->
	<?php include 'helper/config.php' ?>

     <!-- Here will be checking for login -->
     <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $get_login_sql = "SELECT * FROM users WHERE email='".$email."' AND password='".$password."'";

            $login_success = $conn->query($get_login_sql);
            if($login_success->num_rows == 1){
                // Check the session and add into session
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $email;

                // Redirect to settings page
                header('Location: settings.php');
            }else {
                echo '<p class="error-message">Credientials are not correct!!</p>';
            }
        }
     ?>

    <!-- Login view -->
    <div class="container-form">
        <div class="text-section">
            <h1>Credit Card Detection System</h1>
            <p>
                Welcome to our Credit Card Detection System. Our innovative technology helps you detect and validate credit card information quickly and securely.
                <br><br>
                Simply enter the details of your credit card below to check its validity. Our system uses advanced algorithms to ensure your data is processed safely and accurately.
            </p>
        </div>
        <div class="form-section">
            <form method="Post" action="">
                <h2>Enter Login Details</h2>
                <div class="form-group">
                    <label for="cardNumber">Email Address :</label>
                    <input Type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                </div>
                <div class="form-group">
                    <label for="cardName">Password:</label>
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required/>
                </div>
                <button type="submit" class="submit-button">Validate Card</button>
            </form>
        </div>
    </div>

</body>
<footer>
	<!-- All the Javascript will be load here... -->
	<script type="text/javascript" src="assets/JS/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="assets/JS/main.js"></script>
	<script type="text/javascript" src="assets/BS/js/bootstrap.min.js"></script>
</footer>
</html>