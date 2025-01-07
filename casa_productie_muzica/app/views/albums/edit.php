<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <title>Edit Album</title>
</head>
<body>
    <h1>Album profile</h1>
    <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$album["id"] ?>">
    <p> <label for="name">Name</label>
        <input type="text" name="name" id="name" value=" <?=$album["name"] ?>">
    </p>
        <p>
            <?php  
                if (isset($_SESSION["edit_album"]) && isset($_SESSION["edit_album"]['name_error'])) 
                echo $_SESSION["edit_album"]['name_error'];
                unset($_SESSION["edit_album"]['name_error']);
            ?>
        </p>
    <p><label for="release_date">Release date</label>
        <input type="text" name="release_date" id="release_date" value=" <?=$album["release_date"] ?>">
    </p>
        <p>
            <?php  
                if (isset($_SESSION["edit_album"]) && isset($_SESSION["edit_album"]['date_error'])) 
                echo $_SESSION["edit_album"]['date_error'];
                // var_dump ($_SESSION["edit_artist"]);
                unset($_SESSION["edit_album"]['date_error']);
            ?>
        </p>
    <p><label for="price">Price</label>
        <input type="text" name="price" id="price" value=" <?=$album["price"] ?>">
    </p>
    <p>
            <?php  
                if (isset($_SESSION["edit_album"]) && isset($_SESSION["edit_album"]['price_error'])) 
                echo $_SESSION["edit_album"]['price_error'];
                unset($_SESSION["edit_album"]['price_error']);
            ?>
        </p>
    <p><label for="genre">Genre</label>
        <input type="text" name="genre" id="genre" value=" <?=$album["genre"] ?>">
    </p>
    <p><label for="stoc">Stoc</label>
        <input type="text" name="stoc" id="stoc" value=" <?=$album["stoc"] ?>">
    </p>
    <p>
            <?php  
                if (isset($_SESSION["edit_album"]) && isset($_SESSION["edit_album"]['stoc_error'])) 
                echo $_SESSION["edit_album"]['stoc_error'];
                unset($_SESSION["edit_album"]['stoc_error']);
            ?>
    </p>
    <p><label for="image">Image</label>
        <input type="file" name="file" id="file">
    </p>
    <p style="color: red;">
            <?php 
           if (isset($_SESSION["edit_album"]) && isset($_SESSION["edit_album"]['file_error'])) 
           echo $_SESSION["edit_album"]['file_error'];
           unset($_SESSION["edit_album"]['file_error']);
            ?>
        </p>
        <input type="submit" value="Update" name="update">
    </form>
    <a href="index">Back</a>
</body>
</html>