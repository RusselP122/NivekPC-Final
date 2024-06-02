-- Create a table for storing user information
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL, -- Add phone column
    address VARCHAR(255) NOT NULL -- Add address column
);

INSERT INTO users (username, email, password, phone, address) 
VALUES ('admin', 'admin@gmail.com', 'admin123', '', '');


-- Create a table for storing password reset requests
CREATE TABLE password_reset (
    reset_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    product_price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    stock INT NOT NULL,
    product_img VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL 
);

INSERT INTO products (product_name, product_price, description, stock, product_img, category) 
VALUES
('ZOTAC RTX 3060 Twin Edge OC', 18499.00, 'Get Amplified with the ZOTAC GAMING GeForce RTX™ 30 Series based on the NVIDIA Ampere architecture. Built with enhanced RT Cores and Tensor Cores, new streaming multiprocessors, and high-speed GDDR6 memory, the ZOTAC GAMING GeForce RTX 3060 Twin Edge OC gives rise to amplified gaming with high fidelity.', 15, 'ZOTAC RTX 3060 Twin Edge OC ZOTAC RTX 3060 Twin Edge OC.jpg', 'GPU'),
('Sapphire RX470', 3888.00, 'The Sapphire Radeon RX 470 OC Graphics Card provides smooth gameplay at HD resolutions on DirectX 12, Vulkan, and e-Sports titles. The Radeon RX 470 is also compatible with HDR (high dynamic range) content so you can experience enhanced contrast and color.', 8, 'Sapphire RX470 Sapphire RX470.jpg', 'GPU'),
('Gigabyte GTX 1660 Super', 27000.00, 'The graphics card uses 4+2 power phases design to allow the MOSFET to operate at lower temperature, and over-temperature protection design and load balancing for each MOSFET, plus the Ultra Durable certified chokes and capacitors, to provide excellent performance and longer system life.', 6, 'Gigabyte GTX 1660 Super Gigabyte GTX 1660 Super.jpg', 'GPU'),
('PNY GEFORCE RTX 3060 DDR6', 21999.00, 'The GeForce RTX™ 3060 lets you take on the latest games using the power of Ampere—NVIDIA\'s 2nd generation RTX architecture. Get incredible performance with enhanced Ray Tracing Cores and Tensor Cores, new streaming multiprocessors, and high-speed G6 memory.', 6, 'PNY GEFORCE RTX 3060 DDR6 PNY GEFORCE RTX 3060 DDR6.jpg', 'GPU'),
('PNY RTX A6000 48GB DDR6', 363187.00, 'Built on the NVIDIA Ampere architecture, the RTX A6000 combines 84 second-generation RT Cores, 336 third-generation Tensor Cores, and 10,752 CUDA cores with 48 GB of graphics memory for unprecedented rendering, AI, graphics, and compute performance. Connect two RTX A6000s with NVIDIA NVLink for 96 GB of combined GPU.', 1, 'PNY RTX A6000 48GB DDR6 PNY RTX A6000 48GB DDR6.jpg', 'GPU'),
('GALAX GTX 1660 Super', 363187.00, 'With dual 90 mm fans and fans stop to assure the temperature is maintained at a reasonable level. To prevent the stress on PCB, the 1660 Super series is furnished with back plates that befit for both colors.', 1, 'GALAX GTX 1660 Super GALAX GTX 1660 Super.jpg', 'GPU'),
('GeForce GTX 1070 Ti Gaming 8G', 32559.00, 'The GeForce GTX 1070 Ti, released in November 2017, is a high-end graphics card by NVIDIA. It\'s built on the 16nm process and features the GP104 graphics processor. Unlike the fully unlocked GTX 1080, the 1070 Ti has some shading units disabled to meet its target shader count. It boasts 2432 shading units, 152 texture mapping units, and 64 ROPs. With 8 GB of GDDR5 memory connected via a 256-bit interface, it supports DirectX 12, ensuring compatibility with modern games. The GPU operates at a base frequency of 1607 MHz, boostable up to 1683 MHz, while the memory runs at 2002 MHz (8 Gbps effective).', 1, 'GeForce GTX 1070 Ti Gaming 8G.jpg', 'GPU'),
('GeForce GTX 1080 Ti Gaming OC 11G', 40200.00, 'The GeForce GTX 1080 Ti, released in March 2017, is a top-tier graphics card by NVIDIA. It supports DirectX 12 for optimal performance in modern games. With 3584 shading units, 224 texture mapping units, and 88 ROPs, it ensures high-quality graphics. The card features 11 GB of GDDR5X memory and operates at a base frequency of 1481 MHz, boostable up to 1582 MHz.', 1, 'GeForce GTX 1080 Ti Gaming OC 11G.jpg', 'GPU'),
('Asus GTX 1660 Super', 13132.59, 'The GeForce GTX 1660 SUPER is up to 20% faster than the original GTX 1660 and up to 1.5X faster than the previous-generation GTX 1060 6GB. Powered by the award-winning NVIDIA Turing™ architecture and ultra-fast GDDR6 memory, it\'s a supercharger for today\'s most popular games. Time to gear up and get SUPER.', 3, 'Asus GTX 1660 Super Asus GTX 1660 Super.jpg', 'GPU'),
('ASUS TUF Gaming B450 Pro II', 5800.00, 'Comprehensive cooling: VRM heatsinks, PCH heatsink, Fan Xpert 2+ Next-gen connectivity: USB 3.2 Gen 2 Type-A and Type-C support Realtek S1200A codec: Pristine audio quality with unprecedented 108 dB signal-to-noise ratio for stereo line out and 103 dB SNR for line in AI Noise-Canceling Microphone: Provides crystal-clear in-game voice communication Aura Sync RGB Lighting: Synchronize LED lighting with a vast portfolio of compatible PC gear', 6, 'ASUS TUF Gaming B450 Pro II ASUS TUF Gaming B450 Pro II.jpg', 'MotherBoard'),
('Onda A520SD4 White', 7999.00, 'The ONDA A520SD4-W is a white, M-ATX PC motherboard with an A520 chipset, AM4 CPU socket, and 4xDDR4 RAM slots. It supports AMD Ryzen 3000, 4000, and 5000 series CPUs, as well as 4000G and 5000G series APUs. The motherboard has a maximum RAM capacity of 128GB, 2xSATA3.0 6Gb/s ports, and 1xM.2 SSD port. It also has a 3.5mm audio port, 5.1 audio, 1xHDMI port, 1xDVI port, and 1xVGA port.', 4, 'Onda A520SD4 White Onda A520SD4 White.jpg', 'MotherBoard'),
('MSI B550m P GEN 3', 5670.00, 'Supports AMD Ryzen™ 5000 & 3000 Series desktop processors (not compatible with AMD Ryzen™ 5 3400G & Ryzen™ 3 3200G) and AMD Ryzen™ 4000 G-Series desktop processors Supports DDR4 Memory, up to 4400(OC) MHz Turbo M.2: Running at PCI-E Gen3 x4 maximizes performance for NVMe based SSDs Powerful Design: Core Boost, Digital PWM IC, DDR4 Boost Audio Boost: Reward your ears with studio grade sound quality Steel Armor: Protecting VGA cards against bending and EMI for better performance, stability and strength.', 5, 'MSI B550m P GEN 3 MSI B550m P GEN 3.jpg', 'MotherBoard'),
('Gigabyte B550M DS3H AC', 6299.00, 'Supports AMD Ryzen™ 5000 Series/ Ryzen™ 5000 G-Series/ Ryzen™ 4000 G-Series/ Ryzen™ 3000 and Ryzen™ 3000 G-Series Processors Dual Channel ECC/ Non-ECC Unbuffered DDR4, 4 DIMMs 5+3 Phases Pure Digital VRM Solution with Low RDS(on) MOSFETs Ultra Durable™ PCIe 4.0 Ready x16 Slot Dual Ultra-Fast NVMe PCIe 4.0/3.0 M.2 Connectors Onboard Intel® Dual Band 802.11ac Wireless & BT 4.2 with WIFI Antenna High Quality Audio Capacitors and Audio Noise Guard for Ultimate Audio Quality Realtek GbE LAN with Bandwidth Management Rear HDMI & DVI Support RGB FUSION 2.0 Supports Addressable LED & RGB LED Strips Smart Fan 5 Features Multiple Temperature Sensors , Hybrid Fan Headers with FAN STOP Q-Flash Plus Update BIOS without Installing the CPU, Memory and Graphics Card Anti-Sulfur Resistors Design', 4, 'Gigabyte B550M DS3H AC Gigabyte B550M DS3H AC.jpg', 'MotherBoard'),
('A320m Motherboard', 2971.00, 'Supports AMD 5000 Series/ 5000 G-Series/ 4000 G-Series/ 3rd Gen Ryzen™/ 2nd Gen Ryzen™/ 1st Gen Ryzen™/ 2nd Gen Ryzen™ with Radeon™ Vega Graphics/ 1st Gen Ryzen™ with Radeon™ Vega Graphics/ Athlon™ with Radeon™ Vega Graphics/ 7th Gen A-series/ Athlon X4 Processors', 5, 'A320m Motherboard A320m Motherboard.jpg', 'MotherBoard'),
('Asus B550M-A WiFi', 5999.00, 'MD B550 (Ryzen AM4) micro ATX motherboard with dual M.2, PCIe 4.0, Intel® WiFi 6, 1 Gb Ethernet, HDMI/D-Sub/DVI, SATA 6 Gbps, USB 3.2 Gen 2 Type-A, and Aura Sync RGB headers support AMD AM4 socket: Ready for Ryzen™ 5000 Series/ 4000 G-Series/ 3000 Series Desktop Processors Comprehensive cooling: VRM heatsink, PCH heatsink, and Fan Xpert 2+ Ultrafast connectivity: Dual M.2, PCIe 4.0, Intel® WiFi 6, 1 Gb Ethernet, USB 3.2 Gen 2 Type-A Aura Sync RGB: Onboard addressable Gen 2 header for RGB LED strips, easily synced with Aura Sync-capable hardware', 3, 'Asus B550M-A WiFi Asus B550M-A WiFi.jpg', 'MotherBoard'),
('MSI B550 VDH PRO WIFI', 6275.00, 'PRO series helps users work smarter by delivering an efficient and productive experience. Featuring stable functionality and high-quality assembly, PRO series motherboards provide not only optimized professional workflows but also less troubleshooting and longevity.', 3, 'MSI B550 VDH PRO WIFI MSI B550 VDH PRO WIFI.jpg', 'MotherBoard'),
('ASUS TUF Gaming B550M WiFi', 10295.00, 'Unleash gaming prowess with the Asus TUF Gaming B550M-PLUS WIFI II motherboard. AM4 socket, DDR4 support, and unwavering stability. Elevate your gaming experience with this durable and reliable motherboard for a robust and seamless gaming setup.', 2, 'ASUS TUF Gaming B550M WiFi ASUS TUF Gaming B550M WiFi.jpg', 'MotherBoard'),
('Gigabyte B450 Aorus Pro Wifi', 7999.00, 'AMD B450 AORUS Motherboard with Hybrid Digital PWM, Intel® Dual Band 802.11ac WIFI, Dual M.2 with Dual Thermal Guards, Audio ALC1220-VB, Intel® GbE LAN with cFosSpeed, CEC 2019 ready, RGB FUSION 2.0', 3, 'Gigabyte B450 Aorus Pro Wifi Gigabyte B450 Aorus Pro Wifi.jpg', 'MotherBoard'),
('AMD Ryzen 7 5800X', 11799.00, 'Introducing the AMD Ryzen 7 5800X, a high-performance desktop processor with 8 cores and 16 threads. Built on the Zen 3 architecture, it delivers blazing speeds of up to 4.7 GHz. With unlocked multiplier support for easy overclocking and compatibility with DDR4 memory up to 3200 MT/s, it offers exceptional flexibility. Plus, features like hardware virtualization and support for AVX and AVX2 ensure top-tier performance for gaming and professional applications alike. Elevate your computing experience with the AMD Ryzen 7 5800X.', 10, 'AMD Ryzen 7 5800X AMD Ryzen 7 5800X2.jpg', 'CPU'),
('AMD Ryzen 5 3600', 4400.00, 'The AMD Ryzen 5 3600 desktop processor offers 6 native and 12 logical cores for smooth multitasking. Thanks to its high native frequency and its Turbo Core mode, the third-generation AMD Ryzen CPU delivers exceptional performance in gaming, intensive multitasking, video editing, 3D modeling and more. The 32MB L3 cache also enables ultra-fast processing of large numbers of instructions with low latency.', 14, 'AMD Ryzen 5 3600 AMD Ryzen 5 3600.jpg', 'CPU'),
('AMD Ryzen 5 5600', 5799.00, 'The AMD Ryzen 5 5600 is a high-performance desktop processor featuring 6 cores and 12 threads, built on the efficient Zen 3 architecture. With a base clock speed of 3.5 GHz and boost up to 4.4 GHz, it delivers excellent performance for gaming and multitasking. Equipped with 32MB of L3 cache and supporting DDR4 memory, it offers smooth operation even under heavy workloads. With a TDP of 65W and support for overclocking, it provides flexibility for enthusiasts. Designed for Socket AM4, it requires a separate graphics card and comes with a Wraith Stealth cooler for efficient cooling.', 21, 'AMD Ryzen 5 5600 AMD Ryzen 5 5600.jpg', 'CPU'),
('AMD Ryzen Threadripper 3990X', 306570.00, 'Introducing the AMD Ryzen Threadripper 3990X: a powerhouse desktop processor with an astounding 64 cores and 128 threads, designed for uncompromising performance. Built on the Zen 2 architecture and featuring AMD Simultaneous Multithreading (SMT), this CPU delivers unparalleled multitasking capabilities. With 256 MB of L3 cache and speeds up to 4.3 GHz, it\'s optimized for intensive workloads and calculation-heavy tasks. The unlocked multiplier simplifies overclocking for enthusiasts, while support for DDR4 memory with quad-channel interface ensures high-speed data transfer. With a TDP of 280 W and hardware virtualization, it\'s a top choice for demanding computing needs. Note that a separate graphics card is required for display output.', 1, 'AMD Ryzen Threadripper 3990X AMD Ryzen Threadripper 3990X.jpg', 'CPU'),
('AMD Ryzen 7 4700G', 23000.00, 'Introducing the AMD Ryzen 7 4700G, a high-performance desktop processor featuring 8 cores and 16 threads, launched in July 2020. Part of the Ryzen 7 series, it utilizes the Zen 2 (Renoir) architecture with Socket AM4. With AMD Simultaneous Multithreading (SMT), it effectively doubles its core count, enabling seamless multitasking. Boasting 8 MB of L3 cache and default clock speeds of 3.6 GHz (boosting up to 4.4 GHz), it offers impressive performance for a variety of workloads. Fabricated on a 7 nm process with over 9 billion transistors, it delivers efficient and powerful computing. The unlocked multiplier simplifies overclocking, allowing enthusiasts to dial in their desired frequencies with ease.', 1, 'AMD Ryzen 7 4700G AMD Ryzen 7 4700G.jpg', 'CPU'),
('Ryzen 5 5500', 5640.00, 'Introducing the AMD Ryzen 5 5500, a cutting-edge desktop processor launched in April 2022. With 6 cores and 12 threads powered by the Zen 3 (Cezanne) architecture, it offers impressive performance for a range of tasks. Featuring AMD Simultaneous Multithreading (SMT) and 16 MB of L3 cache, it ensures seamless multitasking and smooth operation. Clocking in at 3.6 GHz by default and boosting up to 4.2 GHz, it delivers efficient processing power.', 8, 'Ryzen 5 5500 Ryzen 5 5500.jpg', 'CPU'),
('Robin Cube Chamber Case', 1550.00, 'The Keytech Robin Cube Dual Chamber Case is a white, compact, and stylish Micro ATX PC case with a dual-chamber design that offers optimal airflow.', 5, 'Robin Cube Chamber Case Robin Cube Chamber Case.jpg', 'PC Case'),
('MSi Mag Forge M100R Mid Tower Case', 7400.00, 'The MSI MAG Forge M100R is a black, mid-tower gaming PC case with a compact design and tempered glass side panel. It\'s designed for micro-ATX and mini-ITX motherboards, but can also support ATX. The case has a spacious interior that can accommodate full-sized graphics cards and multiple cooling fans. It also has a front mesh panel with three 120 mm ARGB fans, a 120 mm ARGB fan on the rear panel, and a magnetic dust filter on the top.', 5, 'MSi Mag Forge M100R Mid Tower Case MSi Mag Forge M100R Mid Tower Case.jpg', 'PC Case'),
('Inplay Meteor 03 White', 1449.00, 'The InPlay Meteor 03 is a white mid-tower gaming case for desktop computers. It has a tempered glass side panel, a black and white design, and optimal airflow.', 6, 'Inplay Meteor 03 White Inplay Meteor 03 White.jpg', 'PC Case'),
('Inplay Robin 101 Tempered Case', 3250.00, 'The Inplay Robin 101 Tempered Glass Casing is a gaming desktop PC case with a tempered glass side panel and an LED strip front panel. It comes in black, pink, and white.', 3, 'Inplay Robin 101 Tempered Case Inplay Robin 101 Tempered Case.jpg', 'PC Case'),
('Asus Tuf GT301', 4999.00, 'The ASUS TUF Gaming GT301 is a compact, mid-tower ATX case for gaming. It has a perforated honeycomb front panel and tempered glass side panel, and comes with three 120 mm Aura Sync addressable RGB fans and one 120 mm rear fan. The case also has space for 280/360 mm water-cooling radiators in the front and 120 mm at the rear.', 5, 'Asus Tuf GT301 Asus Tuf GT301.jpg', 'PC Case'),
('T Force Delta 3200MHz RGB', 5195.00, 'The heat spreader is built with lighter, thinner and high quality metal material. The colorful light changes make the hollow “R” on the front even more stereoscopic, and echo the ultra wide angle luminous area. The extraordinary Revolution will provide players a new experience never seen before.', 30, 'T Force Delta 3200MHz RGB T Force Delta 3200MHz RGB.jpg', 'RAM'),
('Kingbank 8GB 3200MHz DDR4', 1080.00, 'High Memory Frequency: With a memory frequency of 3200 MHz, this RAM can handle heavy workloads and multitasking with ease. Suitable for Intel Platform Desktop Computer: This RAM is specifically designed to work with Intel platform desktop computers, ensuring optimal performance.', 30, 'Kingbank 8GB 3200MHz DDR4 Kingbank 8GB 3200MHz DDR4.jpg', 'RAM'),
('Adata Spectrix RGB 3200MHz', 1499.00, 'The Adata XPG Spectrix D50 is a 16 GB DDR4 RGB memory module with a 3200 MHz clock speed. It has a stylish white design and dynamic RGB lighting. The D50 is made with high-quality chips and PCBs, and it supports the latest Intel and AMD platforms.', 36, 'Adata Spectrix RGB 3200MHz Adata Spectrix RGB 3200MHz.jpg', 'RAM'),
('G.Skill Ripjaws V', 2590.00, 'The G.Skill Ripjaws V is a DDR4 memory series designed for performance and aesthetics. It\'s suitable for building a new PC or upgrading system memory, and is ideal for gaming, video and image editing, rendering, and data processing. The Ripjaws V is available in a wide range of frequency options, from DDR4-2133MHz to DDR4-4000MHz.', 24, 'G.Skill Ripjaws V G.Skill Ripjaws V.jpg', 'RAM'),
('G.Skill Trident Z Neo 3600MHz', 3865.00, 'The G.Skill Trident Z Neo is a DDR4 memory designed for AMD Ryzen 3000 and X570 Series platforms. It has a 3600 MHz memory speed, 288 pins, and a CAS Latency CL18 (18-22-22-42) at 1.35V. The Trident Z Neo has a dual-toned heatspreader with black brushed aluminum and powder-coated silver, a beveled edge, and a tri-fin design. It also has Trident Z Neo RGB heatsinks to keep the RAM cool.', 15, 'G.Skill Trident Z Neo 3600MHz G.Skill Trident Z Neo 3600MHz.jpg', 'RAM'),
('3200MHz Kimtigo Wolfrine DDR4', 1300.00, 'The Kimtigo Wolfrine DDR4 3200MHz is a high-performance memory module designed for demanding applications like gaming and content creation. It has a clock speed of 3200MHz, which means it can perform 3.2 billion clock cycles per second.', 50, '3200MHz Kimtigo Wolfrine DDR4 3200MHz Kimtigo Wolfrine DDR4.jpg', 'RAM'),
('Corsair Vengeance RGB Pro 16GB DDR4 3600', 2765.00, 'Custom Performance PCB: Provides the highest signal quality for the greatest level of performance and stability. Tightly Screened Memory: Carefully screened ICs for extended overclocking potential. Maximum Bandwidth and Tight Response Times: Optimised for peak performance on the latest Intel and AMD DDR4 motherboards.', 20, 'Corsair Vengeance RGB Pro 16GB DDR4 3600.jpg', 'RAM'),
('PowerSpec 750W Power Supply Semi Modular 80 Plus Bronze Certified', 12970.00, 'Semi-modular 750W PSU with continuous power supply. Active PFC design with single +12V output rail providing strong and stable power to computers. 80 PLUS Bronze certified with 85% efficiency or higher and very stable voltage output', 4, 'PowerSpec 750W Power Supply Semi Modular 80 Plus Bronze Certified.jpg', 'PSU'),
('Keytech 450 Watts 80+ Bronze', 1229.00, 'The Keytech 450 Watts 80+ Bronze is an ATX power supply with 80 Plus Bronze certification. It has a universal input from 150-264v and features premium components, low noise, and protection against short-circuit, over-current, over-voltage, over-power, under-voltage, and lightning. It also has an auto thermally controlled 120mm fan.', 10, 'Keytech 450 Watts 80 Bronze Keytech 450 Watts 80 Bronze.jpg', 'PSU'),
('500 Watts ES-Gaming PSU 80+ Bronze', 1350.00, 'The ES-Gaming 500W RGB 80+ Bronze is a computer power supply that has 500 watts of power and 80+ Bronze certification', 6, '500 Watts ES-Gaming PSU 80+ Bronze 500 Watts ES-Gaming PSU 80+ Bronze.jpg', 'PSU'),
('FSP - HV Pro 650W 80+ Bronze', 2580.00, 'With an 230V 80 Plus™ rating, both models deliver over 85% high efficiency and low noise levels thanks to its thermal control fan design, where a large 120mm fan takes care of cooling duties when required, making it excellent for situations that are sensitive to size and noise.', 9, 'FSP - HV Pro 650W 80+ Bronze FSP - HV Pro 650W 80+ Bronze.jpg', 'PSU'),
('PSU 550 Watts 80+ Bronze Aerocool', 2675.00, 'The AeroCool Lux 550W 80 Plus Bronze Power Supply is a component designed to provide reliable power to your computer system. With an 80 Plus Bronze certification, it indicates that the power supply is efficient, capable of delivering power while minimizing energy waste.', 5, 'PSU 550 Watts 80+ Bronze Aerocool PSU 550 Watts 80+ Bronze Arocool.jpg', 'PSU'),
('Corsair CV650 ATX 80+ Bronze', 3280.00, 'CORSAIR CV power supplies are ideal for powering your new home or office PC, with 80 PLUS Bronze efficiency guaranteed to continuously deliver full wattage to your system. A 120mm thermally controlled cooling fan keeps fan noise to a minimum, while a compact casing makes for an easy fit into nearly any modern PC case.', 3, 'PSU 550 Watts 80+ Bronze Aerocool PSU 550 Watts 80+ Bronze Arocool.jpg', 'PSU'),
('Jonsbo CR1400 aRGB White', 728.00, 'The Jonsbo CR-1400 EVO ARGB CPU Air Cooler in white offers superior cooling performance with a stylish touch. Its advanced ARGB lighting illuminates your setup, while the efficient design ensures optimal CPU temperature. Perfect for gamers and enthusiasts seeking both performance and aesthetics in their PC builds.', 33, 'Jonsbo CR1400 aRGB White Jonsbo CR1400 aRGB White.jpg', 'Fans'),
('Dark Flash Twister 240mm v2 Liquid CPU Cooler', 3750.00, 'The DarkFlash Twister DX-240 V2 is a 240 mm all-in-one (AIO) liquid CPU cooler with a 120 mm PWM cooling fan and ARGB LED synchronization. It has a fan size of 120 x 120 x 25 mm, a fan speed of 800–1800 rpm, and an airflow of 51 CFM ±10%. The cooler also has a water block size of 75 x 75 x 53 mm, a pump speed of 2400+10% RPM, a pump voltage of 12V, and a 4-pin connector. The cooler is made of aluminum and measures 275 x 120 x 27 mm.', 20, 'Dark Flash Twister 240mm v2 Liquid CPU Cooler Dark Flash Twister 240mm v2 Liquid CPU Cooler.jpg', 'Fans'),
('Inplay Ice Tower Kit Fan', 638.00, 'The InPlay Ice Tower Kit is a 3-in-1 kit chassis fan that includes three RGB fans, a remote, and a hub. The fans are 120 mm in size, have a voltage of 12 V, a rated speed of 1200 RPM, and an airflow of 41 CFM. The kit also has a remote control switch, bright LED effects, and a guide fan leaf design to reduce wind noise', 40, 'Inplay Ice Tower Kit Fan Inplay Ice Tower Kit Fan.jpg', 'Fans'),
('Asus Tuf LC 240 RGB AIO', 6619.00, 'TUF Gaming LC ARGB is a series of durable liquid CPU coolers that deliver the performance and features needed to bring out the best in mid-sized gaming builds. Adding style to power, each cooler includes Aura Sync-enabled ARGB elements illuminating the radiator fans and the pump cover''s TUF Gaming logo.', 8, 'Asus Tuf LC 240 RGB AIO Asus Tuf LC 240 RGB AIO.jpg', 'Fans'),
('Deepcool Digital AK500S', 2300.00, 'The DeepCool AK500S Digital is a CPU cooler with a high-performance FDB fan, five heat pipes, and a black matrix fin design. It''s a successor to the DeepCool AK500 and is designed for mainstream systems that need good price-performance ratio in a compact size.', 16, 'Deepcool Digital AK500S Deepcool Digital AK500S.jpg', 'Fans'),
('24 inch 165Hz Viewplus Curve Frameless 1ms', 5680.00, 'The Viewplus MX-24CH is a 23.6 in curved gaming monitor with a 165 Hz refresh rate, 1 ms response time, and 1920 x 1080 resolution. It has a VA panel, 1500R curve, 1000:1 contrast ratio, and 16.7 million display colors. The monitor also has DP and HDMI inputs, and an audio out speaker', 5, '24 inch 165Hz Viewplus Curve Frameless 1ms 24 165Hz Viewplus Curve Frameless 1ms.jpg', 'Monitor'),
('Gamdias Atlas HDW7H 240Hz Curved Gaming Monitor', 10060.00, 'Immerse in gaming excellence with the Gamdias Atlas HD27H 27" 240Hz VA Curved Gaming Monitor. Experience smooth visuals and vibrant colors on the curved display. Elevate your gameplay with high refresh rates and a stunning visual experience.', 4, 'Gamdias Atlas HDW7H 240Hz Curved Gaming Monitor Gamdias Atlas HDW7H 240Hz Curved Gaming Monitor.jpg', 'Monitor'),
('AGON AOC 49 inch 5120 x 1440 165Hz Curved Gaming Monitor AG493UCX AGON 49 Premium Gaming Monitor', 51750.00, 'This 49" Class curved monitor offers up an astounding 5120x1440 resolution that is an equivalent of having 2x 27" Qhd monitors side-by-side, without Borders in between. offering you a true immersive gaming experience, The AG493UCX delivers fast response time of 1ms (MPRT) and up to 120Hz refresh rate', 2, 'AGON AOC 49 inch 5120 x 1440 165Hz Curved Gaming Monitor AG493UCX AGON 49 Premium Gaming Monitor.jpg', 'Monitor'),
('ViewSonic VX2476-SMHD 24″ Full HD Frameless Monitor', 5495.00, 'With SuperClear® AH-IPS Panel technology, this monitor offers best-in-class screen performance with ultra-wide viewing angles. Vivid 1920x1080 resolution and dual speakers, combined with a sleek edge to edge frameless design, deliver an immersive viewing experience for home entertainment and multimedia applications.', 4, 'ViewSonic VX2476-SMHD 24″ Full HD Frameless Monitor.jpg', 'Monitor'),
('AOC 144Hz 24 inch Frameless Full HDAOC 144Hz 24 Frameless Full HD', 7200.00, 'The AOC 24G2 is a 24-inch, 144Hz, frameless gaming monitor with a 1920 x 1080 Full HD (1080P) resolution IPS panel. It has a 1ms response time, AMD FreeSync Premium, and a 3-sided frameless design for wide viewing angles and vibrant colors. The monitor also has a height-adjustable stand, AOC Low Blue mode, and flicker reduction to help with extended gaming sessions. It comes with one DisplayPort, two HDMI 1.4 inputs, and one VGA input, and includes one HDMI and one DP cable.', 4, 'AOC 144Hz 24 inch Frameless Full HDAOC 144Hz 24 Frameless Full HD.jpg', 'Monitor'),
('Gigabyte 165Hz Curve 31.5 G32QC', 21340.03, 'The Gigabyte G32QC is a 31.5 in curved gaming monitor with a 165 Hz refresh rate, 1 ms response time, and a 1500R VA panel. It has a QHD resolution of 2560 x 1440, 93% DCI-P3 color gamut, and AMD FreeSync Premium Pro for smooth gameplay.', 3, 'Gigabyte 165Hz Curved 31.5 G32QC Gigabyte 165Hz Curved 31.5 G32QC.jpg', 'Monitor'),
('256GB M.2 NVMe SSD Adata', 3199.00, 'The Adata 256GB Legend 710 PCIe Gen3 x4 M.2 2280 SSD is a solid-state drive with a 256 GB capacity, PCIe Gen3 x4 interface, and NVMe 1.4 support. It has a heat sink to keep temperatures down by 15% for better performance and stability, and also supports LDPC and AES 256-bit encryption', 20, '256GB M.2 NVMe SSD Adata 256GB M.2 NVMe SSD Adata (1).jpg', 'Storage'),
('1TB Seagate Barracuda Green', 1000.00, 'The Seagate Barracuda Green 1TB is a hard disk drive with a 1TB capacity, 32MB cache, and 5900 RPM speed. It has a SATA 6 Gb/s interface and uses Seagate SmartAlign technology to provide the benefits of the Advanced Format 4K sector standard. The drive is designed to be eco-friendly and has low power consumption', 60, '1TB Seagate Barracuda Green 1TB Seagate Barracuda Green.jpg', 'Storage'),
('Kingbank 120GB 2.5" SSD', 900.00, 'The KingBank 120GB 2.5" SSD is a high-performance solid state drive (SSD) that can be used to upgrade a computer''s storage. It has a 2.5-inch SATA3 form factor, which is compatible with most systems and can fit into laptops and desktops. The SSD has a 7 mm metal case, is shock-proof, and is designed to be durable and reliable. It has a maximum read speed of 550 MB/s and a maximum write speed of 500 MB/s.', 43, 'Kingbank 120GB 2.5 SSD Kingbank 120GB 2.5 SSD.jpg', 'Storage'),
('512GB Hikvision SSD', 3990.00, 'The Hikvision 512GB SSD is a 2.5-inch solid state drive (SSD) with a SATA 6Gb/S interface and a read speed of up to 550 MB/s. It has a 512 GB digital storage capacity and measures 3.95 x 2.75 x 0.28 inches', 12, '512GB Hikvision SSD 512GB Hikvision SSD.jpg', 'Storage'),
('ETOPSO 512GB E500 SATA3 2.5 Inch SSD', 1270.00, 'The Etopso 512GB E500 SATA3 2.5 Inch SSD is a 2.5 inch internal solid-state drive (SSD) with a SATA 3.0 interface and 512 GB of capacity. It has a 6 Gb/s interface rate and measures 100 x 70 x 10 mm', 28, 'ETOPSO 512GB E500 SATA3 2.5 Inch SSD.jpg', 'Storage'),
('Samsung 500GB NVMe SSD', 3150.00, 'Samsung offers multiple 500 GB NVMe SSDs, including the 970 EVO Plus, 970 EVO, and 980. NVMe stands for Non-Volatile Memory Express, a protocol that connects SSDs to CPUs or servers using the PCI Express (PCIe) bus', 8, 'Samsung 500GB NVMe SSD Samsung 500GB NVMe SSD.jpg', 'Storage'),
('Kingston NV1 NVMe PCIe 500GB', 2500.00, 'Kingston''s NV1 NVMe PCIe SSD is a substantial storage solution that offers read/write¹ speeds of up to 2,100/1,700MB/s, which is 3 to 4 times faster than a SATA-based SSD, and 35 times faster than a traditional hard drive', 18, 'Kingston NV1 NVMe PCIe 500GB Kingston NV1 NVMe PCIe 500GB.jpg', 'Storage'),
('Toshiba 1TB 7200RPM HDD', 2799.00, 'The Toshiba 1TB Desktop 7200rpm Internal Hard Drive is a reliable, high-performance hard drive that''s ideal for challenging applications like photo and video editing, and gaming. It has a 64 MB buffer and data protection technology, and can operate in temperatures ranging from 0–65°C and -40–70°C.', 9, 'Toshiba 1TB 7200RPM HDD Toshiba 1TB 7200RPM HDD.jpg', 'Storage');




CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    delivery_address VARCHAR(255) NOT NULL,
    order_date DATE NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL
);


CREATE TABLE cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE cart_items ADD COLUMN client_id INT;


CREATE TABLE order_list (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    product_name VARCHAR(255),
    address VARCHAR(255),
    phone VARCHAR(20),
    date_ordered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payment_status VARCHAR(20),
    total DECIMAL(10, 2),
    payment_method VARCHAR(50),
    order_status VARCHAR(50),
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE order_list
ADD client_id INT NOT NULL;



CREATE TABLE system_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    about_us TEXT,
    logo VARCHAR(255),
    contacts TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO system_info (about_us, logo, contacts)
VALUES (

    'At Nivek PC Repair, we understand the importance of staying connected in today\'s fast-paced world. Whether you\'re a gamer, a professional, or a casual user, we\'ve got you covered with the latest laptops, desktops, peripherals, and accessories. Our mission is to simplify your shopping experience by offering intuitive navigation, detailed product descriptions, and secure payment options. With our user-friendly interface, you can browse, compare, and purchase with confidence. Customer satisfaction is our top priority, and our dedicated support team is always here to assist you every step of the way. Whether you have questions about a product or need help with an order, we\'re just a click away.',
    'logo.png',
    '826 Don Soriano Ave. Balayhangin Calauan Laguna, Calauan, Philippines, kevin.barias28@gmail.com, 0945 973 1833, Monday to Saturday 9:00 am to 6:00 pm'
);



UPDATE system_info
SET contacts = '{
    "map": "826 Don Soriano Ave. Balayhangin Calauan Laguna, Calauan, Philippines",
    "envelope": "kevin.barias28@gmail.com",
    "phone": "0945 973 1833",
    "clock": "Monday to Saturday 9:00 am to 6:00 pm"
}'
WHERE id = 1;


