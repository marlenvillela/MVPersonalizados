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
('Regalo LED','Iluminación especial',300,'/imgs/retratera-personalizada.png',5),
('Taza Personalizada','Taza de cerámica con tu foto',85,'/imgs/taza-personalizada.png',15),
('Llavero Grabado','Acero inoxidable con grabado',45,'/imgs/llavero-grabado.png',20),
('Marco de Fotos 3D','Marco moderno con efecto 3D',120,'/imgs/marco-fotos-3d.png',12);

INSERT INTO products (productName, productDescription, productPrice, productImgUrl, inventoryQty)
VALUES
('Retratera con Cajita','Set especial con retratera y caja decorativa',260,'/imgs/retratera con cajita.PNG',7),
('Retratera Calendario','Retratera con diseño de calendario personalizado',270,'/imgs/retrateracalendario.PNG',6),
('Retratera Aniversario','Edición especial para aniversarios',320,'/imgs/retrateraniversario.PNG',4),
('Retratera Padre','Retratera temática Día del Padre',240,'/imgs/retraterapadre.PNG',9),
('Retratera Pareja','Retratera para parejas con doble foto',295,'/imgs/retraterapareja.PNG',5),
('Set de Flores','Arreglo floral decorativo pequeño',75,'/imgs/flores1.jpeg',18),
('Bouquet Mini','Mini bouquet para detalles',95,'/imgs/flores2.jpeg',16),
('Pack Flores Premium','Pack premium de flores preservadas',150,'/imgs/flores3.jpeg',10),
('Ramo Sorpresa','Ramo sorpresa con envoltorio premium',130,'/imgs/flores4.jpeg',11);
