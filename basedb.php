<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('relaydb.sqlite');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }


$sql =<<< EOF
	select pins from tblpins  
EOF;



   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      echo "Pin = ". $row['pins'] . "\n";
   }
   echo "Operation done successfully\n";
   $db->close();

?>


