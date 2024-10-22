<?php
    require "component/header.php";
    echo '<div class="result-container">';
    echo "<h1>List of feedback here</h1>";
    $sql = "SELECT name, email, body, pic from feedback;";
    if($connection != null) {
        try {
            $statement = $connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $feedbacks = $statement->fetchAll();
            echo '<ul>';
            foreach($feedbacks as $feedback) {
                $name = $feedback['name'] ?? '';
                $email = $feedback['email'] ?? '';
                $body = $feedback['body'] ?? '';
                $pic = $feedback['pic'] ?? '';
                echo "<li>";
                echo "<p>$name</p>";
                echo "<p>$email</p>";
                echo "<p>$body</p>";
                if ($pic) {echo "<img src='",$pic,"'"," alt='Picture'>";}
                echo "</li>";
            }
            echo '</ul>';
        } catch (PDOException $e) {
            echo "Cannot query data. Error: ".$e->getMessage();
        }
    }
    echo '</div>';
    include "component/footer.php";
?>