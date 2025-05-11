<?php
    session_start();
    if (!isset($_SESSION['username']) || !isset($_SESSION['userID'])) {
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>MOVIE WORLD | NEW MOVIE</title>
        <link rel="stylesheet" href="CSS/newmovie.css" type="text/css"/>
    </head>
    <body>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $user_id = $_SESSION['userID'];

                $data = [
                    'title' => $title,
                    'description' => $description,
                    'user_id' => $user_id
                ];

                $jsonData = json_encode($data);

                $url = "http://localhost:3000/addMovie";

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
                    echo "<script>alert('".$result['message']."'); window.location.href='".$result['redirect']."';</script>";
                    exit();
                } else {
                    echo "<script>alert('Failed to add movie!'); window.location.href='newmovie.php';</script>";
                    exit();
                }
            }
        ?>
        <div class="newMovieContainer">
            <a href="index.php">Back to Movie World</a>
            <div>
                <div>
                    <h1>ADD MOVIE</h1>

                    <form action="newmovie.php" method="POST" >
                        <div>
                            <label>Title</label><br>
                            <input type="text" name="title" required><br><br>
                            <label>Description</label><br>
                            <textarea name="description" rows="6" required></textarea><br><br>
                        </div>
                        <button type="submit">Add Movie</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>