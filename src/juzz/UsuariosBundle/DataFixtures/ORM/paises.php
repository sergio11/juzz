<?php

namespace juzz\EpisodiosBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use juzz\UsuariosBundle\Entity\Paises AS CountryEntity;

/*
    Los accesorios de Doctrine2 son clases PHP que pueden crear y persistir objetos a la base de datos.
    Al igual que todas las clases en Symfony2, los accesorios deben vivir dentro de uno de los paquetes de tu aplicación.
*/
class PaisesFixture extends AbstractFixture implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        //Uusarios de Prueba
        $countries = array(
          array("id" => 1,"iso" => "AF","nombre" => "Afganistán"),
          array("id" => 2,"iso" => "AX","nombre" => "Islas Gland"),
          array("id" => 3,"iso" => "AL","nombre" => "Albania"),
          array("id" => 4,"iso" => "DE","nombre" => "Alemania"),
          array("id" => 5,"iso" => "AD","nombre" => "Andorra"),
          array("id" => 6,"iso" => "AO","nombre" => "Angola"),
          array("id" => 7,"iso" => "AI","nombre" => "Anguilla"),
          array("id" => 8,"iso" => "AQ","nombre" => "Antártida"),
          array("id" => 9,"iso" => "AG","nombre" => "Antigua y Barbuda"),
          array("id" => 10,"iso" => "AN","nombre" => "Antillas Holandesas"),
          array("id" => 11,"iso" => "SA","nombre" => "Arabia Saudí"),
          array("id" => 12,"iso" => "DZ","nombre" => "Argelia"),
          array("id" => 13,"iso" => "AR","nombre" => "Argentina"),
          array("id" => 14,"iso" => "AM","nombre" => "Armenia"),
          array("id" => 15,"iso" => "AW","nombre" => "Aruba"),
          array("id" => 16,"iso" => "AU","nombre" => "Australia"),
          array("id" => 17,"iso" => "AT","nombre" => "Austria"),
          array("id" => 18,"iso" => "AZ","nombre" => "Azerbaiyán"),
          array("id" => 19,"iso" => "BS","nombre" => "Bahamas"),
          array("id" => 20,"iso" => "BH","nombre" => "Bahréin"),
          array("id" => 21,"iso" => "BD","nombre" => "Bangladesh"),
          array("id" => 22,"iso" => "BB","nombre" => "Barbados"),
          array("id" => 23,"iso" => "BY","nombre" => "Bielorrusia"),
          array("id" => 24,"iso" => "BE","nombre" => "Bélgica"),
          array("id" => 25,"iso" => "BZ","nombre" => "Belice"),
          array("id" => 26,"iso" => "BJ","nombre" => "Benin"),
          array("id" => 27,"iso" => "BM","nombre" => "Bermudas"),
          array("id" => 28,"iso" => "BT","nombre" => "Bhután"),
          array("id" => 29,"iso" => "BO","nombre" => "Bolivia"),
          array("id" => 30,"iso" => 'BA',"nombre" => 'Bosnia y Herzegovina'),
          array("id" => 31,"iso" => 'BW',"nombre" => 'Botsuana'),
          array("id" => 32,"iso" => 'BV',"nombre" => 'Isla Bouvet'),
          array("id" => 33,"iso" => 'BR',"nombre" => 'Brasil'),
          array("id" => 34,"iso" => 'BN',"nombre" => 'Brunéi'),
          array("id" => 35,"iso" => 'BG',"nombre" => 'Bulgaria'),
          array("id" => 36,"iso" => 'BF',"nombre" => 'Burkina Faso'),
          array("id" => 37,"iso" => 'BI',"nombre" => 'Burundi'),
          array("id" => 38,"iso" => 'CV',"nombre" => 'Cabo Verde'),
          array("id" => 39,"iso" => 'KY',"nombre" => 'Islas Caimán'),
          array("id" => 40,"iso" => 'KH',"nombre" => 'Camboya'),
          array("id" => 41,"iso" => 'CM',"nombre" => 'Camerún'),
          array("id" => 42,"iso" => 'CA',"nombre" => 'Canadá'),
          array("id" => 43,"iso" => 'CF',"nombre" => 'República Centroafricana'),
          array("id" => 44,"iso" => 'TD',"nombre" => 'Chad'),
          array("id" => 45,"iso" => 'CZ',"nombre" => 'República Checa'),
          array("id" => 46,"iso" => 'CL',"nombre" => 'Chile'),
          array("id" => 47,"iso" => 'CN',"nombre" => 'China'),
          array("id" => 73,"iso" => 'ES',"nombre" => 'España')
          
        );

        foreach ($countries as $country) {
            $countryEntity = new CountryEntity();
            $countryEntity->setId($country['id']);
            $countryEntity->setIso($country['iso']);
            $countryEntity->setNombre($country['nombre']);
            $manager->persist($countryEntity);
        }

        $manager->flush();

    }
}


