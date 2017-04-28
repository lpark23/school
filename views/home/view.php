<?php $this->title = 'Събитие';?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= htmlspecialchars($this->title) ?></h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>  <a href="<?=APP_ROOT?>">Начало</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> <?= htmlspecialchars($this->title) ?>
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <h3 class="panel-title"><?=htmlspecialchars($this->title)?></h3>
                </div>
                <div class="panel-body">
                    <p>
                        <i>Създадено на</i>
                        <?=htmlentities($this->event['dateofcreate'])?>
                        <i>,чиито автор е</i>
                        <?=htmlentities($this->event['Fname'])?></p>
                    <p> <?=$this->event['content']?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->





