drop SCHEMA if EXISTS authentikator;
create SCHEMA authentikator;
set SCHEMA 'authentikator';

CREATE TABLE information(
    email VARCHAR(50) PRIMARY KEY,
    secret VARCHAR(50)
);