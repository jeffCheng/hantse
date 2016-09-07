<?php
	function httpGet(){
		$url = "https://api.cloudflare.com/client/v4/zones/9ebdc2dcf9a063d5391419702061e006/purge_cache";
		$data = '{"purge_everything": true}';

		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"X-Auth-Email: jeff32191182@gmail.com", 
			"X-Auth-Key: 01ef0f044ea996adef87cb43544274f58805c", 
			"Content-Type: application/json"
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$output = @curl_exec($ch);
		curl_close($ch);
			return $output;
	}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="utf-8">
	<title>Hantse.com CDN 快取設定</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">
</head>

<body>
<h1>Hantse.com CDN 快取設定</h1>
<?php
$purge = isset($_POST["purge"]);

if($purge){
	$purged = json_decode(httpGet(), true)["success"];
	echo $purged ? "<h2>已清除</h2>" : "<h2>發生錯誤</h2>";
}
else{
	echo <<<EOF
<form method="POST">
	<input type="hidden" name="purge" value="1">
	<input type="submit" value="清除">
</form>
EOF;
}
?>
</body>

</html>