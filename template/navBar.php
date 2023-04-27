<nav>
    <ul class="navbar">
        <?php if ($_SERVER['REQUEST_URI'] === '/list' || $_SERVER['REQUEST_URI'] === '/') { ?>
            <li>
                <form action="/search" method="GET">
                    <input class="left" type="text" name="query" placeholder="Rechercher">
                    <button class="button" type="submit"><span class="material-icons-outlined">
                            search
                        </span></button>
                </form>
            </li>
            <li><a class="button right" href="/create"> <span class="material-icons-outlined">add_circle_outline</span> Ajouter</a></li>
            <li><a class="button right" href="/pdf_list">Preview PDF</a></li>
            <li><button class="button right" id="delete_selected">Supprimer sélection</button></li>
            <li><a class="button right" href="/import"><span class="material-icons-outlined">
                        upload_file
                    </span></a></li>
            <li><a class="button" href="/export"><span class="material-icons-outlined">
                        save_as
                    </span> CSV</a></li>
        <?php } else if (strpos($_SERVER['REQUEST_URI'], '/details/') !== false) {
            $id = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1); ?>
            <li><a class="button" href="/list"><span class="material-icons-outlined">
                        list_alt
                    </span></a></li>
            <li><a href="/editUser/<?php echo $id; ?>">Modifier</a></li>
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