<?php $this->title = 'Добре дошли'; ?>

<!--<div id="page-wrapper">-->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-yellow" >
                <?php foreach ($this->events as $event) : ?>
                    <div class="panel-heading">
                        <h1 class="panel-title"> <?=htmlentities($event['Title'])?></h1>
                    </div>
                    <div class="panel-body">
                        <p>
                            <i>Create on</i>
                            <?=htmlentities($event['dateofcreate'])?>
                            <i>by</i>
                            <?=htmlentities($event['Fname'])?></p>
                        <p> <?=$event['content']?></p>
                    </div>
                <?php endforeach ?>
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
                    <?php foreach ($this->eventsSidebar as $event) : ?>
                    <a href="<?=APP_ROOT?>/home/view/<?=$event['ID']?>">
                        <div class="panel-body">
                        <?=htmlentities($event['Title'])?></a>
                    <p><?=htmlentities($event['dateofcreate'])?></p>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
