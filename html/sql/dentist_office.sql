-- Dentist Office
-- Authors: Duarte Rodrigues, Mariana Xavier

PRAGMA foreign_keys = ON;

-- Drop Tables --

DROP TABLE IF EXISTS person;
DROP TABLE IF EXISTS client;
DROP TABLE IF EXISTS employee;
DROP TABLE IF EXISTS dentist;
DROP TABLE IF EXISTS dentalAuxiliary;
DROP TABLE IF EXISTS specialty;
DROP TABLE IF EXISTS appointment;
DROP TABLE IF EXISTS auxiliariesAssigned;
DROP TABLE IF EXISTS record;
DROP TABLE IF EXISTS service;
DROP TABLE IF EXISTS insurance;
DROP TABLE IF EXISTS discount;
DROP TABLE IF EXISTS material;
DROP TABLE IF EXISTS quantity;
DROP TABLE IF EXISTS materialManagement;

-- Create Tables --

CREATE TABLE person (
    id integer PRIMARY KEY AUTOINCREMENT,
    name text NOT NULL,
    address text,
    phone_number text NOT NULL, -- e.g. +351935556768
    username text NOT NULL UNIQUE,
    password text NOT NULL
);

CREATE TABLE insurance (
    insurance_code integer PRIMARY KEY
);

CREATE TABLE client (
    id integer PRIMARY KEY REFERENCES person,
    birth_date text NOT NULL, -- format dd-mm-yyyy
    tax_number integer UNIQUE,
    insurance_code integer REFERENCES insurance
);

CREATE TABLE employee (
    id integer PRIMARY KEY REFERENCES person, 
    salary float CHECK(salary > 0),
    date_of_admission text -- format dd-mm-yyyy
);

CREATE TABLE dentist (
    id integer PRIMARY KEY REFERENCES employee
);

CREATE TABLE dentalAuxiliary (
    id integer PRIMARY KEY REFERENCES employee
);

CREATE TABLE specialty (
    type text PRIMARY KEY,
    CHECK(type = "general" OR type = "orthodontics" OR type = "pediatric" OR type = "prosthodontics" OR type = "endodontics")
);

CREATE TABLE appointment (
    app_id integer PRIMARY KEY AUTOINCREMENT,
    date text NOT NULL, -- format dd-mm-yyyy
    time text NOT NULL, -- format 'hh:mm'
    room integer NOT NULL,
    client_id integer NOT NULL REFERENCES client,
    dentist_id integer NOT NULL REFERENCES dentist,
    specialty text NOT NULL REFERENCES specialty,
    price float CHECK (price > 0 OR price IS NULL)
);

CREATE TABLE auxiliariesAssigned (
    appointment_id integer REFERENCES appointment,
    auxiliary_id integer REFERENCES dentalAuxiliary,
    PRIMARY KEY(appointment_id, auxiliary_id)
);

CREATE TABLE record (
    client_id integer REFERENCES client,
    appointment_id integer NOT NULL UNIQUE REFERENCES appointment,
    observations text,
    PRIMARY KEY(client_id, appointment_id)
);

CREATE TABLE service (
    procedure_name text PRIMARY KEY,
    price float NOT NULL CHECK(price > 0),
    specialty_type text NOT NULL REFERENCES specialty
);

CREATE TABLE servicePerformed (
    appointment_id integer REFERENCES appointment,
    procedure text REFERENCES service,
    PRIMARY KEY(appointment_id, procedure)
);

CREATE TABLE discount (
    insurance_code integer REFERENCES insurance,
    service_name text REFERENCES service,
    percentage_discount integer CHECK(percentage_discount >= 0 OR percentage_discount IS NULL),
    PRIMARY KEY(insurance_code, service_name)
);

CREATE TABLE material (
    name text PRIMARY KEY,
    quantity_in_stock integer NOT NULL CHECK(quantity_in_stock >= 0)
);

