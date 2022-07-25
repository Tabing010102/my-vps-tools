<?php

  $ip = $_GET['ip'];

  echo "Domain: a.b.com<br>";

  echo "IP: $ip<br>";

  echo "Changing IP using curl...";

  echo "Output:<br>";

  $cmd = 'curl -X PUT "https://api.cloudflare.com/client/v4/zones/xxx/dns_records/xxx" -H "X-Auth-Email: a@b.com" -H "X-Auth-Key: xxxxx" -H "Content-Type: application/json" --data \'{"type":"A","name":"a.b.com","content":"'.$ip.'"}\'';

  system($cmd, $retavl);

  echo "<br>Command exit with return value:".$retavl.".<br>";

?>
