<?php $this->title = 'Създай профил'; ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-8 text-center" disabled="">
            <div class="panel panel-yellow"  >
                <div class="panel-heading">
                    <h2 class="panel-title">Регистрирани сте в системата, като <?=htmlspecialchars($_SESSION['positiontype'])?>
                        <br> потребителско име <?=htmlspecialchars($_SESSION['username'])?></h2>
                </div>
                <div class="panel-body" >
                    <form role="form" method="post">
                        <?php $exstProfile = $this->profileby['pid'];
                        if (isset($exstProfile)) :?>
                        <fieldset disabled>
                            <?php endif;?>
                            <div class="row">
                                <div class="col-sm-6 text-left" >
                                    <div class="panel panel-yellow" >
                                        <div class="panel-body" >
                                            <label for="person_fname" >
                                                <input id="person_fname" type="text" name="person_fname"   class="form-control">
                                                <i>Първото Ви име е....</i>
                                            </label>
                                            <label for="person_mname">
                                                <input id="person_mname" type="text" name="person_mname" value="<?=$_POST['person_mname']?>"  class="form-control">
                                                <i >Врото Ви име.....</i>
                                            </label>
                                            <label for="person_lname">
                                                <input id="person_lname" type="text" name="person_lname" value="<?=$_POST['person_lname']?>"  class="form-control">
                                                <i >И третото :)......</i>
                                            </label>
                                            <label for="person_date" ><i >Роден сте на ?....</i>
                                                <input id="person_date" class="form-control; datepicker" type="text" name="person_date" value="<?=$_POST['person_date']?>" readonly>
                                            </label>
                                            <label for="egn">
                                                <input id="egn" type="text" name="egn" value="<?=$_POST['egn']?>" class="form-control">
                                                <i >ЕГН или номер по лична карта</i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-left">
                                    <div class="panel panel-yellow">
                                        <div class="panel-body">
                                            <label for="country">
                                                <input id="country" type="text" name="country"  value="<?=$_POST['country']?>"  class="form-control">
                                                <i>От коя държава сте?</i>
                                            </label>
                                            <label for="city">
                                                <input id="city" type="text" name="city" value="<?=$_POST['city']?>" class="form-control">
                                                <i>Град или село....</i>
                                            </label>
                                            <label for="street" class="lin">
                                                <input id="street" type="text" name="street" value="<?=$_POST['street']?>" class="form-control">
                                                <i>Адресът, на който живеете</i>
                                            </label>
                                            <label for="gender">
                                                <select name="gender" class="form-control">
                                                    <option value="<?=$_POST['gender']?>" class="dropdown-item" ><i>пол</i></option>
                                                    <option value="1" class="dropdown-item" >мъж</option>
                                                    <option value="2" class="dropdown-item" >жена</option>
                                                </select>
                                            </label>
                                            <label for="phonenumber">
                                                <input id="phonenumber" type="text" name="phonenumber" value="<?=$_POST['phonenumber']?>" class="form-control">
                                                <i>Телефон за връзка.........</i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <div class="panel panel-yellow">
                                        <div class="panel-body">
                                            <button type="submit" value="Create" class="btn btn-default">Изпрати</button>
                                            <a href="<?=APP_ROOT?>">[Начало]</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Профилът на ..... учащ в:</h3>
                </div>
                <div class="panel-body">
                    <p class="text-center" >Средно общообразователно училище</p>
                    <p class="text-center">"Добър пример"</p>
                    <p class="text-left" >град/село:Пловдив</p> <p class="text-right">район:........</p>
                    <p class="text-left">община:Пловдив</p>  <p class="text-right">област:Пловдив</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 text-right">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <p></p>
                </div>
                <div class="panel-body">
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-right">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <p></p>
                </div>
                <div class="panel-body">
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-right">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <p></p>
                </div>
                <div class="panel-body">
                    <p></p>
                </div>
            </div>
        </div>
    </div>








