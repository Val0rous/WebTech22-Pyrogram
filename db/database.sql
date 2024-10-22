-- Database Section
-- ________________ 

CREATE DATABASE pyrogram;
USE pyrogram;


-- Tables Section
-- _____________ 

CREATE TABLE comments (
     comment_id char(16) NOT NULL,
     content text NOT NULL,
     comment_time datetime NOT NULL,
     user_id varchar(30) NOT NULL,
     post_id char(16) NOT NULL,
     CONSTRAINT pk_id_comments PRIMARY KEY (comment_id));

CREATE TABLE followings (
     user_id_following varchar(30) NOT NULL,
     user_id_followed varchar(30) NOT NULL,
     CONSTRAINT pk_id_followings PRIMARY KEY (user_id_followed, user_id_following));

CREATE TABLE likes (
     user_id varchar(30) NOT NULL,
     post_id char(16) NOT NULL,
     CONSTRAINT pk_id_likes PRIMARY KEY (user_id, post_id));

CREATE TABLE messages (
     message_id char(16) NOT NULL,
     content text,
     media_path text,
     message_time datetime NOT NULL,
     user_id_sender varchar(30) NOT NULL,
     user_id_receiver varchar(30) NOT NULL,
     CONSTRAINT pk_id_messages PRIMARY KEY (message_id));

CREATE TABLE notifications (
     notification_id char(16) NOT NULL,
     content tinytext NOT NULL,
     notification_type char(1) NOT NULL,      -- this one may be useless later on, keep an eye on it
     notification_time datetime NOT NULL,
     read_status char(1) NOT NULL,
     user_id varchar(30) NOT NULL,                -- user who will receive a notification
     sender_id varchar(30) NOT NULL,              -- user who sent a notification
     post_id char(16),
     story_id char(16),
     CONSTRAINT pk_id_notifications PRIMARY KEY (notification_id));

CREATE TABLE posts (
     post_id char(16) NOT NULL,
     content text,
     media_path0 text,
     media_path1 text,
     media_path2 text,
     media_path3 text,
     media_path4 text,
     media_path5 text,
     media_path6 text,
     media_path7 text,
     media_path8 text,
     media_path9 text,
     location varchar(64),
     post_time datetime NOT NULL,
     num_likes int NOT NULL,
     num_comments int NOT NULL,
     num_tags int NOT NULL,
     user_id varchar(30) NOT NULL,
     CONSTRAINT pk_id_posts PRIMARY KEY (post_id));

CREATE TABLE replies (
     reply_id char(16) NOT NULL,
     content text NOT NULL,
     reply_time datetime NOT NULL,
     story_id char(16) NOT NULL,
     user_id varchar(30) NOT NULL,
     CONSTRAINT pk_id_replies PRIMARY KEY (reply_id));

CREATE TABLE stories (
     story_id char(16) NOT NULL,
     media_path text NOT NULL,
     story_time datetime NOT NULL,
     expiration_time datetime NOT NULL,
     user_id varchar(30) NOT NULL,
     CONSTRAINT pk_id_stories PRIMARY KEY (story_id));

CREATE TABLE tags (
     user_id varchar(30) NOT NULL,
     post_id char(16) NOT NULL,
     CONSTRAINT pk_id_tags PRIMARY KEY (user_id, post_id));

CREATE TABLE users (
     user_id varchar(30) NOT NULL,
     user_name varchar(128) NOT NULL,
     user_email varchar(320) NOT NULL,
     user_password varchar(128) BINARY NOT NULL,
     user_picture_path text NOT NULL,
     user_bio tinytext NOT NULL,                  -- '' if empty
     account_active_status char(1) NOT NULL,      -- true if account is enabled
     num_posts int NOT NULL,
     num_followers int NOT NULL,
     num_following int NOT NULL,
     CONSTRAINT pk_id_users PRIMARY KEY (user_id),
     CONSTRAINT uc_email_users UNIQUE (user_email));


-- Constraints Section
-- ___________________ 

ALTER TABLE comments ADD CONSTRAINT fk_user_comment
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE comments ADD CONSTRAINT fk_post_comment
     FOREIGN KEY (post_id)
     REFERENCES posts (post_id);

ALTER TABLE followings ADD CONSTRAINT fk_user_followed
     FOREIGN KEY (user_id_followed)
     REFERENCES users (user_id);

ALTER TABLE followings ADD CONSTRAINT fk_user_following
     FOREIGN KEY (user_id_following)
     REFERENCES users (user_id);

ALTER TABLE likes ADD CONSTRAINT fk_post_liked
     FOREIGN KEY (post_id)
     REFERENCES posts (post_id);

ALTER TABLE likes ADD CONSTRAINT fk_user_liker
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE messages ADD CONSTRAINT fk_sender
     FOREIGN KEY (user_id_sender)
     REFERENCES users (user_id);

ALTER TABLE messages ADD CONSTRAINT fk_receiver
     FOREIGN KEY (user_id_receiver)
     REFERENCES users (user_id);

ALTER TABLE notifications ADD CONSTRAINT fk_user_notifications
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE notifications ADD CONSTRAINT fk_sender_notifications
     FOREIGN KEY (sender_id)
     REFERENCES users (user_id);

ALTER TABLE notifications ADD CONSTRAINT fk_post_notifications
     FOREIGN KEY (post_id)
     REFERENCES posts (post_id);

ALTER TABLE notifications ADD CONSTRAINT fk_story_notifications
     FOREIGN KEY (story_id)
     REFERENCES stories (story_id);

ALTER TABLE posts ADD CONSTRAINT fk_uploading_post
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE replies ADD CONSTRAINT fk_story_reply
     FOREIGN KEY (story_id)
     REFERENCES stories (story_id);

ALTER TABLE replies ADD CONSTRAINT fk_user_reply
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE stories ADD CONSTRAINT fk_uploading_story
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE tags ADD CONSTRAINT fk_user_tag
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE tags ADD CONSTRAINT fk_post_tag
     FOREIGN KEY (post_id)
     REFERENCES posts (post_id);
