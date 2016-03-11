<html>
<head>
</head>
<body class="body_title">

<table cellspacing="0" cellpadding="0" width="100%" height="100%">
<tr>
<td align="left">
	<table cellspacing="0" cellpadding="1" style="margin:0px 0px 0px 3px;">

<tr><td style="vertical-align:text-bottom;">
		<a href='' class="css_button_small" style="margin:0px;vertical-align:top;" id='new0' onClick="">
		NEW PATIENT</a>
    </td>
    <td style="vertical-align:text-bottom;">
            <a href='' class="css_button_small" style="margin:0px;vertical-align:top;display:none;" id='clear_active' onClick="">
            CLEAR ACTIVE PATIENT</a>
    </td>
</tr>

	<tr><td valign="baseline"><B>
		<a class="text" style='vertical-align:text-bottom;' href="main_title.php" id='showMenuLink' onclick=''>Hide Menu</a></B>
	</td></tr></table>
</td>
<td style="margin:3px 0px 3px 0px;vertical-align:middle;">
        <div style='margin-left:10px; float:left; display:none' id="current_patient_block">
            <span class='text'>Patient:&nbsp;<span class='title_bar_top' id="current_patient"><b>None</b>
        </div>
</td>
<td style="margin:3px 0px 3px 0px;vertical-align:middle;" align="left">
	<table cellspacing="0" cellpadding="1" ><tr><td>
		<div style='margin-left:5px; float:left; display:none' id="past_encounter_block">
			<span class='title_bar_top' id="past_encounter"><b>None</b>
		</div></td></tr>
	<tr><td valign="baseline" align="center">	
        <div style='display:none' class='text' id="current_encounter_block" >
            <span class='text'>Selected Encounter:&nbsp;<span class='title_bar_top' id="current_encounter"><b>None</b>
        </div></td></tr></table>
</td>

<td align="right">
	<table cellspacing="0" cellpadding="1" style="margin:0px 3px 0px 0px;"><tr>
		<td align="right" class="text" style="vertical-align:text-bottom;"><a href='main_title.php' onclick="" >Home</a>
		&nbsp;|&nbsp;
		<a href="" target="_blank" id="help_link" >
			Manual</a>&nbsp;</td>
		<td align="right" style="vertical-align:top;"><a href="../logout.php" target="_top" class="css_button_small" style='float:right;' id="logout_link" onclick="top.restoreSession()" >
			Logout</a></td>
	</tr></table>
</td>
</tr>
</table>



</body>
</html>