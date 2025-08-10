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
    <table class="book_table">
        <tr>
            <th>Book Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Publish Dtae</th>
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
                    </tr>";
                };

                echo "<html> <a href='MyBooks.html'> Back to Library </a>";
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