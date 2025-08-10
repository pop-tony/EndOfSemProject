<?php
    include ("DbConnect.php")
?>

<?php
    
    $upd_id = "";
    $book_id = "";
    $author_name = "";
    $title = "";
    $publish_date = "";

    $author_name_err = $title_err = $publish_date_err = "";
    $valid = true;

    function test_input($data) {
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SERVER["REQUEST_METHOD"] == "GET"){

        $upd_id = $_GET["book_id"];

        $sql1 = "SELECT *
                FROM books
                WHERE book_id = $upd_id";
        $query_run = "";

        try{
            $query_run = mysqli_query($conn, $sql1);

            if(mysqli_num_rows($query_run) > 0){
                $info = $query_run->fetch_assoc();
            }
            else{
                echo "No record found";
            }
        }
        catch(mysqli_sql_exception){
            echo "Could not get data";
        }

        $book_id = $info["book_id"];
        $author_name = $info["author_name"];
        $title = $info["title"];
        $publish_date = $info["publish_date"];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $upd_id = $_POST["book_id"];

        if (isset($_POST['update_book'])){
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

            $sql2 = "UPDATE books
                     SET author_name = '$author_name', title = '$title', publish_date = '$publish_date'
                     WHERE book_id = $upd_id";
            $query_run = "";

            try{
                $query_run = mysqli_query($conn, $sql2);
            }
            catch(mysqli_sql_exception){
                echo "Could not update book";
            }

            echo "Book Updated!";
            echo "<html> <a href='ReadBooks.php'> View Books </a>";

            exit;
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Books</title>
</head>
<body>
<a href='MyBooks.html'> Back to Library </a> <br>
<div class="signup" id="signupp">
        <form action="UpdateBook.php" method="post">
            <input type = "hidden" value="<?php echo $upd_id; ?>" name = "book_id">
            <label for="author_name" id="slauthor_name">Name of Author</label>
            <input id="sauthor_name" name="author_name" value="<?php echo $author_name; ?>">
            <span class="error" id="erro1">* <?php echo $author_name_err;?></span>
            <br>
            <br>
            <label for="title">Title</label>
            <input type="text" id="stitle" name="title" value="<?php echo $title; ?>">
            <span class="error" id="error2">* <?php echo $title_err; ?></span>
            <br>
            <br>
            <label for="spublish_date" id="slpassword">Date of Publication</label>
            <input type="date" id="spublish_date" name="publish_date" value="<?php echo $publish_date; ?>">
            <span class="error" id="error3">* <?php echo $publish_date_err;?></span>
            <br>
            <br>
            <input type="submit" name="update_book" value="Update" class="btn">
        </form>
        <br>
    </div>
</body>
</html>