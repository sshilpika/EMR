USE EMR;

DELETE FROM PatientHistory;
DELETE FROM Has_Patients;
DELETE FROM Notes;
DELETE FROM PatientsImmunizations;
DELETE FROM Immunizations;
DELETE FROM Medications;
DELETE FROM PatientsAllergies;
DELETE FROM Allergies;
DELETE FROM PatientsPreConditions;
DELETE FROM PreExistingConditions;
DELETE FROM Prescribed_Meds; 
DELETE FROM Medicine;
DELETE FROM Manufacturer; 
DELETE FROM Prescription; 
DELETE FROM Result; 
DELETE FROM Diagnosis; 
DELETE FROM Has_Visits; 
DELETE FROM Visit; 
DELETE FROM Bill; 
DELETE FROM Payment; 
DELETE FROM Insurance_Policy; 
DELETE FROM Insurance_Company; 
DELETE FROM Pharmacist; 
DELETE FROM Patient; 
DELETE FROM Doctor; 
DELETE FROM Department; 
DELETE FROM Person; 


INSERT INTO Person(SSN, First_Name, Last_Name, Home_Address, Birth_Date, Home_Phone, City, State, ZipCode, Gender) VALUES 
	("99999","John", "Smith","731 Fondren", "1965-07-09", "123456789","Houston", "TX", "90909",'M'),
	("111111","Jessie", "Smith","999 Fondren", "1965-08-11", "123456789","Houston", "TX", "90919",'F'),
	("222222","Jada", "Ross","3321 Castle", "1965-07-30", "123456789","Spring", "TX", "90989",'F'),
	("44444","Lily", "Dotson","291 Berry", "1965-06-10", "123456789","Bellaire", "TX", "12229",'F'),
	("666666","Claudia", "Contrea","731 Fondren", "1965-04-13", "123456789","Houston", "TX", "98614",'F'),
	("777777","Jack", "Roger","975 Fire Oak", "1965-03-09", "123456789","Humble", "TX", "41411",'M'),
	("888888","Laila", "Schiffer","5631 Rice", "1965-02-14", "123456789","Houston", "TX", "87151",'F'),
	("8778","Mindy", "Kaling","980 Dallas", "1965-09-19", "123456789","Houston", "TX", "87878",'F'),
	("55555","Jacob", "Trey","450 Stone", "1965-01-22", "123456789","Houston", "TX", "64568",'M'),
	("7777555","Terry", "Robertson","777 Stone", "1965-01-26", "123456789","Houston", "TX", "12212",'M');


INSERT INTO Department(Dept_ID, Dept_Name) VALUES
	(1, 'Emergency'),
	(2, 'Cardiovascular'),
	(3, 'Medicine'),
	(4, 'Hematology and Oncology'),
	(5, 'Pediatrics'),
	(6, 'Plastic Surgery'),
	(7, 'Radiology'),
	(8, 'Urology');


INSERT INTO Doctor(SSN, D_Office_Address, D_Office_City, D_Office_State, D_Office_Zip, D_Office_Phone, D_Qualification, Dept_ID) VALUES
	("44444", "1000 Davis St", "Evanston", "IL", "60201", "7737213456", "Cardiovascular", 2),
	("55555", "1001 Davis St", "Evanston", "IL", "60202", "7737213456", "Medicine", 3);


INSERT INTO Patient(SSN, Current_Status, D_SSN) VALUES
	("99999", "Heart Problem", "55555"),
	("8778", "Allergy issue raised", "55555");


INSERT INTO Pharmacist(SSN, P_Office_Address, P_Office_City, P_Office_State, P_Office_Zip, P_Office_Phone, P_Qualification) VALUES 
	("666666", "1000 Davis", "Evanston", "IL", "60201", "1234567890", "Pharmacy managers"),
	("7777555", "1000 Davis", "Evanston", "IL", "60201", "1234567890", "Pharmacy specialist");
	

INSERT INTO Insurance_Company(InsCompany_Name,  Ins_Phone, Ins_Address, Ins_City, Ins_ZipCode) VALUES
	("Aetna", "3128889999", "401 N Sheridan Rd", "Chicago", "60602"),
	("Blue Cross Blue Shield", "3128889999", "78 N Michigan Ave", "Chicago", "60606");


INSERT INTO Insurance_Policy(Policy_Num, Group_Num, Ins_Category, InsCompany_Name) VALUES
	("123456789", "987654", "HMO", "Aetna"),
	("456789012", "123456", "PPO", "Blue Cross Blue Shield");


INSERT INTO Payment(Payment_ID, Payment_Method, Payment_Status, Payment_Date, Policy_Num) VALUES
	("P123456", "Credit Card", "Done", "2014-10-20", "123456789"),
	("P456789", "Cash", "Done", "2014-11-13", "456789012");


INSERT INTO Bill(Bill_Num, Amount, Bill_Date, Due_Date, Payment_ID) VALUES
	("B0956", 507.69, "2014-08-12", "2015-04-30", "P123456"),
	("B1956", 450.00, "2014-10-29", "2015-05-30", "P456789");


