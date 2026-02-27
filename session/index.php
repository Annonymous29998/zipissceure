<?php
error_reporting(0);
session_start();
header("HTTP/1.0 404 Not Found");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 72px;
            margin: 0;
            color: #333;
        }
        p {
            color: #666;
            margin: 20px 0;
        }
        .redirect-text {
            font-size: 14px;
            color: #999;
        }
    </style>
    <meta http-equiv="refresh" content="5;url=https://www.firstcitizens.com/">
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p>The page you're looking for cannot be found.</p>
        <p class="redirect-text">You will be redirected in 5 seconds...</p>
    </div>
</body>
</html>
