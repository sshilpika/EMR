
CREATE DATABASE IF NOT EXISTS EMR DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE EMR;

DROP TABLE IF EXISTS PatientHistory;
DROP TABLE IF EXISTS Has_Patients;
DROP TABLE IF EXISTS Notes;
DROP TABLE IF EXISTS PatientsImmunizations;
DROP TABLE IF EXISTS Immunizations;
DROP TABLE IF EXISTS Medications;
DROP TABLE IF EXISTS PatientsAllergies;
DROP TABLE IF EXISTS Allergies;
DROP TABLE IF EXISTS PatientsPreConditions;
DROP TABLE IF EXISTS PreExistingConditions;
DROP TABLE IF EXISTS Prescribed_Meds; 
DROP TABLE IF EXISTS Medicine;
DROP TABLE IF EXISTS Manufacturer; 
DROP TABLE IF EXISTS Prescription; 
DROP TABLE IF EXISTS Result; 
DROP TABLE IF EXISTS Diagnosis; 
DROP TABLE IF EXISTS Has_Visits; 
DROP TABLE IF EXISTS Visit; 
DROP TABLE IF EXISTS Bill; 
DROP TABLE IF EXISTS Payment; 
DROP TABLE IF EXISTS Insurance_Policy; 
DROP TABLE IF EXISTS Insurance_Company; 
DROP TABLE IF EXISTS Pharmacist; 
DROP TABLE IF EXISTS Patient; 
DROP TABLE IF EXISTS Doctor; 
DROP TABLE IF EXISTS Department; 
DROP TABLE IF EXISTS Person; 


CREATE TABLE Person (
  SSN varchar(9)             PRIMARY KEY     NOT NULL,
  First_Name varchar(20)                  NOT NULL,
  Last_Name varchar(20)                   NOT NULL,
  Home_Address   varchar(50), 
  Birth_Date  DATE,
  Home_Phone varchar(15),
  City varchar(10),
  State char(2),
  ZipCode varchar(10),
  Gender Char(1)  
) ENGINE = MyISAM;


CREATE TABLE Department (
  Dept_ID int(10)   PRIMARY KEY     NOT NULL,
  Dept_Name varchar(20)                   NOT NULL
) ENGINE = MyISAM;


CREATE TABLE Doctor (
  SSN varchar(9)             PRIMARY KEY     NOT NULL,
  D_Office_Address varchar(50)            NOT NULL,
  D_Office_City varchar(10),
  D_Office_State char(2),
  D_Office_Zip varchar(10),
  D_Office_Phone varchar(20),  
  D_Qualification varchar(20)             NOT NULL,
  Dept_ID int(10)                         NOT NULL,
  FOREIGN KEY (SSN)     REFERENCES Person(SSN),
  FOREIGN KEY (Dept_ID) REFERENCES Department(Dept_ID)
) ENGINE = MyISAM;


CREATE TABLE Patient (
  SSN varchar(9)             PRIMARY KEY     NOT NULL,
  Current_Status varchar(200),
  Image   varchar(50),
  D_SSN varchar(9)                           NOT NULL,
  FOREIGN KEY (SSN)       REFERENCES Person(SSN),
  FOREIGN KEY (D_SSN)     REFERENCES Doctor(SSN)
) ENGINE = MyISAM;


CREATE TABLE Pharmacist (
  SSN varchar(9)             PRIMARY KEY     NOT NULL,
  P_Office_Address varchar(50),
  P_Office_City varchar(10),
  P_Office_State char(2),
  P_Office_Zip varchar(10),  
  P_Office_Phone varchar(20),
  P_Qualification varchar(20),
  FOREIGN KEY (SSN) REFERENCES Person(SSN)
) ENGINE = MyISAM;



CREATE TABLE Insurance_Company(
  InsCompany_Name varchar(30) PRIMARY KEY  NOT NULL,
  Ins_Address varchar(50),
  Ins_Phone varchar(10),
  Ins_City varchar(10),
  Ins_ZipCode varchar(10)
) ENGINE = MyISAM;


