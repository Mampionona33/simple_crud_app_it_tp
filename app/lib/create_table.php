<?php
function create_table($nom_table, $col)
{
    $db = connect_db();
    $sql = "CREATE TABLE IF NOT EXISTS $nom_table($col);";
    $db->exec($sql);
}
