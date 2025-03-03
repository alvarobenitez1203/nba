/* INSERTS DATOS SCRIPT NBA */

/* USUARIOS */

INSERT INTO usuarios (nombre, email, contrasenna, telefono) 
VALUES 
("Administrador", "admin@admin.com", "adminnba", 000000000);

/* EQUIPOS */	

INSERT INTO equipos (nombre, pais, annofundacion, conferencia)
VALUES 
/* CONFERENCIA ESTE */
("Boston Celtics", "Estados Unidos", 1946, "Este"),
("Cleveland Cavaliers", "Estados Unidos", 1970, "Este"),
("Milwaukee Bucks", "Estados Unidos", 1968, "Este"),
("New York Knicks", "Estados Unidos", 1946, "Este"),
("Philadelphia 76ers", "Estados Unidos", 1963, "Este"),
("Indiana Pacers", "Estados Unidos", 1967, "Este"),
("Orlando Magic", "Estados Unidos", 1989, "Este"),
("Miami Heat", "Estados Unidos", 1988, "Este"),
("Chicago Bulls", "Estados Unidos", 1966, "Este"),
("Atlanta Hawks", "Estados Unidos", 1946, "Este"),
("Brooklyn Nets", "Estados Unidos", 1967, "Este"),
("Toronto Raptors", "Canadá", 1993, "Este"),
("Charlotte Hornets", "Estados Unidos", 1988, "Este"),
("Washington Wizards", "Estados Unidos", 1961, "Este"),
("Detroit Pistons", "Estados Unidos", 1941, "Este"),
/* CONFERENCIA OESTE */
("Oklahoma City Thunder", "Estados Unidos", 1967, "Oeste"),
("Minnesota Timberwolves", "Estados Unidos", 1989, "Oeste"),
("Los Angeles Clippers", "Estados Unidos", 1969, "Oeste"),
("Denver Nuggets", "Estados Unidos", 1967, "Oeste"),
("Sacramento Kings", "Estados Unidos", 1923, "Oeste"),
("Phoenix Suns", "Estados Unidos", 1968, "Oeste"),
("New Orleans Pelicans", "Estados Unidos", 2002, "Oeste"),
("Dallas Mavericks", "Estados Unidos", 1980, "Oeste"),
("Los Angeles Lakers", "Estados Unidos", 1947, "Oeste"),
("Utah Jazz", "Estados Unidos", 1974, "Oeste"),
("Houston Rockets", "Estados Unidos", 1967, "Oeste"),
("Golden State Warriors", "Estados Unidos", 1946, "Oeste"),
("Memphis Grizzlies", "Estados Unidos", 1995, "Oeste"),
("Portland Trail Blazers", "Estados Unidos", 1970, "Oeste"),
("San Antonio Spurs", "Estados Unidos", 1967, "Oeste");

/* JUGADORES */

