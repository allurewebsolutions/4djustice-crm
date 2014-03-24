<tbody class="scrollContent">

<?php 
/* check whethere there were matching records in the table
by counting the number of results returned */
if(mysql_num_rows($results) >= 1)
{
	$output = "";
		while($row = mysql_fetch_array($results))
	{
		$output .= "<tr valign='top' class='searchable' data-index='" . $row['attorneyfollowup'].$row['leadfollowup'].$row['id'].str_replace(' ', '', strtolower($row['leadstatus'])).str_replace(' ', '', strtolower($row['paymentstatus'])).str_replace(' ', '', strtolower($row['assignedto'])).str_replace(' ', '', strtolower($row['state'])) . "'>";
		$output .= "<td>";
		$output .= "<a href='../forms/lead-edit.php?id=" . $row['id'] . "' target='_blank'><img src='../images/edit-icon.png' width='20' /></a>";
		//$output .= "<br /><br />";
		//$output .= "<a href='../lead-pdf/generate-lead-pdf.php?id=" . $row['id'] . "'><img src='../images/generate-pdf-icon.png' width='20' /></a>";
		$output .= "&nbsp;";
		$output .= "<a href='../lead-pdf/save-lead-pdf.php?id=" . $row['id'] . "'><img src='../images/pdf-download-icon.png' width='20' /></a>";
		$output .= "</td>";
		$output .= "<td>";
		$output .= "<strong>" . $id = $row['id'] . "</strong>";
		$output .= "</td>";
		$output .= "<td>" . $added = $row['added'];
		$output .= "</td>";
		$output .= "<td>" . $leadstatus = $row['leadstatus'];
		$output .= "</td><td>	";
		$output .= $paymentstatus = $row['paymentstatus'];
		$output .= "</td><td>";
		$output .= $ppl = $row['ppl'];
		$output .= "</td>";
		$output .= "<td>";
		$output .= "<strong>Lead:</strong><br />" . $leadfollowup = $row['leadfollowup'];
		$output .= "</td><td>";
		$output .= "<strong>Attorney:</strong><br />" . $attorneyfollowup = $row['attorneyfollowup'];
		$output .= "</td>";
        $output .= "<td>" . $firstname = $row['firstname'] . " " . $lastname = $row['lastname'];
		$output .= "</td>";
        $output .= "<td>" . $contactname = $row['contactname'];
		$output .="</td>";
		$output .= "<td>";
		$output .= "<strong>Primary:</strong><br />" . $row['attorney'] . "<br />";
		$output .= "<a href='../lead-pdf/email-lead-pdf.php?id=" . $row['id'] . "&attorney=attorney1' target=\"_blank\"><img src='../images/email-icon.png' width='20' /><a>";
		if ($row['attorney2'] != "") {
		$output .= "<br /><br /><strong>Attorney 2:</strong><br />" . $row['attorney2'] . "<br />";
		$output .= "<a href='../lead-pdf/email-lead-pdf.php?id=" . $row['id'] . "&attorney=attorney2' target=\"_blank\"><img src='../images/email-icon.png' width='20' /><a><br /><br />";
		}
		if ($row['attorney3'] != "") {
		$output .= "<strong>Attorney 3:</strong><br />" . $row['attorney3'];
		$output .= "<a href='../lead-pdf/email-lead-pdf.php?id=" . $row['id'] . "&attorney=attorney3' target=\"_blank\"><img src='../images/email-icon.png' width='20' /><a>";
		}
		$output .= "</td>";
		$output .= "<td>" . $row['state'] . "</td>";
        $output .= "<td>" . $loggedby = $row['loggedby'];
		$output .= "</td><td>";
		$output .= $assignedto = $row['assignedto'];
		$output .= "</td>";
		$output .= "</tr>";		
	}
	echo $output;
}
else
	echo "There was no matching record for the search: " . $searchTerm . "<br />";
	
?>
</tbody>
</table>
</div>
