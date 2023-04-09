<?php //>

use matrix\db\column\Integer;
use matrix\db\column\Text;
use matrix\db\column\Timestamp;
use matrix\db\Table;

$tbl = new Table('base_chat_message_view');

$tbl->add('participant_id', Integer::class);

$tbl->add('message_id', Integer::class);

$tbl->add('member_id', Integer::class);

$tbl->add('avatar', Text::class);

$tbl->add('name', Text::class);

$tbl->add('content', Text::class);

$tbl->add('data', Text::class);

$tbl->add('reader_count', Integer::class);

$tbl->add('create_time', Timestamp::class);

$tbl->add('cancel_time', Timestamp::class);

return $tbl;