CREATE TABLE feature_products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    product_price DECIMAL(10,2) NOT NULL,
    description TEXT NOT NULL,
    stock INT NOT NULL,
    product_img VARCHAR(255) NOT NULL
);

INSERT INTO feature_products (product_name, product_price, description, stock, product_img) 
VALUES 
('NVIDIA RTX 2060', 1300.00, 'Powered by GeForce® RTX 2060 SUPER™ Integrated with 8GB GDDR6 256-bit memory interface WINDFORCE 3X Cooling System with alternate spinning fans 4 Copper Heat Pipes direct touch GPU RGB Fusion 2.0 – synchronize with other AORUS devices Metal Back Plate', 10, 'NVIDIA RTX 2060.png'),

('MSI A520m Pro AMD', 3593.00, 'The MSI A520M Pro AM4 DDR4 Micro-ATX Gaming Motherboard offers reliable performance. Perfect for budget gaming setups, it supports DDR4 memory and AMD AM4 processors. Upgrade for efficient multitasking, stable gaming, and a compact build. Ideal for users seeking a cost-effective and functional gaming motherboard.', 10, 'MSI A520m Pro AMD.jpg'),

('AORUS LIQUID COOLER 280', 7500.00, 'New high performance pump efficiently dissipates heat from high end CPUs. Unique 60*60mm circular full color LCD with dynamic AORUS logo display designs and custom a picture and text available. High performance, low-noise level, dual ball bearing ARGB fans.', 10, 'AORUS LIQUID COOLER 280.png'),

