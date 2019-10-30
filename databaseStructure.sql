DROP DATABASE blogpro;
-- Create database

CREATE DATABASE blogpro;

USE blogpro;

-- Create table users

CREATE TABLE  users (
	id SMALLINT UNSIGNED AUTO_INCREMENT,
	pseudo VARCHAR(50) NOT NULL,
	email VARCHAR(250) NOT NULL,
	password VARCHAR(255) NOT NULL,
	created_at DATETIME NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8;


-- Create table posts

CREATE TABLE  posts (
	id SMALLINT UNSIGNED AUTO_INCREMENT,
	user_id SMALLINT UNSIGNED,
    published TINYINT DEFAULT 0,
	title VARCHAR(100) NOT NULL,
	slug VARCHAR(100) NOT NULL,
	resume TINYTEXT NOT NULL,
	content TEXT NOT NULL,
	picture VARCHAR(255) default 'https://picsum.photos/400', 
	created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8;


-- Create table category

CREATE TABLE  categories (
	id SMALLINT UNSIGNED AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	created_at DATETIME NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8;


-- Create table posts_categories

CREATE TABLE  posts_categories (
	post_id SMALLINT NOT NULL,
	category_id SMALLINT NOT NULL,
	PRIMARY KEY (post_id, category_id)
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8;


-- Create table comments

CREATE TABLE  comments (
	id SMALLINT UNSIGNED AUTO_INCREMENT,
	user_id SMALLINT UNSIGNED,
    post_id SMALLINT UNSIGNED,
    validate TINYINT DEFAULT 0,
	content TEXT NOT NULL,
	created_at DATETIME NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8;


-- Create index

CREATE UNIQUE INDEX ind_uni_email
ON users (email);

CREATE UNIQUE INDEX ind_uni_pseudo
ON users (pseudo);

CREATE UNIQUE INDEX ind_uni_title
ON posts (title);

-- Add foreign keys

ALTER TABLE posts
ADD CONSTRAINT fk_user_id 
    FOREIGN KEY (user_id)
	REFERENCES users (id)
		ON DELETE SET NULL;

ALTER TABLE comments 
ADD CONSTRAINT fk_comment_user_id 
    FOREIGN KEY (user_id)
	REFERENCES users (id)
		ON UPDATE RESTRICT;

ALTER TABLE comments 
ADD CONSTRAINT fk_comment_post_id 
    FOREIGN KEY (post_id)
	REFERENCES posts (id)
		ON UPDATE RESTRICT;


