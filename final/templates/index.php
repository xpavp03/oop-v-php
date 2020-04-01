<!doctype html>
<html>
<head>
  <title>final</title>
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
  /** @var Customer $customer */
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
/** @var Customer $default */
?>
<form method="post">
  Name: <input type="text" name="customer[name]" value="<?= $default->name ?>">

  <input type="hidden" name="customer[id]" value="<?= $default->id ?>">
  <input type="submit" name="save">
</form>

</body>
</html>
