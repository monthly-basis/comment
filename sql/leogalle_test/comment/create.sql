CREATE TABLE `comment` (
    `comment_id` int(10) unsigned not null auto_increment,
    `message` text not null,
    `created` datetime not null,
    PRIMARY KEY (`comment_id`)
) charset=utf8;
