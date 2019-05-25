<section id="content_area">
    <div class="clearfix wrapper main_content_area">

        <div class="clearfix main_content floatleft">


            <div class="clearfix content">
                <div class="content_title"><h2>DODAJ NOVI ODGOVOR ZA ANKETU</h2></div>
                <div class="contact_us">
                
                <form>
                        <p>
                            <select id="sveAnkete" class="wpcf7-select">
                            <option value="0">Izaberi anketu za koju postavaljas pitanje</option>
                            <?php
                            $upit="SELECT * FROM anketa";
                            $rez= $kon->query($upit)->fetchAll();
                            foreach($rez as $sve):
                            ?>
                            <option value="<?= $sve->id_a ?>"><?= $sve->pitanje?></option>
                            <?php endforeach;?>
                            </select>   
                        </p>
                        <span class="spanovi" id="sveAnketice">Morate izabrati anketu za koju postavljate!</span>

                        <p><input type="text" class="wpcf7-text" id="noviOdgovor" name="noviOdgovor" placeholder="Odgvor za anketu*"/></p> 
                        <span class="spanovi" id="odgovorAkete">Odgovor ankete ne moze da bude prazan!</span>
                        <p><input type="button" id="unesiOdgovor" name="unesiOdgovor" class="wpcf7-submit" value="Dodaj"/></p>
                </form>

                </div>

            </div>

        </div>
    