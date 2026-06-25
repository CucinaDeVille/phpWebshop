INSERT INTO categories (name, parent_id) VALUES

-- Main categories
                                             ('Electronics', NULL), -- id1
                                             ('Household Appliances', NULL), -- id2
                                             ('Smart Home', NULL), -- id3

-- Subcategories
-- Electronics
                                             ('Computers', 1), -- id4
                                             ('Phones', 1), -- id5
                                             ('Tablets', 1), -- id6
                                             ('Monitors', 1), -- id7
                                             ('TVs', 1), -- id8
                                             ('Accessories', 1), -- id9
-- Household appliances
                                            ('Kitchen Appliances', 2), -- id10
                                            ('Bathroom Appliances', 2), -- id11
                                            ('Other', 2), -- id12

-- Smart home
                                            ('Indoor Lighting', 3), -- id13
                                            ('Smart Devices', 3), -- id14
                                            ('Automations', 3), -- id15
                                            ('Outdoor & Router', 3), -- id16


-- Sub-subcategories (Smart Devices)
-- Computers
                                             ('MacBook', 4), -- id17
                                             ('iMac', 4), -- id18
                                             ('Mac Mini', 4), -- id19

-- Phones
                                             ('iPhones', 5), -- id20

-- Tablets
                                             ('iPads', 6), -- id21

-- Monitors
                                             ('4K Monitors', 7), -- id22
                                             ('5K Monitors', 7), -- id23
                                             ('Ultrawide Monitors', 7), -- id24
                                             ('Studio Display', 7), -- id25

-- TVs
                                             ('4K TVs', 8), -- id26
                                             ('OLED TVs', 8), -- id27

-- Accessories
                                             ('AirPods', 9), -- id28
                                             ('Apple Watch', 9), -- id29
                                             ('Chargers & Cables', 9), -- id30

-- Sub-subcategories (Household appliances)
-- Kitchen appliances
                                            ('Mixer', 10), -- id31
                                            ('Computer Mice', 10), -- id32
                                            ('Egg cooker', 10), -- id33
-- Bathroom appliances
                                            ('Washing Machine', 11), -- id34
                                            ('Dryer', 11), -- id35
                                            ('Hair Dryer', 11), -- id36
-- other
                                            ('Vacuum Cleaner', 12), -- id37

-- Sub-subcategories (Smart home)
-- Lighting
                                            ('Bulbs', 13), -- id38
                                            ('Light Strips', 13), -- id39

-- Electronics
                                            ('Speakers', 14), -- id40
                                            ('Controllers', 14), -- id41

-- Automations
                                            ('RFID-Tags', 15), -- id42

-- Outdoors
                                            ('Outdoor Lighting', 16), -- id43
                                            ('Router', 16); -- id44

INSERT INTO products (name, description, image, price, category_id) VALUES

-- iPhones
('Apple iPhone XR', 'Apple iPhone from 2018', 'assets/images/iphonexr.jpeg', 699.00, 20),
('Apple iPhone SE', 'Apple iPhone from 2016', 'assets/images/iphonese.jpeg', 589.00, 20),
('Apple iPhone 5c', 'Apple iPhone from 2013', 'assets/images/iphone5c.jpeg', 599.00, 20),

-- iPads
('Apple iPad mini', 'Small Apple iPad', 'assets/images/ipadmini.jpeg', 599.00, 21),
('Apple iPad Pro 11"', 'Pro Apple iPad', 'assets/images/ipadpro.jpeg', 799.00, 21),

-- MacBook
('MacBook Air M1', 'First Mac with Apple Silicon', 'assets/images/mba13.jpeg', 999.00, 17),
('MacBook Pro 16"', 'Powerful Apple Mac for professionals', 'assets/images/mbp16.jpeg', 2499.00, 17),

-- iMac
('iMac 24"', 'All-in-one Apple desktop computer', 'assets/images/lg5k.jpeg', 1199.00, 18),

-- Mac Mini
('Mac Mini M4', 'Compact Apple desktop computer', 'assets/images/macmini.jpeg', 799.00, 19),

-- Monitors
('LG UltraFine 4K', 'High quality 4K monitor for Mac', 'assets/images/lg4k.jpeg', 699.00, 22),
('LG UltraFine 5K', 'High quality 5K monitor for Mac', 'assets/images/lg5k.jpeg', 899.00, 23),
('DELL UltraWide 4K', '34 inch monitor for productive workflows', 'assets/images/lg5k.jpeg', 899.00, 24),
('Apple Studio Display', '5K Retina display', 'assets/images/lg5k.jpeg', 1599.00, 25),

