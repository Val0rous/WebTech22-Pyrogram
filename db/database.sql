-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 20 2021              
-- * Generation date: Sun Dec 25 01:22:59 2022 
-- * LUN file: /home/francesco/Desktop/WebDev-Project/db/Social_Network_TW.lun 
-- * Schema: pyrogram/1 
-- ********************************************* 


-- Database Section
-- ________________ 

CREATE DATABASE pyrogram;
USE pyrogram;


-- Tables Section
-- _____________ 

CREATE TABLE comments (
     comment_id char(16) NOT NULL,
     content varchar(MAX) NOT NULL,
     comment_time datetime NOT NULL,
     user_id varchar(MAX) NOT NULL,
     post_id char(16) NOT NULL,
     CONSTRAINT IDCOMMENTS PRIMARY KEY (comment_id));

CREATE TABLE followings (
     user_id_followed varchar(MAX) NOT NULL,
     user_id_following varchar(MAX) NOT NULL,
     CONSTRAINT IDFOLLOWINGS PRIMARY KEY (user_id_followed, user_id_following));

CREATE TABLE likes (
     post_id char(16) NOT NULL,
     user_id varchar(MAX) NOT NULL,
     CONSTRAINT IDLIKES PRIMARY KEY (user_id, post_id));

CREATE TABLE messages (
     message_id char(16) NOT NULL,
     content varchar(MAX),
     media_path varchar(MAX),
     message_time datetime NOT NULL,
     user_id_sender varchar(MAX) NOT NULL,
     user_id_receiver varchar(MAX) NOT NULL,
     CONSTRAINT IDMESSAGES PRIMARY KEY (message_id));

CREATE TABLE notifications (
     notification_id char(16) NOT NULL,
     content varchar(MAX) NOT NULL,
     notification_type varchar(MAX) NOT NULL,     -- this one may be useless later on, keep an eye on it
     notification_time datetime NOT NULL,
     read_status char(1) NOT NULL,
     user_id varchar(MAX) NOT NULL,
     CONSTRAINT IDNOTIFICATIONS PRIMARY KEY (notification_id));

CREATE TABLE posts (
     post_id char(16) NOT NULL,
     content varchar(MAX),
     media_path varchar(MAX),
     post_time datetime NOT NULL,
     num_likes int NOT NULL,
     num_comments int NOT NULL,
     num_tags int NOT NULL,
     user_id varchar(MAX) NOT NULL,
     CONSTRAINT IDPOSTS PRIMARY KEY (post_id));

CREATE TABLE replies (
     reply_id char(16) NOT NULL,
     content varchar(MAX) NOT NULL,
     reply_time datetime NOT NULL,
     story_id char(16) NOT NULL,
     user_id varchar(MAX) NOT NULL,
     CONSTRAINT IDREPLIES PRIMARY KEY (reply_id));

CREATE TABLE stories (
     story_id char(16) NOT NULL,
     media_path varchar(MAX) NOT NULL,
     story_time datetime NOT NULL,
     expiration_time datetime NOT NULL,
     user_id varchar(MAX) NOT NULL,
     CONSTRAINT IDSTORIES PRIMARY KEY (story_id));

CREATE TABLE tags (
     user_id varchar(MAX) NOT NULL,
     post_id char(16) NOT NULL,
     CONSTRAINT IDTAGS PRIMARY KEY (user_id, post_id));

CREATE TABLE users (
     user_id varchar(MAX) NOT NULL,
     user_name varchar(MAX) NOT NULL,
     user_email varchar(MAX) NOT NULL,
     user_password varchar(128) NOT NULL,
     user_picture_path varchar(MAX) NOT NULL,
     num_posts int NOT NULL,
     num_followers int NOT NULL,
     num_following int NOT NULL,
     CONSTRAINT IDUSERS PRIMARY KEY (user_id));


-- Constraints Section
-- ___________________ 

ALTER TABLE comments ADD CONSTRAINT FKUSER_COMMENT
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE comments ADD CONSTRAINT FKPOST_COMMENT
     FOREIGN KEY (post_id)
     REFERENCES posts (post_id);

ALTER TABLE followings ADD CONSTRAINT FKUSER_FOLLOWING
     FOREIGN KEY (user_id_following)
     REFERENCES users (user_id);

ALTER TABLE followings ADD CONSTRAINT FKUSER_FOLLOWED
     FOREIGN KEY (user_id_followed)
     REFERENCES users (user_id);

ALTER TABLE likes ADD CONSTRAINT FKUSER_LIKER
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE likes ADD CONSTRAINT FKPOST_LIKED
     FOREIGN KEY (post_id)
     REFERENCES posts (post_id);

ALTER TABLE messages ADD CONSTRAINT FKSENDER
     FOREIGN KEY (user_id_sender)
     REFERENCES users (user_id);

ALTER TABLE messages ADD CONSTRAINT FKRECEIVER
     FOREIGN KEY (user_id_receiver)
     REFERENCES users (user_id);

ALTER TABLE notifications ADD CONSTRAINT FKUSER_NOTIFICATIONS
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE posts ADD CONSTRAINT FKUPLOADING_POST
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE replies ADD CONSTRAINT FKSTORY_REPLY
     FOREIGN KEY (story_id)
     REFERENCES stories (story_id);

ALTER TABLE replies ADD CONSTRAINT FKUSER_REPLY
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE stories ADD CONSTRAINT FKUPLOADING_STORY
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE tags ADD CONSTRAINT FKPOST_TAG
     FOREIGN KEY (post_id)
     REFERENCES posts (post_id);

ALTER TABLE tags ADD CONSTRAINT FKUSER_TAG
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);


-- Index Section
-- _____________ 

