<?php
//**************************************
//     Page load dropdown results     //
//**************************************
function getstates()
{
	$result = mysql_query("SELECT DISTINCT state FROM states ORDER BY state ASC") 
	or die(mysql_error());

	  while($tier = mysql_fetch_array( $result )) 
  
		{
		   echo '<option value="'.$tier['state'].'">'.$tier['state'].'</option>';
		}

}

//**************************************
//     First selection results     //
//**************************************
if($_GET['func'] == "state" && isset($_GET['func'])) { 
   state($_GET['drop_var']); 
}

function state($drop_var)
{   include_once('db.php');
	$result = mysql_query("SELECT * FROM states WHERE state='$drop_var' ORDER BY substate ASC") 
	or die(mysql_error());
	
	echo '<select name="substate" id="substate">
	      <option value=" " disabled="disabled" selected="selected">Sub Practice Area</option>';

		   while($drop_2 = mysql_fetch_array( $result )) 
			{
			  echo '<option value="'.$drop_2['substate'].'">'.$drop_2['substate'].'</option>';
			}
	
	echo '</select> ';
}
?>

<?php
//**************************************
//     Page load dropdown results     //
//**************************************
function getstates()
{
	$result = mysql_query("SELECT state FROM states ORDER BY state ASC") 
	or die(mysql_error());

	  while($tier = mysql_fetch_array( $result )) 
  
		{
		   echo '<option value="'.$tier['state'].'">'.$tier['state'].'</option>';
		}

}

//**************************************
//     First selection results     //
//**************************************
if($_GET['func'] == "state" && isset($_GET['func'])) { 
   state($_GET['drop_var']); 
}

function state($drop_var)
{   include_once('db.php');
	$result = mysql_query("SELECT city FROM cities JOIN states ON states.state_code=cities.state_code WHERE states.state='$drop_var' ORDER BY city ASC") 
	or die(mysql_error());
	
	echo '<select name="city" id="city">
	      <option value=" " disabled="disabled" selected="selected">City</option>';

		   while($drop_2 = mysql_fetch_array( $result )) 
			{
			  echo '<option value="'.$drop_2['city'].'">'.$drop_2['city'].'</option>';
			}
	
	echo '</select> ';
}
?>