<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php foreach ($pengumuman as $row) { ?>
        <ul>
            <li><?= $row->id ?></li>
            <li><?= $row->judul ?></li>
            <li><?= $row->keterangan ?></li>
        </ul>
    <?php } ?>

</body>

</html>