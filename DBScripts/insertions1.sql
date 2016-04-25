USE EMR;

INSERT INTO Person(SSN, First_Name, Last_Name, Home_Address, Birth_Date, Home_Phone, City, State, ZipCode, Gender) VALUES
	("999999","Aaron", "Hank","731 Fondren", "1965-07-09", "123456789","Houston", "TX", "90909",'M'),
	("1111111","Frank", "Abagnale","999 Fondren", "1965-08-11", "123456789","Houston", "TX", "90919",'M'),
	("2222222","Edward", "Abbey","3321 Castle", "1965-07-30", "123456789","Spring", "TX", "90989",'M'),
	("444444","Reuben", "Dotson","291 Berry", "1965-06-10", "123456789","Bellaire", "TX", "12229",'M'),
	("6666666","Hal", "Abel","731 Fondren", "1965-04-13", "123456789","Houston", "TX", "98614",'M'),
	("7777777","James", "Abourezk","975 Fire Oak", "1965-03-09", "123456789","Humble", "TX", "41411",'M'),
	("8888888","Creighton", "Abrams","5631 Rice", "1965-02-14", "123456789","Houston", "TX", "87151",'M'),
	("87788","Jane", "Ace","980 Dallas", "1965-09-19", "123456789","Houston", "TX", "87878",'M'),
	("555555","John", "Acton","450 Stone", "1965-01-22", "123456789","Houston", "TX", "64568",'M'),
	("77775555","Abigail", "Adams","777 Stone", "1965-01-26", "123456789","Houston", "TX", "12212",'M');


INSERT INTO Patient(SSN, Current_Status, D_SSN) VALUES
	("999999", "Heart Problem", "55555"),
  ("2222222", "Heart Problem", "55555"),
  ("7777777", "Heart Problem", "55555"),
  ("6666666", "Heart Problem", "55555"),
  ("444444", "Heart Problem", "55555"),
  ("8888888", "Heart Problem", "55555"),
	("87788", "Allergy issue raised", "55555");


INSERT INTO Visit(Visit_ID, Date_Time, Complaint, CommentsSuggestions, D_SSN, Bill_Num) VALUES
	("V12345", "2014-11-13 13:45:00", "", "High fever, chest congestion", "55555", "B0956"),
  ("V72345", "2014-11-13 13:45:00", "", "High fever, chest congestion", "55555", "B0956"),
  ("V32345", "2014-11-13 13:45:00", "", "High fever, chest congestion", "55555", "B0956"),
  ("V42345", "2014-11-13 13:45:00", "", "High fever, chest congestion", "55555", "B0956"),
  ("V52345", "2014-11-13 13:45:00", "", "High fever, chest congestion", "55555", "B0956"),
  ("V62345", "2014-11-13 13:45:00", "", "High fever, chest congestion", "55555", "B0956"),
	("V22345", "2014-11-15 11:30:00", "", "indigestion, nausea, passing excessive amounts of gas, or vomiting", "55555", "B1956");


INSERT INTO Has_Visits(P_SSN, Visit_ID) VALUES
	("999999", "V12345"),
  ("2222222", "V3234"),
  ("7777777", "V4234"),
  ("6666666", "V5234"),
  ("444444", "V6234"),
  ("8888888", "V7234"),
	("87788", "V22345");



INSERT INTO Result(Visit_ID, Diagnosis_ID) VALUES
	("V12345", "D1234"),
	("V12345", "D9845"),
  ("V32345", "D1234"),
  ("V42345", "D1234"),
  ("V52345", "D1234"),
  ("V62345", "D1234"),
  ("V72345", "D1234"),
  ("V72345", "D0099"),
	("V22345", "D0001");


INSERT INTO Prescription(Prescription_ID, Visit_ID, PH_SSN) VALUES
	("Rx012346", "V12345", "666666"),
  ("Rx012345", "V72345", "666666"),
  ("Rx012347", "V32345", "666666"),
  ("Rx012348", "V42345", "666666"),
  ("Rx012349", "V52345", "666666"),
  ("Rx0123401", "V62345", "666666"),
	("Rx1123402", "V22345", "666666");


