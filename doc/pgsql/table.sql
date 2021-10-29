
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
    id              INTEGER   NOT NULL PRIMARY KEY,
    chat_id         INTEGER   NOT NULL,
    chat_member_id  INTEGER   NOT NULL,
    target_id       INTEGER   NOT NULL,
    join_time       TIMESTAMP NOT NULL,
    last_message_id INTEGER       NULL,
    remove_time     TIMESTAMP     NULL
);

CREATE TABLE base_chat_message (
    id             INTEGER   NOT NULL PRIMARY KEY,
    chat_id        INTEGER   NOT NULL,
    chat_member_id INTEGER   NOT NULL,
    type           INTEGER   NOT NULL,  -- 1:text
    content        TEXT      NOT NULL,
    data           TEXT      NOT NULL,
    reader_count   INTEGER   NOT NULL,
    create_time    TIMESTAMP NOT NULL,
    cancel_type    INTEGER       NULL,  -- 1:unsend
    cancel_time    TIMESTAMP     NULL
);

CREATE TABLE base_chat_message_log (
    id          INTEGER   NOT NULL PRIMARY KEY,
    chat_id     INTEGER   NOT NULL,
    message_id  INTEGER   NOT NULL,
    receiver_id INTEGER   NOT NULL,
    read_time   TIMESTAMP     NULL
);

CREATE VIEW base_chat_unread_count AS
     SELECT receiver_id,
            chat_id,
            COUNT(*) as count
       FROM base_chat_message_log
      WHERE read_time IS NULL
   GROUP BY receiver_id,
            chat_id;

