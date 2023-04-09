<?php //>

namespace matrix\chat;

trait TouchMessage {

    private function touch($participant, $list) {
        $table = table('ChatMessageLog');

        $conditions = [
            'participant_id' => $participant['id'],
            'message_id' => $list,
            $table->read_time->isNull(),
            $table->deleted_time->isNull(),
        ];

        $logs = $table->filter($conditions)->update(['read_time' => date(cfg('system.timestamp'))]);

        //--

        $table = table('ChatMessage');

        foreach ($logs as $log) {
            $table->filter($log['message_id'])->increase('reader_count');
        }
    }

}
