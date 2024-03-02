/**
* Все команды по созданию базы данных, пользователей и привязки пользователей к базе я делегировал контейнеру mariadb
* (create database, create user 'username'@'host' identified by 'password', grand all on database.* to 'user'@'host'
* и т. д).
*/

/**
* Using mariadb syntax
*/

create table department(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    department_address varchar(255) null,
    department_phone varchar(15) null
);

create table user(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) not null,
    role ENUM('admin','manager','user')
);

create table event(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    event_manager int not null,
    event_name varchar(255) not null,
    event_location varchar(255) not null,
    event_price float not null,
    event_date date not null,
    Foreign Key (event_manager) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE
);


create table department_event(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    de_date date not null,
    de_time time not null,
    department_id int not null,
    event_id int not null,
    foreign key (department_id) references department(id) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key (event_id) references event(id) ON DELETE CASCADE ON UPDATE CASCADE
);

create table event_record(
    er_id int not null AUTO_INCREMENT primary key,
    client_email VARCHAR(255) not null,
    client_name VARCHAR(255) not null
);
