<?php
/*
 * @author: Lahiru
 * @modified:
 * 
 */

/*
  //Return Employee Roles by String
  //create object
  $rm=new RolesManager("lahiru");
  echo $rm->getRoleCode();
  Edit:
	nuwan: create the connection using datalink class
*/
 
require_once('auto_loader.php');
class RolesManager {

    private $username;

    public function __construct($user='') {
        if($user==''){
             $user= $_SESSION['myusername'];
        }
        $this->username=$user;
    }

    public function getRoleCode() { //gives special role the user has
        if (!isset($_SESSION)) {
            session_start();
        }
        /*
        if (isset($_SESSION['role'])) {
            //if($_SESSION['role']=='EM')exit ();
            return $_SESSION['role'];
        }
*/
        //$conn = new mysqli("localhost", "root", "", "users");
		$obj=new DataLink("roles");
		$conn=$obj->getConnection();
                
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM `roles` WHERE `username`='" . $this->username . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        //echo print_r($row);//["roles"];
        if ($row) {
            $conn->close();
            $_SESSION['role'] = $row["roles"];
            return $row["roles"];
        } else {
            $conn->close();
            $_SESSION['role'] = "EM";
            return "EM";
        }
    }
    /*
     * Modified by Niroshan
     *  added new new item for $a array
     * for all feedeer
     */
    public function getRoleName($roleCode){
        /*
        $a=array(
            "EM"=>"Employee",
            "FD-DLG"=>"Feeder-DLG",
            "FD-FST"=>"Feeder-FST",
            "FD-LNE"=>"Feeder-LNE",
            "FD-LNS"=>"Feeder-LNS",
            "FD-MDC"=>"Feeder-MDC",
            "FD-MBT"=>"Feeder-MBT",
            "FD-RMT"=>"Feeder-RMT",
            "FD-NPY"=>"Feeder-NPY",
            "FD-OVT"=>"Feeder-OVT",
            "FD-RSG"=>"Feeder-RSG",
            "PO"=>"Payroll Officer",
            "HH"=>"HOHR",
            "HP-LOMC"=>"HR partner-LOMC"    
        );
        if(array_key_exists($roleCode, $a)){
            return $a[$roleCode];            
        }
        else{
            return "Ofiicer";
        }
         
         */
        return str_replace("EM", "Employee",str_replace("HH", "Head of HR",str_replace("HP", "HR Partner", str_replace("PO", "Payroll Officer",str_replace("FD", "Feeder", $roleCode)))));
        
    }
    /*
     * returns an array with roles and permission details with their employee details
     */
    public function getRolesDetailsArray(){
        
    }
}

?>