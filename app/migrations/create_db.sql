-- CREATE DATABASE casa_productie_muzica CHARACTER SET=utf8mb4;

-- create the user and grant privileges
-- CREATE USER 'moisauser'@'localhost' IDENTIFIED BY 'moisapass';
-- GRANT ALL ON casa_productie_muzica.* TO 'moisauser'@'localhost';

-- -- create the user and grant privileges
-- CREATE USER 'moisauser'@'127.0.0.1' IDENTIFIED BY 'moisapass';
-- GRANT ALL ON casa_productie_muzica.* TO 'moisauser'@'127.0.0.1';

-- if you run the commans from phpmyadmin, comment the next line
-- USE casa_productie_muzica;

-- create user admin@localhost identified by 'admins_password'


CREATE TABLE user_roles (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) UNIQUE
);

CREATE TABLE users (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(128),
    last_name VARCHAR(128),
    email VARCHAR(255) UNIQUE,
    pwd VARCHAR(128) NOT NULL,
    role_id INTEGER NOT NULL,
    FOREIGN KEY (role_id) REFERENCES user_roles(id) ON DELETE RESTRICT 
);

CREATE TABLE artists (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    join_date DATE NOT NULL,
    origin VARCHAR(255),
    description TEXT  
);
ALTER TABLE artists
ADD image VARCHAR(100);
UPDATE artists
SET image="/casa_productie_muzica/files/eminem.jpg"
WHERE id=1;
UPDATE artists
SET image="/casa_productie_muzica/files/yelawolf.jpg"
WHERE id=2;



CREATE TABLE albums (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128),
    release_date DATE NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    genre VARCHAR(255),
    stoc INTEGER DEFAULT 10,
    artist_id INTEGER NOT NULL,
    FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE RESTRICT
);
ALTER TABLE albums
ADD image VARCHAR(100);
UPDATE albums
SET image="/casa_productie_muzica/files/Recovery.jpg"
WHERE id=1;
UPDATE albums
SET image="/casa_productie_muzica/files/The_Marshall_Mathers_LP.jpg"
WHERE id=2;

CREATE TABLE songs (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    album_id INTEGER NOT NULL,
    length DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (album_id) REFERENCES albums(id) ON DELETE RESTRICT
);

