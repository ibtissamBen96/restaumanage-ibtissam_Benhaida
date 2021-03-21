insert into city (name, zipcode) values  ( 'Marrakech', '13266');
insert into city (name, zipcode)  values ('Agadir', '14449');
insert into city (name, zipcode) values  ('Rabat', '17776');
insert into city (name, zipcode) values ('Tanger', '16666');
insert into city (name, zipcode) values ( 'Fes', '13233');






INSERT INTO restau_db.restaurant ( name, description, city_id_id) VALUES ( 'restaurant 1', 'restaurant 1',126);
INSERT INTO restau_db.restaurant ( name, description, city_id_id) VALUES ( 'restaurant 2', 'restaurant 2',126);
INSERT INTO restau_db.restaurant ( name, description, city_id_id) VALUES ( 'restaurant 3', 'restaurant 3',127);
INSERT INTO restau_db.restaurant ( name, description, city_id_id) VALUES ( 'restaurant 4', 'restaurant 4',128);
INSERT INTO restau_db.restaurant ( name, description, city_id_id) VALUES ( 'restaurant 5', 'restaurant 5',129);
INSERT INTO restau_db.restaurant ( name, description, city_id_id) VALUES ( 'restaurant 6', 'restaurant 6',129);
INSERT INTO restau_db.restaurant ( name, description, city_id_id) VALUES ( 'restaurant 7', 'restaurant 7',130);
INSERT INTO restau_db.restaurant ( name, description, city_id_id) VALUES ( 'restaurant 8', 'restaurant 8',130);




INSERT INTO restaurant ( name, description, city_id_id) VALUES ( 'restaurant 1', 'restaurant 1',58);
INSERT INTO restaurant ( name, description, city_id_id) VALUES ( 'restaurant 2', 'restaurant 2',58);
INSERT INTO restaurant ( name, description, city_id_id) VALUES ( 'restaurant 3', 'restaurant 3',58);
INSERT INTO restaurant ( name, description, city_id_id) VALUES ( 'restaurant 4', 'restaurant 4',59);
INSERT INTO restaurant ( name, description, city_id_id) VALUES ( 'restaurant 5', 'restaurant 5',59);
INSERT INTO restaurant ( name, description, city_id_id) VALUES ( 'restaurant 6', 'restaurant 6',60);
INSERT INTO restaurant ( name, description, city_id_id) VALUES ( 'restaurant 7', 'restaurant 7',61);
INSERT INTO restaurant ( name, description, city_id_id) VALUES ( 'restaurant 8', 'restaurant 8',62);

INSERT INTO restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture1', 32);
INSERT INTO restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture2', 33);
INSERT INTO restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture3', 34);
INSERT INTO restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture4', 35);
INSERT INTO restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture1', 36);
INSERT INTO restaurant_picture (filename, restaurant_id_id) VALUES ( 'pecture2', 37);

INSERT INTO user ( username, password, city_id_id) VALUES ( 'Alawi', 'Alawi', 58);
INSERT INTO user ( username, password, city_id_id) VALUES ( 'benhaida', 'benhaida', 59);
INSERT INTO user ( username, password, city_id_id) VALUES ( 'Abad', 'Abad', 58);
INSERT INTO user ( username, password, city_id_id) VALUES ( 'nazih', 'nazih', 60);
INSERT INTO user ( username, password, city_id_id) VALUES ( 'Adnani', 'Adnani', 61);
INSERT INTO user ( username, password, city_id_id) VALUES ( 'sabir', 'sabir', 62);

INSERT INTO review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message1', 3, 6, 32);
INSERT INTO review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message2', 4, 6, 33);
INSERT INTO review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message3', 8, 7, 32);
INSERT INTO review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message4', 2, 8, 34);
INSERT INTO review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message5', 7, 9, 33);
INSERT INTO review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message6', 4, 10, 32);
INSERT INTO review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message7', 5, 6, 35);
INSERT INTO review ( message, rating, user_id_id, restaurant_id_id) VALUES ('message8', 4, 11, 36) ;