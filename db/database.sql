-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 20 2021              
-- * Generation date: Sat Dec 24 18:13:24 2022 
-- * LUN file: /home/francesco/Desktop/WebDev-Project/db/Social_Network_TW.lun 
-- * Schema: Social_Network_Relational/1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database Social_Network_Relational;
use Social_Network_Relational;


-- Tables Section
-- _____________ 

create table COMMENTS (
     comment_ID char(16) not null,
     content varchar(1) not null,
     time date not null,
     username varchar(1) not null,
     post_ID char(16) not null,
     constraint IDCOMMENTS primary key (comment_ID));

create table FOLLOWINGS (
     username_followed varchar(1) not null,
     username_following varchar(1) not null,
     constraint IDFOLLOWINGS primary key (username_followed, username_following));

create table LIKES (
     post_ID char(16) not null,
     username varchar(1) not null,
     constraint IDLIKES primary key (username, post_ID));

create table MESSAGES (
     message_ID char(16) not null,
     content varchar(1),
     media char(69),
     time date not null,
     sender_username varchar(1) not null,
     receiver_username varchar(1) not null,
     constraint IDMESSAGES primary key (message_ID));

create table NOTIFICATIONS (
     notification_ID char(16) not null,
     content varchar(1) not null,
     type (???) char(69) not null,
     time date not null,
     read_status char not null,
     username varchar(1) not null,
     constraint IDNOTIFICATIONS primary key (notification_ID));

create table POSTS (
     post_ID char(16) not null,
     content varchar(1),
     media char(69),
     num_likes int not null,
     num_comments int not null,
     num_tags int not null,
     username varchar(1) not null,
     constraint IDPOSTS primary key (post_ID));

create table REPLIES (
     reply_ID char(16) not null,
     content varchar(1) not null,
     time date not null,
     story_ID char(16) not null,
     username varchar(1) not null,
     constraint IDREPLIES primary key (reply_ID));

create table STORIES (
     story_ID char(16) not null,
     media char(69) not null,
     posting_time date not null,
     expiration_time date not null,
     username varchar(1) not null,
     constraint IDSTORIES primary key (story_ID));

create table TAGS (
     username varchar(1) not null,
     post_ID char(16) not null,
     constraint IDTAGS primary key (username, post_ID));

create table USERS (
     username varchar(1) not null,
     email varchar(1) not null,
     password varchar(1) not null,
     profile_pic char(69) not null,
     num_posts int not null,
     num_followers int not null,
     num_following int not null,
     constraint IDUSERS primary key (username));


-- Constraints Section
-- ___________________ 

alter table COMMENTS add constraint FKUSER_COMMENT
     foreign key (username)
     references USERS (username);

alter table COMMENTS add constraint FKPOST_COMMENT
     foreign key (post_ID)
     references POSTS (post_ID);

alter table FOLLOWINGS add constraint FKUSER_FOLLOWING
     foreign key (username_following)
     references USERS (username);

alter table FOLLOWINGS add constraint FKUSER_FOLLOWED
     foreign key (username_followed)
     references USERS (username);

alter table LIKES add constraint FKUSER_LIKER
     foreign key (username)
     references USERS (username);

alter table LIKES add constraint FKPOST_LIKED
     foreign key (post_ID)
     references POSTS (post_ID);

alter table MESSAGES add constraint FKSENDER
     foreign key (sender_username)
     references USERS (username);

alter table MESSAGES add constraint FKRECEIVER
     foreign key (receiver_username)
     references USERS (username);

alter table NOTIFICATIONS add constraint FKUSER_NOTIFICATIONS
     foreign key (username)
     references USERS (username);

alter table POSTS add constraint FKUPLOADING_POST
     foreign key (username)
     references USERS (username);

alter table REPLIES add constraint FKSTORY_REPLY
     foreign key (story_ID)
     references STORIES (story_ID);

alter table REPLIES add constraint FKUSER_REPLY
     foreign key (username)
     references USERS (username);

alter table STORIES add constraint FKUPLOADING_STORY
     foreign key (username)
     references USERS (username);

alter table TAGS add constraint FKPOST_TAG
     foreign key (post_ID)
     references POSTS (post_ID);

alter table TAGS add constraint FKUSER_TAG
     foreign key (username)
     references USERS (username);


-- Index Section
-- _____________ 

