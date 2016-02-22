<?php
$jsondata = @file_get_contents("http://opendata.epa.gov.tw/ws/Data/REWXQA/?format=json");
$servername = "ap-cdbr-azure-east-c.cloudapp.net";
$username = "b55e922bd765e8";
$password = "6ba216d5";
$dbname = "albertphpdemo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
	if($jsondata){
		$mydata=json_decode($jsondata,True);
		$insert_str='';
		$sqlstr_d='';
		$sqlstr_h= "INSERT INTO airrec (SiteName,County,SI,MajorPollutant,Status,SO2,CO,O3,PM10,PM25,NO2,WindSpeed,WindDirec,FPMI,NOx,NO,PublishTime) VALUES (";
		$sqlstr_f=')";';
		foreach ($mydata as $key => $vv) {
			$sqlstr_d="'".$vv["SiteName"]."',"
			$sqlstr_d.="'".$vv["County"]."',";
			$sqlstr_d.="'".$vv["PSI"]."',";
			$sqlstr_d.="'".$vv["MajorPollutant"]."',";
			$sqlstr_d.="'".$vv["Status"]."',";
			$sqlstr_d.="'".$vv["SO2"]."',";
			$sqlstr_d.="'".$vv["CO"]."',";
			$sqlstr_d.="'".$vv["O3"]."',";
			$sqlstr_d.="'".$vv["PM10"]."',";
			$sqlstr_d.="'".$vv["PM2.5"]."',";
			$sqlstr_d.="'".$vv["NO2"]."',";
			$sqlstr_d.="'".$vv["WindSpeed"]."',";
			$sqlstr_d.="'".$vv["WindDirec"]."',";
			$sqlstr_d.="'".$vv["FPMI"]."',";
			$sqlstr_d.="'".$vv["NOx"]."',";
			$sqlstr_d.="'".$vv["NO"]."',";
			$sqlstr_d.="'".$vv["PublishTime"]."'";
			
			$insert_str=$sqlstr_h.$sqlstr_d.$sqlstr_f;

			if ($conn->query($insert_str) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $insert_str . "<br>" . $conn->error;
			}

		}
		$conn->close();
	}

} 




/*
file_put_contents('../../../../'.$save_FileName, $tablecontent);
SiteName
County
SI
MajorPollutant
Status
SO2
CO
O3
PM10
PM25
NO2
WindSpeed
WindDirec
FPMI
NOx
NO
PublishTime


//SiteName,County,SI,MajorPollutant,Status,SO2,CO,O3,PM10,PM25,NO2,WindSpeed,WindDirec,FPMI,NOx,NO,PublishTime
$sql = "INSERT INTO airrec (SiteName,County,SI,MajorPollutant,Status,SO2,CO,O3,PM10,PM25,NO2,WindSpeed,WindDirec,FPMI,NOx,NO,PublishTime)
VALUES ('John', 'Doe', 'john@example.com')";


*/


?>