INSERT INTO jugadores (nombre, edad, posicion, nacionalidad, idequipo)
VALUES 
/* BOSTON CELTICS */
("Jaylen Brown", 27, "Escolta", "Estados Unidos", 1),
("Jayson Tatum", 25, "Alero", "Estados Unidos", 1),
("Derrick White", 29, "Base", "Estados Unidos", 1),
("Jrue Holiday", 33, "Base", "Estados Unidos", 1),
("Kristaps Porzingis", 28, "Ala-pívot", "Letonia", 1),
("Al Horford", 37, "Pívot", "República Dominicana", 1),
/* CLEVELAND CAVALIERS */
("Donovan Mitchell", 27, "Escolta", "Estados Unidos", 2),
("Darius Garland", 24, "Base", "Estados Unidos", 2),
("Evan Mobley", 22, "Ala-Pívot", "Estados Unidos", 2),
("Max Strus", 27, "Alero", "Estados Unidos", 2),
("Jarrett Allen", 25, "Pívot", "Estados Unidos", 2),
("Caris Levert", 37, "Base", "Estados Unidos", 2),
/* MILWAUKEE BUCKS */
("Damian Lillard", 33, "Base", "Estados Unidos", 3),
("Giannis Antetokoumpo", 29, "Ala-pívot", "Grecia", 3),
("Brook Lopez", 35, "Pívot", "Estados Unidos", 3),
("Malik Beasley", 27, "Escolta", "Estados Unidos", 3),
("Khris Middleton", 32, "Alero", "Estados Unidos", 3),
("Bobby Portis", 29, "Alero", "Estados Unidos", 3),
/* NEW YORK KNICKS */
("Jalen Brunson", 27, "Base", "Estados Unidos", 4),
("Julius Randle", 29, "Ala-pívot", "Estados Unidos", 4),
("OG Anunoby", 26, "Alero", "Inglaterra", 4),
("Josh Hart", 28, "Base", "Estados Unidos", 4),
("Mitchell Robinson", 25, "Pívot", "Estados Unidos", 4),
("Donte DiVincenzo", 27, "Escolta", "Estados Unidos", 4),
/* PHILADELPHIA 76ERS */
("Joel Embiid", 29, "Pívot", "Camerún", 5),
("Tyrese Maxey", 23, "Base", "Estados Unidos", 5),
("Tobias Harris", 31, "Alero", "Estados Unidos", 5),
("Buddy Hield", 31, "Escolta", "Bahamas", 5),
("De'Anthony Melton", 25, "Base", "Estados Unidos", 5),
("Kyle Lowry", 37, "Base", "Estados Unidos", 5),
/* INDIANA PACERS */
("Tyrese Haliburton", 23, "Base", "Estados Unidos", 6),
("Myles Turner", 27, "Pívot", "Estados Unidos", 6),
("Obi Toppin", 25, "Ala-pívot", "Estados Unidos", 6),
("Bennedict Mathurin", 21, "Escolta", "Canadá", 6),
("Aaron Nesmith", 24, "Escolta", "Estados Unidos", 6),
("Pascal Siakam", 29, "Ala-pívot", "Camerún", 6),
/* ORLANDO MAGIC */
("Paolo Banchero", 21, "Alero", "Estados Unidos", 7),
("Franz Wagner", 22, "Alero", "Alemania", 7),
("Cole Anthony", 23, "Base", "Estados Unidos", 7),
("Wendell Carter Jr.", 24, "Ala-pívot", "Estados Unidos", 7),
("Markelle Fultz", 25, "Escolta", "Estados Unidos", 7),
("Jalen Suggs", 22, "Base", "Estados Unidos", 7),
/* MIAMI HEAT */
("Jimmy Butler", 34, "Alero", "Estados Unidos", 8),
("Tyler Herro", 24, "Base", "Estados Unidos", 8),
("Bam Adebayo", 26, "Pívot", "Estados Unidos", 8),
("Duncan Robinson", 29, "Alero", "Estados Unidos", 8),
("Josh Richardson", 30, "Escolta", "Estados Unidos", 8),
("Terry Rozier", 29, "Base", "Estados Unidos", 8),
/* CHICAGO BULLS */
("Zach LaVine", 28, "Escolta", "Estados Unidos", 9),
("DeMar DeRozan", 34, "Alero", "Estados Unidos", 9),
("Coby White", 23, "Base", "Estados Unidos", 9),
("Nikola Vucevic", 33, "Pívot", "Montenegro", 9),
("Patrick Williams", 22, "Alero", "Estados Unidos", 9),
("Alex Caruso", 29, "Base", "Estados Unidos", 9),
/* CHICAGO BULLS */
("Trae Young", 25, "Base", "Estados Unidos", 10),
("Dejounte Murray", 27, "Base", "Estados Unidos", 10),
("Jalen Johnson", 28, "Alero", "Estados Unidos", 10),
("Bogdan Bogdanovic", 31, "Escolta", "Serbia", 10),
("Saddiq Bey", 24, "Alero", "Estados Unidos", 10),
("Clint Capela", 29, "Pívot", "Suiza", 10),
/* BROOKLYN NETS */
("Dennis Schroder", 30, "Base", "Alemania", 11),
("Mikal Bridges", 27, "Alero", "Estados Unidos", 11),
("Cameron Johnson", 27, "Alero", "Estados Unidos", 11),
("Nic Claxton", 24, "Pívot", "Estados Unidos", 11),
("Dorian Finney-Smith", 30, "Alero", "Estados Unidos", 11),
("Lonnie Walker IV", 25, "Escolta", "Estados Unidos", 11),
/* TORONTO RAPTORS */
("Bruce Brown", 27, "Escolta", "Estados Unidos", 12),
("RJ Barrett", 23, "Escolta", "Canadá", 12),
("Scottie Barnes", 22, "Alero", "Estados Unidos", 12),
("Immanuel Quickley", 24, "Base", "Estados Unidos", 12),
("Jakob Poeltl", 28, "Pívot", "Austria", 12),
("Gary Trent Jr.", 25, "Escolta", "Estados Unidos", 12),
/* CHARLOTTE HORNETS */
("Lamelo Ball", 22, "Base", "Estados Unidos", 13),
("Miles Bridges", 25, "Alero", "Estados Unidos", 13),
("Brandon Miller", 21, "Alero", "Estados Unidos", 13),
("Mark Williams", 22, "Pívot", "Estados Unidos", 13),
("Grant Williams", 25, "Alero", "Estados Unidos", 13),
("Nick Richards", 26, "Pívot", "Estados Unidos", 13),
/* CHARLOTTE HORNETS */
("Kyle Kuzma", 28, "Ala-pívot", "Estados Unidos", 14),
("Jordan Poole", 24, "Escolta", "Estados Unidos", 14),
("Tyus Jones", 27, "Base", "Estados Unidos", 14),
("Corey Kispert", 22, "Alero", "Estados Unidos", 14),
("Deni Avdija", 23, "Alero", "Israel", 14),
("Delon Wright", 31, "Base", "Estados Unidos", 14),
/* CHARLOTTE HORNETS */
("Cade Cunningham", 22, "Base", "Estados Unidos", 15),
("Jaden Ivey", 21, "Base", "Estados Unidos", 15),
("Ausar Thompson", 28, "Escolta", "Estados Unidos", 15),
("Isaiah Stewart", 22, "Ala-pívot", "Estados Unidos", 15),
("Jalen Duren", 20, "Pívot", "Estados Unidos", 15),
("Quentin Grimes", 23, "Base", "Estados Unidos", 15),
/* OKLAHOMA CITY THUNDER */
("Shai Gilgeous-Alexander", 25, "Escolta", "Canadá", 16),
("Chet Holmgren", 21, "Pívot", "Estados Unidos", 16),
("Jalen Williams", 22, "Escolta", "Estados Unidos", 16),
("Gordon Hayward", 33, "Alero", "Estados Unidos", 16),
("Joshua Giddey", 21, "Base", "Australia", 16),
("Luguentz Dort", 24, "Alero", "Canadá", 16),
/* MINNESOTA TIMBERWOLVES */
("Karl-Anthony Towns", 28, "Ala-pívot", "Republica Dominicana", 17),
("Anthony Edwards", 22, "Escolta", "Estados Unidos", 17),
("Rudy Gobert", 31, "Pívot", "Francia", 17),
("Mike Conley", 36, "Base", "Estados Unidos", 17),
("Jaden McDaniels", 23, "Alero", "Estados Unidos", 17),
("Kyle Anderson", 30, "Ala-pívot", "Estados Unidos", 17),
/* LOS ANGELES CLIPPERS */
("Paul George", 33, "Alero", "Estados Unidos", 18),
("Kawhi Leonard", 32, "Alero", "Estados Unidos", 18),
("James Harden", 34, "Base", "Estados Unidos", 18),
("Ivica Zubac", 26, "Pívot", "Croacia", 18),
("Norman Powell", 30, "Base", "Estados Unidos", 18),
("Terance Mann", 27, "Escolta", "Estados Unidos", 18),
/* DENVER NUGGETS */
("Nikola Jokic", 28, "Pívot", "Serbia", 19),
("Jamal Murray", 26, "Base", "Canadá", 19),
("Aaron Gordon", 28, "Alero", "Estados Unidos", 19),
("Michael Porter Jr.", 25, "Alero", "Estados Unidos", 19),
("Kentavious Caldwell-Pope", 30, "Escolta", "Estados Unidos", 19),
("Reggie Jackson", 33, "Base", "Estados Unidos", 19),
/* SACRAMENTO KINGS */
("De'Aaron Fox", 26, "Base", "Estados Unidos", 20),
("Domantas Sabonis", 27, "Ala-pívot", "Lituania", 20),
("Keegan Murray", 23, "Alero", "Estados Unidos", 20),
("Malik Monk", 26, "Base", "Estados Unidos", 20),
("Kevin Huerter", 25, "Escolta", "Estados Unidos", 20),
("Harrison Barnes", 30, "Alero", "Estados Unidos", 20),
/* PHOENIX SUNS */
("Kevin Durant", 35, "Alero", "Estados Unidos", 21),
("Devin Booker", 27, "Escolta", "Estados Unidos", 21),
("Bradley Beal", 30, "Base", "Estados Unidos", 21),
("Grayson Allen", 28, "Base", "Estados Unidos", 21),
("Eric Gordon", 35, "Escolta", "Estados Unidos", 21),
("Jusuf Nurkic", 29, "Pívot", "Bosnia-Herzegovina", 21),
/* NEW ORLEANS PELICANS */
("Brandon Ingram", 26, "Alero", "Estados Unidos", 22),
("Zion Williamson", 23, "Ala-pívot", "Estados Unidos", 22),
("Jonas Valanciunas", 31, "Pívot", "Lituania", 22),
("Dyson Daniels", 20, "Base", "Australia", 22),
("Herbert Jones", 25, "Alero", "Estados Unidos", 22),
("CJ McCollum", 32, "Escolta", "Estados Unidos", 22),
/* DALLAS MAVERICKS */
("Luka Doncic", 24, "Escolta", "Eslovenia", 23),
("Kyrie Irving", 31, "Base", "Estados Unidos", 23),
("P.J Washington", 25, "Alero", "Estados Unidos", 23),
("Tim Hardaway Jr.", 31, "Escolta", "Estados Unidos", 23),
("Daniel Gafford", 25, "Ala-pívot", "Estados Unidos", 23),
("Derrick Jones", 26, "Alero", "Estados Unidos", 23),
/* LOS ANGELES LAKERS */
("Anthony Davis", 30, "Ala-pívot", "Estados Unidos", 24),
("LeBron James", 39, "Alero", "Estados Unidos", 24),
("Austin Reaves", 25, "Escolta", "Estados Unidos", 24),
("D'Angelo Russell", 27, "Base", "Estados Unidos", 24),
("Taurean Prince", 29, "Alero", "Estados Unidos", 24),
("Spencer Dinwiddie", 30, "Base", "Estados Unidos", 24),
/* UTAH JAZZ */
("Jordan Clarkson", 31, "Escolta", "Estados Unidos", 25),
("Lauri Markkanen", 26, "Ala-pívot", "Estados Unidos", 25),
("John Collins", 26, "Ala-pívot", "Estados Unidos", 25),
("Kevin Knox", 24, "Alero", "Estados Unidos", 25),
("Keyonte George", 20, "Base", "Estados Unidos", 25),
("Collin Sexton", 25, "Base", "Estados Unidos", 25),
/* UTAH JAZZ */
("Alperen Sengun", 21, "Pívot", "Turquía", 26),
("Fred VanVleet", 29, "Base", "Estados Unidos", 26),
("Jalen Green", 22, "Escolta", "Estados Unidos", 26),
("Jabari Smith", 20, "Ala-pívot", "Estados Unidos", 26),
("Dillon Brooks", 28, "Escolta", "Canadá", 26),
("Tari Eason", 22, "Escolta", "Estados Unidos", 26),
/* GOLDEN STATE WARRIORS */
("Stephen Curry", 35, "Base", "Estados Unidos", 27),
("Andrew Wiggins", 28, "Alero", "Canadá", 27),
("Klay Thompson", 34, "Escolta", "Estados Unidos", 27),
("Draymond Green", 33, "Ala-pívot", "Estados Unidos", 27),
("Chris Paul", 38, "Base", "Estados Unidos", 27),
("Kevon Looney", 28, "Pívot", "Estados Unidos", 27),
/* MEMPHIS GRIZZLIES */
("Ja Morant", 24, "Base", "Estados Unidos", 28),
("Desmond Bane", 25, "Escolta", "Estados Unidos", 28),
("Jaren Jackson Jr.", 24, "Ala-pívot", "Estados Unidos", 28),
("Marcus Smart", 29, "Base", "Estados Unidos", 28),
("Santi Aldama", 23, "Pívot", "España", 28),
("Derrick Rose", 35, "Base", "Estados Unidos", 28),
/* PORTLAND TRAIL BLAZERS */
("Jerami Grant", 29, "Ala-pívot", "Estados Unidos", 29),
("Arfernee Simons", 24, "Base", "Estados Unidos", 29),
("Shaedon Sharpe", 20, "Base", "Canadá", 29),
("Deandre Ayton", 25, "Pívot", "Bahamas", 29),
("Toumani Camara", 23, "Alero", "Bélgica", 29),
("Matisse Thybulle", 26, "Escolta", "Australia", 29),
/* SAN ANTONIO SPURS */
("Victor Wembanyama", 20, "Pívot", "Francia", 30),
("Keldon Johnson", 24, "Escolta", "Estados Unidos", 30),
("Devin Vassell", 23, "Escolta", "Estados Unidos", 30),
("Zach Collins", 26, "Ala-pívot", "Estados Unidos", 30),
("Jeremy Sochan", 20, "Alero", "Polonia", 30),
("Julian Champagnie", 22, "Base", "Estados Unidos", 30);