CREATE TABLE Insurance_Policy(
  Policy_Num varchar(10)      PRIMARY KEY  NOT NULL,  
  Group_Num varchar(10),
  Ins_Category varchar(10),
  InsCompany_Name varchar(30),
  FOREIGN KEY (InsCompany_Name) REFERENCES Insurance_Company(InsCompany_Name)
) ENGINE = MyISAM;


CREATE TABLE Payment(
  Payment_ID varchar(10)      PRIMARY KEY  NOT NULL,
  Payment_Method varchar(10),
  Payment_Status varchar(10),
  Payment_Date Date,
  Policy_Num varchar(10),
  FOREIGN KEY (Policy_Num) REFERENCES Insurance_Policy(Policy_Num)
) ENGINE = MyISAM;


CREATE TABLE Bill(
  Bill_Num varchar(10)        PRIMARY KEY  NOT NULL,
  Amount Decimal(10,2),
  Bill_Date Date,
  Due_Date Date,
  Payment_ID varchar(10),
  FOREIGN KEY (Payment_ID) REFERENCES Payment(Payment_ID)
) ENGINE = MyISAM;


CREATE TABLE Visit(
  Visit_ID varchar(10)      PRIMARY KEY  NOT NULL,
  Date_Time Timestamp                    NOT NULL,
  Complaint varchar(250),
  CommentsSuggestions varchar(250),
  D_SSN varchar(9)                           NOT NULL,
  Bill_Num varchar(10)                    NOT NULL,
  FOREIGN KEY (D_SSN)     REFERENCES Doctor(SSN)  
) ENGINE = MyISAM;


CREATE TABLE Has_Visits(
  P_SSN varchar(9)                       NOT NULL,  
  Visit_ID varchar(10)                   NOT NULL,
  PRIMARY KEY (P_SSN, Visit_ID),    
  FOREIGN KEY (P_SSN) REFERENCES Patient(SSN),
  FOREIGN KEY (Visit_ID)  REFERENCES Visit(Visit_ID)
) ENGINE = MyISAM;


CREATE TABLE Diagnosis(
  Diagnosis_ID varchar(10) PRIMARY KEY  NOT NULL,
  Diagnosis_Category varchar(50) 
) ENGINE = MyISAM;


CREATE TABLE Result(  
  Visit_ID varchar(10)        NOT NULL,
  Diagnosis_ID varchar(10)    NOT NULL,
  
  PRIMARY KEY (Visit_ID, Diagnosis_ID),
  FOREIGN KEY (Visit_ID)      REFERENCES Visit(Visit_ID),
  FOREIGN KEY (Diagnosis_ID)  REFERENCES Diagnosis(Diagnosis_ID)
) ENGINE = MyISAM;


CREATE TABLE Prescription (
  Prescription_ID varchar(10) PRIMARY KEY  NOT NULL,
  Visit_ID varchar(10)              NOT NULL,
  PH_SSN varchar(9)                 NOT NULL,
  FOREIGN KEY (Visit_ID)      REFERENCES Visit(Visit_ID),
  FOREIGN KEY (PH_SSN)        REFERENCES Pharmacist(SSN)
  
) ENGINE = MyISAM;


CREATE TABLE Manufacturer (
  Manufacturer_ID varchar(10) PRIMARY KEY  NOT NULL,
  M_Name varchar(30)                       NOT NULL,
  M_Address varchar(30),
  M_Phone varchar(10)
) ENGINE = MyISAM;


CREATE TABLE Medicine (
  Minventory_ID varchar(10) PRIMARY KEY  NOT NULL,
  Mname varchar(30)                      NOT NULL,
  Price decimal(10,2),
  M_Qauntity INT(2),
  Exp_Date Date,
  Manufacture_Date Date,
  Manufacturer_ID varchar(10)            NOT NULL,
  FOREIGN KEY (Manufacturer_ID) REFERENCES Manufacturer(Manufacturer_ID)
) ENGINE = MyISAM;


