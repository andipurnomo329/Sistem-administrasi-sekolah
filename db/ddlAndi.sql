CREATE TABLE tbl_pegawai (
    id_pegawai INT  PRIMARY key AUTO_INCREMENT,
    id_people INT(11) NOT NULL,
    nip VARCHAR(20) NOT NULL,
    tanggal_masuk DATE NOT NULL,
    isDeleted TINYINT(4) NOT NULL DEFAULT '0',
    createdBy INT(11) NOT NULL,
    createdDtm DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedBy INT(11) DEFAULT NULL,
    updatedDtm DATETIME DEFAULT NULL
);

-- Add Triger tbl_pegawai
CREATE DEFINER=`root`@`localhost` TRIGGER after_pegawai_delete
AFTER UPDATE ON tbl_pegawai
FOR EACH ROW
BEGIN
    -- Jika isDeleted diubah menjadi 1 pada tbl_guru, update juga di tbl_people
    IF NEW.isDeleted = 1 THEN
        UPDATE tbl_people 
        SET isDeleted = 1, updatedDtm = NOW()
        WHERE id = NEW.id_people;  -- Sesuaikan dengan foreign key di tabel tbl_guru
    END IF;
END

--260225
CREATE TABLE trx_guru (
    id INT  PRIMARY key AUTO_INCREMENT,
    id_guru INT NOT NULL,
    id_kelas INT NOT NULL,
    isDeleted TINYINT(4) NOT NULL DEFAULT '0',
    createdBy INT(11) NOT NULL,
    createdDtm DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedBy INT(11) DEFAULT NULL,
    updatedDtm DATETIME DEFAULT NULL
)ENGINE=InnoDB;

--03032025
ALTER TABLE cias.tbl_kelas ADD kouta INT NULL;

DROP TRIGGER IF EXISTS cias.after_guru_delete;
USE cias;

DELIMITER $$
$$
CREATE DEFINER=`root`@`localhost` TRIGGER after_guru_delete
AFTER UPDATE ON tbl_guru
FOR EACH ROW
BEGIN
    -- Jika isDeleted diubah menjadi 1 pada tbl_guru, update juga di tbl_people
    IF NEW.isDeleted = 1 THEN
        UPDATE tbl_people 
        SET isDeleted = 1, updatedDtm = NOW()
        WHERE id = NEW.id_people;
        
        UPDATE trx_guru 
        SET isDeleted = 1, updatedDtm = NOW()
        WHERE id = NEW.id_guru;
    END IF;
END$$
DELIMITER ;

--05032025

CREATE or replace VIEW view_wali_kelas AS
SELECT 
    tg.id AS trx_id, 
    p.id AS id_people, 
    k.id_kelas,
    g.id_guru,
    k.nama_kelas,
    k.tahun_ajaran,
    k.tingkat, 
    p.nama, 
    p.nik, 
    g.nip, 
    g.tanggal_masuk, 
    CASE 
        WHEN p.jenis_kelamin = 'P' THEN 'Laki-laki' 
        WHEN p.jenis_kelamin = 'W' THEN 'Perempuan' 
        ELSE 'Tidak Diketahui' 
    END as jenis_kelamin,
    tg.isDeleted
FROM tbl_guru g
LEFT JOIN tbl_people p ON g.id_people = p.id
LEFT JOIN trx_guru tg ON g.id_guru = tg.id_guru 
left join tbl_kelas k on k.id_kelas = tg.id_kelas
