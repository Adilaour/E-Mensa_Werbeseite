CREATE TABLE bewertungen(
    		id          		INTEGER PRIMARY KEY AUTO_INCREMENT,
                 wichtig     		BOOLEAN NOT NULL DEFAULT false,
                 bewertungszeitpunkt 	DATETIME DEFAULT CURRENT_TIMESTAMP,
                 sterne      		INTEGER NOT NULL  DEFAULT 0,
                 bemerkung   		VARCHAR(500) NOT NULL DEFAULT 'Keine Bewertung gefunden',
                 benutzer_id 		BIGINT NOT NULL,
                 gericht_id  		INTEGER NOT NULL);

ALTER TABLE bewertungen
    ADD CONSTRAINT benutzer_id_fk FOREIGN KEY (benutzer_id) REFERENCES benutzer(id);

ALTER TABLE bewertungen
    ADD CONSTRAINT gericht_id_fk FOREIGN KEY (gericht_id) REFERENCES gericht(id);