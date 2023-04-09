<?php //>

return new class('ChatMessage') extends matrix\web\backend\ListController {

    protected function init() {
        $table = $this->table();

        $table->add('name', 'member.name');

        $this->columns([
            'name',
            'type',
            'content',
            'reader_count',
            'create_time',
            'cancel_time',
        ]);
    }

};
