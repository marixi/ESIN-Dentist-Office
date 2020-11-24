-- Dentist Office
-- Authors: Duarte Rodrigues, Mariana Xavier

PRAGMA foreign_keys = ON;

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

CREATE TABLE person (
    id integer PRIMARY KEY AUTOINCREMENT,
    name text NOT NULL,
    address text,
    phone_number text NOT NULL -- e.g. +351935556768
);

CREATE TABLE client (
    id integer PRIMARY KEY REFERENCES person,
    birth_date text NOT NULL, -- format dd-mm-yyyy
    tax_number integer UNIQUE
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
    id integer PRIMARY KEY AUTOINCREMENT,
    date text NOT NULL, -- format dd-mm-yyyy
    time text NOT NULL, -- format 'hh:mm'
    room integer NOT NULL,
    cost float CHECK(cost > 0 OR cost IS NULL),
    client_id integer NOT NULL REFERENCES client,
    dentist_id integer NOT NULL REFERENCES dentist,
    specialty text NOT NULL REFERENCES specialty
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

CREATE TABLE insurance (
    insurance_code integer PRIMARY KEY
);

CREATE TABLE discount (
    insurance_code integer REFERENCES insurance,
    service_name text REFERENCES service,
    percentage_discount integer CHECK(percentage_discount >= 0 OR percentage_discount IS NULL),
    PRIMARY KEY(insurance_code, service_name)
);

CREATE TABLE material (
    name text PRIMARY KEY,
    quantity_in_stock NOT NULL CHECK(quantity_in_stock >= 0)
);

CREATE TABLE quantity (
    service_name text REFERENCES service,
    material_name text REFERENCES material,
    quantity_needed integer NOT NULL CHECK(quantity_needed > 0),
    PRIMARY KEY(service_name, material_name)
);

CREATE TABLE materialManagement (
    dental_auxiliar integer REFERENCES dentalAuxiliary,
    material_name text REFERENCES material,
    PRIMARY KEY(dental_auxiliar, material_name)
);

INSERT INTO person VALUES(1, 'Raquel Pires', 'Rua Muro Bacalhoeiros 57 4250-124 Porto, Porto', '+351921555422');
INSERT INTO person VALUES(2, 'Miguel Paredes', 'Rua Muro Bacalhoeiros 57 4250-124 Porto, Porto', '+351929255572');
INSERT INTO person VALUES(3, 'Joana Fonseca', 'Rua Caminho Cruz 21 4440-689 Valongo, Porto', '+351965559111');
INSERT INTO person VALUES(4, 'Ricardo Brioso', 'Rua Tapada Marinha 77 4455-459 Perafita, Porto', '+351929155587');
INSERT INTO person VALUES(5, 'Sara Fernandes', 'Rua Nossa Senhora Graça 90 4620-135 Lousada, Porto', '+351921555869');
INSERT INTO person VALUES(6, 'Lara Guerreiro', 'Rua Heróis Ultramar 94 4640-210 Monte Alegra, Porto', '+351921555935');
INSERT INTO person VALUES(7, 'Erica Freitas', 'Avenida Júlio Saúl Dias 53 4560-800 Portela, Porto', '+351225555669');
INSERT INTO person VALUES (8, 'Clara Tavares', 'Rua Âncora 77 4400-095 Vila Nova de Gaia, Porto', '+351935556768');
INSERT INTO person VALUES (9, 'Francisco Amaral', 'Rua Comércio Porto 42 4500-532 Porto, Porto', '+351922555524');
INSERT INTO person VALUES (10, 'Andreia Baptista', 'Rua Patrão Caramelho 111 4485-330 Labruge, Porto', '+351915555347');
INSERT INTO person VALUES (11, 'Martim Sousa', 'Rua Nossa Senhora Graça 44 4620-226 Sequeiros, Porto', '+351921555346');
INSERT INTO person VALUES (12, 'Maria Esteves', 'Rua Alegria 39 4580-372 Seixoso, Porto', '+351915557534');
INSERT INTO person VALUES (13, 'Pedro Neves', 'Rua Tapada Marinha 49 4455-184 Lavra, Porto', '+351929055523');
INSERT INTO person VALUES (14, 'Yara Martins', 'Rua Oliveirinhas 58 4420-400 Valbom, Porto', '+351922555434');
INSERT INTO person VALUES (15, 'Miguel Barros', 'Avenida Parque Gondarim 97 4405-796 Vila Nova de Gaia, Porto', '+351921555668');
INSERT INTO person VALUES (16, 'Duarte Barros', 'Avenida Parque Gondarim 97 4405-796 Vila Nova de Gaia, Porto', '+351921555668');
INSERT INTO person VALUES (17, 'Mariana Ramos', 'Travessa Pindelo do Falcão 84 4425-547 Maia, Porto', '+351921555595');

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

INSERT INTO client VALUES (8, '15-06-1987', 204996503);
INSERT INTO client VALUES (9, '27-01-1999', 249869900);
INSERT INTO client VALUES (10, '03-12-1995', 232895775);
INSERT INTO client VALUES (11, '14-07-1982', 278402062);
INSERT INTO client VALUES (12, '08-08-1972', 219225133);
INSERT INTO client VALUES (13, '31-01-1970', NULL);
INSERT INTO client VALUES (14, '03-02-2007', 226969886);
INSERT INTO client VALUES (15, '05-11-2005', NULL);
INSERT INTO client VALUES (16, '05-11-2005', NULL);
INSERT INTO client VALUES (17, '09-07-1964', 204398754);