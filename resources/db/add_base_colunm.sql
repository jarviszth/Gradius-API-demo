
ALTER TABLE ats_forums
ADD COLUMN created_user integer(11),
ADD COLUMN created_date datetime  AFTER created_user,
ADD COLUMN updated_user integer(11) AFTER created_date,
ADD COLUMN updated_date datetime AFTER updated_user;

alter table ats_forums add index FK_ATSFORUMS_CREATEDUSER (created_user), 
add constraint FK_ATSFORUMS_CREATEDUSER foreign key (created_user) references app_user (id);


alter table ats_forums add index FK_ATSFORUMS_UPDATEDUSER (updated_user), 
add constraint FK_ATSFORUMS_UPDATEDUSER foreign key (updated_user) references app_user (id);
