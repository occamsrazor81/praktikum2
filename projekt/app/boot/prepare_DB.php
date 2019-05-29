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
		'id_team1 int NOT NULL,' .
		'id_team2 int NOT NULL,'.
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
try
{
	$st = $db->prepare('INSERT into project_player_stats(id_player, FGM, FGA, FG_PERC,
	FTM, FTA, FT_PERC, 3PTM, PTS, REB, AST, ST, BLK, TOV, week, day)
	values (:id_player,:fgm, :fga, :fg_perc, :ftm, :fta, :ft_perc, :3ptm,
		:pts, :reb, :ast, :st, :blk, :tov, :week, :day)');

	$st->execute(array('id_player' => 1, 'fgm' => 7, 'fga' => 20, 'fg_perc' => 35.0,
'ftm' => 6, 'fta' => 7, 'ft_perc' => 85.7, '3ptm' => 0, 'pts' => 20, 'reb' => 8,
'ast' => 1, 'st' => 0, 'blk' => 2, 'tov' => 5, 'week' => 1, 'day' => 2));





}
catch( PDOException $e ) { exit( "PDO error [insert project_player_stats]: " . $e->getMessage() ); }

echo "Ubacio u tablicu project_player_stats.<br />";





?>
