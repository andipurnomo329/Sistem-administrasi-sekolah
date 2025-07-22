-- 17022025
CREATE TABLE `tbl_murid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(10) DEFAULT NULL,
  `nik` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `tempat_lahir` varchar(128) DEFAULT NULL,
  `alamat` varchar(128) DEFAULT NULL,
  `agama` varchar(28) DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL COMMENT 'P/W',
  `tanggal_lahir` date DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `namaIbuKandung` varchar(100) DEFAULT NULL,
  `namaAyahKandung` varchar(100) DEFAULT NULL,
  `namaWaliMurid` varchar(100) DEFAULT NULL,
  `pekerjaanWali` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1274 DEFAULT CHARSET=utf8;

++ 03032025

CREATE TABLE `tbl_mapel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

+++++++++++++++++++++++++++++++++++++++++++++++++++++++++

ALTER TABLE cias.tbl_murid ADD kodeMurid varchar(25) NULL;
ALTER TABLE cias.tbl_murid ADD flagLulus varchar(100) DEFAULT 0 NULL;
ALTER TABLE cias.tbl_murid ADD tanggalPendaftaran DATE NULL;
ALTER TABLE cias.tbl_murid ADD tanggalMasuk DATE NULL;

++++++++++++++++++++++++++++++++++++++++++++++++++++++++
05-03-2025

ALTER TABLE cias.tbl_murid ADD tanggalKeluar DATE NULL;
ALTER TABLE cias.tbl_murid ADD pekerjaanAyah varchar(25) NULL;
ALTER TABLE cias.tbl_murid ADD pekerjaanIbu varchar(25) NULL;
ALTER TABLE cias.tbl_murid ADD pekerjaanWali varchar(25) NULL;