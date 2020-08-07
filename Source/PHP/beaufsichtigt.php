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

<div>
 <form id='searchname' action='beaufsichtigt.php' method='get'>
   Suche Nachname von Mitarbeiter, der dieser beaufsichtigt:
     <input id='nachname' name='nachname' type='text' size='20' value='<?php if (isset($_GET['nachname'])) echo $_GET['nachname']; ?>'/>
     <input id='submit' type='submit' value='Aufruf Stored Procedure!' />
 </form>
</div>


<?php
 //Handle Stored Procedure
 if (isset($_GET['nachname']))
 {
    //Call Stored Procedure  
    $nachname = $_GET['nachname'];
    $nn ='';
    $sproc = oci_parse($conn, 'begin mit(:p1, :p2); end;');
    //Bind variables, p1=input (nachname), p2=output (abtnr)
    oci_bind_by_name($sproc, ':p1', $nachname);
    oci_bind_by_name($sproc, ':p2', $nn, 20);
    oci_execute($sproc);
    $conn_err=oci_error($conn);
    $proc_err=oci_error($sproc);
    //If there have been no Connection or Database errors, print department
    if(!$conn_err && !$proc_err){
       echo("<br><b>" . $nachname . " beaufsichtigt " . $nn . "</b><br>" );  // prints OUT parameter of stored procedure
    }
     else{
      //Print potential errors and warnings
      print($conn_err);
      print_r($proc_err);
    }
     oci_free_statement($sproc);
 }
 // clean up connections
 
 
?>


</body>
</html>