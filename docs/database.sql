DROP DATABASE IF EXISTS anitop;
CREATE DATABASE anitop;

USE anitop;

CREATE TABLE anime (
    animeid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    studio VARCHAR(200) NOT NULL,
    publisher VARCHAR(200) NOT NULL,
    image TEXT NOT NULL
);

CREATE TABLE genre (
    genreid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE animegenre (
    animegenreid INT PRIMARY KEY AUTO_INCREMENT,
    anime INT NOT NULL UNIQUE,
    genre INT NOT NULL,
    
    FOREIGN KEY(anime) REFERENCES anime(animeid),
    FOREIGN KEY(genre) REFERENCES genre(genreid)
);

CREATE TABLE status (
    statusid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(200) NOT NULL UNIQUE
);

CREATE TABLE user (
    userid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    email VARCHAR(250) NOT NULL UNIQUE,
    password VARCHAR(200) NOT NULL UNIQUE
);

CREATE TABLE watchlist (
    watchlistid INT PRIMARY KEY AUTO_INCREMENT,
    user INT NOT NULL,
    anime INT NOT NULL,
    status INT NOT NULL,
    active BOOLEAN NOT NULL,
    
    FOREIGN KEY(user) REFERENCES user(userid),
    FOREIGN KEY(anime) REFERENCES anime(animeid),
    FOREIGN KEY(status) REFERENCES status(statusid)
);