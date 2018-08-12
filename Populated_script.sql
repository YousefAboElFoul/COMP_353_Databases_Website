USE rcc353_1;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS AccountType;
  CREATE TABLE IF NOT EXISTS AccountType(
  id INT(6) UNSIGNED AUTO_INCREMENT,
  type VARCHAR(20),
  PRIMARY KEY(id)
)ENGINE= INNODB;
INSERT INTO AccountType(type) VALUES('ADMIN');
INSERT INTO AccountType(type) VALUES('SalesAssociate');
INSERT INTO AccountType(type) VALUES('Manager');
INSERT INTO AccountType(type) VALUES('Employee');
INSERT INTO AccountType(type) VALUES('Client');


DROP TABLE IF EXISTS Account;
CREATE TABLE IF NOT EXISTS Account(
  id INT(6) UNSIGNED AUTO_INCREMENT,
  username VARCHAR(20),
  password CHAR(8),
  account_type INT UNSIGNED,
  PRIMARY KEY (id),
  FOREIGN KEY (account_type) REFERENCES AccountType(id)
)ENGINE=INNODB;

# 1
INSERT INTO Account(username,password,account_type) VALUES('MOMO','123456',5);
# 2
INSERT INTO Account(username,password,account_type) VALUES('Ryan','4588AA',5);
# 3
INSERT INTO Account(username,password,account_type) VALUES('Yosuef','BB123',5);
# 4
INSERT INTO Account(username,password,account_type)VALUES('HANABANANA','ubadass',5);
# 5
INSERT INTO Account(username,password,account_type) VALUES('THUGMAN','nopass',4);
# 6
INSERT INTO Account(username,password,account_type) VALUES('WHYYoulikedat','4545A',4);
# 7
INSERT INTO Account(username,password,account_type)VALUES('PRINCE EL LYAL','BB123',4);
# 8
INSERT INTO Account(username,password,account_type)VALUES('manager_user','pwrd',3);
# 9
INSERT INTO Account(username,password,account_type)VALUES('THOMAS ANDRESON','passisme',3);
# 10
INSERT INTO Account(username,password,account_type) VALUES('DEVIANT_CONOOR','BB123',1);
# 11
INSERT INTO Account(username,password,account_type) VALUES('BRADLEY MARTYN','ZOOGYM',2);
# 12
INSERT INTO Account(username,password,account_type) VALUES('NICK Power','Strength',2);
# 13
INSERT INTO Account(username,password,account_type) VALUES('rion_nikols','pwrd',4);
# 14
INSERT INTO Account(username,password,account_type) VALUES('ryan_nichols','pwrd',4);
#15
INSERT INTO Account(username,password,account_type) VALUES('Hall_pass','zuchini',5);
#16
INSERT INTO Account(username,password,account_type) VALUES('Cdog','P3rfum3',2);
#17
INSERT INTO Account(username,password,account_type) VALUES('Benq','stronass',3);
#18
INSERT INTO Account(username,password,account_type) VALUES('Deeflo','Powa',3);
#19
INSERT INTO Account(username,password,account_type) VALUES('2late','2hate',3);
#20
INSERT INTO Account(username,password,account_type) VALUES('Terminator','Skyn3t',1);
#21
INSERT INTO Account(username,password,account_type) VALUES('MATILDAV','IamTrash',4);
#22
INSERT INTO Account(username,password,account_type) VALUES('Corsair','200r',4);
#23
INSERT INTO Account(username,password,account_type) VALUES('garfic','rx480',4);
#24
INSERT INTO Account(username,password,account_type) VALUES('cpu','i57500',4);
#25
INSERT INTO Account(username,password,account_type) VALUES('psu','EVGA500B',4);

DROP TABLE IF EXISTS Service_type; 
CREATE TABLE IF NOT EXISTS Service_type(
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    name CHAR(11),
    PRIMARY KEY(id)
) ENGINE=INNODB;
INSERT INTO Service_type (name) VALUES ("On premises");
INSERT INTO Service_type (name) VALUES ("Cloud");



DROP TABLE IF EXISTS Contract_type;
CREATE TABLE IF NOT EXISTS Contract_type(
    id INT(6) UNSIGNED AUTO_INCREMENT, 
    name VARCHAR(30) NOT NULL,
    PRIMARY KEY(id)
    ) ENGINE=INNODB;
   
