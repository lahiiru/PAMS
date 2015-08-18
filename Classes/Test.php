<?php
/**
 * Created by PhpStorm.
 * User: Niroshan
 * Date: 8/10/2015
 * Time: 12:03 AM
 */
//$t=new Test();
//$t->approveOrRejectBatch("APR");
/*
$sring="   sfsgsg gdgdg ggdg     ";
echo $sring;
echo '</br>';
$sring=trim($sring," ");

echo $sring;

*/

require_once 'auto_loader.php';

$obj=new DataLink("actions");
$conn=$obj->getConnection();
if($conn !=null){
    echo "Connection created Successfully!";
}
else{
    echo "DataBase conection Error!!";
}

$dataarray=array();


$query="SELECT u.*, s.* ,k.* FROM actions u inner join item_action_map s inner JOIN items k ON u.id = s.actionid  and s.itemid=k.id and k.itemtype='DLG' WHERE u.type != 'REG' ";
//$query="SELECT u.*, s.* ,k.* FROM item_action_map u inner join actions s inner JOIN items k ON u.actionid = s.id  and u.itemid=k.id";
//$query="SELECT NOT NULL ,NOT NULL,NOT NULL FROM actions inner join item_action_map inner JOIN items ";


if ($result = mysqli_query($conn, $query)) {
    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {
       foreach($result as $rw=>$data){
           foreach($data as $a=>$b){
               echo $b.'    ';
           }
           echo '</br>';
       }

    }


    mysqli_free_result($result);
}

else{
    echo "no data item";
}

mysqli_close($conn);








class Test {

}