INSERT INTO Visit(Visit_ID, Date_Time, Complaint, CommentsSuggestions, D_SSN, Bill_Num) VALUES
	("V1234", "2014-11-13 13:45:00", "", "Came with high fever", "44444", "B0956"),
	("V2234", "2014-11-15 11:30:00", "", "", "55555", "B1956");


INSERT INTO Has_Visits(P_SSN, Visit_ID) VALUES
	("99999", "V1234"),
	("8778", "V2234");


INSERT INTO Diagnosis(Diagnosis_ID, Diagnosis_Category) VALUES
	("D0001", "No Diagnosis Needed"),
	("D1234", "Circulatory System"),
	("D2345", "Nervous System"),
	("D0099", "Digestive System"),
	("D9845", "Injuries, Poison and Toxic Effect"),
	("D4567", "Kidney and Urinary");


INSERT INTO Result(Visit_ID, Diagnosis_ID) VALUES
	("V1234", "D1234"),
	("V1234", "D9845"),
	("V2234", "D0001");


INSERT INTO Prescription(Prescription_ID, Visit_ID, PH_SSN) VALUES
	("Rx01234", "V1234", "666666"),
	("Rx11234", "V2234", "666666");


INSERT INTO Manufacturer(Manufacturer_ID, M_Name, M_Address, M_Phone) VALUES
	("M567", "CVS Pharmaceuticals", "Calumet, IN", "7779990001"),
	("M3456", "Procter & Gamble", "Nashville, TN", "8889990001"),
	("M0054", "Sigma-Tau Pharmaceuticals", "Houston, TX", "5559990001");


INSERT INTO Medicine(Minventory_ID, Mname, Price, M_Qauntity, Exp_Date, Manufacture_Date, Manufacturer_ID) VALUES
	("345987", "Zantac", 17.49, 100, "2016-12-30", "2014-10-23", "M3456"),
	("10034", "Antibiotic Ointment", 5.99, 50, "2016-02-30", "2014-11-12", "M567");


INSERT INTO Prescribed_Meds(Prescription_ID, Minventory_ID, Medicine_Quantity) VALUES
	("Rx01234", "345987", 1),
	("Rx11234", "10034", 1);


INSERT INTO PreExistingConditions(Id, Value) VALUES
	("Pre001", "High Blood Pressure"),
	("Pre002", "High Cholesterol"),
	("Pre003", "Previous Heart-Attack"),
	("Pre004", "Migraine");


INSERT INTO PatientsPreConditions(P_SSN, PreConditionId, EntryDate) VALUES
	("99999", "Pre001", now()),
	("99999", "Pre002", now()),
	("99999", "Pre003", now());


INSERT INTO Allergies(Id, Value) VALUES
	("Allergy001", "Egg"),
	("Allergy002", "Peanut"),
	("Allergy003", "Gluten"),
	("Allergy004", "Tetracycline"),
	("Allergy005", "Polen"),
	("Allergy006", "Cold"),
	("Allergy007", "Mold"),
	("Allergy008", "Perfume"),
	("Allergy009", "Dust");


INSERT INTO PatientsAllergies(P_SSN, AllergyId, EntryDate) VALUES
	("99999", "Allergy001", now()),
	("99999", "Allergy003", now()),
	("99999", "Allergy006", now()),
	("8778", "Allergy004", now()),
	("8778", "Allergy006", now());


INSERT INTO Medications(P_SSN, MedicineName, EntryDate) VALUES
	("99999", "Aspirin", now()),
	("99999", "Zantac", now()),	
	("8778", "Advil", now()),
	("8778", "Zantac", now());


INSERT INTO Immunizations(Id, Value) VALUES
	("Immu001", "Hepatitis A"),
	("Immu002", "Hepatitis B"),
	("Immu003", "Infuenza"),
	("Immu004", "Tetanus"),
	("Immu005", "Diptheria"),
	("Immu006", "Measles"),
	("Immu007", "Mumps"),
	("Immu008", "Rubella"),
	("Immu009", "Haemophilus"),
	("Immu010", "Varicella");


INSERT INTO PatientsImmunizations(P_SSN, ImmunizationId, EntryDate) VALUES
	("99999", "Immu006", now()),
	("99999", "Immu007", now()),
	("99999", "Immu008", now()),
	("99999", "Immu001", now()),
	("99999", "Immu002", now()),
	("99999", "Immu003", now()),
	("99999", "Immu004", now()),
	("8778", "Immu001", now()),
	("8778", "Immu005", now()),
	("8778", "Immu009", now()),
	("8778", "Immu002", now());


INSERT INTO Notes(P_SSN, EntryDate, Comments) VALUES
	("99999", now(), "Nothing to be Noted"),		
	("8778", now(), "Nothing to be noted");
	
	
INSERT INTO Has_Patients(PH_SSN, P_SSN) VALUES
	("666666", "99999"),
	("7777555", "8778");

COMMIT;