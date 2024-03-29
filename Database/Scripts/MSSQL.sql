USE [tempApp]
GO
/****** Object:  Table [dbo].[Category]    Script Date: 12.02.2016 01:46:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Category](
	[id] [int] NOT NULL,
	[refCategory] [int] NOT NULL,
	[refTranslationName] [int] NOT NULL,
	[refTranslationDescription] [int] NOT NULL,
	[RecordTime] [datetime] NOT NULL,
 CONSTRAINT [PK_Category] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[CategoryAttribute]    Script Date: 12.02.2016 01:46:40 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CategoryAttribute](
	[id] [int] NOT NULL,
	[refCategory] [int] NOT NULL,
	[refCategoryGroup] [int] NOT NULL,
	[refInputType] [int] NOT NULL,
	[refTranslationName] [int] NOT NULL,
	[Order] [int] NULL,
	[ShownInFilter] [bit] NULL,
	[ShownInDetails] [bit] NULL,
 CONSTRAINT [PK_CategoryAttribute] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[CategoryGroup]    Script Date: 12.02.2016 01:46:40 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CategoryGroup](
	[id] [int] NOT NULL,
	[refTranslationName] [int] NOT NULL,
 CONSTRAINT [PK_CategoryGroup] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[InputTypeEnum]    Script Date: 12.02.2016 01:46:40 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[InputTypeEnum](
	[id] [int] NOT NULL,
	[Name] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_InputTypeEnum] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Item]    Script Date: 12.02.2016 01:46:40 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Item](
	[id] [int] NOT NULL,
	[refCategory] [int] NOT NULL,
	[refTranslationName] [int] NOT NULL,
	[refTranslationSlug] [int] NOT NULL,
 CONSTRAINT [PK_Item] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Translation]    Script Date: 12.02.2016 01:46:40 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Translation](
	[id] [int] NOT NULL,
	[Turkish] [nvarchar](250) NULL,
	[English] [nvarchar](250) NULL,
 CONSTRAINT [PK_Translation_1] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
ALTER TABLE [dbo].[Category] ADD  CONSTRAINT [DF_Category_RecordTime]  DEFAULT (getdate()) FOR [RecordTime]
GO
ALTER TABLE [dbo].[Category]  WITH CHECK ADD  CONSTRAINT [FK_Category_refCategory] FOREIGN KEY([refCategory])
REFERENCES [dbo].[Category] ([id])
GO
ALTER TABLE [dbo].[Category] CHECK CONSTRAINT [FK_Category_refCategory]
GO
ALTER TABLE [dbo].[Category]  WITH CHECK ADD  CONSTRAINT [FK_Category_Translation_Description] FOREIGN KEY([refTranslationDescription])
REFERENCES [dbo].[Translation] ([id])
GO
ALTER TABLE [dbo].[Category] CHECK CONSTRAINT [FK_Category_Translation_Description]
GO
ALTER TABLE [dbo].[Category]  WITH CHECK ADD  CONSTRAINT [FK_Category_Translation_Name] FOREIGN KEY([refTranslationName])
REFERENCES [dbo].[Translation] ([id])
GO
ALTER TABLE [dbo].[Category] CHECK CONSTRAINT [FK_Category_Translation_Name]
GO
ALTER TABLE [dbo].[CategoryAttribute]  WITH CHECK ADD  CONSTRAINT [FK_CategoryAttribute_Category] FOREIGN KEY([refCategory])
REFERENCES [dbo].[Category] ([id])
GO
ALTER TABLE [dbo].[CategoryAttribute] CHECK CONSTRAINT [FK_CategoryAttribute_Category]
GO
ALTER TABLE [dbo].[CategoryAttribute]  WITH CHECK ADD  CONSTRAINT [FK_CategoryAttribute_CategoryGroup] FOREIGN KEY([refCategoryGroup])
REFERENCES [dbo].[CategoryGroup] ([id])
GO
ALTER TABLE [dbo].[CategoryAttribute] CHECK CONSTRAINT [FK_CategoryAttribute_CategoryGroup]
GO
ALTER TABLE [dbo].[CategoryAttribute]  WITH CHECK ADD  CONSTRAINT [FK_CategoryAttribute_InputTypeEnum] FOREIGN KEY([refInputType])
REFERENCES [dbo].[InputTypeEnum] ([id])
GO
ALTER TABLE [dbo].[CategoryAttribute] CHECK CONSTRAINT [FK_CategoryAttribute_InputTypeEnum]
GO
ALTER TABLE [dbo].[CategoryAttribute]  WITH CHECK ADD  CONSTRAINT [FK_CategoryAttribute_Translation] FOREIGN KEY([refTranslationName])
REFERENCES [dbo].[Translation] ([id])
GO
ALTER TABLE [dbo].[CategoryAttribute] CHECK CONSTRAINT [FK_CategoryAttribute_Translation]
GO
ALTER TABLE [dbo].[CategoryGroup]  WITH CHECK ADD  CONSTRAINT [FK_CategoryGroup_Translation] FOREIGN KEY([refTranslationName])
REFERENCES [dbo].[Translation] ([id])
GO
ALTER TABLE [dbo].[CategoryGroup] CHECK CONSTRAINT [FK_CategoryGroup_Translation]
GO
ALTER TABLE [dbo].[Item]  WITH CHECK ADD  CONSTRAINT [FK_Item_Category] FOREIGN KEY([refCategory])
REFERENCES [dbo].[Category] ([id])
GO
ALTER TABLE [dbo].[Item] CHECK CONSTRAINT [FK_Item_Category]
GO
ALTER TABLE [dbo].[Item]  WITH CHECK ADD  CONSTRAINT [FK_Item_Translation] FOREIGN KEY([refTranslationName])
REFERENCES [dbo].[Translation] ([id])
GO
ALTER TABLE [dbo].[Item] CHECK CONSTRAINT [FK_Item_Translation]
GO
ALTER TABLE [dbo].[Item]  WITH CHECK ADD  CONSTRAINT [FK_Item_Translation2] FOREIGN KEY([refTranslationSlug])
REFERENCES [dbo].[Translation] ([id])
GO
ALTER TABLE [dbo].[Item] CHECK CONSTRAINT [FK_Item_Translation2]
GO