CREATE TABLE quantity (
    service_name text REFERENCES service,
    material_name text REFERENCES material,
    quantity_needed integer NOT NULL CHECK(quantity_needed > 0),
    PRIMARY KEY(service_name, material_name)
);

-- Insert Data --

INSERT INTO person VALUES (1, 'Raquel Pires', 'Rua Muro Bacalhoeiros 57 4250-124 Porto, Porto', '+351921555422', 'raquel.pires', '164936a34578278d7100d73ccad70f109baf9d43');
INSERT INTO person VALUES (2, 'Miguel Paredes', 'Rua Muro Bacalhoeiros 57 4250-124 Porto, Porto', '+351929255572', 'miguel.paredes', '13cc4966c3969e53fab7cfcd8f28fe1de3e2d034');
INSERT INTO person VALUES (3, 'Joana Fonseca', 'Rua Caminho Cruz 21 4440-689 Valongo, Porto', '+351965559111', 'joana.fonseca', '3dc8a0caf01c4bc5bd996c3ab07dda15f5c9dbb5');
INSERT INTO person VALUES (4, 'Ricardo Brioso', 'Rua Tapada Marinha 77 4455-459 Perafita, Porto', '+351929155587', 'ricardo.brioso', 'b7f7916aaaa1932e5dcf1d7c2f22c244b2103474');
INSERT INTO person VALUES (5, 'Sara Fernandes', 'Rua Nossa Senhora Graça 90 4620-135 Lousada, Porto', '+351921555869', 'sara.fernandes', '500152318a6e2cbcccf587b8baff79c51d99c30b');
INSERT INTO person VALUES (6, 'Lara Guerreiro', 'Rua Heróis Ultramar 94 4640-210 Monte Alegra, Porto', '+351921555935', 'lara.guerreiro', 'a08731c16f2891242eefe02d9317b780ce994a69');
INSERT INTO person VALUES (7, 'Erica Freitas', 'Avenida Júlio Saúl Dias 53 4560-800 Portela, Porto', '+351225555669', 'erica.freitas', '8976ec8184f167b261157b3b06eb2e8d8681b6b5');
INSERT INTO person VALUES (8, 'Clara Tavares', 'Rua Âncora 77 4400-095 Vila Nova de Gaia, Porto', '+351935556768', 'clara.tavares', '6f0d467010fbd96f36699f7cfa85e546e4d2a926');
INSERT INTO person VALUES (9, 'Francisco Amaral', 'Rua Comércio Porto 42 4500-532 Porto, Porto', '+351922555524', 'francisco.amaral', '64c25d1f83fcf90f6a4de4ac13fe43d6625413e6');
INSERT INTO person VALUES (10, 'Andreia Baptista', 'Rua Patrão Caramelho 111 4485-330 Labruge, Porto', '+351915555347', 'andreia.baptista', '1c8d567ba6ae13a5017dadd15ba47fb24d443b2e');
INSERT INTO person VALUES (11, 'Martim Sousa', 'Rua Nossa Senhora Graça 44 4620-226 Sequeiros, Porto', '+351921555346', 'martim.sousa', '85f9c01e17d5f91602e24db4544446883d337c51');
INSERT INTO person VALUES (12, 'Maria Esteves', 'Rua Alegria 39 4580-372 Seixoso, Porto', '+351915557534', 'maria.esteves', '275dad6b2e501ff44c6ce7114ba2f2e53a5f66ec');
INSERT INTO person VALUES (13, 'Pedro Neves', 'Rua Tapada Marinha 49 4455-184 Lavra, Porto', '+351929055523', 'pedro.neves', 'ffed61c52f1a66962e553f6c360fc61b0d35b5f0');
INSERT INTO person VALUES (14, 'Yara Martins', 'Rua Oliveirinhas 58 4420-400 Valbom, Porto', '+351922555434', 'yara.martins', '0bdee421fa92af328db0453548a0dd7a09b0bc53');
INSERT INTO person VALUES (15, 'Miguel Barros', 'Avenida Parque Gondarim 97 4405-796 Vila Nova de Gaia, Porto', '+351921555668', 'miguel.barros', 'f3eea9aa586450bea488effa68e7063b342e5627');
INSERT INTO person VALUES (16, 'Duarte Barros', 'Avenida Parque Gondarim 97 4405-796 Vila Nova de Gaia, Porto', '+351921555668', 'duarte.barros', 'e614c0e7b08a3d4424d290af59f794caf8248c2e');
INSERT INTO person VALUES (17, 'Mariana Ramos', 'Travessa Pindelo do Falcão 84 4425-547 Maia, Porto', '+351921555595', 'mariana.ramos', '82a75ef12ca2179dd4726f93d48ff5c294b0dc6c');

