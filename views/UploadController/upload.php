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


<form class="register" action="?page=register" method="POST">
    <label for="name">Name: </label><input name="name" value="<?php if(isset($_POST['name']) && !preg_match('/[^A-Za-z]/', $_POST['name'])) echo $_POST['name'] ?>" required/><br>
    <label for="surname">Surname: </label><input name="surname" value="<?php if(isset($_POST['surname']) && !preg_match('/[^A-Za-z]/', $_POST['surname'])) echo $_POST['surname'] ?>" required/><br>
    <label for="email">E-mail: </label><input name="email" value="<?php if(isset($_POST['email']) && preg_match('/[^@]+@[^\.]+\..+/', $_POST['email'])) echo $_POST['email'] ?>" required/><br>
    <label for="password">Password: </label><input name="password" type="password" required/><br>
    <input type="submit" value="Register"/>
</form>