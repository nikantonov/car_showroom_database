create or replace PROCEDURE mit(am IN VARCHAR2, nn OUT VARCHAR2)
  IS
BEGIN
  Select m.nachname INTO nn from mitarbeiter a, beaufsichtigt b, mitarbeiter m
  where a.nachname=am AND a.persnr = b.persnr1 AND b.persnr2 = m.persnr;
END;
/