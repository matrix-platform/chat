<?php //>

namespace matrix\chat;

trait NotifyNewMessage {

    private function notify($message) {
        if (@$message['receivers']) {
            $url = cfg('system.event-notify-url');

            foreach ($message['receivers'] as $receiver) {
                @file_get_contents($url . '?' . http_build_query([
                    'type' => 'new-message',
                    'chat_id' => $message['chat_id'],
                    'id' => $receiver,
                ]));
            }
        }
    }

}
