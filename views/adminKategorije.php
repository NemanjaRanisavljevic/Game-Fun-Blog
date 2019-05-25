<section id="content_area">
    <div class="clearfix wrapper main_content_area">

        <div class="clearfix main_content floatleft">


            <div class="clearfix content">
                <div class="content_title"><h2>TRENUTNE KATEGORIJE</h2></div>
                <div class="contact_us">
                <table border="1px solid" class='tabelaA'>
                   
                    <tr>
                        <th>Id</th>
                        <th>Naziv</th>
                        <th>Brisanje</th>
                        <th>Azuriranje</th>
                       
                        
                       
                    </tr>
                        <?php 
                        $upit ="SELECT * FROM kategorije";
                        $rez = $kon->query($upit)->fetchAll();
                        foreach($rez as $k):
                        ?>
                    
                        <tr>
                            <td><?= $k->id?></td>
                            <td><?= $k->naziv?></td>
                            
                            <td><input type="button" value="Obrisi" class="brisanjeKat dugmic" data-id="<?= $k->id?>"/></td>
                            <td><input type="button" value="Update" class="updateKate dugmic"  data-id="<?= $k->id?>"/></td>
                        </tr>
                        <?php endforeach;?>
                </table>

                <div class="formaadmin">
                <div id="more_works" class="more_works">
							<h2>Izmeni kategoriju</h2></div>
                    <form>
                        <p><input type="text" class="wpcf7-text" id="nazivK" name="nazivK" placeholder="Naziv kategorije*"/></p> 
                        <p><input type="hidden" id="skriveniIdKategorije"/></p> 
                        <span class="spanovi" id="nazivS">Kategirija ne moze da bude prazna</span>



                        <p><input type="button" id="updateKat" name="updateKat" class="wpcf7-submit" value="Izmeni"/></p>
                    </form>
                </div>   
                  
                </div>

            </div>

        </div>