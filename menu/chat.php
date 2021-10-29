<?php //>

return [

    'chats' => ['icon' => 'fas fa-comments', 'ranking' => 2500, 'parent' => null],

        'chat' => ['icon' => 'fas fa-comment-dots', 'ranking' => 200, 'parent' => 'chats', 'group' => true, 'tag' => 'query'],

            'chat/' => ['parent' => 'chat', 'tag' => 'query'],

            'chat/delete' => ['parent' => 'chat', 'tag' => 'delete'],

            'chat/update' => ['parent' => 'chat', 'tag' => 'update'],

            'chat/participant' => ['parent' => 'chat', 'pattern' => 'chat/{{ id }}/participant', 'group' => true, 'tag' => 'query'],

            'chat/message' => ['parent' => 'chat', 'pattern' => 'chat/{{ id }}/message', 'group' => true, 'tag' => 'query'],

                'chat/message/' => ['parent' => 'chat/message', 'tag' => 'query'],

                'chat/message/update' => ['parent' => 'chat/message', 'tag' => 'update'],

];
