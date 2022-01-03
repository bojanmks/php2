<?php
    require_once('../../../config/connection.php');
    require_once('../functions.php');

    $excel = new COM("Excel.Application") or Die ("Konekcija sa Excel-om nije bila uspešna!");
	$Workbook = $excel->Workbooks->Add();
	$Worksheet = $Workbook->Worksheets('Sheet1');
		
	$field = $Worksheet->Range("A1");
	$field->activate;	
	$field->Value = "ID:";
		
	$field = $Worksheet->Range("B1");
	$field->activate;	
	$field->Value = "Username:";
		
	$field = $Worksheet->Range("C1");
	$field->activate;	
	$field->Value = "Email:";
		
	$field = $Worksheet->Range("D1");
	$field->activate;	
	$field->Value = "Role:";

    $field = $Worksheet->Range("E1");
	$field->activate;	
	$field->Value = "Active:";

    $users = getAllUsers();
	foreach($users as $key=>$u) {
        $rowNumber = $key + 2;

        $field = $Worksheet->Range("A$rowNumber");
        $field->activate;	
        $field->Value = $u->id;
            
        $field = $Worksheet->Range("B$rowNumber");
        $field->activate;	
        $field->Value = $u->username;
            
        $field = $Worksheet->Range("C$rowNumber");
        $field->activate;	
        $field->Value = $u->email;
            
        $field = $Worksheet->Range("D$rowNumber");
        $field->activate;	
        $field->Value = $u->role_name;

        $field = $Worksheet->Range("E$rowNumber");
        $field->activate;	
        $field->Value = $u->active;
    }

    $location = ABSOLUTE_PATH . "data/users.xls";
    $location = str_replace("/", "\\", $location);
	$Workbook->_SaveAs($location, -4143);
		
	$Workbook->Save();
	$Workbook->Saved = true;
	$Workbook->Close;
		
	unset($Workbook);
		
	$excel->Workbooks->Close();
	$excel->Quit();
		
	unset($excel);

    // download
    $file = file_get_contents($location);
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment;filename=users.xls");
    echo($file);

    // delete
    if(file_exists($location)) {
        unlink($location);
    }
?>