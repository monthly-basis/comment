CREATE TABLE `comment` (
    `comment_id` int(10) unsigned not null auto_increment,
    `entity_id` int(10) unsigned default null,
    `entity_type_id` int(10) unsigned not null,
    `type_id` int(10) unsigned default null,
    `user_id` int(10) unsigned default null,
    `name` varchar(255) default null,
    `message` text not null,
    `created` datetime not null,
    PRIMARY KEY (`comment_id`)
) charset=utf8;
