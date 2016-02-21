<?php
$jsondata = @file_get_contents("http://opendata.epa.gov.tw/ws/Data/REWXQA/?format=json");
//http://opendata.epa.gov.tw/ws/Data/AQX/?format=json
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>空氣品質即時監測資訊</title>
	
	<link href="jcss/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
	th{
		background-color: #2B5F75;
		color: #FFFFFF;
	}
	.fred{
		color: #DB4D6D;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>空氣品質即時監測資訊</h1>
	<div id="body">
	<blockquote>
		<p>PM2.5年平均值為15，24小時平均值為35</p>
		<small class="fred">超標為紅色</small>
	</blockquote>

		<table class="table table-bordered" id="mydata">
		<thead>
			<tr>
				<th>測站名稱</th>
				<th>縣市</th>
				<th>空污指標PSI</th>
				<th>指標污染物</th>
				<th>品質狀態</th>
				<th>二氧化硫濃度SO2</th>
				<th>一氧化碳濃度CO</th>
				<th>臭氧濃度</th>
				<th>懸浮微粒濃度</th>
				<th>細懸浮微粒濃度PM2.5</th>
				<th>二氧化淡濃度</th>
				<th>風速</th>
				<th>風向</th>
				<th>細懸浮微粒指標</th>
				<th>氮氧化物</th>
				<th>一氧化氮</th>
				<th>更新時間</th>
			</tr>
		</thead>
		<tbody id="databody">
			<?php
			if($jsondata){
				$mydata=json_decode($jsondata,True);
				foreach ($mydata as $key => $vv) {
					if($vv["PM2.5"]>35){
						$tablecontent.='<tr class="danger">';
					}else{
						$tablecontent.="<tr>";
					}
					
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
				echo $tablecontent;
			}else{
				echo '<tr><th colspan="19">遠端資料無法讀取，請稍後再試</th></tr>';
			}
			?>
		</tbody>
		<tfoot>
			<tr><th colspan="19">資料來源：環保署空氣品質即時污染指標</th></tr>
			<tr><th colspan="19">http://opendata.epa.gov.tw/Data/ContentsColumns/AQX/?PageIndex=1</th></tr>
			</tfoot>
		</table>
	</div>
	<p class="footer"></p>
</div>

<script src="jcss/jquery-1.12.0.min.js"></script>
<script src="jcss/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function() {
		//getresult();
		window.setInterval(getresult, 3000);
	});
	function getresult(){
		$.ajax({
			  url: "jsondata.php",
			  type: "GET",
			  dataType: "json",
			  success: function(Jdata) {
			  	var ajtxt="";
			  	$.each(Jdata, function( index, value ) {
			  		ajtxt +="<div class='tiles'>" + value +"</div>";
			  	})
			  	$("#numbox").empty();
			    $("#numbox").append(ajtxt);
			  },
			  error: function() {
			    
			  }
		});  
	}
</script>
<script type="text/javascript">
  var appInsights=window.appInsights||function(config){
    function r(config){t[config]=function(){var i=arguments;t.queue.push(function(){t[config].apply(t,i)})}}var t={config:config},u=document,e=window,o="script",s=u.createElement(o),i,f;for(s.src=config.url||"//az416426.vo.msecnd.net/scripts/a/ai.0.js",u.getElementsByTagName(o)[0].parentNode.appendChild(s),t.cookie=u.cookie,t.queue=[],i=["Event","Exception","Metric","PageView","Trace"];i.length;)r("track"+i.pop());return r("setAuthenticatedUserContext"),r("clearAuthenticatedUserContext"),config.disableExceptionTracking||(i="onerror",r("_"+i),f=e[i],e[i]=function(config,r,u,e,o){var s=f&&f(config,r,u,e,o);return s!==!0&&t["_"+i](config,r,u,e,o),s}),t
    }({
        instrumentationKey:"4a86ab74-1490-4fa1-896b-3c73225fbc31"
    });
       
    window.appInsights=appInsights;
    appInsights.trackPageView();
</script>
</body>
</html>