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
  <li><a href="auto.php">Autos</a></li>
   </div>
  </button> 
  </p>
  
   <p style="text-align: center"><button class="parent">
   <div class="block">
  <li><a href="motorteil_li.php">Motoreteilen</a></li>
   </div>
  </button> 
  </p>


<div>
 <form id='searchform' action='motor_li.php' method='get'>
  <a href='motor_li.php'>Alle Motoren</a> ---
  Suche nach Typ:
  <input id='search' name='search' type = 'text' size='20' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
  <input id='submit' type='submit' value='Los!' />
 </form>
</div>

<?php
 if (isset($_GET['search'])) {
  $sql = " SELECT * FROM motor WHERE Typ like '%" . $_GET['search'] . "%'";
  } else {
   $sql = "SELECT * FROM motor";
  } 
  
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>


  

<table style='border: 1px solid #DDDDDD'>
 <thead>
  <tr>
   <th>MotorID</th>
   <th>Typ</th>
   <th>Leistung</th>
  </tr>
 </thead>
 <tbody>
 
<?php
 while ($row = oci_fetch_assoc($stmt)) {
  echo "<tr>";
  echo "<td>" . $row['MOTORID'] . "</td>";
  echo "<td>" . $row['TYP'] . "</td>";
  echo "<td>" . $row['LEISTUNG'] . "</td>";
  echo "</tr>"; }
?>

 </tbody>
</table>

<div>Insgesamt <?php echo oci_num_rows($stmt); ?> Motoren gefunden!</div>

<?php oci_free_statement($stmt); ?>

</body>
</html>