INSERT INTO employee VALUES (1, 6500, '01-01-2020');
INSERT INTO employee VALUES (2, 6500, '01-01-2020');
INSERT INTO employee VALUES (3, 1400, '01-01-2020');
INSERT INTO employee VALUES (4, 1500, '01-01-2020');
INSERT INTO employee VALUES (5, 1000, '01-05-2020');
INSERT INTO employee VALUES (6, 1000, '01-05-2020');
INSERT INTO employee VALUES (7, 1000, '01-08-2020');

INSERT INTO dentist VALUES (1);
INSERT INTO dentist VALUES (2);

INSERT INTO dentalAuxiliary VALUES (3);
INSERT INTO dentalAuxiliary VALUES (4);
INSERT INTO dentalAuxiliary VALUES (5);
INSERT INTO dentalAuxiliary VALUES (6);
INSERT INTO dentalAuxiliary VALUES (7);

INSERT INTO insurance VALUES (123);
INSERT INTO insurance VALUES (456);

INSERT INTO client VALUES (1, '12-10-1994', 235496415, 123);
INSERT INTO client VALUES (2, '16-08-1994', 284659725, 123);
INSERT INTO client VALUES (3, '23-12-1996', 232595456, 123);
INSERT INTO client VALUES (4, '01-01-1999', 252978655, 456);
INSERT INTO client VALUES (5, '07-04-1992', 235481279, NULL);
INSERT INTO client VALUES (8, '15-06-1987', 204996503, 123);
INSERT INTO client VALUES (9, '27-01-1999', 249869900, 456);
INSERT INTO client VALUES (10, '03-12-1995', 232895775, NULL);
INSERT INTO client VALUES (11, '14-07-1982', 278402062, 456);
INSERT INTO client VALUES (12, '08-08-1972', 219225133, NULL);
INSERT INTO client VALUES (13, '31-01-1970', NULL, 456);
INSERT INTO client VALUES (14, '03-02-2007', 226969886, 456);
INSERT INTO client VALUES (15, '05-11-2010', NULL, 123);
INSERT INTO client VALUES (16, '05-11-2010', NULL, 123);
INSERT INTO client VALUES (17, '09-07-1964', 204398754, NULL);

INSERT INTO specialty VALUES ('general');
INSERT INTO specialty VALUES ('orthodontics');
INSERT INTO specialty VALUES ('pediatric');
INSERT INTO specialty VALUES ('prosthodontics');
INSERT INTO specialty VALUES ('endodontics');

