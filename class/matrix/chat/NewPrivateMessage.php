<?php //>

namespace matrix\chat;

trait NewPrivateMessage {

    use NotifyNewMessage;

    private function createMessage($memberId, $targetId, $type, $content, $data) {
        $chat = $this->getChat($memberId, $targetId);

        if (!$chat) {
            return false;
        }

        $message = model('ChatMessage')->insert([
            'chat_id' => $chat['id'],
            'chat_member_id' => $memberId,
            'type' => $type,
            'content' => $content,
            'data' => json_encode($data, JSON_UNESCAPED_UNICODE),
        ]);

        foreach ($chat['participants'] as $participant) {
            model('ChatMessageLog')->insert([
                'participant_id' => $participant['id'],
                'message_id' => $message['id'],
                'read_time' => ($message['chat_member_id'] === $participant['chat_member_id']) ? date(cfg('system.timestamp')) : null,
            ]);
        }

        $message['participants'] = $chat['participants'];

        return $message;
    }

    private function getChat($memberId, $targetId) {
        $model = model('ChatParticipant');
        $participant = $model->find(['chat_member_id' => $memberId, 'target_id' => $targetId]);

        if ($participant) {
            $chat = model('Chat')->get($participant['chat_id']);
            $chat['participants'] = $model->query(['chat_id' => $chat['id']]);
        } else {
            $members = model('ChatMember')->query(['id' => [$memberId, $targetId]]);

            if (count($members) !== 2) {
                return false;
            }

            $chat = model('Chat')->insert([
                'title' => implode(',', array_column($members, 'name')),
                'type' => 1,
            ]);

            $chat['participants'][] = $model->insert([
                'chat_id' => $chat['id'],
                'chat_member_id' => $members[0]['id'],
                'target_id' => $members[1]['id'],
            ]);

            $chat['participants'][] = $model->insert([
                'chat_id' => $chat['id'],
                'chat_member_id' => $members[1]['id'],
                'target_id' => $members[0]['id'],
            ]);
        }

        return $chat;
    }

}