-- TVs
('Samsung 4K Smart TV', 'Ultra HD smart television', 'assets/images/lgoled.jpeg', 499.00, 26),
('LG OLED C3 55"', 'OLED TV with perfect blacks', 'assets/images/lgoled.jpeg', 899.00, 27),

-- Accessories
('Apple AirPods Pro', 'Noise cancelling AirPods', 'assets/images/airpodspro.jpeg', 279.00, 28),
('Apple Watch Series', 'Apple Watch with health tracking', 'assets/images/applewatch.jpeg', 499.00, 29),
('Apple iPhone 5c Dock', 'Charge iPhone and play music in an upright position', 'assets/images/iphone5cdock.jpeg', 39.00, 30),

-- Mixer
('KitchenAid Mixer', 'Powerful kitchen mixer for baking', 'assets/images/mixer.jpeg', 199.00, 31),
('Bosch Hand Mixer', 'Compact hand mixer for daily use', 'assets/images/mixer2.jpeg', 59.00, 31),

-- Mice
('Logitech MX Master 3S', 'Ergonomic Computer Mouse', 'assets/images/mouse.jpeg', 149.00, 32),
('Apple Mighty Mouse', 'White Computer Mouse', 'assets/images/mouse2.jpeg', 129.00, 32),

-- Egg cooker
('Krups Egg Cooker', 'Cook up to 3 eggs perfectly', 'assets/images/eggcooker.jpeg', 29.00, 33),
('Severin Egg Boiler', 'Simple egg cooking device', 'assets/images/eggcooker2.jpeg', 24.00, 33),

-- Washing Machine
('Miele Washing Machine', 'Energy efficient washing machine', 'assets/images/washingmachine.jpeg', 499.00, 34),
('Bosch EcoBubble Washer', 'Powerful and smart washing machine', 'assets/images/washingmachine2.jpeg', 549.00, 34),

-- Dryer
('Miele Heat Pump Dryer', 'Low energy drying technology', 'assets/images/dryer.jpeg', 599.00, 35),
('AEG Tumble Dryer', 'Fast and gentle drying', 'assets/images/dryer2.jpeg', 529.00, 35),

-- Hair Dryer
('Braun Supersonic', 'Premium hair dryer with fast drying', 'assets/images/hairdryer.jpeg', 399.00, 36),
('Philips Hair Dryer', 'Classic household hair dryer', 'assets/images/hairdryer2.jpeg', 39.00, 36),

-- Vacuum Cleaner
('Miele Tango', 'Powerful vacuum cleaner', 'assets/images/vacuum.jpeg', 599.00, 37),
('Dyson Vacuum Cleaner', 'Cordless home vacuum cleaner', 'assets/images/vacuum2.jpeg', 199.00, 37),

-- Bulb
('Philips Hue White Bulb', 'Smart controllable LED bulb', 'assets/images/bulb.jpeg', 19.00, 38),
('IKEA Smart Bulb', 'Affordable smart lighting', 'assets/images/bulb2.jpeg', 12.00, 38),

-- Light Strip
('Philips Hue Lightstrip', 'RGB smart LED strip', 'assets/images/lightstrip.jpeg', 79.00, 39),
('Govee LED Strip', 'Color changing LED strip', 'assets/images/lightstrip2.jpeg', 49.00, 39),

-- Speakers
('Apple Homepod', 'Smart speaker', 'assets/images/speaker.jpeg', 199.00, 40),
('Apple iPod HiFi', 'Powerful home speaker', 'assets/images/speaker2.jpeg', 159.00, 40),

-- Controllers
('Philips Hue Bridge', 'Smart home controller hub', 'assets/images/controller.jpeg', 59.00, 41),
('HomeKit Controller', 'Apple smart home control unit', 'assets/images/controller2.jpeg', 89.00, 41),

-- RFID-Tags
('NFC Smart Tags Pack', 'Automation tags for smart home actions', 'assets/images/rfid.jpeg', 14.00, 42),
('Mi Smart NFC Tags', 'Programmable automation stickers', 'assets/images/rfid2.jpeg', 12.00, 42),

-- Lighting
('Philips Outdoor Light', 'Smart outdoor lighting system', 'assets/images/bulb.jpeg', 89.00, 43),
('Ring Floodlight', 'Outdoor security light with camera', 'assets/images/bulb2.jpeg', 179.00, 43),

-- Router
('Fritzbox 7590', 'Home Router', 'assets/images/router.jpeg', 229.00, 44),
('Fritzbox 5690 Pro', 'Pro Home Router', 'assets/images/router2.jpeg', 329.00, 44);
