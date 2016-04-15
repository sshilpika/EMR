Alter table patient add username tinytext FIRST;
alter table patient add password char(255) after username;
Alter table doctor add username tinytext FIRST;
alter table doctor add password char(255) after username;
Alter table pharmacist add username tinytext FIRST;
alter table pharmacist add password char(255) after username;




UPDATE Patient
SET username = 'Kmindy',
 	password = '$2a$10$pHKGwaQY75TR68WR3b5xeuSJ7Mw2meyBrU45uj6ivdxP4MQw5zkG6',
	image = '/emr/patient/img/KMindy.png'
where SSN = 8778;


UPDATE Patient
SET username = 'SJohn',
 	password = '$2a$10$pHKGwaQY75TR68WR3b5xeuSJ7Mw2meyBrU45uj6ivdxP4MQw5zkG6',
image = '/emr/patient/img/SJohn.png'
where SSN = 99999;

UPDATE pharmacist
SET username = 'CClaudia',
 	password = '$2a$10$pHKGwaQY75TR68WR3b5xeuSJ7Mw2meyBrU45uj6ivdxP4MQw5zkG6'
where SSN = 666666;

UPDATE pharmacist
SET username = 'RTerry',
 	password = '$2a$10$pHKGwaQY75TR68WR3b5xeuSJ7Mw2meyBrU45uj6ivdxP4MQw5zkG6'
where SSN = 7777555;

UPDATE doctor
SET username = 'DLily',
 	password = '$2a$10$pHKGwaQY75TR68WR3b5xeuSJ7Mw2meyBrU45uj6ivdxP4MQw5zkG6'
where SSN = 44444;

UPDATE doctor
SET username = 'TJacob',
 	password = '$2a$10$pHKGwaQY75TR68WR3b5xeuSJ7Mw2meyBrU45uj6ivdxP4MQw5zkG6'
where SSN = 55555;


INSERT INTO PatientsPreConditions(P_SSN, PreConditionId, EntryDate) VALUES
	("8778", "Pre001", now()),
	("8778", "Pre002", now()),
	("8778", "Pre003", now());


INSERT INTO Has_Visits(Record_ID, Visit_ID) VALUES
	("R-0011", "V1234");
