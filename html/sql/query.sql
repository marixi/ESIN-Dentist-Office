SELECT app_id
FROM appointment JOIN person ON dentist_id = person.id
WHERE username = 'miguel.paredes' AND password = 'mgpmed20'