INSERT INTO appointment VALUES (1, '03-01-2020', '10:00', 2, 8, 2, 'general', 54);
INSERT INTO appointment VALUES (2, '03-01-2020', '11:00', 1, 9, 1, 'general', 36);
INSERT INTO appointment VALUES (3, '10-01-2020', '11:00', 1, 9, 1, 'orthodontics', 3220);
INSERT INTO appointment VALUES (4, '12-03-2020', '09:00', 1, 9, 1, 'orthodontics', 9);
INSERT INTO appointment VALUES (5, '01-05-2020', '17:00', 2, 10, 2, 'general', 60);
INSERT INTO appointment VALUES (6, '08-05-2020', '09:00', 1, 9, 1, 'orthodontics', 9);
INSERT INTO appointment VALUES (7, '08-05-2020', '14:00', 2, 11, 2, 'prosthodontics', 81);
INSERT INTO appointment VALUES (8, '10-07-2020', '11:00', 1, 9, 1, 'orthodontics', 9);
INSERT INTO appointment VALUES (9, '10-07-2020', '15:00', 1, 12, 1, 'general', 60);
INSERT INTO appointment VALUES (10, '10-07-2020', '15:00', 2, 13, 2, 'general', 48);
INSERT INTO appointment VALUES (11, '12-09-2020', '09:00', 2, 8, 2, 'general', 54);
INSERT INTO appointment VALUES (12, '14-09-2020', '09:00', 1, 14, 1, 'orthodontics', 3500);
INSERT INTO appointment VALUES (13, '15-09-2020', '10:00', 1, 9, 1, 'orthodontics', 9);
INSERT INTO appointment VALUES (14, '15-10-2020', '15:00', 2, 15, 2, 'pediatric', 30);
INSERT INTO appointment VALUES (15, '15-10-2020', '16:00', 2, 16, 2, 'pediatric', 30);
INSERT INTO appointment VALUES (16, '10-11-2020', '11:00', 1, 9, 1, 'orthodontics', 9);
INSERT INTO appointment VALUES (17, '14-11-2020', '09:00', 1, 14, 1, 'orthodontics', 9);
INSERT INTO appointment VALUES (18, '14-11-2020', '11:00', 2, 17, 2, 'endodontics', 800);
INSERT INTO appointment VALUES (19, '24-11-2020', '17:00', 2, 10, 2, 'endodontics', 800);
INSERT INTO appointment VALUES (20, '27-11-2020', '11:00', 2, 12, 2, 'endodontics', 800);
INSERT INTO appointment VALUES (21, '23-12-2020', '15:00', 2, 15, 2, 'pediatric', NULL);
INSERT INTO appointment VALUES (22, '23-12-2020', '16:00', 2, 16, 2, 'pediatric', NULL);
INSERT INTO appointment VALUES (23, '28-12-2020', '14:00', 2, 11, 2, 'prosthodontics', NULL);
INSERT INTO appointment VALUES (24, '12-01-2021', '11:00', 1, 9, 1, 'orthodontics', NULL);
INSERT INTO appointment VALUES (25, '16-01-2021', '09:00', 1, 14, 1, 'orthodontics', NULL);
INSERT INTO appointment VALUES (26, '02-02-2021', '16:00', 2, 10, 2, 'general', NULL);

INSERT INTO auxiliariesAssigned VALUES (1, 4);
INSERT INTO auxiliariesAssigned VALUES (2, 3);
INSERT INTO auxiliariesAssigned VALUES (3, 3);
INSERT INTO auxiliariesAssigned VALUES (3, 4);
INSERT INTO auxiliariesAssigned VALUES (4, 3);
INSERT INTO auxiliariesAssigned VALUES (5, 3);
INSERT INTO auxiliariesAssigned VALUES (6, 4);
INSERT INTO auxiliariesAssigned VALUES (7, 3);
INSERT INTO auxiliariesAssigned VALUES (7, 5);
INSERT INTO auxiliariesAssigned VALUES (8, 4);
INSERT INTO auxiliariesAssigned VALUES (8, 6);
INSERT INTO auxiliariesAssigned VALUES (9, 6);
INSERT INTO auxiliariesAssigned VALUES (10, 5);
INSERT INTO auxiliariesAssigned VALUES (11, 3);
INSERT INTO auxiliariesAssigned VALUES (12, 4);
INSERT INTO auxiliariesAssigned VALUES (13, 5);
INSERT INTO auxiliariesAssigned VALUES (14, 6);
INSERT INTO auxiliariesAssigned VALUES (15, 7);
INSERT INTO auxiliariesAssigned VALUES (16, 3);
INSERT INTO auxiliariesAssigned VALUES (17, 4);
INSERT INTO auxiliariesAssigned VALUES (18, 5);
INSERT INTO auxiliariesAssigned VALUES (19, 6);
INSERT INTO auxiliariesAssigned VALUES (20, 7);
INSERT INTO auxiliariesAssigned VALUES (21, 3);
INSERT INTO auxiliariesAssigned VALUES (22, 4);
INSERT INTO auxiliariesAssigned VALUES (23, 5);
INSERT INTO auxiliariesAssigned VALUES (24, 6);
INSERT INTO auxiliariesAssigned VALUES (25, 7);
INSERT INTO auxiliariesAssigned VALUES (26, 3);

