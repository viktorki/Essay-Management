SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


INSERT INTO `essay` (`id`, `title`, `content`, `notes`, `user_id`, `votes_sum`, `votes_count`, `upload_date`, `version`) VALUES
(1, 'Spring Framework', 'Spring Framework e Java ïëàòôîðìà, êîÿòî ïðåäëàãà èíôðàñòðóêòóðíà ïîääðúæêà çà ðàçðàáîòâàíå íà Java ïðèëîæåíèÿ. Òàçè ïëàòôîðìà ñå ãðèæè çà èíôðàñòðóêòóðàòà çà äà ìîæå ðàçðàáîò÷èöèòå äà ñå ôîêóñèðàò âúðõó ñàìîòî ïðèëîæåíèå. ×ðåç Spring ìîãàò äà ñå ñúçäàâàò ñòàðè Java îáåêòè êàòî êúì òÿõ íåèíâàçèâíî ñå ïðèëàãàò enterprise-óñëóãè. Òîâà ìîæå äà ñå ïðèëàãà êàêòî êúì Java SE ìîäåëà, òàêà è êúì ïúëåí èëè ÷àñòè÷åí Java EE ìîäåë.\r\n\r\nÅòî è ïðèìåðè, â êîèòî ìîãàò äà áúäàò èçïîëçâàíè ïðåäèìñòâàòà íà Spring ïëàòôîðìàòà:\r\n    Ìîæåì äà íàïðàâèì Java ìåòîä äà ñå èçïúëíÿâà â òðàíçàêöèÿ áåç äà ñå íàëàãà äà èçïîëçâàìå òðàíçàêöèîííè API.\r\n    Ìîæåì äà ïðåîáðàçóâàìå ëîêàëåí Java ìåòîä â îòäàëå÷åíà (remote) ïðîöåäóðà áåç äà èìàìå íóæäà îò remote API.\r\n    Ìîæåì äà ïðåîáðàçóâàìå ëîêàëåí Java ìåòîä â óïðàâëÿâàùà îïåðàöèÿ áåç äà èìàìå íóæäà îò JMX API.\r\n    Ìîæåì äà èçïîëçâàìå ëîêàëåí Java ìåòîä êàòî îáðàáîò÷èê íà ñúîáùåíèÿ (message handler) áåç äà èçïîëçâàìå JMS API.\r\n\r\nÇà íàìàëÿâàíå íà çàâèñèìîñòèòå ìåæäó îòäåëíèòå êëàñîâå â ïðèëîæåíèåòî ñå èçïîëçâàò Inversion of Control (IoC) è Dependancy Injection. Inversion of Control êîíòåéíåðà ñòîè â îñíîâàòà íà Spring Framework. Òîé îñèãóðÿâà ïîñëåäîâàòåëíè ñðåäñòâà çà êîíôèãóðèðàíå è óïðàâëåíèå íà Java îáåêòè. Êîíòåéíåðúò å îòãîâîðåí çà óïðàâëåíèåòî íà æèçíåíèÿ öèêúë íà ñïåöèôè÷íè îáåêòè: ñúçäàâàíåòî íà òåçè îáåêòè, èçâèêâàíåòî íà èíèöèàëèçèðàùèòå èì ìåòîäè è êîíôèãóðèðàíåòî èì. ×ðåç íåãî îáåêòèòå ñå ñâúðçâàò â åäíî öÿëî. Îáåêòèòå, ñúçäàäåíè îò êîíòåéíåðà ñå íàðè÷àò óïðàâëÿâàíè îáåêòè èëè áèéíîâå (beans). Êîíòåéíåðúò ìîæå äà áúäå êîíôèãóðèðàí ÷ðåç XML ôàéëîâå èëè ÷ðåç çàñè÷àíå íà ñïåöèôè÷íè Java àíîòàöèè îò êîíôèãóðèðàùèòå êëàñîâå.', '', 2, 9, 2, '2015-02-06', 1);

INSERT INTO `subject` (`id`, `title`) VALUES
(1, 'Spring Framework'),
(2, 'nginx'),
(3, 'Strts'),
(4, 'Django');

INSERT INTO `user` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `role`, `fn`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Èâàí', 'Ïåòðîâ', 'Èâàíîâ', 2, NULL),
(2, 'viktorki', '11a120bccf0cdcac02be4fe5f0a2ec09bd0a027c', 'Âèêòîð', 'Êðàñåíîâ', 'Èâàíîâ', 1, 80720),
(3, 'gtodorova', '1bf453eb668770e1a634b470a91930f03e07f4c5', 'Ãåðãàíà', 'Òîäîðîâà', 'Òîäîðîâà', 1, 80711);

INSERT INTO `user_vote` (`user_id`, `essay_id`, `grade`) VALUES
(1, 1, 4),
(3, 1, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
