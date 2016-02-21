<?php
$jsondata = @file_get_contents("http://opendata.epa.gov.tw/ws/Data/REWXQA/?format=json");
//http://opendata.epa.gov.tw/ws/Data/AQX/?format=json
$tablecontent="<table>";
//$tablecontent.="<td></td>"

if($jsondata){
	$mydata=json_decode($jsondata,True);
	foreach ($mydata as $key => $vv) {
		$tablecontent.="<tr>";
		/*
		foreach ($vv as $value1) {
			$tablecontent.="<td>".$value1."</td>";
		}
		*/
		$tablecontent.="<td>".$vv["SiteName"]."</td>";
		$tablecontent.="<td>".$vv["County"]."</td>";
		$tablecontent.="<td>".$vv["PSI"]."</td>";
		$tablecontent.="<td>".$vv["MajorPollutant"]."</td>";
		$tablecontent.="<td>".$vv["Status"]."</td>";
		$tablecontent.="<td>".$vv["SO2"]."</td>";
		$tablecontent.="<td>".$vv["CO"]."</td>";
		$tablecontent.="<td>".$vv["O3"]."</td>";
		$tablecontent.="<td>".$vv["PM10"]."</td>";
		$tablecontent.="<td>".$vv["PM2.5"]."</td>";
		$tablecontent.="<td>".$vv["NO2"]."</td>";
		$tablecontent.="<td>".$vv["WindSpeed"]."</td>";
		$tablecontent.="<td>".$vv["WindDirec"]."</td>";
		$tablecontent.="<td>".$vv["FPMI"]."</td>";
		$tablecontent.="<td>".$vv["NOx"]."</td>";
		$tablecontent.="<td>".$vv["NO"]."</td>";
		$tablecontent.="<td>".$vv["PublishTime"]."</td>";

		$tablecontent.="</tr>";
	}
	$tablecontent.="</table>";
	echo $tablecontent;

}else{
	echo "stream data error";
}


	//echo $vv;
	

//print_r($fp);http://data.taipei/youbike

?>