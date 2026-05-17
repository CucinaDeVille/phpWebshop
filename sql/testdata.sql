INSERT INTO categories (name, parent_id) VALUES
                                             ('Electronics', NULL),

                                             ('Computers', 1), -- id2
                                             ('Phones', 1), -- id3
                                             ('Tablets', 1), -- id4
                                             ('Monitors', 1), -- id5
                                             ('TVs', 1), -- id6
                                             ('Accessories', 1), -- id7

-- Computers subcategories
                                             ('MacBook', 2), -- id8
                                             ('iMac', 2), -- id9
                                             ('Mac Mini', 2), -- id10

-- Phones (direct products will be here)
                                             ('iPhones', 3), -- id11

-- Tablets
                                             ('iPads', 4), -- id12

-- Monitors
                                             ('4K Monitors', 5), -- id13
                                             ('5K Monitors', 5), -- id14
                                             ('Ultrawide Monitors', 5), -- id15
                                             ('Studio Display', 5), -- id16

-- TVs
                                             ('4K TVs', 6), -- id17
                                             ('OLED TVs', 6), -- id18

-- Accessories
                                             ('AirPods', 7), -- id19
                                             ('Apple Watch', 7), -- id20
                                             ('Chargers & Cables', 7); -- id21

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
('LG UltraFine 4K', 'High quality 4K monitor for Mac', 'lg4k.jpg', 699.00, 13),
('LG UltraFine 5K', 'High quality 5K monitor for Mac', 'lg5k.jpg', 1099.00, 14),
('Samsung UltraWide 4K', '32 inch monitor for productive workflows', 'samsunguw.jpg', 899.00, 15),
('Apple Studio Display', '5K Retina display', 'studiodisplay.jpg', 1599.00, 16),

-- TVs
('Samsung 4K Smart TV', 'Ultra HD smart television', 'samsung4k.jpg', 899.00, 17),
('LG OLED C3 55"', 'OLED TV with perfect blacks', 'oled55.jpg', 1499.00, 18),

-- Accessories
('AirPods Pro', 'Noise cancelling earbuds', 'airpodspro.jpg', 279.00, 19),
('Apple Watch Series 9', 'Smartwatch with health tracking', 'watch9.jpg', 499.00, 20),
('Apple MagSafe Duo', 'Charge iPhone and Apple Watch at the same time', 'magsafeduo.jpg', 89.00, 21);
