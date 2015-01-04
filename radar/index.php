<!--Proof of concept of Situational awareness radar for in clubhouse or on the strip. Needs to run on 1920x1080 screen resolution. If you make improvements please share! -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<html>
	<head>
		<title>Live Info @ EHGR - GLC Illustrious</title>
			<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
			<META HTTP-EQUIV="Expires" CONTENT="-1">

<style>
body { overflow:hidden;background-color:#bbcee8; }
* { margin: 0; padding: 0; }

.top, .middle {width:1920px;height:1px;background-color:#bbcee8;margin:0 0 10 0;}

.tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;border:none;}
.tg td{font-family:Arial, sans-serif;font-size:24px;text-align: left; font-weight:bold; padding:0;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#bbcee8;}
.tg th{font-family:Arial, sans-serif;font-size:24px;text-align: left; font-weight:bold;padding:10px 5px;border-style:solid;border-width:0px;width:200px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f38630;}
.tg .tg-29rf{font-size:24px;font-family:Arial, Helvetica, sans-serif !important;}
.tg .tg-698h{background-color:#bbcee8}

#frame-1, #frame-2 {
        -ms-zoom: 0.70;
        -moz-transform: scale(0.70);
        -moz-transform-origin: 0 0;
        -o-transform: scale(0.70);
        -o-transform-origin: 0 0;
        -webkit-transform: scale(0.70);
        -webkit-transform-origin: 0 0;
    }

    #wrap-1 { background-color:#fbede2; width: 852px; height: 575px; padding: 0; overflow: hidden;}
    #frame-1 { width: 1218px; height: 821px;}

    #wrap-2 { background-color:#fbede2; width: 1020px; height: 575px; padding: 0; overflow: hidden;}
    #frame-2 { width: 1440px; height: 821px;}

    #wrap-3 { background-color:#fbede2; width: 1035px; height: 336px; padding: 0; overflow: hidden;}
    #frame-3 { width: 1035px; height: 336px;}

    #wrap-4 { background-color:#fbede2; width: 336px; height: 336px; padding: 0; overflow: hidden;}
    #frame-4 { width: 336px; height: 336px;}

    #wrap-5 { background-color:#fbede2; width: 462px; height: 336px; padding: 0; overflow: hidden;}
    #frame-5 { width: 462px; height: 336px;}
</style>

</head>

<body bgcolor="#BBCEE8">

<div class="top">&nbsp;</div>

<table class="tg">
 	<tr>
		<th class="tg-29rf">Local Radar</th>
		<th class="tg-698h"></th>
		<th class="tg-698h"></th>
		<th class="tg-29rf">Extended Radar</th>
		<th class="tg-698h"></th>
	</tr>
	<tr>
		<td class="tg-031e" colspan="2">
			<div id="wrap-1"><iframe id="frame-1" src="http://live.glidernet.org/#c=51.56357,4.97&z=13&b=51.8149,51.2253,5.8297,4.0719&w=0&nocache=<?php echo date("Ymd-His");?>" frameBorder="0"></iframe></div>
		</td>
		<td class="tg-698h"></td>
		<td class="tg-031e" colspan="2">
			<div id="wrap-2"><iframe id="frame-2" src="http://live.glidernet.org/#c=51.52103,4.95078&z=9&b=52,51,6,3.8&l=zr&w=0&nocache=<?php echo date("Ymd-His");?>" frameBorder="0"></iframe></div>
		</td>
  </tr>
</table>
<div class="middle">&nbsp;</div>
<table class="tg">
 	<tr>
		<th class="tg-29rf">Vluchten van vandaag</th>
		<th class="tg-698h"></th>
		<th class="tg-698h"></th>
		<th class="tg-29rf">Buienradar</th>
		<th class="tg-698h"></th>
		<th class="tg-698h"></th>
		<th class="tg-29rf">Wolken</th>
		<th class="tg-698h"></th>
	</tr>
	<tr>
		<td class="tg-031e" colspan="2">

<script type="text/javascript">
        setInterval(refreshIframe3, 600000);
        function refreshIframe3() {
            var frame = document.getElementById("frame-3");
            frame.src = frame.src;
        } 
    </script>

			<div id="wrap-3"><iframe id="frame-3" src="flightlog.php?a=EHGR&s=QFE&u=m&nocache=<?php echo date("Ymd-His");?>" frameBorder="0"></iframe></div>
		</td>
		<td class="tg-698h"></td>
		<td class="tg-031e" colspan="2">
			<div id="wrap-4">

<script type="text/javascript">
        setInterval(refreshIframe4, 300000);
        function refreshIframe4() {
            var frame = document.getElementById("frame-4");
            frame.src = frame.src;
        } 
    </script>

			<iframe id="frame-4" src="http://www.weeronline.nl/Go/ExternalWidgetsNew/RainWidgetContent?gid=4058597&sizeType=1&defaultSettings=False&nocache=<?php echo date("Ymd-His");?>" frameBorder="0"></iframe></div>
		</td>
		<td class="tg-698h"></td>
		<td class="tg-031e" colspan="2">
			<div id="wrap-5">

<script type="text/javascript">
        setInterval(refreshIframe5, 300000);
        function refreshIframe5() {
            var frame = document.getElementById("frame-5");
            frame.src = frame.src;
        } 
    </script>

			<iframe id="frame-5" src="sat24.php"></iframe></div>
</body>
</html>