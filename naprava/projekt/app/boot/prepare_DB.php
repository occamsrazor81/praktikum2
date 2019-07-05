<?php

// Manualno inicijaliziramo bazu ako veÄ‡ nije.
require_once __DIR__.'/../../model/db.class.php';

$db = DB::getConnection();

$has_tables = false;

try
{
	$st = $db->prepare(
		'SHOW TABLES LIKE :tblname'
	);

	$st->execute( array( 'tblname' => 'project_users' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

	$st->execute( array( 'tblname' => 'project_members' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

	$st->execute( array( 'tblname' => 'project_leagues' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

	$st->execute( array( 'tblname' => 'project_players' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;


	$st->execute( array( 'tblname' => 'project_player_stats' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

	$st->execute( array( 'tblname' => 'project_teams' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

	$st->execute( array( 'tblname' => 'project_weekly_matchups' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;


	$st->execute( array( 'tblname' => 'project_league_tables' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

	$st->execute( array( 'tblname' => 'project_trades' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

}
catch( PDOException $e ) { exit( "PDO error [show tables]: " . $e->getMessage() ); }


if( $has_tables )
{
	exit( 'Tablice  vec postoje. Obrisite ih pa probajte ponovno.' );
}



//users
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS project_users (' .
		'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'username varchar(50) NOT NULL,' .
		'password_hash varchar(255) NOT NULL,'.
		'email varchar(50) NOT NULL,' .
		'registration_sequence varchar(20) NOT NULL,' .
		'has_registered int,'.
		'bank_account double)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create project_users]: " . $e->getMessage() ); }

echo "Napravio tablicu project_users.<br />";


//leagues
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS project_leagues (' .
		'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'id_user int NOT NULL,' .
		'title varchar(50) NOT NULL,' .
		'number_of_members int NOT NULL,' .
		'week int NOT NULL,' .
		'day int NOT NULL,' .
		'trade_deadline int NOT NULL,' .
		'league_type varchar(20) NOT NULL,'.
		'status varchar(10) NOT NULL)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create project_leagues]: " . $e->getMessage() ); }

echo "Napravio tablicu project_leagues.<br />";



//members
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS project_members (' .
		'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'id_league int NOT NULL,' .
		'id_user int NOT NULL,' .
		'member_type varchar(20) NOT NULL)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create project_members]: " . $e->getMessage() ); }

echo "Napravio tablicu project_members.<br />";



//players
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS project_players (' .
		'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'name varchar(40) NOT NULL,'.
		'position varchar(5) NOT NULL)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create project_players]: " . $e->getMessage() ); }

echo "Napravio tablicu project_players.<br />";


//player_stats
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS project_player_stats (' .
		'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'id_player int NOT NULL,' .
		'FGM int,' .
		'FGA int,' .
		'FG_PERC double,' .
		'FTM int,' .
		'FTA int,' .
		'FT_PERC double,' .
		'3PTM int,' .
		'PTS int,' .
		'REB int,' .
		'AST int,' .
		'ST int,' .
		'BLK int,' .
		'TOV int,' .
		'week int NOT NULL,'.
		'day int NOT NULL)'

	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create project_player_stats]: " . $e->getMessage() ); }

echo "Napravio tablicu project_player_stats.<br />";


//teams
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS project_teams (' .
		'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'team_name varchar(30) NOT NULL,' .
		'id_league int NOT NULL,' .
		'id_user int NOT NULL,' .
		'id_player int NOT NULL,' .
		'points int)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create project_teams]: " . $e->getMessage() ); }

echo "Napravio tablicu project_teams.<br />";


//weekly matchups
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS project_weekly_matchups (' .
		'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'id_league int NOT NULL,' .
		'id_user1 int NOT NULL,' .
		'id_user2 int NOT NULL,'.
		'week int NOT NULL,' .
		'FGM1 int,' .
		'FGA1 int,' .
		'FG_PERC1 double,' .
		'FTM1 int,' .
		'FTA1 int,' .
		'FT_PERC1 double,' .
		'3PTM1 int,' .
		'PTS1 int,' .
		'REB1 int,' .
		'AST1 int,' .
		'ST1 int,' .
		'BLK1 int,' .
		'TO1 int,' .
		'FGM2 int,' .
		'FGA2 int,' .
		'FG_PERC2 double,' .
		'FTM2 int,' .
		'FTA2 int,' .
		'FT_PERC2 double,' .
		'3PTM2 int,' .
		'PTS2 int,' .
		'REB2 int,' .
		'AST2 int,' .
		'ST2 int,' .
		'BLK2 int,' .
		'TO2 int)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create project_weekly_matchups]: " . $e->getMessage() ); }

echo "Napravio tablicu project_weekly_matchups.<br />";


//league tables
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS project_league_tables (' .
		'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'id_league int NOT NULL,' .
		'id_team int NOT NULL,' .
		'position int NOT NULL,' .
		'team_points int)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create project_league_tables]: " . $e->getMessage() ); }

echo "Napravio tablicu project_league_tables.<br />";


//trades
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS project_trades (' .
		'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'id_league int NOT NULL,' .
		'id_team1 int NOT NULL,' .
		'id_team2 int NOT NULL,' .
		'id_player1 int NOT NULL,' .
		'id_player11 int,' .
		'id_player12 int,' .
		'id_player21 int,' .
		'id_player22 int NULL,' .
		'id_player2 int NOT NULL,'.
		'trade_status varchar(30) NOT NULL)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create project_trades]: " . $e->getMessage() ); }

echo "Napravio tablicu project_trades.<br />";


//project_draft
try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS project_draft (' .
		'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'id_league int NOT NULL,' .
		'id_user int NOT NULL,' .
		'lastModified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,'. //CURRENT TIMESTAMP
		'current_number int NOT NULL,' .
		'starting_number int NOT NULL)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create project_draft]: " . $e->getMessage() ); }

echo "Napravio tablicu project_draft.<br />";








// Ubaci neke korisnike unutra
try
{
	$st = $db->prepare( 'INSERT into project_users(username, password_hash, email, registration_sequence, has_registered, bank_account) VALUES (:username, :password, \'a@b.com\', \'abc\', \'1\', :bank_account)' );

	$st->execute( array( 'username' => 'mirko', 'password' => password_hash( 'mirkovasifra', PASSWORD_DEFAULT ), 'bank_account' => 50 ) );
	$st->execute( array( 'username' => 'ana', 'password' => password_hash( 'aninasifra', PASSWORD_DEFAULT ), 'bank_account' => 150 ) );
	$st->execute( array( 'username' => 'maja', 'password' => password_hash( 'majinasifra', PASSWORD_DEFAULT ), 'bank_account' => 200 ) );
	$st->execute( array( 'username' => 'slavko', 'password' => password_hash( 'slavkovasifra', PASSWORD_DEFAULT ), 'bank_account' => 30 ) );
	$st->execute( array( 'username' => 'pero', 'password' => password_hash( 'perinasifra', PASSWORD_DEFAULT ), 'bank_account' => 45.5 ) );
}
catch( PDOException $e ) { exit( "PDO error [insert project_users]: " . $e->getMessage() ); }

echo "Ubacio u tablicu project_users.<br />";

//players insert
try
{
	$st = $db->prepare( 'INSERT into project_players(name,position) VALUES (:name, :position)' );

	$st->execute(array('name' => 'Anthony Davis', 'position' => 'PF')); //1
	$st->execute(array('name' => 'James Harden', 'position' => 'SG'));
	$st->execute(array('name' => 'Paul George', 'position' => 'SF'));
	$st->execute(array('name' => 'Stephen Curry', 'position' => 'PG'));
	$st->execute(array('name' => 'Giannis Antetokounmpo', 'position' => 'PF'));
	$st->execute(array('name' => 'Karl Anthony Towns', 'position' => 'C'));
	$st->execute(array('name' => 'Kawhi Leonard', 'position' => 'SF'));
	$st->execute(array('name' => 'Kevin Durant', 'position' => 'SF'));
	$st->execute(array('name' => 'Joel Embiid', 'position' => 'C'));
	$st->execute(array('name' => 'Kyrie Irving', 'position' => 'PG'));
	$st->execute(array('name' => 'Nikola Vucevic', 'position' => 'C'));
	$st->execute(array('name' => 'Nikola Jokic', 'position' => 'C'));
	$st->execute(array('name' => 'Damian Lillard', 'position' => 'PG'));
	$st->execute(array('name' => 'Bradley Beal', 'position' => 'SG'));
	$st->execute(array('name' => 'Jimmy Butler', 'position' => 'SG'));
	$st->execute(array('name' => 'Rudy Gobert', 'position' => 'C'));
	$st->execute(array('name' => 'Kemba Walker', 'position' => 'PG'));
	$st->execute(array('name' => 'Andre Drummond', 'position' => 'C'));
	$st->execute(array('name' => 'LaMarcus Aldridge', 'position' => 'PF'));
	$st->execute(array('name' => 'LeBron James', 'position' => 'SF'));
	$st->execute(array('name' => 'Chris Paul', 'position' => 'PG'));
	$st->execute(array('name' => 'Brook Lopez', 'position' => 'C'));
	$st->execute(array('name' => 'Tobias Harris', 'position' => 'PF'));
	$st->execute(array('name' => 'Klay Thompson', 'position' => 'SG'));
	$st->execute(array('name' => 'Myles Turner', 'position' => 'C'));
	$st->execute(array('name' => 'Mike Conley', 'position' => 'PG'));
	$st->execute(array('name' => 'Jrue Holiday', 'position' => 'SG'));
	$st->execute(array('name' => 'Clint Capela', 'position' => 'C'));
	$st->execute(array('name' => 'Al Horford', 'position' => 'C'));
	$st->execute(array('name' => 'Russell Westbrook', 'position' => 'PG'));
	$st->execute(array('name' => 'Danilo Gallinari', 'position' => 'SF'));
	$st->execute(array('name' => 'Deandre Ayton', 'position' => 'C'));
	$st->execute(array('name' => 'Kyle Lowry', 'position' => 'PG'));
	$st->execute(array('name' => 'DeMar DeRozan', 'position' => 'SG'));
	$st->execute(array('name' => 'DeMarcus Cousins', 'position' => 'C'));
	$st->execute(array('name' => 'Khris Middleton', 'position' => 'SF'));
	$st->execute(array('name' => 'Pascal Siakam', 'position' => 'PF'));
	$st->execute(array('name' => 'Buddy Hield', 'position' => 'SG'));
	$st->execute(array('name' => 'Lauri Markkanen', 'position' => 'PF'));
	$st->execute(array('name' => 'Victor Oladipo', 'position' => 'SG'));
	$st->execute(array('name' => 'Jerami Grant', 'position' => 'PF'));
	$st->execute(array('name' => 'Devin Booker', 'position' => 'PG'));
	$st->execute(array('name' => 'Josh Richardson', 'position' => 'SF'));
	$st->execute(array('name' => 'Bojan Bogdanovic', 'position' => 'SF'));
	$st->execute(array('name' => 'CJ Mccollum', 'position' => 'SG'));
	$st->execute(array('name' => 'TJ Warren', 'position' => 'PF'));
	$st->execute(array('name' => 'D\'Angelo Russell', 'position' => 'PG'));
	$st->execute(array('name' => 'Jason Tatum', 'position' => 'SF'));
	$st->execute(array('name' => 'Blake Griffin', 'position' => 'PF'));
	$st->execute(array('name' => 'Draymond Green', 'position' => 'PF'));
	$st->execute(array('name' => 'Donovan Mitchell', 'position' => 'SG'));
	$st->execute(array('name' => 'Luka Doncic', 'position' => 'PG'));
	$st->execute(array('name' => 'Julius Randle', 'position' => 'PF'));
	$st->execute(array('name' => 'Lou Williams', 'position' => 'SG'));
	$st->execute(array('name' => 'Ben Simmons', 'position' => 'PG'));
	$st->execute(array('name' => 'Robert Covington', 'position' => 'SF'));
	$st->execute(array('name' => 'Jeremy Lamb', 'position' => 'SG'));
	$st->execute(array('name' => 'Otto Porter Jr', 'position' => 'SF'));
	$st->execute(array('name' => 'Evan Fournier', 'position' => 'SF'));
	$st->execute(array('name' => 'Thaddeus Young', 'position' => 'PF'));




//Point Guard = 12
//Shooting Guard = 12
//Small Forward = 12
//Power Forward = 12
//Center = 12


}
catch( PDOException $e ) { exit( "PDO error [insert project_players]: " . $e->getMessage() ); }

echo "Ubacio u tablicu project_players.<br />";
//

// //ubaci statse
// try
// {
// 	$st = $db->prepare('INSERT into project_player_stats(id_player, FGM, FGA, FG_PERC,
// 	FTM, FTA, FT_PERC, 3PTM, PTS, REB, AST, ST, BLK, TOV, week, day)
// 	values (:id_player,:fgm, :fga, :fg_perc, :ftm, :fta, :ft_perc, :3ptm,
// 		:pts, :reb, :ast, :st, :blk, :tov, :week, :day)');
//
// 	$st->execute(array('id_player' => 1, 'fgm' => 7, 'fga' => 20, 'fg_perc' => 35.0,
// 'ftm' => 6, 'fta' => 7, 'ft_perc' => 85.7, '3ptm' => 0, 'pts' => 20, 'reb' => 8,
// 'ast' => 1, 'st' => 0, 'blk' => 2, 'tov' => 5, 'week' => 1, 'day' => 2));
//
//
//
//
//
// }
// catch( PDOException $e ) { exit( "PDO error [insert project_player_stats]: " . $e->getMessage() ); }
//
// echo "Ubacio u tablicu project_player_stats.<br />";
//



try
{
 $st = $db->prepare('INSERT into project_player_stats(id_player, FGM, FGA, FG_PERC,
 FTM, FTA, FT_PERC, 3PTM, PTS, REB, AST, ST, BLK, TOV, week, day)
 values (:id_player,:fgm, :fga, :fg_perc, :ftm, :fta, :ft_perc, :3ptm,
	 :pts, :reb, :ast, :st, :blk, :tov, :week, :day)');


///Davis
$st->execute(array('id_player' => 1, 'fgm' => 7, 'fga' => 20, 'fg_perc' => 35.0,
'ftm' => 6, 'fta' => 7, 'ft_perc' => 85.7, '3ptm' => 0, 'pts' => 20, 'reb' => 8,
'ast' => 1, 'st' => 0, 'blk' => 1, 'tov' => 5, 'week' => 1, 'day' => 2));

//+
$st->execute(array('id_player' => 1, 'fgm' => 13, 'fga' => 24, 'fg_perc' => 54.2,
'ftm' => 4, 'fta' => 7, 'ft_perc' => 57.1, '3ptm' => 2, 'pts' => 32, 'reb' => 15,
'ast' => 7, 'st' => 1, 'blk' => 4, 'tov' => 4, 'week' => 1, 'day' => 4));

//+
$st->execute(array('id_player' => 1, 'fgm' => 7, 'fga' => 18, 'fg_perc' => 38.9,
'ftm' => 12, 'fta' => 12, 'ft_perc' => 100.0, '3ptm' => 0, 'pts' => 26, 'reb' => 13,
'ast' => 6, 'st' => 1, 'blk' => 2, 'tov' => 1, 'week' => 1, 'day' => 7));

//+
$st->execute(array('id_player' => 1, 'fgm' => 11, 'fga' => 20, 'fg_perc' => 55.0,
'ftm' => 2, 'fta' => 2, 'ft_perc' => 100.0, '3ptm' => 1, 'pts' => 25, 'reb' => 20,
'ast' => 6, 'st' => 0, 'blk' => 2, 'tov' => 4, 'week' => 2, 'day' => 2));



	 //+
$st->execute(array('id_player' => 1, 'fgm' => 9, 'fga' => 25, 'fg_perc' => 36.0,
'ftm' => 9, 'fta' => 10, 'ft_perc' => 90.0, '3ptm' => 2, 'pts' => 29, 'reb' => 11,
'ast' => 2, 'st' => 2, 'blk' => 4, 'tov' => 0, 'week' => 2, 'day' => 4));


//+
$st->execute(array('id_player' => 1, 'fgm' => 16, 'fga' => 25, 'fg_perc' => 64.0,
'ftm' => 10, 'fta' => 15, 'ft_perc' => 66.7, '3ptm' => 1, 'pts' => 43, 'reb' => 17,
'ast' => 5, 'st' => 1, 'blk' => 1, 'tov' => 2, 'week' => 2, 'day' => 6));




//+
$st->execute(array('id_player' => 1, 'fgm' => 10, 'fga' => 20, 'fg_perc' => 50.0,
'ftm' => 20, 'fta' => 21, 'ft_perc' => 95.2, '3ptm' => 0, 'pts' => 40, 'reb' => 8,
'ast' => 8, 'st' => 0, 'blk' => 1, 'tov' => 0, 'week' => 2, 'day' => 7));

			 //+
$st->execute(array('id_player' => 1, 'fgm' => 13, 'fga' => 22, 'fg_perc' => 59.1,
'ftm' => 3, 'fta' => 3, 'ft_perc' => 100.0, '3ptm' => 0, 'pts' => 29, 'reb' => 9,
'ast' => 4, 'st' => 2, 'blk' => 2, 'tov' => 2, 'week' => 3, 'day' => 2));

			 //+
$st->execute(array('id_player' => 1, 'fgm' => 4, 'fga' => 13, 'fg_perc' => 30.8,
'ftm' => 4, 'fta' => 7, 'ft_perc' => 57.1, '3ptm' => 0, 'pts' => 12, 'reb' => 16,
'ast' => 6, 'st' => 5, 'blk' => 5, 'tov' => 2, 'week' => 3, 'day' => 4));

//+
$st->execute(array('id_player' => 1, 'fgm' => 12, 'fga' => 19, 'fg_perc' => 63.2,
'ftm' => 8, 'fta' => 10, 'ft_perc' => 80.0, '3ptm' => 1, 'pts' => 33, 'reb' => 11,
'ast' => 4, 'st' => 0, 'blk' => 0, 'tov' => 0, 'week' => 3, 'day' => 6));



////////////Harden
$st->execute(array('id_player' => 2, 'fgm' => 8, 'fga' => 17, 'fg_perc' => 47.1,
'ftm' => 10, 'fta' => 13, 'ft_perc' => 76.9, '3ptm' => 3, 'pts' => 29, 'reb' => 4,
'ast' => 8, 'st' => 2, 'blk' => 1, 'tov' => 5, 'week' => 1, 'day' => 2));

$st->execute(array('id_player' => 2, 'fgm' => 5, 'fga' => 16, 'fg_perc' => 31.3,
'ftm' => 3, 'fta' => 3, 'ft_perc' => 100.0, '3ptm' => 2, 'pts' => 15, 'reb' => 6,
'ast' => 2, 'st' => 0, 'blk' => 0, 'tov' => 7, 'week' => 1, 'day' => 5));

$st->execute(array('id_player' => 2, 'fgm' => 11, 'fga' => 22, 'fg_perc' => 50.0,
'ftm' => 7, 'fta' => 7, 'ft_perc' => 100.0, '3ptm' => 6, 'pts' => 35, 'reb' => 4,
'ast' => 8, 'st' => 1, 'blk' => 1, 'tov' => 6, 'week' => 1, 'day' => 7));

$st->execute(array('id_player' => 2, 'fgm' => 10, 'fga' => 21, 'fg_perc' => 47.6,
'ftm' => 5, 'fta' => 7, 'ft_perc' => 71.4, '3ptm' => 4, 'pts' => 29, 'reb' => 1,
'ast' => 4, 'st' => 1, 'blk' => 0, 'tov' => 2, 'week' => 2, 'day' => 3));

$st->execute(array('id_player' => 2, 'fgm' => 14, 'fga' => 26, 'fg_perc' => 53.8,
'ftm' => 18, 'fta' => 19, 'ft_perc' => 94.7, '3ptm' => 4, 'pts' => 50, 'reb' => 10,
'ast' => 11, 'st' => 2, 'blk' => 0, 'tov' => 6, 'week' => 2, 'day' => 5));

$st->execute(array('id_player' => 2, 'fgm' => 9, 'fga' => 14, 'fg_perc' => 64.3,
'ftm' => 11, 'fta' => 13, 'ft_perc' => 84.6, '3ptm' => 3, 'pts' => 32, 'reb' => 12,
'ast' => 10, 'st' => 2, 'blk' => 0, 'tov' => 5, 'week' => 2, 'day' => 7));

$st->execute(array('id_player' => 2, 'fgm' => 14, 'fga' => 31, 'fg_perc' => 45.2,
'ftm' => 15, 'fta' => 16, 'ft_perc' => 93.8, '3ptm' => 4, 'pts' => 47, 'reb' => 6,
'ast' => 5, 'st' => 5, 'blk' => 0, 'tov' => 5, 'week' => 3, 'day' => 2));

$st->execute(array('id_player' => 2, 'fgm' => 10, 'fga' => 18, 'fg_perc' => 55.6,
'ftm' => 9, 'fta' => 9, 'ft_perc' => 100.0, '3ptm' => 6, 'pts' => 35, 'reb' => 3,
'ast' => 9, 'st' => 2, 'blk' => 0, 'tov' => 2, 'week' => 3, 'day' => 4));

$st->execute(array('id_player' => 2, 'fgm' => 7, 'fga' => 23, 'fg_perc' => 30.4,
'ftm' => 15, 'fta' => 18, 'ft_perc' => 83.3, '3ptm' => 6, 'pts' => 35, 'reb' => 6,
'ast' => 12, 'st' => 2, 'blk' => 0, 'tov' => 3, 'week' => 3, 'day' => 5));

$st->execute(array('id_player' => 2, 'fgm' => 12, 'fga' => 34, 'fg_perc' => 35.3,
'ftm' => 8, 'fta' => 9, 'ft_perc' => 88.9, '3ptm' => 7, 'pts' => 39, 'reb' => 4,
'ast' => 10, 'st' => 2, 'blk' => 0, 'tov' => 3, 'week' => 3, 'day' => 7));




//George
$st->execute(array('id_player' => 3, 'fgm' => 8, 'fga' => 10, 'fg_perc' => 80.0,
'ftm' => 10, 'fta' => 12, 'ft_perc' => 83.3, '3ptm' => 5, 'pts' => 31, 'reb' => 3,
'ast' => 3, 'st' => 4, 'blk' => 0, 'tov' => 2, 'week' => 1, 'day' => 2));

$st->execute(array('id_player' => 3, 'fgm' => 9, 'fga' => 17, 'fg_perc' => 52.9,
'ftm' => 4, 'fta' => 4, 'ft_perc' => 100.0, '3ptm' => 3, 'pts' => 25, 'reb' => 11,
'ast' => 5, 'st' => 2, 'blk' => 1, 'tov' => 4, 'week' => 1, 'day' => 4));

$st->execute(array('id_player' => 3, 'fgm' => 12, 'fga' => 24, 'fg_perc' => 50.0,
'ftm' => 5, 'fta' => 6, 'ft_perc' => 83.3, '3ptm' => 3, 'pts' => 32, 'reb' => 5,
'ast' => 2, 'st' => 1, 'blk' => 0, 'tov' => 3, 'week' => 1, 'day' => 6));

$st->execute(array('id_player' => 3, 'fgm' => 11, 'fga' => 19, 'fg_perc' => 57.9,
'ftm' => 6, 'fta' => 8, 'ft_perc' => 75.0, '3ptm' => 5, 'pts' => 33, 'reb' => 7,
'ast' => 6, 'st' => 1, 'blk' => 1, 'tov' => 0, 'week' => 1, 'day' => 7));

$st->execute(array('id_player' => 3, 'fgm' => 8, 'fga' => 19, 'fg_perc' => 42.1,
'ftm' => 4, 'fta' => 4, 'ft_perc' => 100.0, '3ptm' => 4, 'pts' => 24, 'reb' => 8,
'ast' => 4, 'st' => 3, 'blk' => 0, 'tov' => 3, 'week' => 2, 'day' => 2));


$st->execute(array('id_player' => 3, 'fgm' => 15, 'fga' => 27, 'fg_perc' => 55.6,
'ftm' => 9, 'fta' => 10, 'ft_perc' => 90.0, '3ptm' => 4, 'pts' => 43, 'reb' => 12,
'ast' => 7, 'st' => 0, 'blk' => 0, 'tov' => 5, 'week' => 2, 'day' => 4));


$st->execute(array('id_player' => 3, 'fgm' => 15, 'fga' => 25, 'fg_perc' => 60.0,
'ftm' => 8, 'fta' => 10, 'ft_perc' => 80.0, '3ptm' => 5, 'pts' => 43, 'reb' => 14,
'ast' => 6, 'st' => 5, 'blk' => 1, 'tov' => 3, 'week' => 2, 'day' => 7));


$st->execute(array('id_player' => 3, 'fgm' => 11, 'fga' => 24, 'fg_perc' => 45.8,
'ftm' => 6, 'fta' => 6, 'ft_perc' => 100.0, '3ptm' => 3, 'pts' => 31, 'reb' => 12,
'ast' => 3, 'st' => 1, 'blk' => 0, 'tov' => 3, 'week' => 3, 'day' => 1));


$st->execute(array('id_player' => 3, 'fgm' => 11, 'fga' => 24, 'fg_perc' => 45.8,
'ftm' => 6, 'fta' => 6, 'ft_perc' => 100.0, '3ptm' => 3, 'pts' => 31, 'reb' => 12,
'ast' => 3, 'st' => 1, 'blk' => 0, 'tov' => 3, 'week' => 3, 'day' => 1));



$st->execute(array('id_player' => 3, 'fgm' => 10, 'fga' => 25, 'fg_perc' => 40.0,
'ftm' => 4, 'fta' => 4, 'ft_perc' => 100.0, '3ptm' => 4, 'pts' => 28, 'reb' => 14,
'ast' => 2, 'st' => 3, 'blk' => 0, 'tov' => 4, 'week' => 3, 'day' => 2));



///Curry

$st->execute(array('id_player' => 4, 'fgm' => 10, 'fga' => 17, 'fg_perc' => 58.8,
'ftm' => 4, 'fta' => 4, 'ft_perc' => 100.0, '3ptm' => 6, 'pts' => 30, 'reb' => 3,
'ast' => 2, 'st' => 1, 'blk' => 1, 'tov' => 3, 'week' => 1, 'day' => 2));

$st->execute(array('id_player' => 4, 'fgm' => 11, 'fga' => 20, 'fg_perc' => 55.0,
'ftm' => 11, 'fta' => 12, 'ft_perc' => 91.7, '3ptm' => 9, 'pts' => 42, 'reb' => 9,
'ast' => 7, 'st' => 1, 'blk' => 0, 'tov' => 2, 'week' => 1, 'day' => 4));

$st->execute(array('id_player' => 4, 'fgm' => 7, 'fga' => 17, 'fg_perc' => 41.2,
'ftm' => 2, 'fta' => 2, 'ft_perc' => 100.0, '3ptm' => 4, 'pts' => 20, 'reb' => 8,
'ast' => 4, 'st' => 1, 'blk' => 0, 'tov' => 3, 'week' => 1, 'day' => 6));

$st->execute(array('id_player' => 4, 'fgm' => 12, 'fga' => 23, 'fg_perc' => 52.2,
'ftm' => 7, 'fta' => 7, 'ft_perc' => 100.0, '3ptm' => 7, 'pts' => 38, 'reb' => 7,
'ast' => 6, 'st' => 2, 'blk' => 1, 'tov' => 2, 'week' => 2, 'day' => 2));

$st->execute(array('id_player' => 4, 'fgm' => 3, 'fga' => 12, 'fg_perc' => 25.0,
'ftm' => 2, 'fta' => 2, 'ft_perc' => 100.0, '3ptm' => 2, 'pts' => 10, 'reb' => 3,
'ast' => 3, 'st' => 1, 'blk' => 0, 'tov' => 4, 'week' => 2, 'day' => 4));

$st->execute(array('id_player' => 4, 'fgm' => 11, 'fga' => 23, 'fg_perc' => 47.8,
'ftm' => 8, 'fta' => 8, 'ft_perc' => 100.0, '3ptm' => 5, 'pts' => 35, 'reb' => 7,
'ast' => 6, 'st' => 3, 'blk' => 0, 'tov' => 1, 'week' => 2, 'day' => 6));

$st->execute(array('id_player' => 4, 'fgm' => 6, 'fga' => 16, 'fg_perc' => 37.5,
'ftm' => 5, 'fta' => 5, 'ft_perc' => 100.0, '3ptm' => 3, 'pts' => 20, 'reb' => 7,
'ast' => 1, 'st' => 2, 'blk' => 0, 'tov' => 3, 'week' => 3, 'day' => 2));

$st->execute(array('id_player' => 4, 'fgm' => 12, 'fga' => 21, 'fg_perc' => 57.1,
'ftm' => 3, 'fta' => 3, 'ft_perc' => 100.0, '3ptm' => 5, 'pts' => 32, 'reb' => 3,
'ast' => 3, 'st' => 3, 'blk' => 1, 'tov' => 4, 'week' => 3, 'day' => 4));

$st->execute(array('id_player' => 4, 'fgm' => 7, 'fga' => 22, 'fg_perc' => 31.8,
'ftm' => 2, 'fta' => 3, 'ft_perc' => 66.7, '3ptm' => 6, 'pts' => 22, 'reb' => 5,
'ast' => 5, 'st' => 2, 'blk' => 0, 'tov' => 3, 'week' => 3, 'day' => 7));


//Antetokounmpo

$st->execute(array('id_player' => 5, 'fgm' => 6, 'fga' => 12, 'fg_perc' => 50.0,
'ftm' => 3, 'fta' => 4, 'ft_perc' => 75.0, '3ptm' => 0, 'pts' => 15, 'reb' => 7,
'ast' => 5, 'st' => 1, 'blk' => 1, 'tov' => 5, 'week' => 1, 'day' => 4));

$st->execute(array('id_player' => 5, 'fgm' => 8, 'fga' => 13, 'fg_perc' => 61.5,
'ftm' => 6, 'fta' => 9, 'ft_perc' => 66.7, '3ptm' => 0, 'pts' => 22, 'reb' => 15,
'ast' => 5, 'st' => 2, 'blk' => 2, 'tov' => 4, 'week' => 1, 'day' => 6));

$st->execute(array('id_player' => 5, 'fgm' => 8, 'fga' => 15, 'fg_perc' => 53.3,
'ftm' => 2, 'fta' => 3, 'ft_perc' => 66.7, '3ptm' => 1, 'pts' => 19, 'reb' => 19,
'ast' => 6, 'st' => 0, 'blk' => 1, 'tov' => 2, 'week' => 2, 'day' => 1));

$st->execute(array('id_player' => 5, 'fgm' => 4, 'fga' => 6, 'fg_perc' => 66.7,
'ftm' => 3, 'fta' => 6, 'ft_perc' => 50.0, '3ptm' => 1, 'pts' => 12, 'reb' => 10,
'ast' => 7, 'st' => 0, 'blk' => 0, 'tov' => 4, 'week' => 2, 'day' => 4));

$st->execute(array('id_player' => 5, 'fgm' => 14, 'fga' => 19, 'fg_perc' => 73.7,
'ftm' => 16, 'fta' => 21, 'ft_perc' => 76.2, '3ptm' => 0, 'pts' => 44, 'reb' => 14,
'ast' => 8, 'st' => 0, 'blk' => 2, 'tov' => 4, 'week' => 2, 'day' => 6));


$st->execute(array('id_player' => 5, 'fgm' => 15, 'fga' => 21, 'fg_perc' => 71.4,
'ftm' => 2, 'fta' => 2, 'ft_perc' => 100.0, '3ptm' => 0, 'pts' => 32, 'reb' => 12,
'ast' => 5, 'st' => 0, 'blk' => 2, 'tov' => 6, 'week' => 3, 'day' => 2));


$st->execute(array('id_player' => 5, 'fgm' => 8, 'fga' => 13, 'fg_perc' => 61.5,
'ftm' => 9, 'fta' => 13, 'ft_perc' => 69.2, '3ptm' => 0, 'pts' => 25, 'reb' => 8,
'ast' => 8, 'st' => 2, 'blk' => 1, 'tov' => 6, 'week' => 3, 'day' => 4));

$st->execute(array('id_player' => 5, 'fgm' => 8, 'fga' => 13, 'fg_perc' => 61.5,
'ftm' => 13, 'fta' => 17, 'ft_perc' => 76.5, '3ptm' => 1, 'pts' => 30, 'reb' => 8,
'ast' => 5, 'st' => 0, 'blk' => 3, 'tov' => 4, 'week' => 3, 'day' => 6));

$st->execute(array('id_player' => 5, 'fgm' => 3, 'fga' => 12, 'fg_perc' => 25.0,
'ftm' => 3, 'fta' => 4, 'ft_perc' => 75.0, '3ptm' => 0, 'pts' => 9, 'reb' => 13,
'ast' => 3, 'st' => 0, 'blk' => 2, 'tov' => 4, 'week' => 3, 'day' => 7));



////Towns
$st->execute(array('id_player' => 6, 'fgm' => 10, 'fga' => 24, 'fg_perc' => 41.7,
'ftm' => 3, 'fta' => 4, 'ft_perc' => 75.0, '3ptm' => 1, 'pts' => 24, 'reb' => 11,
'ast' => 3, 'st' => 3, 'blk' => 1, 'tov' => 3, 'week' => 1, 'day' => 2));

$st->execute(array('id_player' => 6, 'fgm' => 13, 'fga' => 20, 'fg_perc' => 65.0,
'ftm' => 5, 'fta' => 7, 'ft_perc' => 71.4, '3ptm' => 4, 'pts' => 35, 'reb' => 12,
'ast' => 3, 'st' => 2, 'blk' => 6, 'tov' => 2, 'week' => 1, 'day' => 4));

$st->execute(array('id_player' => 6, 'fgm' => 6, 'fga' => 16, 'fg_perc' => 37.5,
'ftm' => 5, 'fta' => 6, 'ft_perc' => 83.3, '3ptm' => 2, 'pts' => 19, 'reb' => 10,
'ast' => 2, 'st' => 1, 'blk' => 1, 'tov' => 2, 'week' => 1, 'day' => 7));

$st->execute(array('id_player' => 6, 'fgm' => 11, 'fga' => 15, 'fg_perc' => 73.3,
'ftm' => 8, 'fta' => 12, 'ft_perc' => 66.7, '3ptm' => 1, 'pts' => 31, 'reb' => 11,
'ast' => 4, 'st' => 0, 'blk' => 1, 'tov' => 4, 'week' => 2, 'day' => 2));

$st->execute(array('id_player' => 6, 'fgm' => 8, 'fga' => 15, 'fg_perc' => 53.3,
'ftm' => 1, 'fta' => 1, 'ft_perc' => 100.0, '3ptm' => 2, 'pts' => 19, 'reb' => 11,
'ast' => 4, 'st' => 0, 'blk' => 3, 'tov' => 2, 'week' => 2, 'day' => 4));

$st->execute(array('id_player' => 6, 'fgm' => 11, 'fga' => 26, 'fg_perc' => 42.3,
'ftm' => 5, 'fta' => 6, 'ft_perc' => 83.3, '3ptm' => 1, 'pts' => 28, 'reb' => 12,
'ast' => 4, 'st' => 2, 'blk' => 2, 'tov' => 0, 'week' => 2, 'day' => 7));

$st->execute(array('id_player' => 6, 'fgm' => 5, 'fga' => 11, 'fg_perc' => 45.5,
'ftm' => 2, 'fta' => 2, 'ft_perc' => 100.0, '3ptm' => 2, 'pts' => 14, 'reb' => 14,
'ast' => 3, 'st' => 0, 'blk' => 3, 'tov' => 1, 'week' => 3, 'day' => 2));

$st->execute(array('id_player' => 6, 'fgm' => 6, 'fga' => 15, 'fg_perc' => 40.0,
'ftm' => 4, 'fta' => 6, 'ft_perc' => 66.7, '3ptm' => 0, 'pts' => 16, 'reb' => 8,
'ast' => 2, 'st' => 1, 'blk' => 3, 'tov' => 2, 'week' => 3, 'day' => 4));

$st->execute(array('id_player' => 6, 'fgm' => 4, 'fga' => 15, 'fg_perc' => 26.7,
'ftm' => 4, 'fta' => 5, 'ft_perc' => 80.0, '3ptm' => 1, 'pts' => 13, 'reb' => 6,
'ast' => 4, 'st' => 1, 'blk' => 0, 'tov' => 1, 'week' => 3, 'day' => 6));



///Leonard
$st->execute(array('id_player' => 7, 'fgm' => 10, 'fga' => 22, 'fg_perc' => 45.5,
'ftm' => 5, 'fta' => 5, 'ft_perc' => 100.0, '3ptm' => 1, 'pts' => 26, 'reb' => 6,
'ast' => 1, 'st' => 1, 'blk' => 0, 'tov' => 1, 'week' => 1, 'day' => 3));

$st->execute(array('id_player' => 7, 'fgm' => 14, 'fga' => 20, 'fg_perc' => 70.0,
'ftm' => 2, 'fta' => 3, 'ft_perc' => 66.7, '3ptm' => 1, 'pts' => 31, 'reb' => 1,
'ast' => 2, 'st' => 2, 'blk' => 0, 'tov' => 2, 'week' => 1, 'day' => 6));

$st->execute(array('id_player' => 7, 'fgm' => 11, 'fga' => 19, 'fg_perc' => 57.9,
'ftm' => 0, 'fta' => 3, 'ft_perc' => 0.0, '3ptm' => 3, 'pts' => 25, 'reb' => 9,
'ast' => 2, 'st' => 1, 'blk' => 0, 'tov' => 2, 'week' => 2, 'day' => 2));

$st->execute(array('id_player' => 7, 'fgm' => 8, 'fga' => 20, 'fg_perc' => 40.0,
'ftm' => 4, 'fta' => 6, 'ft_perc' => 66.7, '3ptm' => 5, 'pts' => 25, 'reb' => 8,
'ast' => 4, 'st' => 2, 'blk' => 0, 'tov' => 4, 'week' => 2, 'day' => 5));

$st->execute(array('id_player' => 7, 'fgm' => 11, 'fga' => 21, 'fg_perc' => 52.4,
'ftm' => 6, 'fta' => 8, 'ft_perc' => 75.0, '3ptm' => 5, 'pts' => 33, 'reb' => 10,
'ast' => 2, 'st' => 1, 'blk' => 1, 'tov' => 1, 'week' => 2, 'day' => 7));

$st->execute(array('id_player' => 7, 'fgm' => 8, 'fga' => 19, 'fg_perc' => 42.1,
'ftm' => 4, 'fta' => 5, 'ft_perc' => 80.0, '3ptm' => 2, 'pts' => 22, 'reb' => 10,
'ast' => 6, 'st' => 2, 'blk' => 0, 'tov' => 3, 'week' => 3, 'day' => 4));

$st->execute(array('id_player' => 7, 'fgm' => 12, 'fga' => 23, 'fg_perc' => 52.2,
'ftm' => 9, 'fta' => 10, 'ft_perc' => 90.0, '3ptm' => 4, 'pts' => 37, 'reb' => 6,
'ast' => 4, 'st' => 2, 'blk' => 0, 'tov' => 8, 'week' => 3, 'day' => 6));

$st->execute(array('id_player' => 7, 'fgm' => 10, 'fga' => 18, 'fg_perc' => 55.6,
'ftm' => 6, 'fta' => 6, 'ft_perc' => 100.0, '3ptm' => 2, 'pts' => 28, 'reb' => 9,
'ast' => 3, 'st' => 0, 'blk' => 2, 'tov' => 2, 'week' => 3, 'day' => 7));



///Durant
$st->execute(array('id_player' => 8, 'fgm' => 10, 'fga' => 13, 'fg_perc' => 76.9,
'ftm' => 7, 'fta' => 8, 'ft_perc' => 87.5, '3ptm' => 1, 'pts' => 28, 'reb' => 5,
'ast' => 8, 'st' => 2, 'blk' => 0, 'tov' => 5, 'week' => 1, 'day' => 2));

$st->execute(array('id_player' => 8, 'fgm' => 9, 'fga' => 16, 'fg_perc' => 56.3,
'ftm' => 3, 'fta' => 4, 'ft_perc' => 75.0, '3ptm' => 4, 'pts' => 25, 'reb' => 10,
'ast' => 9, 'st' => 1, 'blk' => 2, 'tov' => 4, 'week' => 1, 'day' => 4));

$st->execute(array('id_player' => 8, 'fgm' => 3, 'fga' => 14, 'fg_perc' => 21.4,
'ftm' => 4, 'fta' => 4, 'ft_perc' => 100.0, '3ptm' => 1, 'pts' => 11, 'reb' => 8,
'ast' => 6, 'st' => 1, 'blk' => 0, 'tov' => 7, 'week' => 1, 'day' => 6));

$st->execute(array('id_player' => 8, 'fgm' => 7, 'fga' => 15, 'fg_perc' => 46.7,
'ftm' => 4, 'fta' => 4, 'ft_perc' => 100.0, '3ptm' => 4, 'pts' => 22, 'reb' => 5,
'ast' => 3, 'st' => 3, 'blk' => 0, 'tov' => 2, 'week' => 2, 'day' => 2));

$st->execute(array('id_player' => 8, 'fgm' => 13, 'fga' => 22, 'fg_perc' => 59.1,
'ftm' => 2, 'fta' => 2, 'ft_perc' => 100.0, '3ptm' => 2, 'pts' => 30, 'reb' => 7,
'ast' => 5, 'st' => 0, 'blk' => 0, 'tov' => 5, 'week' => 2, 'day' => 4));

$st->execute(array('id_player' => 8, 'fgm' => 9, 'fga' => 20, 'fg_perc' => 45.0,
'ftm' => 11, 'fta' => 12, 'ft_perc' => 91.7, '3ptm' => 4, 'pts' => 33, 'reb' => 8,
'ast' => 8, 'st' => 0, 'blk' => 0, 'tov' => 4, 'week' => 2, 'day' => 6));

$st->execute(array('id_player' => 8, 'fgm' => 7, 'fga' => 15, 'fg_perc' => 46.7,
'ftm' => 8, 'fta' => 8, 'ft_perc' => 100.0, '3ptm' => 1, 'pts' => 23, 'reb' => 3,
'ast' => 5, 'st' => 0, 'blk' => 2, 'tov' => 2, 'week' => 3, 'day' => 2));

$st->execute(array('id_player' => 8, 'fgm' => 10, 'fga' => 23, 'fg_perc' => 43.5,
'ftm' => 8, 'fta' => 9, 'ft_perc' => 88.9, '3ptm' => 2, 'pts' => 30, 'reb' => 7,
'ast' => 2, 'st' => 0, 'blk' => 1, 'tov' => 5, 'week' => 3, 'day' => 4));

$st->execute(array('id_player' => 8, 'fgm' => 9, 'fga' => 18, 'fg_perc' => 50.0,
'ftm' => 8, 'fta' => 8, 'ft_perc' => 100.0, '3ptm' => 3, 'pts' => 29, 'reb' => 12,
'ast' => 8, 'st' => 0, 'blk' => 1, 'tov' => 5, 'week' => 3, 'day' => 7));




///Embiid
$st->execute(array('id_player' => 9, 'fgm' => 9, 'fga' => 19, 'fg_perc' => 47.4,
'ftm' => 8, 'fta' => 12, 'ft_perc' => 66.7, '3ptm' => 2, 'pts' => 28, 'reb' => 19,
'ast' => 3, 'st' => 1, 'blk' => 3, 'tov' => 5, 'week' => 1, 'day' => 3));

$st->execute(array('id_player' => 9, 'fgm' => 12, 'fga' => 23, 'fg_perc' => 52.2,
'ftm' => 17, 'fta' => 19, 'ft_perc' => 89.5, '3ptm' => 1, 'pts' => 42, 'reb' => 18,
'ast' => 2, 'st' => 3, 'blk' => 2, 'tov' => 4, 'week' => 1, 'day' => 4));

$st->execute(array('id_player' => 9, 'fgm' => 7, 'fga' => 17, 'fg_perc' => 41.2,
'ftm' => 10, 'fta' => 11, 'ft_perc' => 90.9, '3ptm' => 1, 'pts' => 25, 'reb' => 12,
'ast' => 5, 'st' => 1, 'blk' => 1, 'tov' => 2, 'week' => 1, 'day' => 7));

$st->execute(array('id_player' => 9, 'fgm' => 8, 'fga' => 13, 'fg_perc' => 61.5,
'ftm' => 2, 'fta' => 3, 'ft_perc' => 66.7, '3ptm' => 2, 'pts' => 20, 'reb' => 10,
'ast' => 4, 'st' => 0, 'blk' => 1, 'tov' => 3, 'week' => 2, 'day' => 3));

$st->execute(array('id_player' => 9, 'fgm' => 11, 'fga' => 17, 'fg_perc' => 64.7,
'ftm' => 12, 'fta' => 14, 'ft_perc' => 85.7, '3ptm' => 1, 'pts' => 35, 'reb' => 14,
'ast' => 2, 'st' => 1, 'blk' => 3, 'tov' => 7, 'week' => 2, 'day' => 4));

$st->execute(array('id_player' => 9, 'fgm' => 9, 'fga' => 24, 'fg_perc' => 37.5,
'ftm' => 8, 'fta' => 12, 'ft_perc' => 66.7, '3ptm' => 0, 'pts' => 26, 'reb' => 8,
'ast' => 1, 'st' => 0, 'blk' => 6, 'tov' => 2, 'week' => 2, 'day' => 7));

$st->execute(array('id_player' => 9, 'fgm' => 10, 'fga' => 17, 'fg_perc' => 58.8,
'ftm' => 4, 'fta' => 6, 'ft_perc' => 66.7, '3ptm' => 4, 'pts' => 31, 'reb' => 13,
'ast' => 3, 'st' => 0, 'blk' => 1, 'tov' => 4, 'week' => 3, 'day' => 3));

$st->execute(array('id_player' => 9, 'fgm' => 9, 'fga' => 19, 'fg_perc' => 47.4,
'ftm' => 2, 'fta' => 2, 'ft_perc' => 100.0, '3ptm' => 2, 'pts' => 22, 'reb' => 13,
'ast' => 8, 'st' => 1, 'blk' => 3, 'tov' => 5, 'week' => 3, 'day' => 5));

$st->execute(array('id_player' => 9, 'fgm' => 11, 'fga' => 19, 'fg_perc' => 57.9,
'ftm' => 8, 'fta' => 12, 'ft_perc' => 66.7, '3ptm' => 1, 'pts' => 31, 'reb' => 8,
'ast' => 6, 'st' => 0, 'blk' => 1, 'tov' => 3, 'week' => 3, 'day' => 6));


/// Irving

$st->execute(array('id_player' => 10, 'fgm' => 8, 'fga' => 16, 'fg_perc' => 50.0,
'ftm' => 0, 'fta' => 0, 'ft_perc' => 0, '3ptm' => 1, 'pts' => 17, 'reb' => 2,
'ast' => 6, 'st' => 3, 'blk' => 0, 'tov' => 0, 'week' => 1, 'day' => 2));

$st->execute(array('id_player' => 10, 'fgm' => 5, 'fga' => 9, 'fg_perc' => 55.6,
'ftm' => 1, 'fta' => 1, 'ft_perc' => 100.0, '3ptm' => 1, 'pts' => 12, 'reb' => 2,
'ast' => 2, 'st' => 1, 'blk' => 0, 'tov' => 3, 'week' => 1, 'day' => 4));

$st->execute(array('id_player' => 10, 'fgm' => 10, 'fga' => 19, 'fg_perc' => 52.6,
'ftm' => 0, 'fta' => 0, 'ft_perc' => 0, '3ptm' => 2, 'pts' => 22, 'reb' => 5,
'ast' => 5, 'st' => 1, 'blk' => 1, 'tov' => 3, 'week' => 1, 'day' => 5));

$st->execute(array('id_player' => 10, 'fgm' => 7, 'fga' => 16, 'fg_perc' => 43.6,
'ftm' => 11, 'fta' => 13, 'ft_perc' => 84.6, '3ptm' => 0, 'pts' => 25, 'reb' => 5,
'ast' => 6, 'st' => 2, 'blk' => 1, 'tov' => 2, 'week' => 1, 'day' => 7));

$st->execute(array('id_player' => 10, 'fgm' => 11, 'fga' => 19, 'fg_perc' => 57.9,
'ftm' => 2, 'fta' => 2, 'ft_perc' => 100.0, '3ptm' => 3, 'pts' => 27, 'reb' => 5,
'ast' => 18, 'st' => 1, 'blk' => 1, 'tov' => 7, 'week' => 2, 'day' => 4));

$st->execute(array('id_player' => 10, 'fgm' => 11, 'fga' => 19, 'fg_perc' => 57.9,
'ftm' => 2, 'fta' => 2, 'ft_perc' => 100.0, '3ptm' => 3, 'pts' => 27, 'reb' => 5,
'ast' => 18, 'st' => 1, 'blk' => 1, 'tov' => 7, 'week' => 2, 'day' => 4));

$st->execute(array('id_player' => 10, 'fgm' => 14, 'fga' => 21, 'fg_perc' => 66.7,
'ftm' => 6, 'fta' => 9, 'ft_perc' => 66.7, '3ptm' => 4, 'pts' => 38, 'reb' => 7,
'ast' => 11, 'st' => 0, 'blk' => 1, 'tov' => 3, 'week' => 2, 'day' => 6));

$st->execute(array('id_player' => 10, 'fgm' => 11, 'fga' => 19, 'fg_perc' => 57.9,
'ftm' => 5, 'fta' => 5, 'ft_perc' => 100.0, '3ptm' => 5, 'pts' => 32, 'reb' => 3,
'ast' => 5, 'st' => 1, 'blk' => 0, 'tov' => 4, 'week' => 2, 'day' => 7));

$st->execute(array('id_player' => 10, 'fgm' => 11, 'fga' => 19, 'fg_perc' => 57.9,
'ftm' => 2, 'fta' => 3, 'ft_perc' => 66.7, '3ptm' => 2, 'pts' => 26, 'reb' => 3,
'ast' => 10, 'st' => 8, 'blk' => 1, 'tov' => 3, 'week' => 3, 'day' => 2));

$st->execute(array('id_player' => 10, 'fgm' => 12, 'fga' => 27, 'fg_perc' => 44.4,
'ftm' => 4, 'fta' => 4, 'ft_perc' => 100.0, '3ptm' => 4, 'pts' => 32, 'reb' => 6,
'ast' => 10, 'st' => 2, 'blk' => 0, 'tov' => 4, 'week' => 3, 'day' => 7));




//Vucevic
$st->execute(array('id_player' => 11, 'fgm' => 7, 'fga' => 14, 'fg_perc' => 50.0,
'ftm' => 3, 'fta' => 4, 'ft_perc' => 75.0, '3ptm' => 1, 'pts' => 18, 'reb' => 13,
'ast' => 3, 'st' => 1, 'blk' => 1, 'tov' => 1, 'week' => 1, 'day' => 2));

$st->execute(array('id_player' => 11, 'fgm' => 8, 'fga' => 17, 'fg_perc' => 47.1,
'ftm' => 1, 'fta' => 2, 'ft_perc' => 50.0, '3ptm' => 3, 'pts' => 20, 'reb' => 8,
'ast' => 3, 'st' => 2, 'blk' => 0, 'tov' => 2, 'week' => 1, 'day' => 4));

$st->execute(array('id_player' => 11, 'fgm' => 7, 'fga' => 18, 'fg_perc' => 38.9,
'ftm' => 2, 'fta' => 4, 'ft_perc' => 50.0, '3ptm' => 0, 'pts' => 16, 'reb' => 13,
'ast' => 5, 'st' => 0, 'blk' => 0, 'tov' => 4, 'week' => 1, 'day' => 7));

$st->execute(array('id_player' => 11, 'fgm' => 9, 'fga' => 16, 'fg_perc' => 56.3,
'ftm' => 3, 'fta' => 4, 'ft_perc' => 75.0, '3ptm' => 1, 'pts' => 22, 'reb' => 9,
'ast' => 6, 'st' => 1, 'blk' => 0, 'tov' => 2, 'week' => 2, 'day' => 1));

$st->execute(array('id_player' => 11, 'fgm' => 11, 'fga' => 22, 'fg_perc' => 50.0,
'ftm' => 0, 'fta' => 1, 'ft_perc' => 0, '3ptm' => 2, 'pts' => 24, 'reb' => 13,
'ast' => 3, 'st' => 1, 'blk' => 0, 'tov' => 2, 'week' => 2, 'day' => 4));

$st->execute(array('id_player' => 11, 'fgm' => 7, 'fga' => 20, 'fg_perc' => 35.0,
'ftm' => 1, 'fta' => 1, 'ft_perc' => 100.0, '3ptm' => 1, 'pts' => 16, 'reb' => 17,
'ast' => 6, 'st' => 0, 'blk' => 1, 'tov' => 0, 'week' => 2, 'day' => 6));

$st->execute(array('id_player' => 11, 'fgm' => 11, 'fga' => 24, 'fg_perc' => 45.8,
'ftm' => 3, 'fta' => 3, 'ft_perc' => 100.0, '3ptm' => 2, 'pts' => 27, 'reb' => 6,
'ast' => 4, 'st' => 0, 'blk' => 2, 'tov' => 0, 'week' => 2, 'day' => 7));

$st->execute(array('id_player' => 11, 'fgm' => 12, 'fga' => 23, 'fg_perc' => 52.2,
'ftm' => 4, 'fta' => 4, 'ft_perc' => 100.0, '3ptm' => 1, 'pts' => 29, 'reb' => 14,
'ast' => 2, 'st' => 0, 'blk' => 2, 'tov' => 0, 'week' => 3, 'day' => 1));

$st->execute(array('id_player' => 11, 'fgm' => 9, 'fga' => 20, 'fg_perc' => 45.0,
'ftm' => 2, 'fta' => 2, 'ft_perc' => 100.0, '3ptm' => 1, 'pts' => 21, 'reb' => 14,
'ast' => 5, 'st' => 2, 'blk' => 4, 'tov' => 4, 'week' => 3, 'day' => 4));

$st->execute(array('id_player' => 11, 'fgm' => 12, 'fga' => 17, 'fg_perc' => 70.6,
'ftm' => 3, 'fta' => 5, 'ft_perc' => 60.0, '3ptm' => 1, 'pts' => 28, 'reb' => 9,
'ast' => 1, 'st' => 0, 'blk' => 1, 'tov' => 3, 'week' => 3, 'day' => 6));




//Jokic
$st->execute(array('id_player' => 12, 'fgm' => 8, 'fga' => 16, 'fg_perc' => 50.0,
'ftm' => 2, 'fta' => 3, 'ft_perc' => 66.7, '3ptm' => 1, 'pts' => 19, 'reb' => 14,
'ast' => 15, 'st' => 1, 'blk' => 3, 'tov' => 5, 'week' => 1, 'day' => 3));

$st->execute(array('id_player' => 12, 'fgm' => 10, 'fga' => 18, 'fg_perc' => 55.6,
'ftm' => 3, 'fta' => 4, 'ft_perc' => 75.0, '3ptm' => 3, 'pts' => 26, 'reb' => 13,
'ast' => 6, 'st' => 1, 'blk' => 1, 'tov' => 5, 'week' => 1, 'day' => 5));

$st->execute(array('id_player' => 12, 'fgm' => 16, 'fga' => 29, 'fg_perc' => 55.2,
'ftm' => 4, 'fta' => 5, 'ft_perc' => 80.0, '3ptm' => 3, 'pts' => 39, 'reb' => 12,
'ast' => 6, 'st' => 3, 'blk' => 1, 'tov' => 2, 'week' => 1, 'day' => 6));

$st->execute(array('id_player' => 12, 'fgm' => 11, 'fga' => 20, 'fg_perc' => 55.0,
'ftm' => 1, 'fta' => 1, 'ft_perc' => 100.0, '3ptm' => 1, 'pts' => 24, 'reb' => 13,
'ast' => 4, 'st' => 2, 'blk' => 1, 'tov' => 8, 'week' => 2, 'day' => 2));

$st->execute(array('id_player' => 12, 'fgm' => 11, 'fga' => 21, 'fg_perc' => 52.4,
'ftm' => 6, 'fta' => 6, 'ft_perc' => 100.0, '3ptm' => 1, 'pts' => 29, 'reb' => 11,
'ast' => 10, 'st' => 1, 'blk' => 0, 'tov' => 3, 'week' => 2, 'day' => 3));

$st->execute(array('id_player' => 12, 'fgm' => 8, 'fga' => 19, 'fg_perc' => 42.1,
'ftm' => 2, 'fta' => 3, 'ft_perc' => 66.7, '3ptm' => 0, 'pts' => 18, 'reb' => 14,
'ast' => 10, 'st' => 0, 'blk' => 2, 'tov' => 1, 'week' => 2, 'day' => 5));

$st->execute(array('id_player' => 12, 'fgm' => 8, 'fga' => 15, 'fg_perc' => 53.3,
'ftm' => 6, 'fta' => 7, 'ft_perc' => 85.7, '3ptm' => 1, 'pts' => 23, 'reb' => 10,
'ast' => 4, 'st' => 0, 'blk' => 1, 'tov' => 2, 'week' => 2, 'day' => 7));

$st->execute(array('id_player' => 12, 'fgm' => 15, 'fga' => 23, 'fg_perc' => 65.2,
'ftm' => 6, 'fta' => 8, 'ft_perc' => 75.0, '3ptm' => 4, 'pts' => 40, 'reb' => 10,
'ast' => 8, 'st' => 0, 'blk' => 0, 'tov' => 3, 'week' => 3, 'day' => 1));

$st->execute(array('id_player' => 12, 'fgm' => 6, 'fga' => 12, 'fg_perc' => 50.0,
'ftm' => 5, 'fta' => 5, 'ft_perc' => 100.0, '3ptm' => 0, 'pts' => 17, 'reb' => 4,
'ast' => 8, 'st' => 0, 'blk' => 0, 'tov' => 3, 'week' => 3, 'day' => 3));

$st->execute(array('id_player' => 12, 'fgm' => 6, 'fga' => 18, 'fg_perc' => 33.3,
'ftm' => 6, 'fta' => 6, 'ft_perc' => 100.0, '3ptm' => 0, 'pts' => 18, 'reb' => 8,
'ast' => 11, 'st' => 1, 'blk' => 1, 'tov' => 2, 'week' => 3, 'day' => 5));

$st->execute(array('id_player' => 12, 'fgm' => 8, 'fga' => 12, 'fg_perc' => 66.7,
'ftm' => 0, 'fta' => 1, 'ft_perc' => 0, '3ptm' => 3, 'pts' => 19, 'reb' => 11,
'ast' => 12, 'st' => 1, 'blk' => 0, 'tov' => 1, 'week' => 3, 'day' => 7));



/// Lillard
$st->execute(array('id_player' => 13, 'fgm' => 6, 'fga' => 16, 'fg_perc' => 37.5,
'ftm' => 5, 'fta' => 6, 'ft_perc' => 83.3, '3ptm' => 1, 'pts' => 18, 'reb' => 5,
'ast' => 5, 'st' => 1, 'blk' => 0, 'tov' => 0, 'week' => 1, 'day' => 1));

$st->execute(array('id_player' => 13, 'fgm' => 5, 'fga' => 15, 'fg_perc' => 33.3,
'ftm' => 0, 'fta' => 0, 'ft_perc' => 0, '3ptm' => 3, 'pts' => 13, 'reb' => 6,
'ast' => 3, 'st' => 0, 'blk' => 1, 'tov' => 2, 'week' => 1, 'day' => 3));

$st->execute(array('id_player' => 13, 'fgm' => 11, 'fga' => 25, 'fg_perc' => 44.0,
'ftm' => 0, 'fta' => 0, 'ft_perc' => 0, '3ptm' => 3, 'pts' => 25, 'reb' => 4,
'ast' => 4, 'st' => 1, 'blk' => 1, 'tov' => 2, 'week' => 1, 'day' => 5));

$st->execute(array('id_player' => 13, 'fgm' => 7, 'fga' => 15, 'fg_perc' => 46.7,
'ftm' => 3, 'fta' => 3, 'ft_perc' => 100.0, '3ptm' => 2, 'pts' => 19, 'reb' => 5,
'ast' => 12, 'st' => 0, 'blk' => 0, 'tov' => 4, 'week' => 2, 'day' => 1));


$st->execute(array('id_player' => 13, 'fgm' => 8, 'fga' => 23, 'fg_perc' => 34.8,
'ftm' => 12, 'fta' => 13, 'ft_perc' => 92.3, '3ptm' => 3, 'pts' => 31, 'reb' => 8,
'ast' => 11, 'st' => 0, 'blk' => 1, 'tov' => 2, 'week' => 2, 'day' => 4));


$st->execute(array('id_player' => 13, 'fgm' => 5, 'fga' => 18, 'fg_perc' => 27.8,
'ftm' => 5, 'fta' => 6, 'ft_perc' => 83.3, '3ptm' => 1, 'pts' => 16, 'reb' => 6,
'ast' => 5, 'st' => 0, 'blk' => 0, 'tov' => 5, 'week' => 2, 'day' => 6));


$st->execute(array('id_player' => 13, 'fgm' => 12, 'fga' => 29, 'fg_perc' => 41.4,
'ftm' => 13, 'fta' => 15, 'ft_perc' => 86.7, '3ptm' => 3, 'pts' => 40, 'reb' => 6,
'ast' => 5, 'st' => 1, 'blk' => 0, 'tov' => 1, 'week' => 3, 'day' => 1));

$st->execute(array('id_player' => 13, 'fgm' => 9, 'fga' => 22, 'fg_perc' => 40.9,
'ftm' => 8, 'fta' => 10, 'ft_perc' => 80.0, '3ptm' => 3, 'pts' => 29, 'reb' => 6,
'ast' => 8, 'st' => 2, 'blk' => 0, 'tov' => 4, 'week' => 3, 'day' => 3));

$st->execute(array('id_player' => 13, 'fgm' => 5, 'fga' => 12, 'fg_perc' => 41.7,
'ftm' => 11, 'fta' => 13, 'ft_perc' => 84.6, '3ptm' => 1, 'pts' => 22, 'reb' => 4,
'ast' => 5, 'st' => 0, 'blk' => 2, 'tov' => 4, 'week' => 3, 'day' => 4));

$st->execute(array('id_player' => 13, 'fgm' => 9, 'fga' => 24, 'fg_perc' => 37.5,
'ftm' => 2, 'fta' => 3, 'ft_perc' => 66.7, '3ptm' => 3, 'pts' => 23, 'reb' => 2,
'ast' => 8, 'st' => 2, 'blk' => 1, 'tov' => 2, 'week' => 3, 'day' => 6));




//Beal
$st->execute(array('id_player' => 14, 'fgm' => 11, 'fga' => 24, 'fg_perc' => 45.8,
'ftm' => 1, 'fta' => 2, 'ft_perc' => 50.0, '3ptm' => 4, 'pts' => 27, 'reb' => 6,
'ast' => 6, 'st' => 0, 'blk' => 0, 'tov' => 2, 'week' => 1, 'day' => 2));

$st->execute(array('id_player' => 14, 'fgm' => 12, 'fga' => 22, 'fg_perc' => 54.5,
'ftm' => 4, 'fta' => 5, 'ft_perc' => 80.0, '3ptm' => 2, 'pts' => 30, 'reb' => 8,
'ast' => 4, 'st' => 1, 'blk' => 3, 'tov' => 8, 'week' => 1, 'day' => 4));

$st->execute(array('id_player' => 14, 'fgm' => 9, 'fga' => 20, 'fg_perc' => 45.0,
'ftm' => 5, 'fta' => 5, 'ft_perc' => 100.0, '3ptm' => 2, 'pts' => 25, 'reb' => 6,
'ast' => 13, 'st' => 2, 'blk' => 0, 'tov' => 6, 'week' => 1, 'day' => 6));

$st->execute(array('id_player' => 14, 'fgm' => 13, 'fga' => 21, 'fg_perc' => 61.9,
'ftm' => 4, 'fta' => 4, 'ft_perc' => 100.0, '3ptm' => 1, 'pts' => 31, 'reb' => 2,
'ast' => 4, 'st' => 4, 'blk' => 0, 'tov' => 2, 'week' => 1, 'day' => 7));

$st->execute(array('id_player' => 14, 'fgm' => 9, 'fga' => 19, 'fg_perc' => 47.4,
'ftm' => 12, 'fta' => 12, 'ft_perc' => 100.0, '3ptm' => 2, 'pts' => 32, 'reb' => 6,
'ast' => 10, 'st' => 2, 'blk' => 1, 'tov' => 1, 'week' => 2, 'day' => 2));

$st->execute(array('id_player' => 14, 'fgm' => 6, 'fga' => 15, 'fg_perc' => 40.0,
'ftm' => 14, 'fta' => 15, 'ft_perc' => 93.3, '3ptm' => 2, 'pts' => 28, 'reb' => 3,
'ast' => 11, 'st' => 1, 'blk' => 1, 'tov' => 6, 'week' => 2, 'day' => 4));

$st->execute(array('id_player' => 14, 'fgm' => 16, 'fga' => 25, 'fg_perc' => 64.0,
'ftm' => 10, 'fta' => 10, 'ft_perc' => 100.0, '3ptm' => 4, 'pts' => 46, 'reb' => 6,
'ast' => 7, 'st' => 0, 'blk' => 1, 'tov' => 1, 'week' => 3, 'day' => 6));

$st->execute(array('id_player' => 14, 'fgm' => 12, 'fga' => 22, 'fg_perc' => 54.5,
'ftm' => 8, 'fta' => 8, 'ft_perc' => 100.0, '3ptm' => 3, 'pts' => 35, 'reb' => 3,
'ast' => 6, 'st' => 2, 'blk' => 0, 'tov' => 2, 'week' => 3, 'day' => 7));




///Butler
$st->execute(array('id_player' => 15, 'fgm' => 5, 'fga' => 10, 'fg_perc' => 50.0,
'ftm' => 4, 'fta' => 4, 'ft_perc' => 100.0, '3ptm' => 0, 'pts' => 14, 'reb' => 2,
'ast' => 4, 'st' => 3, 'blk' => 0, 'tov' => 1, 'week' => 1, 'day' => 3));

$st->execute(array('id_player' => 15, 'fgm' => 8, 'fga' => 18, 'fg_perc' => 44.4,
'ftm' => 6, 'fta' => 7, 'ft_perc' => 85.7, '3ptm' => 0, 'pts' => 22, 'reb' => 3,
'ast' => 4, 'st' => 3, 'blk' => 0, 'tov' => 2, 'week' => 1, 'day' => 4));

$st->execute(array('id_player' => 15, 'fgm' => 8, 'fga' => 18, 'fg_perc' => 44.4,
'ftm' => 3, 'fta' => 4, 'ft_perc' => 75.0, '3ptm' => 0, 'pts' => 19, 'reb' => 9,
'ast' => 3, 'st' => 0, 'blk' => 0, 'tov' => 3, 'week' => 1, 'day' => 6));

$st->execute(array('id_player' => 15, 'fgm' => 3, 'fga' => 8, 'fg_perc' => 37.5,
'ftm' => 6, 'fta' => 6, 'ft_perc' => 100.0, '3ptm' => 0, 'pts' => 12, 'reb' => 4,
'ast' => 4, 'st' => 1, 'blk' => 1, 'tov' => 0, 'week' => 1, 'day' => 7));

$st->execute(array('id_player' => 15, 'fgm' => 8, 'fga' => 14, 'fg_perc' => 57.1,
'ftm' => 6, 'fta' => 7, 'ft_perc' => 85.7, '3ptm' => 0, 'pts' => 22, 'reb' => 6,
'ast' => 7, 'st' => 2, 'blk' => 2, 'tov' => 3, 'week' => 2, 'day' => 6));

$st->execute(array('id_player' => 15, 'fgm' => 8, 'fga' => 16, 'fg_perc' => 50.0,
'ftm' => 9, 'fta' => 13, 'ft_perc' => 69.2, '3ptm' => 2, 'pts' => 27, 'reb' => 6,
'ast' => 3, 'st' => 3, 'blk' => 0, 'tov' => 2, 'week' => 2, 'day' => 7));

$st->execute(array('id_player' => 15, 'fgm' => 8, 'fga' => 19, 'fg_perc' => 42.1,
'ftm' => 6, 'fta' => 6, 'ft_perc' => 100.0, '3ptm' => 1, 'pts' => 23, 'reb' => 4,
'ast' => 9, 'st' => 2, 'blk' => 1, 'tov' => 2, 'week' => 3, 'day' => 3));


$st->execute(array('id_player' => 15, 'fgm' => 7, 'fga' => 17, 'fg_perc' => 41.2,
'ftm' => 5, 'fta' => 5, 'ft_perc' => 100.0, '3ptm' => 3, 'pts' => 22, 'reb' => 4,
'ast' => 2, 'st' => 0, 'blk' => 0, 'tov' => 0, 'week' => 3, 'day' => 4));


$st->execute(array('id_player' => 15, 'fgm' => 6, 'fga' => 13, 'fg_perc' => 46.2,
'ftm' => 13, 'fta' => 13, 'ft_perc' => 100.0, '3ptm' => 0, 'pts' => 25, 'reb' => 6,
'ast' => 4, 'st' => 2, 'blk' => 1, 'tov' => 1, 'week' => 3, 'day' => 7));




/// Gobert
$st->execute(array('id_player' => 16, 'fgm' => 4, 'fga' => 8, 'fg_perc' => 50.0,
'ftm' => 6, 'fta' => 10, 'ft_perc' => 60.0, '3ptm' => 0, 'pts' => 14, 'reb' => 15,
'ast' => 3, 'st' => 2, 'blk' => 1, 'tov' => 2, 'week' => 1, 'day' => 2));

$st->execute(array('id_player' => 16, 'fgm' => 4, 'fga' => 8, 'fg_perc' => 50.0,
'ftm' => 4, 'fta' => 4, 'ft_perc' => 100.0, '3ptm' => 0, 'pts' => 12, 'reb' => 14,
'ast' => 2, 'st' => 1, 'blk' => 1, 'tov' => 1, 'week' => 1, 'day' => 4));

$st->execute(array('id_player' => 16, 'fgm' => 4, 'fga' => 10, 'fg_perc' => 40.0,
'ftm' => 4, 'fta' => 8, 'ft_perc' => 50.0, '3ptm' => 0, 'pts' => 12, 'reb' => 18,
'ast' => 2, 'st' => 2, 'blk' => 2, 'tov' => 2, 'week' => 1, 'day' => 6));

$st->execute(array('id_player' => 16, 'fgm' => 5, 'fga' => 6, 'fg_perc' => 83.3,
'ftm' => 5, 'fta' => 9, 'ft_perc' => 55.6, '3ptm' => 0, 'pts' => 15, 'reb' => 16,
'ast' => 8, 'st' => 1, 'blk' => 2, 'tov' => 5, 'week' => 1, 'day' => 7));

$st->execute(array('id_player' => 16, 'fgm' => 6, 'fga' => 9, 'fg_perc' => 66.7,
'ftm' => 6, 'fta' => 8, 'ft_perc' => 75.0, '3ptm' => 0, 'pts' => 18, 'reb' => 25,
'ast' => 3, 'st' => 0, 'blk' => 2, 'tov' => 1, 'week' => 2, 'day' => 2));

$st->execute(array('id_player' => 16, 'fgm' => 7, 'fga' => 10, 'fg_perc' => 70.0,
'ftm' => 9, 'fta' => 10, 'ft_perc' => 90.0, '3ptm' => 0, 'pts' => 23, 'reb' => 22,
'ast' => 1, 'st' => 1, 'blk' => 4, 'tov' => 0, 'week' => 2, 'day' => 4));

$st->execute(array('id_player' => 16, 'fgm' => 8, 'fga' => 10, 'fg_perc' => 80.0,
'ftm' => 3, 'fta' => 3, 'ft_perc' => 100.0, '3ptm' => 0, 'pts' => 19, 'reb' => 15,
'ast' => 5, 'st' => 2, 'blk' => 2, 'tov' => 3, 'week' => 2, 'day' => 6));

$st->execute(array('id_player' => 16, 'fgm' => 4, 'fga' => 10, 'fg_perc' => 40.0,
'ftm' => 2, 'fta' => 4, 'ft_perc' => 50.0, '3ptm' => 0, 'pts' => 10, 'reb' => 13,
'ast' => 3, 'st' => 0, 'blk' => 4, 'tov' => 1, 'week' => 3, 'day' => 2));

$st->execute(array('id_player' => 16, 'fgm' => 4, 'fga' => 11, 'fg_perc' => 36.4,
'ftm' => 7, 'fta' => 9, 'ft_perc' => 77.8, '3ptm' => 0, 'pts' => 15, 'reb' => 10,
'ast' => 3, 'st' => 0, 'blk' => 3, 'tov' => 0, 'week' => 3, 'day' => 4));

$st->execute(array('id_player' => 16, 'fgm' => 8, 'fga' => 12, 'fg_perc' => 66.7,
'ftm' => 2, 'fta' => 4, 'ft_perc' => 50.0, '3ptm' => 0, 'pts' => 18, 'reb' => 16,
'ast' => 2, 'st' => 2, 'blk' => 5, 'tov' => 1, 'week' => 3, 'day' => 6));




}
catch( PDOException $e ) { exit( "PDO error [insert project_player_stats]: " . $e->getMessage() ); }
echo "Ubacio u tablicu project_player_stats.<br />";

?>
