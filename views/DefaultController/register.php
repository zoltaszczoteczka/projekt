<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>
<?php include(dirname(__DIR__).'/navbar.html'); ?>

<body>

<div class="container">
    <div clas="row">
        <div class="col-sm-6 offset-sm-3">
            <h1 class="panel-header">REGISTER</h1>
            <hr>

<?php if(isset($message)): ?>
    <?php foreach($message as $item): ?>
        <h3 class="error"><?= $item ?></h3>
    <?php endforeach; ?>
<?php endif; ?>


    <form class="register" action="?page=register" method="POST">
        <div class="form-group row">
        <label for="name" class="col-sm-1 col-form-label" ></label>
            <div class="col-sm-11">
            <input name="name" value="<?php if(isset($_POST['name']) && !preg_match('/[^A-Za-z]/', $_POST['name'])) echo $_POST['name'] ?>" placeholder="name" required/><br>
            </div>
        </div>
        <div class="form-group row">
        <label for="surname" class="col-sm-1 col-form-label" ></label>
            <div class="col-sm-11">
            <input name="surname" value="<?php if(isset($_POST['surname']) && !preg_match('/[^A-Za-z]/', $_POST['surname'])) echo $_POST['surname'] ?>" placeholder="surname" required/><br>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-1 col-form-label" ></label>
            <div class="col-sm-11">
            <input name="email" value="<?php if(isset($_POST['email']) && preg_match('/[^@]+@[^\.]+[^A-Za-z]+[^\.]+\..+/', $_POST['email'])) echo $_POST['email'] ?>" placeholder="email" required/><br>
            </div>
        </div>
        <div class="form-group row">
        <label for="password" class="col-sm-1 col-form-label" ></label>
            <div class="col-sm-11">
            <input name="password" type="password" placeholder="password" required/><br>
            </div>
        </div>
        <input type="submit" value="Register" class="btn btn-warning"/>
    </form>
        </div>
    </div>
</div>
</body>
</html>