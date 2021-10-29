<?php //>

use matrix\db\column\CreateTime;
use matrix\db\column\Integer;
use matrix\db\column\Text;
use matrix\db\Table;

$tbl = new Table('base_chat');

$tbl->add('title', Text::class)
    ->required(true);

$tbl->add('type', Integer::class)
    ->default(1)
    ->options(load_options('chat-type'))
    ->readonly(true)
    ->required(true);

$tbl->add('create_time', CreateTime::class)
    ->required(true);

$tbl->id->composite('participant', 'ChatParticipant');
$tbl->id->composite('message', 'ChatMessage');

return $tbl;