/* TROFEOS */

INSERT INTO trofeos (nombre, tipo)
VALUES
("In-Season Tournament", "Equipo"),
("NBA Championship", "Equipo"),
("Most Improved Player", "Jugador"),
("Defense Player Of The Year", "Jugador"),
("Sixth Man Of The Year", "Jugador"),
("Bill Russell Finals MVP", "Jugador"),
("NBA MVP", "Jugador"),
("Rookie Of The Year", "Jugador");

/* TROFEOS EQUIPOS */

INSERT INTO trofeos_equipos (idtrofeo, idequipo, cantidad, annos) 
VALUES
/*TROFEOS EQUIPOS De Larry In-Season Tournament*/
(1, 24, 1, "2023"),
/*TROFEOS EQUIPOS De Larry O'Brien Championship*/
(2, 24, 11, "1980, 1982, 1985, 1987, 1988, 2000, 2001, 2002, 2009, 2010, 2020"),
(2, 9, 6, "1991, 1992, 1993, 1996, 1997, 1998"),
(2, 30, 5, "1999, 2003, 2005, 2007, 2014"),
(2, 1, 4, "1981, 1984, 1986, 2008"),
(2, 27, 4, "2015, 2017, 2018, 2022"),
(2, 15, 3, "1989, 1990, 2004"),
(2, 8, 3, "2006, 2012, 2013"),
(2, 26, 2, "1994, 1995"),
(2, 2, 1, "2016"),
(2, 23, 1, "2011"),
(2, 19, 1, "2023"),
(2, 3, 1, "2021"),
(2, 5, 1, "1983"),
(2, 29, 1, "1977"),
(2, 16, 1, "1979"),
(2, 12, 1, "2019"),
(2, 14, 1, "1978");