INSERT INTO Contract_type (name) VALUES ("Premium"); 
INSERT INTO Contract_type (name) VALUES ("Diamond");  
INSERT INTO Contract_type (name) VALUES ("Gold");  
INSERT INTO Contract_type (name) VALUES ("Silver");   

DROP TABLE IF EXISTS Line_business;
CREATE TABLE IF NOT EXISTS Line_business(
   id INT UNSIGNED AUTO_INCREMENT,
   name VARCHAR(30) NOT NULL,
   PRIMARY KEY(id)
) ENGINE=INNODB;

INSERT INTO Line_business(name) VALUES("General Software Development");
INSERT INTO Line_business(name) VALUES("Security");
INSERT INTO Line_business(name) VALUES("Cloud Hosting");
INSERT INTO Line_business(name) VALUES("Blockchain");
INSERT INTO Line_business(name) VALUES("Fintech");

DROP TABLE IF EXISTS Client;
CREATE TABLE IF NOT EXISTS Client(
	id INT UNSIGNED AUTO_INCREMENT NOT NULL,
     name VARCHAR(30) NOT NULL,
     phone_number VARCHAR(15) NOT NULL,  
     email VARCHAR(30) NOT NULL,  
     city VARCHAR(30) NOT NULL,
     province VARCHAR(30) NOT NULL,  
     postal_code CHAR(7) NOT NULL,
	 user_id INT UNSIGNED,
	 PRIMARY KEY(id),
	 FOREIGN KEY (user_id) REFERENCES Account(id)
)ENGINE=INNODB;
INSERT INTO Client(name,phone_number,email,city,province,postal_code,user_id) VALUES('Cameron Hall',5147707,'jos_vpn@hotmail.com','Montreal','Quebec','H4R 3G7',1);
INSERT INTO Client(name,phone_number,email,city,province,postal_code,user_id) VALUES('MOhammed Ghalyani',5147707,'momo@hotmail.com','Montreal','Quebec','H2M 3K7',2);
INSERT INTO Client(name,phone_number,email,city,province,postal_code,user_id) VALUES('Yazan Odeh',5147707,'yazan@hotmail.com','Montreal','Quebec','H3L 3N7',3);
INSERT INTO Client(name,phone_number,email,city,province,postal_code,user_id) VALUES('Tim Guy',5147707,'Tim@hotmail.com','Montreal','Quebec','H2U 2Y7',4);
INSERT INTO Client(name,phone_number,email,city,province,postal_code,user_id) VALUES('PASS Hall',5147707,'Hall.Pass@hotmail.com','Montreal','Quebec','H3T 3G7',15);

DROP TABLE IF EXISTS Responsible;
CREATE TABLE IF NOT EXISTS Responsible (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    middle_initial CHAR(1) NOT NULL,
    client_id INT UNSIGNED,
    PRIMARY KEY(id),
    INDEX(client_id),
    FOREIGN KEY (client_id) REFERENCES Client(id)
) ENGINE=INNODB;
INSERT INTO Responsible(first_name,last_name,middle_initial,client_id)Values('Ayman','Abo El Foul','S',1);
INSERT INTO Responsible(first_name,last_name,middle_initial,client_id)Values('Loban','Fear','S',2);
INSERT INTO Responsible(first_name,last_name,middle_initial,client_id)Values('Hanz','FlamenWerfer','M',3);
INSERT INTO Responsible(first_name,last_name,middle_initial,client_id)Values('Ioseph','Stalin','L',4);
INSERT INTO Responsible(first_name,last_name,middle_initial,client_id)Values('Ayman','Abo El Foul','S',5);



DROP TABLE IF EXISTS Insurance_plan;
CREATE TABLE IF NOT EXISTS Insurance_plan(
    id INT UNSIGNED AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
	  PRIMARY KEY(id)
) ENGINE=INNODB;

INSERT INTO Insurance_plan(name)
  VALUES("Premium Employee Plan");

INSERT INTO Insurance_plan(name)
  VALUES("Silver Employee Plan");

INSERT INTO Insurance_plan(name)
  VALUES("Normal Employee Plan");
	 
