<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pdo = new PDO('sqlite:' . __DIR__ . '/../db/database.sq3',null,null);

//$pdo->query("DROP TABLE customer");
//$pdo->query("CREATE TABLE customer (id INTEGER PRIMARY KEY, name TEXT)");

if (isset($_POST['save'])) {
  if (empty($_POST['id'])) {
    $query = $pdo->prepare('INSERT INTO customer (name) VALUES (:name)');
    $query->execute([':name' => $_POST['name']]);
  } else {
    $query = $pdo->prepare('UPDATE customer SET name = :name WHERE id = :id');
    $query->execute([':id' => $_POST['id'], ':name' => $_POST['name']]);
  }

  header('Location: '.$_SERVER['PHP_SELF']);
}

?>
<!doctype html>
<html>
<head>
  <title>spaghetti</title>
</head>
<body>

<h1>Our Valued Customers</h1>

<table>
  <tr>
    <th>id</th>
    <th>name</th>
    <th></th>
  </tr>
  <?php
  $query = $pdo->query('SELECT * FROM customer ORDER BY name');
  $customers = $query->fetchAll(PDO::FETCH_OBJ);

  foreach ($customers as $customer):
  ?>
  <tr>
    <td><?= $customer->id ?></td>
    <td><?= $customer->name ?></td>
    <td><a href="?id=<?= $customer->id ?>">Edit</a></td>
  </tr>
  <?php
    endforeach;
  ?>
</table>

<?php
if (!empty($_GET['id'])) {
  $query = $pdo->prepare('SELECT * FROM customer WHERE id = :id');
  $query->execute([':id' => $_GET['id']]);

  $customer = $query->fetch(PDO::FETCH_OBJ);
} else {
  $customer = (object) [
    'id' => null,
    'name' => null,
  ];
}
?>

<form method="post">
  Name: <input type="text" name="name" value="<?= $customer->name ?>">

  <input type="hidden" name="id" value="<?= $customer->id ?>">
  <input type="submit" name="save">
</form>

</body>
</html>