/*

  INSERT INTO `paises` VALUES(48, 'CY', 'Chipre');
INSERT INTO `paises` VALUES(49, 'CX', 'Isla de Navidad');
INSERT INTO `paises` VALUES(50, 'VA', 'Ciudad del Vaticano');
INSERT INTO `paises` VALUES(51, 'CC', 'Islas Cocos');
INSERT INTO `paises` VALUES(52, 'CO', 'Colombia');
INSERT INTO `paises` VALUES(53, 'KM', 'Comoras');
INSERT INTO `paises` VALUES(54, 'CD', 'República Democrática del Congo');
INSERT INTO `paises` VALUES(55, 'CG', 'Congo');
INSERT INTO `paises` VALUES(56, 'CK', 'Islas Cook');
INSERT INTO `paises` VALUES(57, 'KP', 'Corea del Norte');
INSERT INTO `paises` VALUES(58, 'KR', 'Corea del Sur');
INSERT INTO `paises` VALUES(59, 'CI', 'Costa de Marfil');
INSERT INTO `paises` VALUES(60, 'CR', 'Costa Rica');
INSERT INTO `paises` VALUES(61, 'HR', 'Croacia');
INSERT INTO `paises` VALUES(62, 'CU', 'Cuba');
INSERT INTO `paises` VALUES(63, 'DK', 'Dinamarca');
INSERT INTO `paises` VALUES(64, 'DM', 'Dominica');
INSERT INTO `paises` VALUES(65, 'DO', 'República Dominicana');
INSERT INTO `paises` VALUES(66, 'EC', 'Ecuador');
INSERT INTO `paises` VALUES(67, 'EG', 'Egipto');
INSERT INTO `paises` VALUES(68, 'SV', 'El Salvador');
INSERT INTO `paises` VALUES(69, 'AE', 'Emiratos Árabes Unidos');
INSERT INTO `paises` VALUES(70, 'ER', 'Eritrea');
INSERT INTO `paises` VALUES(71, 'SK', 'Eslovaquia');
INSERT INTO `paises` VALUES(72, 'SI', 'Eslovenia');
INSERT INTO `paises` VALUES(73, 'ES', 'España');
INSERT INTO `paises` VALUES(74, 'UM', 'Islas ultramarinas de Estados Unidos');
INSERT INTO `paises` VALUES(75, 'US', 'Estados Unidos');
INSERT INTO `paises` VALUES(76, 'EE', 'Estonia');
INSERT INTO `paises` VALUES(77, 'ET', 'Etiopía');
INSERT INTO `paises` VALUES(78, 'FO', 'Islas Feroe');
INSERT INTO `paises` VALUES(79, 'PH', 'Filipinas');
INSERT INTO `paises` VALUES(80, 'FI', 'Finlandia');
INSERT INTO `paises` VALUES(81, 'FJ', 'Fiyi');
INSERT INTO `paises` VALUES(82, 'FR', 'Francia');
INSERT INTO `paises` VALUES(83, 'GA', 'Gabón');
INSERT INTO `paises` VALUES(84, 'GM', 'Gambia');
INSERT INTO `paises` VALUES(85, 'GE', 'Georgia');
INSERT INTO `paises` VALUES(86, 'GS', 'Islas Georgias del Sur y Sandwich del Sur');
INSERT INTO `paises` VALUES(87, 'GH', 'Ghana');
INSERT INTO `paises` VALUES(88, 'GI', 'Gibraltar');
INSERT INTO `paises` VALUES(89, 'GD', 'Granada');
INSERT INTO `paises` VALUES(90, 'GR', 'Grecia');
INSERT INTO `paises` VALUES(91, 'GL', 'Groenlandia');
INSERT INTO `paises` VALUES(92, 'GP', 'Guadalupe');
INSERT INTO `paises` VALUES(93, 'GU', 'Guam');
INSERT INTO `paises` VALUES(94, 'GT', 'Guatemala');
INSERT INTO `paises` VALUES(95, 'GF', 'Guayana Francesa');
INSERT INTO `paises` VALUES(96, 'GN', 'Guinea');
INSERT INTO `paises` VALUES(97, 'GQ', 'Guinea Ecuatorial');
INSERT INTO `paises` VALUES(98, 'GW', 'Guinea-Bissau');
INSERT INTO `paises` VALUES(99, 'GY', 'Guyana');
INSERT INTO `paises` VALUES(100, 'HT', 'Haití');
INSERT INTO `paises` VALUES(101, 'HM', 'Islas Heard y McDonald');
INSERT INTO `paises` VALUES(102, 'HN', 'Honduras');
INSERT INTO `paises` VALUES(103, 'HK', 'Hong Kong');
INSERT INTO `paises` VALUES(104, 'HU', 'Hungría');
INSERT INTO `paises` VALUES(105, 'IN', 'India');
INSERT INTO `paises` VALUES(106, 'ID', 'Indonesia');
INSERT INTO `paises` VALUES(107, 'IR', 'Irán');
INSERT INTO `paises` VALUES(108, 'IQ', 'Iraq');
INSERT INTO `paises` VALUES(109, 'IE', 'Irlanda');
INSERT INTO `paises` VALUES(110, 'IS', 'Islandia');
INSERT INTO `paises` VALUES(111, 'IL', 'Israel');
INSERT INTO `paises` VALUES(112, 'IT', 'Italia');
INSERT INTO `paises` VALUES(113, 'JM', 'Jamaica');
INSERT INTO `paises` VALUES(114, 'JP', 'Japón');
INSERT INTO `paises` VALUES(115, 'JO', 'Jordania');
INSERT INTO `paises` VALUES(116, 'KZ', 'Kazajstán');
INSERT INTO `paises` VALUES(117, 'KE', 'Kenia');
INSERT INTO `paises` VALUES(118, 'KG', 'Kirguistán');
INSERT INTO `paises` VALUES(119, 'KI', 'Kiribati');
INSERT INTO `paises` VALUES(120, 'KW', 'Kuwait');
INSERT INTO `paises` VALUES(121, 'LA', 'Laos');
INSERT INTO `paises` VALUES(122, 'LS', 'Lesotho');
INSERT INTO `paises` VALUES(123, 'LV', 'Letonia');
INSERT INTO `paises` VALUES(124, 'LB', 'Líbano');
INSERT INTO `paises` VALUES(125, 'LR', 'Liberia');
INSERT INTO `paises` VALUES(126, 'LY', 'Libia');
INSERT INTO `paises` VALUES(127, 'LI', 'Liechtenstein');
INSERT INTO `paises` VALUES(128, 'LT', 'Lituania');
INSERT INTO `paises` VALUES(129, 'LU', 'Luxemburgo');
INSERT INTO `paises` VALUES(130, 'MO', 'Macao');
INSERT INTO `paises` VALUES(131, 'MK', 'ARY Macedonia');
INSERT INTO `paises` VALUES(132, 'MG', 'Madagascar');
INSERT INTO `paises` VALUES(133, 'MY', 'Malasia');
INSERT INTO `paises` VALUES(134, 'MW', 'Malawi');
INSERT INTO `paises` VALUES(135, 'MV', 'Maldivas');
INSERT INTO `paises` VALUES(136, 'ML', 'Malí');
INSERT INTO `paises` VALUES(137, 'MT', 'Malta');
INSERT INTO `paises` VALUES(138, 'FK', 'Islas Malvinas');
INSERT INTO `paises` VALUES(139, 'MP', 'Islas Marianas del Norte');
INSERT INTO `paises` VALUES(140, 'MA', 'Marruecos');
INSERT INTO `paises` VALUES(141, 'MH', 'Islas Marshall');
INSERT INTO `paises` VALUES(142, 'MQ', 'Martinica');
INSERT INTO `paises` VALUES(143, 'MU', 'Mauricio');
INSERT INTO `paises` VALUES(144, 'MR', 'Mauritania');
INSERT INTO `paises` VALUES(145, 'YT', 'Mayotte');
INSERT INTO `paises` VALUES(146, 'MX', 'México');
INSERT INTO `paises` VALUES(147, 'FM', 'Micronesia');
INSERT INTO `paises` VALUES(148, 'MD', 'Moldavia');
INSERT INTO `paises` VALUES(149, 'MC', 'Mónaco');
INSERT INTO `paises` VALUES(150, 'MN', 'Mongolia');
INSERT INTO `paises` VALUES(151, 'MS', 'Montserrat');
INSERT INTO `paises` VALUES(152, 'MZ', 'Mozambique');
INSERT INTO `paises` VALUES(153, 'MM', 'Myanmar');
INSERT INTO `paises` VALUES(154, 'NA', 'Namibia');
INSERT INTO `paises` VALUES(155, 'NR', 'Nauru');
INSERT INTO `paises` VALUES(156, 'NP', 'Nepal');
INSERT INTO `paises` VALUES(157, 'NI', 'Nicaragua');
INSERT INTO `paises` VALUES(158, 'NE', 'Níger');
INSERT INTO `paises` VALUES(159, 'NG', 'Nigeria');
INSERT INTO `paises` VALUES(160, 'NU', 'Niue');
INSERT INTO `paises` VALUES(161, 'NF', 'Isla Norfolk');
INSERT INTO `paises` VALUES(162, 'NO', 'Noruega');
INSERT INTO `paises` VALUES(163, 'NC', 'Nueva Caledonia');
INSERT INTO `paises` VALUES(164, 'NZ', 'Nueva Zelanda');
INSERT INTO `paises` VALUES(165, 'OM', 'Omán');
INSERT INTO `paises` VALUES(166, 'NL', 'Países Bajos');
INSERT INTO `paises` VALUES(167, 'PK', 'Pakistán');
INSERT INTO `paises` VALUES(168, 'PW', 'Palau');
INSERT INTO `paises` VALUES(169, 'PS', 'Palestina');
INSERT INTO `paises` VALUES(170, 'PA', 'Panamá');
INSERT INTO `paises` VALUES(171, 'PG', 'Papúa Nueva Guinea');
INSERT INTO `paises` VALUES(172, 'PY', 'Paraguay');
INSERT INTO `paises` VALUES(173, 'PE', 'Perú');
INSERT INTO `paises` VALUES(174, 'PN', 'Islas Pitcairn');
INSERT INTO `paises` VALUES(175, 'PF', 'Polinesia Francesa');
INSERT INTO `paises` VALUES(176, 'PL', 'Polonia');
INSERT INTO `paises` VALUES(177, 'PT', 'Portugal');
INSERT INTO `paises` VALUES(178, 'PR', 'Puerto Rico');
INSERT INTO `paises` VALUES(179, 'QA', 'Qatar');
INSERT INTO `paises` VALUES(180, 'GB', 'Reino Unido');
INSERT INTO `paises` VALUES(181, 'RE', 'Reunión');
INSERT INTO `paises` VALUES(182, 'RW', 'Ruanda');
INSERT INTO `paises` VALUES(183, 'RO', 'Rumania');
INSERT INTO `paises` VALUES(184, 'RU', 'Rusia');
INSERT INTO `paises` VALUES(185, 'EH', 'Sahara Occidental');
INSERT INTO `paises` VALUES(186, 'SB', 'Islas Salomón');
INSERT INTO `paises` VALUES(187, 'WS', 'Samoa');
INSERT INTO `paises` VALUES(188, 'AS', 'Samoa Americana');
INSERT INTO `paises` VALUES(189, 'KN', 'San Cristóbal y Nevis');
INSERT INTO `paises` VALUES(190, 'SM', 'San Marino');
INSERT INTO `paises` VALUES(191, 'PM', 'San Pedro y Miquelón');
INSERT INTO `paises` VALUES(192, 'VC', 'San Vicente y las Granadinas');
INSERT INTO `paises` VALUES(193, 'SH', 'Santa Helena');
INSERT INTO `paises` VALUES(194, 'LC', 'Santa Lucía');
INSERT INTO `paises` VALUES(195, 'ST', 'Santo Tomé y Príncipe');
INSERT INTO `paises` VALUES(196, 'SN', 'Senegal');
INSERT INTO `paises` VALUES(197, 'CS', 'Serbia y Montenegro');
INSERT INTO `paises` VALUES(198, 'SC', 'Seychelles');
INSERT INTO `paises` VALUES(199, 'SL', 'Sierra Leona');
INSERT INTO `paises` VALUES(200, 'SG', 'Singapur');
INSERT INTO `paises` VALUES(201, 'SY', 'Siria');
INSERT INTO `paises` VALUES(202, 'SO', 'Somalia');
INSERT INTO `paises` VALUES(203, 'LK', 'Sri Lanka');
INSERT INTO `paises` VALUES(204, 'SZ', 'Suazilandia');
INSERT INTO `paises` VALUES(205, 'ZA', 'Sudáfrica');
INSERT INTO `paises` VALUES(206, 'SD', 'Sudán');
INSERT INTO `paises` VALUES(207, 'SE', 'Suecia');
INSERT INTO `paises` VALUES(208, 'CH', 'Suiza');
INSERT INTO `paises` VALUES(209, 'SR', 'Surinam');
INSERT INTO `paises` VALUES(210, 'SJ', 'Svalbard y Jan Mayen');
INSERT INTO `paises` VALUES(211, 'TH', 'Tailandia');
INSERT INTO `paises` VALUES(212, 'TW', 'Taiwán');
INSERT INTO `paises` VALUES(213, 'TZ', 'Tanzania');
INSERT INTO `paises` VALUES(214, 'TJ', 'Tayikistán');
INSERT INTO `paises` VALUES(215, 'IO', 'Territorio Británico del Océano Índico');
INSERT INTO `paises` VALUES(216, 'TF', 'Territorios Australes Franceses');
INSERT INTO `paises` VALUES(217, 'TL', 'Timor Oriental');
INSERT INTO `paises` VALUES(218, 'TG', 'Togo');
INSERT INTO `paises` VALUES(219, 'TK', 'Tokelau');
INSERT INTO `paises` VALUES(220, 'TO', 'Tonga');
INSERT INTO `paises` VALUES(221, 'TT', 'Trinidad y Tobago');
INSERT INTO `paises` VALUES(222, 'TN', 'Túnez');
INSERT INTO `paises` VALUES(223, 'TC', 'Islas Turcas y Caicos');
INSERT INTO `paises` VALUES(224, 'TM', 'Turkmenistán');
INSERT INTO `paises` VALUES(225, 'TR', 'Turquía');
INSERT INTO `paises` VALUES(226, 'TV', 'Tuvalu');
INSERT INTO `paises` VALUES(227, 'UA', 'Ucrania');
INSERT INTO `paises` VALUES(228, 'UG', 'Uganda');
INSERT INTO `paises` VALUES(229, 'UY', 'Uruguay');
INSERT INTO `paises` VALUES(230, 'UZ', 'Uzbekistán');
INSERT INTO `paises` VALUES(231, 'VU', 'Vanuatu');
INSERT INTO `paises` VALUES(232, 'VE', 'Venezuela');
INSERT INTO `paises` VALUES(233, 'VN', 'Vietnam');
INSERT INTO `paises` VALUES(234, 'VG', 'Islas Vírgenes Británicas');
INSERT INTO `paises` VALUES(235, 'VI', 'Islas Vírgenes de los Estados Unidos');
INSERT INTO `paises` VALUES(236, 'WF', 'Wallis y Futuna');
INSERT INTO `paises` VALUES(237, 'YE', 'Yemen');
INSERT INTO `paises` VALUES(238, 'DJ', 'Yibuti');
INSERT INTO `paises` VALUES(239, 'ZM', 'Zambia');
INSERT INTO `paises` VALUES(240, 'ZW', 'Zimbabue');

*/