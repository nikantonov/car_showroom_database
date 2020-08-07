import java.sql.*;
import oracle.jdbc.driver.*;
import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.nio.charset.Charset;


public class TestDataGenerator {

    public static void main(String args[]) {
        
        //connection
        
        try {
            Class.forName("oracle.jdbc.driver.OracleDriver");
            String database = "jdbc:oracle:thin:@oracle-lab.cs.univie.ac.at:1521:lab";
            String user = "a01348746";
            String pass = "Nikita1995";
            
            Connection con = DriverManager.getConnection(database, user, pass);
            Statement stmt = con.createStatement();
            
            //Mitarbeiter befullung
            
            for(int i = 1; i <= 1500; i++)
            {
                try {
                    String v = String.valueOf(i);
                    String insertSql = "INSERT INTO mitarbeiter (Vorname, Nachname, Geburtsdatum, Gehalt) VALUES ('Vorname"+i+"','Nachname"+i+"', to_date('1975-01-01', 'yyyy-mm-dd'), 1500)";
                    stmt.executeUpdate(insertSql);
                } catch (Exception e) {
                    System.err.println("Fehler!" + e.getMessage());
                }
            }
            
            ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM mitarbeiter");
            if (rs.next()) {
                int count1 = rs.getInt(1);
                System.out.println("Number of Mitarbeiter: " + count1);
            }
            
            //beaufsichtigt befullung
            
            int j = 500;
            int d = 1;
            while (d <= 100)
            {
                try {
                    String e = String.valueOf(d);
                    String y = String.valueOf(j);
                    String insertSql = "INSERT INTO beaufsichtigt VALUES ("+e+", "+y+")";
                    stmt.executeUpdate(insertSql);
                } catch (Exception e) {
                    System.err.println("Fehler!" + e.getMessage());
                }
                d = d + 1;
                j = j + 2;
            }
            
            ResultSet rd = stmt.executeQuery("SELECT COUNT(*) FROM beaufsichtigt");
            if (rd.next())
            {
                int count2 = rd.getInt(1);
                System.out.println("Number of beaufsichtigt: " + count2);
            }
            
            //autotechniker befullung
            
            for (int r = 1; r <= 1500; r++)
            {
                 if (r % 2 == 0)
                 {
                   try {
                       String e = String.valueOf(r);
                       String insertSql = "INSERT INTO autotechniker VALUES ("+e+", 'Erste', 'Techniker')";
                       stmt.executeUpdate(insertSql);
                   }catch (Exception e) {
                       System.err.println("Fehler!" + e.getMessage());
                
                   }
                }
            }
            
            ResultSet rm = stmt.executeQuery("SELECT COUNT(*) FROM autotechniker");
            if (rm.next())
            {
                int count3 = rm.getInt(1);
                System.out.println("Number of Autotechniker: " + count3);
            }
            
            
            //manager befullung
            
            
            for (int s = 1; s <= 1500; s++)
            {
                if (s % 2 != 0)
                {
                    try {
                        String q = String.valueOf(s);
                        String insertSql = "INSERT INTO manager VALUES ("+q+",010"+q+", 'email@"+q+"autohaus.at')";
                        stmt.executeQuery(insertSql);
                    }catch (Exception e) {
                        System.err.println("Fehler!" + e.getMessage());
                    }
                }
            }
            
            ResultSet rg = stmt.executeQuery("SELECT COUNT(*) FROM manager");
            if (rg.next())
            {
                int count4 = rg.getInt(1);
                System.out.println("Number of Manager: " + count4);
            }
           
            //motor befullung
            
            for (int q = 3001; q <=5000; q++)
            {
                try {
                    int b = q/12;
                    String a = String.valueOf(q);
                    String df = String.valueOf(b);
                    if (q % 2 == 0)
                    {
                        String insertSql = "INSERT INTO motor VALUES ("+a+", 'Benzin', "+df+")";
                        stmt.executeQuery(insertSql);
                    }
                    else {
                        String insertSql = "INSERT INTO motor VALUES ("+a+", 'Diesel', "+df+")";
                        stmt.executeQuery(insertSql);
                    }
                    
                }catch (Exception e) {
                    System.err.println("Fehler!" + e.getMessage());
                }
            }
            
            ResultSet qw = stmt.executeQuery("SELECT COUNT(*) FROM motor");
            if (qw.next())
            {
                int count5 = qw.getInt(1);
                System.out.println("Number of Motor: " + count5);
            }
            
            //motorteil befullung
            
            int ss = 3001;
            for (int a = 10001; a <= 13000; a++)
            {
                try {
                    String pos = String.valueOf(ss);
                    String po = String.valueOf(a);
                    if ( a % 2 == 0)
                    {
                        String insertSql = "INSERT INTO motorteil VALUES ("+pos+", "+po+", 'Typ"+po+"', 'Eisen')";
                        stmt.executeQuery(insertSql);
                    } else {
                        String insertSql = "INSERT INTO motorteil VALUES ("+pos+", "+po+", 'Typ"+po+"', 'Aluminium')";
                        stmt.executeQuery(insertSql);
                        ss++;
                    }
                    
                }catch (Exception e) {
                    System.out.println("Fehler! " + e.getMessage());
                }
            }
            
            ResultSet lk = stmt.executeQuery("SELECT COUNT(*) FROM motorteil");
            if (lk.next())
            {
                int count6 = lk.getInt(1);
                System.out.println("Number of Motorteil: " + count6);
            }
            
            //auto befullung
            
            int hm = 1;
            int lks = 3001;
            for (int df = 15001; df <= 17000; df++)
            {
                try {
                    String sx = String.valueOf(lks);
                    String hd = String.valueOf(hm);
                    String hj = String.valueOf(df);
                    String insertSql = "INSERT INTO auto VALUES ("+hj+", 'Marke"+hj+"', 'Modell"+hj+"', 'Karosserie"+hj+"', "+hd+", "+sx+")";
                    lks++;
                    if (df % 4 == 0)
                    {
                        hm = hm + 2;
                    }
                    stmt.executeQuery(insertSql);
                }catch (Exception e) {
                    System.out.println("Fehler! " + e.getMessage());
                }
            }
            
            ResultSet zx = stmt.executeQuery("SELECT COUNT(*) FROM auto");
            if (zx.next())
            {
                int count7 = zx.getInt(1);
                System.out.println("Number of Auto: " + count7);
            }
            
            //repariert befullung
            
            int yu = 2;
            int jk = 15001;
            for (int as = 1; as <= 100; as++)
            {
                try {
                    String sdf = String.valueOf(jk);
                    String ghj = String.valueOf(yu);
                    String insertSql = "INSERT INTO repariert VALUES ("+ghj+", "+sdf+")";
                    if ( as % 2 == 0)
                    {
                        yu = yu + 2;
                    }
                    jk++;
                    stmt.executeQuery(insertSql);
                } catch (Exception e) {
                    System.out. println("Fehler! " + e.getMessage());
                }
            }
            
            ResultSet cv = stmt.executeQuery("SELECT COUNT(*) FROM repariert");
            if (cv.next())
            {
                int count8 = cv.getInt(1);
                System.out.println("Number of repariert: " + count8);
            }
            
            
            cv.close();
            zx.close();
            lk.close();
            qw.close();
            rg.close();
            rm.close();
            rd.close();
            rs.close();
            stmt.close();
            con.close();
            
            
            
        } catch (Exception e) {
            System.err.println(e.getMessage());
        }
    }

}

