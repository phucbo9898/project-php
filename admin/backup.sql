DROP TABLE image_library;

CREATE TABLE `image_library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4;

INSERT INTO image_library VALUES("28","40","uploads/10-12-2020/pd2.jpg","1607621507","1607621507");
INSERT INTO image_library VALUES("30","40","uploads/10-12-2020/pd4.jpg","1607621507","1607621507");
INSERT INTO image_library VALUES("31","1","uploads/10-12-2020/pd2(1).jpg","1607622412","1607622412");
INSERT INTO image_library VALUES("32","1","uploads/10-12-2020/pd4(1).jpg","1607622412","1607622412");
INSERT INTO image_library VALUES("43","50","uploads/14-12-2020/8af769baf25f4ebe5516322e59e0b28ee3404b72(1).jpg","1607972566","1607972566");
INSERT INTO image_library VALUES("44","50","uploads/14-12-2020/515e2e3d461a1f0f0e2ec94119f14eb1685d5e97(1).jpg","1607972566","1607972566");
INSERT INTO image_library VALUES("45","51","uploads/14-12-2020/8af769baf25f4ebe5516322e59e0b28ee3404b72(1).jpg","1607973066","1607973066");
INSERT INTO image_library VALUES("46","51","uploads/14-12-2020/515e2e3d461a1f0f0e2ec94119f14eb1685d5e97(1).jpg","1607973066","1607973066");
INSERT INTO image_library VALUES("47","52","uploads/14-12-2020/8af769baf25f4ebe5516322e59e0b28ee3404b72(1).jpg","1607973085","1607973085");
INSERT INTO image_library VALUES("48","52","uploads/14-12-2020/515e2e3d461a1f0f0e2ec94119f14eb1685d5e97(1).jpg","1607973085","1607973085");
INSERT INTO image_library VALUES("50","53","uploads/14-12-2020/515e2e3d461a1f0f0e2ec94119f14eb1685d5e97(1).jpg","1607974328","1607974328");
INSERT INTO image_library VALUES("51","54","uploads/14-12-2020/515e2e3d461a1f0f0e2ec94119f14eb1685d5e97(1).jpg","1607974354","1607974354");
INSERT INTO image_library VALUES("54","56","uploads/15-12-2020/8af769baf25f4ebe5516322e59e0b28ee3404b72(1).jpg","1608025104","1608025104");
INSERT INTO image_library VALUES("55","56","uploads/15-12-2020/515e2e3d461a1f0f0e2ec94119f14eb1685d5e97.jpg","1608025104","1608025104");
INSERT INTO image_library VALUES("57","57","uploads/15-12-2020/515e2e3d461a1f0f0e2ec94119f14eb1685d5e97.jpg","1608025109","1608025109");
INSERT INTO image_library VALUES("58","58","uploads/15-12-2020/8af769baf25f4ebe5516322e59e0b28ee3404b72(1).jpg","1608025362","1608025362");
INSERT INTO image_library VALUES("59","58","uploads/15-12-2020/anhbia.jpg","1608025362","1608025362");
INSERT INTO image_library VALUES("60","61","anhbia.jpg","0","0");
INSERT INTO image_library VALUES("61","59","uploads/15-12-2020/515e2e3d461a1f0f0e2ec94119f14eb1685d5e97(1).jpg","1608025368","1608025368");
INSERT INTO image_library VALUES("70","56","uploads/21-06-2021/anhbia.jpg","6666666","6666666");
INSERT INTO image_library VALUES("90","91","uploads/15-12-2020/anhbia.jpg","646466565","899889886");
INSERT INTO image_library VALUES("91","39","uploads/21-06-2021/203905388_3995031940611372_3960290250958678745_n.jpg","1624261583","1624261583");
INSERT INTO image_library VALUES("92","39","uploads/21-06-2021/200075265_824207004878048_7264077901432175058_n(1).jpg","1624261691","1624261691");
INSERT INTO image_library VALUES("93","38","uploads/21-06-2021/186558475_495879621621476_4926308080828840733_n.jpg","1624261858","1624261858");
INSERT INTO image_library VALUES("94","37","uploads/21-06-2021/51446873_598218030619477_8881987343016263680_n.jpg","1624261976","1624261976");



DROP TABLE order_detail;

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `quantity` int(200) NOT NULL,
  `price` int(255) NOT NULL,
  `created_time` varchar(255) DEFAULT NULL,
  `last_updated` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO order_detail VALUES("6","63","62","1","4000000","1626965022","1626965022");
INSERT INTO order_detail VALUES("7","63","5536","1","4000000","1626965022","1626965022");
INSERT INTO order_detail VALUES("8","64","12","1","7000000","1626965332","1626965332");
INSERT INTO order_detail VALUES("9","64","66","1","7000000","1626965332","1626965332");



DROP TABLE orders;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `note` text NOT NULL,
  `total` int(255) NOT NULL,
  `created_time` varchar(255) DEFAULT NULL,
  `last_updated` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

INSERT INTO orders VALUES("63","6","","8000000","22/7/2021","1626965022");
INSERT INTO orders VALUES("64","14","","14000000","21/7/2021","1626965332");



DROP TABLE post;

CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `kind` varchar(200) NOT NULL,
  `age` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` int(1) NOT NULL,
  `created_time` varchar(255) NOT NULL,
  `last_updated` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89668647 DEFAULT CHARSET=utf8mb4;

