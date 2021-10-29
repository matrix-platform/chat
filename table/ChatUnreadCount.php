<?php //>

use matrix\db\column\Integer;
use matrix\db\Table;

$tbl = new Table('base_chat_unread_count', false);

$tbl->add('receiver_id', Integer::class);

$tbl->add('chat_id', Integer::class);

$tbl->add('count', Integer::class);

return $tbl;