CREATE TABLE achizitie (
    user_id INT,
    album_id INT,
    data DATE,
    number_of_copies INTEGER,
    PRIMARY KEY(user_id,album_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT,
    FOREIGN KEY (album_id) REFERENCES albums(id) ON DELETE RESTRICT 
);


CREATE TABLE migrations (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL UNIQUE,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO user_roles (name) VALUES ('admin');
INSERT INTO user_roles (name) VALUES ('user');
INSERT INTO user_roles (name) VALUES ('guest');

INSERT INTO users (first_name, last_name, email, pwd, role_id) VALUES ('admin', 'admin', 'admin@admin.com', 'admin', 1);
INSERT INTO users (first_name, last_name, email, pwd, role_id) VALUES ('user', 'user', 'user@user.com', 'user', 2);
INSERT INTO users (first_name, last_name, email, pwd, role_id) VALUES ('Andrei','Moisa','andrei@moisa.com',password_hash('BaDcFe',PASSWORD_DEFAULT),1);

INSERT INTO artists (name, join_date,origin, description) VALUES ('Eminem','1999-10-12','Detroit','Marshall Bruce Mathers III (born October 17, 1972), better known by his stage name Eminem 
and by his alter ego Slim Shady, is an American rapper, record producer, songwriter and actor.');
INSERT INTO artists(name,join_date,origin,description)
VALUES ('Yelawolf','2011-06-10','Gadsden','Yelawolf is an underground rapper from a small town in the South who found major-label success in 2011. Born Michael Wayne Atha on December 30,
 1979, in Gadsden, Alabama, he made his full-length album debut with the independent release Creekwater (2005).');


INSERT INTO albums(name,release_date,price,genre,stoc,artist_id)
VALUES ('Recovery','2010-06-18',28.50,'hip-hop',50,1);
INSERT INTO albums(name,release_date,price,genre,stoc,artist_id)
VALUES ('The Marshall Mathers LP','2000-05-23',13.00,'hardcore hip-hop',20,1);
INSERT INTO albums(name,release_date,price,genre,stoc,artist_id)
VALUES ('Love Story','2015-04-22',22.30,'hip-hop',120,2);



INSERT INTO songs(name,album_id,length)
VALUES ('Not Afraid',1,4.09);
INSERT INTO songs(name,album_id,length)
VALUES ('Cold Wind Blows',1,5.04);
INSERT INTO songs(name,album_id,length)
VALUES ("Talkin' 2  Myself",1,5.01);
INSERT INTO songs(name,album_id,length)
VALUES ('On Fire',1,3.34);
INSERT INTO songs(name,album_id,length)
VALUES ("Won't Back Down",1,4.26);
INSERT INTO songs(name,album_id,length)
VALUES ('W.T.P.',1,3.59);
INSERT INTO songs(name,album_id,length)
VALUES ('Going Through Changes',1,4.59);
INSERT INTO songs(name,album_id,length)
VALUES ('Seduction',1,4.36);
INSERT INTO songs(name,album_id,length)
VALUES ('No Love',1,5.15);
INSERT INTO songs(name,album_id,length)
VALUES ('Space Bound',1,4.25);
INSERT INTO songs(name,album_id,length)
VALUES ('Cindarella Man',1,4.39);
INSERT INTO songs(name,album_id,length)
VALUES ('25 To Life',1,4.02);
INSERT INTO songs(name,album_id,length)
VALUES ('So Bad',1,5.26);
INSERT INTO songs(name,album_id,length)
VALUES ('Almost Famous',1,4.53);
INSERT INTO songs(name,album_id,length)
VALUES ('Love The Way You Lie',1,4.27);
INSERT INTO songs(name,album_id,length)
VALUES ("You're never over",1,5.06);
INSERT INTO songs(name,album_id,length)
VALUES ('Untitled',1,3.15);


INSERT INTO songs(name,album_id,length)
VALUES ('Public Service Announcement 2000',2,0.28);
INSERT INTO songs(name,album_id,length)
VALUES ("Kill You",2,4.25);
INSERT INTO songs(name,album_id,length)
VALUES ('Stan',2,6.44);
INSERT INTO songs(name,album_id,length)
VALUES ('Paul(Skit)',2,0.11);
INSERT INTO songs(name,album_id,length)
VALUES ('Who Knew',2,3.48);
INSERT INTO songs(name,album_id,length)
VALUES ('Steve Berman',2,0.54);
INSERT INTO songs(name,album_id,length)
VALUES ('The Way I Am',2,5.03);
INSERT INTO songs(name,album_id,length)
VALUES ('The Real Slim Shady',2,4.29);
INSERT INTO songs(name,album_id,length)
VALUES ('Remember Me?',2,3.39);
INSERT INTO songs(name,album_id,length)
VALUES ("I'm Back",2,5.10);
INSERT INTO songs(name,album_id,length)
VALUES ('Marshall Mathers',2,5.22);
INSERT INTO songs(name,album_id,length)
VALUES ('Ken Kaniff(Skit)',2,1.02);
INSERT INTO songs(name,album_id,length)
VALUES ("Drug Ballad",2,5.01);
INSERT INTO songs(name,album_id,length)
VALUES ('Amityville',2,4.15);
INSERT INTO songs(name,album_id,length)
VALUES ('Bitch Please II',2,4.49);
INSERT INTO songs(name,album_id,length)
VALUES ('Kim',2,6.18);
INSERT INTO songs(name,album_id,length)
VALUES ('Under The Influence',2,5.22);
INSERT INTO songs(name,album_id,length)
VALUES ('Criminal',2,5.20);


INSERT INTO songs(name,album_id,length)
VALUES ("Outer Space",3,4.02);
INSERT INTO songs(name,album_id,length)
VALUES ("Change",3,3.13);
INSERT INTO songs(name,album_id,length)
VALUES ("American You",3,3.38);
INSERT INTO songs(name,album_id,length)
VALUES ("Whiskey In A Bottle",3,4.24);
INSERT INTO songs(name,album_id,length)
VALUES ("Ball And Chain",3,1.36);
INSERT INTO songs(name,album_id,length)
VALUES ("Till It's Gone",3,4.48);
INSERT INTO songs(name,album_id,length)
VALUES ("Devil In My Veins",3,4.03);
INSERT INTO songs(name,album_id,length)
VALUES ("Best Friend",3,5.05);
INSERT INTO songs(name,album_id,length)
VALUES ("Empty Bottles",3,4.18);
INSERT INTO songs(name,album_id,length)
VALUES ("Heartbreak",3,4.26);
INSERT INTO songs(name,album_id,length)
VALUES ("Tennessee Love",3,4.55);
INSERT INTO songs(name,album_id,length)
VALUES ("Box Chevy V",3,4.09);
INSERT INTO songs(name,album_id,length)
VALUES ("Love Story",3,4.14);
INSERT INTO songs(name,album_id,length)
VALUES ("Johnny Cash",3,4.16);
INSERT INTO songs(name,album_id,length)
VALUES ("Have A Great Flight",3,5.04);
INSERT INTO songs(name,album_id,length)
VALUES ("Sky's The Limit",3,4.29);
INSERT INTO songs(name,album_id,length)
VALUES ("Disappear",3,5.15);
INSERT INTO songs(name,album_id,length)
VALUES ("Fiddle Me This",3,3.46);
