CREATE TABLE `comment` (
    `comment_id` int(10) unsigned not null auto_increment,
    `user_id` int(10) unsigned default null,
    `entity_id` int(10) unsigned default null,
    `entity_type_id` int(10) unsigned not null,
    `type_id` int(10) unsigned default null,
    `message` text not null,
    `created` datetime not null,
    PRIMARY KEY (`comment_id`)
) charset=utf8;
