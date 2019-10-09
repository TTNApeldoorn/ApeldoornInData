<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="https://apeldoornindata.nl">Apeldoorn in Data</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
		  <?php
            echo '<li><a href="https://apeldoornindata.nl">Home</a></li>'."\n";
		  echo '<li';
		  if(strpos($_SERVER['REQUEST_URI'], 'map.php') !== false ) {
				echo ' class="active"';
			}
			echo '><a href="https://apeldoornindata.nl/map.php">Kaart</a></li>'."\n";
            echo '<li><a href="https://apeldoornindata.nl/index.php/category/apeldoorn-in-data/">Blog</a></li>'."\n";
		  echo '<li class="dropdown';
		  if(strpos($_SERVER['REQUEST_URI'], 'raw.php') !== false
		  	|| strpos($_SERVER['REQUEST_URI'], 'gateway.php') !== false
		  	|| strpos($_SERVER['REQUEST_URI'], 'nodeoverview.php') !== false	
		  	|| strpos($_SERVER['REQUEST_URI'], 'node.php') !== false	
		  	|| strpos($_SERVER['REQUEST_URI'], 'chart') !== false	) {
		  	echo ' active';
		  }
		  echo '">'."\n";
              echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Details<span class="caret"></span></a>'."\n";
              echo '<ul class="dropdown-menu">'."\n";
				  echo '<li';
		  	if(strpos($_SERVER['REQUEST_URI'], 'raw.php') !== false ) {
		  			echo ' class="active"';
				  }
				  echo '><a href="'.$GLOBALS['urldata'].'raw.php">Ruwe data</a></li>'."\n";
				  echo '<li';
		  	if(strpos($_SERVER['REQUEST_URI'], 'gateway.php') !== false ) {
		  			echo ' class="active"';
				  }
				  echo '><a href="'.$GLOBALS['urldata'].'gateway.php">Gateways</a></li>'."\n";
				  echo '<li';
		  	if(strpos($_SERVER['REQUEST_URI'], 'node.php') !== false
		  		|| strpos($_SERVER['REQUEST_URI'], 'nodeoverview.php') !== false ) {
		  			echo ' class="active"';
				  }
		  		echo '><a href="'.$GLOBALS['urldata'].'nodeoverview.php">Nodes</a></li>'."\n";
		  		echo '<li class="';
		  	if(strpos($_SERVER['REQUEST_URI'], 'chart') !== false ) {
		  		echo 'active ';
		  	}
		  	echo ' dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Grafieken</a>'."\n";
		  	echo '<ul class="dropdown-menu">
                        <li ';
		  	if(strpos($_SERVER['REQUEST_URI'], 'chartcombined.php?id=01') !== false ) {
		  		echo 'class="active" ';
		  	}
			echo '><a href="'.$GLOBALS['urldata'].'chartcombined.php?id=01">Temperatuur</a></li>
            <li ';
		  	if(strpos($_SERVER['REQUEST_URI'], 'chartcombined.php?id=2') !== false ) {
		  		echo 'class="active" ';
		  	}
		  	echo '><a href="'.$GLOBALS['urldata'].'chartcombined.php?id=2">Relatieve vochtigheid</a></li>
            <li ';
		  	if(strpos($_SERVER['REQUEST_URI'], 'chartcombined.php?id=3') !== false ) {
		  		echo 'class="active" ';
		  	}
		  	echo '><a href="'.$GLOBALS['urldata'].'chartcombined.php?id=3">Luchtdruk</a></li>
            <li ';
		  	if(strpos($_SERVER['REQUEST_URI'], 'chartcombined.php?id=4') !== false ) {
		  		echo 'class="active" ';
		  	}
		  	echo '><a href="'.$GLOBALS['urldata'].'chartcombined.php?id=4">Lichtintensiteit</a></li>
            <li ';
		  	if(strpos($_SERVER['REQUEST_URI'], 'chartcombined.php?id=5') !== false ) {
		  		echo 'class="active" ';
		  	}
		  	echo '><a href="'.$GLOBALS['urldata'].'chartcombined.php?id=5">Batterij</a></li>
            <li ';
		  	if(strpos($_SERVER['REQUEST_URI'], 'chartcombined.php?id=6') !== false ) {
		  		echo 'class="active" ';
		  	}
		  	echo '><a href="'.$GLOBALS['urldata'].'chartcombined.php?id=6">Radio actieve straling</a></li>
            <li ';
		  	if(strpos($_SERVER['REQUEST_URI'], 'chartcombined.php?id=7') !== false ) {
		  		echo 'class="active" ';
		  	}
		  	echo '><a href="'.$GLOBALS['urldata'].'chartcombined.php?id=7">Fijnstof</a></li>
            <li ';
		  	if(strpos($_SERVER['REQUEST_URI'], 'chartcombined.php?id=8') !== false ) {
		  		echo 'class="active" ';
		  	}
		  	echo '><a href="'.$GLOBALS['urldata'].'chartcombined.php?id=8">Fijnstof - SDS011 - PM2.5</a></li>
            <li ';
		  	if(strpos($_SERVER['REQUEST_URI'], 'chartcombined.php?id=9') !== false ) {
		  		echo 'class="active" ';
		  	}
		  	echo '><a href="'.$GLOBALS['urldata'].'chartcombined.php?id=9">Fijnstof - SDS011 - PM10</a></li>
						<li ';
				if(strpos($_SERVER['REQUEST_URI'], 'chartcombined.php?id=10') !== false ) {
					echo 'class="active" ';
				}
				echo '><a href="'.$GLOBALS['urldata'].'chartcombined.php?id=10">Fijnstof - PM2.5 & PM10</a></li>'."\n";
				echo '<li ';
				if(strpos($_SERVER['REQUEST_URI'], 'chartcombined.php?id=11') !== false ) {
					echo 'class="active" ';
				}
				echo '><a href="'.$GLOBALS['urldata'].'chartcombined.php?id=11">Fijnstof - PM2.5 2018</a></li>'."\n";
				echo '<li ';
				if(strpos($_SERVER['REQUEST_URI'], 'chartcombined.php?id=12') !== false ) {
					echo 'class="active" ';
				}
				echo '><a href="'.$GLOBALS['urldata'].'chartcombined.php?id=12">Fijnstof - PM10 2018</a></li>'."\n";
							echo '
                    </ul>'."\n";
		  		echo '</li></ul>'."\n";
            echo '</li>'."\n";
		  	echo '<li><a href="'.$GLOBALS['url'].'index.php/links/">Links</a></li>'."\n";
		  echo '</ul>'."\n";
		?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo $GLOBALS['url']; ?>#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	