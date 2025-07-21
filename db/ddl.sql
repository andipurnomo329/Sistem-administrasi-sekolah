ALTER TABLE cias.tbl_people ADD namaIbuKandung varchar(100) NULL;
ALTER TABLE cias.tbl_people CHANGE namaIbuKandung namaIbuKandung varchar(100) NULL AFTER tanggal_lahir;

-- Andi 06-02-2025
CREATE TABLE `tbl_kelas` (
  id_kelas INT(11) PRIMARY KEY AUTO_INCREMENT,
    nama_kelas VARCHAR(50),
    tingkat VARCHAR(10),
    jurusan VARCHAR(50),
    tahun_ajaran VARCHAR(9),
    id_wali_kelas INT(11),
    isDeleted tinyint(4) NOT NULL DEFAULT '0',
    createdBy int(11) NOT NULL,
    createdDtm datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedBy int(11) DEFAULT NULL,
    updatedDtm datetime DEFAULT NULL
) ENGINE=InnoDB 

CREATE TABLE tbl_guru (
    id_guru INT(11) PRIMARY KEY AUTO_INCREMENT,
    nip VARCHAR(20),
    id_people INT(11) NOT NULL,
    isDeleted TINYINT(4) NOT NULL DEFAULT '0',
    createdBy INT(11) NOT NULL,
    createdDtm DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedBy INT(11) DEFAULT NULL,
    updatedDtm DATETIME DEFAULT NULL
) ENGINE=InnoDB;

ALTER TABLE cias.tbl_guru ADD tanggal_masuk DATE NULL;

CREATE DEFINER=`root`@`localhost` TRIGGER after_guru_delete
AFTER UPDATE ON tbl_guru
FOR EACH ROW
BEGIN
    -- Jika isDeleted diubah menjadi 1 pada tbl_guru, update juga di tbl_people
    IF NEW.isDeleted = 1 THEN
        UPDATE tbl_people 
        SET isDeleted = 1, updatedDtm = NOW()
        WHERE id = NEW.id_people;  -- Sesuaikan dengan foreign key di tabel tbl_guru
    END IF;
END

-- jemi 05-02-2025
ALTER TABLE cias.tbl_people MODIFY COLUMN no_telp varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

