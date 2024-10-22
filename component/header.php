<?php
    // Reuse configuration PDO database
    include 'configuration/database.php';
?>

<!--HTML part-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--CSS-->
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        header, footer {
            background-color: lightblue;
            padding: 1px;
            text-align: center;
        }
        header > div {
            text-align: left;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            max-width: 45%;
            margin: auto;
        }

        .form-header {
            text-align: center;
        }

        .form-content {
            display: flex;
            flex-direction: column;
        }
        .form-group {
            display: flex;
            font-size: 14px;
            align-items: center;
        }
        .form-group > label {
            width: 25%;
        }
        .form-group > input {
            padding: 8px;
            width: 75%;
        }
        .form-group > textarea {
            padding: 8px;
            width: 75%;
        }
        .form-group > input[type="file"] {
            padding: 0px;
            width: 75%;
        }
        

        .form-actions {
            display: flex;
            justify-content: flex-end;
        }
        .form-actions > input {
            padding: 8px 16px;
        }

        .result-container {
            word-wrap: break-word; /* For older browsers */
            overflow-wrap: break-word; /* For modern browsers */
            max-width: 90%;
        }

        .error-text {
            color: red;
            font-size: 14px;
        }

        img {
            max-width: 50%;
            height: auto;
        }

        @media only screen and (max-width: 768px) {
            /*For mobile phones: */
            .form-container {
                max-width: 90%;
            }

            .form-group {
                flex-direction: column;
                justify-content: center;
                gap: 5px;
            }
            .form-group > label {
                width: 100%;
            }
            .form-group > input {
                padding: 8px;
                width: 100%;
            }
            .form-group > textarea {
                padding: 8px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Feedback Page</h1>
        <div>
            <a href="index.php">Feedback</a> |
            <a href="feedback_list.php">Check Result</a>
        </div>
    </header>
<!--Next HTML part is in file which call include-->