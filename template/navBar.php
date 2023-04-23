<nav>
    <ul>
        <?php if ($_SERVER['REQUEST_URI'] === '/list' || $_SERVER['REQUEST_URI'] === '/') { ?>
            <li>
                <form action="/search" method="GET">
                    <input type="text" name="query" placeholder="Rechercher">
                    <button type="submit">Rechercher</button>
                </form>
            </li>
            <li><a href="/create">Ajouter</a></li>
            <li><a href="/preview">Preview PDF</a></li>
            <li><button id="delete_selected">Supprimer sélection</button></li>
            <li><a href="/import">Importer données</a></li>
            <li><a href="/export">Exporter données CSV</a></li>
        <?php } else if (strpos($_SERVER['REQUEST_URI'], '/details/') !== false) {
            $id = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1); ?>
            <li><a href="/editUser/<?php echo $id; ?>">Modifier</a></li>
            <li><a href="/list">Retour à la liste</a></li>
            <li><a href="/preview/<?php echo $id; ?>">Preview PDF</a></li>
        <?php } else if (strpos($_SERVER['REQUEST_URI'], '/editUser/') !== false) {
            $id = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1); ?>
            <li><a href="/details/<?php echo $id; ?>">Retour au détail</a></li>
            <li><a href="/list">Retour à la liste</a></li>
            <li><a href="/preview/<?php echo $id; ?>">Preview PDF</a></li>
        <?php } else if ($_SERVER['REQUEST_URI'] === '/create') { ?>
            <li><a href="/list">Retour à la liste</a></li>
        <?php } ?>
    </ul>
</nav>