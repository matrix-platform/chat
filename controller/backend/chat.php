<?php //>

return new class('Chat') extends matrix\web\backend\ListController {

    protected function init() {
        $table = $this->table();

        $table->add('participant_count', 'participant.count');
        $table->add('message_count', 'message.count');

        $this->columns([
            'title',
            'type',
            'create_time',
            'participant_count',
            'message_count',
        ]);
    }

};