DROP TABLE IF EXISTS Employee;
	CREATE TABLE IF NOT EXISTS Employee(
  id INT UNSIGNED AUTO_INCREMENT,
  name VARCHAR(30) NOT NULL,
  employee_plan_id INT UNSIGNED,
	user_id INT UNSIGNED,
	contract_type INT UNSIGNED,
	home_province VARCHAR(30),
	PRIMARY KEY(id),
	FOREIGN KEY(contract_type) REFERENCES Contract_type(id),
  FOREIGN KEY (user_id) REFERENCES Account(id),
  FOREIGN KEY(employee_plan_id) REFERENCES Employee_plan(id)
) ENGINE=INNODB;

INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Fred Flintstone", 5, 4, 1, "Quebec");
    
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Ellen Degeneress", 6, 3, 2, "Quebec");
    
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Max Patches", 7, 2, 3, "Quebec");

INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Sonny Jim", 13, 1, 2, "Quebec");

INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Banana Sandwhich", 14, 4, 2, "Quebec");
	
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Matilda Tank", 21, 3, 2, "Quebec");
    
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Case Corsair", 22, 2, 3, "Quebec");

INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Garfic Kard", 23, 1, 1, "Quebec");

INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Cee Pee Yu ", 24, 4, 2, "Quebec");
	
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Pee Es Yu", 25, 3, 2, "Quebec");
    
	
    
DROP TABLE IF EXISTS Manager;
	 CREATE TABLE IF NOT EXISTS Manager(
    id INT UNSIGNED AUTO_INCREMENT, 
    name VARCHAR(30) NOT NULL,
	user_id INT UNSIGNED,
	 PRIMARY KEY(id),
	 FOREIGN KEY (user_id) REFERENCES Account(id)
) ENGINE=INNODB;
INSERT INTO Manager(name,user_id) VALUES("HOMFO MAN",8);
INSERT INTO Manager(name,user_id) VALUES("SPIDER GUY",9);
INSERT INTO Manager(name,user_id) VALUES("BEN QUEU",17);
INSERT INTO Manager(name,user_id) VALUES("Dental FLOSS",18);
INSERT INTO Manager(name,user_id) VALUES("TU LEIT FAM",19);

DROP TABLE IF EXISTS SalesAssociate;
CREATE TABLE IF NOT EXISTS SalesAssociate(
   id INT UNSIGNED AUTO_INCREMENT,
   name VARCHAR(30) NOT NULL,
   user_id INT UNSIGNED,
   PRIMARY KEY(id),
   FOREIGN KEY (user_id) REFERENCES Account(id)
)ENGINE=INNODB;
INSERT INTO SalesAssociate(name,user_id) VALUES("Nicholas Gattuson",11);
INSERT INTO SalesAssociate(name,user_id) VALUES("Khaled Jababo",12);
INSERT INTO SalesAssociate(name,user_id) VALUES("Cesar Madfai",16);

DROP TABLE IF EXISTS Admin;	
CREATE TABLE IF NOT EXISTS Admin(
   id INT UNSIGNED AUTO_INCREMENT,
   name VARCHAR(30) NOT NULL,
   user_id INT UNSIGNED,
   PRIMARY KEY(id),
   FOREIGN KEY (user_id) REFERENCES Account(id)
) ENGINE=INNODB;

INSERT INTO Admin(name, user_id) VALUES("DEVIANT CONOOR", 10);
INSERT INTO Admin(name, user_id) VALUES("TERRY MINATOR", 20);
##--VALUES("BOSS HAMILITON",10);



DROP TABLE IF EXISTS Contract;
CREATE TABLE IF NOT EXISTS Contract (
    id INT UNSIGNED AUTO_INCREMENT, 
    client_id INT UNSIGNED,
    responsible_id INT UNSIGNED,
    acv int (10) NOT NULL,
    initial_amount DOUBLE(10, 2),  # 10 digits total, 2 for decimal
    start_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    service_type INT UNSIGNED,
    contract_type INT UNSIGNED,
    sales_associate INT UNSIGNED,
    first_deliverable DATE,
    second_deliverable DATE,
    third_deliverable DATE,
		final_deliverable DATE,
	line_business  INT UNSIGNED,
	client_satisfaction INT DEFAULT NULL,
	CONSTRAINT satisfaction_chk CHECK (client_satisfaction BETWEEN 1 AND 10),
    PRIMARY KEY(id),
    INDEX(client_id),
    INDEX(contract_type),
    INDEX(service_type),
    INDEX(responsible_id),
    INDEX(sales_associate),
	FOREIGN KEY(line_business) REFERENCES Line_business(id),
    FOREIGN KEY(client_id) REFERENCES Client(id),
    FOREIGN KEY(service_type) REFERENCES Service_type(id),
    FOREIGN KEY(contract_type) REFERENCES Contract_type(id),
    FOREIGN KEY(responsible_id) REFERENCES Responsible(id),
    FOREIGN KEY(sales_associate) REFERENCES SalesAssociate(id)
) ENGINE=INNODB;



