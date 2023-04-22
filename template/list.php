<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
</head>

<body>
    <table>
        <th>
        <td>
            <input type="checkbox" name="select_all" id="select_all">
        </td>
        <td>
            <p>Nom</p>
        </td>
        <td>Prènoms</td>
        <td>Action</td>
        </th>

        <tbody>
            <?php foreach ($user as $key => $value) { ?>
                <tr>
                    <td>
                        <input type="checkbox" name="selected_id" id="selected_id">
                    </td>
                    <td>
                        nom
                    </td>
                    <td>
                        prenoms
                    </td>
                    <td>
                        <a href="#">details</a>
                        <a href="#">delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>