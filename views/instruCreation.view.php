<?php ob_start(); ?>

<form method="POST" action="<?= URL ?>back/instrus/creationValidation" enctype="multipart/form-data">
    <div class="form-group">
        <label for="instru_nom">Nom de l'instru:</label>
        <input type="text" class="form-control" id="animal_nom" name="animal_nom">
    </div>
    <div class="form-group">
        <label for="animal_description">Description</label>
        <textarea class="form-control" id="animal_description" name="animal_description" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image :</label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <div class="form-group">
        <label for="sons">Mp3</label>
        <input type="file" class="form-control-file" id="sons" name="sons">
    </div>
    <div class="form-group">
        <label for="image">bpm :</label>
        <select class="form-control" name="bpm_id">
            <option></option>
            <?php foreach ($bpm as $bpm) : ?>
                <option value="<?= $bpm['bpm_id'] ?>">
                    <?= $bpm['bpm_id'] ?> - <?= $bpm['bpm_libelle'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class='row no-gutters'>
        <div class="col-1"></div>
        <?php foreach($genres as $genre) : ?>
            <div class="form-group form-check col-2">
                <input type="checkbox" class="form-check-input" name="genre" -<?= $genre['genre_id'] ?>>
                <label class="form-check-label" for="exampleCheck1"><?= $genre['genre_libelle'] ?></label>
            </div>
        <?php endforeach; ?>
        <div class="col-1"></div>
    </div>
    <button type="submit" class="btn btn-primary">Créer</button>
</form>

<?php 
$content = ob_get_clean();
$titre = "Page de création d'une instru";
require "views/commons/template.php";