<html>
<head>
<style type="text/css">
 body {
  font-size:10pt;
  font-weight:normal;
  padding: 5px 3px 5px 3px;
 }
 
 a.navitem, a.navitem:visited {
  color:#0000ff;
  font-family:sans-serif;
  font-size:8pt;
  font-weight:bold;
 }
.inputtext {
 font-size:9pt;
 font-weight:normal;
 border-style:solid;
 border-width:1px;
 padding-left:2px;
 padding-right:2px;
 border-color: #000000;
 background-color:transparent;
}

#navigation ul {
 background-color:transparent;
}
#navigation-slide ul {
 background-color:transparent;
}
#navigation-slide a{
 width: 92%;
}
.nav-menu-img{
  width:25px;
  height:25px;
  border:none;
  margin-right:5px;
  vertical-align:middle;
}
</style>
</head>

<body class="body_nav">

<form method='post' name='find_patient' target='RTop'
 action='/openemr/interface/main/finder/patient_select.php'>



  <ul id="navigation-slide">


  <li><a href='' id='cal0' onclick="">Calendar</a></li>  
  <li><a href='' id='msg0' onclick="">Messages </a></li> 
  <li><a href='' id='pact0' onclick="">Portal Activity</a></li>  
  
  <li class="open"><a class="expanded" id="patimg" >Patient/Client</a>
    <ul>
      <li><a href='' id='fin0' onclick="">Patients</a></li>      
      <li><a href='' id='new0' onclick="">New/Search</a></li>      
      <li><a href='' id='dem1' onclick="">Summary</a></li>      
      <li class="open"><a class="expanded_lv2">Visits</a>
        <ul>
          <li><a href='' id='nen1' onclick="">Create Visit</a></li>          
          <li><a href='' id='enc2' onclick="">Current</a></li>          
          <li><a href='' id='ens1' onclick="">Visit History</a></li>        
        </ul>
      </li>

      <li><a class="collapsed_lv2">Records</a>
        <ul>
          <li><a href='' id='prq1' onclick="">Patient Record Request</a></li>        
        </ul>
      </li>

      <li><a class="collapsed_lv2">Visit Forms</a>
        <ul>
          <li><a href='' id='cod2' onclick="">Misc Billing Options HCFA</a></li>
          <li><a href='' id='cod2' onclick="">Procedure Order</a></li>
          <li><a href='' id='cod2' onclick="">Review Of Systems</a></li>
          <li><a href='' id='cod2' onclick="">Review of Systems Checks</a></li>
          <li><a href='' id='cod2' onclick="">SOAP</a></li>
          <li><a href='' id='cod2' onclick="">Speech Dictation</a></li>
          <li><a href='' id='cod2' onclick="">Vitals</a></li>        
        </ul>
      </li>
      <li class="collapsed" ><a class="collapsed_lv2">Import</a>
        <ul>
          <li><a href='' id='ccr0' onclick="">Upload</a></li>          
          <li><a href='' id='apr0' onclick="">Pending Approval</a></li>        
        </ul>
      </li>

    </ul>
  </li>
  <li><a class="collapsed" id="feeimg" >Fees</a>
    <ul>
      <li><a href='' id='cod2' onclick="">Fee Sheet</a></li>            
      <li><a href='' id='pay1' onclick="">Payment</a></li>      
      <li><a href='' id='bil1' onclick="">Checkout</a></li> 
      <li><a href='' id='bil0' onclick="">Billing</a></li>	  
      <li><a href='' id='npa0' onclick="">Batch Payments</a></li>      
      <li><a href='' id='edi0' onclick="">EDI History</a></li>    
    </ul>
  </li>
  <li><a class="collapsed" id="proimg" >Procedures</a>
    <ul>
      <li><a href='' id='orl0' onclick="">Providers</a></li>      
      <li><a href='' id='ort0' onclick="">Configuration</a></li>      
      <li><a href='' id='orc0' onclick="">Load Compendium</a></li>      
      <li><a href='' id='orp1' onclick="">Pending Review</a></li>      
      <li><a href='' id='orr1' onclick="">Patient Results</a></li>      
      <li><a href='' id='orb0' onclick="">Batch Results</a></li>      
      <li><a href='' id='ore0' onclick="">Electronic Reports</a></li>    
    </ul>
  </li>
  <li><a class="collapsed" id="admimg" >Administration</a>
    <ul>
      <li><a href='' id='adm0' onclick="">Globals</a></li>      
      <li><a href='' id='adm0' onclick="">Facilities</a></li>      
      <li><a href='' id='adm0' onclick="">Users</a></li>      
      <li><a href='' id='adb0' onclick="">Addr Book</a></li>      
      <li><a href='' id='adm0' onclick="">Practice</a></li>      
      <li><a href='' id='sup0' onclick="">Codes</a></li>      
      <li><a href='' id='adm0' onclick="">Layouts</a></li>      
      <li><a href='' id='adm0' onclick="">Lists</a></li>      
      <li><a href='' id='adm0' onclick="">ACL</a></li>      
      <li><a href='' id='adm0' onclick="">Files</a></li>      
      <li><a href='' id='adm0' onclick="">Backup</a></li>      
      <li><a href='' id='adm0' onclick="">Rules</a></li>      
      <li><a href='' id='adm0' onclick="">Alerts</a></li>      
      <li><a href='' id='adm0' onclick="">Patient Reminders</a></li>                            
      <li><a class="collapsed_lv2">Other</a>
        <ul>
          <li><a href='' id='adm0' onclick="">Language</a></li>          
          <li><a href='' id='adm0' onclick="">Forms</a></li>          
          <li><a href='' id='adm0' onclick="">Calendar</a></li>          
          <li><a href='' id='adm0' onclick="">Logs</a></li>                    
          <li><a href='' id='adm0' onclick="">Database</a></li>         
          <li><a href='' id='adm0' onclick="">Certificates</a></li>          
          <li><a href='' id='adm0' onclick="">External Data Loads</a></li>          
          <li><a href='' id='adm0' onclick="">Merge Patients</a></li>        
        </ul>
      </li>
    </ul>
  </li>
  <li><a class="collapsed" id="repimg" >Reports</a>
    <ul>
    <li><a class="collapsed_lv2">Clients</a>
      <ul>
  	  <li><a href='' id='rep0' onclick="">List</a></li>         
      <li><a href='' id='rep0' onclick="">Rx</a></li>          
      <li><a href='' id='rep0' onclick="">Clinical</a></li>	  
      <li><a href='' id='rep0' onclick="">Referrals</a></li>	  
      <li><a href='' id='rep0' onclick="">Immunization Registry</a></li>       
      </ul>
    </li>
    <li><a class="collapsed_lv2">Clinic</a>
        <ul>
          <li><a href='' id='rep0' onclick="">Report Results</a></li>          
          <li><a href='' id='rep0' onclick="">Standard Measures</a></li>          
          <li><a href='' id='rep0' onclick="">Quality Measures (CQM)</a></li>          
          <li><a href='' id='rep0' onclick="">Automated Measures (AMC)</a></li>          
          <li><a href='' id='rep0' onclick="">AMC Tracking</a></li>        
        </ul>
    </li>
    <li><a class="collapsed_lv2">Visits</a>
      <ul>
        <li><a href='' id='rep0' onclick="">Appointments</a></li>          
        <li><a href='' id='rep0' onclick="">Encounters</a></li>          
        <li><a href='' id='rep0' onclick="">Appt-Enc</a></li>          
        <li><a href='' id='rep0' onclick="">Superbill</a></li>	  
        <li><a href='' id='rep0' onclick="">Eligibility</a></li>	  
        <li><a href='' id='rep0' onclick="">Eligibility Response</a></li>	  
        <li><a href='' id='rep0' onclick="">Chart Activity</a></li>          
        <li><a href='' id='rep0' onclick="">Charts Out</a></li>         
        <li><a href='' id='rep0' onclick="">Services</a></li>          
        <li><a href='' id='rep0' onclick="">Syndromic Surveillance</a></li>        
      </ul>
    </li>
    <li><a class="collapsed_lv2">Financial</a>
        <ul>
          <li><a href='' id='rep0' onclick="">Sales</a></li>          
          <li><a href='' id='rep0' onclick="">Cash Rec</a></li>          
          <li><a href='' id='rep0' onclick="">Front Rec</a></li>          
          <li><a href='' id='rep0' onclick="">Pmt Method</a></li>          
          <li><a href='' id='rep0' onclick="">Collections</a></li>          
          <li><a href='' id='rep0' onclick="">Financial Summary by Service Code</a></li>        
        </ul>
      </li>
      <li><a class="collapsed_lv2">Procedures</a>
        <ul>
          <li><a href='' onclick="">Pending Res</a></li>                    
          <li><a href='' onclick="">Statistics</a></li>        
        </ul>
      </li>
      <li><a class="collapsed_lv2">Insurance</a>
        <ul>
          <li><a href='' id='rep0' onclick="">Distribution</a></li>          
          <li><a href='' id='rep0' onclick="">Indigents</a></li>          
          <li><a href='' id='rep0' onclick="">Unique SP</a></li>        
        </ul>
      </li>
      <li><a class="collapsed_lv2">Blank Forms</a>
        <ul>
          <li><a href='' onclick="">Demographics</a></li>          
          <li><a href='' onclick="">Superbill/Fee Sheet</a></li>          
          <li><a href='' onclick="">Referral</a></li>        
        </ul>
      </li>
          <li><a class="collapsed_lv2">Services</a>
        <ul>
          <li><a href='' id='rep0' onclick="">Background Services</a></li>          
          <li><a href='' id='rep0' onclick="">Direct Message Log</a></li>        
        </ul>
      </li>  
    </ul>
  </li>
  <li><a class="collapsed" id="misimg" >Miscellaneous</a>
    <ul>
      <li><a href='' id='ped0' onclick="">Patient Education</a></li> 
      <li><a href='' id='aun0' onclick="">Authorizations</a></li>            
      <li><a href='' id='adb0' onclick="">Addr Book</a></li>      
      <li><a href='' id='ort0' onclick="">Order Catalog</a></li>      
      <li><a href='' id='cht0' onclick="">Chart Tracker</a></li>      
      <li><a href='' id='ono0' onclick="">Ofc Notes</a></li>      
      <li><a href='' id='adm0' onclick="">BatchCom</a></li>      
      <li><a href='' id='pwd0' onclick="">Password</a></li>      
      <li><a href='' id='prf0' onclick="">Preferences</a></li>      
      <li><a href='' id='adm0' onclick="">New Documents</a></li>    
    </ul>
  </li>
</ul>


<br />

</form>

</body>
</html>