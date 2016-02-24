CREATE USER statsfeed@`%`
;
GRANT USAGE ON *.* TO `statsfeed`@`%`
    IDENTIFIED BY 'letsgomets'
    WITH MAX_QUERIES_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0
;
GRANT SELECT ON statsAdmin.* TO `statsfeed`@`%`
;
GRANT INSERT ON statsAdmin.* TO `statsfeed`@`%`
;
GRANT UPDATE ON statsAdmin.* TO `statsfeed`@`%`
;
GRANT DELETE ON statsAdmin.* TO `statsfeed`@`%`
;
GRANT CREATE ON statsAdmin.* TO `statsfeed`@`%`
;
GRANT DROP ON statsAdmin.* TO `statsfeed`@`%`
;
GRANT REFERENCES ON statsAdmin.* TO `statsfeed`@`%`
;
GRANT INDEX ON statsAdmin.* TO `statsfeed`@`%`
;
GRANT ALTER ON statsAdmin.* TO `statsfeed`@`%`
;
GRANT CREATE TEMPORARY TABLES ON statsAdmin.* TO `statsfeed`@`%`
;
GRANT LOCK TABLES ON statsAdmin.* TO `statsfeed`@`%`
;
GRANT SELECT ON stats.* TO `statsfeed`@`%`
;
GRANT INSERT ON stats.* TO `statsfeed`@`%`
;
GRANT UPDATE ON stats.* TO `statsfeed`@`%`
;
GRANT DELETE ON stats.* TO `statsfeed`@`%`
;
GRANT CREATE ON stats.* TO `statsfeed`@`%`
;
GRANT DROP ON stats.* TO `statsfeed`@`%`
;
GRANT REFERENCES ON stats.* TO `statsfeed`@`%`
;
GRANT INDEX ON stats.* TO `statsfeed`@`%`
;
GRANT ALTER ON stats.* TO `statsfeed`@`%`
;
GRANT CREATE TEMPORARY TABLES ON stats.* TO `statsfeed`@`%`
;
GRANT LOCK TABLES ON stats.* TO `statsfeed`@`%`
;
CREATE USER webapp@`%`
;
GRANT USAGE ON *.* TO `webapp`@`%`
    IDENTIFIED BY 'letsgomets'
    WITH MAX_QUERIES_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0
;
GRANT SELECT ON modules.* TO `webapp`@`%`
;
GRANT INSERT ON modules.* TO `webapp`@`%`
;
GRANT UPDATE ON modules.* TO `webapp`@`%`
;
GRANT DELETE ON modules.* TO `webapp`@`%`
;
GRANT CREATE ON modules.* TO `webapp`@`%`
;
GRANT DROP ON modules.* TO `webapp`@`%`
;
GRANT REFERENCES ON modules.* TO `webapp`@`%`
;
GRANT INDEX ON modules.* TO `webapp`@`%`
;
GRANT ALTER ON modules.* TO `webapp`@`%`
;
GRANT CREATE TEMPORARY TABLES ON modules.* TO `webapp`@`%`
;
GRANT LOCK TABLES ON modules.* TO `webapp`@`%`
;
GRANT SELECT ON stats.* TO `webapp`@`%`
;
GRANT INSERT ON stats.* TO `webapp`@`%`
;
GRANT UPDATE ON stats.* TO `webapp`@`%`
;
GRANT DELETE ON stats.* TO `webapp`@`%`
;
GRANT CREATE ON stats.* TO `webapp`@`%`
;
GRANT DROP ON stats.* TO `webapp`@`%`
;
GRANT REFERENCES ON stats.* TO `webapp`@`%`
;
GRANT INDEX ON stats.* TO `webapp`@`%`
;
GRANT ALTER ON stats.* TO `webapp`@`%`
;
GRANT CREATE TEMPORARY TABLES ON stats.* TO `webapp`@`%`
;
GRANT LOCK TABLES ON stats.* TO `webapp`@`%`
;
