<?php $this->title = 'Родителски профил за попълване'; ?>
<!--<div id="page-wrapper">-->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-8 text-center" >
            <div class="panel panel-yellow" >
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
                                                    <option value=""  class="dropdown-item" ><i><?=htmlspecialchars($this->profileby['gender'])?></i></option>
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

        <div class="col-md-4">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title"> <?= htmlspecialchars($this->title) ?> </h3>
                </div>
                <div class="panel-body">
                    <p class="text-center" ><?= htmlspecialchars($this->school['name']) ?> </p>
                    <p class="text-left" >Държава: <?= htmlspecialchars($this->school['countryName']) ?> </p>
                    <p class="text-center" >град/село: <?= htmlspecialchars($this->school['cityName']) ?></p>
                    <p class="text-right">улица:  <?= htmlspecialchars($this->school['streetName']) ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <h3 class="panel-title">Търсене по ЕГН</h3>
                    <?php
                    if (!isset($_GET['search']) || isset($_GET['search']) ) {

                    ?>
                    <form action="<?=APP_ROOT?>/profile/parentProfile/<?=$this->profileby['parentID']?>?search=<?php$_GET['search']?>" method="get">
                        <label for="search">
                            <input name="search" type="text" class="form-control">
                        </label>
                        <?php }?>
                        <button  type="submit" value="Create" class="btn btn-default">Намери</button>
                    </form>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Три имена</th>
                            <th>Тип родител</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php
                            if (isset($_GET['search'] )){

                            foreach ($this->search as $sr) :
                            ?>
                            <td><a href="<?=APP_ROOT?>/profile/view/<?=$sr['userID']?>">
                                    <p><?=htmlspecialchars($sr['Fname']) ?></p>
                                    <p><?=htmlspecialchars($sr['Mname']) ?></p>
                                    <p><?=htmlspecialchars($sr['Lname']) ?></p>
                                </a>
                            </td>
                            <td>
                                <form  method="post">
                                    <label for="parentStudentType">
                                        <select name="parentStudenType" class="form-control">
                                            <option value="0">избери</option>
                                            <option value="майка">Вие сте майка</option>
                                            <option value="баща">Вие сте баща</option>
                                            <option value="брат">Вие сте брат</option>
                                            <option value="сестра">Вие сте сестра</option>
                                        </select>
                                    </label>
                                    <label class="hidden">
                                        <input name="studentID" id="studentID" value="<?=$sr['studID']?>" checked type="radio">
                                    </label>
                                    <label class="hidden">
                                        <input name="parentID" id="parentID" value="<?=$this->profileby['parentID']?>" checked type="radio">
                                    </label>
                                    <button type="submit" value="index" class="btn btn-default">Изпрати</button>
                                    <p><b>ЕГН/л.к.№:</b> <?=htmlspecialchars($sr['egn']) ?></p>
                                </form>
                            </td>
                        </tr>
                        <?php  endforeach;}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <h3 class="panel-title">Вие сте <?=$this->profileby['parentType']?> на</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered"  style="font-size: 12px">
                        <thead>
                        <tr>
                            <th>Три имена</th>
                            <th>Клас</th>
                            <th>Учебен период</th>
                            <th>Предмет</th>
                            <th>Оценки</th>
                            <th>Дейност</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($this->kids as $kid) :
                            ?>
                            <tr>
                                <td><a href="<?=APP_ROOT?>/profile/view/<?=$kid['userid']?>">
                                        <p><?=htmlspecialchars($kid['personStudentFname']) ?></p>
                                        <p><?=htmlspecialchars($kid['personStudentMname']) ?></p>
                                        <p><?=htmlspecialchars($kid['personStudentLname']) ?></p>
                                    </>
                                </td>
                                <td>
                                    <p><?=htmlspecialchars($kid['numberType']) ?></p>
                                    <p><?=htmlspecialchars($kid['letterType']) ?></p>
                                </td> <!-- клас -->
                                <td>
                                    <p><?=htmlspecialchars($kid['term']) ?></p>
                                    <p><?=htmlspecialchars($kid['termyear']) ?></p>
                                </td> <!-- Учебен период-->
                                <td>
                                    <?php
                                    $Subjects = $this->model->getSubjects($kid['personStudentID']);

                                    if (!isset($_GET['subject'])){
                                        ?>
                                        <form action="<?=APP_ROOT?>/profile/parentProfile/<?=$this->profileby['parentID']?>?subject=<?php$_GET['subject']?>"  method="get">
                                            <label for="subject">
                                                <select name="subject" class="form-control">
                                                    <?php
                                                    foreach ($Subjects as $subjectinfo) :
                                                        $subjectID = $subjectinfo['subid'];
                                                        ?>
                                                        <option value="<?=$subjectID?>"><?=htmlspecialchars($subjectinfo['subname'])?></option>
                                                    <?php  endforeach;?>
                                                </select>
                                            </label>
                                            <button  type="submit" value="Create" class="btn btn-default">Намери</button>
                                        </form>
                                        <?php
                                    }
                                    else{
                                        $subject = $this->model->getSubjectBy($_GET['subject'])
                                        ?>
                                        <a href="<?=APP_ROOT?>/profile/parentProfile">
                                            <p><?=$subject['Name']?></p>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (isset($_GET['subject'])){
                                        $evaluations = $this->model->getStudEvaluationBy($kid['personStudentID'], $_GET['subject']);
                                        ?>
                                        <label for="evaluation">
                                            <select name="evaluation" class="form-control">
                                                <?php
                                                foreach ($evaluations as $evaluation) :
                                                    ?>
                                                    <option value=""><?=htmlspecialchars($evaluation['exammark'])?> от дата
                                                        <?=htmlspecialchars($evaluation['examdate'])?></option>
                                                <?php  endforeach;?> </select>
                                        </label>
                                        <?php
                                    }?>
                                </td>
                                <td>
                                    <form method="post">
                                        <label class="hidden">
                                            <input name="delFamilyConn" id="delFamilyConn" value="<?=$kid['famID']?>" checked type="radio">
                                        </label>
                                        <button type="submit" value="index" class="btn btn-danger">изтрий</button>
                                    </form>
                                </td>
                            </tr>
                        <?php  endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
