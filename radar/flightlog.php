<html>
<head>

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta http-equiv="refresh" content="300">
  <title></title>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
function scroll(speed) {
    $('html, body').animate({ scrollTop: $(document).height() - $(window).height() }, speed, function() {
        $(this).animate({ scrollTop: 0 }, speed);
    });
}

speed = 20000;

scroll(speed)
setInterval(function(){scroll(speed)}, speed / 4);
});//]]>  

</script>


</head>


<script src="js/sorttable.js"></script>
<script>
source = '<?php 
$airfield = substr($_GET["a"],0,9);
$day = substr($_GET["d"],0,9);
$source = file_get_contents("http://live.glidernet.org/flightlog/index2.php?s=QFE&u=m&a=".$airfield."&d=".$day);
$source = str_replace(array("\r\n", "\n", "\r"), ' ', $source); //remove linebreaks for javascript
$source = str_replace('<BR>', '<BR/>', $source); //xhtml for DOMParser
echo $source; 
?>';

/*
var wrapper = document.createElement('div');
wrapper.innerHTML = source;
var dom = wrapper.firstChild;
*/

function toHHMMSS(sec) {
	if(isNaN(sec)) { return "???"; }
	
	var sec_num = parseInt(sec, 10); // don't forget the second parm
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    var time    = hours+':'+minutes+':'+seconds;
    return time;
}

function displaynumber(number, unit) {
	if(isNaN(number) || number == 0) return "";
	else return Math.round(number*100)/100 + unit;
}

if (window.DOMParser) {
  parser=new DOMParser();
  xmlDoc=parser.parseFromString(source,"text/xml");
} else { // code for IE
  xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
  xmlDoc.async=false;
  xmlDoc.loadXML(source); 
}

//parse table on http://cunimb.fr/live/flightlog/ according to glider or motorplane columns
function parseFlightlog(plane, cn, type, time, alt, towedPlane) {
	if(plane != "") {
		//towing statistics
		if(towedPlane == "") {
			release_alt = 0; 
		} else {
			release_alt = parseInt(alt,10); //Number.parseInt(alt);
			if(isNaN(release_alt)) release_alt = 0;
		}
		planeIndex = planeTable.indexOf(plane);
		hmsArray = time.split(/[A-Za-z]+/);
		seconds = parseInt(hmsArray[0],10)*3600 + parseInt(hmsArray[1],10)*60 + parseInt(hmsArray[2],10);
		if (planeIndex < 0 ) {
			// new entry
			var tows = 0;
			var tow_seconds = 0;
			if(release_alt > 0) {
				tows =  1;
				tow_seconds = seconds;
			}	
			totalTable.push( Array(plane, type, 1, seconds, tows, release_alt, tow_seconds, cn) ); //id, type, flights, duration, tows, release alt, tow duration, callsign
			planeTable.push( plane ); // 1D array to check for entry
		} else {
			// add to existing entry
			totalTable[planeIndex][2] += 1; //number of flights
			totalTable[planeIndex][3] += seconds; //total duration
			if(release_alt > 0) {
				totalTable[planeIndex][4] += 1; //number of aerotows
				totalTable[planeIndex][5] += release_alt; //total tow height
				totalTable[planeIndex][6] += seconds; //total tow duration
			}
		}
	}
}


var inputTable = xmlDoc.getElementsByTagName("TABLE")[0];

var outputTable = Array();
var totalTable = Array();
var planeTable = Array();

//parse inputTable into 2D array
for (var i = 1, rowsLength = inputTable.childNodes.length; i < rowsLength; i++) {
	var newRow = Array();
	var row = inputTable.childNodes[i];
	for (var j = 0, cellsLength = row.childNodes.length; j < cellsLength; j++) {
	   var cell = row.childNodes[j];
	   newRow.push(String(cell.innerHTML));
	}
	outputTable[i] = newRow;
   
	//sum totals for each plane, without header row
	parseFlightlog(newRow[0],"",newRow[1],newRow[9],newRow[10], newRow[2]); //motorplane
	parseFlightlog(newRow[2],newRow[3],newRow[4],newRow[7],0,""); //glider

}

function init() {
	//display sortable table with http://www.kryogenix.org/code/browser/sorttable/
	document.getElementById('output').innerHTML = source;
	sorttable.makeSortable(document.getElementsByTagName('TABLE')[0]);
	
}


</script>

<style type="text/css">
table.totalvalues tbody tr:nth-child(2n) td {
  background: #ffffff;
}
table.totalvalues tbody tr:nth-child(2n+1) td {
  background: #cccccc;
}
table.totalvalues th {
  background: #aaaaaa;
}

table th:not(.sorttable_sorted):not(.sorttable_sorted_reverse):after { 
    content: " \25B4\25BE" 
}

table tbody {
    counter-reset: sortabletablescope;
}
table thead tr::before {
    content: "";
    display: table-cell;
}
table tbody tr::before {
    content: counter(sortabletablescope);
    counter-increment: sortabletablescope;
    display: table-cell;
	text-align: right;
	padding-right: 5px;
}

#total, #totalheading {
	text-align: center;	
	margin-left: auto; 
	margin-right: auto; 
}
#total table {
	border-collapse: collapse;
	margin-left: auto; 
	margin-right: auto; 
}
#total table td, th {
	border: 1px solid black;
	padding: 0px 3px;
	min-width: 70px;
}
</style>
</head>

<body onLoad="init()">

<div id="output">
</div>

<div id="total">
</div>

</body>
</html>