DROP TABLE IF EXISTS Contract_Employee;
CREATE TABLE IF NOT EXISTS Contract_Employee(
  contract_id INT UNSIGNED,
  employee_id INT UNSIGNED,
  hours_worked INT UNSIGNED,
  PRIMARY KEY(contract_id,employee_id),
  FOREIGN KEY(contract_id) REFERENCES Contract(id),
  FOREIGN KEY(employee_id) REFERENCES Employee(id)
)ENGINE=INNODB;

DROP TABLE IF EXISTS Contract_Manager;
CREATE TABLE IF NOT EXISTS Contract_Manager(
  contract_id INT UNSIGNED,
  manager_id INT UNSIGNED,
  PRIMARY KEY(contract_id,manager_id),
  FOREIGN KEY(contract_id) REFERENCES Contract(id),
  FOREIGN KEY(manager_id) REFERENCES Manager(id)
)ENGINE=INNODB;



INSERT INTO Contract(client_id, responsible_id, acv, initial_amount, service_type, contract_type, sales_associate,line_business,start_date,first_deliverable,second_deliverable,final_deliverable)
  VALUES(1, 1, 69000, 20000, 1, 1, 1,1,date("2017-01-05 00:00:00"),'2017-01-08','2017-01-10','2017-01-25');
INSERT INTO Contract(client_id, responsible_id, acv, initial_amount, service_type, contract_type, sales_associate,line_business)
  VALUES(2, 2, 7355608, 20000, 1, 2, 1,2);
INSERT INTO Contract(client_id, responsible_id, acv, initial_amount, service_type, contract_type, sales_associate,line_business)
  VALUES(3, 1, 800085, 20000, 2, 3, 2,3);
INSERT INTO Contract(client_id, responsible_id, acv, initial_amount, service_type, contract_type, sales_associate,line_business)
  VALUES(4, 2, 69420, 20000, 2, 4, 2,4);
INSERT INTO Contract(client_id, responsible_id, acv, initial_amount, service_type, contract_type, sales_associate,line_business)
  VALUES(5, 2, 303259, 20000, 2, 4, 2,5);
INSERT INTO Contract(client_id, responsible_id, acv, initial_amount, service_type, contract_type, sales_associate,line_business)
  VALUES(1, 1, 90000, 20000, 1, 1, 1,1);
INSERT INTO Contract(client_id, responsible_id, acv, initial_amount, service_type, contract_type, sales_associate,line_business)
  VALUES(2, 2, 100000, 20000, 1, 2, 1,2);
INSERT INTO Contract(client_id, responsible_id, acv, initial_amount, service_type, contract_type, sales_associate,line_business)
  VALUES(3, 1, 85000, 20000, 2, 3, 2,3);
INSERT INTO Contract(client_id, responsible_id, acv, initial_amount, service_type, contract_type, sales_associate,line_business)
  VALUES(4, 2, 194000, 20000, 2, 4, 2,4);
INSERT INTO Contract(client_id, responsible_id, acv, initial_amount, service_type, contract_type, sales_associate,line_business)
  VALUES(5, 2, 110000, 20000, 2, 1, 2,5);
  
