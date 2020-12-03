/*SELECT app_id
FROM appointment JOIN person ON dentist_id = person.id
WHERE username = 'miguel.paredes' AND password = 'mgpmed20'*/
/*
SELECT * FROM appointment
JOIN person ON client_id=person.id
WHERE dentist_id = 1
ORDER BY app_id DESC*/

SELECT * FROM auxiliariesAssigned
JOIN appointment ON appointment_id=app_id
JOIN person ON auxiliary_id=person.id
WHERE username = 'ricardo.brioso' AND password = 'ricardo4Work'