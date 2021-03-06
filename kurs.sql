USE [BAYUBUANA]
GO
/****** Object:  Table [dbo].[fin_kurs]    Script Date: 11/12/2021 10:22:22 ******/
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
/****** Object:  Table [dbo].[fin_kurs_name]    Script Date: 11/12/2021 10:22:22 ******/
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
