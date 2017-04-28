<?php $this->title = 'Създай събитие';?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="panel-title">

                        <h2><?= htmlspecialchars($this->title) ?></h2>
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?=APP_ROOT?>">Начало</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i> <?= htmlspecialchars($_SESSION['teacherName'])?>
                        </li>
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
                            <input id="event_title" type="text" name="event_title" class="form-control">
                            <label for="event_content">Съдържание:</label>
                            <textarea id="event_content" rows="13" name="event_content" class="form-control"></textarea>
                            <button type="submit" value="Create" class="btn btn-success">Създай</button>
                            <a href="<?=APP_ROOT?>/events">[Начало]</a> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
