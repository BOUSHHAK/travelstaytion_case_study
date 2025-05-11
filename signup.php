<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>MOVIE WORLD | SIGN UP</title>
        <link rel="stylesheet" href="CSS/signup.css" type="text/css"/>
    </head>
    <body>
        <?php
            if(isset($_SESSION['username'])) {
                header("Location:index.php");
                exit();
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $data = [
                    'username' => $username,
                    'password' => $password
                ];

                $jsonData = json_encode($data);

                $url = "http://localhost:3000/signup";

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($jsonData)
                ]);

                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                $result = json_decode($response, true);

                if ($httpCode == 200) {
                    echo "<script>alert('".$result['message']."');window.location.href='".$result['redirect']."';</script>";
                    exit();
                } else {
                    echo "<script>alert('".$result['message']."');window.location.href='".$result['redirect']."';</script>";
                    exit();
                }
            }
        ?>
        <div class="signupContainer">
            <a href="index.php">Back to Movie World</a>
            <div>
                <div>
                    <h1>SIGN UP</h1>

                    <form action="signup.php" method="POST">
                        <div class="inputField">
                            <label for="username" >Username</label>
                            <input type="text" name="username" id="username" required>
                            <label for="password" >Password</label>
                            <input type="password" name="password" id="password" required>
                        </div>
                        <button type="submit" class="submitButton">Sign Up</button>
                        <div class="logingLink">
                            or <a href="login.php" class="reg_logLink">Log in!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>