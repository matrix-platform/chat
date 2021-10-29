<?php //>

namespace matrix\chat;

use Carbon\Carbon;

trait GetMessages {

    private function getMessages($participant, $lastId = null, $maxSize = 10) {
        $table = table('ChatMessage');

        $conditions = [
            'chat_id' => $participant['chat_id'],
            $table->id->lessThanOrEqual($lastId ?: $participant['last_message_id']),
        ];

        return $this->pack($table->model()->query($conditions, true, $maxSize));
    }

    private function getNewMessages($participant, $lastId = null) {
        $table = table('ChatMessage');

        $conditions = [
            'chat_id' => $participant['chat_id'],
            $table->id->greaterThan($lastId ?: $participant['last_message_id']),
        ];

        $messages = $table->model()->query($conditions);

        if ($messages) {
            $table = table('ChatMessageLog');
            $model = $table->model();

            $conditions = [
                'chat_id' => $participant['chat_id'],
                'receiver_id' => $participant['chat_member_id'],
                $table->read_time->isNull(),
            ];

            $logs = $model->query($conditions);

            if ($logs) {
                $now = date(cfg('system.timestamp'));

                foreach ($logs as $log) {
                    $log['read_time'] = $now;

                    $model->update($log);
                }
            }

            //--

            $participant['last_message_id'] = $messages[0]['id'];

            model('ChatParticipant')->update($participant);
        }

        return $this->pack($messages);
    }

    private function pack($messages) {
        foreach ($messages as &$msg) {
            $time = Carbon::create($msg['create_time']);
            $msg['timestamp'] = $time->getTimestampMs();
        }

        return array_reverse($messages);
    }

}
