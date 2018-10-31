mysql> create table passenger(  p_id int(11) unsigned zerofill not null auto_increment,
    -> u_id int(11),
    -> t_id int(11),
    -> status varchar(30),
    -> source varchar(30),
    -> destination varchar(30),
    -> t_no int,
    -> primary key(p_id,u_id)
    -> );


mysql> alter table passenger add foreign key(u_id) references user(u_id);

mysql> alter table passenger add foreign key(t_no) references train(t_no);