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
  <li><a href="auto.php">Auto</a></li>
   </div>
  </button> 
  </p>
  
   <p style="text-align: center"><button class="parent">
   <div class="block">
  <li><a href="motor_li.php">Motor listen</a></li>
   </div>
  </button> 
  </p>


<div>
 <form id='searchtyp' action='motor.php' method='get'>
   Suche Typ von Motor, der hat dieser Modell:
     <input id='modell' name='modell' type='text' size='20' value='<?php if (isset($_GET['modell'])) echo $_GET['modell']; ?>'/>
     <input id='submit' type='submit' value='Aufruf Stored Procedure!' />
 </form>
</div>


<?php
 //Handle Stored Procedure
 if (isset($_GET['modell']))
 {
    //Call Stored Procedure  
    $modell = $_GET['modell'];
    $typ ='';
    $sproc = oci_parse($conn, 'begin a_m(:p1, :p2); end;');
    //Bind variables, p1=input (nachname), p2=output (abtnr)
    oci_bind_by_name($sproc, ':p1', $modell);
    oci_bind_by_name($sproc, ':p2', $typ, 20);
    oci_execute($sproc);
    $conn_err=oci_error($conn);
    $proc_err=oci_error($sproc);
    //If there have been no Connection or Database errors, print department
    if(!$conn_err && !$proc_err){
       echo("<br><b>" . $modell . " hat motor Typ " . $typ . "</b><br>" );  // prints OUT parameter of stored procedure
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
