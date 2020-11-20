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
    phone_number text NOT NULL
);

CREATE TABLE client (
    id integer PRIMARY KEY REFERENCES person,
    birth_date text NOT NULL,
    tax_number integer UNIQUE
);

CREATE TABLE employee (
    id integer PRIMARY KEY REFERENCES person, 
    salary float CHECK(salary > 0),
    date_of_admission text
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
    date text NOT NULL,
    time text NOT NULL,
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