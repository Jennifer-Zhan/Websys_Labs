CREATE DATABASE websyslab9 CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE courses( 
	crn int(11), 
	prefix varchar(4) NOT NULL, 
	number smallint(4) NOT NULL, 
	title varchar(255) NOT NULL, 
	PRIMARY KEY (crn)
);

CREATE TABLE students( 
	RIN int(9), 
	RCSID char(7), 
	first_name varchar(100) NOT NULL, 
	last_name varchar(100) NOT NULL, 
	alias varchar(100) NOT NULL, 
	phone bigint(10), 
	PRIMARY KEY (RIN)
);

ALTER TABLE students ADD COLUMN street varchar(100);

ALTER TABLE students ADD COLUMN city varchar(100);

ALTER TABLE students ADD COLUMN state varchar(100);

ALTER TABLE students ADD COLUMN zip int(5);

ALTER TABLE courses ADD COLUMN section int(2);

ALTER TABLE courses ADD COLUMN year int(4);

CREATE TABLE grades( 
	id int(10) AUTO_INCREMENT, 
	crn int, 
	RIN int, 
	grade int(3) NOT NULL, 
	PRIMARY KEY(id), 
	FOREIGN KEY(crn) REFERENCES courses(crn), 
	FOREIGN KEY(RIN) REFERENCES students(RIN)
);

INSERT INTO courses(crn, prefix, number, title, section, year)
VALUES('43694', 'ITWS', '1100', 'INTRO TO IT & WEB SCIENCE', '02', '2020');

INSERT INTO courses(crn, prefix, number, title, section, year)
VALUES('42149', 'ITWS', '1200', 'IT AND SOCIETY', '01', '2020');

INSERT INTO courses(crn, prefix, number, title, section, year)
VALUES('43695', 'ITWS', '2210', 'INTRODUCTION TO HCI', '02', '2020');

INSERT INTO courses(crn, prefix, number, title, section, year)
VALUES('42806', 'ITWS', '4500', 'WEB SCIENCE SYSTEMS DEV', '02', '2020');

INSERT INTO students(RIN, RCSID, first_name, last_name, alias, phone, street, city, state, zip)
VALUES('661978679', 'wuj17', 'Jiahui', 'Wu', 'None', '518258106', 'Burdett Avenue', 'Troy', 'NY', '12180');

INSERT INTO students(RIN, RCSID, first_name, last_name, alias, phone, street, city, state, zip)
VALUES('661963261', 'yangh12', 'Jonathan', 'Yang', 'None', '917346882', 'Burdett Avenue', 'Troy', 'NY', '12180');

INSERT INTO students(RIN, RCSID, first_name, last_name, alias, phone, street, city, state, zip)
VALUES('661963452', 'smithj', 'John', 'Smith', 'John', '947284775', 'Burdett Avenue', 'Troy', 'NY', '12180');

INSERT INTO students(RIN, RCSID, first_name, last_name, alias, phone, street, city, state, zip)
VALUES('661934526', 'jamesl', 'Lebron', 'James', 'Lebron', '9462856388', 'Burdett Avenue', 'Troy', 'NY', '12180');

INSERT INTO `grades`
    (`crn`, `RIN`, `grade`)
VALUES
    (43694, 661978679, 99)
    , (43694, 661963261, 99)
    , (43694, 661963452, 99)
    , (42149, 661963261, 70)
    , (42149, 661934526, 86)
    , (42149, 661978679, 67)
    , (43695, 661963261, 89)
    , (43695, 661978679, 89)
    , (42806, 661934526, 82)
    , (42806, 661978679, 90)
;

SELECT * FROM `students` ORDER BY `RIN`;

SELECT * FROM `students` ORDER BY `last_name`;

SELECT * FROM `students` ORDER BY `RCSID`;

SELECT * FROM `students` ORDER BY `first_name`;

SELECT students.RIN, students.first_name, students.last_name, students.street, students.city, students.state, students.zip FROM `students`, `grades` WHERE grades.grade > 90 and students.RIN = grades.RIN;

SELECT `crn`, AVG(`grade`) FROM `grades` GROUP BY `crn`;

SELECT `crn`, COUNT(`rin`) FROM `grades` GROUP BY `crn`