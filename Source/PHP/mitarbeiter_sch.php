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
   <li> <a href="mi.html">Mitarbeitern</a></li>
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
  <li><a href="manager.php">Managern</a></li>
   </div>
  </button> 
  </p>
  
   <p style="text-align: center"><button class="parent">
   <div class="block">
  <li><a href="autotechniker.php">Autotechnikern</a></li>
   </div>
  </button> 
  </p>
 
<div>
 <form id='searchform' action='mitarbeiter_sch.php' method='get'>
  <a href='mitarbeiter_sch.php'>Alle Mitarbeitern</a> ---
  Suche nach Nachname:
  <input id='search' name='search' type = 'text' size='20' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
  <input id='submit' type='submit' value='Los!' />
 </form>
</div>

<?php
 if (isset($_GET['search'])) {
  $sql = " SELECT * FROM mitarbeiter WHERE nachname like '%" . $_GET['search'] . "%'";
  } else {
   $sql = "SELECT * FROM mitarbeiter";
  } 
  
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>

<centrum>
<table style='border: 1px solid #DDDDDD'>
 <thead>
  <tr>
   <th>PersNr</th>
   <th>Vorname</th>
   <th>Nachname</th>
   <th>Geburtsdatum</th>
   <th>Gehalt</th>
  </tr>
 </thead>
 <tbody>
 
<?php
 while ($row = oci_fetch_assoc($stmt)) {
  echo "<tr>";
  echo "<td>" . $row['PERSNR'] . "</td>";
  echo "<td>" . $row['VORNAME'] . "</td>";
  echo "<td>" . $row['NACHNAME'] . "</td>";
  echo "<td>" . $row['GEBURTSDATUM'] . "</td>";
  echo "<td>" . $row['GEHALT'] . "</td>";
  echo "</tr>"; }
?>

 </tbody>
</table>
</centrum>
<div>Insgesamt <?php echo oci_num_rows($stmt); ?> Mitarbeitern gefunden!</div> 

<?php oci_free_statement($stmt); ?>

</body>
</html>
  