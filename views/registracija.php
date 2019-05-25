<section id="content_area">
    <div class="clearfix wrapper main_content_area">

        <div class="clearfix main_content floatleft">


            <div class="clearfix content">
                <div class="content_title"><h2>Registracija</h2></div>
                <div class="contact_us">

                    <form>
                        <p><input type="text" class="wpcf7-text" id="ime" name="ime" placeholder="Ime*"/></p> 
                        <span id="imeS">Morate uneti ime! Prvo veliko slovo.</span>

                        <p><input type="text" class="wpcf7-text" id="prezime" name="prezime" placeholder="Prezime*"/></p>
                        <span id="prezimeS">Morate uneti prezime! Prvo veliko slovo.</span>

                        <p><select id="listaPol" name="listaPol" class="wpcf7-select">
                                <option value="0">Izaberi pol</option>
                                <?php
                                
                                $upit ="Select * FROM pol";
                                $rez = $kon->query($upit)->fetchAll(); 
                                foreach($rez as $p):
                                ?>
                                <option value="<?= $p->id ?>"><?= $p->nazivP?></option>
                                <?php endforeach; ?>

                        </select>
                        </p>
                        <span id="polS">Morate izabrati pol!</span>

                        <p><input type="text" id="email" class="wpcf7-email" name="email" placeholder="Email*"/></p>
                        <span id="emailS">Morate uneti email! Mora da bude gmail.com</span>

                        <p><input type="password" id="sifra" class="wpcf7-text" name="sifra" placeholder="Sifra*"/></p>
                        <span id="sifraS">Morate uneti sifru! Mora poceti velikim slovom i imati 6 karaktera.</span>

                    
                        <p><input type="button" id="registrovan" name="registrovan" class="wpcf7-submit" value="Posalji"/></p>
                    </form>

                </div>

            </div>

        </div>