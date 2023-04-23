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
        <?php } else if (strpos($_SERVER['REQUEST_URI'], '/detail/') !== false) { ?>
            <li><a href="/edit/<?php echo $user['id']; ?>">Modifier</a></li>
            <li><a href="/list">Retour à la liste</a></li>
            <li><a href="/preview/<?php echo $user['id']; ?>">Preview PDF</a></li>
        <?php } else if ($_SERVER['REQUEST_URI'] === '/create') { ?>
            <li><a href="/list">Retour à la liste</a></li>
        <?php } ?>
    </ul>
</nav>