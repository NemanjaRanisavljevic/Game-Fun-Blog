<section id="content_area">
    <div class="clearfix wrapper main_content_area">

        <div class="clearfix main_content floatleft">


            <div class="clearfix content">
                <div class="content_title"><h2>TRENUTNE ANKETE</h2></div>
                <div class="contact_us">
                <table border="1px solid" class='tabelaA'>
                   
                    <tr>
                        <th>Id</th>
                        <th>Pitanje</th>
                        <th>Aktivna</th>
                        <th>Brisanje</th>
                        <th>Azuriranje</th>
                       
                        
                       
                    </tr>
                        <?php 
                        $upit ="SELECT * FROM anketa";
                        $rez = $kon->query($upit)->fetchAll();
                        foreach($rez as $k):
                        ?>
                    
                        <tr>
                            <td><?= $k->id_a?></td>
                            <td><?= $k->pitanje?></td>
                            <td><?= $k->aktivna?></td>
                            
                            <td><input type="button" value="Obrisi" class="brisanjeAnkete dugmic" data-id="<?= $k->id_a?>"/></td>
                            <td><input type="button" value="Update" class="updateAnkete dugmic"  data-id="<?= $k->id_a?>"/></td>
                        </tr>
                        <?php endforeach;?>
                </table>

                <div class="formaadmin">
                <div id="more_works" class="more_works">
							<h2>Izmeni anketu</h2></div>
                    <form>
                        <p><input type="text" class="wpcf7-text" id="pitanjeAn" name="pitanjeAn" placeholder="Pitanje *"/></p> 
                        <p><input type="hidden" id="skrivenaAnketaId"/></p> 
                        <span class="spanovi" id="anketaS">Pitanje ne moze da bude prazno!</span>
                        <p>
                        <select id="ddlAktivan" class="wpcf7-select">
                            <option value="1">Aktivna</option>
                            <option value="0">Nije aktivna</option>
                        </select>
                        </p>

                        <p><input type="button" id="upAnketa" name="upAnketa" class="wpcf7-submit" value="Izmeni"/></p>
                    </form>
                </div>   
                <div class="formaadmin">
                <div id="more_works" class="more_works">
						<h2>Svi odgovori Anketa</h2>
                </div>

                <table border="1px solid" class='tabelaA'>
                   
                   <tr>
                       <th>Anketa</th>
                       <th>Odgovori</th>
                       <th>Brisanje</th>
                   </tr>
                       <?php 
                       $upit ="SELECT * FROM anketa_odgovori ao INNER JOIN anketa a ON ao.idAnketa=a.id_a";
                       $rez = $kon->query($upit)->fetchAll();
                       foreach($rez as $odgovori):
                       ?>
                   
                       <tr>
                           <td><?= $odgovori->pitanje?></td>
                           <td><?= $odgovori->odgovor?></td>
                           <td><input type="button" value="Obrisi" class="brisanjeOdgovora dugmic" data-id="<?= $odgovori->id_od?>"/></td>
                       </tr>
                       <?php endforeach;?>
               </table>
                   
                </div>   
                  
                </div>

            </div>

        </div>