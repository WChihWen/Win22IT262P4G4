#since constraints cause problems, drop tables first, working backward
DROP TABLE IF EXISTS winter2022_rss_news;
DROP TABLE IF EXISTS winter2022_rss_categories; 



#all tables must be of type InnoDB to do transactions, foreign key constraints
CREATE TABLE winter2022_rss_categories(
CategoryID INT UNSIGNED NOT NULL AUTO_INCREMENT,
ParentID INT UNSIGNED DEFAULT 0,
CategoryName VARCHAR(100) DEFAULT '',
PRIMARY KEY (CategoryID)
)ENGINE=INNODB; 


#foreign key field must match size and type, hence NewsID is INT UNSIGNED
CREATE TABLE winter2022_rss_news(
NewsID INT UNSIGNED NOT NULL AUTO_INCREMENT,
CategoryID INT UNSIGNED DEFAULT 0,
NewsTitle TEXT,
NewsUrl TEXT,
Source VARCHAR(200) DEFAULT '',
SourceUrl TEXT,
DateAdded DATETIME,
PRIMARY KEY (NewsID),
INDEX NewsID_index(NewsID),
FOREIGN KEY (CategoryID) REFERENCES winter2022_rss_categories(CategoryID) ON DELETE CASCADE
)ENGINE=INNODB;
