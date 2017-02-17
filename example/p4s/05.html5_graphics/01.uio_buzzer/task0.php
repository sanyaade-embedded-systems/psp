<?php 

if(_SERVER("REQUEST_METHOD"))
	exit; // avoid php execution via http request

include "/lib/sd_340.php";
include "/lib/sn_tcp_ws.php";

define("OUT_PIN", 0);

uio_setup(0, OUT_PIN, "out low");
ws_setup(0, "buzzer", "csv.phpoc");

$rwbuf = "";

while(1)
{
	if(ws_state(0) == TCP_CONNECTED)
	{
		$rlen = ws_read_line(0, $rwbuf);

		if($rlen)
			uio_out(0, OUT_PIN, (int)$rwbuf);
	}
}

?>