INSERT INTO record VALUES (8, 1, 'Everything normal in the check up.');
INSERT INTO record VALUES (9, 2, 'Everything ready for the braces placement.');
INSERT INTO record VALUES (9, 3, 'Schedule check up appointment in two months.');
INSERT INTO record VALUES (9, 4, 'Good progress in the frontal teeth.');
INSERT INTO record VALUES (10, 5, 'Everything normal in the check up. Only come back in the next year if not feeling any pain.');
INSERT INTO record VALUES (9, 6, 'Frontal teeths are looking good. Started using elastic braces. Come back in two months.');
INSERT INTO record VALUES (11, 7, 'X-ray shows insufficient jaw bone for lower implant.');
INSERT INTO record VALUES (9, 8, 'Come back in two months.');
INSERT INTO record VALUES (12, 9, NULL);
INSERT INTO record VALUES (13, 10, NULL);
INSERT INTO record VALUES (8, 11, NULL);
INSERT INTO record VALUES (14, 12, 'Invisible alligners placed.');
INSERT INTO record VALUES (9, 13, 'Good improval on the right lateral teeth. Come back in two months.');
INSERT INTO record VALUES (15, 14, 'Healthy and strong teeth.');
INSERT INTO record VALUES (16, 15, 'Healthy and strong teeth but need to be better cleaned.');
INSERT INTO record VALUES (9, 16, 'The braces were tightened a lot. In case of more pain you can take Brufen. Come back in two months.');
INSERT INTO record VALUES (14, 17, 'Great improval in the left canine teath which was the major problem.');
INSERT INTO record VALUES (17, 18, 'In case of inflamation you can take Brufen and try to avoid chewing with the tooth.');
INSERT INTO record VALUES (10, 19, 'Complicated procedure as there were more damage than expected. In case of inflamation you can take Brufen and try to avoid chewing with the tooth.');
INSERT INTO record VALUES (12, 20, 'In case of inflamation you can take Brufen and try to avoid chewing with the tooth.');
INSERT INTO record VALUES (15, 21, NULL);
INSERT INTO record VALUES (16, 22, NULL);
INSERT INTO record VALUES (11, 23, NULL);
INSERT INTO record VALUES (9, 24, NULL);
INSERT INTO record VALUES (14, 25, NULL);
INSERT INTO record VALUES (10, 26, NULL);

INSERT INTO service VALUES ('check up', 40, 'general');
INSERT INTO service VALUES ('check up and clean', 60, 'general');
INSERT INTO service VALUES ('metal braces placement', 4600, 'orthodontics');
INSERT INTO service VALUES ('ceramic braces placement', 5000, 'orthodontics');
INSERT INTO service VALUES ('invisible aligners', 4800, 'orthodontics');
INSERT INTO service VALUES ('braces maintenance', 10, 'orthodontics');
INSERT INTO service VALUES ('dental cleanings', 50, 'pediatric');
INSERT INTO service VALUES ('initial implant assessment', 90, 'prosthodontics');
INSERT INTO service VALUES ('single dental implant', 1700, 'prosthodontics');
INSERT INTO service VALUES ('three adjacent teeth replacement', 4000, 'prosthodontics');
INSERT INTO service VALUES ('all upper teeth replacement', 6200, 'prosthodontics');
INSERT INTO service VALUES ('all lower teeth replacement', 5500, 'prosthodontics');
INSERT INTO service VALUES ('root canal treatment', 800, 'endodontics');

