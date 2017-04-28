<?php $this->title = 'Редактиране на събитие';?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">
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
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-yellow">
                <div class="panel-body">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="event_title">Заглавие:</label>
                            <input id="event_title" name="event_title" type="text" name="event_title"
                                   value="<?= htmlspecialchars($this->event['Title'])?>" class="form-control">
                            <textarea id="event_content" name="event_content" rows="10" class="form-control">
                                <?=htmlspecialchars($this->event['content']) ?></textarea>
                            <label for="event_date">Дата:</label>
                            <input id="event_date" name="event_date" type="text" class="form-control"
                                   value="<?=htmlspecialchars($this->event['dateofcreate'])?>"/>
                            <label for="user_id">Автор:</label>
                            <input id="user_id" name="user_id" type="text" class="form-control"
                                   value="<?=htmlspecialchars(($this->event['TeacherID']))?>" />
                            <button type="submit" value="Edit" class="btn btn-default">Промени</button>
                            <a href="<?=APP_ROOT?>/events">[отказ]</a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