('silverstone 700w', 3133.00, 'Silverstone offers a 700W ATX power supply called the SST-ST70F-ES230, which is 80 PLUS certified and designed for workstations and gaming rigs', 10, 'ST70F-ES230.jpg'),

('AMD Ryzen 3 3200G', 8935.00, 'The AMD Ryzen 3 3200G is a quad-core desktop processor with four threads, a base clock speed of 3.6 GHz, and a max boost clock speed of 4.0 GHz. It was released in July 2019 and is part of the Ryzen 3 lineup, which is marketed towards the low-end performance market.', 10, 'AMD Ryzen 3 3200G.jpg'),

('HyperX Cloud Stinger', 4300.00, 'HyperX Cloud Stinger™ is the ideal headset for gamers looking for lightweight comfort, superior sound quality and added convenience. At just 275 grams, it''s comfortable on your neck and its ear cups rotate in a 90-degree angle for a better fit', 10, 'HyperX Cloud Stinger.jpg'),

('256GB M.2 NVMe SSD Adata', 3199.00, 'Ultra-fast PCIe Gen3x4 interface: Capacity Model Number EAN Code R/W speed up to 3500/3000MB/s 256GB ASX8200PNP-256GT-C 4713218469441 3D NAND Flash for higher capacity and durability 1TB ASX8200PNP-1TT-C 4713218469465 Compact M.2 2280 form factor – ideal for gaming and high-end desktops', 10, '256GB M.2 NVMe SSD Adata 256GB M.2 NVMe SSD Adata.jpg'),

