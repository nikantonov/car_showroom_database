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
   <li><a href="mi.html">Mitarbeitern</a></li>
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
  <form id = 'insertform' action= 'mitarbeiter_ins.php' method='get'>
   Neues Mitarbeiter einfuegen:
    <table style='border': 1px solid #DDDDDD'>
     <thead>
      <tr>
       <th>persnr</th>
       <th>vorname</th>
       <th>nachname</th>
       <th>geburtsdatum (yyyy-mm-dd)</th>
       <th>gehalt</th>
      </tr>
     </thead>
     <tbody>
      <tr>
        <td>
          
                 <input id='persnr' name='persnr' type='text' size='10' value='<?php if (isset($_GET['persnr'])) echo $_GET['persnr']; ?>' />
               </td>
               <td>
                  <input id='vorname' name='vorname' type='text' size='20' value='<?php if (isset($_GET['vorname'])) echo $_GET['vorname']; ?>' />
               </td>
               <td>
                 <input id='Nachname' name='Nachname' type='text' size='20' value='<?php if (isset($_GET['Nachname'])) echo $_GET['Nachname']; ?>' />
               </td>
               <td>
                 <input id='geburtsdatum' name='geburtsdatum' type='text' size='20' value='<?php if (isset($_GET['geburtsdatum'])) echo $_GET['geburtsdatum']; ?>' />
               <td> 
                  <input id='gehalt' name='gehalt' type='text' size='10' value='<?php if (isset($_GET['gehalt'])) echo $_GET['gehalt']; ?>' />
               </td>
            </td>
         </tr>
        </tbody>
     </table>
     <input id='submit' type='submit' name='BUTTON' value='Insert!' />
<?php
 //Handle insert
 if (isset($_GET['persnr']))
 {
   //Prepare insert statementd
   $sql = "INSERT INTO mitarbeiter VALUES(" . $_GET['persnr'] . ",'"  . $_GET['vorname'] . "','" . $_GET['Nachname'] . "',to_date('" . $_GET['geburtsdatum'] . "','yyyy-mm-dd')  ,'" . $_GET['gehalt'] . "')";
   //Parse and execute statement
   $insert = oci_parse($conn, $sql);
   oci_execute($insert);
   $conn_err=oci_error($conn);
   $insert_err=oci_error($insert);
   if(!$conn_err & !$insert_err){
       print("Successfully inserted");
  print("<br>");
   }
   //Print potential errors and warnings
   else{
      print($conn_err);
      print_r($insert_err);
      print("<br>");
   }
   oci_free_statement($insert);
 }
?>

</body>
</html>
  