<?php $this->title = 'Потребители'; ?>
<!--<div id="page-wrapper">-->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?= APP_ROOT ?>/users">Потребители</a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li>
                                <form action="<?=APP_ROOT?>/users/index/" role="form" method="get">
                                    <div class="form-inline">
                                        <label for="position">
                                            <select name="position" class="form-control">
                                                <option value=""  > тип потребител</option>
                                                <?php foreach ($this->getposition as $getposition) :?>
                                                    <option value="<?=$getposition['ID']?>" class="dropdown-item" >
                                                        <?=htmlspecialchars($getposition['type'])?>  </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </label>
                                        <button type="submit" value="Create" class="btn btn-default">Избери</button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-yellow" >
                <div class="panel-heading" >

                </div>
                <div class="panel-body">
                    <?php if ((isset($_GET['position']))){
                    if ($_GET['position'] != $_SESSION['positionID'] ) {
                        $this->addErrorMessage("нямате достатъчно права");
                        $this->redirectToUrl("../");
                    }
                    if($_GET['position'] >= 5 ){
                        $this->addErrorMessage("няма такава страница");
                        $this->redirectToUrl("../");
                    }
                    if($_GET['position'] == 2 ){?>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>userName</th>
                                    <th>име</th>
                                    <th>позиция</th>
                                    <th>Телефон</th>
                                    <th>адрес</th>
                                    <th>класен ръководител</th>
                                    <th>учи в </th>
                                    <th>предмети</th>
                                    <th>оценки</th>
                                </tr>
                                </thead>
                                <?php
                                foreach ($this->studentsinfo as $studentinfo) :
                                    $personid = $studentinfo['PersonID'];
                                    $this->Subjects = $this->model->getSubjects();
                                    ?>
                                    <tbody>
                                    <td><?=htmlspecialchars($studentinfo['username'])?></td>
                                    <td><a href="<?=APP_ROOT?>/profile/view/<?=$studentinfo['UserID']?>" >
                                            <?=htmlspecialchars($studentinfo['Fname'])?>
                                            <?=htmlspecialchars($studentinfo['Lname'])?>
                                        </a>
                                    </td>
                                    <td><?=htmlspecialchars($studentinfo['positionType'])?></td>
                                    <td><?=htmlspecialchars($studentinfo['PhoneN'])?></td>
                                    <td><?=htmlspecialchars($studentinfo['cityName'])?>
                                        <?= $studentinfo['streetName']?></td>
                                    <td><?=htmlspecialchars($studentinfo['teacherFname'])?>
                                        <?=htmlspecialchars($studentinfo['teacherLname'])?></td>
                                    <td><?=htmlspecialchars($studentinfo['numberType'])?>
                                        <?=htmlspecialchars($studentinfo['letterType'])?> клас.</td>
                                    <td>
                                        <?php
                                        if (!isset($_GET['subject'])) {
                                            ?>
                                            <form  method="get">
                                                <label class="hidden">
                                                    <input name="position" value="<?=$studentinfo['PositionID']?>" checked type="radio">
                                                </label>
                                                <label for="subject">
                                                    <select name="subject" class="form-control">
                                                        <?php
                                                        foreach ($this->Subjects as $subjectinfo) :
                                                            $subjectID = $subjectinfo['ID'];
                                                            ?>
                                                            <option value="<?=$subjectID?>"><?=htmlspecialchars($subjectinfo['Name'])?></option>
                                                        <?php  endforeach;?> </select>
                                                </label>
                                                <button type="submit" value="index" class="btn btn-default">Изпрати</button>
                                            </form>
                                            <?php
                                        }
                                        if (isset($_GET['subject'])){
                                        $subjectid = $_GET['subject'];
                                        $subject  = $this->model->getSubjectBy($subjectid);
                                        $evaluationsubjectID =  $subject['ID'];
                                        $this->evaluation = $this->model->getStudEvaluationBy($personid, $evaluationsubjectID );
                                        ?>
                                        <a href="<?=APP_ROOT?>/users/index/?position=<?=$studentinfo['PositionID']?>">
                                        <?=htmlspecialchars($subject['Name'])?></td>
                                    </a>
                                    <td>
                                        <label for="evaluation">
                                            <select name="evaluation" class="form-control">
                                                <?php
                                                foreach ($this->evaluation as $evaluation) :
                                                    ?>
                                                    <option value=""><?=htmlspecialchars($evaluation['exammark'])?> от дата
                                                        <?=htmlspecialchars($evaluation['examdate'])?></option>
                                                <?php  endforeach;?> </select>
                                        </label>
                                    </td>
                                    <?php }?>
                                    </tbody>
                                <?php endforeach;
                                ?>
                                <?php
                                }?>
                            </table>
                        </div>
                    </div>
                    <?php
                    if($_GET['position'] == 4 ){
                        $this->parents = $this->model->getAllParents();
                    }
                    ?>
                    <?php
                    if($_GET['position'] == 3 ){ ?>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>userName</th>
                                    <th>име</th>
                                    <th>позиция</th>
                                    <th>Телефон</th>
                                    <th>град</th>
                                    <th>преподава на</th>
                                    <th>преподава по</th>
                                </tr>
                                </thead>
                                <?php
                                foreach ($this->teachers as $teacher):
                                    $teacheruid = $teacher['UserID'];
                                    $teacherpid = $teacher['PersonID'];
                                    $teachertid = $teacher['TeacherID'];
                                    $teacherUsername = $teacher['username'];
                                    $teacherposition = $teacher['positionType'];
                                    $phoneN = $teacher['PhoneN'];
                                    $teacherfname = $teacher['Fname'];
                                    $teacherlname = $teacher['Lname'];
                                    $this->teacherClass = $this->model->getTecherClassBy($teachertid);
                                    $this->teacherSubjects = $this->model->getTecherSubjectBy($teachertid);
                                    $this->teacherUserID = $this->model->getUserBy($teacherpid);?>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <?=htmlspecialchars($teacherUsername)?>
                                        </td>
                                        <td><a href="<?=APP_ROOT?>/profile/view/<?=$teacheruid?>">
                                                <?=htmlspecialchars($teacherfname)?> <?=htmlspecialchars($teacherlname)?>
                                            </a>
                                        </td>
                                        <td><?=htmlspecialchars($teacherposition)?></td>
                                        <td><?=htmlspecialchars($phoneN)?> </td>
                                        <td><?=htmlspecialchars($teacher['city'])?> </td>
                                        <td><label for="teacherClass">
                                                <select name="teacherClass" class="form-control">
                                                    <?php foreach ($this->teacherClass as $teacherclass) : ?>
                                                        <option value=""><?=$teacherclass['classterm']?> срок на <?=$teacherclass['classtermYear']?> г.
                                                            На <?=$teacherclass['classNumberType']?><?=$teacherclass['classLetterType']?> клас</option>
                                                    <?php endforeach;?>
                                                    <?=htmlspecialchars($this->teacherUserID['username'])?>
                                                </select>
                                            </label>
                                        </td>
                                        <td><label for="teacherSubject">
                                                <select name="teacherSubject" class="form-control">
                                                    <?php foreach ($this->teacherSubjects as $teacherSubject) : ?>
                                                        <option value=""><?=$teacherSubject['ABB']?> __ <?=$teacherSubject['Name']?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </label>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <?php
                                endforeach;
                                }

                                ?>
                            </table>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
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
                        <h3 class="panel-title">Най-скорошни събития</h3>
                        <!-- s edin foreach wvimamem kvoto ni e nujno -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