INSERT INTO Medicine(Minventory_ID, Mname, Price, M_Qauntity, Exp_Date, Manufacture_Date, Manufacturer_ID) VALUES
	("3459878", "Abarelix", 17.49, 100, "2016-12-30", "2014-10-23", "M3456"),
  ("3459879", "Abatacept", 17.49, 100, "2016-12-30", "2014-10-23", "M3456"),
  ("3459871", "Daclizumab", 17.49, 100, "2016-12-30", "2014-10-23", "M3456"),
  ("3459872", "Dacogen", 17.49, 100, "2016-12-30", "2014-10-23", "M3456"),
  ("3459873", "Econazole Nitrate", 17.49, 100, "2016-12-30", "2014-10-23", "M3456"),
	("100344", "Kalbitor", 5.99, 50, "2016-02-30", "2014-11-12", "M567");


INSERT INTO Prescribed_Meds(Prescription_ID, Minventory_ID, Medicine_Quantity) VALUES
	("Rx012346", "3459878", 1),
  ("Rx012345", "3459879", 1),
  ("Rx012347", "3459871", 1),
  ("Rx012348", "3459872", 1),
  ("Rx012349", "3459873", 1),
  ("Rx0123401", "3459873", 1),
	("Rx1123402", "100344", 1);


INSERT INTO PreExistingConditions(Id, Value) VALUES
	("Pre005", "Anorexia"),
	("Pre006", "Bipolar disorder"),
	("Pre007", "Cholesterol"),
  ("Pre009", "Heartburn"),
	("Pre008", "Depression");


INSERT INTO PatientsPreConditions(P_SSN, PreConditionId, EntryDate) VALUES
	("999999", "Pre003", now()),
	("2222222", "Pre003", now()),
  ("7777777", "Pre004", now()),
	("6666666", "Pre005", now()),
  ("444444", "Pre006", now()),
  ("8888888", "Pre009", now()),
	("87788", "Pre007", now()),
	("7777777", "Pre008", now());


INSERT INTO PatientsAllergies(P_SSN, AllergyId, EntryDate) VALUES
	("999999", "Allergy001", now()),
	("2222222", "Allergy003", now()),
	("444444", "Allergy006", now()),
  ("999999", "Allergy002", now()),
	("2222222", "Allergy004", now()),
	("444444", "Allergy008", now()),
	("7777777", "Allergy004", now()),
	("7777777", "Allergy006", now());


INSERT INTO Medications(P_SSN, MedicineName, EntryDate) VALUES
	("999999", "Aspirin", now()),
	("999999", "Zantac", now()),
	("87788", "Advil", now()),
	("87788", "Zantac", now());



INSERT INTO PatientsImmunizations(P_SSN, ImmunizationId, EntryDate) VALUES
	("999999", "Immu006", now()),
	("999999", "Immu007", now()),
	("999999", "Immu008", now()),
	("999999", "Immu001", now()),
	("999999", "Immu002", now()),
	("999999", "Immu003", now()),
	("999999", "Immu004", now()),
	("87788", "Immu001", now()),
	("87788", "Immu005", now()),
	("87788", "Immu009", now()),
  ("2222222", "Immu006", now()),
	("2222222", "Immu007", now()),
	("2222222", "Immu008", now()),
	("2222222", "Immu001", now()),
	("2222222", "Immu002", now()),
	("2222222", "Immu003", now()),
	("2222222", "Immu004", now()),
	("444444", "Immu001", now()),
	("444444", "Immu005", now()),
	("444444", "Immu009", now()),
	("444444", "Immu002", now());


INSERT INTO Notes(P_SSN, EntryDate, Comments) VALUES
	("999999", now(), "Patient making good progress"),
	("87788", now(), "Patient making good progress");


INSERT INTO Has_Patients(PH_SSN, P_SSN) VALUES
	("666666", "999999"),
  ("666666", "2222222"),
  ("666666", "444444"),
  ("7777555", "999999"),
  ("7777555", "444444"),
	("7777555", "87788");

COMMIT;