# /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO Contract(client_id,
    responsible_id,
    acv,
    initial_amount,
    service_type,
    contract_type,
    sales_associate,
    line_business,
    start_date,
    first_deliverable,
    second_deliverable,
    final_deliverable)
  VALUES(5, 2, 100000, 25000, 2, 1, 2,5,
  date("2017-01-05 00:00:00"),
  '2017-01-08',
  '2017-01-10',
  '2017-01-25');

  INSERT INTO Contract(client_id,
    responsible_id,
    acv,
    initial_amount,
    service_type,
    contract_type,
    sales_associate,
    line_business,
    start_date,
    first_deliverable,
    second_deliverable,
    final_deliverable)
  VALUES(2, 1, 10000, 2500, 2, 2, 2,5,
  date("2017-02-03 00:00:00"),
  '2017-02-05',
  '2017-02-10',
  '2017-02-15');


  INSERT INTO Contract(client_id,
    responsible_id,
    acv,
    initial_amount,
    service_type,
    contract_type,
    sales_associate,
    line_business,
    start_date,
    first_deliverable,
    second_deliverable,
    final_deliverable)
  VALUES(4, 1, 10000, 2500, 4, 3, 2, 5,
  date("2017-03-02 00:00:00"),
  '2017-03-05',
  '2017-03-10',
  '2017-03-15');

  INSERT INTO Contract(client_id,
    responsible_id,
    acv,
    initial_amount,
    service_type,
    contract_type,
    sales_associate,
    line_business,
    start_date,
    first_deliverable,
    second_deliverable,
    third_deliverable,
    final_deliverable)
  VALUES(4, 1, 10000, 2500, 4, 4, 2, 5,
  date("2017-04-02 00:00:00"),
  '2017-04-07',
  '2017-04-17',
  '2017-04-22',
  '2017-04-30');

  INSERT INTO Contract(client_id,
    responsible_id,
    acv,
    initial_amount,
    service_type,
    contract_type,
    sales_associate,
    line_business,
    start_date,
    first_deliverable,
    second_deliverable,
    final_deliverable)
  VALUES(1, 1, 11000, 2500, 1, 1, 3, 2,
  date("2017-05-01 00:00:00"),
  '2017-05-04',
  '2017-05-06',
  '2017-05-10');

  INSERT INTO Contract(client_id,
    responsible_id,
    acv,
    initial_amount,
    service_type,
    contract_type,
    sales_associate,
    line_business,
    start_date,
    first_deliverable,
    second_deliverable,
    final_deliverable)
  VALUES(5, 2, 1000, 200, 3, 2, 4, 4,
  date("2017-06-01 00:00:00"),
  '2017-06-06',
  '2017-06-11',
  '2017-06-18');


  INSERT INTO Contract(client_id,
    responsible_id,
    acv,
    initial_amount,
    service_type,
    contract_type,
    sales_associate,
    line_business,
    start_date,
    first_deliverable,
    second_deliverable,
    final_deliverable)
  VALUES(2, 2, 10000, 2000, 1, 3, 2, 3,
  date("2017-07-03 00:00:00"),
  '2017-07-11',
  '2017-07-13',
  '2017-07-20');

  INSERT INTO Contract(client_id,
    responsible_id,
    acv,
    initial_amount,
    service_type,
    contract_type,
    sales_associate,
    line_business,
    start_date,
    first_deliverable,
    second_deliverable,
    final_deliverable)
  VALUES(2, 2, 10000, 2000, 1, 3, 2, 3,
  date("2017-08-01 00:00:00"),
  '2017-08-10',
  '2017-08-12',
  '2017-08-19');

  INSERT INTO Contract(client_id,
    responsible_id,
    acv,
    initial_amount,
    service_type,
    contract_type,
    sales_associate,
    line_business,
    start_date,
    first_deliverable,
    second_deliverable,
    third_deliverable,
    final_deliverable)
  VALUES(4, 1, 13000, 2500, 2, 4, 2, 3,
  date("2017-09-01 00:00:00"),
  '2017-09-06',
  '2017-09-16',
  '2017-09-21',
  '2017-09-29');

  INSERT INTO Contract(client_id,
    responsible_id,
    acv,
    initial_amount,
    service_type,
    contract_type,
    sales_associate,
    line_business,
    start_date,
    first_deliverable,
    second_deliverable,
    final_deliverable)
  VALUES(4, 1, 13000, 2500, 2, 1, 2, 3,
  date("2017-10-03 00:00:00"),
  '2017-10-06',
  '2017-10-08',
  '2017-10-12');

  INSERT INTO Contract(client_id,
    responsible_id,
    acv,
    initial_amount,
    service_type,
    contract_type,
    sales_associate,
    line_business,
    start_date,
    first_deliverable,
    second_deliverable,
    final_deliverable)
  VALUES(2, 1, 13000, 2500, 2, 1, 2, 3,
  date("2017-11-03 00:00:00"),
  '2017-11-06',
  '2017-11-08',
  '2017-11-12');


