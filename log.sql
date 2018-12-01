mysql> create table passenger(  p_id int(11) unsigned zerofill not null auto_increment,
    -> u_id int(11),
    -> t_id int(11),
    -> status varchar(30),
    -> source varchar(30),
    -> destination varchar(30),
    -> t_no int,
    ->type varchar(30),
    -> primary key(p_id)
    -> );


mysql> alter table passenger add foreign key(u_id) references user(u_id);

mysql> alter table passenger add foreign key(t_no) references train(t_no);

mysql>>create table user (u_id int not null auto_increment primary key,first_name varchar(30),last_name varchar(30),email varchar(30),gender varchar(30),age varchar(30),password varchar(30));

>create table train(t_no int primary key,t_name varchar(30),no_of_seats int,start_t varchar(30),start_station varchar(30),end_station varchar(30));

>create table train_status(t_no int primary key,A_seat int,B_seat int,AC_fare varchar(30),g_fare varchar(30),foreign key(t_no) references train(t_no) on update cascade on delete cascade);

>create table station(s_no int primary key,s_name varchar(30),halt varchar(30),arrival_time varchar(30),t_no int,hours varchar(30),foreign key(t_no) references train(t_no) on update cascade on delete cascade);




