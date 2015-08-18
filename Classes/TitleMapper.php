<?php
/**
 * Maps title of uploading xls with sql table titles
 * Returns an associative array containing map.
 * 
 * @author Lahiru
 */

//$map=new TitleMapper("DLG");
//$mapArr=$map->getMapXLS_SQL();

//print_r($mapArr);

class TitleMapper {
    private $itemType;              // e.g. DLG
    private $parentMap=array(
            "DLG" => array(
                'empno' => 'EMP No',
                'epfno' => 'EPF No',
                'name' => 'Name',
                'company' => 'Company',
                'department' => 'Department',
                'corporatetitle' => 'Corporate Title',
                'amount' => 'Dialog deductions'
            ),
            "FST" => array(
                'empno' => 'EMP No',
                'epfno' => 'EPF No',
                'company' => 'Company',
                'name' => 'Name',
                'corparatetitle' => 'Corparate Title',
                'department' => 'Bu/Department',
                'amount' => 'Amount'
            ),
            "LNS" => array(
                'empno' => 'EPF No',
                'epfno' => 'EPF No',
                'name' => 'Employee Name',
                'varchar1' => 'NIC No',
                'contractno' => 'Contract No',
                'company' => 'Company',
                'date1' => 'Settlement Date'
            ),
            "LNE" => array(
                'empno' => 'EMP No',
                'epfno' => 'EPF No',
                'name' => 'Employrr Name',
                'company' => 'Company',
                'varchar1' => 'NIC No',
                'varchar2' => 'Contract No',
                'amount' => 'Monthly Rental',
                'int_1' => 'No of Instalments',
                'date1' => 'Excution Date'
            ),
            "MBT" => array(
                'empno' => 'EMP No',
                'epfno' => 'EPF No',
                'name' => 'Name',
                'company' => 'Company',
                'corporatetitle' => 'Corporate Title',
                'department' => 'Department',

                'amount' => 'Mobitel deductions'

            ),
            "RMT" => array(



                'basicsalary' => 'Basic Salary',
                'brallowance' => 'BR Allowance',
                'travellingallowance' => 'Travelling Allowance',
                'attendance_mealallowance' => 'Attendance & Meal Allowance',
                'cashierallowance' => 'Cashier Allowance',
                'sportclub' => 'Sport Club',
                'recreationclub' => 'Recreation Club',
                'benevelentfund' => 'Benevelent Fund',

                'nic' => 'NIC No',
                'destination' => 'Designation',
                'accno' => 'Account No',
                'salgrade' => 'Sal Grade',
                'bucategory' => 'BU Category',
                'branch' => 'Branch',
                'email' => 'E-Mail',
                'bankname' => 'Bank Name',
                'emptype' => 'EMP Type',
                'bankbranch' => 'Bank Branch',
                'fullname' => 'Full Name',

                'company' => 'Company',
                'corporatetitle' => 'Coporate Title',
                'department' => 'Department',
                'empno' => 'EMP No',
                'epfno' => 'EPF No',
                'name' => 'Other Name',
                'startdate' => 'Start Date'

            ),
            "NPY" => array(
                'company' => 'Comapany',
                'corperatetitle' => 'Cooperate Title',
                'department' => 'Department',
                'empno' => 'EMP No',
                'epfno' => 'EPF No',
                'name' => 'Name',
                'int_1' => 'Number of days'
            ),
            "RSG" => array(
                'company' => 'Comapany',
                'corperatetitle' => 'Cooperate Title',
                'department' => 'Department',
                'empno' => 'EMP No',
                'epfno' => 'EPF No',
                'name' => 'Name',

                'date1' => 'Date of joined',
                'date2' => 'Resignation Effective Date',

                'varchar1' => 'Designation',
                'varchar2' => 'BU/Department',
                'varchar3' => 'Type (Resignation/Hold)',

                'float_1' => 'Vehicle loan',
                'float_2' => 'Mobile bills',
                'float_3' => 'Festival advance',
                'float_4' => 'Other'




            ),
            "OVT" => array(
                'branch' => 'Branch',
                'company' => 'Company',
                'corperatetitle' => 'Corporate Title',
                'department' => 'Department',

                'empno' => 'EMP No',
                'epfno' => 'EPF No',
                'name' => 'Name',

                'float_1' => 'Normal OT(Hrs.)',
                'float_2' => 'Double OT(Hrs.)',
                'float_3' => 'Tripple OT(Hrs.)',
                'float_4' => 'Total OT(Hrs.)'

            )

        );
    public function __construct($type) {
        $this->itemType=$type;
    }
    public function getMapSQL_XLS(){                                           //return format 'empno' => 'EMP No'
        if(array_key_exists($this->itemType, $this->parentMap)){
            return $this->parentMap[$this->itemType];
        }
        else{
            return "Error: Invalid item type ".$this->itemType;
        }
    }

    public function getMapXLS_SQL(){                                           //return format 'EMP No' => 'empno'
        
        if(array_key_exists($this->itemType, $this->parentMap)){
            $revArray=array_flip($this->parentMap[$this->itemType]);
            return $revArray;
        }
        else{
            return "Error: Invalid item type ".$this->itemType;
        }
    }
    public function getSQLtitleByXLS($xlsTitle){
        return getMapXLS_SQL()[$xlsTitle];
    }
}
