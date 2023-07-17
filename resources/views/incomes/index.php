<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de ingresos</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  
  <h1>Lista de ingresos</h1>

  <table>
    <tr>
      <th>Método de pago</th>
      <th>Tipo de ingreso</th>
      <th>Fecha</th>
      <th>Monto</th>
      <th>Descripción</th>
    </tr>

    <tbody>
      <?php foreach($results as $result): ?>
  
      <tr>
        <td><?= $result["payment_method"] ?></td>
        <td><?= $result["type"] ?></td>
        <td><?= $result["date"] ?></td>
        <td><?= $result["amount"] ?></td>
        <td><?= $result["description"] ?></td>
      </tr>
      
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="/cursos-platzi/php-database/public/incomes/create">Agregar nuevo ingreso</a>

</body>
</html>