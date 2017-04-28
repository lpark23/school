<?php $this->title = 'Класове'; ?>

<!--<div id="page-wrapper">-->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?= APP_ROOT ?>/class">Класове</a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <?php
                            if  (isset($_GET['availablePeriod'])){
                                $period = $_GET['availablePeriod'];
                                foreach ($this->classByNumber as $classNumber){
                                    ?>
                                    <li class="dropdown">
                                        <a href="<?= APP_ROOT ?>/class/index/?class=<?=$classNumber['classnumberID']?>" class="dropdown-toggle"
                                           data-toggle="dropdown"> <?= htmlspecialchars($classNumber['classNumberType'])?> клас </a>
                                        <ul class="dropdown-menu">
                                            <?php
                                            $clletter = $this->model->classLetterByNumber($classNumber['classnumberID']);
                                            foreach ( $clletter as $classLetter){
                                                ?>
                                                <li>
                                                    <a href="<?= APP_ROOT ?>/class/index/?classletter=<?=$classLetter['grpID']?>&period=<?=$period?>">погрупа
                                                        <?= htmlspecialchars($classLetter['classLetterType'])?> </a>
                                                </li>
                                                <?php
                                            }?>
                                        </ul>
                                    </li>
                                    <?php
                                }
                            }?>
                        </ul>

                        <ul class="nav navbar-nav">
                            <li>
                                <form action="<?=APP_ROOT?>/class/index/?availablePeriod=" role="form" method="get">
                                    <div class="form-inline">
                                        <label for="availablePeriod">
                                            <select name="availablePeriod" class="form-control">
                                                <option value=""  > налични периоди</option>
                                                <?php foreach ($this->studyperiod as $term) :?>
                                                    <option value="<?=$term['studyPeriodID']?>" class="dropdown-item" >
                                                        <?=htmlspecialchars($term['term'])?> -
                                                        <?=htmlspecialchars($term['termYear'])?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </label>
                                        <button type="submit" value="Create" class="btn btn-default">Изпрати</button>
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
                    <?php
                    if ((isset($_GET['classletter']) && isset($_GET['period']))  || isset($_GET['sub']) ){
                    ?>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>име</th>
                                    <th>№</th>
                                    <th>оценка по</th>
                                    <th>оценка</th>
                                    <th>присъстрие по</th>
                                    <th>бр.</th>
                                    <th>остават</th>
                                </tr>
                                </thead>
                                <?php foreach ($this->students as $student):
                                $TeacherID = $_SESSION['teacherID'];
                                $personid = $student['PersonID'];
                                $studentid = $student['studentID'];
                                $studentfname = $student['Fname'];
                                $studentlname = $student['Lname'];
                                $studentclassid = $student['ClassID'];
                                $studentperiod = $student['studyPeriodID'];
                                $studentclassgrp = $student['classgroupID'];
                                $studentSubjects = $this->model->getStudentSubjects($personid);
                                ?>
                                <tbody>
                                <tr>
                                    <?php
                                    if (!isset($_GET['subject'])) {
                                        ?>
                                        <td><a href="<?=APP_ROOT?>/profile/view/<?=$student['userID']?>" >
                                                <?= htmlspecialchars($studentfname) ?>
                                                <?= htmlspecialchars($studentlname) ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($student['studentnumber']) ?>
                                        </td>

                                        <td>
                                            <form  method="get">
                                                <label class="hidden">
                                                    <input name="student" value="<?=$studentid?>" checked type="radio">
                                                </label>
                                                <label for="subject">
                                                    <select name="subject" class="form-control">
                                                        <?php
                                                        if (isset($_SESSION['teacherID'])){
                                                            foreach ($this->teachercon as $teachercon) :
                                                                $subjectID = $teachercon['SubjectID'];
                                                                ?>
                                                                <option value="<?=$subjectID?>"><?=htmlspecialchars($teachercon['Name'])?></option>
                                                            <?php  endforeach;
                                                        } else{
                                                            foreach ($studentSubjects as $studsub) :
                                                                $subjectID = $studsub['subjectID'];
                                                                ?>
                                                                <option value="<?=$subjectID?>"><?=htmlspecialchars($studsub['subName'])?></option>
                                                                <?php
                                                            endforeach;
                                                        }
                                                        ?>
                                                    </select>
                                                </label>
                                                <button type="submit" value="index" class="btn btn-default">Изпрати</button>
                                        </td>
                                        </form>
                                        <?php
                                    }

                                    ?>
                                </tr>
                                <?php
                                endforeach;

                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <?php
                    if ((isset($_GET['student']) && isset($_GET['subject'])) || ( isset($_GET['edit']) && isset($_GET['evaluation'])) ){ ?>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Ученик</th>
                                    <th>№</th>
                                    <th>оценка по</th>
                                    <th>оценка</th>
                                    <th>Добави/Промени</th>
                                    <th>Преподавтел</th>
                                    <th>Среден успех</th>
                                    <th>присъстрие по</th>
                                    <th>бр.</th>
                                    <th>остават</th>
                                </tr>
                                </thead>
                                <?php
                                foreach ($this->studentbyid as $studentid) :
                                    $TeacherID = $_SESSION['teacherID'];
                                    $studentID = $studentid['PersonID'];
                                    $studentGET = $_GET['student'];
                                    $subjectGET = $_GET['subject'];
                                    $clasgrp = $this->HomeClass['classgroupID'];
                                    $period = $this->HomeClass['studyPeriodID'];
                                    $studentuserid = $studentid['userID'];
                                    $avgmark = 0;
                                    ?>
                                    <td><a href="<?=APP_ROOT?>/profile/view/<?=$studentuserid?>">
                                            <?=htmlspecialchars($studentid['Fname'])?>
                                            <?=htmlspecialchars($studentid['Lname'])?>
                                        </a>
                                    </td>
                                    <td>
                                        <?=htmlspecialchars($studentid['studentnumber'])?>
                                    </td>
                                    <td>
                                        <a href="<?=APP_ROOT?>/class/index/?classletter=<?=$clasgrp?>&period=<?=$period?>" >
                                            <?=htmlspecialchars($this->subjects['Name'])?></a>
                                    </td>
                                    <?php
                                    if (!isset($_GET['evaluation']) && !isset($_GET['edit'])){
                                        ?>
                                        <td>
                                            <form  method="get">
                                                <label for="evaluation">
                                                    <label class="hidden">
                                                        <input name="student" id="student" value="<?=$studentGET?>" checked type="radio">
                                                    </label>
                                                    <label class="hidden">
                                                        <input name="subject" id="subject" value="<?=$subjectGET?>" checked type="radio">
                                                    </label>

                                                    <select name="evaluation" class="form-control">
                                                        <?php
                                                        foreach ($this->studentmarks as $studentMarks) :
                                                            $studentMarkID = $studentMarks['ID'];
                                                            $mark = $studentMarks['exammark'];
                                                            $avgmark += $mark;
                                                            ?>
                                                            <option value="<?=$studentMarkID?>">
                                                                <?=htmlspecialchars($studentMarks['exammark'])?> -
                                                                <?=htmlspecialchars($studentMarks['examdate'])?>
                                                            </option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                    <label class="hidden">
                                                        <input name="edit" id="edit" value="" checked type="radio">
                                                    </label>
                                                </label>
                                                <?php if (isset($_SESSION['teacherID'])) { ?>
                                                    <button type="submit" value="index" class="btn btn-default">промени</button>
                                                <?php }
                                                else {?>
                                                    <button type="submit" value="index" class="btn btn-default" disabled>промени</button>
                                                <?php }?>
                                            </form>
                                        </td>

                                        <form  method="post">
                                            <td>
                                                <label for="evaluation">
                                                    <label class="hidden">
                                                        <input name="student" id="student" value="<?=$studentGET?>" checked type="radio">
                                                    </label>
                                                    <label class="hidden">
                                                        <input name="subject" id="subject" value="<?=$subjectGET?>" checked type="radio">
                                                    </label>

                                                    <select name="evaluation" class="form-control">
                                                        <?php
                                                        for ($i=0;$i<=10;$i++){
                                                            ?>
                                                            <option value="<?=$i;?>"><?=$i?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </label>
                                                <label class="hidden">
                                                    <input name="teacher" id="edit" value="<?=$TeacherID?>" checked type="radio">
                                                </label>
                                                <?php if (isset($_SESSION['teacherID'])) { ?>
                                                    <button type="submit" value="index" class="btn btn-default">Добави</button>
                                                <?php }
                                                else {?>
                                                    <button type="submit" value="index" class="btn btn-default" disabled>Добави</button>
                                                <?php }?>

                                            </td>
                                        </form>

                                        <td>
                                            <?=htmlspecialchars($this->teacherBySubject['Fname'])?>
                                        </td>
                                        <td>
                                            <?= round($avgmark/count($this->studentmarks), 2, PHP_ROUND_HALF_DOWN)?>
                                        </td>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if (isset($_GET['evaluation']) && isset($_GET['edit'])) :

                                        ?>
                                        <td>
                                            <?=htmlspecialchars($this->examMarkID['exammark'])?>
                                        </td>

                                        <form method="post">
                                            <label class="hidden">
                                                <input name="MarkIDdelete" id="" value="<?=$_GET['evaluation']?>" checked
                                                       type="radio">
                                            </label>
                                            <td>
                                                <button type="submit" value="index" class="btn-danger">изтрий
                                                </button>
                                        </form>

                                        <form  method="post">
                                            <label for="editmark">
                                                <label class="hidden">
                                                    <input name="MarkID" id="student" value="<?=$_GET['evaluation']?>" checked type="radio">
                                                </label>
                                                <select name="editmark" class="form-control">
                                                    <?php
                                                    for ($i=0;$i<=10;$i++){
                                                        ?>
                                                        <option value="<?=$i;?>"><?=$i?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </label>

                                            <button type="submit" value="index" class="btn-warning">Промени</button>

                                        </form>
                                        </td>
                                    <?php endif;
                                endforeach;
                                }

                                ?>
                            </table>
                        </div>
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
                        <h3 class="panel-title">Най-скорошни събития</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

