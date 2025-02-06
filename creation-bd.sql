create database starmovie;


use starmovie;


create table users (
	id int(11) unsigned auto_increment primary key,
	name varchar (100),
	lastname varchar (100),
	email varchar (100),
	password varchar (200),
	image varchar (200),
	bio text,
	token varchar (200)
);

create table movies (
	id int(11) unsigned auto_increment primary key,
	title varchar (100),
	description text,
	image varchar (200),
	trailer varchar (100),
	category varchar (45),
	length varchar (50),
	users_id int(11) unsigned,
	foreign key (users_id) references users(id)
);

create table reviews (
	id int(11) unsigned auto_increment primary key,
	rating int,
	review text,
	user_id int(11) unsigned,
	movies_id int(11) unsigned,
	foreign key (user_id) references users(id),
	foreign key (movies_id) references movies(id)
);