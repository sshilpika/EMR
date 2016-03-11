
	

<!-- START user_display -->



<!-- START POSTCALENDAR OUTPUT [-: HTTP://POSTCALENDAR.TV :-] -->


<html>
<head>
<!-- Get the style sheet for the theme defined in globals.php -->
<link rel="stylesheet" href="/openemr/interface/themes/style_oemr.css" type="text/css">
<!-- this style sheet is used for the ajax_* style calendars -->
<link rel="stylesheet" href="/openemr/interface/themes/ajax_calendar.css" type="text/css">
<!--[if IE]>
<link rel="stylesheet" href="/openemr/interface/themes/ajax_calendar_ie.css" type="text/css"/>
<![endif]-->
<!-- the javascript used for the ajax_* style calendars -->
<script type="text/javascript" src="/openemr/library/dialog.js"></script>
<script type="text/javascript" src="/openemr/library/textformat.js"></script>
<script type="text/javascript" src="/openemr/library/js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="/openemr/library/js/calendarDirectSelect.js"></script>
<script>function event_time_click(elem){EditEvent($(elem).parents("div.event_appointment").get(0))} </script>
</head>
<body style='background-color:#dddddd'>
<script language='JavaScript'>

 var mypcc = '1';

 // This is called from the event editor popup.
 function refreshme() {
  top.restoreSession();
  document.forms[0].submit();
 }

 function newEvt(startampm, starttimeh, starttimem, eventdate, providerid, catid) {
  dlgopen('add_edit_event.php?startampm=' + startampm +
   '&starttimeh=' + starttimeh + '&userid=' + providerid + '&starttimem=' + starttimem +
   '&date=' + eventdate + '&catid=' + catid   ,'_blank', 575, 375);
 }

 function oldEvt(eventdate, eventid, pccattype) {
  dlgopen('add_edit_event.php?date='+eventdate+'&eid=' + eventid+'&prov=' + pccattype, '_blank', 575, 375);
 }

 function goPid(pid) {
  top.restoreSession();
  top.RTop.location = '../../patient_file/summary/demographics.php' + '?set_pid=' + pid;
 }

 function GoToToday(theForm){
  var todays_date = new Date();
  var theMonth = todays_date.getMonth() + 1;
  theMonth = theMonth < 10 ? "0" + theMonth : theMonth;
  theForm.jumpdate.value = todays_date.getFullYear() + "-" + theMonth + "-" + todays_date.getDate();
  top.restoreSession();
  theForm.submit();
 }

</script>
<div id="topToolbarRight">  <!-- this wraps some of the top toolbar items -->
<div id="functions">
<!-- stuff form element here to avoid the margin padding it introduces into the page in some browsers -->
<form name='theform' id='theform' action='index.php?module=PostCalendar&func=view&tplview=default&pc_category=&pc_topic=' method='post' onsubmit='return top.restoreSession()'>
<input type="hidden" name="jumpdate" id="jumpdate" value="">
<input type="hidden" name="viewtype" id="viewtype" value="day">
<a href='#' value='Add' onclick='newEvt(1, 9, 00, 20141128, 0, 0)' class='css_button'/><span>Add</span></a>
<a href='#' value='Search' onclick='top.restoreSession();location="index.php?module=PostCalendar&func=search"' class='css_button'/><span>Search</span></a>
</div>
<div id="dateNAV"">
<a href='#' name='bnsubmit' value='Today' onClick='GoToToday(theform);'  class='css_button'/><span>Today</span></a>
<a href='http://demo.open-emr.org:2107/openemr/interface/main/calendar/index.php?module=PostCalendar&func=view&tplview=default&viewtype=day&Date=20141127&pc_username=&pc_category=&pc_topic=' onclick='top.restoreSession()'>
<img id="prevday" src="/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/leftbtn.gif" border="0" title="Previous Day" alt="Previous Day" style="padding-top:5px"/></a>
<a href='http://demo.open-emr.org:2107/openemr/interface/main/calendar/index.php?module=PostCalendar&func=view&tplview=default&viewtype=day&Date=20141129&pc_username=&pc_category=&pc_topic=' onclick='top.restoreSession()'>
<img id="nextday" src="/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/rightbtn.gif" border="0" title="Next Day" alt="Next Day" /></a>
&nbsp;
Friday, November 28, 2014</div>
<div id="viewPicker">
<a href='#' type='button' id='printview' title='Print View' class='css_button'/><span>Print</span></a>
<a href='#' type='button' value='Refresh' onclick='javascript:refreshme()' class='css_button'/><span>Refresh</span></a>
<a href='#' type='button' id='dayview' title='Day View' class='css_button'/><span>Day</span></a>
<a href='#' type='button' id='weekview' title='Week View' class='css_button'/><span>Week</span></a>
<a href='#' type='button' id='monthview' title='Month View' class='css_button'/><span>Month</span></a>
</div>
</div> <!-- end topToolbarRight -->
<div id="bottom">
<div id="bottomLeft">
<div id="datePicker">
<DIV ID="monthPicker" style="display:none;position: absolute; top: 15px;"><TABLE><TBODY><TR><TD ID="20141128" CLASS="tdDatePicker tdMonthName-small">November 2014</TD></TR><TR><TD ID="20141228" CLASS="tdDatePicker tdMonthName-small">December 2014</TD></TR><TR><TD ID="20150128" CLASS="tdDatePicker tdMonthName-small">January 2015</TD></TR><TR><TD ID="20150228" CLASS="tdDatePicker tdMonthName-small">February 2015</TD></TR><TR><TD ID="20150328" CLASS="tdDatePicker tdMonthName-small">March 2015</TD></TR><TR><TD ID="20150428" CLASS="tdDatePicker tdMonthName-small">April 2015</TD></TR><TR><TD ID="20150528" CLASS="tdDatePicker tdMonthName-small">May 2015</TD></TR><TR><TD ID="20150628" CLASS="tdDatePicker tdMonthName-small">June 2015</TD></TR><TR><TD ID="20150728" CLASS="tdDatePicker tdMonthName-small">July 2015</TD></TR><TR><TD ID="20150828" CLASS="tdDatePicker tdMonthName-small">August 2015</TD></TR><TR><TD ID="20150928" CLASS="tdDatePicker tdMonthName-small">September 2015</TD></TR><TR><TD ID="20151028" CLASS="tdDatePicker tdMonthName-small">October 2015</TD></TR><TR><TD ID="20151128" CLASS="tdDatePicker tdMonthName-small">November 2015</TD></TR></TBODY></TABLE></DIV><table border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="tdDOW-small tdDatePicker" id="20141028" title="October">&lt;</td>
<td colspan="5" class="tdMonthName-small">
November</td>
<td class="tdDOW-small tdDatePicker" id="20141228" title="December">&gt;</td>
<tr>
<td class='tdDOW-small'>M</td><td class='tdDOW-small'>T</td><td class='tdDOW-small'>W</td><td class='tdDOW-small'>T</td><td class='tdDOW-small'>F</td><td class='tdDOW-small'>S</td><td class='tdDOW-small'>S</td></tr>
<tr><td class="tdOtherMonthDay-small tdDatePicker" id="20141027" title="Go to Oct 27, 2014" > 27</td>
<td class="tdOtherMonthDay-small tdDatePicker" id="20141028" title="Go to Oct 28, 2014" > 28</td>
<td class="tdOtherMonthDay-small tdDatePicker" id="20141029" title="Go to Oct 29, 2014" > 29</td>
<td class="tdOtherMonthDay-small tdDatePicker" id="20141030" title="Go to Oct 30, 2014" > 30</td>
<td class="tdOtherMonthDay-small tdDatePicker" id="20141031" title="Go to Oct 31, 2014" > 31</td>
<td class="tdWeekend-small tdDatePicker" id="20141101" title="Go to Nov 01, 2014" > 01</td>
<td class="tdWeekend-small tdDatePicker" id="20141102" title="Go to Nov 02, 2014" > 02</td>
</tr>
<tr><td class="tdMonthDay-small tdDatePicker" id="20141103" title="Go to Nov 03, 2014" > 03</td>
<td class="tdMonthDay-small tdDatePicker" id="20141104" title="Go to Nov 04, 2014" > 04</td>
<td class="tdMonthDay-small tdDatePicker" id="20141105" title="Go to Nov 05, 2014" > 05</td>
<td class="tdMonthDay-small tdDatePicker" id="20141106" title="Go to Nov 06, 2014" > 06</td>
<td class="tdMonthDay-small tdDatePicker" id="20141107" title="Go to Nov 07, 2014" > 07</td>
<td class="tdWeekend-small tdDatePicker" id="20141108" title="Go to Nov 08, 2014" > 08</td>
<td class="tdWeekend-small tdDatePicker" id="20141109" title="Go to Nov 09, 2014" > 09</td>
</tr>
<tr><td class="tdMonthDay-small tdDatePicker" id="20141110" title="Go to Nov 10, 2014" > 10</td>
<td class="tdMonthDay-small tdDatePicker" id="20141111" title="Go to Nov 11, 2014" > 11</td>
<td class="tdMonthDay-small tdDatePicker" id="20141112" title="Go to Nov 12, 2014" > 12</td>
<td class="tdMonthDay-small tdDatePicker" id="20141113" title="Go to Nov 13, 2014" > 13</td>
<td class="tdMonthDay-small tdDatePicker" id="20141114" title="Go to Nov 14, 2014" > 14</td>
<td class="tdWeekend-small tdDatePicker" id="20141115" title="Go to Nov 15, 2014" > 15</td>
<td class="tdWeekend-small tdDatePicker" id="20141116" title="Go to Nov 16, 2014" > 16</td>
</tr>
<tr><td class="tdMonthDay-small tdDatePicker" id="20141117" title="Go to Nov 17, 2014" > 17</td>
<td class="tdMonthDay-small tdDatePicker" id="20141118" title="Go to Nov 18, 2014" > 18</td>
<td class="tdMonthDay-small tdDatePicker" id="20141119" title="Go to Nov 19, 2014" > 19</td>
<td class="tdMonthDay-small tdDatePicker" id="20141120" title="Go to Nov 20, 2014" > 20</td>
<td class="tdMonthDay-small tdDatePicker" id="20141121" title="Go to Nov 21, 2014" > 21</td>
<td class="tdWeekend-small tdDatePicker" id="20141122" title="Go to Nov 22, 2014" > 22</td>
<td class="tdWeekend-small tdDatePicker" id="20141123" title="Go to Nov 23, 2014" > 23</td>
</tr>
<tr><td class="tdMonthDay-small tdDatePicker" id="20141124" title="Go to Nov 24, 2014" > 24</td>
<td class="tdMonthDay-small tdDatePicker" id="20141125" title="Go to Nov 25, 2014" > 25</td>
<td class="tdMonthDay-small tdDatePicker" id="20141126" title="Go to Nov 26, 2014" > 26</td>
<td class="tdMonthDay-small tdDatePicker" id="20141127" title="Go to Nov 27, 2014" > 27</td>
<td class="tdMonthDay-small currentDate tdDatePicker" id="20141128" title="Go to Nov 28, 2014" > 28</td>
<td class="tdWeekend-small tdDatePicker" id="20141129" title="Go to Nov 29, 2014" > 29</td>
<td class="tdWeekend-small tdDatePicker" id="20141130" title="Go to Nov 30, 2014" > 30</td>
</tr>
</table>
</div>
<div id="bigCalHeader">
</div>
<div id="providerPicker">
Providers<div>
</div>   <select multiple size='5' name='pc_username[]' id='pc_username' class='view2'>
<option value='__PC_ALL__'>All Users</option>
<option value='physician' selected>Lee, Donna</option>
<option value='admin' selected>Smith, Billy</option>
<option value='clinician' selected>Stone, Fred</option>
</select>
</div>
<div id="facilityColor">
<table>
<tr><td><div class='view1' style=background-color:#99FFFF;font-weight:bold>Great Clinic</div></td></tr> </table>
</div>
</form>
</div> <!-- end bottomLeft -->
<div id="bigCal">
<table border='0' cellpadding='1' cellspacing='0' width='100%'>
<tr><td id='times'><div><table>
<td class='timeslot'>&nbsp;</td><tr><td class='timeslot'><a href='javascript:newEvt(1,8,00,20141128,6,0)' title='New Appointment' alt='New Appointment'>8:00</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,8,15,20141128,6,0)' title='New Appointment' alt='New Appointment'>8:15</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,8,30,20141128,6,0)' title='New Appointment' alt='New Appointment'>8:30</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,8,45,20141128,6,0)' title='New Appointment' alt='New Appointment'>8:45</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,9,00,20141128,6,0)' title='New Appointment' alt='New Appointment'>9:00</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,9,15,20141128,6,0)' title='New Appointment' alt='New Appointment'>9:15</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,9,30,20141128,6,0)' title='New Appointment' alt='New Appointment'>9:30</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,9,45,20141128,6,0)' title='New Appointment' alt='New Appointment'>9:45</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,10,00,20141128,6,0)' title='New Appointment' alt='New Appointment'>10:00</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,10,15,20141128,6,0)' title='New Appointment' alt='New Appointment'>10:15</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,10,30,20141128,6,0)' title='New Appointment' alt='New Appointment'>10:30</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,10,45,20141128,6,0)' title='New Appointment' alt='New Appointment'>10:45</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,11,00,20141128,6,0)' title='New Appointment' alt='New Appointment'>11:00</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,11,15,20141128,6,0)' title='New Appointment' alt='New Appointment'>11:15</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,11,30,20141128,6,0)' title='New Appointment' alt='New Appointment'>11:30</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(1,11,45,20141128,6,0)' title='New Appointment' alt='New Appointment'>11:45</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,12,00,20141128,6,0)' title='New Appointment' alt='New Appointment'>12:00</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,12,15,20141128,6,0)' title='New Appointment' alt='New Appointment'>12:15</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,12,30,20141128,6,0)' title='New Appointment' alt='New Appointment'>12:30</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,12,45,20141128,6,0)' title='New Appointment' alt='New Appointment'>12:45</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,13,00,20141128,6,0)' title='New Appointment' alt='New Appointment'>1:00</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,13,15,20141128,6,0)' title='New Appointment' alt='New Appointment'>1:15</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,13,30,20141128,6,0)' title='New Appointment' alt='New Appointment'>1:30</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,13,45,20141128,6,0)' title='New Appointment' alt='New Appointment'>1:45</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,14,00,20141128,6,0)' title='New Appointment' alt='New Appointment'>2:00</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,14,15,20141128,6,0)' title='New Appointment' alt='New Appointment'>2:15</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,14,30,20141128,6,0)' title='New Appointment' alt='New Appointment'>2:30</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,14,45,20141128,6,0)' title='New Appointment' alt='New Appointment'>2:45</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,15,00,20141128,6,0)' title='New Appointment' alt='New Appointment'>3:00</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,15,15,20141128,6,0)' title='New Appointment' alt='New Appointment'>3:15</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,15,30,20141128,6,0)' title='New Appointment' alt='New Appointment'>3:30</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,15,45,20141128,6,0)' title='New Appointment' alt='New Appointment'>3:45</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,16,00,20141128,6,0)' title='New Appointment' alt='New Appointment'>4:00</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,16,15,20141128,6,0)' title='New Appointment' alt='New Appointment'>4:15</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,16,30,20141128,6,0)' title='New Appointment' alt='New Appointment'>4:30</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,16,45,20141128,6,0)' title='New Appointment' alt='New Appointment'>4:45</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,17,00,20141128,6,0)' title='New Appointment' alt='New Appointment'>5:00</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,17,15,20141128,6,0)' title='New Appointment' alt='New Appointment'>5:15</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,17,30,20141128,6,0)' title='New Appointment' alt='New Appointment'>5:30</a></td></tr>
<tr><td class='timeslot'><a href='javascript:newEvt(2,17,45,20141128,6,0)' title='New Appointment' alt='New Appointment'>5:45</a></td></tr>
</table></div></td><td class='schedule' title='Donna Lee' date='20141128' provider='6'><div class='providerheader'>Donna Lee</div><div class='calendar_day'><div class='event_in event in_start' style='top:140px; height:20px; ; ; border: none' title='Donna Lee
Great Clinic
[IN]
(double click to edit)' id='20141128-11-true'>10:00 IN<img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/repeating8.png' border='0' style='margin:0px 2px 0px 2px;' title='Repeating event' alt='Repeating event'></div>
<div class='event_in event' style='top:160px; height:560px; background-color:#99CCFF; ; ' title='Donna Lee
Great Clinic
[IN]
(double click to edit)' id='20141128-11-true'></div>
<div class='event_appointment event' style='top:240px; height:20px; background-color:#FFFFCC; width: 100%; left: 0%' title='Donna Lee
Great Clinic
[Office Visit ]Susan Underwood
(double click to edit)' id='20141128-14-'><span class='appointment'><a class='event_time' onclick='event_time_click(this)' title='Click to edit'>11:00</a><img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/repeating8.png' border='0' style='margin:0px 2px 0px 2px;' title='Repeating event' alt='Repeating event'>&nbsp;-<a href='javascript:goPid(2)' title='Susan Underwood 
Age: 47
DOB: 1967-02-08
(Click to view)'><img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/user-green.gif' border='0' title='Susan Underwood 
Age: 47
DOB: 1967-02-08
(Click to view)' alt='View Patient' />Underwood,Susan</a></span></div>
<div class='event_reserved event' style='top:440px; height:80px; background-color:#FFFF33; width: 100%; left: 0%' title='Donna Lee
Great Clinic
[LUNCH]
(double click to edit)' id='20141128-12-true'>LUNCH<img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/repeating8.png' border='0' style='margin:0px 2px 0px 2px;' title='Repeating event' alt='Repeating event'></div>
<div class='event_out event' style='top:720px; height:20px; width: 100%; left: 0%' title='Donna Lee
Great Clinic
[OUT]
(double click to edit)' id='20141128-13-true'>OUT<img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/repeating8.png' border='0' style='margin:0px 2px 0px 2px;' title='Repeating event' alt='Repeating event'></div>
</div></td>
<td class='schedule' title='Billy Smith' date='20141128' provider='1'><div class='providerheader'>Billy Smith</div><div class='calendar_day'><div class='event_in event in_start' style='top:60px; height:20px; ; ; border: none' title='Billy Smith
Great Clinic
[IN]
(double click to edit)' id='20141128-7-true'>09:00 IN<img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/repeating8.png' border='0' style='margin:0px 2px 0px 2px;' title='Repeating event' alt='Repeating event'></div>
<div class='event_in event' style='top:80px; height:640px; background-color:#99CCFF; ; ' title='Billy Smith
Great Clinic
[IN]
(double click to edit)' id='20141128-7-true'></div>
<div class='event_reserved event' style='top:360px; height:80px; background-color:#FFFF33; width: 100%; left: 0%' title='Billy Smith
Great Clinic
[LUNCH]
(double click to edit)' id='20141128-8-true'>LUNCH<img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/repeating8.png' border='0' style='margin:0px 2px 0px 2px;' title='Repeating event' alt='Repeating event'></div>
<div class='event_appointment event' style='top:520px; height:20px; background-color:#FFFFCC; width: 100%; left: 0%' title='Billy Smith
Great Clinic
[Office Visit ]Phil Belford
(double click to edit)' id='20141128-10-'><span class='appointment'><a class='event_time' onclick='event_time_click(this)' title='Click to edit'>2:30</a><img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/repeating8.png' border='0' style='margin:0px 2px 0px 2px;' title='Repeating event' alt='Repeating event'>&nbsp;-<a href='javascript:goPid(1)' title='Phil Belford 
Age: 42
DOB: 1972-02-09
(Click to view)'><img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/user-green.gif' border='0' title='Phil Belford 
Age: 42
DOB: 1972-02-09
(Click to view)' alt='View Patient' />Belford,Phil</a></span></div>
<div class='event_out event' style='top:720px; height:20px; width: 100%; left: 0%' title='Billy Smith
Great Clinic
[OUT]
(double click to edit)' id='20141128-9-true'>OUT<img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/repeating8.png' border='0' style='margin:0px 2px 0px 2px;' title='Repeating event' alt='Repeating event'></div>
</div></td>
<td class='schedule' title='Fred Stone' date='20141128' provider='5'><div class='providerheader'>Fred Stone</div><div class='calendar_day'><div class='event_in event in_start' style='top:20px; height:20px; ; ; border: none' title='Fred Stone
Great Clinic
[IN]
(double click to edit)' id='20141128-15-true'>08:30 IN<img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/repeating8.png' border='0' style='margin:0px 2px 0px 2px;' title='Repeating event' alt='Repeating event'></div>
<div class='event_in event' style='top:40px; height:360px; background-color:#99CCFF; ; ' title='Fred Stone
Great Clinic
[IN]
(double click to edit)' id='20141128-15-true'></div>
<div class='event_appointment event' style='top:120px; height:20px; background-color:#FFFFCC; width: 100%; left: 0%' title='Fred Stone
Great Clinic
[Office Visit com dor no ...]Cezar Aro
(double click to edit)' id='20141128-18-'><span class='appointment'><a class='event_time' onclick='event_time_click(this)' title='Click to edit'>09:30</a>&nbsp;-<a href='javascript:goPid(4)' title='Cezar Aro 
Age: 39
DOB: 1975-11-28com dor no ...
(Click to view)'><img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/user-green.gif' border='0' title='Cezar Aro 
Age: 39
DOB: 1975-11-28com dor no ...
(Click to view)' alt='View Patient' />Aro,Cezar</a></span></div>
<div class='event_appointment event' style='top:280px; height:20px; background-color:#FFFFCC; width: 100%; left: 0%' title='Fred Stone
Great Clinic
[Office Visit ]Wanda Moore
(double click to edit)' id='20141128-17-'><span class='appointment'><a class='event_time' onclick='event_time_click(this)' title='Click to edit'>11:30</a><img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/repeating8.png' border='0' style='margin:0px 2px 0px 2px;' title='Repeating event' alt='Repeating event'>&nbsp;-<a href='javascript:goPid(3)' title='Wanda Moore 
Age: 7
DOB: 2007-02-18
(Click to view)'><img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/user-green.gif' border='0' title='Wanda Moore 
Age: 7
DOB: 2007-02-18
(Click to view)' alt='View Patient' />Moore,Wanda</a></span></div>
<div class='event_out event' style='top:400px; height:20px; width: 100%; left: 0%' title='Fred Stone
Great Clinic
[OUT]
(double click to edit)' id='20141128-16-true'>OUT<img src='/openemr/interface/main/calendar/modules/PostCalendar/pntemplates/default/images/repeating8.png' border='0' style='margin:0px 2px 0px 2px;' title='Repeating event' alt='Repeating event'></div>
</div></td>
</tr>
</table>
<P></div>  <!-- end bigCal DIV -->
</div>  <!-- end bottom DIV -->
</body>
<script language='JavaScript'>
    var tsHeight='20px';
    var tsHeightNum=20;

    $(document).ready(function(){
        setupDirectTime();
        $("#pc_username").change(function() { ChangeProviders(this); });
        $("#pc_facility").change(function() { ChangeProviders(this); });
        //$("#dayview").click(function() { ChangeView(this); });
        $("#weekview").click(function() { ChangeView(this); });
        $("#monthview").click(function() { ChangeView(this); });
        //$("#yearview").click(function() { ChangeView(this); });
        $(".tdDatePicker").click(function() { ChangeDate(this); });
        $(".tdDatePicker").mouseover(function() { $(this).toggleClass("tdDatePickerHighlight"); });
        $(".tdDatePicker").mouseout(function() { $(this).toggleClass("tdDatePickerHighlight"); });
        $("#printview").click(function() { PrintView(this); });
        $(".event").dblclick(function() { EditEvent(this); });
        $(".event").mouseover(function() { $(this).toggleClass("event_highlight"); });
        $(".event").mouseout(function() { $(this).toggleClass("event_highlight"); });
        $(".tdMonthName-small").click(function() {
            
            dpCal=$("#datePicker>table"); 
            mp = $("#monthPicker"); mp.width(dpCal.width()); mp.toggle();});
    });

    /* edit an existing event */
    var EditEvent = function(eObj) {
        //alert ('editing '+eObj.id);
        // split the object ID into date and event ID
        objID = eObj.id;
        var parts = new Array();
        parts = objID.split("-");
        // call the oldEvt function to bring up the event editor
        oldEvt(parts[0], parts[1], parts[2]);
        return true;
    }

    /* change the current date based upon what the user clicked in 
     * the datepicker DIV
     */
    var ChangeDate = function(eObj) {
        baseURL = "http://demo.open-emr.org:2107/openemr/interface/main/calendar/index.php?module=PostCalendar&func=view&tplview=&viewtype=day&Date=~REPLACEME~&pc_username=&pc_category=&pc_topic=";
        newURL = baseURL.replace(/~REPLACEME~/, eObj.id);
        document.location.href=newURL;
    }

    /* pop up a window to print the current view
     */
    var PrintView = function (eventObject) {
        printURL = "http://demo.open-emr.org:2107/openemr/interface/main/calendar/index.php?module=PostCalendar&func=view&tplview=&viewtype=day&Date=20141128&print=1&pc_username=&pc_category=&pc_topic=";
        window.open(printURL,'printwindow','width=740,height=480,toolbar=no,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,copyhistory=no,resizable=yes');
        return false;
    }

    /* change the provider(s)
     */
    var ChangeProviders = function (eventObject) {
        $('#theform').submit();
    }

    /* change the calendar view
     */
    var ChangeView = function (eventObject) {
        if (eventObject.id == "dayview") {
            $("#viewtype").val('day');
        }
        else if (eventObject.id == "weekview") {
            $("#viewtype").val('week');
        }
        else if (eventObject.id == "monthview") {
            $("#viewtype").val('month');
        }
        else if (eventObject.id == "yearview") {
            $("#viewtype").val('year');
        }
        $('#theform').submit();
    }

</script>
</html>    

<!-- END POSTCALENDAR OUTPUT [-: HTTP://POSTCALENDAR.TV :-] -->



<!-- END user_display -->

