<?php
 $user = 'a01348746';
 $pass = 'Nikita1995';
 $database = 'lab';
 
 $conn = oci_connect($user, $pass, $database);
 if (!$conn) exit;
?>

<html>
<head></head>
<body bgcolor="LightGrey" link="black" alink="black" vlink = "black">

  <p style="text-align: center"><button class="parent">
   <div class="block">
   <li><a href="in.html">Hauptmenu</a></li>
   </div>
  </button>
  </p>

  <p style="text-align: center"><button class="parent">
   <div class="block">
  <li><a href="repariert.php">Repariert</a></li>
   </div>
  </button> 
  </p>
  
   <p style="text-align: center"><button class="parent">
   <div class="block">
  <li><a href="motor.php">Motor</a></li>
   </div>
  </button> 
  </p>

  
<div>
 <form id='searchform' action='auto.php' method='get'>
  <a href='auto.php'>Alle Autos</a> ---
  Suche nach Modell:
  <input id='search' name='search' type = 'text' size='20' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
  <input id='submit' type='submit' value='Los!' />
 </form>
</div>

<?php
 if (isset($_GET['search'])) {
  $sql = " SELECT * FROM auto WHERE Modell like '%" . $_GET['search'] . "%'";
  } else {
   $sql = "SELECT * FROM auto";
  } 
  
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>

<table style='border: 1px solid #DDDDDD'>
 <thead>
  <tr>
   <th>AutoID</th>
   <th>Marke</th>
   <th>Modell</th>
   <th>Karosserie</th>
   <th>Manager</th>
   <th>Motor</th>
  </tr>
 </thead>
 <tbody>
 
<?php
 while ($row = oci_fetch_assoc($stmt)) {
  echo "<tr>";
  echo "<td>" . $row['AUTOID'] . "</td>";
  echo "<td>" . $row['MARKE'] . "</td>";
  echo "<td>" . $row['MODELL'] . "</td>";
  echo "<td>" . $row['KAROSSERIE'] . "</td>";
  echo "<td>" . $row['PERSNR'] . "</td>";
  echo "<td>" . $row['MOTORID'] . "</td>";
  echo "</tr>"; }
?>

 </tbody>
</table>

<div>Insgesamt <?php echo oci_num_rows($stmt); ?> Autos gefunden!</div>

<?php oci_free_statement($stmt); ?>

</body>
</html>








