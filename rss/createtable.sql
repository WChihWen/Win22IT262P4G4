#since constraints cause problems, drop tables first, working backward
DROP TABLE IF EXISTS winter2022_rss_feeds;
DROP TABLE IF EXISTS winter2022_rss_category; 


#all tables must be of type InnoDB to do transactions, foreign key constraints
CREATE TABLE winter2022_rss_category(
CategoryID INT UNSIGNED NOT NULL AUTO_INCREMENT,
CategoryName VARCHAR(100) DEFAULT '',
PRIMARY KEY (CategoryID)
)ENGINE=INNODB; 

INSERT INTO winter2022_rss_category VALUES (NULL,'Sport');
INSERT INTO winter2022_rss_category VALUES (NULL,'Category2');
INSERT INTO winter2022_rss_category VALUES (NULL,'Category3');


#foreign key field must match size and type, hence NewsID is INT UNSIGNED
CREATE TABLE winter2022_rss_feeds(
FeedsID INT UNSIGNED NOT NULL AUTO_INCREMENT,
CategoryID INT UNSIGNED DEFAULT 0,
SubCategory VARCHAR(100),
FeedsFrom VARCHAR(100),
FeedsUrl TEXT,
DateAdded DATETIME,
PRIMARY KEY (FeedsID),
INDEX FeedsID_index(FeedsID),
FOREIGN KEY (CategoryID) REFERENCES winter2022_rss_category(CategoryID) ON DELETE CASCADE
)ENGINE=INNODB;


INSERT INTO winter2022_rss_feeds VALUES (NULL,1,'tennis','Google RSS News','https://news.google.com/rss/search?q=Sport+tennis&hl=en-US&gl=US&ceid=US:en',now());
INSERT INTO winter2022_rss_feeds VALUES (NULL,1,'baseball','Google RSS News','https://news.google.com/rss/search?q=Category1+SubCategory2&hl=en-US&gl=US&ceid=US:en',now());
INSERT INTO winter2022_rss_feeds VALUES (NULL,1,'football','Google RSS News','https://news.google.com/rss/search?q=Category1+SubCategory3&hl=en-US&gl=US&ceid=US:en',now());

INSERT INTO winter2022_rss_feeds VALUES (NULL,2,'SubCategory1','Google RSS News','https://news.google.com/rss/search?q=Category2+SubCategory1&hl=en-US&gl=US&ceid=US:en',now());
INSERT INTO winter2022_rss_feeds VALUES (NULL,2,'SubCategory2','Google RSS News','https://news.google.com/rss/search?q=Category2+SubCategory2&hl=en-US&gl=US&ceid=US:en',now());
INSERT INTO winter2022_rss_feeds VALUES (NULL,2,'SubCategory3','Google RSS News','https://news.google.com/rss/search?q=Category2+SubCategory3&hl=en-US&gl=US&ceid=US:en',now());

INSERT INTO winter2022_rss_feeds VALUES (NULL,3,'SubCategory1','Google RSS News','https://news.google.com/rss/search?q=Category3+SubCategory1&hl=en-US&gl=US&ceid=US:en',now());
INSERT INTO winter2022_rss_feeds VALUES (NULL,3,'SubCategory2','Google RSS News','https://news.google.com/rss/search?q=Category3+SubCategory2&hl=en-US&gl=US&ceid=US:en',now());
INSERT INTO winter2022_rss_feeds VALUES (NULL,3,'SubCategory3','Google RSS News','https://news.google.com/rss/search?q=Category3+SubCategory3&hl=en-US&gl=US&ceid=US:en',now());