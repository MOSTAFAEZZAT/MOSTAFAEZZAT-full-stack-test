<?php


$servername = "localhost";
$username = "root";
$password = "root";
$db = "json";

// Create connection
$mysqli  = new mysqli($servername, $username, $password,$db) or die("Connect failed: %s\n". $mysqli  -> error);

 
  echo "Connected successfully";

   $json = file_get_contents("https://raw.githubusercontent.com/SeteMares/full-stack-test/master/feed.json") ;
    $json = json_decode(  $json,true);
    $content= array();
    $TITLE = array();
    $CONTENT = array() ;
    $MEDIA = array() ;
    $SLUG = array() ;
    $categories = array() ;
    foreach ($json as $key => $value){
      
        $TITLE[] = $json[$key]['title'] ;
      
       
        $CONTENT[] = $json[$key]['content'];
        $MEDIA[] = $json[$key]['media'];
        $SLUG[] = $json[$key]['slug'];
        $categories[] = $json[$key]['categories'];
    }
    
    
    echo "</br" ;
    
    for($s=0;$s<sizeof($TITLE);$s++){

        $url_string =  $CONTENT[$s][0]['content'];
        $res = urldecode($url_string);
        $Cataggory = $categories[$s]['primary']; 
        echo gettype($Cataggory );
        $slug = $SLUG[$s] ;
        echo gettype($slug );


         
        
         $sqlquery = "INSERT INTO `jsondata` (`title`, `slug`, `content`, `categories`, `media`) VALUES (  '$TITLE[$s]',   ? ,   ?, ?,  '$TITLE[$s]' )" ;
         $stmt = $mysqli->prepare($sqlquery);
         $stmt->execute(array($slug,$res,$Cataggory));
       
         
    }
    // $title1=  implode(" ",$TITLE);
   
    /*  $columns =  implode(", ",array_keys($TITLE  ));
    $escaped_values = array_map('mysql_real_escape_string', array_values($TITLE));  
     $values  = implode(", ", $escaped_values); */
    
    
    

     $sqlquery3 = "SELECT *   FROM jsondata  " ;
     $stmt = $mysqli->prepare( $sqlquery3  );
       $stmt->execute();
      $result = $stmt->get_result();
      foreach ($result as $row) {
        
          print_r($row);
      }

     
      
    

     


     


 
    

?>