CREATE TABLE Kanal(
	idKanal varchar(25) PRIMARY KEY,
	nama varchar(25),
	isGroup INT,
	pass INT,
	gambar varchar(50),
	link varchar(50),
	dscp varchar(100)
);

CREATE TABLE Pengguna(
	email varchar(30) PRIMARY KEY,
	idKanalPribadi varchar(25),
    FOREIGN KEY (idKanalPribadi) REFERENCES Kanal(idKanal)
);

CREATE TABLE Subscription(
	idKanal1 varchar(25),
    FOREIGN KEY (idKanal1)REFERENCES Kanal(idKanal),
	idKanal2 varchar(25),
    FOREIGN KEY (idKanal1) REFERENCES Kanal(idKanal)
);

CREATE TABLE Posisi(
	accessGroup INT PRIMARY KEY,
	gelar varchar(15)
);

CREATE TABLE PosisiPenggunaGroup(
	email varchar(30),
    FOREIGN KEY (email) REFERENCES Pengguna (email),
	idKanal varchar(25),
    FOREIGN KEY (idKanal) REFERENCES Kanal(idKanal),
	accessGroup INT,
    FOREIGN KEY (accessGroup) REFERENCES Posisi(accessGroup),
	statusUndangan INT,
	PRIMARY KEY (email,idKanal)
);

CREATE TABLE Video (
    idVideo varchar(50) PRIMARY KEY,
    dscp varchar(500),
    judul varchar(30),
    waktu datetime,
	isPublished INT,
	uploader varchar(30),
    FOREIGN KEY (uploader) REFERENCES Pengguna(email),
	loc varchar(25),
    FOREIGN KEY (loc) REFERENCES Kanal(idKanal),
	thumbnail varchar(50)
);

CREATE TABLE Caption (
    idPengunggah varchar(30),
    FOREIGN KEY (idPengunggah) REFERENCES Pengguna(email),
	idVideo varchar(50),
    FOREIGN KEY (idVideo) REFERENCES Video(idVideo),
	subtitle varchar(50),
	waktu INT
);
CREATE TABLE Tonton (
	idPenonton varchar(25),
    FOREIGN KEY (idPenonton) REFERENCES Kanal(idKanal),
	idVideo varchar(50),
    FOREIGN KEY (idVideo) REFERENCES Video(idVideo),
	likes INT,
	duration INT,
	PRIMARY KEY (idPenonton, idVideo)
);
CREATE TABLE Thread(
	idVideo varchar(50),
    FOREIGN KEY (idVideo)REFERENCES Video(idVideo),
	number INT,
	PRIMARY KEY (idVideo, number)
);
CREATE TABLE Komentar(
	idVideo varchar(50),
	threadNumber INT,
	FOREIGN KEY (idVideo, threadNumber) REFERENCES Thread(idVideo,number),
	Waktu datetime,
	uploader varchar(25),
    FOREIGN KEY (uploader) REFERENCES Kanal(idKanal),
	msg varchar(200),
	PRIMARY KEY (idVideo, threadNumber, Waktu, uploader)
);



--Data Dummy

-- Data untuk Tabel Kanal
INSERT INTO Kanal VALUES 
('K001', 'ChannelA', 0, 0, 'gambar1.jpg', 'link1.com', 'Deskripsi A'),
('K002', 'ChannelB', 0, 0, 'gambar2.jpg', 'link2.com', 'Deskripsi B'),
('K003', 'ChannelC', 1, 1234, 'gambar3.jpg', 'link3.com', 'Group C');

-- Data untuk Tabel Pengguna
INSERT INTO Pengguna VALUES 
('userA@example.com', 'K001'),
('userB@example.com', 'K002'),
('userC@example.com', 'K003');

-- Data untuk Tabel Subscription (misalnya channel A subscribe ke channel B dan C)
INSERT INTO Subscription VALUES 
('K001', 'K002'),
('K001', 'K003'),
('K002', 'K003');

-- Data untuk Tabel Posisi
INSERT INTO Posisi VALUES 
(1, 'Admin'),
(2, 'Editor'),
(3, 'Member');

-- Data untuk Tabel PosisiPenggunaGroup (userA dan userB gabung ke ChannelC)
INSERT INTO PosisiPenggunaGroup VALUES 
('userA@example.com', 'K003', 1, 1),
('userB@example.com', 'K003', 2, 1);

-- Data untuk Tabel Video (userA unggah video ke ChannelA)
INSERT INTO Video VALUES 
('/Eric/Video/video.html', 'Deskripsi video pertama', 'Judul Video A', '2025-	06-01 10:00:00', 1, 'userA@example.com', 'K001', null);
