<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>

<body>
    <?php include "navBar.php" ?>
    <?php echo $content; ?>
    <script src="../dist/bundle.js"></script>
</body>

</html>