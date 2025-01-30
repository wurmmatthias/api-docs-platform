-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Jan 2025 um 15:27
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `api-docs`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `changelog`
--

CREATE TABLE `changelog` (
  `cid` int(11) DEFAULT NULL,
  `timestamp` int(11) NOT NULL,
  `editor` text NOT NULL,
  `whatid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `custom_css`
--

CREATE TABLE `custom_css` (
  `cid` int(11) NOT NULL,
  `css` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `custom_css`
--

INSERT INTO `custom_css` (`cid`, `css`) VALUES
(1, '.navbar {background-color: #B4D455 !important;}\n.footer {background-color: #B4D455;}');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE `posts` (
  `poid` int(11) NOT NULL,
  `to_pid` int(11) NOT NULL,
  `name` text NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `author` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `posts`
--

INSERT INTO `posts` (`poid`, `to_pid`, `name`, `content`, `author`) VALUES
(26, 3, 'Test', '{\"time\":1737974722290,\"blocks\":[{\"id\":\"ZgOdiXsc25\",\"type\":\"paragraph\",\"data\":{\"text\":\"&lt;code&gt;Code&lt;/code&gt;\"}},{\"id\":\"pg2qHo3tVG\",\"type\":\"paragraph\",\"data\":{\"text\":\"Kein Code\"}},{\"id\":\"IbCbSC-Cyz\",\"type\":\"paragraph\",\"data\":{\"text\":\"Code\"}}],\"version\":\"2.30.7\"}', 'Test_User'),
(27, 3, 'code', '{\"time\":1737974805632,\"blocks\":[{\"id\":\"QG2kWmLs3p\",\"type\":\"paragraph\",\"data\":{\"text\":\"--dies soll code sein--\"}}],\"version\":\"2.30.7\"}', 'Test_User'),
(28, 3, 'Code', '{\"time\":1737976028255,\"blocks\":[{\"id\":\"YYW6JxCk-K\",\"type\":\"paragraph\",\"data\":{\"text\":\"Das ist kein Code\"}},{\"id\":\"QnJRDcsBIQ\",\"type\":\"paragraph\",\"data\":{\"text\":\"@@Das aber schon@@\"}}],\"version\":\"2.30.7\"}', 'Test_User'),
(34, 3, 'retzuio', '{\"time\":1737981491932,\"blocks\":[{\"id\":\"gWQZErLtC1\",\"type\":\"code\",\"data\":{\"text\":\"@@Code Cpde Code@@\"}}],\"version\":\"2.30.7\"}', 'Test_User'),
(35, 3, 'fdgdfhg', '{\"time\":1737980807804,\"blocks\":[{\"id\":\"jd4L58cvkb\",\"type\":\"code\",\"data\":{\"text\":\"@@@@Test Test Test@@@@\"}}],\"version\":\"2.30.7\"}', 'Test_User'),
(36, 3, 'Nur Code', '{\"time\":1737981592994,\"blocks\":[{\"id\":\"gVP0GUiRq7\",\"type\":\"code\",\"data\":{\"text\":\"@@Test Test Test@@\"}}],\"version\":\"2.30.7\"}', 'Test_User'),
(37, 3, 'Test Test', '{\"time\":1737981667515,\"blocks\":[{\"id\":\"ByRR-f4YB3\",\"type\":\"code\",\"data\":{\"text\":\"@@Test Edit@@\"}}],\"version\":\"2.30.7\"}', 'Test_User'),
(38, 3, 'HTML', '{\"time\":1738051706059,\"blocks\":[{\"id\":\"8pd07Ia74N\",\"type\":\"raw\",\"data\":{\"html\":\"<Code>Test</Code>\"}}],\"version\":\"2.30.7\"}', 'Test_User'),
(39, 3, 'Test Table', '{\"time\":1738052349145,\"blocks\":[{\"id\":\"Vde8US_Brx\",\"type\":\"table\",\"data\":{\"withHeadings\":false,\"stretched\":false,\"content\":[[\"Head 1\",\"Head 2\",\"Head 3\"],[\"Test 1\",\"Test 2\",\"Test 3\"]]}}],\"version\":\"2.30.7\"}', 'Test_User'),
(40, 3, 'Big Table', '{\"time\":1738053155389,\"blocks\":[{\"id\":\"GC6-OOgqAc\",\"type\":\"table\",\"data\":{\"withHeadings\":false,\"stretched\":false,\"content\":[[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"],[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"],[\"3\",\"4\",\"5\",\"6\",\"7\",\"8\"]]}}],\"version\":\"2.30.7\"}', 'Test_User'),
(42, 3, 'Test Test', '{\"time\":1738061551479,\"blocks\":[{\"id\":\"r3BfPSiRb7\",\"type\":\"table\",\"data\":{\"withHeadings\":true,\"stretched\":false,\"content\":[[\"Test\",\"\",\"\",\"\",\"\",\"\",\"\"],[\"Test\",\"\",\"\",\"\",\"\",\"\",\"\"]]}}],\"version\":\"2.30.7\"}', 'Test_User'),
(50, 16, 'Main Backend Page', '{\"time\":1738245448734,\"blocks\":[{\"id\":\"gtjUDTVhvK\",\"type\":\"header\",\"data\":{\"text\":\"Allgemein\",\"level\":3}},{\"id\":\"K4MA4n4z_4\",\"type\":\"paragraph\",\"data\":{\"text\":\"Die <i>Admin_Main.php</i> ist die landing Page nach dem Login. Dort können angemeldete Nutzer*Innen Projekte (Übergeordneter Inhalt) und Posts (zu Projekten zugehöriger Inhalt) erstellen, bearbeiten und löschen.\"}},{\"id\":\"AJaJGbT2lK\",\"type\":\"paragraph\",\"data\":{\"text\":\"Ebenso bietet sie direkten Zugriff auf weitere administrative Tätigkeiten wie dem anpassen der optischen Erscheinung des Frontends oder der Konfiguration des eigenen Nutzerprofils.\"}},{\"id\":\"73U6kMA-Ga\",\"type\":\"header\",\"data\":{\"text\":\"Erstellen von Projekten\",\"level\":3}},{\"id\":\"ETCcC5nJVS\",\"type\":\"paragraph\",\"data\":{\"text\":\"Sobald ein User auf der linken Seite den➕ Button wählt, öffnet sich das Modal <i>addproject.</i>\"}},{\"id\":\"P7y4ugklN1\",\"type\":\"table\",\"data\":{\"withHeadings\":true,\"stretched\":false,\"content\":[[\"id\",\"value\",\"\"],[\"author\",\"current_user\",\"hidden\"],[\"projectname\",\" Input\",\"\"],[\"projectdescription\",\" Input\",\"\"]]}},{\"id\":\"FmXU_SMFOa\",\"type\":\"paragraph\",\"data\":{\"text\":\"Die Value current_user entspricht dem Nutzernamen des aktuell eingeloggten User, welcher aus der Session ID entnommen wird.\"}},{\"id\":\"O3bSgVCUv9\",\"type\":\"paragraph\",\"data\":{\"text\":\"Die Verarbeitung der Werte erfolgt in <i>addproject.php </i>-&gt;<i> </i>siehe <i>Database</i>\"}},{\"id\":\"T8iL9E9P7K\",\"type\":\"header\",\"data\":{\"text\":\"Bearbeiten von Projekten\",\"level\":3}},{\"id\":\"Lks1ilkuhE\",\"type\":\"paragraph\",\"data\":{\"text\":\"Projekte können mit einem Klick auf den Stift (✏️) bearbeitet werden. Das erscheinende Modal wird mit der <i>pid</i>, also der Projekt ID aufgerufen.\"}},{\"id\":\"76SFwEM5qR\",\"type\":\"table\",\"data\":{\"withHeadings\":false,\"stretched\":false,\"content\":[[\"id\",\"value\",\"\"],[\"author\",\"current_user\",\"hidden\"],[\"projectname\",\"projectname (from DB)\",\"\"],[\"projectdescription\",\"projectdescription (from DB)\",\"\"]]}},{\"id\":\"iCEQu3t7-j\",\"type\":\"paragraph\",\"data\":{\"text\":\"&nbsp;Die Verarbeitung der Werte erfolgt in&nbsp;<i>editproject.php&nbsp;</i>-&gt;<i>&nbsp;</i>siehe&nbsp;<i>Database.</i>\"}},{\"id\":\"Lu_FcD3uMO\",\"type\":\"header\",\"data\":{\"text\":\"Löschen von Projekten\",\"level\":3}},{\"id\":\"Jlh6Mll93-\",\"type\":\"paragraph\",\"data\":{\"text\":\"Projekte können mit einem Klick auf den Mülleimer (🗑️) gelöscht werden. Das erscheinende Modal wird mit der&nbsp;<i>pid</i>, also der Projekt ID aufgerufen.&nbsp;&nbsp;\"}},{\"id\":\"r5YWPyNUup\",\"type\":\"paragraph\",\"data\":{\"text\":\"Beim bestätigen des löschens wird die Seite <i>deleteproject.php</i> -&gt; siehe <i>Database </i>geöffnet und die pid übergeben.\"}},{\"id\":\"JcgYe-VEUk\",\"type\":\"header\",\"data\":{\"text\":\"Anzeige von Projekten\",\"level\":3}},{\"id\":\"Fviis2ioFM\",\"type\":\"paragraph\",\"data\":{\"text\":\"Wenn Projekte in der Database vorhanden sind, werden diese in der linken Spalte angezeigt. Abgerufen wird der <i>projectname</i>, welcher als Hyperlink dargestellt wird. Öffnet man diesen, wird die Seite <i>admin_main.php</i> mit dem Parameter <i>pid</i> geladen, sodass im zentralen Bereich nun der Inhalt des gewählten Projektes dargestellt wird.\"}},{\"id\":\"uiAgJRz-eI\",\"type\":\"paragraph\",\"data\":{\"text\":\"Oben befindet sich die Heading des jeweiligen Projektes, welche als <i>projectname </i>aus der DB abgerufen wird. Darunter befindet sich der Ersteller des Projektes, welcher dem Wert <i>author </i>der DB<i>&nbsp;</i>beim erstellen oder bearbeiten des Projektes entspricht.\"}},{\"id\":\"1zf2HlfXJh\",\"type\":\"header\",\"data\":{\"text\":\"Hinzufügen von Posts\",\"level\":3}},{\"id\":\"tPBNITJzPh\",\"type\":\"paragraph\",\"data\":{\"text\":\"Sobald ein Projekt geöffnet ist befindet sich oben der Button zum hinzufügen von Posts. Dieser leitet auf die <i>addpost_page.php</i> weiter und übergibt den Wert <i>toPID</i>, welcher der PID des aktuellen Projektes entspricht\"}},{\"id\":\"p_l2RPWsqa\",\"type\":\"header\",\"data\":{\"text\":\"Darstellung von Posts\",\"level\":3}},{\"id\":\"0IoV_NcAGa\",\"type\":\"paragraph\",\"data\":{\"text\":\"Posts werden immer in plain HTML dargestellt. Dafür wird der JSON String (Speicherformat des Inhaltes der Posts) aus der DB als <i>postcontent </i>geladen und je nach Datentyp (Heading, Paragraph, Code, ...) unterschiedlich dargestellt. Zum Syntax des JSON String siehe Doku von Editor.js.\"}},{\"id\":\"Ramj8epmcr\",\"type\":\"header\",\"data\":{\"text\":\"Bearbeiten von Posts\",\"level\":3}},{\"id\":\"B93619HTFL\",\"type\":\"paragraph\",\"data\":{\"text\":\"Sind bereits Posts in einem Projekt vorhanden, ist die Überschrift dieser (also der <i>postname</i>) ein Hyperlink, welcher auf die Seite editpost_page.php weiterleitet. Übergeben wird die ID des Posts <i>poid</i>.\"}},{\"id\":\"RYCENNvsqq\",\"type\":\"header\",\"data\":{\"text\":\"Projekt im Frontend ansehen\",\"level\":3}},{\"id\":\"KNyvkSl3O8\",\"type\":\"paragraph\",\"data\":{\"text\":\"In einem Projekt kann mit dem Button Im Frontend ansehen das aktuelle Projekt im Frontend geladen werden. Referenziert wird die <i>Index.php</i> des Frontends und übergeben wird die <i>pid </i>als Doku.\"}},{\"id\":\"ScmUHuiwUz\",\"type\":\"header\",\"data\":{\"text\":\"Sprache wechseln\",\"level\":3}},{\"id\":\"ApBmGgEgZK\",\"type\":\"paragraph\",\"data\":{\"text\":\"Über den Button der Länderflagge (Deutsch oder Englisch) kann ein angemeldeter Nutzer die Sprache der Oberfläche wechseln. Seine Entscheidung wird in seinem Usereintrag in der DB gespeichert als lang en oder de. Der Wechsel der Sprache erfolgt über <i>userLang.php.</i>\"}},{\"id\":\"gJHRYNB-Qu\",\"type\":\"header\",\"data\":{\"text\":\"Benutzerbereich\",\"level\":3}},{\"id\":\"8agBSaS51N\",\"type\":\"paragraph\",\"data\":{\"text\":\"siehe hierzu Doku Benutzerbereich\"}}],\"version\":\"2.31.0-rc.7\"}', 'Test_User'),
(51, 16, 'Addpost_Page', '{\"time\":1738245726294,\"blocks\":[{\"id\":\"iByXY1dKbB\",\"type\":\"header\",\"data\":{\"text\":\"Allgemeines\",\"level\":3}},{\"id\":\"aGxmU0TRgi\",\"type\":\"paragraph\",\"data\":{\"text\":\"Die <i>Addpost_page.php</i> wird mittels Get Request und der ID des Projektes, zu dem der Post gehören soll aufgerufen. Übergeben wird dieser Index als <i>toPID</i>.\"}},{\"id\":\"aHYfNNI6SI\",\"type\":\"header\",\"data\":{\"text\":\"Eingabe\",\"level\":3}},{\"id\":\"ZAu22rDi1p\",\"type\":\"table\",\"data\":{\"withHeadings\":false,\"stretched\":false,\"content\":[[\"id\",\"value\",\"\"],[\"author\",\"current_user\",\"hidden\"],[\"topid\",\"toPID\",\"hidden\"],[\"postname\",\"Input\",\"\"],[\"postcontent\",\"Input (Editor.js)\",\"\"]]}},{\"id\":\"79mNPGts62\",\"type\":\"paragraph\",\"data\":{\"text\":\"Die Weiterverarbeitung der Daten erfolgt in <i>addpost.php</i>. Übergeben werden die oberen Werte mittels Post Request.\"}}],\"version\":\"2.31.0-rc.7\"}', 'Test_User'),
(52, 16, 'Editpost_page', '{\"time\":1738246084406,\"blocks\":[{\"id\":\"bQYf_Yq1BZ\",\"type\":\"header\",\"data\":{\"text\":\"Allgemeines\",\"level\":3}},{\"id\":\"_LNCcpJjAJ\",\"type\":\"paragraph\",\"data\":{\"text\":\"In der <i>Editpost_page.php</i> können Posts bearbeitet werden. Aufgerufen wird diese Seite aus der <i>admin_main.php</i> mit dem <i>poid </i>des zu bearbeitenden Posts.&nbsp;Editpost_page.php\"}},{\"id\":\"cP006px4l3\",\"type\":\"header\",\"data\":{\"text\":\"Abruf von Daten\",\"level\":3}},{\"id\":\"2hmME5fkwy\",\"type\":\"paragraph\",\"data\":{\"text\":\"Die Daten des jeweiligen Posts werden aus der DB abgerufen und als pre-Value in die entsprechenden Felder geladen. Geladen wird sowohl die Überschrift als <i>postname </i>als auch der Editor (JSON String) als <i>postcontent</i>.\"}},{\"id\":\"SiaBz4OI_0\",\"type\":\"header\",\"data\":{\"text\":\"Speichern der Daten\",\"level\":3}},{\"id\":\"U86xBCX03T\",\"type\":\"paragraph\",\"data\":{\"text\":\"Nachdem die Inhalte bearbeitet wurden werden folgende Daten an editpost.php übergeben:\"}},{\"id\":\"njWh-kQN9f\",\"type\":\"table\",\"data\":{\"withHeadings\":false,\"stretched\":false,\"content\":[[\"id\",\"value\",\"\"],[\"pid\",\"pid\",\"hidden\"],[\"poid\",\"poid\",\"hidden\"],[\"author\",\"author\",\"hidden\"]]}}],\"version\":\"2.31.0-rc.7\"}', 'Test_User');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projekte`
--

CREATE TABLE `projekte` (
  `pid` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `author` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `projekte`
--

INSERT INTO `projekte` (`pid`, `name`, `description`, `author`) VALUES
(3, 'Test Projekt', 'Dies ist ein neues und noch nie dagewesenes Testprojekt! bearbeitet', 'Test_User'),
(16, 'API-DOCS-PLATFORM', 'Dies ist die Dokumentation zu dieser Plattform. Zul. bearbeitet am 29.01.2025', 'linus.hermann');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `username` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `password` text NOT NULL,
  `lang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uid`, `username`, `firstname`, `lastname`, `password`, `lang`) VALUES
(4, 'test_user2', 'test', 'user 2', '$2y$10$iJPzXsbZ6lwqONA5i9h9K.1eHnRC1dSUmnQ7ZIj4oGdk5.mWbY4ZO', 'en'),
(5, 'Test_User', 'Test', 'User', '$2y$10$XUA5UOpwEIDmiq4A/URWWOYNyANaKLyX0zV8iZMEqZBIgIVg2Ur9W', 'de'),
(8, 'User2', 'Test', 'User', '$2y$10$naz3Qqk9SghyscVB/JqPsegZDWQvkw/bqVAukcmdKyE2SAN87cXpm', ''),
(9, 'linushermann', 'Linus', 'Hermann', '$2y$10$Gx5l3mhIi0a4V7R1JTTvc.arTAG4FOVXlwwqIzYBbjc6A1pq8zOBW', 'de');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `custom_css`
--
ALTER TABLE `custom_css`
  ADD PRIMARY KEY (`cid`);

--
-- Indizes für die Tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`poid`);

--
-- Indizes für die Tabelle `projekte`
--
ALTER TABLE `projekte`
  ADD PRIMARY KEY (`pid`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `custom_css`
--
ALTER TABLE `custom_css`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `posts`
--
ALTER TABLE `posts`
  MODIFY `poid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT für Tabelle `projekte`
--
ALTER TABLE `projekte`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
