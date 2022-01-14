<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if($_POST["id"] != ''){ 
		$query = "SELECT * FROM tbl_company 
					JOIN tbl_company_address1 ON tbl_company_address1.company_address_id = tbl_company.company_address_id
						JOIN cities ON cities.city_id = tbl_company_address1.city_id
						JOIN provinces ON provinces.province_id = tbl_company_address1.province_id 
					JOIN tbl_company_contact ON tbl_company_contact.company_contact_id = tbl_company.company_contact_id
					JOIN tbl_company_moa ON tbl_company_moa.company_moa_id = tbl_company.company_moa_id
					JOIN tbl_user ON tbl_user.userid = tbl_company.userid
				WHERE tbl_company.company_id = '".$_POST["id"]."'";  
		$_SESSION['query'] = $query;
	}
?>