-- create the databases
CREATE DATABASE IF NOT EXISTS di_internet_technologies_project;

-- create the users for each database
-- CREATE USER 'webuser'@'%' IDENTIFIED BY 'webpass';
GRANT CREATE, ALTER, INDEX, LOCK TABLES, REFERENCES, UPDATE, DELETE, DROP, SELECT, INSERT ON `di_internet_technologies_project`.* TO 'webuser'@'%';
ALTER USER 'webuser'@'%' IDENTIFIED WITH mysql_native_password BY 'webpass';

FLUSH PRIVILEGES;
