<?php //>

namespace matrix\chat;

trait NotifyNewMessage {

    private function notify($message) {
        $url = cfg('system.event-notify-url');

        foreach ($message['participants'] as $participant) {
            @file_get_contents($url . '?' . http_build_query([
                'type' => 'new-message',
                'id' => $participant['chat_member_id'],
                'target_id' => $participant['target_id'],
            ]));
        }
    }

}