INSERT INTO Contract(client_id,
    responsible_id,
    acv,
    initial_amount,
    service_type,
    contract_type,
    sales_associate,
    line_business,
    start_date,
    first_deliverable,
    second_deliverable,
    final_deliverable)
  VALUES(3, 1, 13000, 2500, 2, 1, 2, 3,
  date("2017-12-03 00:00:00"),
  '2017-12-06',
  '2017-12-08',
  '2017-12-12');
# ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

# contract type is 1 for this 1st contract therefore we need an employee whos preferred
# contract type is 1 therefor Max Patches the third employee created --> employee_id = 3
INSERT INTO Contract_Manager(contract_id, manager_id) VALUES(1,1);
INSERT INTO Contract_Manager(contract_id, manager_id) VALUES(2,1);
INSERT INTO Contract_Manager(contract_id, manager_id) VALUES(3,2);
INSERT INTO Contract_Manager(contract_id, manager_id) VALUES(4,2);
INSERT INTO Contract_Manager(contract_id, manager_id) VALUES(5,3);
INSERT INTO Contract_Manager(contract_id, manager_id) VALUES(6,3);
INSERT INTO Contract_Manager(contract_id, manager_id) VALUES(7,4);
INSERT INTO Contract_Manager(contract_id, manager_id) VALUES(8,4);
INSERT INTO Contract_Manager(contract_id, manager_id) VALUES(9,5);
INSERT INTO Contract_Manager(contract_id, manager_id) VALUES(10,5);


#platinum contract workers
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 4, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 8, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(6, 4, 70);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(6, 8, 69);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(10, 4, 83);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(10, 8, 25);

#diamond contract workers

INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(2, 3, 110);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(2, 7, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(7, 3, 50);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(7, 7, 80);

#gold contract workers

INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(3, 2, 110);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(3, 6, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(3, 10, 50);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(8, 2, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(8, 6, 110);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(8, 10, 80);


#silver contract workers
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(4, 1, 55);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(4, 5, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(4, 9, 50);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(5, 1, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(5, 5, 55);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(5, 9, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(9, 1, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(9, 5, 55);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(9, 9, 80);

#report number 2 employees

# employees added for 7th report 

INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler nguyen", 26, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler Degeneress", 27, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler drei ", 28, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler  khamse", 29, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler seteh ", 30, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler sabaa ", 31, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler tmeneh", 32, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler tessa", 33, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler ashara", 34, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler onze", 35, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler douze", 36, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler treise", 37, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler quatorze", 38, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler quinze", 39, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler seize", 40, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler dixsept", 41, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler dixhuit", 42, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler dix neuf", 43, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler vingh", 44, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler tiger", 45, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler panther", 46, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler ferdinand", 47, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler panzer", 48, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler churchill", 49, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler chromwell", 50, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler apds", 51, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler patton", 52, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler honika", 53, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler clarke", 54, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler wells", 55, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler kensei", 56, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler orochi", 57, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler tide", 58, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler venge", 59, 1, 2, "Quebec");
INSERT INTO Employee(name, user_id, contract_type, employee_plan_id, home_province)
    VALUES("Filler sven", 60, 1, 2, "Quebec");

INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 11, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 12, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 13, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 14, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 15, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 16, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 17, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 18, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 19, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 20, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 21, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 22, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 23, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 24, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 25, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 26, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 27, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 28, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 29, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 30, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 31, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 32, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 33, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 34, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 35, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 36, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 37, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 38, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 39, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 40, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 41, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 42, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 43, 80);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 44, 40);
INSERT INTO Contract_Employee(contract_id, employee_id, hours_worked) VALUES(1, 45, 80);

#accounts of these employees
INSERT INTO Account(username,password,account_type) VALUES('filler1','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler2','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler3','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler4','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler5','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler6','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler7','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler8','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler9','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler10','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler11','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler12','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler13','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler14','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler15','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler116','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler17','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler18','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler111','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler20','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler123','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler321','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler654','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('filler645','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('fille645r','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('fill5er','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('f6iller','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('fill5er','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('fi2ller','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('fill1er','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('fil2ler','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('f2iller','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('fill02er','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('fill3er','fillap',4);
INSERT INTO Account(username,password,account_type) VALUES('fi0ller','fillap',4);





