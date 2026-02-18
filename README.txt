create user 'mytic'@'localhost' identified by 'tictactoe123';
grant all on tictactoe.* to 'mytic'@'localhost' with grant option;
flush privileges;

then run the summary.sql database.

Please alter the applicaton/config/config.php as may be required.