<?php
    // Reuse header HTML
    require 'component/header.php';

    $name = $email = $body = $email_name = '';
    $name_error = $email_error = $body_error = $upload_error = '';

    // When submit button is pressed, form is sent to PHP server
    if(isset($_POST['submit'])) {

        // Check value 'name' from form, if it is empty or only space bar or too long
        if(empty($_POST['name'])) {
            $name_error = 'Name is required';
        } else {
            $name = htmlspecialchars($_POST['name']);
            if(strlen($name) > 150) {$name_error = 'Name is too long';}
            if(ctype_space($name)) {$name_error = 'Name is required';}
        }

        // Check value 'email' from form, if it is empty or only space bar or too long
        if(empty($_POST['email'])) {
            $email_error = 'Email is required';
        } else {
            $email = htmlspecialchars($_POST['email']);
            if(strlen($email) > 150) {$email_error = 'Email is too long';}
            $email_name = ctype_space(explode('@',$email)[0]);
            if(ctype_space($email_name)) {$email_error = 'Email is required';}
        }

        // Check value 'email' from form, if it is empty or only space bar or too long
        if(empty($_POST['body'])) {
            $body_error = 'Feedback is required';
        } else {
            $body = htmlspecialchars($_POST['body']);
            if(strlen($body) > 150) {$body_error = 'Feedback is too long';}
            if(ctype_space($body)) {$body_error = 'Feedback is required';}
        }

        // Check uploaded picture from form
        $permitted_extensions = ['png', 'jpg', 'jpeg', 'gif'];
        $file_name = $_FILES['upload']['name'];
        if(!empty($file_name)) {
            $file_size = $_FILES['upload']['size'];
            $file_tmp_name = $_FILES['upload']['tmp_name'];
            $file_extension = explode('.', $file_name);
            $file_extension = strtolower(end($file_extension));
            $genarated_file_name = time().'.'.$file_extension;
            $destination_path = "uploads/{$genarated_file_name}";
            
            if(in_array($file_extension, $permitted_extensions)) {
                if($file_size <= 300000) {
                    //ok, move from temp folder to uploads
                    move_uploaded_file($file_tmp_name, $destination_path);
                } else {
                    $upload_error = 'File too big';
                }
            } else {
                $upload_error = 'Invalid file type';
            }
        }

        // If there are no error messages, accept feedback, save to MySQL
        $validate_success = (empty($name_error)&&empty($email_error)&&empty($body_error)&&empty($upload_error));
        if($validate_success) {
            $sql = "INSERT INTO feedback (name, email, body, pic)
                    VALUES (?, ?, ?, ?);";
            try {
                $statement = $connection->prepare($sql);
                $statement->bindParam(1, $name);
                $statement->bindParam(2, $email);
                $statement->bindParam(3, $body);
                $statement->bindParam(4, $destination_path);
                $statement->execute();
                echo "Feedback inserted successfully";
            } catch (PDOException $e) {
                echo "Cannot inserted feedback to database".$e->getMessage();
            }
        }
    }
?>

<!---HTML part-->
<!---Flex box-->
<div class="form-container">
    
    <div class="form-header">
        <h2>Enter your Feedback here</h2>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
        method="post"
        class="form-content"
        enctype="multipart/form-data">

        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text"
                id="name"
                name="name"
                placeholder="What is your name ?"
                require: required
                maxlength="150"> 
        </div>
        <p class="error-text"><?php echo $name_error; ?></p>

        <div class="form-group">
            <label for="email">Your Email</label>
            <input type="email"
                name="email"
                placeholder="Enter your email"
                require: required
                maxlength="150">
        </div>
        <p class="error-text"><?php echo $email_error; ?></p>

        <div class="form-group">
            <label for="body">Your Feedback</label>
            <textarea
                name="body"
                placeholder="Enter your feedback"
                require: required
                maxlength="150"></textarea>
        </div>
        <p class="error-text"><?php echo $body_error; ?></p>

        <div class="form-group">
            <label for="upload">Your Picture</label>
            <input type="file" name="upload">
        </div>
        <p class="error-text"><?php echo $upload_error; ?></p>

        <div class="form-actions">
            <input type="submit"
                name="submit"
                value="Send">
        </div>
    </form>
</div>

<!---Reuse Footer HTML-->
<?php include 'component/footer.php';?>
