if EXISTS drop SCHEMA authen;
create SCHEMA 'authen';

CREATE TABLE information(
    email VARCHAR(50) PRIMARY KEY,
    secret VARCHAR(50)
);