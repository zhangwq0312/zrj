				<div class="panel panel-default" >
					<div class="panel-heading-green" >
<script language=Javascript type=text/Javascript> 
									var day=""; 
									var month=""; 
									var ampm=""; 
									var ampmhour=""; 
									var myweekday=""; 
									var year=""; 
									mydate=new Date(); 
									myweekday=mydate.getDay(); 
									mymonth=mydate.getMonth()+1; 
									myday= mydate.getDate(); 
									myyear= mydate.getYear(); 
									year=(myyear > 200) ? myyear : 1900 + myyear; 
									if(myweekday == 0) 
									weekday=" 星期日 "; 
									else if(myweekday == 1) 
									weekday=" 星期一 "; 
									else if(myweekday == 2) 
									weekday=" 星期二 "; 
									else if(myweekday == 3) 
									weekday=" 星期三 "; 
									else if(myweekday == 4) 
									weekday=" 星期四 "; 
									else if(myweekday == 5) 
									weekday=" 星期五 "; 
									else if(myweekday == 6) 
									weekday=" 星期六 "; 
									document.write(year+"年"+mymonth+"月"+myday+"日 "+weekday); 
									</script>
					</div>
					<div class="panel-body" >
									<?php 
try{
									$ch = curl_init();

									//设置选项，包括URL
									curl_setopt($ch, CURLOPT_URL, "http://flash.weather.com.cn/wmaps/xml/lvliang.xml");
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($ch, CURLOPT_HEADER, 0);
									//执行并获取HTML文档内容
									$output = curl_exec($ch);
									curl_close($ch);
									//打印获得的数据 
									$xml = simplexml_load_string($output);  

									if(!$xml==false){
										foreach($xml->children() as $city){ 
										
											foreach($city->attributes() as $a => $b){ 
												
												 if($a=="cityname"&&$b=="孝义市"){
													echo "&nbsp;<b><span  style='font-size:20px;'>".$city->attributes()->stateDetailed."</span></b>";
										//			echo "&nbsp;".$city->attributes()->windState."";
													if(!$city->attributes()->temNow=="暂无实况"){
														echo "&nbsp;当前：<b><font style='font-size:18px'>".$city->attributes()->temNow."</font></b>℃";
													}	
													echo "&nbsp;全天".$city->attributes()->tem1."℃"."~".$city->attributes()->tem2."℃";
													break;
												 }
											} 
										} 
									}
}
catch(Exception $e)
{
	
}
									?>
					</div>
				</div>