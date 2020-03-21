CREATE TABLE `comment` (
    `comment_id` int(10) unsigned not null auto_increment,
    `entity_id` int(10) unsigned default null,
    `entity_type_id` int(10) unsigned not null,
    `type_id` int(10) unsigned default null,
    `user_id` int(10) unsigned default null,
    `name` varchar(255) default null,
    `message` text not null,
    `created` datetime not null,
    PRIMARY KEY (`comment_id`),
    KEY `entity_type_id_type_id` (`entity_type_id`, `type_id`)
) CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
