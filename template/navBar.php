<nav>
    <div class="navbar">
        <?php if ($_SERVER['REQUEST_URI'] === '/list' || $_SERVER['REQUEST_URI'] === '/') { ?>
            <div class="left">
                <form action="/search" method="GET">
                    <input type="text" name="query" placeholder="Rechercher">
                    <button class="button" type="submit"><span class="material-icons-outlined">
                            search
                        </span></button>
                </form>
            </div>
            <div><a class="button right" href="/create"> <span class="material-icons-outlined">add_circle_outline</span> Ajouter</a></div>
            <div><a class="button right" href="/pdf_list"><span class="material-icons-outlined">
                        preview
                    </span>Preview PDF</a></div>
            <div><button class="button danger right" id="delete_selected"> <span class="material-icons-outlined">
                        playlist_remove
                    </span> Supprimer sélection</button></div>
            <div><a class="button right" href="/import"><span class="material-icons-outlined">
                        upload_file
                    </span>import</a></div>
            <div><a class="button" href="/export"><span class="material-icons-outlined">
                        save_as
                    </span> CSV</a></div>
        <?php } else if (strpos($_SERVER['REQUEST_URI'], '/details/') !== false) {
            $id = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1); ?>
            <div><a class="button" href="/list"><span class="material-icons-outlined">
                        list_alt
                    </span>List</a></div>
            <div class="button"><a href="/editUser/<?php echo $id; ?>">Modifier</a></div>
            <div><a href="/preview/<?php echo $id; ?>">Preview PDF</a></div>
        <?php } else if (strpos($_SERVER['REQUEST_URI'], '/editUser/') !== false) {
            $id = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1); ?>
            <div><a href="/details/<?php echo $id; ?>">Retour au détail</a></div>
            <div><a href="/list">Retour à la liste</a></div>
            <div><a href="/preview/<?php echo $id; ?>">Preview PDF</a></div>
        <?php } else if ($_SERVER['REQUEST_URI'] === '/create') { ?>
            <div><a class="button" href="/list"><span class="material-icons-outlined">
                        list_alt
                    </span>liste</a></div>
        <?php } ?>
    </div>
</nav>