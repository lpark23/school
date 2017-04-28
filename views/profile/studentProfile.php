<?php $this->title = 'Ученически профил'; ?>
<div class="container-fluid" >
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-8 text-center" disabled="">
            <div class="panel panel-yellow"  >
                <div class="panel-heading">
                    <h2 class="panel-title">Регистрирани сте в системата, като <?=htmlspecialchars($_SESSION['positiontype'])?>
                        <br> потребителско име <?=htmlspecialchars($_SESSION['username'])?></h2>
                </div>
                <div class="panel-body" >
                    <form action="<?=APP_ROOT?>/profile/edit/<?=htmlspecialchars($this->profileby['pid'])?>" role="form" method="get">

                        <button  type="submit" value="Create" class="btn btn-default">Промени</button>
                    </form>
                    <?php
                    $exstProfile = $this->profileby['pid'];
                    if (isset($exstProfile))
                    :?>
                    <fieldset disabled>
                        <form role="form" method="post">
                            <?php endif;
                            ?>
                            <div class="row">
                                <div class="col-sm-6 text-left" >
                                    <div class="panel panel-yellow" >
                                        <div class="panel-body" >
                                            <label for="person_fname" >
                                                <input id="person_fname" type="text" name="person_fname"
                                                       value="<?=htmlspecialchars($this->profileby['Fname'])?>"  class="form-control">
                                                <i >Първото Ви име е....</i>
                                            </label>
                                            <label for="person_mname">
                                                <input id="person_mname" type="text" name="person_mname"
                                                       value="<?=htmlspecialchars($this->profileby['Mname'])?>" class="form-control">
                                                <i >Врото Ви име.....</i>
                                            </label>
                                            <label for="person_lname">
                                                <input id="person_lname" type="text" name="person_lname"
                                                       value="<?=htmlspecialchars($this->profileby['Lname'])?>"  class="form-control">
                                                <i >И третото :)......</i>
                                            </label>
                                            <label for="person_date" ><i >Роден сте на ?....</i>
                                                <input id="person_date" class="form-control; datepicker" type="text"
                                                       value="<?=htmlspecialchars($this->profileby['DOB'])?>" name="person_date" readonly>

                                            </label>
                                            <label for="egn">
                                                <input id="egn" type="text" name="egn"
                                                       value="<?=htmlspecialchars($this->profileby['egn'])?>" class="form-control">
                                                <i >ЕГН или номер по лична карта</i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-left">
                                    <div class="panel panel-yellow">
                                        <div class="panel-body">
                                            <label for="country">
                                                <input id="country" type="text" name="country"
                                                       value="<?=htmlspecialchars($this->profileby['countryName'])?>" class="form-control">
                                                <i>От коя държава сте?</i>
                                            </label>
                                            <label for="city">
                                                <input id="city" type="text" name="city"
                                                       value="<?=htmlspecialchars($this->profileby['cityName'])?>" class="form-control">
                                                <i>Град или село....</i>
                                            </label>
                                            <label for="street" class="lin">
                                                <input id="street" type="text" name="street"
                                                       value="<?=htmlspecialchars($this->profileby['streetName'])?>"  class="form-control">
                                                <i>Адресът, на който живеете</i>
                                            </label>
                                            <label for="gender">
                                                <select name="gender" class="form-control">
                                                    <option value="value="<?=htmlspecialchars($this->profileby['gender'])?>" " class="dropdown-item" ><i>пол</i></option>
                                                    <option value="1" class="dropdown-item" >мъж</option>
                                                    <option value="2" class="dropdown-item" >жена</option>
                                                </select>
                                            </label>
                                            <label for="phonenumber">
                                                <input id="phonenumber" type="text" name="phonenumber"
                                                       value="<?=htmlspecialchars($this->profileby['PhoneN'])?>"  class="form-control">
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
                    <?php  ?>
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
        <div class="col-lg-4 text-center">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Клас</h3>
                </div>
                <div class="panel-body">
                    <?php $checkPosition = $this->profileby['SClassID'];
                    if (($checkPosition)) :?>
                    <fieldset disabled>
                        <?php endif;?>

                        <form role="form" method="post">
                            <label for="availableClass">
                                <select name="classgroup"  class="form-control" >
                                    <option value=""  > налични класове:</option>
                                    <?php foreach ($this->classgroup as $classg) :
                                        $classgrID = $classg['ID'];
                                        ?>
                                        <option value="<?=$classgrID?>" class="dropdown-item" >
                                            <?=htmlspecialchars($classg['number'])?>-<?= htmlspecialchars($classg['letter'])?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </label>
                            <label for="availablePeriod">
                                <select name="period" class="form-control">
                                    <option value=""  > налични периоди</option>
                                    <?php foreach ($this->studyperiod as $term) :
                                        $termID = $term['ID']?>
                                        <option value="<?=$termID?>" class="dropdown-item" >
                                            <?=htmlspecialchars($term['term'])?> -
                                            <?=htmlspecialchars($term['termYear'])?> </option>
                                    <?php endforeach; ?>
                                    ?>
                                </select>
                            </label>
                            <div class="panel-body text-center">
                                <div class="col-sm-6 ">
                                    <div class="panel panel-yellow">
                                        <i>№ в клас</i>
                                        <label for="stNumber" class="col-sm-6 ">
                                            <input id="stNumber" type="text" name="stNumber" class="form-control">
                                            <button type="submit" value="Create" class="btn btn-default">Изпрати</button>
                                            <a href="<?=APP_ROOT?>">[Начало]</a>
                                    </div>
                                </div>
                            </div>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Родители</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Име</th>
                            <th>Роднинска Връзка</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php
                            foreach ($this->parents as $parent) :
                                ?>
                                <td><a href="<?=APP_ROOT?>/profile/view/<?=$parent['parentUserID']?>">
                                        <p><?=htmlspecialchars($parent['parentFname']) ?>
                                        <?=htmlspecialchars($parent['parentLname']) ?></p>
                                    </a>
                                </td>
                                <td>
                                    <p><b> <?=htmlspecialchars($parent['type']) ?> </b></p>
                                </td>
                            <?php  endforeach;?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Профилна снимка</h3>
                </div>
                <div class="panel-body">
                    <form  method="post" enctype="multipart/form-data">
                        Select image to upload:
                        <input type="file" name="image" id="image">
                        <input type="submit" value="Upload Image" name="upload">
                    </form>
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

