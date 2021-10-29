<?php //>

return new class('ChatParticipant') extends matrix\web\backend\ListController {

    protected function init() {
        $table = $this->table();

        $table->add('name', 'member.name');

        $this->columns([
            'name',
            'join_time',
            'view_time',
            'remove_time',
        ]);
    }

};
