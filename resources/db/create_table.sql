    create table otep_member_sintitution (
        `id` int(11) not null AUTO_INCREMENT,
				`member_name` VARCHAR(255) null,
				`details` text,
				
				`status` VARCHAR(1) null,
        `created_user` int(11),
        `created_date` datetime null,
        `updated_user` int(11),
        `updated_date` datetime null,
        primary key (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;




alter table otep_member_sintitution add index FKOTEPMEMBERINSTITUTION001 (created_user), 
add constraint FKOTEPMEMBERINSTITUTION001 foreign key (created_user) references vframe_user (id);


alter table otep_member_sintitution add index FKOTEPMEMBERINSTITUTION002 (updated_user), 
add constraint FKOTEPMEMBERINSTITUTION002 foreign key (updated_user) references vframe_user (id);

