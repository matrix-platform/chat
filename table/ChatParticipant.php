<?php //>

use matrix\db\column\CreateTime;
use matrix\db\column\Integer;
use matrix\db\column\Timestamp;
use matrix\db\Table;

$tbl = new Table('base_chat_participant', false);

$tbl->add('chat_id', Integer::class)
    ->associate('chat', 'Chat', true)
    ->readonly(true)
    ->required(true);

$tbl->add('chat_member_id', Integer::class)
    ->associate('member', 'ChatMember')
    ->readonly(true)
    ->required(true);

$tbl->add('target_id', Integer::class)
    ->invisible(true)
    ->readonly(true)
    ->required(true);

$tbl->add('join_time', CreateTime::class)
    ->required(true);

$tbl->add('last_message_id', Integer::class);

$tbl->add('remove_time', Timestamp::class);

return $tbl;
