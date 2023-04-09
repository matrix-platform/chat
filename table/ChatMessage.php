<?php //>

use matrix\db\column\CreateTime;
use matrix\db\column\Integer;
use matrix\db\column\Text;
use matrix\db\column\Timestamp;
use matrix\db\Table;

$tbl = new Table('base_chat_message', false);

$tbl->add('chat_id', Integer::class)
    ->associate('chat', 'Chat', true)
    ->readonly(true)
    ->required(true);

$tbl->add('chat_member_id', Integer::class)
    ->associate('member', 'ChatMember')
    ->readonly(true)
    ->required(true);

$tbl->add('type', Integer::class)
    ->options(load_options('chat-message-type'))
    ->readonly(true)
    ->required(true);

$tbl->add('content', Text::class)
    ->readonly(true);

$tbl->add('data', Text::class)
    ->invisible(true)
    ->readonly(true)
    ->required(true);

$tbl->add('reader_count', Integer::class)
    ->default(0)
    ->readonly(true)
    ->required(true);

$tbl->add('create_time', CreateTime::class)
    ->required(true);

$tbl->add('cancel_time', Timestamp::class);

$tbl->ranking('-id');

return $tbl;
