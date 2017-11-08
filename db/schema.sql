DROP TABLE users; 
CREATE TABLE users(user_id integer primary key, email varchar(45), username varchar(25), salt varchar(64), pass varchar(64));

DROP TABLE notifs;
CREATE TABLE notifs(notif_id integer primary key, owner integer, message varchar(50));

DROP TABLE groups;
CREATE TABLE groups(group_id integer primary key, owner integer, name varchar(30));

DROP TABLE members;
CREATE TABLE members(member_id integer primary key, group_id integer, username varchar(25), user_id integer);

DROP TABLE bills;
CREATE TABLE bills(bill_id integer primary key, misc integer, owner integer, group_id integer, name varchar(25), amount real, each real);

DROP TABLE payees;
CREATE TABLE payees(payee_id integer primary key, bill_id integer, user_id integer, username varchar(25), payed integer);