<!DOCTYPE html>
<html>
<head>
<h1 align = "left">Monitoring Tool Index Page</h1><br>
<title>Assignment 1</title>
</head>

<?php
	include "db.php";
	$conn = mysqli_connect($host, $username, $password, $database, $port);

	if (!$conn)
	{
	   die("Connection failed: " . mysqli_connect_error());
	}
	
	mysqli_select_db($conn,"$database");	
	$result = mysqli_query($conn,"SELECT * FROM Graphs");        

//RRD

	while($row = mysqli_fetch_array($result)) 
	{
		$id = $row["id"];
		$ip = $row["IP"];
		$ports = $row["PORT"];
		$com = $row["COMMUNITY"];
		$sname = $row['sysname'];

		$ifname = explode (",",$row['name']);
		sort($ifname);

		if (file_exists("$ip:$ports:$com.rrd")==1)
		{	

		foreach ($ifname as $ifname1)
		{
		 $ifname2 = explode (".",$ifname1);	

		 $int = $ifname2[0];

		 $opts = array( "--start", "-1d","--vertical-label=Bytes per second",
                 "DEF:bytesIn=$ip\:$ports\:$com.rrd:bytesIn$int:AVERAGE",
                 "DEF:bytesOut=$ip\:$ports\:$com.rrd:bytesOut$int:AVERAGE",
		 "AREA:bytesIn#00FF00:In traffic",
                 "LINE1:bytesOut#0000FF:Out traffic\\r",
                 "GPRINT:bytesIn:MAX:Max In\:%6.2lf %SBps",
                 "GPRINT:bytesIn:AVERAGE:Avg In\:%6.2lf %SBps",
                 "GPRINT:bytesIn:LAST:Current In\:%6.2lf %SBps\\j",
		 "GPRINT:bytesOut:MAX:Max Out\:%6.2lf %SBps",
                 "GPRINT:bytesOut:AVERAGE:Avg Out\:%6.2lf %SBps",
                 "GPRINT:bytesOut:LAST:Current Out\:%6.2lf %SBps\\j"
               );
		 
		$ret = rrd_graph("$ip:$ports:$com:$int.daily.png", $opts);

		?>

		<h4 style='float:left;margin-right:5%;'><?php echo "Traffic Analysis for $ifname2[1]-- $sname "?><br>
		<a href="graph.php?var=<?php echo "$id";?> & var2=<?php echo "$int";?>" style='float:left;margin-right:5%;'>
		<img src=<?php echo "./$ip:$ports:$com:$int.daily.png";?> alt="Daily">
		</h4>
		</a>

		<?php
		}
		}
	}
		?>
</html>
