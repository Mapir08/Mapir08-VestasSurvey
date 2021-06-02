-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 01, 2021 at 08:46 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `img` varchar(10) NOT NULL,
  `reponse` int(11) NOT NULL,
  `choix1` varchar(200) NOT NULL,
  `choix2` varchar(200) NOT NULL,
  `choix3` varchar(200) NOT NULL,
  `choix4` varchar(200) NOT NULL,
  `typeQ` varchar(1) NOT NULL,
  `niveau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `img`, `reponse`, `choix1`, `choix2`, `choix3`, `choix4`, `typeQ`, `niveau`) VALUES
(1, 'A quoi correspond le symbole ci-dessous ?', 'pict1', 4, 'Un contacteur', 'Un disjoncteur', 'Un fusible', 'Un transformateur', 'E', 1),
(2, 'Quel est le composant sur la photos ?', 'pict2', 3, 'Un contacteur', 'Un disjoncteur', 'Un relai thermique', 'Un transformateur', 'E', 1),
(3, 'A quoi correspond le symbole ci-dessous ?', 'pict3', 1, 'Un contacteur', 'Un disjoncteur', 'Un fusible', 'Un transformateur', 'E', 1),
(4, 'A quoi correspond le symbole ci-dessous ?', 'pict4', 2, 'Un contacteur', 'Un disjoncteur magnéto-thermique', 'Un fusible', 'Un transformateur', 'E', 1),
(5, 'Quel est la différence entre un relais et un contacteur ?', '', 2, 'Le contacteur permet de supporter des courants plus faibles', 'Le contacteur permet de supporter des courants plus forts', '', '', 'E', 1),
(6, 'A quoi correspond le symbole ci-dessous ?', 'pict5', 3, 'Un contacteur', 'Un disjoncteur magnéto-thermique', 'Un fusible', 'Un transformateur', 'E', 1),
(7, 'Quel est le composant représenté sur l\'image ?', 'pict6', 3, 'Capteur électromagnétique', 'Capteur photo-électrique', 'Fin de course', 'Inter verrouillage', 'E', 1),
(8, 'Un voyant est un élément de :', '', 2, 'La partie puissance', 'La partie commande', '', '', 'E', 1),
(9, 'Choisissez la bonne affirmation :', '', 1, 'Pour tester la bobine d\'un contacteur, il faut utiliser un Ohmmètre', 'Pour tester la bobine d\'un contacteur, il faut utiliser un ampèremètre', '', '', 'E', 1),
(10, 'Choisissez la bonne affirmation :', '', 1, 'Un contacteur n\'a pas de pouvoir de coupure', 'Un contacteur a un pouvoir de coupure', '', '', 'E', 1),
(11, 'Choisissez la bonne affirmation :', '', 2, 'Un disjoncteur différentiel permet de protéger contre les surcharges', 'Un disjoncteur différentiel permet de protéger contre les défauts d\'isolement', '', '', 'E', 1),
(12, 'Choisissez la bonne affirmation :', '', 2, 'Un variateur de vitesse fait varier la vitesse d\'un moteur en agissant sur son couple', 'Un variateur de vitesse fait varier la vitesse d\'un moteur en agissant sur sa fréquence', '', '', 'E', 1),
(13, 'Quel sorte de matériau peut détecter un capteur de proximité inductif ?', '', 2, 'Bois', 'Métal', 'Plastique', 'Bois, Métal, et Plastique', 'E', 1),
(14, 'Dans cette configuration, qu\'est ce qui est mesuré ?', 'pict7', 1, 'Une tension', 'Une résistance', 'Une capacitance', 'Un courant', 'E', 1),
(15, 'L\'unité de la capacité électrique est :', '', 3, 'L\'ampère-heure', 'Le coulomb', 'Le farad', 'Le faraday', 'E', 1),
(16, 'Quel câblage correspond à un couplage étoile ?', 'pict8', 1, '1)', '2)', '', '', 'E', 1),
(17, 'La protection des appareils contre les courts-circuits est assurée par :', '', 2, 'L\'interrupteur différentiel', 'Le fusible ou le disjoncteur', 'Le relai thermique', '', 'E', 1),
(18, 'La sécurité des personnes est assurée par :', '', 1, 'Le disjoncteur différentiel', 'Le fusible', 'Le disjoncteur', '', 'E', 1),
(19, 'Parmi ces différents composants lequel est un actionneur ?', '', 3, 'Distributeur pneumatique', 'Bouton poussoir', 'Vérin pneumatique', '', 'E', 1),
(20, 'Quel est le rôle d\'un relais thermique ?', '', 3, 'Protéger le moteur contre les emballements', 'Protéger les moteur contre les court-circuit', 'Protéger le moteur contre les surcharges', '', 'E', 1),
(21, 'Quel est le rôle d\'un contacteur ?', '', 1, 'Etablir ou interrompre un circuit de charge', 'Arrêter un moteur', 'Démarrer un moteur', '', 'E', 1),
(22, 'Quel est le composant qui permet d\'isoler un circuit afin d\'effectuer des opérations de maintenance ?', '', 1, 'Sectionneur', 'Disjoncteur', 'Contacteur auxiliaire', '', 'E', 1),
(23, 'Quel est ce couplage ?', 'pict9', 1, 'Etoile', 'Triangle', '', '', 'E', 1),
(24, 'Quel est le composant représenté sur l\'image ?', 'pict10', 2, 'Distributeur 2/3', 'Distributeur 3/2', 'Distributeur 5/2', '', 'H', 1),
(25, 'A quoi correspond le symbole ci-dessous ?', 'pict11', 1, 'Une pompe', 'Un variateur', 'Un limiteur de débit', 'Un distributeur', 'H', 1),
(26, 'A quoi correspond le symbole ci-dessous ?', 'pict12', 2, 'Une pompe', 'Un accumulateur', 'Un verin', 'Une vanne', 'H', 1),
(27, 'A quoi correspond le symbole ci-dessous ?', 'pict13', 3, 'Un limiteur de débit', 'Un étrangleur', 'Un limiteur de débit variable', 'Un variateur', 'H', 1),
(28, 'Quel est la fonction d\'un clapet anti-retour ?', '', 3, 'Réduit le débit d\'un circuit', 'Augmente la pression d\'un circuit', 'Laisse passer un fluide dans un sens ', 'Diminue la pression du circuit', 'H', 1),
(29, 'A quoi correspond le symbole ci-dessous ?', 'pict14', 4, 'Un étrangleur', 'Un distributeur', 'Un limiteur de débit', 'Un clapet anti-retour', 'H', 1),
(30, 'A quoi correspond le symbole ci-dessous ?', 'pict15', 2, 'Un étrangleur', 'Un distributeur', 'Un verin', 'Un clapet anti-retour', 'H', 1),
(31, 'Qu\'est ce qu\'un isolant électrique ?', '', 4, 'Un non-métal', 'Un métal', 'Un matériau qui ne conduit pas la chaleur', 'Un matériau qui ne conduit pas l\'électricité', 'E', 1),
(32, 'Qu\'est ce que le symbole ci-dessous :', 'pict16', 3, 'Une résistance', 'Un condensateur', 'Une batterie', 'Une bobine', 'E', 1),
(33, 'Quel lampe est allumé ?', 'pict17', 1, 'A)', 'B)', 'C)', '', 'E', 1),
(34, 'Une batterie fournit un courant ...', '', 3, 'Alternatif', 'Synchrone', 'Continu', 'Haché', 'E', 1),
(35, 'Qu\'appelle-t-on un circuit électrique ouvert ?', '', 1, 'Un circuit ou le courant ne circule plus', 'Un circuit ou le courant circule', 'Un circuit interconnecté avec un autre', 'Un circuit avec les fils à nue', 'E', 1),
(36, 'Si la pression est égale du coté rouge et bleu, de quel côté va se déplacer la tige du vérin ?', 'pict18', 2, 'Coté 1', 'Coté 2', 'Ne bouge pas', '', 'H', 1),
(37, 'Quel vérin est double effet ?', 'pict19', 3, 'Vérin 1', 'Vérin 2', 'Vérin 3', 'Vérin 1 et 2', 'H', 1),
(38, 'Quel élément dans le schéma protège le circuit (élément de sécurité) ?', 'pict20', 1, 'Position 3', 'Position 4', 'Position 5', 'Position 7', 'H', 1),
(39, 'Quel test est effectué sur cette image ?', 'pict21', 1, 'Contrôle du courant', 'Contrôle de la tension', 'Contrôle de résistance', 'Vérification du serrage du câble', 'E', 1),
(40, 'A quoi correspond ce symbole ?', 'pict22', 3, 'Un réservoir', 'Un drain', 'Un filtre', 'Un manomètre', 'H', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
