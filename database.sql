CREATE DATABASE IF NOT EXISTS dapur_razka;
USE dapur_razka;

CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_menu VARCHAR(100) NOT NULL,
    kategori VARCHAR(30) NOT NULL,
    harga INT NOT NULL,
    deskripsi TEXT NOT NULL,
    gambar VARCHAR(255) NOT NULL
);

INSERT INTO menu (nama_menu, kategori, harga, deskripsi, gambar) VALUES
('Nasi Timbel Komplit', 'Makanan', 25000, 'Nasi timbel dengan ayam goreng, tahu, tempe, lalapan, dan sambal terasi.', 'nasi-timbel-komplit.jpg'),
('Nasi Liwet Sunda', 'Makanan', 22000, 'Nasi liwet gurih dengan ikan asin, tempe goreng, dan lalapan segar.', 'nasi-liwet-sunda.jpg'),
('Ayam Goreng Kampung', 'Makanan', 20000, 'Ayam kampung goreng bumbu kuning, disajikan dengan sambal dan lalapan.', 'ayam-goreng-kampung.jpg'),
('Ikan Mas Goreng', 'Makanan', 22000, 'Ikan mas goreng renyah dengan sambal dadak.', 'ikan-mas-goreng.jpg'),
('Pepes Ikan Mas', 'Makanan', 24000, 'Ikan mas berbumbu rempah dibungkus daun pisang lalu dikukus.', 'pepes-ikan-mas.jpg'),
('Gepuk Sapi', 'Makanan', 28000, 'Daging sapi empuk yang digeprek dengan bumbu manis gurih.', 'gepuk-sapi.jpg'),
('Sayur Asem', 'Makanan', 10000, 'Sayur asem segar dengan jagung, labu siam, dan kacang tanah.', 'sayur-asem.jpg'),
('Soto Bandung', 'Makanan', 20000, 'Soto bening berisi daging sapi dan lobak, ditaburi kacang kedelai goreng.', 'soto-bandung.jpg'),
('Karedok', 'Makanan', 15000, 'Sayuran mentah segar dengan bumbu kacang khas Sunda.', 'karedok.jpg'),
('Mie Kocok Bandung', 'Makanan', 20000, 'Mie kuah kaldu sapi dengan kikil, taoge, dan bawang goreng.', 'mie-kocok-bandung.jpg'),
('Batagor Bandung', 'Makanan', 18000, 'Ikan dan tahu goreng disiram bumbu kacang dan kecap.', 'batagor-bandung.jpg'),
('Tempe Mendoan', 'Makanan', 8000, 'Tempe tepung setengah matang, hangat dan gurih.', 'tempe-mendoan.jpg'),
('Es Teh Manis', 'Minuman', 5000, 'Teh seduh dingin dengan gula pas, menyegarkan.', 'es-teh-manis.jpg'),
('Es Jeruk', 'Minuman', 8000, 'Perasan jeruk segar dengan es batu.', 'es-jeruk.jpg'),
('Jus Alpukat', 'Minuman', 12000, 'Jus alpukat kental dengan susu coklat.', 'jus-alpukat.jpg'),
('Jus Mangga', 'Minuman', 12000, 'Jus mangga manis yang segar dan dingin.', 'jus-mangga.jpg'),
('Jus Jeruk', 'Minuman', 10000, 'Jus jeruk peras asli tanpa pengawet.', 'jus-jeruk.jpg'),
('Es Cendol', 'Minuman', 10000, 'Cendol hijau, santan, dan gula merah cair.', 'es-cendol.jpg'),
('Kue Balok Original', 'Kue', 8000, 'Kue balok panggang renyah di luar, lembut di dalam.', 'kue-balok-original.jpg'),
('Kue Balok Coklat Keju', 'Kue', 10000, 'Kue balok hangat dengan isian coklat dan keju leleh.', 'kue-balok-coklat-keju.jpg');