/* TROFEOS JUGADORES */

/* TROFEOS JUGADORES De Player Most Improved */
INSERT INTO trofeos_jugadores (idtrofeo, idjugador, cantidad, annos)
VALUES
(3, 103, 1, "2013"),
(3, 43, 1, "2015"),
(3, 132, 1, "2016"),
(3, 14, 1, "2017"),
(3, 36, 1, "2019"),
(3, 127, 1, "2020"),
(3, 20, 1, "2021"),
(3, 163, 1, "2022"),
(3, 146, 1, "2023"),
/* TROFEOS JUGADORES De Defense Player Of Year */
(4, 104, 2, "2015, 2016"),
(4, 160, 1, "2017"),
(4, 99, 3, "2018, 2019, 2021"),
(4, 14, 1, "2020"),
(4, 166, 1, "2022"),
(4, 165, 1, "2023"),
/* TROFEOS JUGADORES De Sixth Man Of Year */
(5, 105, 1, "2012"),
(5, 145, 1, "2021"),
(5, 44, 1, "2022"),
/* TROFEOS JUGADORES De Bill Russell Finals MVP */
(6, 140, 4, "2012, 2013, 2016, 2020"),
(6, 121, 2, "2017, 2018"),
(6, 104, 1, "2019"),
(6, 14, 1, "2021"),
(6, 157, 1, "2022"),
(6, 109, 1, "2023"),
/* TROFEOS JUGADORES De NBA MVP */
(7, 140, 4, "2009, 2010, 2012, 2013"),
(7, 168, 1, "2011"),
(7, 157, 2, "2015, 2016"),
(7, 105, 1, "2018"),
(7, 14, 2, "2019, 2020"),
(7, 109, 2, "2021, 2022"),
(7, 25, 1, "2023"),
/* TROFEOS JUGADORES De ROOKIE OF YEAR */
(8, 140, 1, "2004"),
(8, 161, 1, "2006"),
(8, 121, 1, "2008"),
(8, 168, 1, "2009"),
(8, 134, 1, "2012"),
(8, 13, 1, "2013"),
(8, 158, 1, "2015"),
(8, 97, 1, "2016"),
(8, 133, 1, "2019"),
(8, 163, 1, "2020"),
(8, 73, 1, "2021"),
(8, 69, 1, "2022"),
(8, 37, 1, "2023");