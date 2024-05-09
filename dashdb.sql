CREATE TABLE register (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(25) NOT NULL,
    lastname VARCHAR(25) NOT NULL,
    email VARCHAR(25) NOT NULL,
    password VARCHAR(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;
INSERT INTO register (email, firstname, password) VALUES('admin@gmail.com','Admin' ,'123');


CREATE TABLE dash (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    office VARCHAR(255) NOT NULL,
    age INT (255) NOT NULL,
    startdate date NOT NULL,
    salary INT (255) NOT NULL
     );


SELECT DATE_FORMAT(startdate, '%d/%m/%Y') AS formatted_date FROM dash;
