<?php
    include ("DbConnect.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
</head>
<body>
    <a href='MyBooks.html'> Back to Library </a> <br>

    <table class="book_table">
        <tr>
            <th>Book Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Publish Date</th>
        </tr>

        <?php
        $sql = "SELECT * FROM books";
        $query_run = "";

        try{
            $query_run = mysqli_query($conn, $sql);

            if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $row){
                    echo "
                    <tr>
                        <td>$row[book_id]</td>
                        <td>$row[author_name]</td>
                        <td>$row[title]</td>
                        <td>$row[publish_date]</td>
                        <td>
                            <form action='UpdateBook.php' method='GET'> 
                                <input type='hidden' name='book_id' value='$row[book_id]'>
                                <input type='hidden' name='author_name' value='$row[author_name]'>
                                <input type='hidden' name='title' value='$row[title]'>
                                <input type='hidden' name='publish_date' value='$row[publish_date]'>
                                <input type='submit' id='update' name='update' value='Update'>
                            </form>
                        </td>
                    </tr>"; 
                };

            }
            else{
                echo "No record found";
                echo "<html> <a href='MyBooks.html'> Back to Library </a>";
            }
        }
        catch(mysqli_sql_exception){
            echo "Could not get data";
            echo "<html> <a href='MyBooks.html'> Back to Library </a>";
        }
        
    ?>
    </table>
</body>
</html>

<?php
    mysqli_close($conn);
?>