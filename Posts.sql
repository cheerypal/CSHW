/* todo : Tables to make:
            Users - Everything on the Register page
            Posts - Year posts/code problems/news
 */

 CREATE TABLE Users(
  username VARCHAR(50) PRIMARY KEY NOT NULL,
  firstName TEXT NOT NULL,
  surname TEXT NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password  VARCHAR(40) NOT NULL,
  yearOfStudy ENUM ("1", "2", "3", "4", "5"),
  subject ENUM("CS", "CSYS", "IS", "SE"),
 )ENGINE =INNODB;

CREATE TABLE Posts(
  postID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  topic TEXT NOT NULL,
  description TEXT NOT NULL,
  timeOfPost TIME NOT NULL,
  dateOfPost DATE NOT NULL,
  tags ENUM("java", "c", "Web", "news", "python", "assembler", "ml", "prolog"),
  username VARCHAR(50) NOT NULL,
  FOREIGN KEY (username) REFERENCES Users(username)
)ENGINE =INNODB;

CREATE VIEW recentPosts as SELECT postID, topic, description, tags, timeOfPost, dateOfPost, Posts.username, yearOfStudy AS 'years', pic FROM Posts INNER JOIN Users ON Posts.username = Users.username ORDER BY postID DESC LIMIT 10;
CREATE VIEW PostsYear AS SELECT postID, topic, description, tags, timeOfPost, dateOfPost, Posts.username, yearOfStudy AS 'years', pic FROM Posts INNER JOIN Users ON Posts.username = Users.username ORDER BY postID DESC;
