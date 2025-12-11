CREATE TABLE users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(50) UNIQUE,
    userPassword VARCHAR(255),
    userRole VARCHAR(20) DEFAULT 'CLIENT'
);

CREATE TABLE products (
    productId INT AUTO_INCREMENT PRIMARY KEY,
    productName VARCHAR(150),
    productDescription TEXT,
    productPrice DECIMAL(10,2),
    productImgUrl VARCHAR(255),
    inventoryQty INT DEFAULT 0
);

CREATE TABLE sales (
    saleId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    total DECIMAL(10,2),
    items JSON,
    status VARCHAR(20),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (userName, userPassword, userRole)
VALUES 
('admin', '$2y$10$VvI0iKmqQkMljg04tRMS9uLw8y38nS5EnqXG7akA68RDnPWRP4bX6', 'ADMIN');

INSERT INTO products (productName, productDescription, productPrice, productImgUrl, inventoryQty)
VALUES
('Retratera Personalizada','Fotografías impresas temáticas',250,'/imgs/cajitatematicaequipo.png',10),
('Cajita Temática','Detalles perfectos para regalos',180,'/imgs/retrateraled.png',8),
('Regalo LED','Iluminación especial',300,'/imgs/retratera-personalizada.png',5);
