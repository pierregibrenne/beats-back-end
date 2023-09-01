<?php ob_start(); ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">BPM</th>
            <th scope="col">Description</th>
            <th scope="col" colspan="2">actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($bpm as $bpm) : ?>
            <?php if(empty($_POST['bpm_id']) || $_POST['bpm_id'] !== $bpm['bpm_id']) : ?>
                <tr>
                    <td><?= $bpm['bpm_id'] ?></td>
                    <td><?= $bpm['bpm_libelle'] ?></td>
                    <td><?= $bpm['bpm_description'] ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="bpm_id" value="<?= $bpm['bpm_id'] ?>" />
                            <button class="btn btn-warning" type="submit">Modifier</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="<?= URL ?>back/bpm/validationSuppression" onSubmit="return confirm('Voulez-vous vraiment supprimer ?');">
                            <input type="hidden" name="bpm_id" value="<?= $bpm['bpm_id'] ?>" />
                            <button class="btn btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php else: ?>
                <form method="post" action="<?= URL ?>back/bpm/validationModification">
                    <tr>
                        <td><?= $bpm['bpm_id'] ?></td>
                        <td><input type="text" name="bpm_libelle" class="bpm-control" value="<?= $bpm['bpm_libelle'] ?>" /></td>
                        <td><textarea name='bpm_description' class="form-control" rows="3"><?= $bpm['bpm_description'] ?></textarea></td>
                        <td colspan="2">
                            <input type="hidden" name="bpm_id" value="<?= $bpm['bpm_id'] ?>" />
                            <button class="btn btn-primary" type="submit">Valider</button>
                        </td>
                    </tr>
                </form>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
$content = ob_get_clean();
$titre = "Les bpm";
require "views/commons/template.php";