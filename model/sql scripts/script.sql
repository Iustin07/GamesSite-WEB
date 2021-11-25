drop table users;
drop table products;
drop table orders;
drop table order_content;
drop table addresses;

drop trigger order_after_delete_user;
drop trigger order_content_after_delete_order;

create table users
(
    id           int primary key AUTO_INCREMENT,
    fname        varchar(48)        not null,
    lname        varchar(48)        not null,
    email        varchar(50) unique not null,
    phone_number varchar(15),
    password     varchar(100)       not null,
    money_spent  int
);

create table products
(
    id                int primary key AUTO_INCREMENT,
    name              varchar(200) unique,
    type              varchar(15),
    picture_path      varchar(100),
    price             int,
    category          varchar(30),
    age_target        int,
    number_of_players varchar(10),
    rating            float(3, 2),
    numViews          int default 0,
    inStock           int default 0,
    numberSelles      int default 0,
    productYear       int,
    colectional       int default 0
);

create table orders
(
    id_order int primary key auto_increment,
    id_user  int not null,
    payment  int,
    finalized varchar(2) default 'no',
    Constraint FK_idUser FOREIGN KEY (id_user) references users (id)
);

create table order_content
(
    id_order   int,
    id_product int,
    Constraint FK_idOrder FOREIGN KEY (id_order) references orders (id_order) on delete cascade,
    Constraint FK_idProduct FOREIGN KEY (id_product) references products (id) on delete cascade
);

create table if not exists sessions
(
    id      int primary key auto_increment not null,
    id_user int references users (id),
    token   varchar(255)                   not null,
    serial  varchar(255)
);
select *
from products;
create table addresses
(
    id_address    int primary key not null,
    id_user       int references users (id),
    country       varchar(100)    not null,
    state         varchar(200)    not null,
    city          varchar(300)    not null,
    street_name   varchar(200)    not null,
    building      varchar(200)    not null,
    entrance      varchar(10),
    floor         int,
    apartment     int,
    postal_code   varchar(50)     not null
);

create trigger addresses_after_delete_user
    after delete
    on users
    for each row
begin
    delete from addresses where id_user = OLD.id;
end;

create trigger order_after_delete_user
    after delete
    on users
    for each row
begin
    delete from orders where id_user = OLD.id;
end;

create trigger order_content_after_delete_order
    after delete
    on orders
    for each row
begin
    delete from order_content where id_order = OLD.id_order;
end;


insert into users(fname, lname, email, phone_number, password, money_spent)
values ('Daniel', 'Bodnariu', 'daniel.bodnariu@gmail.com', '0729292929', 'nono', 500);

insert into users(fname, lname, email, phone_number, password, money_spent)
values ('Paula', 'Balint', 'paula.balint21@gmail.com', '0792929292', 'pass', 300);

insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('El Grande', 'board', '../product_images/elgrNDE.png', '50', 'strategy', '12', '5-6', '8.6', '300', '5',
        '50', '1995', '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Tichu', 'board', '../product_images/tichu.png', '12', 'cards', '10', '4', '7.6', '100', '1', '100', '1991',
        '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Ra', 'board', '../product_images/ra.jpg', '30', 'strategy', '12', '2-5', '7.5', '150', '1', '15', '1999',
        '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('1830: Railways & Robber Barons', 'board', '../product_images/train.jpg', '100', 'strategy', '14', '2-7',
        '7.9', '70', '2', '66', '1986', '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Civilization', 'board', '../product_images/pic374847.jpg', '150', 'strategy', '12', '2-7', '7.5', '300',
        '2', '45', '1980', '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('LostCitites', 'board', '../product_images/lostcities.jpg', '25', 'strategy', '10', '2', '6.7', '40', '2',
        '35', '1999', '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Blood Bowl (Third Edition)', 'board', '../product_images/blood.jpg', '60', 'strategy', '12', '2', '7.5',
        '5', '2', '65', '1999', '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Catan', 'board', '../product_images/catan.jpg', '25', 'strategy', '10', '3-4', '9', '500', '1', '70',
        '1995', '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Bohnanza', 'board', '../product_images/bohanza.jpg', '7', 'strategy', '13', '2-7', '6.3', '70', '1', '65',
        '1997', '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Times Up', 'board', '../product_images/time.jpg', '12', 'strategy', '12', '4-18', '7.2', '30', '1', '90',
        '1999', '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Wizard', 'board', '../product_images/wizard.jpg', '10', 'strategy', '10', '3-6', '9', '35', '1', '70',
        '1984', '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Wizard2', 'board', '../product_images/wizard.jpg', '10', 'strategy', '9', '3-6', '6.2', '15', '1', '50',
        '1984', '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Wizard3', 'board', '../product_images/wizard.jpg', '10', 'strategy', '8', '3-6', '7.8', '15', '1', '100',
        '1984', '1');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Wizard4', 'board', '../product_images/wizard.jpg', '10', 'strategy', '7', '3-6', '6.5', '15', '1', '60',
        '1984', '1');


insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Time up', 'board', '../product_images/times_up.png', '30', 'strategy', '10', '2-5', '6.5', '70', '30',
        '15', '2011', '0');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Cortex', 'board', '../product_images/cortex.png', '30', 'strategy', '11', '4', '7', '70', '30', '22',
        '2017', '0');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Unstable Unicorns', 'board', '../product_images/unstable-unicorns.jpg', '12', 'strategy', '10', '2-5', '6.5', '70', '30',
        '15', '2011', '0');
insert into products(name, type, picture_path, price, category, age_target, number_of_players, rating, numViews,
                     inStock, numberSelles, productYear, colectional)
values ('Ticket to ride', 'board', '../product_images/ticket-to-ride.png', '50', 'strategy', '11', '4', '7', '70', '30', '22',
        '2017', '0');

insert into orders(id_user, payment)
VALUES ('2', '140');
insert into order_content(id_order, id_product)
VALUES (1, 1);
insert into order_content(id_order, id_product)
VALUES (1, 2);
insert into order_content(id_order, id_product)
VALUES (1, 3);


