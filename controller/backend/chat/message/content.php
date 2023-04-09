<?php //>

return new class('ChatMessage') extends matrix\web\backend\GetController {

    protected function init() {
        $table = $this->table();
        $table->chat_member_id->invisible(true);
        $table->add('name', 'member.name');
    }

};
