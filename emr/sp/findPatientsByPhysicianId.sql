CREATE PROCEDURE findPatientsByPhysicianId (IN physicianId VARCHAR(9))
BEGIN
	SELECT 
		person.SSN, 
		person.First_Name, 
		person.Last_Name, 
		person.Birth_Date, 
		person.Gender,
		patient.Current_Status 
	FROM 
		Person person, Patient patient
	WHERE 
		patient.D_SSN = physicianId
	AND
		patient.SSN = person.SSN; 	
END 