<?php $this->title = 'Събития'; ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <h1 ><?= htmlspecialchars($this->title) ?></h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?=APP_ROOT?>">Начало</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i> <?= htmlspecialchars($this->title)?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-yellow">
            <div class="panel-body">
                <div class="table-bordered">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Заглавие</th>
                            <th>Съдържание</th>
                            <th>Дата</th>
                            <th>Автор</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->events as $event) : ?>
                            <tr>
                                <th scope="row"><?= $event['ID'] ?></th>
                                <td><?= htmlspecialchars($event['Title']) ?></td>
                                <td><?= cutLongText($event['content'],250) ?></td>
                                <td><?= htmlspecialchars($event['dateofcreate']) ?></td>
                                <td><?= $event['Fname'] ?> <?= $event['Lname'] ?></td>
                                <td><a href="<?=APP_ROOT?>/events/edit/<?=$event['ID']?> ">[Промени]</a>
                                    <a href="<?=APP_ROOT?>/events/delete/<?=$event['ID']?> ">[Изтрий]</a></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="<?=APP_ROOT?>/events/create">[Създай ново събитие]</a>
    </div>
</div>

