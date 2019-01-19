<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>
<?php include(dirname(__DIR__).'/navbar.html'); ?>

<?php
/**
 * Created by PhpStorm.
 * User: Kasia
 * Date: 17.01.2019
 * Time: 12:33
 */
if(isset($message)): ?>
    <?php foreach($message as $item): ?>
        <h3 class="error"><?= $item ?></h3>
    <?php endforeach; ?>
<?php endif; ?>


<body>
<div class="container">

<div class="row">
    <h4 class="mt-4">Sprzet:</h4>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Rent</th>
        </tr>
        </thead>

        <tbody class="itemstorent-list">
        </tbody>
    </table>

</div>
</div>

</body>
</html>