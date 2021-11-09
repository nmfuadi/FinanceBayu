/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : SQL Server
 Source Server Version : 15002000
 Source Host           : localhost:1433
 Source Catalog        : BAYUBUANA
 Source Schema         : dbo

 Target Server Type    : SQL Server
 Target Server Version : 15002000
 File Encoding         : 65001

 Date: 09/11/2021 10:04:19
*/


-- ----------------------------
-- Table structure for com_user
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[com_user]') AND type IN ('U'))
	DROP TABLE [dbo].[com_user]
GO

CREATE TABLE [dbo].[com_user] (
  [id_user] int  IDENTITY(113,1) NOT NULL,
  [username] varchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS DEFAULT NULL NULL,
  [passwords] varchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS DEFAULT NULL NULL,
  [surename] varchar(50) COLLATE SQL_Latin1_General_CP1_CI_AS DEFAULT NULL NULL,
  [email] varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS DEFAULT NULL NULL,
  [level] int DEFAULT NULL NULL,
  [is_active] int DEFAULT NULL NULL,
  [uc] int DEFAULT NULL NULL,
  [dc] datetime2(0) DEFAULT NULL NULL
)
GO

ALTER TABLE [dbo].[com_user] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Records of com_user
-- ----------------------------
SET IDENTITY_INSERT [dbo].[com_user] ON
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'1', N'lia', N'21232f297a57a5a743894a0e4a801fc3', N'Lia', N'abalabal221@gmail.com', N'2', N'1', N'1', N'2019-03-26 16:41:03')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'2', N'sandy', N'21232f297a57a5a743894a0e4a801fc3', N'Wara Santoso', N'sularso.moch@gmail.com', N'2', N'1', N'1', N'2019-04-02 12:04:13')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'3', N'mkt', N'21232f297a57a5a743894a0e4a801fc3', N'Dika', N'nmfuadi@gmail.com', N'2', N'1', N'1', N'2020-01-10 11:16:26')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'4', N'dir', N'21232f297a57a5a743894a0e4a801fc3', N'Fuad', N'nmfuadi@gmail.com', N'2', N'1', N'1', N'2020-01-10 11:16:26')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'5', N'vp', N'21232f297a57a5a743894a0e4a801fc3', N'Fuad', N'nmfuadi@gmail.com', N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'6', N'staff', N'21232f297a57a5a743894a0e4a801fc3', N'Fuad', N'nmfuadi@gmail.com', N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'7', N'yuli', N'653a5ac8541a16bce0c39d1501e1e49e', N'YULI ROSMALAWATI', N'yuli.axelera@gmail.com', N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'8', N'hera', N'8ad6974cba9aa8bd051dfd6550a9a8c5', N'HERAWATI', N'herawatimoy1212@gmail.com', N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'9', N'amee', N'fb5fbc420f89701ac603bf7aa331ccd0', N'RACHMAT HIDAYAT', N'ameekute99@gmail.com', N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'10', N'usep', N'968ddd74a4043e07abec73e91a62b614', N'USEP TAMRIN. H', N'useptamrin80@gmail.com', N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'11', N'andi', N'9d255a6fe45fd75228c9258d321c4edd', N'ANDI NELWAN', N'andinelwan72@gmail.com', N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'12', N'djati', N'e97aed9a36d9525caa858945f7cdf5e4', N'M. DJATI RISMANTORO', N'djati.rismantoro50@gmail.com', N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'13', N'bangday', N'21232f297a57a5a743894a0e4a801fc3', N'HIDAYATULLAH', N'hjupiterhidayat@yahoo.com', N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'14', N'anto', N'76077b1aefb98479536576c68c597b78', N'RISTANTO BUDI. S', N'antolupus1168@gmail.com', N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'15', N'rere', N'21232f297a57a5a743894a0e4a801fc3', N'RIANI', N'riani@gmail.com', N'2', N'1', N'1', N'2020-03-09 15:06:03')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'16', N'indah', N'21232f297a57a5a743894a0e4a801fc3', N'Indah wulan', N'riani@gmail.com', N'2', N'1', N'1', N'2020-03-09 15:06:06')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'17', N'arul', N'21232f297a57a5a743894a0e4a801fc3', N'hairul Anwar', N'riani@gmail.com', N'2', N'1', N'1', N'2020-03-09 15:06:09')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'18', N'hery', N'21232f297a57a5a743894a0e4a801fc3', N'Hery Murti', N'riani@gmail.com', N'2', N'1', N'1', N'2020-03-09 15:06:12')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'19', N'rudi', N'21232f297a57a5a743894a0e4a801fc4', N'Nurudi Wijanarko', N'riani@gmail.com', N'2', N'1', N'1', N'2020-03-09 15:06:15')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'20', N'aulia_dir', N'21232f297a57a5a743894a0e4a801fc3', N'Aulia Firdaus', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'21', N'rully', N'f36973581997df36b8684e5d6c4b4b75', N'Rully Muliarto', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'22', N'andy_dir', N'21232f297a57a5a743894a0e4a801fc3', N'Andy Kesuma Natanael', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'23', N'zasha', N'21232f297a57a5a743894a0e4a801fc3', N'Zasha Natasya', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'24', N'bela', N'8828261f8dce5813b5b293701e251f4d', N'Ghaisani Nabila Gumay', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'25', N'aulia_audit', N'21232f297a57a5a743894a0e4a801fc3', N'Aulia Firdaus', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'26', N'cholid', N'21232f297a57a5a743894a0e4a801fc3', N'Cholid Wuryanto', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'27', N'rully_lgl', N'21232f297a57a5a743894a0e4a801fc3', N'Rully Muliarto', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'28', N'arifa', N'21232f297a57a5a743894a0e4a801fc3', N'Arifa Nur Rachmawati', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'29', N'machdar', N'21232f297a57a5a743894a0e4a801fc3', N'Machdar', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'30', N'aulia_fin', N'21232f297a57a5a743894a0e4a801fc3', N'Aulia Firdaus', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'31', N'maya', N'21232f297a57a5a743894a0e4a801fc3', N'Katherin Mayasari', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'32', N'gagah', N'21232f297a57a5a743894a0e4a801fc3', N'Gagah Tjandra Putra', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'33', N'luis', N'21232f297a57a5a743894a0e4a801fc3', N'Edlin Luis Witarso', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'34', N'yazid', N'21232f297a57a5a743894a0e4a801fc3', N'Yazid', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'35', N'widhi', N'21232f297a57a5a743894a0e4a801fc3', N'Widhi Arianto', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'36', N'aizah', N'21232f297a57a5a743894a0e4a801fc3', N'Nur Aizah', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'37', N'naufal', N'21232f297a57a5a743894a0e4a801fc3', N'Faris Naufal', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'38', N'tommy', N'21232f297a57a5a743894a0e4a801fc3', N'Tommy Saputra', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'39', N'saihu', N'21232f297a57a5a743894a0e4a801fc3', N'Saihu', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'40', N'tyo', N'21232f297a57a5a743894a0e4a801fc3', N'Prinatin Hadisetyo', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'41', N'aulia_etod', N'21232f297a57a5a743894a0e4a801fc3', N'Aulia Firdaus', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'42', N'alfi', N'21232f297a57a5a743894a0e4a801fc3', N'Alfiatun', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'43', N'husni', N'21232f297a57a5a743894a0e4a801fc3', N'Husni Abbad', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'44', N'fuad', N'21232f297a57a5a743894a0e4a801fc3', N'Nur Muhammad Fuadi', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'45', N'finance', N'37383e63922e95843d92d21b82f6776f', N'Finance bayu Buana', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'46', N'eris', N'21232f297a57a5a743894a0e4a801fc3', N'Eris Rachmat T', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'47', N'putri', N'21232f297a57a5a743894a0e4a801fc3', N'Putri Sri Maulidah', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'48', N'iqbal', N'21232f297a57a5a743894a0e4a801fc3', N'Adhitya Iqbal Lazuardi', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'49', N'aulia_pro', N'21232f297a57a5a743894a0e4a801fc3', N'Aulia Firdaus', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'50', N'nurma', N'fc5364bf9dbfa34954526becad136d4b', N'Nurmaningsih', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'51', N'wiyono', N'21232f297a57a5a743894a0e4a801fc3', N'Wiyono', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'52', N'andy', N'21232f297a57a5a743894a0e4a801fc3', N'Andy natenael', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'53', N'rully_fin', N'21232f297a57a5a743894a0e4a801fc3', N'Rully Muliarto', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'54', N'rully_etod', N'21232f297a57a5a743894a0e4a801fc3', N'Rully Muliarto', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'55', N'ibnu_sina', N'21232f297a57a5a743894a0e4a801fc3', N'Ibnu Sina', NULL, N'2', N'1', N'1', N'2020-09-14 07:12:34')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'56', N'deri', N'21232f297a57a5a743894a0e4a801fc3', N'Martakhir Derita', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'66', N'barasulaiman@gmail.com', N'23ed66fc52b27d2e1de1a061ea46c4dd', N'Sulaiman Nur Umbara', N'barasulaiman@gmail.com', N'2', N'1', NULL, N'2021-02-25 13:24:19')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'67', N'carlayuliya@gmail.com', N'21232f297a57a5a743894a0e4a801fc3', N'Carla yulita', N'carlayuliya@gmail.com', N'2', N'1', NULL, N'2021-02-25 13:26:28')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'68', N'ratnatata2882@gmail.com', N'517e4c4afd230ed891e19b1a40e76884', N'Dewi ratna sari', N'ratnatata2882@gmail.com', N'2', N'0', NULL, N'2021-02-25 13:26:57')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'69', N'tania.komara@gmail.com', N'21232f297a57a5a743894a0e4a801fc3', N'Tania Senja Komara', N'tania.komara@gmail.com', N'2', N'1', NULL, N'2021-02-25 13:29:38')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'70', N'ch88buldozer@gmail.com', N'21232f297a57a5a743894a0e4a801fc3', N'Charles', N'ch88buldozer@gmail.com', N'2', N'1', NULL, N'2021-02-25 13:31:07')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'71', N'bayu.kurniawan9937@gmail.com', N'81c2cd0a806712d22986d4e2ed7cd392', N'Bayu Kurniawan', N'bayu.kurniawan9937@gmail.com', N'2', N'1', NULL, N'2021-02-25 13:50:01')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'72', N'ratnatata2882@gmail.com', N'517e4c4afd230ed891e19b1a40e76884', N'Dewi ratna sari', N'ratnatata2882@gmail.com', N'2', N'0', NULL, N'2021-02-25 13:51:13')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'73', N'charles.nishida@yahoo.com', N'21232f297a57a5a743894a0e4a801fc3', N'Charles ', N'charles.nishida@yahoo.com', N'2', N'1', NULL, N'2021-02-25 13:55:29')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'74', N'ceciliakarundeng.ck@gmail.com', N'b26f20b469422bfe2a42f44b3abe302d', N'Cecilia Kartika Putri Karundeng', N'ceciliakarundeng.ck@gmail.com', N'2', N'1', NULL, N'2021-02-25 14:06:41')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'75', N'ratnatata28822882@gmail.com', N'517e4c4afd230ed891e19b1a40e76884', N'Dewi ratna sari', N'ratnatata28822882@gmail.com', N'2', N'1', NULL, N'2021-02-25 14:59:30')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'76', N'mrsagrian17@gmail.com', N'2ba859759d7c79abb764168fcd2a52b9', N'Lindasari', N'mrsagrian17@gmail.com', N'2', N'1', NULL, N'2021-02-25 15:16:41')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'77', N'faizsyaifulloh99@gmail.com', N'21232f297a57a5a743894a0e4a801fc3', N'Faiz syaufulloh', N'faizsyaifulloh99@gmail.com', N'2', N'1', NULL, N'2021-02-25 16:52:01')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'78', N'yulia34c@gmail.com', N'5b03775706e2357c0181e3b571e2a88a', N'Yulianti Chandra', N'yulia34c@gmail.com', N'2', N'1', NULL, N'2021-03-01 09:51:13')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'79', N'ayu.asuhaya@gmail.com', N'21232f297a57a5a743894a0e4a801fc3', N'Ayu.agustin.suhaja', N'ayu.asuhaya@gmail.com', N'2', N'1', NULL, N'2021-03-17 14:53:39')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'80', N'euistomo@gmail.com', N'21232f297a57a5a743894a0e4a801fc3', N'Eis susanti', N'euistomo@gmail.com', N'2', N'1', NULL, N'2021-03-20 09:35:45')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'81', N'lianingsih79@gmail.com', N'c5fbe01b963a4505325cc967023d24e4', N'Lianingsih ', N'lianingsih79@gmail.com', N'2', N'1', NULL, N'2021-03-20 09:38:25')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'83', N'erick.meidiwan@yahoo.com', N'21232f297a57a5a743894a0e4a801fc3', N'Erik Meidiwan', N'erick.meidiwan@yahoo.com', N'2', N'1', NULL, N'2021-05-03 11:01:54')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'84', N'hjupiterhidayat@yahoo.com', N'21232f297a57a5a743894a0e4a801fc3', N'Hidayat', N'hjupiterhidayat@yahoo.com', N'2', N'1', NULL, N'2021-05-06 05:18:36')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'86', N'ariniartanti5@gmail.com', N'21232f297a57a5a743894a0e4a801fc3', N'Arini Artanti', N'ariniartanti5@gmail.com', N'2', N'1', NULL, N'2021-05-06 12:11:35')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'87', N'agussetiady99@gmail.com', N'21232f297a57a5a743894a0e4a801fc3', N'Agus Setiady', N'agussetiady99@gmail.com', N'2', N'1', NULL, N'2021-05-06 12:17:14')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'88', N'revhita@gmail.com', N'21232f297a57a5a743894a0e4a801fc3', N'Revhita Anis', N'revhita@gmail.com', N'2', N'1', NULL, N'2021-05-06 15:43:16')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'90', N'lianisari.srg@gmail.com', N'e10adc3949ba59abbe56e057f20f883e', N'GABENA SARI', N'lianisari.srg@gmail.com', N'2', N'1', NULL, N'2021-05-06 15:52:14')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'91', N'aguspodojoyo.st88@gmail.com', N'4b293dae156b042d92efd96a2048d7b4', N'Agus setiady', N'aguspodojoyo.st88@gmail.com', N'2', N'1', NULL, N'2021-05-06 16:01:32')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'92', N'gabena.sari@gmail.com', N'25d55ad283aa400af464c76d713c07ad', N'GABENA SARI', N'gabena.sari@gmail.com', N'2', N'1', NULL, N'2021-05-07 10:54:07')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'93', N'meelingbogor@gmail.com', N'cdb0b6889f4def26f43951b2d5b7a9e3', N'Meling', N'meelingbogor@gmail.com', N'2', N'1', NULL, N'2021-05-07 11:28:36')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'94', N'rediray2@gmail.com', N'9ba6be0eafb92d9ebfe297723fbd59c3', N'Renaldi Raybani ', N'rediray2@gmail.com', N'2', N'1', NULL, N'2021-05-08 00:45:24')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'95', N'siswanto.hadi165@gmail.com', N'6f0794793ded269b49d7c551ee1f6aff', N'Slamet hadi siswanto', N'siswanto.hadi165@gmail.com', N'2', N'1', NULL, N'2021-05-08 08:56:46')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'96', N'naufal.akselera@gmail.com', N'21232f297a57a5a743894a0e4a801fc3', N'Faris naufal', N'naufal.akselera@gmail.com', N'2', N'1', NULL, N'2021-05-11 15:03:54')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'97', N'keuangan', N'21232f297a57a5a743894a0e4a801fc3', N'Nur Muhammad Fuadi', NULL, N'2', N'1', N'1', NULL)
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'98', N'theresiafitriani015@gmail.com', N'21232f297a57a5a743894a0e4a801fc3', N'Theresia vitriani Trisi', N'theresiafitriani015@gmail.com', N'2', N'1', NULL, N'2021-05-24 15:15:32')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'99', N'rezalazuardi17@gmail.com', N'21232f297a57a5a743894a0e4a801fc3OUT', N'Rezah Aprilian', N'rezalazuardi17@gmail.com', N'2', N'0', NULL, N'2021-05-25 14:15:56')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'100', N'nmfu1', N'21232f297a57a5a743894a0e4a801fc3', N'nmfu', N'drezz@gmail.com', N'2', N'1', NULL, N'2021-05-25 14:23:33')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'101', N'gurning777@gmail.com', N'21232f297a57a5a743894a0e4a801fc3OUT', N'Agustina mariana', N'gurning777@gmail.com', N'2', N'0', NULL, N'2021-06-03 14:22:26')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'102', N'romy.s.1215@gmail.com', N'00e1663f12c553fbdb5a2a4a54f62184', N'romy', N'romy.s.1215@gmail.com', N'2', N'1', NULL, N'2021-06-03 14:28:30')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'103', N'yulihastuti.84@gmail.com', N'4820115f18a71a879d0c60413f791cab', N'YULI HASTUTI', N'yulihastuti.84@gmail.com', N'2', N'1', NULL, N'2021-06-22 10:03:27')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'104', N'bayoegcv@gmail.com', N'd756355d1937d8ecd2b060d455063f08', N'Bayu fajar sidik', N'bayoegcv@gmail.com', N'2', N'1', NULL, N'2021-06-23 15:31:22')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'105', N'raka', N'863b224639693aa52f27d8dd0cdae764', N'Raka', NULL, N'2', N'1', NULL, N'2021-07-07 14:45:40')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'106', N'irvandi', N'4e4925a32a20e11a3044f084a2cfe35c', N'Irvandi Siahaan', NULL, N'2', N'1', NULL, N'2021-07-07 14:49:43')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'107', N'adit', N'21232f297a57a5a743894a0e4a801fc3', N'Aditya Soekarno AR', NULL, N'2', N'1', NULL, N'2021-07-07 14:54:15')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'108', N'adnan', N'21232f297a57a5a743894a0e4a801fc3', N'Adnan Fauzi Siregar', NULL, N'2', N'1', NULL, N'2021-07-07 15:12:50')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'109', N'ayu', N'21232f297a57a5a743894a0e4a801fc3', N'Ayu Kartika', NULL, N'2', N'1', NULL, N'2021-07-07 15:12:57')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'110', N'faisal', N'21232f297a57a5a743894a0e4a801fc3', N'Mohammad Faisal', NULL, N'2', N'1', NULL, N'2021-07-07 15:13:34')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'111', N'ridha', N'21232f297a57a5a743894a0e4a801fc3', N'Ridha Putra Pertama', NULL, N'2', N'1', NULL, N'2021-07-07 15:53:20')
GO

INSERT INTO [dbo].[com_user] ([id_user], [username], [passwords], [surename], [email], [level], [is_active], [uc], [dc]) VALUES (N'112', N'linda', N'21232f297a57a5a743894a0e4a801fc3', N'Erlinda Kusumawati', NULL, N'2', N'2', NULL, N'2021-07-09 10:55:35')
GO

SET IDENTITY_INSERT [dbo].[com_user] OFF
GO


-- ----------------------------
-- Auto increment value for com_user
-- ----------------------------
DBCC CHECKIDENT ('[dbo].[com_user]', RESEED, 113)
GO


-- ----------------------------
-- Indexes structure for table com_user
-- ----------------------------
CREATE NONCLUSTERED INDEX [level]
ON [dbo].[com_user] (
  [level] ASC
)
GO


-- ----------------------------
-- Primary Key structure for table com_user
-- ----------------------------
ALTER TABLE [dbo].[com_user] ADD CONSTRAINT [PK_com_user_id_user] PRIMARY KEY CLUSTERED ([id_user])
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)  
ON [PRIMARY]
GO

