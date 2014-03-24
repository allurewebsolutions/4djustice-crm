    	<?php include("db.php"); ?>
		<?php $name = $_GET['attorney'];?>
        <h1><?php echo $name; ?></h1>
        <ul>
       	<?php 
			$result = mysql_query("SELECT DISTINCT city,state_code FROM cities WHERE attorney1='$name' OR attorney2='$name' OR attorney3='$name' ORDER BY city ASC") 
			or die(mysql_error());
			while($row = mysql_fetch_array($result))
			{
				echo '<li style="display:block;float:left;width:150px;">'.$row['city'] . ", " . $row['state_code'].'</li>';
            }
        ?>
        </ul>