
CREATE VIEW base_chat_member AS
     SELECT id,
            1 as type,
            name,
            avatar
       FROM base_member;

CREATE TABLE base_chat (
    id          INTEGER   NOT NULL PRIMARY KEY,
    title       TEXT      NOT NULL,
    type        INTEGER   NOT NULL,  -- 1:private, 2:group
    create_time TIMESTAMP NOT NULL
);

CREATE TABLE base_chat_participant (
    id             INTEGER   NOT NULL PRIMARY KEY,
    chat_id        INTEGER   NOT NULL,
    chat_member_id INTEGER   NOT NULL,
    target_id      INTEGER   NOT NULL,
    join_time      TIMESTAMP NOT NULL,
    remove_time    TIMESTAMP     NULL
);

CREATE TABLE base_chat_message (
    id             INTEGER   NOT NULL PRIMARY KEY,
    chat_id        INTEGER   NOT NULL,
    chat_member_id INTEGER   NOT NULL,
    type           INTEGER   NOT NULL,  -- 1:text, 2:combo
    content        TEXT          NULL,
    data           TEXT      NOT NULL,
    reader_count   INTEGER   NOT NULL,
    create_time    TIMESTAMP NOT NULL,
    cancel_time    TIMESTAMP     NULL
);

CREATE TABLE base_chat_message_log (
    id             INTEGER   NOT NULL PRIMARY KEY,
    participant_id INTEGER   NOT NULL,
    message_id     INTEGER   NOT NULL,
    read_time      TIMESTAMP     NULL,
    deleted_time   TIMESTAMP     NULL
);

CREATE VIEW base_chat_unread_count AS
     SELECT participant_id AS id,
            COUNT(*) as count
       FROM base_chat_message_log
      WHERE read_time IS NULL
        AND deleted_time IS NULL
   GROUP BY participant_id;

CREATE VIEW base_chat_latest_message AS
     SELECT participant_id AS id,
            MAX(message_id) as message_id
       FROM base_chat_message_log
      WHERE deleted_time IS NULL
   GROUP BY participant_id;

CREATE VIEW base_chat_message_view AS
     SELECT A.id,
            A.participant_id,
            A.message_id,
            C.id AS member_id,
            C.avatar,
            C.name,
            B.content,
            B.data,
            B.reader_count,
            B.create_time,
            B.cancel_time
       FROM base_chat_message_log AS A
       JOIN base_chat_message AS B ON (B.id = A.message_id)
       JOIN base_chat_member AS C ON (C.id = B.chat_member_id)
      WHERE A.deleted_time IS NULL;

