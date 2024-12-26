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

CREATE TABLE songs (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
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
