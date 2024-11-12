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
<table>
    <tr>
        <th>Name</th>
        <th>Join Date</th>
        <th>Origin</th>
    </tr>
    <?php foreach ($artists as $artist) : ?>
        <tr>
            <td><?= $artist["name"] ?></td>
            <td><?= $artist["join_date"] ?></td>
            <td><?= $artist["origin"] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>