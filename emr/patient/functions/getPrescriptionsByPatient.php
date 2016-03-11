<?php

  function getPrescriptionsByPatient($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "Select person.First_Name, person.Last_Name, ph.P_Office_Address,ph.P_Office_City,ph.P_Office_State,v.Date_Time, bill.Bill_Num,bill.Amount,bill.Bill_Date,bill.Due_Date, pay.payment_Date, pay.payment_Status, d.Diagnosis_Category,pres.prescription_ID,m.Mname
		From person person
		JOIN patient patient on(person.SSN = patient.SSN)		
		JOIN has_visits hv on(hv.P_SSN = patient.SSN)
		JOIN Visit v on(v.visit_id = hv.visit_ID)
		JOIN Result res on(res.Visit_ID = v.Visit_ID)
		JOIN Diagnosis d on(d.Diagnosis_ID = res.Diagnosis_ID)
		JOIN Prescription pres on(v.Visit_ID = pres.Visit_ID)
		JOIN Prescribed_meds pm on(pm.prescription_ID = pres.prescription_ID)
		JOIN Medicine m on(pm.Minventory_ID = m.Minventory_ID)
		jOIN Bill bill on(bill.Bill_Num = v.Bill_Num)
		JOIN payment pay on(pay.payment_ID = bill.payment_ID)
		JOIN Pharmacist ph on(ph.SSN = pres.PH_SSN)

Where patient.SSN= '$patientId'
ORDER BY
                v.Date_Time DESC";   
              
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching patients Pre-existing Conditions: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }



  
?>