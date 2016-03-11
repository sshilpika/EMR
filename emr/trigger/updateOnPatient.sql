CREATE TRIGGER LogPatientHistory
BEFORE UPDATE
ON
	Patient
FOR EACH ROW
BEGIN
	INSERT INTO 
		PatientHistory(SSN, D_SSN, Current_Status)
	VALUES(
		OLD.SSN,
		OLD.D_SSN,
		OLD.Current_Status		
	);	
END