INSERT INTO post VALUES("1","NHÍM CẢNH ĐỰC","200000","10","Nhím"," Từ 60 ngày tới 1 tuổi","Anh Quốc","uploads/09-07-2021/avatars-VLncOsFhGlaI9ayM-ffdy5g-t500x500.jpg","19","1605360584","1625841092");
INSERT INTO post VALUES("2","CHÓ HUSKY ĐỰC THUẦN CHỦNG","1000000","10","Chó Husky"," Từ 60 ngày tới 1 tuổi","Anh Quốc","uploads/09-07-2021/f73d197f6a46a3090c2a48a1c42324b2.jpg","4","1605360584","1625839956");
INSERT INTO post VALUES("3","NHÍM CẢNH","200000","14","Nhím"," Từ 60 ngày tới 1 tuổi","Anh Quốc","uploads/09-07-2021/1401934607-anh15.jpg","1","1605360584","1625841083");
INSERT INTO post VALUES("5","HAMSTER WW","100000","10","Hamster WW","1 tuổi","Đức","uploads/09-07-2021/hamster3335.jpg","8","1605360584","1625841855");
INSERT INTO post VALUES("8","HAMSTER ROBO","100000","10","Hams Robo"," Từ 60 ngày tới 1 tuổi","Đức","uploads/09-07-2021/chuot-hamster-robo-4-350x350.jpg","10","1605360584","1625842171");
INSERT INTO post VALUES("12","CHÓ PITTBULL","7000000","10","Chó Pitbull","12 tháng","Anh Quốc","uploads/09-07-2021/7cc38d4e2bf52-f957.jpg","1","1605360584","1625841621");
INSERT INTO post VALUES("19","HAMSTER BEAR","100000","10","Hamster Bear"," Từ 60 ngày tới 1 tuổi","Việt Nam","uploads/09-07-2021/204018659_554818205698424_3256562432970514784_n.png","9","1605360584","1625842098");
INSERT INTO post VALUES("21","MÈO SCOTTISH CÁI","2000000","10","Mèo Scottish"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/meotrai-12-1-400x400.jpg","11","1605360584","1625840155");
INSERT INTO post VALUES("22","CHIHUAHUA ĐỰC","1000000","10","Chó Chihuahua","1 tuổi","Mỹ","uploads/09-07-2021/chihuahua-for-sale.jpg","5","1624294288","1625839163");
INSERT INTO post VALUES("23","MÈO BA TƯ","5000000","10","Mèo Batu"," Từ 60 ngày tới 1 tuổi","Đức","uploads/09-07-2021/Meo-ba-tu-happypetsvn-gnes-2-400x400.jpg","14","1605360584","1625840468");
INSERT INTO post VALUES("24","MÈO MUNCHKIN CHÂN NGẮN","10000000","10","Mèo Munchkin"," 1 tuổi","Đức","uploads/09-07-2021/Điều-cần-biết-trước-khi-quyết-định-mua-chó-mèo-con-400x400.jpg","16","1605360584","1625840422");
INSERT INTO post VALUES("25","MÈO SPHYNX","10000000","10","Mèo Sphynx"," Từ 60 ngày tới 1 tuổi","Đức","uploads/09-07-2021/738d192d0547e297fc59905144b0486b-2720260001235201705.jpg","12","1605360584","1625840385");
INSERT INTO post VALUES("32","CHÓ POODLE ĐỰC THUẦN CHỦNG","1000000","10","Chó Poodle "," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/14747722537049938339.jpg","3","1608003580","1625838986");
INSERT INTO post VALUES("33","MÈO ANH LÔNG DÀI","2000000","10","Mèo Anh"," Từ 60 ngày tới 1 tuổi","Đức","uploads/09-07-2021/1f3ddbc2fdcfe6a564c465a11d6d9e38-2725609808552560002.jpg","13","1605360584","1625840319");
INSERT INTO post VALUES("34","THÔI MÍU","1000000","10","Mèo Ta"," Từ 60 ngày tới 1 tuổi","Việt Nam","uploads/09-07-2021/203058619_1167475687091452_5436841248549820825_n.png","17","1605360584","1626538613");
INSERT INTO post VALUES("35","BEAGLE ĐỰC ","1000000","10","Chó Beagle"," Từ 60 ngày tới 1 tuổi","Đức","uploads/09-07-2021/185ee45aafc4419a18d5.jpg","7","1605360584","1625842269");
INSERT INTO post VALUES("37","PUG ĐỰC THUẦN CHỦNG","1000000","10","Chó Pug"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/Pug-min-1.jpg","2","1605360584","1625839736");
INSERT INTO post VALUES("38","PHỐC SÓC CÁI THUẦN CHỦNG","1000000","10","Chó phốc"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/3-8.jpg","0","1605360584","1625839564");
INSERT INTO post VALUES("39","CORGI ĐỰC THUẦN CHỦNG","10000000","10","Chó Corgi"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/c0fd486408cb44675d2acdc8e11ba99c.jpg","6","1605360584","1625839430");
INSERT INTO post VALUES("43","PUG CÁI THUẦN CHỦNG","1000000","10","Chó Pug"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/pug-de-thuong-600x600.jpg","2","1605360584","1625839727");
INSERT INTO post VALUES("55","CHÓ POODLE ĐỰC THUẦN CHỦNG","1000000","10","Chó Poodle "," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/unnamed(1).jpg","3","1608003580","1625838972");
INSERT INTO post VALUES("60","THỎ CẢNH","200000","10","Thỏ","1 tuổi","Việt Nam","uploads/09-07-2021/fe5df8635f2a170f3fac0317b52babb9.jpg","18","1624263556","1625841372");
INSERT INTO post VALUES("61","VẸT NGỰC HỒNG","5000000","10","Vẹt","1 tuổi","Mỹ","uploads/09-07-2021/vet-nguc-hong-compressed.jpg","0","1624263666","1625841243");
INSERT INTO post VALUES("62","SÓC BAY ÚC","4000000","10","Sóc","1 tuổi","Mỹ","uploads/09-07-2021/san-pham-soc-bay-uc-mat-trang-1.jpg","20","1624263752","1625841312");
INSERT INTO post VALUES("63","CHIHUAHUA CÁI","1000000","10","Chó Chihuahua","1 tuổi","Mỹ","uploads/09-07-2021/unnamed_(1).jpg","5","1624294288","1625839146");
INSERT INTO post VALUES("64","CORGI ĐỰC THUẦN CHỦNG","10000000","10","Chó Corgi"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/mua-ban-cho-corgi-thuan-chung-gia-tot-nhat-tp-hcm-500x500.jpg","1","1605360584","1625839418");
INSERT INTO post VALUES("65","CHÓ HUSKY CÁI THUẦN CHỦNG","1000000","10","Chó Husky"," Từ 60 ngày tới 1 tuổi","Anh Quốc","uploads/09-07-2021/tải_xuống.jpg","4","1605360584","1625839942");
INSERT INTO post VALUES("66","CHÓ SAMOYED","7000000","15","Chó Samoyed","12 tháng","Mỹ","uploads/09-07-2021/1601308641_866_Cung-thuong-thuc-nhung-hinh-anh-cho-Samoyed-cuc-de.jpg","1","1605360584","1625841506");
INSERT INTO post VALUES("89","CHÓ HUSKY CÁI","1000000","10","Chó Husky"," Từ 60 ngày tới 1 tuổi","Anh Quốc","uploads/09-07-2021/tải_xuống_(1).jpg","4","1605360584","1625839932");
INSERT INTO post VALUES("122","MÈO ANH LÔNG NGẮN","2000000","10","Mèo Anh"," Từ 60 ngày tới 1 tuổi","Đức","uploads/09-07-2021/meo-anh-long-ngan-tricolor-400x400.jpg","13","1605360584","1625840290");
INSERT INTO post VALUES("123","CORGI ĐỰC THUẦN CHỦNG","10000000","10","Chó Corgi"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/cho-corgi-4.jpg","6","1605360584","1625839407");
INSERT INTO post VALUES("334","CHÓ POODLE ĐỰC THUẦN CHỦNG","1000000","10","Chó Poodle "," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/InfinityPups-Willow-Female-7-400x400.jpg","3","1608003580","1625838683");
INSERT INTO post VALUES("444","CHÓ HUSKY ĐỰC","1000000","10","Chó Husky"," Từ 60 ngày tới 1 tuổi","Anh Quốc","uploads/09-07-2021/f05fd6aaaf6b94eb702e450c1a6490c1.jpg","4","1605360584","1625839912");
INSERT INTO post VALUES("453","CORGI CÁI THUẦN CHỦNG","10000000","10","Chó Corgi"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/plain___glam__15__e4175eab5b794e6eaafc8c868763835a_grande.png","6","1605360584","1625839395");
INSERT INTO post VALUES("455","CORGI ĐỰC THUẦN CHỦNG","10000000","10","Chó Corgi"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/plain___glam_2006654c4dfe4b6aac8ffc11e2cc6257_grande.png","6","1605360584","1625839386");
INSERT INTO post VALUES("467","CHIHUAHUA ĐỰC","1000000","10","Chó Chihuahua","1 tuổi","Mỹ","uploads/09-07-2021/426-4268878_black-chihuahua-dog-lying-down-canvas-print-.png","5","1624294288","1625839137");
INSERT INTO post VALUES("532","MÈO ANH LÔNG NGẮN","2000000","10","Mèo Anh"," Từ 60 ngày tới 1 tuổi","Đức","uploads/09-07-2021/Mèo-anh-lông-ngắn-hồng-phấn-e1589209953626.jpg","13","1605360584","1625840270");
INSERT INTO post VALUES("553","MÈO SCOTTISH CÁI","2000000","10","Mèo Scottish"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/meo-tai-cup-scottish-fold-dogily-petshop.jpg","11","1605360584","1625840144");
INSERT INTO post VALUES("614","PUG CÁI THUẦN CHỦNG","1000000","10","Chó Pug"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/pug-liem-moi-600x600.jpg","2","1605360584","1625839717");
INSERT INTO post VALUES("856","BEAGLE CÁI","1000000","10","Chó Beagle"," Từ 60 ngày tới 1 tuổi","Đức","uploads/09-07-2021/22-39b55(1).jpg","7","1605360584","1625841544");
INSERT INTO post VALUES("996","VẸT XÁM ÚC","5000000","10","Vẹt","1 tuổi","Mỹ","uploads/09-07-2021/cockatiel14.jpg","0","1624263666","1625841234");
INSERT INTO post VALUES("999","VẸT SUNCONURE","5000000","10","Vẹt","1 tháng","Mỹ","uploads/09-07-2021/fd02907157316d8b0e426694277f5ccd.jpg","0","1624263666","1625841222");
INSERT INTO post VALUES("3444","PUG ĐỰC THUẦN CHỦNG","1000000","10","Chó Pug"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/Cho-Pug-Mat-Xe-6.jpg","2","1605360584","1625839706");
INSERT INTO post VALUES("4545","NHÍM CẢNH ĐỰC","200000","10","Nhím"," Từ 60 ngày tới 1 tuổi","Anh Quốc","uploads/09-07-2021/1387716820-nhim-8.jpg","19","1605360584","1625841074");
INSERT INTO post VALUES("4666","CORGI ĐỰC THUẦN CHỦNG","10000000","10","Chó Corgi"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/765945a924e5b46cee993bd0178e816e.jpg","6","1605360584","1625839377");
INSERT INTO post VALUES("5536","SÓC BAY ÚC","4000000","10","Sóc","1 tuổi","Mỹ","uploads/09-07-2021/san-pham-soc-bay-uc-normal-1.jpg","20","1624263752","1625841302");
INSERT INTO post VALUES("5555","MÈO ANH LÔNG DÀI","2000000","10","Mèo Anh"," Từ 60 ngày tới 1 tuổi","Đức","uploads/09-07-2021/Meo-Anh-long-dai-so-huu-bo-long-ong-anh-va-than-hinh-cuc-ky-san-chac.jpg","13","1605360584","1625840236");
INSERT INTO post VALUES("6666","HAMSTER WW","100000","10","Hamster WW","1 tuổi","Đức","uploads/09-07-2021/eme1403861764.jpg","8","1605360584","1625841812");
INSERT INTO post VALUES("6888","HAMSTER WW","100000","10","Hamster WW","1 tuổi","Đức","uploads/09-07-2021/trang-soc-den.png","8","1605360584","1625841787");
INSERT INTO post VALUES("23333","PUG CÁI THUẦN CHỦNG","1000000","10","Chó Pug"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/243975-500x500.jpg","2","1605360584","1625839682");
INSERT INTO post VALUES("33333","MÈO SCOTTISH ĐỰC","2000000","10","Mèo Scottish"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/1_7e2c398b52e942fc8a6272654d5d66ab_grande.png","11","1605360584","1625840133");
INSERT INTO post VALUES("35368","PHỐC SÓC CÁI THUẦN CHỦNG","1000000","10","Chó phốc"," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/1-7.jpg","0","1605360584","1625839551");
INSERT INTO post VALUES("35555","CHÓ POODLE ĐỰC THUẦN CHỦNG","1000000","10","Chó Poodle "," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/IMG_6434-600x600.jpg","3","1608003580","1625838182");
INSERT INTO post VALUES("64646","CHIHUAHUA ĐỰC","1000000","10","Chó Chihuahua","1 tuổi","Mỹ","uploads/09-07-2021/Trọn-bộ-huấn-luyện-chó-Chihuahua-từ-A-đến-Z-400x400.jpg","5","1624294288","1625839127");
INSERT INTO post VALUES("66666","CHÓ POODLE ĐỰC THUẦN CHỦNG","1000000","10","Chó Poodle "," Từ 60 ngày tới 1 tuổi","Mỹ","uploads/09-07-2021/Tindy-poodle.jpg","3","1608003580","1625837646");
INSERT INTO post VALUES("1133333","HAMSTER ROBO","100000","10","Hams Robo"," Từ 60 ngày tới 1 tuổi","Đức","uploads/09-07-2021/chuot-hamster-robo-mat-nau.jpg","10","1605360584","1625842158");
INSERT INTO post VALUES("89668645","NHÍM CẢNH CÁI","200000","15","Nhím"," Từ 60 ngày tới 1 tuổi","Anh Quốc","uploads/09-07-2021/344fd5cc3c9ca9fa176ae0e700817077.jpg","19","1605360584","1626455520");



DROP TABLE user;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `sodienthoai` varchar(12) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

INSERT INTO user VALUES("6","Admin","edab31e58259b04e5350c5622bbcb169","bongbong@gmail.com","0364735337","Long Biên, Hà Nội","1");
INSERT INTO user VALUES("14","bongbongno1","edab31e58259b04e5350c5622bbcb169","bongbong@gmail.com","0364735337","Hà Nội","0");



DROP TABLE vouchers;

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount` float NOT NULL,
  `code` varchar(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO vouchers VALUES("2","0.5","sale50","0");
INSERT INTO vouchers VALUES("3","0.25","sale25","0");
INSERT INTO vouchers VALUES("4","0.75","sale75","0");
INSERT INTO vouchers VALUES("5","1","sale100","0");



