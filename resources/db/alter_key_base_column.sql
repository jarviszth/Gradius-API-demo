alter table products_sales add index FK_PRODUCTSALE_CREATEDUSER (created_user), 
add constraint FK_PRODUCTSALE_CREATEDUSER foreign key (created_user) references app_user (id);


alter table products_sales add index FK_PRODUCTSALE_UPDATEDUSER (updated_user), 
add constraint FK_PRODUCTSALE_UPDATEDUSER foreign key (updated_user) references app_user (id);