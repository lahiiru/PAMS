<?php

/*
 * @author: Lahiru
 * Returns relevant ItemDA object
 */


  //$ifac = new ItemDAFactory();
  //$ifac->getDAobj($this->itemType, $record, $this->recentActionID)->getQueryStr();
  //$ifac->getDAobj($this->itemType, $record, $this->recentActionID)->updateDB($this->conn);


class ItemDAFactory {

    public function getDAobj($type, $record, $actionID) {
        $type=strtoupper($type);
        switch ($type) {
            case 'DLG':return new GeneralDA($record, $actionID, $type);
            case 'FST':return new GeneralDA($record, $actionID, $type);
            case 'LNS':return new GeneralDA($record, $actionID, $type);
            case 'LNE':return new GeneralDA($record, $actionID, $type);
            case 'MBT':return new GeneralDA($record, $actionID, $type);
            case 'RMT':return new GeneralDA($record, $actionID, $type);
        }
    }

}

class GeneralDA {

    private $query;

    public function __construct($record, $actionID, $type) {
        $prefix="CRE";
        $mapper=new TitleMapper($type);
        $arrayMap=$mapper->getMapSQL_XLS();
        $lastActionID = $prefix . "-" . $actionID . ';';
        $a = "INSERT INTO `items` (";
        $b = "`itemtype`) VALUES (";
        foreach ($arrayMap as $key => $value) {
            $a.="`$key`,";
            $b.="'$record[$value]',";
        }
        $type=strtoupper($type);
        $this->query = "$a$b'$type')";
    }
     
    public function getQueryStr() {
        return $this->query;
    }

    public function updateDB($conn) {
        mysqli_query($conn, $this->query);
    }

}
/*
class dlgDA extends GeneralDA {

    public function __construct($record, $actionID, $type) {
        parent::__construct($record, $actionID, 'CRE', $type);
    }

}

class fstDA extends GeneralDA {

    public function __construct($record, $actionID, $type) {
        parent::__construct($record, $actionID, 'CRE', $type);
    }

}

class lnsDA extends GeneralDA {

    public function __construct($record, $actionID, $type) {
        parent::__construct($record, $actionID, 'CRE', $type);
    }

}

class lneDA extends GeneralDA {

    public function __construct($record, $actionID, $type) {
        parent::__construct($record, $actionID, 'CRE', $type);
    }

}

class mbtDA extends GeneralDA {

    public function __construct($record, $actionID, $type) {
        parent::__construct($record, $actionID, 'CRE', $type);
    }

}

class rmtDA extends GeneralDA {

    public function __construct($record, $actionID, $type) {
        parent::__construct($record, $actionID, 'CRE', $type);
    }

}

class npyDA extends GeneralDA {

    public function __construct($record, $actionID, $type) {
        parent::__construct($record, $actionID, 'CRE', $type);
    }

}

class ovtDA extends GeneralDA {

    public function __construct($record, $actionID, $type) {
        parent::__construct($record, $actionID, 'CRE', $type);
    }

}

 */
?>