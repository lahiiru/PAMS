<?php
include 'Classes/PHPExcel/IOFactory.php';
class XlsJSONParser 
{
	var $inputFileName; 
	var $jsonstring;
	
	
	
	public function __construct() {
		$inputFileName= 'Dialog Deduction.xlsx';
		$js='"Table":[';
		try {
				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load('Dialog Deduction.xlsx');
			} 
		catch (Exception $e) 
			{
		die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
			}


		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		
		for ($row = 1; $row <= $highestRow; $row++) {
			//  Read a row of data into an array
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
		  // $Data = $rowData = $sheet->rangeToArray( $row.'A'. ':' $highestRow.'A', NULL, TRUE, FALSE);
			
			foreach($rowData[0] as $k=>$v)
			{
				if($v=="EMP No")
				{
					
					
					$column = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
					$keys=array_keys($column);
					$datarow=$row;
					//columnecho($column);
					break;
					
				}
			}
		
    
		}


	$js=''.$this->jsonCreator($datarow,$highestRow,$highestColumn,$js,$sheet,$column);
	$js=$js.']';
	
	echo $js;
	echo "<br>end";
	}
	
	function columnecho($col,$key)
{
	foreach($col[0] as $k=>$v)
	{
		if($key==$k)
			return $v;
		
	}
}

		function jsonCreator($datarow,$highestRow,$highestColumn,$js,$sheet,$column)
		{
			for ($row = $datarow+1; $row <= $highestRow; $row++) {
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			$js=$js.'{';
			$flag=0;
			foreach($rowData[0] as $currentcolumn=>$v)
			{
				if($flag==1)
					{
						$js=$js.',';	
					}
					if($v=='')
					{
						$js=substr($js, 0, -1);
						$js=substr($js, 0, -1);
						return $js;
					}
					$js=$js.'"'.$this->columnecho($column,$currentcolumn).'": "'.$v.'"';
					
					$flag=1;	
			}
			if($row==$highestRow)
			{
				$js=$js.'}';
			}
			else
			{
			$js=$js.'},';
			}  
		}
		return $js;
		}
		
		
		function getJsonString()
		{
			echo $this->$jsonstring;
			//return $this->$jsonstring;
		}
	
	
	
	
	
}	
class  Books{
    /* Member variables */
    var $price;
    var $title;
    /* Member functions */
    function setPrice($par){
       $this->price = $par;
    }
    function getPrice(){
       echo $this->price ."<br/>";
    }
    function setTitle($par){
       $this->title = $par;
    }
    function getTitle(){
       echo $this->title ." <br/>";
    }
}	
$physics = new Books;
$maths = new Books;
$chemistry = new Books;
$physics->setTitle( "Physics for High School" );
$chemistry->setTitle( "Advanced Chemistry" );
$maths->setTitle( "Algebra" );

$physics->setPrice( 10 );
$chemistry->setPrice( 15 );
$maths->setPrice( 7 );
$physics->getTitle();
$chemistry->getTitle();
$maths->getTitle();
$physics->getPrice();
$chemistry->getPrice();
$maths->getPrice();
											$jsonfile=new  XlsJSONParser;
											$jsonData1=$jsonfile->getJsonString();

?>
	