('Logitech G304 Lightspeed Wireless Gaming Mouse', 2000.00, 'G304 is a LIGHTSPEED wireless gaming mouse designed for serious performance with latest technology innovations at an affordable price point. HERO sensor is the next-gen optical gaming sensor from Logitech G that accomplishes both incredible performance and unprecedented efficiency. Because, in wireless gaming, there can be no compromises. Program DPI from 200 - 12,000 and save up to 5 profiles on the onboard memory.', 10, 'Logitech G304 Lightspeed Wireless Gaming Mouse.jpg');


CREATE TABLE new_arrivals (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    product_price DECIMAL(10,2) NOT NULL,
    description TEXT NOT NULL,
    stock INT NOT NULL,
    product_img VARCHAR(255) NOT NULL
);

INSERT INTO new_arrivals (product_name, product_price, description, stock, product_img) 
VALUES 
('Nvidia GeForce RTX 3080', 40066.00, 'The GeForce RTX® 3080 Ti and RTX 3080 graphics cards deliver the performance that gamers crave, powered by Ampere—NVIDIA’s 2nd gen RTX architecture. They are built with dedicated 2nd gen RT Cores and 3rd gen Tensor Cores, streaming multiprocessors, and G6X memory for an amazing gaming experience.', 10, 'Nvidia GeForce RTX 3080.jpg'),

