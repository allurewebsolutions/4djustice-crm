<?php
//**************************************
//     Page load dropdown results     //
//**************************************
function getpracticeareas()
{
	$result = mysql_query("SELECT DISTINCT practicearea FROM practiceareas ORDER BY practicearea ASC") 
	or die(mysql_error());

	  while($tier = mysql_fetch_array( $result )) 
  
		{
		   echo '<option value="'.$tier['practicearea'].'">'.$tier['practicearea'].'</option>';
		}

}

//**************************************
//     First selection results     //
//**************************************
if($_GET['func'] == "practicearea" && isset($_GET['func'])) { 
   practicearea($_GET['drop_var']); 
}

function practicearea($drop_var)
{   include_once('db.php');
	$result = mysql_query("SELECT * FROM practiceareas WHERE practicearea='$drop_var' ORDER BY subpracticearea ASC") 
	or die(mysql_error());
	
	echo '<select name="subpracticearea" id="subpracticearea">
	      <option value=" " disabled="disabled" selected="selected">Sub Practice Area</option>';

		   while($drop_2 = mysql_fetch_array( $result )) 
			{
			  echo '<option value="'.$drop_2['subpracticearea'].'">'.$drop_2['subpracticearea'].'</option>';
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
			echo '<option value="'.$tier['state'].'" '.(($tier['state']==$state)?'selected="selected"':"").'>'.$tier['state'].'</option>';
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
	$result = mysql_query("SELECT DISTINCT city FROM cities JOIN states ON states.state_code=cities.state_code WHERE states.state='$drop_var' ORDER BY city ASC") 
	or die(mysql_error());
	
	echo '<select name="city" id="city" required>';

		   while($drop_2 = mysql_fetch_array( $result )) 
			{
				echo '<option value="'.$drop_2['city'].'" '.(($drop_2['city']==$city)?'selected="selected"':"").'>'.$drop_2['city'].'</option>';
			}
	
	echo '</select> ';
}
?>