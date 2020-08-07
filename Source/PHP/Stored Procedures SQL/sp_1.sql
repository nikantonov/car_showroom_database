create or replace PROCEDURE auto_tec(am IN VARCHAR2, nn OUT VARCHAR2)
  IS
BEGIN
  Select m.nachname INTO nn from auto a, repariert r, mitarbeiter m
  where a.modell=am AND a.autoid = r.autoid AND r.persnr=m.persnr;
END;
/