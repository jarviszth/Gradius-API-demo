/**/
ALTER TABLE vframe_user
ADD COLUMN created_user integer(11) AFTER status,
ADD COLUMN created_date datetime  AFTER created_user,
ADD COLUMN updated_user integer(11) AFTER created_date,
ADD COLUMN updated_date datetime AFTER updated_user



alter table vframe_user add index FKVFRAMEUSER001 (created_user), 
add constraint FKVFRAMEUSER001 foreign key (created_user) references vframe_user (id);


alter table vframe_user add index FKVFRAMETABLE002 (updated_user), 
add constraint FKVFRAMEUSER002 foreign key (updated_user) references vframe_user (id);
