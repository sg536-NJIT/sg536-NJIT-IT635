Steve Grossman IT-635 Database Administration


Overview:

The application consists of a user with read only access called dataselect, and a user with insert, update, delete, and select privileges called datamodify.  
The passwords are as follows.  dataselect/nyyankees datamodify/letsgomets

Please pull down the database export file from the following location: 

server: ftp01.nba.com 
ID: sgrossman 
password: shazb0t  
file name: stats-midterm-db.dmp (its 80 meg)
File is in root directory of the ftp server


Once the database is created.  Please run the following commands as root logged into your mysql server to create the required users before executing php:

create user 'datamodify'@'localhost' identified by 'letsgomets';
create user 'dataselect'@'localhost' identified by 'nyyankees';
grant select, insert, update, delete ON stats.* TO 'datamodify'@'localhost';
grant select ON stats.* TO 'dataselect'@'localhost';
flush privileges;





Deliverables:

1. Add new teams / players to the database
	This is accomplished with two scripts add-player.php and add-team.php
		add-player accepts 3 parameters in the following order Database User, Database password, Player Name
		add-team accepts 5 parameters in the following order Database user, Database password, New Team name, city name, Arena Name

		example: php add-player.php datamodify letsgomets 'Yosemite Sam'
		example: php add-team.php datamodify letsgomets 'Scarlet Knights' 'Newark' 'Pru Center' 


2. Update individual users stats
	This is accomplished with a script called update_player_stats.php
		update_player_stats.php accepts 7 parameters in the following order Database user, Database password, Player Name, Points, Assists, Rebounds, Steals
		 *Full name is required and examples are 'Kobe Bryant' or 'Carmelo Anthony'
		 * This can also be accomplished by performing a lookup with view_player_stats.php

		example: php update_player_stats.php datamodify letsgomets 'Cleanthony Early' 9 9 9 9


3. Update Team affiliations (Associating them with different cities and arenas)
	This is accomplished with a script called update_team_affiliation.php
		update_team_affiliation.php accepts 5 parameters in the following order Database user, Database password, Team Name, City Name, Arena Name
		*This keys on team nickname and a list can be found on nba.com. Examples include Knicks, Lakers, Rockets and it is case sensitive
	
		example: php update_team_affiliation.php datamodify letsgomets Grizzlies Union 'Codey Arena' 


4. Add a game breakdown 
	This is accomplished with a script called add-gamebreakdown.php
		add-gamebreakdown.php accepts 8 parameters including Database user, Database password, game date, winning team nickname, winning team score,
		losing team, losing team score, comments

		example: php add-gamebreakdown.php datamodify letsgomets 3/20/16 Heat 95 Lakers 65 'Kobe looked slow'

5. Search for a team or individual
	This is accomplished with two scripts search_for_team.php and search_for_player.php
		search_for_team.php accepts three parameters in the following order Database user, Database password, Team Nick Name
			*The script has a like clause built in so it will accept partial team names examples include Knicks Mavericks Heat and is case sensitive
		search_for_player.php accepts three parameters in the following order Database, Database password, Player Name
			*The script has a like clause built in so it will accept partial player names examples include 'Kobe Bryant', 'Carmelo Anthony', nthony
			and is case sensitive

		example: php search_for_team.php dataselect nyyankees ick
		example: php search_for_player.php dataselect nyyankees ryant


6. View a players statistics 
		This is accomplished with a script called view_player_stats.php
		view_player_stats.php accepts three parameters including database user, database password, player name
		*The script has a like clause built in so it will accept partial player names examples include 'Kobe Bryant', 'Carmelo Anthony', nthony
		*Statistics returned include cummulative points, assists, rebounds, and steals for the NBA season

		example: php view_player_stats.php dataselect nyyankees thony


7. View a teams statistics
		This is accomplished with a script called view_team_stats.php
		view_team_stats.php accepts three parameters database user, database password, and nickname
		* Paramenters are case sensitive and examples of valid team nicknames include Hawks, Knicks, Lakers, Rockets, Grizzlies

		example: php view_team_stats.php dataselect nyyankees Pelicans

8. View nightly league leaders
		This is accomplished with a script called nightly-leaders.php
		nightly-leaders.php accepts three parameters including database user, database password, date
		***Please note, the data set only goes up as far as 2/23 and there were no games the week of 2/14.  The date format is flexible and accepts almost any
		format as long as it specifies a particular day.  Good sample dates are 1/19 and 1/20
		*** Output provided is the top ten leaders in points, blocks, assists, rebounds, steals

		example: php nightly-leaders.php dataselect nyyankees 2/23/16


		

	