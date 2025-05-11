<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    $userID = $_SESSION['userID'];
    $movieID = $_POST['movie_id'];
    $type = $_POST['type'];

    $data = [
        'user_id' => $userID,
        'movie_id' => $movieID,
        'type' => $type
    ];

    $jsonData = json_encode($data);

    $url = "http://localhost:3000/opinion";

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
        header("Location:".$result['redirect']);
        exit();
    } else {
        echo "<script>alert('Something went wrong with your choice of opinion.'); window.location.href='index.php';</script>";
        exit();
    }
?>
