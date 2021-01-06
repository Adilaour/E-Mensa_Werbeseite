-- M5.4.1   | Erstellen von Views
CREATE VIEW view_suppengerichte AS
    SELECT * FROM gericht
    WHERE name LIKE '%suppe%';
-- M5.4.2
CREATE VIEW view_anmeldungen AS
    SELECT * FROM benutzer
    ORDER BY anzahlanmeldungen DESC ;
-- M5.4.3
CREATE VIEW view_kategoriegerichte_vegetarisch AS
SELECT kategorie.name AS Kategorie,  gericht.name AS Gericht
FROM kategorie LEFT JOIN gericht INNER JOIN gericht_hat_kategorie
                                            ON gericht.id = gericht_hat_kategorie.gericht_id
                                            ON  kategorie.id = gericht_hat_kategorie.kategorie_id
WHERE gericht.vegetarisch =1 OR kategorie_id IS null;