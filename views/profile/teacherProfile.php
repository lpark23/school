<?php $this->title = 'Учителски профил'; ?>
<div class="container-fluid" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
     xmlns="http://www.w3.org/1999/html">
    <!-- Page Heading -->
    <div class="row">
        <!-- Профилна информация плюс бутон за редакция-->
        <div class="col-lg-8 text-center" disabled="">
            <div class="panel panel-yellow"  >
                <div class="panel-heading">
                    <h2 class="panel-title">Регистрирани сте в системата, като <?=htmlspecialchars($_SESSION['positiontype'])?>
                        <br> потребителско име <?=htmlspecialchars($_SESSION['username'])?></h2>
                </div>
                <div class="panel-body" >
                    <form action="<?=APP_ROOT?>/profile/edit/<?=htmlspecialchars($this->profileby['pid'])?>" role="form" method="get">
                        <label class="hidden">
                            <input name="" value="" checked type="radio">
                        </label>
                        <button  type="submit" value="Create" class="btn btn-default">Промени</button>
                    </form>
                    <?php
                    $exstProfile = $this->profileby['pid'];
                    if (isset($exstProfile) && !isset($_GET['editpage']))
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
                </div>
            </div>
        </div>
        <!-- Панел за училището-->
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



        <!-- Класен ръководител-->
        <div class="col-lg-4 text-center">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Класен ръководител</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-inverse">
                        <thead>
                        <tr>
                            <th>На клас</th>
                            <th>За периода</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($this->teacherFormMaster) :
                            foreach ($this->teacherFormMaster as $formMaster) : ?>
                                <?php $classID = $formMaster['ClassID']; ?>
                                <tr>
                                    <td><?= htmlspecialchars($formMaster['number']) ?> -
                                        <?= htmlspecialchars($formMaster['letter']) ?></td>
                                    <td><?= htmlspecialchars($formMaster['term']) ?> -
                                        <?= htmlspecialchars($formMaster['termYear']) ?></td>
                                </tr>
                            <?php endforeach;  else:?>
                            <tr>
                                <td>Вие не сте</td>
                                <td>класен ръководител</td>
                            </tr>
                        <?php  endif;?>
                        </tbody>
                    </table>
                    <?php
                    if (!$this->teacherFormMaster) : ?>
                        <form role="form" method="post">
                            <label for="formMasterInsert">
                                <select name="formMasterInsert" class="form-control">
                                    <option > изберете клас</option>
                                    <?php foreach ($this->classWithoutFormMaster as $classAvailable) :?>
                                        <option class="dropdown-item" value="<?=$classAvailable['ClassID']?>"  >
                                            <?=htmlspecialchars($classAvailable['classNumberType'])?> -
                                            <?=htmlspecialchars($classAvailable['classLetterType'])?>
                                            за периода: <?=htmlspecialchars($classAvailable['term'])?> срок
                                            <?=htmlspecialchars($classAvailable['termYear'])?> г.</option>
                                    <?php endforeach; ?>
                                </select>
                            </label>
                            <button type="submit" value="Create" class="btn btn-default">Добави</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- Предмети, по които преподавате-->
        <div class="col-lg-4 text-center">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Предмети, по който преподавате</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-inverse">
                        <thead>
                        <tr>
                            <th>Предмет</th>
                            <th>Съкращение</th>
                            <th>Изтрий</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->subTeacher as $subjectT) : ?>
                            <tr>
                                <td><?= htmlspecialchars($subjectT['Name']) ?></td>
                                <td><p><?= htmlspecialchars($subjectT['ABB']) ?></td>
                                <form  method="post">
                                    <td>
                                        <label class="hidden">
                                            <input name="delSubject" id="deleteSubject" value="<?=$subjectT['teachID']?>" checked type="radio">
                                        </label>
                                        <button type="submit" value="index" class="btn btn-danger">изтрий</button>
                                    </td>
                                </form>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                    <form role="form" method="post">
                        <label for="subject">
                            <select name="subjectset" class="form-control">
                                <option > налични предмети</option>
                                <?php foreach ($this->subjects as $subject) :?>
                                    <option class="dropdown-item" value="<?=$subject['ID']?>"  >
                                        <?=htmlspecialchars($subject['Name'])?> -
                                        <?=htmlspecialchars($subject['ABB'])?> </option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <button type="submit" class="btn btn-default">Добави</button>
                    </form>
                </div>
            </div>
        </div>


        <!-- преподавате на-->
        <div class="col-lg-4 text-center">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Преподавате на:</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-inverse">
                        <thead>
                        <tr>
                            <th>Клас</th>
                            <th>За периода</th>
                            <th>Изтрий</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->teachingClass as $teachingClass) : ?>
                            <tr>
                                <td>
                                    <a href="<?= APP_ROOT ?>/class/index/?classletter=<?=$teachingClass['classgroupID']
                                    ?>&period=<?=$teachingClass['period']?>">погрупа <?= htmlspecialchars($classLetter)?>
                                        <?= htmlspecialchars($teachingClass['number']) ?> -
                                        <?= htmlspecialchars($teachingClass['letter']) ?>
                                </td>
                                <td><?= htmlspecialchars($teachingClass['term']) ?> -
                                    <?= htmlspecialchars($teachingClass['termYear']) ?>
                                    </a>
                                </td>

                                <form  method="post">
                                    <td>
                                        <label class="hidden">
                                            <input name="delTeaching" id="deleteTeaching" value="<?=$teachingClass['teachingID']?>" checked type="radio">
                                        </label>
                                        <button type="submit" value="index" class="btn btn-danger">изтрий</button>
                                    </td>
                                </form>

                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                    <form role="form" method="post">
                        <label for="classInsert">
                            <select name="classInsert" class="form-control">
                                <option > изберете клас</option>
                                <?php foreach ($this->classavailable as $classAvailable) :?>
                                    <option class="dropdown-item" value="<?=$classAvailable['ClassID']?>"  >
                                        <?=htmlspecialchars($classAvailable['classNumberType'])?> -
                                        <?=htmlspecialchars($classAvailable['classLetterType'])?>
                                        за периода: <?=htmlspecialchars($classAvailable['term'])?> срок
                                        <?=htmlspecialchars($classAvailable['termYear'])?> г.</option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <button type="submit" value="Create" class="btn btn-default">Добави</button>
                    </form>

                </div>
            </div>
        </div>
        <!-- отговорник на класа -->
        <div class="col-lg-4 text-center">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Изберете отговорник на класа:</h3>
                </div>
                <div class="panel-body">
                    <?php if ($this->chosenClassManager):
                        foreach ($this->chosenClassManager as $manager): ?>
                            <p><i>Отговорник на Вашият клас е  <a href="<?=APP_ROOT?>/profile/view/<?=$manager['userID']?>">  <?=htmlspecialchars($manager['Fname']) ?>
                                        <?=htmlspecialchars($manager['Lname']) ?>
                                        № <?=htmlspecialchars($manager['studentnumber']) ?></a></i></p>
                        <?php endforeach; else: ?><p><i>Няма избран отговорник</i></p>
                    <?php endif; ?>

                    <?php if (!$this->chosenClassManager):?>
                        <form role="form" method="post">
                            <label class="hidden">
                                <input name="CMclassID" value="<?=$classID?>" checked type="radio">
                            </label>
                            <label for="classManagerInsert">
                                <select name="classManagerInsert" class="form-control">
                                    <option > изберете отговорник от Вашият клас</option>
                                    <?php foreach ($this->selectClassManager as $manager) :?>
                                        <option class="dropdown-item" value="<?=$manager['StudentID']?>"  >
                                            <?=htmlspecialchars($manager['Fname'])?> -
                                            <?=htmlspecialchars($manager['Lname'])?>
                                            №: <?=htmlspecialchars($manager['studentnumber'])?></option>
                                    <?php endforeach; ?>
                                </select>
                            </label>
                            <button type="submit" value="Create" class="btn btn-default">Добави</button>
                        </form>
                    <?php endif; ?>
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

