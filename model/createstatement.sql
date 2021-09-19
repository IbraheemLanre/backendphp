DROP DATABASE IF EXISTS productdb;
CREATE DATABASE productdb;
USE productdb;

CREATE TABLE IF NOT EXISTS product(
    productId INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sku VARCHAR(20) NOT NULL,
    name VARCHAR(50) NOT NULL,
    price DECIMAL(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS furniture(
    productId INTEGER NOT NULL PRIMARY KEY,
    height DECIMAL(4,2) NOT NULL,
    width DECIMAL(4,2) NOT NULL,
    length DECIMAL(4,2) NOT NULL,
    FOREIGN KEY(productId) REFERENCES product(productId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS book(
    productId INTEGER NOT NULL PRIMARY KEY,
    weight DECIMAL(4,2) NOT NULL,
    FOREIGN KEY(productId) REFERENCES product(productId) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS DVD(
    productId INTEGER NOT NULL PRIMARY KEY,
    size DECIMAL(6,2) NOT NULL,
    FOREIGN KEY(productId) REFERENCES product(productId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO product(sku, name, price) VALUES
('TR120555', 'Chair', 40.00),
('TR120556', 'Desk', 50.00),
('TR120557', 'Bench', 60.00),
('TR120557', 'Lion King', 60.00),
('TR120557', 'Harry Porter', 60.00),
('TR120557', 'Antivirus', 60.00);

INSERT INTO furniture(productId, height, width, length) VALUES
(1, 16.6, 17.4, 8.9),
(2, 16.6, 17.4, 8.9),
(3, 16.6, 17.4, 8.9);

INSERT INTO book(productId, weight) VALUES
(4, 17.3),
(5, 95.5);

INSERT INTO DVD(productId, size) VALUES(6, 1024);