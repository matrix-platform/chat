<?php //>

use matrix\db\column\Image;
use matrix\db\column\Integer;
use matrix\db\column\Text;
use matrix\db\Table;

$tbl = new Table('base_chat_member');

$tbl->add('type', Integer::class)
    ->options(load_options('chat-member-type'));

$tbl->add('name', Text::class);

$tbl->add('avatar', Image::class);

return $tbl;
