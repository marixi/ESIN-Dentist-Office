/*SELECT app_id
FROM appointment JOIN person ON dentist_id = person.id
WHERE username = 'miguel.paredes' AND password = 'mgpmed20'
*/
/*
SELECT * FROM appointment
JOIN person ON client_id=person.id
WHERE dentist_id = 1
ORDER BY app_id DESC
*/
/*
SELECT * FROM auxiliariesAssigned
JOIN appointment ON appointment_id=app_id
JOIN person ON auxiliary_id=person.id
WHERE username = 'ricardo.brioso' AND password = 'ricardo4Work'
*/
/*
SELECT * from person
JOIN dentist USING (id)
WHERE username='raquel.pires';*/
/*
SELECT * FROM record
JOIN appointment ON appointment_id=app_id
JOIN person ON dentist_id=person.id
WHERE username = 'raquel.pires'*/

/*SELECT * FROM appointment
JOIN person ON client_id=person.id
/*JOIN person ON dentist_id=person.id
WHERE dentist.username = 'raquel.pires'
ORDER BY app_id DESC*/
/*
SELECT * FROM appointment
JOIN dentist ON dentist_id=dentist.id
WHERE client_id = 11
ORDER BY app_id ASC;*/

/*SELECT * FROM record WHERE appointment_id = 27;

DELETE FROM servicePerformed
WHERE appointment_id=27;

SELECT * FROM servicePerformed;*/

/*SELECT * FROM appointment
JOIN person ON dentist_id=person.id
WHERE client_id = 11
ORDER BY date DESC;*/

/*INSERT INTO auxiliariesAssigned (appointment_id, auxiliary_id) VALUES (26, 4);
INSERT INTO auxiliariesAssigned (appointment_id, auxiliary_id) VALUES (26, 5);
*//*SELECT * FROM auxiliariesAssigned WHERE appointment_id = 26;
DELETE FROM auxiliariesAssigned WHERE appointment_id = 26;
/*
SELECT * from servicePerformed WHERE appointment_id = 29;
SELECT * from record WHERE appointment_id = 29;
/*
INSERT INTO auxiliariesAssigned (appointment_id, auxiliary_id) VALUES (29, 5);

SELECT * from auxiliariesAssigned WHERE appointment_id = 29;*/

SELECT * FROM auxiliariesAssigned
JOIN appointment ON auxiliariesAssigned.appointment_id=appointment.app_id
JOIN servicePerformed ON servicePerformed.appointment_id=auxiliariesAssigned.appointment_id
WHERE auxiliary_id = 4
