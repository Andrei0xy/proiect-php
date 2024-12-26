<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <title>Artists</title>
</head>
<body>
    <h1>New artist</h1>
    <form action="create" method="post">
    <input type="hidden" name="artist_post" value="1">
    <p> <label for="name">Name</label>
        <input type="text" name="name" id="name" value=" <?=$_SESSION["create_artist"]["artist"]['name'] ?>">
    </p>
    <p style="color: red;">
            <?php 
            if (isset($_SESSION['create_artist']["errors"]['name_error'])):
                echo $_SESSION['create_artist']["errors"]['name_error'];
                unset($_SESSION['create_artist']["errors"]['name_error']);
                endif;
            ?>
        </p>
    <p><label for="join_date">Join date</label>
        <input type="text" name="join_date" id="join_date" value=" <?=$_SESSION["create_artist"]["artist"]['join_date'] ?>">
    </p>
    <p style="color: red;">
            <?php 
            if (isset($_SESSION['create_artist']["errors"]['date_error'])):
                echo $_SESSION['create_artist']["errors"]['date_error'];
                unset($_SESSION['create_artist']["errors"]['date_error']);
                endif;
            ?>
        </p>    
    <p><label for="origin">Origin</label>
        <input type="text" name="origin" id="origin" value=" <?=$_SESSION["create_artist"]["artist"]['origin'] ?>">
    </p>
    <p style="color: red;">
            <?php 
            if (isset($_SESSION['create_artist']["errors"]['origin_error'])):
                echo $_SESSION['create_artist']["errors"]['origin_error'];
                unset($_SESSION['create_artist']["errors"]['origin_error']);
                endif;
            ?>
        </p>
    <p><label for="description">Description</label>
        <input type="text" name="description" id="description" value=" <?=$_SESSION["create_artist"]["artist"]['description'] ?>">
    </p>
        <input type="submit" value="Create" name="create">
    </form>
</body>
</html>