CREATE TABLE Prescribed_Meds(
  Prescription_ID varchar(10)            NOT NULL,
  Minventory_ID varchar(10)              NOT NULL,
  Medicine_Quantity INT(2)                NOT NULL,
  PRIMARY KEY(Prescription_ID, Minventory_ID),
  FOREIGN KEY (Prescription_ID) REFERENCES Prescription(Prescription_ID),
  FOREIGN KEY (Minventory_ID)   REFERENCES Medicine(Minventory_ID)
) ENGINE = MyISAM;


CREATE TABLE PreExistingConditions (
  Id varchar(10) PRIMARY KEY  NOT NULL,
  Value varchar(50)  
) ENGINE = MyISAM;


CREATE TABLE PatientsPreConditions(
  P_SSN varchar(10)               NOT NULL,  
  PreConditionId varchar(10)       NOT NULL,
  EntryDate Timestamp,
  PRIMARY KEY(P_SSN, PreConditionId),
  FOREIGN KEY (P_SSN) REFERENCES Person(SSN),
  FOREIGN KEY (PreConditionId) REFERENCES PreExistingConditions(Id)
) ENGINE = MyISAM;


CREATE TABLE Allergies (
  Id varchar(10) PRIMARY KEY  NOT NULL,
  Value varchar(50)  
) ENGINE = MyISAM;


CREATE TABLE PatientsAllergies(
  P_SSN varchar(10)               NOT NULL,  
  AllergyId varchar(10)       NOT NULL,
  EntryDate Timestamp,
  PRIMARY KEY(P_SSN, AllergyId),
  FOREIGN KEY (P_SSN) REFERENCES Person(SSN),
  FOREIGN KEY (AllergyId) REFERENCES Allergy(Id)
) ENGINE = MyISAM;


CREATE TABLE Medications(
  P_SSN varchar(10)               NOT NULL,  
  MedicineName varchar(50)       NOT NULL,
  EntryDate Timestamp,
  PRIMARY KEY(P_SSN, MedicineName),
  FOREIGN KEY (P_SSN) REFERENCES Person(SSN)  
) ENGINE = MyISAM;


CREATE TABLE Immunizations (
  Id varchar(10) PRIMARY KEY  NOT NULL,
  Value varchar(50)  
) ENGINE = MyISAM;


CREATE TABLE PatientsImmunizations(
  P_SSN varchar(10)               NOT NULL,  
  ImmunizationId varchar(10)       NOT NULL,
  EntryDate Timestamp,
  PRIMARY KEY(P_SSN, ImmunizationId),
  FOREIGN KEY (P_SSN) REFERENCES Person(SSN),
  FOREIGN KEY (ImmunizationId) REFERENCES Immunizations(Id)
) ENGINE = MyISAM;


CREATE TABLE Notes (
  P_SSN varchar(10)           NOT NULL,    
  EntryDate Timestamp         NOT NULL,
  Comments varchar(500)       NOT NULL,    
  PRIMARY KEY(P_SSN, EntryDate),
  FOREIGN KEY (P_SSN) REFERENCES Person(SSN)  
) ENGINE = MyISAM;

CREATE TABLE Has_Patients (
  PH_SSN varchar(9)                           NOT NULL,
  P_SSN varchar(9)                           NOT NULL,
  
  PRIMARY KEY (PH_SSN, P_SSN),
  FOREIGN KEY (PH_SSN) REFERENCES Pharmacist(SSN),
  FOREIGN KEY (P_SSN) REFERENCES Patient(SSN)
) ENGINE = MyISAM;

CREATE TABLE PatientHistory (
  SSN varchar(9)            NOT NULL,
  Current_Status varchar(500),
  Image   varchar(50),
  D_SSN varchar(9)          NOT NULL,
  EntryDate Timestamp       NOT NULL,
  FOREIGN KEY (SSN)       REFERENCES Person(SSN)
) ENGINE = MyISAM;
