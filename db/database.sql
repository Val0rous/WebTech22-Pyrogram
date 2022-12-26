-- Database Section
-- ________________ 

CREATE DATABASE pyrogram;
USE pyrogram;


-- Tables Section
-- _____________ 

CREATE TABLE comments (
     comment_id char(16) NOT NULL,
     content varchar(8192) NOT NULL,
     comment_time datetime NOT NULL,
     user_id varchar(30) NOT NULL,
     post_id char(16) NOT NULL,
     CONSTRAINT id_comments PRIMARY KEY (comment_id));

CREATE TABLE followings (
     user_id_followed varchar(30) NOT NULL,
     user_id_following varchar(30) NOT NULL,
     CONSTRAINT id_followings PRIMARY KEY (user_id_followed, user_id_following));

CREATE TABLE likes (
     post_id char(16) NOT NULL,
     user_id varchar(30) NOT NULL,
     CONSTRAINT id_likes PRIMARY KEY (user_id, post_id));

CREATE TABLE messages (
     message_id char(16) NOT NULL,
     content varchar(8192),
     media_path varchar(4096),
     message_time datetime NOT NULL,
     user_id_sender varchar(30) NOT NULL,
     user_id_receiver varchar(30) NOT NULL,
     CONSTRAINT id_messages PRIMARY KEY (message_id));

CREATE TABLE notifications (
     notification_id char(16) NOT NULL,
     content varchar(256) NOT NULL,
     notification_type varchar(10) NOT NULL,      -- this one may be useless later on, keep an eye on it
     notification_time datetime NOT NULL,
     read_status char(1) NOT NULL,
     user_id varchar(30) NOT NULL,                -- user who will receive a notification
     follower_id varchar(30),
     post_id char(16),
     story_id char(16),
     CONSTRAINT id_notifications PRIMARY KEY (notification_id));

CREATE TABLE posts (
     post_id char(16) NOT NULL,
     content varchar(16384),
     media_path varchar(4096),
     post_time datetime NOT NULL,
     num_likes int NOT NULL,
     num_comments int NOT NULL,
     num_tags int NOT NULL,
     user_id varchar(30) NOT NULL,
     CONSTRAINT id_posts PRIMARY KEY (post_id));

CREATE TABLE replies (
     reply_id char(16) NOT NULL,
     content varchar(8192) NOT NULL,
     reply_time datetime NOT NULL,
     story_id char(16) NOT NULL,
     user_id varchar(30) NOT NULL,
     CONSTRAINT id_replies PRIMARY KEY (reply_id));

CREATE TABLE stories (
     story_id char(16) NOT NULL,
     media_path varchar(4096) NOT NULL,
     story_time datetime NOT NULL,
     expiration_time datetime NOT NULL,
     user_id varchar(30) NOT NULL,
     CONSTRAINT id_stories PRIMARY KEY (story_id));

CREATE TABLE tags (
     user_id varchar(30) NOT NULL,
     post_id char(16) NOT NULL,
     CONSTRAINT id_tags PRIMARY KEY (user_id, post_id));

CREATE TABLE users (
     user_id varchar(30) NOT NULL,
     user_name varchar(128) NOT NULL,
     user_email varchar(320) NOT NULL,
     user_password varchar(128) NOT NULL,
     user_picture_path varchar(4096) NOT NULL,
     user_bio varchar(256),
     account_active_status char(1) NOT NULL,      -- true if account is enabled
     num_posts int NOT NULL,
     num_followers int NOT NULL,
     num_following int NOT NULL,
     CONSTRAINT id_users PRIMARY KEY (user_id));


-- Constraints Section
-- ___________________ 

ALTER TABLE comments ADD CONSTRAINT fk_user_comment
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE comments ADD CONSTRAINT fk_post_comment
     FOREIGN KEY (post_id)
     REFERENCES posts (post_id);

ALTER TABLE followings ADD CONSTRAINT fk_user_following
     FOREIGN KEY (user_id_following)
     REFERENCES users (user_id);

ALTER TABLE followings ADD CONSTRAINT fk_user_followed
     FOREIGN KEY (user_id_followed)
     REFERENCES users (user_id);

ALTER TABLE likes ADD CONSTRAINT fk_user_liker
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE likes ADD CONSTRAINT fk_post_liked
     FOREIGN KEY (post_id)
     REFERENCES posts (post_id);

ALTER TABLE messages ADD CONSTRAINT fk_sender
     FOREIGN KEY (user_id_sender)
     REFERENCES users (user_id);

ALTER TABLE messages ADD CONSTRAINT fk_receiver
     FOREIGN KEY (user_id_receiver)
     REFERENCES users (user_id);

ALTER TABLE notifications ADD CONSTRAINT fk_user_notifications
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);

ALTER TABLE notifications ADD CONSTRAINT fk_follower_notifications
     FOREIGN KEY (user_id)
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

ALTER TABLE tags ADD CONSTRAINT fk_post_tag
     FOREIGN KEY (post_id)
     REFERENCES posts (post_id);

ALTER TABLE tags ADD CONSTRAINT fk_user_tag
     FOREIGN KEY (user_id)
     REFERENCES users (user_id);
