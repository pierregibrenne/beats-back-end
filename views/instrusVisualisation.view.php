<?php ob_start(); ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Instrus</th>
            <th scope="col">Description</th>
            <th scope="col" colspan="2">actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($instrus as $instru) : ?>
          
                <tr>
                    <td><?= $instru['instru_id'] ?></td>
                    <td><?= $instru['instru_nom'] ?></td>
                    <td><?= $instru['instru_description'] ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="instru_id" value="<?= $instru['instru_id'] ?>" />
                            <button class="btn btn-warning" type="submit">Modifier</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="<?= URL ?>back/instrus/validationSuppression" onSubmit="return confirm('Voulez-vous vraiment supprimer ?');">
                            <input type="hidden" name="instru_id" value="<?= $instru['instru_id'] ?>" />
                            <button class="btn btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
$content = ob_get_clean();
$titre = "Les Instrus";
require "views/commons/template.php";