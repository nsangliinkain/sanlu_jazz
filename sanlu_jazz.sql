CREATE DATABASE sanlu_jazz;
USE sanlu_jazz;

-- Utenti
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    ruolo ENUM('spettatore', 'artista', 'admin') NOT NULL
);

-- Luoghi/Locali
CREATE TABLE venues (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_locale VARCHAR(100),
    indirizzo VARCHAR(255),
    capienza INT
);

-- Eventi
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    artista_id INT,
    titolo VARCHAR(100),
    descrizione TEXT,
    data DATE,
    orario TIME,
    luogo VARCHAR(100),
    prezzo DECIMAL(6,2),
    posti_disponibili INT,
    stato ENUM('approvato', 'in_attesa', 'rifiutato') DEFAULT 'in_attesa',
    venue_id INT,
    FOREIGN KEY (artista_id) REFERENCES users(id),
    FOREIGN KEY (venue_id) REFERENCES venues(id)
);

-- Biglietti
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    event_id INT,
    codice VARCHAR(100) UNIQUE,
    data_acquisto DATETIME DEFAULT CURRENT_TIMESTAMP,
    prezzo DECIMAL(6,2),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (event_id) REFERENCES events(id)
);

-- Generi musicali
CREATE TABLE genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50)
);

-- Associazione evento-genere (tabella pivot)
CREATE TABLE event_genre (
    event_id INT,
    genre_id INT,
    PRIMARY KEY (event_id, genre_id),
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE
);

-- Recensioni
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    event_id INT,
    voto TINYINT CHECK (voto BETWEEN 1 AND 5),
    commento TEXT,
    data DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (event_id) REFERENCES events(id)
);

-- (Opzionale) Messaggi
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT,
    receiver_id INT,
    contenuto TEXT,
    data DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id)
);
