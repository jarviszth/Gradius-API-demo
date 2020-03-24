alter table products_sales_detail add index FK_PRODUCTSALESDETAIL_PRODUT (products), 
add constraint FK_PRODUCTSALESDETAIL_PRODUT foreign key (products) references products (id);