('AMD Ryzen 7 7700X', 15455.00, 'This dominant gaming processor can deliver fast 100+ FPS performance in the world''s most popular games, 8 Cores and 16 processing threads, based on AMD "Zen 4" architecture. 5.4 GHz Max Boost, unlocked for overclocking, 80 MB cache, DDR5-5200 support', 10, 'AMD Ryzen 7 7700X.jpg'),

('Corsair Vengeance RGB Pro DDR4', 5800.00, 'VENGEANCE RGB PRO Series performance PCB is custom designed and extensively tested to provide absolutely zero compromise between style and speed. Optimized for high-frequency performance on the latest Intel® and AMD DDR4 motherboards, each module is built using carefully screened ICs for extended overclocking potential.', 10, 'Corsair Vengeance RGB Pro DDR4.jpg'),

('CiT Pro Diamond XR Mid Tower Gaming Case - White', 5540.00, 'The CiT Pro Diamond XR combines the smart, sharp aesthetics of the Tempered Glass Front and Side Panels to showcase your build with the striking and extremely functional full-on Hex-Mesh Design. The Diamond XR''s open design gives you a multitude of options to match your building desire.', 10, 'CiT Pro Diamond XR Mid Tower Gaming Case - White.jpg'),

('Be Quiet! System Power 10 850W 80+ Gold PSU', 7058.00, 'System Power 10 850W even offers an 80 PLUS Gold efficiency, a true testament to quality in this price level. System Power 10‘s combination of power and quietness for a PSU of its class and efficiency is far beyond ordinary, making it possible for you to build cost-effective and reliable systems.', 10, 'Be Quiet! System Power 10 850W 80+ Gold PSU.jpg'),

