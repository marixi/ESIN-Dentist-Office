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



SELECT * FROM person;