/*Create DB Schema as follow*/

create database test;

use test;

CREATE TABLE login (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE users (
  id int(11) NOT NULL auto_increment,
  name varchar(100) NOT NULL,
  age int(3) NOT NULL,
  email varchar(100) NOT NULL,
  status varchar(100) NOT NULL,
  remark varchar(1000) NOT NULL,
  emp_id int(30) NOT NULL,
  home_address varchar(100) NOT NULL,
  last_update varchar(100) NOT NULL,
  mobile_no varchar(100) NOT NULL,
  PRIMARY KEY  (id)
);


CREATE TABLE timeline (
    id int,
    comments varchar(100) NOT NULL,
    timestamp varchar(100) NOT NULL,
    status varchar(100) NOT NULL,
    updated_by varchar(100) NOT NULL,
    FOREIGN KEY (id) REFERENCES users(id)
);




