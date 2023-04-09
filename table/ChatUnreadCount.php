<?php //>

use matrix\db\column\Integer;
use matrix\db\Table;

$tbl = new Table('base_chat_unread_count');

$tbl->add('count', Integer::class);

return $tbl;
