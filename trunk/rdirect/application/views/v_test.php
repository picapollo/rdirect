<html>
	<head></head>
	<body>
		
	<div style="position: relative; float:left; width:100px; height:300px; background:yellow; padding:0; margin: 0; z-index:1;">
		<div style="background:green; width:100px; height:100px; padding:0; margin: 0;"></div>
		<div style="position:absolute; float: none; background:blue; left:0px; width:300px; top:100px; height:100px; padding:0; margin: 0; z-index:400;"></div>
		<div style="background:green; width:100px; height:100px; padding:0; margin: 0;"></div>
	</div>
	<div style="position: relative; float: left; width:700px; height:300px; background: black;z-index:3;" onclick="javascript:alert('aha');">2</div>	
		
	</body>
</html>