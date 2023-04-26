/**
* Все команды по созданию базы данных, пользователей и привязки пользователей к базе я делегировал контейнеру mariadb
* (create database, create user 'username'@'host' identified by 'password', grand all on database.* to 'user'@'host'
* и т. д).
*/

/**
* Using mariadb syntax
*/

create table department(
    department_id int not null AUTO_INCREMENT primary key,
    department_address varchar(255) null,
    department_phone varchar(15) null
);

create table parent(
    parent_id int not null AUTO_INCREMENT primary key,
    parent_name varchar(255) not null,
    parent_email varchar(255) not null
);

create table child(
    child_id int not null AUTO_INCREMENT primary key,
    child_name varchar(255) not null,
    child_birth date not null,
    parent_id int not null,
    foreign key (parent_id) references parent(parent_id)
);

create table manager(
    manager_id int not null AUTO_INCREMENT primary key,
    manager_login varchar(255) not null,
    manager_password varchar(255) not null
);

create table event(
    event_id int not null AUTO_INCREMENT primary key,
    event_name varchar(255) not null,
    manager_id int not null,
    event_location varchar(255) not null,
    event_price float not null,
    foreign key (manager_id) references manager(manager_id)
);

create table department_event(
    de_id int not null AUTO_INCREMENT primary key,
    de_date date not null,
    de_time time not null,
    department_id int not null,
    event_id int not null,
    foreign key (department_id) references department(department_id),
    foreign key (event_id) references event(event_id)
);

create table event_record(
    er_id int not null AUTO_INCREMENT primary key,
    er_date date not null,
    de_id int not null,
    child_id int not null,
    foreign key (de_id) references department_event(de_id),
    foreign key (child_id) references child(child_id)
);


insert into parent(parent_name, parent_email) values("Maria Lungu", 'lunmaria@gmail.com');
insert into manager(manager_login, manager_password) values("toadski@gmail.com", 'ca03e4b0d6a8a08f400264b5e45fb441');
insert into event(event_name, manager_id, event_location, event_price) values('Origami', 1, 'Bulevardul Dimitrie Cantemir 6', 65);
insert into event(event_name, manager_id, event_location, event_price) values('Clay crafting', 1, 'Strada Mihai Viteazul 10/1', 110);