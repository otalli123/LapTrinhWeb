CREATE DATABASE dangkylichkhamchuabenh;
USE dangkylichkhamchuabenh;

CREATE TABLE `bacsi` (
  `MABS` int(11) NOT NULL,
  `HOTEN` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SDT` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NGAYSINH` date NOT NULL,
  `DIACHI` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GIOITINH` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HINHANH` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MOTA` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GIOKHAM` datetime NOT NULL,
  `MAKH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `bacsi` (`MABS`, `HOTEN`, `SDT`, `NGAYSINH`, `DIACHI`, `GIOITINH`, `HINHANH`, `MOTA`, `GIOKHAM`, `MAKH`) VALUES
(1, 'Hà Trung Hiếu', '0902123456', '2022-11-26', 'abcxyz', 'Nam', 'Hieu.jpg', '', '2022-11-26 13:40:11', 1),
(2, 'Lê Phạm Minh Tài', '0902123456', '2022-11-26', 'abcdegh', 'nam', 'Hieu.jpg', NULL, '2022-11-26 15:55:23', 2),
(3, 'Vũ Hoàng Lâm', '0123456789', '2022-11-26', 'Biên Hòa', 'Nam', 'Lam.jpg', NULL, '2022-11-26 17:54:20', 4),
(10, 'Dương Nguyễn Minh Thông', '0123456798', '0000-00-00', 'Quận 12', 'nam', 'Thong.jpg', 'met', '2022-11-27 22:57:00', 5),
(16, 'Ngọ Văn Long', '0123456789', '0000-00-00', 'Quận 12', 'nam', 'Long.jpg', '', '2022-11-27 23:52:00', 4);


CREATE TABLE `giokham` (
  `GIOKHAM` datetime NOT NULL,
  `MABS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `ketqua` (
  `MAPHIEU` int(11) NOT NULL,
  `KETQUA` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NEN` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KHONGNEN` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NGAYTAIKHAM` date NOT NULL,
  `HINHANH1` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `HINHANH2` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `ketqua` (`MAPHIEU`, `KETQUA`, `NEN`, `KHONGNEN`, `NGAYTAIKHAM`, `HINHANH1`, `HINHANH2`) VALUES
(13, 'Tot', 'ko co', 'ko co', '2022-11-26', NULL, NULL);


CREATE TABLE `khoa` (
  `MAKHOA` int(11) NOT NULL,
  `TENKHOA` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `khoa` (`MAKHOA`, `TENKHOA`) VALUES
(1, 'KHOA TIM MẠCH'),
(2, 'KHOA TIÊU HÓA'),
(3, 'KHOA NỘI HÔ HẤP'),
(4, 'NHÃN KHOA'),
(5, 'NHI KHOA');


CREATE TABLE `phieuhen` (
  `MAPHIEU` int(11) NOT NULL,
  `HOTEN` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GIOITINH` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NAMSINH` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DIACHI` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SDT` int(10) NOT NULL,
  `NGAYKHAM` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GIOKHAM` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MOTA` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAXACTHUC` int(11) DEFAULT NULL,
  `TRANGTHAI` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MABS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `phieuhen` (`MAPHIEU`, `HOTEN`, `GIOITINH`, `NAMSINH`, `DIACHI`, `SDT`, `NGAYKHAM`, `GIOKHAM`, `MOTA`, `MAXACTHUC`, `TRANGTHAI`, `MABS`) VALUES
(13, 'Rm', 'nam', '2000', 'Quận Đống Đa', 123456789, '1111-11-11', '7', '11', 47, 'Đang xử lý', 1),
(21, 'Anh', 'nam', '2000', 'TPHCM', 123456789, '1111-11-11', '7', 'pain', 56, 'Đang xử lý', 2),
(25, 'Em', 'nam', '1111', 'Quan 11', 123456789, '1111-11-11', '7', '11', 49, 'Đang xử lý', 3),
(30, 'Em', 'nữ', '2000', 'Quan 1', 123456789, '1111-11-11', '7', 'Ho', 60, 'Đang xử lý', 1),
(61, 'M', 'nam', '2000', 'Quan', 123456789, '1111-11-11', '7', '11', 85, 'Đang xử lý', 3),
(83, 'EMp', 'nam', '2000', 'Quan', 123456789, '1111-11-11', '7', 'he', 85, 'Đang xử lý', 2),
(84, 'EM', 'nam', '2000', 'Quan 11', 123456789, '1111-11-11', '7', '11', 40, 'Đang xử lý', 3),
(86, 'Em', 'nam', '2003', 'Quan 12', 123456789, '2022-11-27', '7', 'met', 81, 'Đang xử lý', 16),
(90, 'He', 'nam', '2000', 'TX', 123456798, '1111-11-11', '7', '11', 86, 'Đang xử lý', 1),
(98, 'Em', 'nam', '2000', 'Quan 12', 123456789, '1111-11-11', '7', '11', 88, 'Đang xử lý', 1);


CREATE TABLE `taikhoan` (
  `ID` int(11) NOT NULL,
  `HOTEN` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASSWORD` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `QUYENTRUYCAP` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `taikhoan` (`ID`, `HOTEN`, `PASSWORD`, `QUYENTRUYCAP`) VALUES
(1, 'Empty', '$2y$10$MSdEk9NzAOX1Z5.qqVzdXeZab86uU5vD/5p3UTbpNssFhA3qk92wi', 1),
(5, 'EmptyM', '$2y$10$Y5uVa7Ctn0BouO67jfnuX.3FTWDZriW4DQZVTmB0HknyWslIiFz7a', 0);


ALTER TABLE `bacsi`
  ADD PRIMARY KEY (`MABS`),
  ADD KEY `FK_BACSI_MAKHOA` (`MAKH`);


ALTER TABLE `giokham`
  ADD KEY `FK_GIOKHAM_MABS` (`MABS`);


ALTER TABLE `ketqua`
  ADD PRIMARY KEY (`MAPHIEU`);


ALTER TABLE `khoa`
  ADD PRIMARY KEY (`MAKHOA`);


ALTER TABLE `phieuhen`
  ADD PRIMARY KEY (`MAPHIEU`),
  ADD KEY `FK_PHIEUHEN_MABS` (`MABS`);


ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `bacsi`
  MODIFY `MABS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;


ALTER TABLE `ketqua`
  MODIFY `MAPHIEU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;


ALTER TABLE `khoa`
  MODIFY `MAKHOA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `phieuhen`
  MODIFY `MAPHIEU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;


ALTER TABLE `taikhoan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `bacsi`
  ADD CONSTRAINT `FK_BACSI_MAKHOA` FOREIGN KEY (`MAKH`) REFERENCES `khoa` (`MAKHOA`);


ALTER TABLE `giokham`
  ADD CONSTRAINT `FK_GIOKHAM_MABS` FOREIGN KEY (`MABS`) REFERENCES `bacsi` (`MABS`);


ALTER TABLE `ketqua`
  ADD CONSTRAINT `FK_KETQUA_MAPHIEU` FOREIGN KEY (`MAPHIEU`) REFERENCES `phieuhen` (`MAPHIEU`);


ALTER TABLE `phieuhen`
  ADD CONSTRAINT `FK_PHIEUHEN_MABS` FOREIGN KEY (`MABS`) REFERENCES `bacsi` (`MABS`);
COMMIT;
