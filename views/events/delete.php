<?php $this->title = 'Изтриване на събитие';?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h1 class="page-header"><?= htmlspecialchars($this->title) ?></h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>  <a href="<?=APP_ROOT?>">Начало</a>
                            </li>
                            <li>
                                <i class="fa fa-coffee"></i>  <a href="<?=APP_ROOT?>/events">[събития]</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> <?= htmlspecialchars($this->title)?>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-yellow">
                <div class="panel-body">
                    <form role="form" method="post">
                    <div class="form-group">
                        <label for="event_title">Заглавие:</label>
                        <input id="event_title" name="event_title" type="text" disabled
                               value="<?= htmlspecialchars($this->event['Title'])?>" class="form-control">
                        <label for="event_content">Съдържание:</label>
                        <textarea id="event_content" name="event_content" rows="10" class="form-control"
                                  disabled><?=htmlspecialchars($this->event['content'])?></textarea>
                        <label for="dateofcreate">Дата:</label>
                        <input id="dateofcreate" name="dateofcreate" type="text" class="form-control"
                               value="<?=htmlspecialchars($this->event['dateofcreate'])?>" disabled/>
                        <label for="event_TeacherID">Автор:</label>
                        <input id="event_TeacherID" name="event_TeacherID" type="text" class="form-control"
                               value="<?=htmlspecialchars(($this->event['TeacherID']))?>" disabled/>
                        <button type="submit" value="Delete" class="btn btn-default">Изтрий</button>
                        <a href="<?=APP_ROOT?>/events">[отказ]</a> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>