INSERT INTO servicePerformed VALUES (1, 'check up and clean');
INSERT INTO servicePerformed VALUES (2, 'check up');
INSERT INTO servicePerformed VALUES (3, 'metal braces placement');
INSERT INTO servicePerformed VALUES (4, 'braces maintenance');
INSERT INTO servicePerformed VALUES (5, 'check up and clean');
INSERT INTO servicePerformed VALUES (6, 'braces maintenance');
INSERT INTO servicePerformed VALUES (7, 'initial implant assessment');
INSERT INTO servicePerformed VALUES (8, 'braces maintenance');
INSERT INTO servicePerformed VALUES (9, 'check up and clean');
INSERT INTO servicePerformed VALUES (10, 'check up and clean');
INSERT INTO servicePerformed VALUES (11, 'check up and clean');
INSERT INTO servicePerformed VALUES (12, 'ceramic braces placement');
INSERT INTO servicePerformed VALUES (13, 'braces maintenance');
INSERT INTO servicePerformed VALUES (14, 'dental cleanings');
INSERT INTO servicePerformed VALUES (15, 'dental cleanings');
INSERT INTO servicePerformed VALUES (16, 'braces maintenance');
INSERT INTO servicePerformed VALUES (17, 'braces maintenance');
INSERT INTO servicePerformed VALUES (18, 'root canal treatment');
INSERT INTO servicePerformed VALUES (19, 'root canal treatment');
INSERT INTO servicePerformed VALUES (20, 'root canal treatment');

INSERT INTO discount VALUES (123, 'check up', 0);
INSERT INTO discount VALUES (123, 'check up and clean', 10);
INSERT INTO discount VALUES (123, 'metal braces placement', 20);
INSERT INTO discount VALUES (123, 'ceramic braces placement', 20);
INSERT INTO discount VALUES (123, 'invisible aligners', 20);
INSERT INTO discount VALUES (123, 'braces maintenance', 0);
INSERT INTO discount VALUES (123, 'dental cleanings', 40);
INSERT INTO discount VALUES (123, 'initial implant assessment', 0);
INSERT INTO discount VALUES (123, 'single dental implant', 10);
INSERT INTO discount VALUES (123, 'three adjacent teeth replacement', 10);
INSERT INTO discount VALUES (123, 'all upper teeth replacement', 20);
INSERT INTO discount VALUES (123, 'all lower teeth replacement', 20);
INSERT INTO discount VALUES (123, 'root canal treatment', 20);
INSERT INTO discount VALUES (456, 'check up', 10);
INSERT INTO discount VALUES (456, 'check up and clean', 20);
INSERT INTO discount VALUES (456, 'metal braces placement', 30);
INSERT INTO discount VALUES (456, 'ceramic braces placement', 30);
INSERT INTO discount VALUES (456, 'invisible aligners', 30);
INSERT INTO discount VALUES (456, 'braces maintenance', 10);
INSERT INTO discount VALUES (456, 'dental cleanings', 20);
INSERT INTO discount VALUES (456, 'initial implant assessment', 10);
INSERT INTO discount VALUES (456, 'single dental implant', 20);
INSERT INTO discount VALUES (456, 'three adjacent teeth replacement', 20);
INSERT INTO discount VALUES (456, 'all upper teeth replacement', 30);
INSERT INTO discount VALUES (456, 'all lower teeth replacement', 30);
INSERT INTO discount VALUES (456, 'root canal treatment', 30);

