<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>
<?php include(dirname(__DIR__).'/navbar.html'); ?>

<body>
<div class="container">
    <div class="row">
        <h1 class="col-12 pl-0">ADMIN PANEL</h1>

        <h4 class="mt-4">Users:</h4>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?= $user->getName(); ?></td>
                <td><?= $user->getSurname(); ?></td>
                <td><?= $user->getEmail(); ?></td>
                <td><?= $user->getRole(); ?></td>
                <td>-</td>
            </tr>
            </tbody>
            <tbody class="users-list">
            </tbody>
        </table>

            <button class="btn btn-dark btn-lg" type="button" onclick="getUsers()">Get all users</button>
    </div>

    <?php if(isset($message)): ?>
        <?php foreach($message as $item): ?>
            <div><?= $item ?></div>
        <?php endforeach; ?>
    <?php endif; ?>


    <div class="adminAddItem" action="?page=adminAddItem" method="POST">
        <br><label for="name"></label><input name="name" value="<?php if(isset($_POST['name']) && !preg_match('/[^A-Za-z]/', $_POST['name'])) echo $_POST['name'] ?>" placeholder="name" required/><label for="price"></label><input name="price" value="<?php if(isset($_POST['price']) && !preg_match('/[^1-9]/', (int)$_POST['price'])) echo (int)$_POST['price'] ?>" placeholder="price" required/>
        <input type="submit" value="Add Item" class="btn btn-warning btn-sm"/>
        </form>


    <div class="row">
            <h4 class="mt-4">Equipment:</h4>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>

            </tr>
            </thead>

            <tbody class="items-list">
            </tbody>
        </table>
    </div>
</div>

</body>
</html>