<?php //>

use matrix\db\column\Integer;
use matrix\db\column\Timestamp;
use matrix\db\Table;

$tbl = new Table('base_chat_message_log', false);

$tbl->add('participant_id', Integer::class)
    ->associate('participant', 'ChatParticipant', true)
    ->readonly(true)
    ->required(true);

$tbl->add('message_id', Integer::class)
    ->associate('message', 'ChatMessage', true)
    ->readonly(true)
    ->required(true);

$tbl->add('read_time', Timestamp::class);

$tbl->add('deleted_time', Timestamp::class);

return $tbl;
