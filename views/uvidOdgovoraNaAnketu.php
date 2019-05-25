<section id="content_area">
    <div class="clearfix wrapper main_content_area">

        <div class="clearfix main_content floatleft">


            <div class="clearfix content">
                <div class="content_title"><h2>ODGOVORI KORISNIKA SAJTA NA ANKETU</h2></div>
                <div class="contact_us">
                <table border="1px solid" class='tabelaA'>
                   
                    <tr>
                        <th>Korisnik</th>
                        <th>Anketa</th>
                        <th>Odgovor</th>
                        <th>Brisanje</th>
                    
                    </tr>
                        <?php 
                        $upit ="SELECT k.ime,k.prezime,a.pitanje,ao.odgovor,ako.* 
                        FROM anketa_korisnik_odgovor ako 
                        INNER JOIN korisnik k ON ako.idK=k.idKorisnik 
                        INNER JOIN anketa a ON ako.anketaId=a.id_a 
                        INNER JOIN anketa_odgovori ao ON ako.idOdgovor=ao.id_od";
                        $rez = $kon->query($upit)->fetchAll();
                        foreach($rez as $ako):
                        ?>
                    
                        <tr>
                            <td><?= $ako->ime . $ako->prezime?></td>
                            <td><?= $ako->pitanje?></td>
                            <td><?= $ako->odgovor?></td>
                            <td><input type="button" value="Obrisi" class="brisanjeAko dugmic" data-id="<?= $ako->id_a_k_o?>"/></td>
                        </tr>
                        <?php endforeach;?>
                </table>

                
                  
                </div>

            </div>

        </div>