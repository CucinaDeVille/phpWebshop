INSERT INTO categories (name, parent_id) VALUES
                                             ('Electronics', NULL),

                                             ('Computers', 1),
                                             ('Phones', 1),
                                             ('Tablets', 1),
                                             ('Monitors', 1),
                                             ('TVs', 1),
                                             ('Accessories', 1),

-- Computers subcategories
                                             ('MacBook', 2),
                                             ('iMac', 2),
                                             ('Mac Mini', 2),

-- Phones (direct products will be here)
                                             ('iPhones', 3),

-- Tablets
                                             ('iPads', 4),

-- Monitors
                                             ('4K Monitors', 5),
                                             ('5K Monitors', 5),
                                             ('Ultrawide Monitors', 5),
                                             ('Studio Display', 5),

-- TVs
                                             ('4K TVs', 6),
                                             ('OLED TVs', 6),

-- Accessories
                                             ('AirPods', 7),
                                             ('Apple Watch', 7),
                                             ('Chargers & Cables', 7);

INSERT INTO products (name, description, image, price, category_id) VALUES

-- iPhones
('iPhone 15', 'Latest Apple smartphone with A16 chip', 'iphone15.jpg', 999.00, 11),
('iPhone 15 Pro', 'Pro model with titanium design', 'iphone15pro.jpg', 1199.00, 11),
('iPhone 14', 'Previous generation iPhone', 'iphone14.jpg', 849.00, 11),

-- iPads
('iPad Air', 'Lightweight Apple tablet', 'ipadair.jpg', 699.00, 12),
('iPad Pro 11"', 'Professional tablet performance', 'ipadpro11.jpg', 1099.00, 12),

-- MacBook
('MacBook Air M2', 'Ultra portable Apple laptop', 'mba_m2.jpg', 1199.00, 8),
('MacBook Pro 14"', 'Powerful laptop for professionals', 'mbp14.jpg', 1999.00, 8),

-- iMac
('iMac 24"', 'All-in-one desktop computer', 'imac24.jpg', 1499.00, 9),

-- Mac Mini
('Mac Mini M2', 'Compact desktop computer', 'macmini.jpg', 799.00, 10),

-- Monitors
('Apple Studio Display', '5K Retina display', 'studiodisplay.jpg', 1599.00, 15),
('LG UltraFine 4K', 'High quality 4K monitor for Mac', 'lg4k.jpg', 699.00, 13),

-- TVs
('LG OLED C3 55"', 'OLED TV with perfect blacks', 'oled55.jpg', 1499.00, 17),
('Samsung 4K Smart TV', 'Ultra HD smart television', 'samsung4k.jpg', 899.00, 16),

-- Accessories
('AirPods Pro', 'Noise cancelling earbuds', 'airpodspro.jpg', 279.00, 18),
('Apple Watch Series 9', 'Smartwatch with health tracking', 'watch9.jpg', 499.00, 19);

