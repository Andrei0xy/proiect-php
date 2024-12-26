<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <title>Edit Artist</title>
</head>
<body>
    <h1>Artist profile</h1>
    <form method="post">
    <input type="hidden" name="id" value="<?=$artist["id"] ?>">
    <p> <label for="name">Name</label>
        <input type="text" name="name" id="name" value=" <?=$artist["name"] ?>">
    </p>
        <p>
            <?php  
                if (isset($_SESSION["edit_artist"]) && isset($_SESSION["edit_artist"]['name_error'])) 
                echo $_SESSION["edit_artist"]['name_error'];
                unset($_SESSION["edit_artist"]['name_error']);
            ?>
        </p>
    <p><label for="join_date">Join date</label>
        <input type="text" name="join_date" id="join_date" value=" <?=$artist["join_date"] ?>">
    </p>
        <p>
            <?php  
                if (isset($_SESSION["edit_artist"]) && isset($_SESSION["edit_artist"]['date_error'])) 
                echo $_SESSION["edit_artist"]['date_error'];
                // var_dump ($_SESSION["edit_artist"]);
                unset($_SESSION["edit_artist"]['date_error']);
            ?>
        </p>
    <p><label for="origin">Origin</label>
        <input type="text" name="origin" id="origin" value=" <?=$artist["origin"] ?>">
    </p>
    <p>
            <?php  
                if (isset($_SESSION["edit_artist"]) && isset($_SESSION["edit_artist"]['origin_error'])) 
                echo $_SESSION["edit_artist"]['origin_error'];
                unset($_SESSION["edit_artist"]['origin_error']);
            ?>
        </p>
    <p><label for="description">Description</label>
        <input type="text" name="description" id="description" value=" <?=$artist["description"] ?>">
    </p>
        <input type="submit" value="Update" name="update">
    </form>
    <a href="index">Back</a>
</body>
</html>