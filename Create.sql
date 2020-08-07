CREATE TABLE mitarbeiter (
  PersNr INTEGER,
  Vorname VARCHAR(60) NOT NULL,
  Nachname VARCHAR(60) NOT NULL,
  Geburtsdatum DATE NOT NULL,
  Gehalt REAL DEFAULT 1000,
  CHECK (Gehalt >= 0),
  PRIMARY KEY (PersNr)
  );
  
CREATE TABLE beaufsichtigt (
  PersNr1 INTEGER NOT NULL,
  PersNr2 INTEGER NOT NULL,
  PRIMARY KEY(PersNr1, PersNr2),
  FOREIGN KEY (PersNr1) REFERENCES mitarbeiter  
      ON DELETE CASCADE,
  FOREIGN KEY (PersNr2) REFERENCES mitarbeiter  
      ON DELETE CASCADE 
);
  
CREATE TABLE autotechniker (
  PersNr INTEGER NOT NULL,
  Qualifikation VARCHAR(40) DEFAULT 'Erste',
  Spezialisierung VARCHAR(100),
  PRIMARY KEY (PersNr),
  FOREIGN KEY (PersNr) REFERENCES mitarbeiter (PersNr) 
    ON DELETE CASCADE 
  );
  
CREATE TABLE manager (
  PersNr INTEGER NOT NULL,
  Arbeitsplatznummer INTEGER,
  Email VARCHAR(70),
  PRIMARY KEY(PersNr),
  UNIQUE(Email),
  CHECK (Arbeitsplatznummer >= 0),
  FOREIGN KEY (PersNr) REFERENCES mitarbeiter (PersNr) 
    ON DELETE CASCADE 
  );
  
CREATE TABLE motor (
  MotorID INTEGER NOT NULL,
  Typ VARCHAR(100) NOT NULL,
  Leistung REAL NOT NULL,
  CHECK (Leistung >= 0),
  PRIMARY KEY(MotorID)
  );
  
CREATE TABLE motorteil (
  MotorID INTEGER NOT NULL,
  TeilID INTEGER NOT NULL,
  Typ VARCHAR(100) NOT NULL,
  Material VARCHAR(100) NOT NULL,
  PRIMARY KEY (MotorID, TeilID),
  FOREIGN KEY (MotorID) REFERENCES motor (MotorID)
   ON DELETE CASCADE 
  );
  
CREATE TABLE auto (
  AutoID INTEGER NOT NULL,
  Marke VARCHAR(64) NOT NULL,
  Modell VARCHAR(64) NOT NULL,
  Karosserie VARCHAR(64),
  PersNr INTEGER NOT NULL,
  MotorID INTEGER NOT NULL,
  PRIMARY KEY(AutoID),
  FOREIGN KEY (PersNr) REFERENCES manager (PersNr),
  FOREIGN KEY (MotorID) REFERENCES motor (MotorID)
  );
  
CREATE TABLE repariert (
  PersNr INTEGER NOT NULL,
  AutoID INTEGER NOT NULL,
  PRIMARY KEY (PersNr, AutoID),
  FOREIGN KEY (PersNr) REFERENCES autotechniker,
  FOREIGN KEY (AutoID) REFERENCES auto 
  );
  
CREATE SEQUENCE seq
  start with 1
  increment by 1;
  
CREATE TRIGGER auto_increment BEFORE INSERT ON mitarbeiter
    FOR EACH ROW
  BEGIN
   SELECT seq.nextval
    INTO :new.PersNr
    FROM dual;
  END;
  /
  
  
/* View mehralszwei zeigt, welche Autotechnikern reparieren mehr als 2 Autos */
  
CREATE VIEW mehralszwei AS
(SELECT r.PersNr, COUNT(r.AutoID) Anzahl
 FROM repariert r                                    
   GROUP BY r.PersNr
     HAVING COUNT(r.AutoID) > 2);
     
/* View zeigt die Namen von Managern mit passenden Email*/     
     
CREATE VIEW managermitemail AS
(SELECT mi.Vorname, mi.Nachname, ma.Email 
  FROM mitarbeiter mi INNER JOIN manager ma ON 
    mi.PersNr = ma.PersNr);
     
     
  
  
  
  
  


