USE [BAYUBUANA]
GO
/****** Object:  Table [dbo].[fin_account]    Script Date: 11/10/2021 16:16:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[fin_account](
	[code] [char](5) NOT NULL,
	[account_name] [varchar](100) NULL,
	[trx_type] [char](2) NULL,
PRIMARY KEY CLUSTERED 
(
	[code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[fin_bank]    Script Date: 11/10/2021 16:16:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[fin_bank](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[bank_name] [varchar](25) NULL,
	[branch] [char](3) NULL,
	[bank_norek] [varchar](20) NULL,
	[bank_rek_name] [varchar](50) NULL,
	[cr_dt] [datetime2](0) NULL,
	[gl_account] [varchar](30) NULL,
	[kurs_code] [char](3) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[fin_kurs]    Script Date: 11/10/2021 16:16:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[fin_kurs](
	[id] [int] NOT NULL,
	[kurs_code] [char](3) NOT NULL,
	[kurs_amount] [float] NULL,
	[kurs_date] [date] NULL,
	[input_date] [datetime2](7) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[fin_kurs_name]    Script Date: 11/10/2021 16:16:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[fin_kurs_name](
	[kurs_code] [char](3) NOT NULL,
	[Kurs_det] [varchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[kurs_code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[fin_mutation]    Script Date: 11/10/2021 16:16:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[fin_mutation](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[account_code] [char](5) NULL,
	[bank_id] [int] NULL,
	[amount] [float] NULL,
	[trx_date] [date] NULL,
	[posting_date] [datetime2](0) NULL,
	[posting_by] [int] NULL,
	[type_mutation] [varchar](2) NULL,
	[posting_st] [varchar](3) NULL,
	[remark] [nvarchar](max) NULL,
	[currancy] [varchar](3) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
ALTER TABLE [dbo].[fin_account] ADD  DEFAULT (NULL) FOR [account_name]
GO
ALTER TABLE [dbo].[fin_bank] ADD  DEFAULT (NULL) FOR [bank_name]
GO
ALTER TABLE [dbo].[fin_bank] ADD  DEFAULT (NULL) FOR [branch]
GO
ALTER TABLE [dbo].[fin_bank] ADD  DEFAULT (NULL) FOR [bank_norek]
GO
ALTER TABLE [dbo].[fin_bank] ADD  DEFAULT (NULL) FOR [bank_rek_name]
GO
ALTER TABLE [dbo].[fin_bank] ADD  DEFAULT (NULL) FOR [cr_dt]
GO
ALTER TABLE [dbo].[fin_mutation] ADD  DEFAULT (NULL) FOR [account_code]
GO
ALTER TABLE [dbo].[fin_mutation] ADD  DEFAULT (NULL) FOR [bank_id]
GO
ALTER TABLE [dbo].[fin_mutation] ADD  DEFAULT (NULL) FOR [amount]
GO
ALTER TABLE [dbo].[fin_mutation] ADD  DEFAULT (NULL) FOR [trx_date]
GO
ALTER TABLE [dbo].[fin_mutation] ADD  DEFAULT (NULL) FOR [posting_date]
GO
ALTER TABLE [dbo].[fin_mutation] ADD  DEFAULT (NULL) FOR [posting_by]
GO
