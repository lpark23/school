<?php $this->title = 'Изтрий профил'; ?>
<div class="container-fluid" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <!-- Page Heading -->
    <div class="row">
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
        <div class="col-lg-8 text-center">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Данни на ученика  </h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <div class="form-inline">
                            <label for="person_fname">Първото Ви име е:</label>
                            <input id="person_fname" type="text" name="person_fname"  class="form-control" disabled>
                            <label for="person_mname">,второто:</label>
                            <input id="person_mname" type="text" name="person_mname" class="form-control" disabled>
                            <label for="person_lname"> и третото:</label>
                            <input id="person_lname" type="text" name="person_lname" class="form-control" disabled>
                            <label for="person_date" >Рожден ден:</label>
                            <input id="person_date" class="form-control; datepicker" type="text" name="person_date" readonly>
                            <label for="egn">ЕГН/лк.№:</label>
                            <input id="egn" type="text" name="egn" class="form-control">
                            <label for="country">Държава:</label>
                            <input id="country" type="text" name="country" class="form-control">
                            <label for="city">Град/село:</label>
                            <input id="city" type="text" name="city" class="form-control">
                            <label for="street" class="lin">    Улица:</label>
                            <input id="street" type="text" name="street" class="form-control">
                            <label for="gender">
                                <select name="gender">
                                    <option value="" class="dropdown-item" > пол</option>
                                    <option value="1" class="dropdown-item" >мъж</option>
                                    <option value="2" class="dropdown-item" >жена</option>
                                </select>
                            </label>

                            <label for="position">
                                <select name="position">
                                    <option value="" class="dropdown-item" > тип потребител</option>
                                    <option value="2" class="dropdown-item" >учиник</option>
                                    <option value="3" class="dropdown-item" >учител</option>
                                    <option value="4" class="dropdown-item" >родител</option>

                                </select>
                            </label>
                            <label for="phonenumber">Телефон за връзка:</label>
                            <input id="phonenumber" type="text" name="phonenumber" class="form-control">



                            <button type="submit" value="Delete" class="btn btn-default">Изтрий</button>

                            <a href="<?=APP_ROOT?>">[Начало]</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>


    <div class="row">
        <div class="col-lg-4 text-center">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Профилна снимка</h3>
                </div>
                <div class="panel-body">
                    <a href="<?=APP_ROOT?>/content/profileImages/<?=$this->profileby['Mname'] ?>.jpg">
                        <img src="<?=APP_ROOT?>/content/profileImages/<?=$this->profileby['Mname'] ?>.jpg"
                             class="img-circle" alt="Cinque Terre" width="250" height="236">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Клас</h3>
                </div>
                <div class="panel-body">


                </div>
            </div>
        </div>


        <div class="col-lg-4 text-center">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Родители</h3>
                </div>
                <div class="panel-body">


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








