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
INSERT INTO Account(username,password,account_type) VALUES('MOMO','123456',5);
INSERT INTO Account(username,password,account_type) VALUES('Ryan','4588AA',5);
INSERT INTO Account(username,password,account_type) VALUES('Yosuef','BB123',5);
INSERT INTO Account(username,password,account_type)VALUES('HANABANANA','ubadass',5);
INSERT INTO Account(username,password,account_type) VALUES('THUGMAN','nopass',4);
INSERT INTO Account(username,password,account_type) VALUES('WHYYoulikedat','4545A',4);
INSERT INTO Account(username,password,account_type)VALUES('PRINCE EL LYAL','BB123',4);
INSERT INTO Account(username,password,account_type)VALUES('ESHQ HERE','notbada',3);
INSERT INTO Account(username,password,account_type)VALUES('THOMAS ANDRESON','passisme',3);
INSERT INTO Account(username,password,account_type) VALUES('DEVIANT CONOOR','BB123',1);
INSERT INTO Account(username,password,account_type) VALUES('BRADLEY MARTYN','ZOOGYM',2);
INSERT INTO Account(username,password,account_type) VALUES('NICK Power','Strength',2);



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
     
	 
DROP TABLE IF EXISTS Employee;
	 CREATE TABLE IF NOT EXISTS Employee(
    id INT UNSIGNED AUTO_INCREMENT, 
    name VARCHAR(30) NOT NULL,
	user_id INT UNSIGNED,
	contract_type INT UNSIGNED,
	PRIMARY KEY(id),
	FOREIGN KEY(contract_type) REFERENCES Contract_type(id),
    FOREIGN KEY (user_id) REFERENCES Account(id)
) ENGINE=INNODB;
INSERT INTO Employee(name,user_id, contract_type) 
    VALUES("Fred Flintstone", 5, 3);
    
INSERT INTO Employee(name,user_id, contract_type)
    VALUES("Ellen Degeneress", 6,2);
    
INSERT INTO Employee(name,user_id, contract_type)
    VALUES("Max Patches", 7,1);
    


DROP TABLE IF EXISTS Manager;
	 CREATE TABLE IF NOT EXISTS Manager(
    id INT UNSIGNED AUTO_INCREMENT, 
    name VARCHAR(30) NOT NULL,
	user_id INT UNSIGNED,
	 PRIMARY KEY(id),
	 FOREIGN KEY (user_id) REFERENCES Account(id)
) ENGINE=INNODB;
INSERT INTO Manager(name,user_id) 
VALUES("HOMFO MAN",8);
INSERT INTO Manager(name,user_id) 
VALUES("SPIDER GUY",9);


DROP TABLE IF EXISTS SalesAssociate;
CREATE TABLE IF NOT EXISTS SalesAssociate(
 id INT UNSIGNED AUTO_INCREMENT, 
 name VARCHAR(30) NOT NULL,
 user_id INT UNSIGNED,
 PRIMARY KEY(id),
 FOREIGN KEY (user_id) REFERENCES Account(id) 
)ENGINE=INNODB;
INSERT INTO SalesAssociate(name,user_id) 
VALUES("Nicholas Gattuson",11);
INSERT INTO SalesAssociate(name,user_id) 
VALUES("Khaled Jababo",12);

DROP TABLE IF EXISTS Admin;	
CREATE TABLE IF NOT EXISTS Admin(
 id INT UNSIGNED AUTO_INCREMENT, 
 name VARCHAR(30) NOT NULL,
 user_id INT UNSIGNED,
 PRIMARY KEY(id),
 FOREIGN KEY (user_id) REFERENCES Account(id)
) ENGINE=INNODB;
INSERT INTO ADMIN(name,user_id) 
VALUES("BOSS HAMILITON",10);



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
    manager_id INT UNSIGNED,
	client_satisfaction INT,
	CONSTRAINT satisfaction_chk CHECK (client_satisfaction BETWEEN 1 AND 10),
    PRIMARY KEY(id),
    INDEX(contract_type),
    INDEX(service_type),
    INDEX(responsible_id),
    FOREIGN KEY(service_type) REFERENCES Service_type(id),
    FOREIGN KEY(contract_type) REFERENCES Contract_type(id),
    FOREIGN KEY(responsible_id) REFERENCES Responsible(id)
) ENGINE=INNODB;

DROP TABLE IF EXISTS WorksOn;
CREATE TABLE IF NOT EXISTS WorksOn(
contract_id INT UNSIGNED,
employee_id INT UNSIGNED,
manager_id INT UNSIGNED,
PRIMARY KEY(contract_id,employee_id),
FOREIGN KEY(contract_id) REFERENCES Contract(id),
FOREIGN KEY(employee_id) REFERENCES Employee(id),
FOREIGN KEY(manager_id) REFERENCES Manager(id)
)ENGINE=INNODB;



