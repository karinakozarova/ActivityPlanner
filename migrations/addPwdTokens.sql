DROP TABLE IF EXISTS pwdtokens;

CREATE TABLE `pwdtokens` (
 `pwdID` int(11) NOT NULL AUTO_INCREMENT,
 `pwdResetEmail` text NOT NULL,
 `pwdResetSelector` text NOT NULL,
 `pwdResetToken` longtext NOT NULL,
 `pwdExpiryDate` text NOT NULL,
 PRIMARY KEY (`pwdID`)
)