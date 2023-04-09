<?php //>

use matrix\db\column\Integer;
use matrix\db\Table;

$tbl = new Table('base_chat_latest_message');

$tbl->add('message_id', Integer::class)
    ->associate('message', 'ChatMessage');

return $tbl;
