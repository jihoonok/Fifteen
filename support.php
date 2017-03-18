<?php

function generatePage($body, $title="DontDoDrugs", $style="css/bootstrap.css") {
    $page = <<<EOPAGE
	<!doctype html>
	<html>
		<head> 
			<meta charset="utf-8">
			<title>$title</title>			
			
			<link rel="stylesheet" type="text/css"  href="$style"/>
		</head>
				
		<body>
				$body
		</body>
	</html>
EOPAGE;

    return $page;
}
?>