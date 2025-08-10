<?php
    include ("DbConnect.php")
?>

<?php

    $author_name_err = $title_err = $publish_date_err = "";
    $valid = true; 

    function test_input($data) {
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['create_book'])){
            if(empty($_POST["author_name"])){
                $author_name_err = "Author Name Required!";
                $valid = false;
            }
            elseif(empty($_POST["title"])){
                $title_err = "Title Required!";
                $valid = false;
            }
            elseif(empty($_POST["publish_date"])){
                $publish_date_err = "Publish Date Required!";
                $valid = false;
            }
            else{
                $valid = true;
            }
        }
        if($valid){
            $author_name = test_input($_POST["author_name"]);
            $title = test_input($_POST["title"]);
            $publish_date = test_input($_POST["publish_date"]);

            $sql = "INSERT INTO books (author_name, title, publish_date)
                    VALUES ('$author_name', '$title', '$publish_date')";
            $query_run = "";

            try{
                $query_run = mysqli_query($conn, $sql);
            }
            catch(mysqli_sql_exception){
                echo "Could not create book";
            }

            echo "Book Created!";
            echo "<html> <a href='ReadBooks.php'> View Books </a> <br>";
        }

    }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Books</title>
</head>
<body>
<a href='MyBooks.html'> Back to Library </a> <br>
<div class="signup" id="signupp">
        <form action="CreateBook.php" method="post">
            <label for="author_name" id="slauthor_name">Name of Author</label>
            <input id="sauthor_name" name="author_name" value="<?php if($_SERVER["REQUEST_METHOD"]=="POST"){echo $_POST["author_name"];} else{echo "";} ?>">
            <span class="error" id="erro1">* <?php echo $author_name_err;?></span>
            <br>
            <br>
            <label for="title">Title</label>
            <input type="text" id="stitle" name="title" value="<?php if(isset($_POST['create_book'])) { echo $_POST["title"];} ?>">
            <span class="error" id="error2">* <?php echo $title_err; ?></span>
            <br>
            <br>
            <label for="spublish_date" id="slpassword">Date of Publication</label>
            <input type="date" id="spublish_date" name="publish_date">
            <span class="error" id="error3">* <?php echo $publish_date_err;?></span>
            <br>
            <br>
            <input type="submit" name="create_book" value="Create" class="btn" id="sbtn1">
        </form>
        <br>
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>