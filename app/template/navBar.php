<nav>
    <div class="navbar">
        <?php if ($_SERVER['REQUEST_URI'] === '/list' || $_SERVER['REQUEST_URI'] === '/' || (isset($_GET['find']))) { ?>

            <div class="left">
                <form action="/" method="GET">
                    <input type="text" name="find" placeholder="Recherche avec nom ou prénom ou adresse">
                    <input type="number" name="age_min" placeholder="Âge minimum">
                    <input type="number" name="age_max" placeholder="Âge maximum">
                    <button class="button" type="submit">
                        <span class="material-icons-outlined">
                            search
                        </span>
                    </button>
                </form>
            </div>
            <div>
                <a title="Créer un nouvel utilisateur" class="button right" href="/create">
                    <span class="material-icons-outlined">add_circle_outline</span>
                    nouveau
                </a>
            </div>
            <div>
                <a class="button right" href="/pdf_list">
                    <span class="material-icons-outlined">
                        preview
                    </span>
                    PDF
                </a>
            </div>
            <div>
                <button title="Supprimer la sélection" class="button danger right" id="delete_selected">
                    <span class="material-icons-outlined">
                        delete
                    </span>
                    supprimer
                </button>
            </div>
            <div>
                <a class="button right" href="/import">
                    <span class="material-icons-outlined">
                        upload_file
                    </span>
                    import
                </a>
            </div>
            <div>
                <a class="button" href="/export">
                    <span class="material-icons-outlined">
                        save_as
                    </span>
                    CSV
                </a>
            </div>
        <?php } else if (strpos($_SERVER['REQUEST_URI'], '/details/') !== false) {
            $id = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1); ?>
            <div>
                <a class="button" href="/list">
                    <span class="material-icons-outlined">
                        list_alt
                    </span>
                    List
                </a>
            </div>
            <div>
                <a class="button" href="/editUser/<?php echo $id; ?>">
                    <span class="material-icons-outlined">
                        edit
                    </span>
                    Modifier
                </a>
            </div>
            <div>
                <a class="button" href="/preview/<?php echo $id; ?>">Preview PDF</a>
            </div>
        <?php } else if (strpos($_SERVER['REQUEST_URI'], '/editUser/') !== false) {
            $id = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1); ?>
            <div>
                <a class="button" href="/details/<?php echo $id; ?>">
                    <span class="material-icons-outlined">
                        info
                    </span>
                    details
                </a>
            </div>
            <div>
                <a class="button" href="/list">
                    <span class="material-icons-outlined">
                        list_alt
                    </span>
                    List
                </a>
            </div>
            <div>
                <a class="button" href="/preview/<?php echo $id; ?>">Preview PDF</a>
            </div>
        <?php } else if ($_SERVER['REQUEST_URI'] === '/create') { ?>
            <div>
                <a class="button" href="/list">
                    <span class="material-icons-outlined">
                        list_alt
                    </span>
                    liste
                </a>
            </div>
        <?php } ?>
    </div>
</nav>