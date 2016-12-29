<?php
echo "hi1";

$ch = curl_init();

echo "hi2";

curl_setopt($ch, CURLOPT_URL,"https://pushify.com/api/authenticate");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "email=vikrantbanerjee5@gmail.com&pass=VB123yoyo1D!");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

echo "h3"
echo "<script>alert(".$server_output.");";

curl_close ($ch);

?>
