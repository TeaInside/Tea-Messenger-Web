<!DOCTYPE html>
<html>
<head>
	<title>IceTea Framework</title>
</head>
	<body>
		<center>
			<h1>Welcome to IceTea Framework</h1>
			<h2>Here the route list</h2>
			<table border="1" style="border-collapse: collapse;">
			<tr><td align="center">No.</td><td align="center">Route</td><td align="center">Method</td><td align="center">Action</td></tr>
			<?php
            $a = \IceTea\Routing\RouteCollector::getRoutes();
            $i = 1;
            foreach ($a as $route => $actions) {
                foreach ($actions as $method => $action) {
                    ?>
					<tr><td align="center"><?php print $i++; ?>.</td><td><?php print $route; ?></td><td><?php print $method; ?></td><td><?php print $action instanceof \Closure ? "Closure" : $action; ?></td></tr>
					<?php
                }
            }
            ?>
			</table>
		</center>
	</body>
</html>