('ASUS ROG Pugio Optical Gaming Mouse', 3900.00, 'The ASUS ROG Pugio is an ambidextrous, wired, optical gaming mouse with customizable side buttons, RGB lighting, and advanced optical sensors. It has a gaming-grade optical sensor with 7200 DPI, 150 IPS, and 30g acceleration. The mouse also has a DPI switch and indicator, and an ROG Armoury interface for customizing buttons, surface calibration, performance, and more.', 10, 'ASUS ROG Pugio Optical Gaming Mouse.png'),

('ASUS ROG Delta S Lightweight USB-C Gaming Headset', 9000.00, 'Lightweight USB-C gaming headset with AI noise-canceling mic, MQA rendering technology, Hi-Res ESS 9281 QUAD DAC, RGB lighting ASUS AI Noise-Canceling Microphone offers crystal-clear in-game voice communication, Customizable, multi-color RGB lighting and unique Soundwave Light mode let you shine in style.', 10, 'ASUS ROG Delta S Lightweight USB-C Gaming Headset.png'),

('Razer BlackWidow V4 Pro Mechanical Gaming Keyboard', 12895.00, 'The Razer BlackWidow V4 Pro gaming keyboard has tactile, clicky Green switches, customizable Chroma RGB lighting, programmable macros, and a magnetic wrist rest for superior comfort during intense gaming marathons.', 10, 'Razer BlackWidow V4 Pro Mechanical Gaming Keyboard.jpg');