INSERT INTO material VALUES ('Dental Examination Mirror', 70);
INSERT INTO material VALUES ('Probe', 80);
INSERT INTO material VALUES ('Scanning Probe', 85);
INSERT INTO material VALUES ('Forceps', 52);
INSERT INTO material VALUES ('Pliers', 47);
INSERT INTO material VALUES ('Turbines', 10);
INSERT INTO material VALUES ('Micromotors', 15);
INSERT INTO material VALUES ('Straight Handpiece', 12);
INSERT INTO material VALUES ('Contra-Angle Handpiece', 12);
INSERT INTO material VALUES ('Light Curing Dental Lamps', 23);
INSERT INTO material VALUES ('Latex gloves', 450);
INSERT INTO material VALUES ('Dental Composites', 104);
INSERT INTO material VALUES ('Orthodontics Metal Braces', 127);
INSERT INTO material VALUES ('Orthodontics Ceramic Braces', 127);
INSERT INTO material VALUES ('Orthodontics Elastic', 300);
INSERT INTO material VALUES ('Orthodontics Clear Aligners', 22);
INSERT INTO material VALUES ('Dental Sutures', 47);
INSERT INTO material VALUES ('Endodontic Instruments', 0);

INSERT INTO quantity VALUES ('metal braces placement', 'Pliers', 1);
INSERT INTO quantity VALUES ('metal braces placement', 'Forceps', 2);
INSERT INTO quantity VALUES ('metal braces placement', 'Straight Handpiece', 1);
INSERT INTO quantity VALUES ('metal braces placement', 'Contra-Angle Handpiece', 1);
INSERT INTO quantity VALUES ('metal braces placement', 'Latex gloves', 4);
INSERT INTO quantity VALUES ('metal braces placement', 'Orthodontics Metal Braces', 32);
INSERT INTO quantity VALUES ('metal braces placement', 'Orthodontics Elastic', 34);
INSERT INTO quantity VALUES ('metal braces placement', 'Dental Composites', 2);
INSERT INTO quantity VALUES ('check up and clean', 'Dental Examination Mirror', 1);
INSERT INTO quantity VALUES ('check up and clean', 'Probe', 2);
INSERT INTO quantity VALUES ('check up and clean', 'Turbines', 3);
INSERT INTO quantity VALUES ('check up and clean', 'Micromotors', 2);
INSERT INTO quantity VALUES ('check up and clean', 'Straight Handpiece', 1);
INSERT INTO quantity VALUES ('check up and clean', 'Contra-Angle Handpiece', 2);
INSERT INTO quantity VALUES ('check up and clean', 'Latex gloves', 4);
INSERT INTO quantity VALUES ('check up', 'Dental Examination Mirror', 1);
INSERT INTO quantity VALUES ('check up', 'Straight Handpiece', 1);
INSERT INTO quantity VALUES ('check up', 'Latex gloves', 4);
INSERT INTO quantity VALUES ('ceramic braces placement', 'Pliers', 1);
INSERT INTO quantity VALUES ('ceramic braces placement', 'Forceps', 2);
INSERT INTO quantity VALUES ('ceramic braces placement', 'Straight Handpiece', 1);
INSERT INTO quantity VALUES ('ceramic braces placement', 'Contra-Angle Handpiece', 1);
INSERT INTO quantity VALUES ('ceramic braces placement', 'Latex gloves', 4);
INSERT INTO quantity VALUES ('ceramic braces placement', 'Orthodontics Ceramic Braces', 32);
INSERT INTO quantity VALUES ('ceramic braces placement', 'Orthodontics Elastic', 34);
INSERT INTO quantity VALUES ('ceramic braces placement', 'Dental Composites', 2);
INSERT INTO quantity VALUES ('invisible aligners', 'Forceps', 2);
INSERT INTO quantity VALUES ('invisible aligners', 'Latex gloves', 4);
INSERT INTO quantity VALUES ('invisible aligners', 'Dental Composites', 2);
INSERT INTO quantity VALUES ('invisible aligners', 'Orthodontics Clear Aligners', 2);
INSERT INTO quantity VALUES ('invisible aligners', 'Dental Examination Mirror', 1);
INSERT INTO quantity VALUES ('braces maintenance', 'Pliers', 1);
INSERT INTO quantity VALUES ('braces maintenance', 'Forceps', 2);
INSERT INTO quantity VALUES ('braces maintenance', 'Straight Handpiece', 1);
INSERT INTO quantity VALUES ('braces maintenance', 'Contra-Angle Handpiece', 1);
INSERT INTO quantity VALUES ('braces maintenance', 'Latex gloves', 4);
INSERT INTO quantity VALUES ('dental cleanings', 'Probe', 2);
INSERT INTO quantity VALUES ('dental cleanings', 'Turbines', 3);
INSERT INTO quantity VALUES ('dental cleanings', 'Micromotors', 2);
INSERT INTO quantity VALUES ('dental cleanings', 'Straight Handpiece', 1);
INSERT INTO quantity VALUES ('dental cleanings', 'Contra-Angle Handpiece', 2);
INSERT INTO quantity VALUES ('dental cleanings', 'Latex gloves', 4);
INSERT INTO quantity VALUES ('initial implant assessment', 'Latex gloves', 4);
INSERT INTO quantity VALUES ('initial implant assessment', 'Dental Examination Mirror', 1);
INSERT INTO quantity VALUES ('initial implant assessment', 'Endodontic Instruments', 5);
INSERT INTO quantity VALUES ('initial implant assessment', 'Probe', 1);
INSERT INTO quantity VALUES ('single dental implant', 'Probe', 1);
INSERT INTO quantity VALUES ('single dental implant', 'Forceps', 2);
INSERT INTO quantity VALUES ('single dental implant', 'Pliers', 1);
INSERT INTO quantity VALUES ('single dental implant', 'Endodontic Instruments', 2);
INSERT INTO quantity VALUES ('single dental implant', 'Dental Composites', 2);
INSERT INTO quantity VALUES ('three adjacent teeth replacement', 'Pliers', 1);
INSERT INTO quantity VALUES ('three adjacent teeth replacement', 'Forceps', 2);
INSERT INTO quantity VALUES ('three adjacent teeth replacement', 'Dental Sutures', 2);
INSERT INTO quantity VALUES ('three adjacent teeth replacement', 'Latex gloves', 4);
INSERT INTO quantity VALUES ('three adjacent teeth replacement', 'Endodontic Instruments', 3);
INSERT INTO quantity VALUES ('three adjacent teeth replacement', 'Dental Composites', 3);
INSERT INTO quantity VALUES ('all upper teeth replacement', 'Pliers', 1);
INSERT INTO quantity VALUES ('all upper teeth replacement', 'Forceps', 2);
INSERT INTO quantity VALUES ('all upper teeth replacement', 'Dental Sutures', 2);
INSERT INTO quantity VALUES ('all upper teeth replacement', 'Latex gloves', 6);
INSERT INTO quantity VALUES ('all upper teeth replacement', 'Endodontic Instruments', 8);
INSERT INTO quantity VALUES ('all upper teeth replacement', 'Dental Composites', 30);
INSERT INTO quantity VALUES ('all lower teeth replacement', 'Pliers', 1);
INSERT INTO quantity VALUES ('all lower teeth replacement', 'Forceps', 2);
INSERT INTO quantity VALUES ('all lower teeth replacement', 'Dental Sutures', 2);
INSERT INTO quantity VALUES ('all lower teeth replacement', 'Latex gloves', 6);
INSERT INTO quantity VALUES ('all lower teeth replacement', 'Endodontic Instruments', 8);
INSERT INTO quantity VALUES ('all lower teeth replacement', 'Dental Composites', 30);
INSERT INTO quantity VALUES ('root canal treatment', 'Probe', 1);
INSERT INTO quantity VALUES ('root canal treatment', 'Forceps', 2);
INSERT INTO quantity VALUES ('root canal treatment', 'Dental Sutures', 1);
INSERT INTO quantity VALUES ('root canal treatment', 'Endodontic Instruments', 2);
INSERT INTO quantity VALUES ('root canal treatment', 'Dental Examination Mirror', 1);
INSERT INTO quantity VALUES ('root canal treatment', 'Contra-Angle Handpiece', 1);
INSERT INTO quantity VALUES ('root canal treatment', 'Light Curing Dental Lamps', 1);