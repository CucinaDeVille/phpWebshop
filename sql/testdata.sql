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
('Apple iPhone XR', 'Apple iPhone from 2018', 'assets/images/iphonexr.jpeg', 699.00, 11),
('Apple iPhone SE', 'Apple iPhone from 2016', 'assets/images/iphonese.jpeg', 589.00, 11),
('Apple iPhone 5c', 'Apple iPhone from 2013', 'assets/images/iphone5c.heic', 599.00, 11),

-- iPads
('Apple iPad mini', 'Small Apple iPad', 'assets/images/ipadmini.heic', 599.00, 12),
('Apple iPad Pro 11"', 'Pro Apple iPad', 'assets/images/ipadpro.heic', 799.00, 12),

-- MacBook
('MacBook Air M1', 'First Mac with Apple Silicon', 'assets/images/mba13.heic', 999.00, 8),
('MacBook Pro 16"', 'Powerful Apple Mac for professionals', 'assets/images/mbp16.heic', 2499.00, 8),

-- iMac
('iMac 24"', 'All-in-one Apple desktop computer', 'assets/images/lg5k.jpeg', 1199.00, 9),

-- Mac Mini
('Mac Mini M4', 'Compact Apple desktop computer', 'assets/images/macmini.heic', 799.00, 10),

-- Monitors
('LG UltraFine 4K', 'High quality 4K monitor for Mac', 'assets/images/lg4k.jpeg', 699.00, 13),
('LG UltraFine 5K', 'High quality 5K monitor for Mac', 'assets/images/lg5k.jpeg', 899.00, 14),
('DELL UltraWide 4K', '34 inch monitor for productive workflows', 'assets/images/lg5k.jpeg', 899.00, 15),
('Apple Studio Display', '5K Retina display', 'assets/images/lg5k.jpeg', 1599.00, 16),

-- TVs
('Samsung 4K Smart TV', 'Ultra HD smart television', 'assets/images/lgoled.heic', 499.00, 17),
('LG OLED C3 55"', 'OLED TV with perfect blacks', 'assets/images/lgoled.heic', 899.00, 18),

-- Accessories
('Apple AirPods Pro', 'Noise cancelling AirPods', 'assets/images/airpodspro.heic', 279.00, 19),
('Apple Watch Series', 'Apple Watch with health tracking', 'assets/images/applewatch.heic', 499.00, 20),
('Apple iPhone 5c Dock', 'Charge iPhone and play music in an upright position', 'assets/images/iphone5cdock.heic', 39.00, 21);
