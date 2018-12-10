<?php

require_once('MYSQL_Class.php');

$mySQL = new MYSQL() ;

/* change which database that you want to access here.
It is the second string entry. */
$mySQL->connect('localhost','librarytracker','root');

/* use the data value to input a few books into the system.*/
/* The data model */
/* $data = ['Title', 'ISBN', 'year', 'description' ] */

/* Entry 1 */
/*$data = ['Pawn of Prophecy', '0-345-33551-1', 'April 1982', 'The book opens with a prologue, beginning with the creation of the world by seven gods. Aldur, one of the seven, fashions a stone orb and creates within it a "living soul". Torak, another of the seven, attempts to seize the Orb from Aldur and subdue the Orb\'s intelligence; the Orb mutilates the left side of Torak\'s body. The Orb of Aldur is later recovered by Belgarath the Sorcerer, King Cherek, and Cherek\'s sons. Riva, Cherek\'s youngest son, is found to be able to hold the Orb unharmed; he and his descendants protect the Orb from Torak.

The story then begins in earnest with the experiences of protagonist Garion. His childhood on a large, prosperous farm: his earliest memories in the kitchen of his Aunt Pol; his friend Durnik the blacksmith; early games and friends; and the romance between Garion and local girl Zubrette. It also introduces Belgarath, as a wandering storyteller nicknamed \'Mister Wolf\'; Garion\'s telepathic vision of the antagonist Asharak/Chamdar; and a "dry voice" in his mind, distinct from his own consciousness. The reader later discovers that this is the Voice of Prophecy, or "Necessity", which takes action through him.

When Belgarath, alias "Wolf", announces the theft of a mysterious object (actually the Orb), he, Garion, and Aunt Pol leave Faldor\'s farm to pursue the thief, reluctantly allowing Durnik to accompany them. They are joined later by Silk/Kheldar, a Drasnia prince, spy, and thief; and by Barak, a Cherek Earl. Thereafter Mister Wolf follows an invisible trail through several regions until they are arrested.

They are taken to a meeting of monarchs where Garion suspects a green-cloaked individual of treason. A few days later, Barak and Garion are hunting wild boar when Garion notices the green-cloaked spy discussing further espionage; but before Garion can tell anyone of this, he is attacked by a wild boar, which is then slain by Barak in the form of a bear.Garion later exposes the green-cloaked spy, and the latter\'s patrons are defeated in a fight. Garion himself is almost captured, but escapes. Garion learns that Polgara is Belgarath\'s daughter and the sister of Garion\'s second-most-distant female ancestor (identified in the prologue as Queen Beldaran, wife of Riva), and for that reason called his aunt. Having learned this, Garion identifies Belgarath as his grandfather. The group, with the addition of an Algarian prince named Hettar, then leave in search of the Orb. ' ]; */

/* Entry 2 */
#$data = ['Title', 'ISBN', 'year', 'description' ]

/*This will only add the book to the books table.
  Will need more code to work on the other tables.*/
$result = $mySQL -> insert ("INSERT INTO books(Title, ISBN, year, description) VALUES(?,?,?,?)",$data);

/*Prints the results so I can view them. Utilizing the prototype method.*/
echo($result);
