<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <title>Artists</title>
</head>
<body>
<h1>All Artists</h1>
<a href="create" role="button">New artist</a>
<table>
    <tr>
        <th>Name</th>
        <th>Join Date</th>
        <th>Origin</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($artists as $artist) : ?>
        <tr>
            <td><?= $artist["name"] ?></td>
            <td><?= $artist["join_date"] ?></td>
            <td><?= $artist["origin"] ?></td>
            <!-- <td><?= $artist["description"] ?></td> -->
            <td>
                <a href="show?id=<?= $artist["id"] ?>">Show</a> |
                <a href="edit?id=<?=$artist['id']?>">Edit</a> |
                <a href="delete?id=<?=$artist['id']?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="/casa_productie_muzica/">Back</a>
</body>
</html>