-- M5.4.1
CREATE VIEW view_suppengerichte AS
    SELECT * FROM gericht
    WHERE name LIKE '%suppe%';
-- M5.4.2
CREATE VIEW view_anmeldungen AS
    SELECT * FROM benutzer
    ORDER BY anzahlanmeldungen DESC ;
-- M5.4.3
CREATE VIEW view_kategoriegerichte_vegetarisch AS
    SELECT k.name AS Kategorie, g.name AS Gerichtname
    FROM kategorie k
    LEFT JOIN gericht_hat_kategorie ghk on k.id = ghk.kategorie_id
    LEFT JOIN gericht g on ghk.gericht_id = g.id
    WHERE g.vegetarisch = true;
-- M5.4.
CREATE VIEW view_kategoriegerichte_vegetarisch AS
SELECT DISTINCT k.name AS Kategorie,
                CASE
                    WHEN g.vegetarisch = true THEN g.name
                    END AS Gerichtname
FROM kategorie k
         LEFT JOIN gericht_hat_kategorie ghk on k.id = ghk.kategorie_id
         LEFT JOIN gericht g on ghk.gericht_id = g.id;