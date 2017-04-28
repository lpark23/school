<?php $this->title = 'Всички потребители'; ?>
<!--<div id="page-wrapper">-->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-8" >
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <h3 class="panel-title">Последните регистрирали се потребителя, които чакат потвърждение за потребитеслкото име</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered"  style="font-size: 12px">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Потр.Име</th>
                            <th>парола</th>
                            <th>е-mail</th>
                            <th>Потр.Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($this->userST as $us) :
                            if (!$us['pstatus']){
                                ?>
                                <tr>
                                    <td><p><?=htmlspecialchars($us['ID']) ?></p></td>
                                    <td><p><?=htmlspecialchars($us['username']) ?></p></td>
                                    <td><p><?= cutLongText($us['password_hash'],33) ?></p></td>
                                    <td><p><?=htmlspecialchars($us['email']) ?></p></td>
                                    <form  method="post">
                                        <td><label for="ustatus">
                                                <select name="ustatus" class="form-control">
                                                    <option value="0"><?=$us['ustatus']?></option>
                                                    <option value="1">изчакване</option>
                                                    <option value="2">активиран</option>
                                                    <option value="3">забранен</option>
                                                </select>
                                            </label>
                                            <label class="hidden">
                                                <input name="useridActive" id="useridActive" value="<?=$us['ID']?>" checked type="radio">
                                            </label>
                                            <button type="submit" value="index" class="btn btn-default">Изпрати</button>
                                        </td>
                                    </form>
                                </tr>
                            <?php } endforeach;?>
                        </tbody>
                    </table>
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

        <div class="col-md-4" >
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <h3 class="panel-title">Търсене по ЕГН</h3>
                    <?php
                    if (!isset($_GET['search']) || isset($_GET['search']) ) {
                    ?>
                    <form action="<?=APP_ROOT?>/notifications/index/?search=<?php$_GET['search']?>" method="get">
                        <label for="search">
                            <input name="search" type="text" class="form-control">
                        </label>
                        <?php }?>
                        <button  type="submit" value="Create" class="btn btn-default">Намери</button>
                    </form>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered"  style="font-size: 12px">
                        <thead>
                        <tr>
                            <th>Три имена</th>
                            <th>Потр.Статус</th>
                            <th>Проф.Статус</th>
                            <th>Позиция</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($_GET['search'])){
                            foreach ($this->search as $sr) :
                                ?>
                                <tr>
                                    <td><a href="<?=APP_ROOT?>/profile/view/<?=$sr['userid']?>"/>
                                        <p><?=htmlspecialchars($sr['Fname']) ?></p>
                                        <p><?=htmlspecialchars($sr['Lname']) ?></p>
                                        <p><?=htmlspecialchars($sr['Fname']) ?></p></td>
                                    <form  method="post">
                                        <td><label for="ustatus">
                                                <select name="ustatus" class="form-control">
                                                    <option value="0"><?=$sr['ustatus']?></option>
                                                    <option value="1">изчакване</option>
                                                    <option value="2">активиран</option>
                                                    <option value="3">забранен</option>
                                                </select>
                                            </label>
                                            <label class="hidden">
                                                <input name="useridActive" id="useridActive" value="<?=$sr['userid']?>" checked type="radio">
                                            </label>
                                            <button type="submit" value="index" class="btn btn-default">Изпрати</button>
                                        </td>
                                    </form>
                                    <form method="post">
                                        <td><label for="pstatus">
                                                <select name="pstatus" class="form-control">
                                                    <option value="0"><?=$sr['pstatus']?></option>
                                                    <option value="1">изчакване</option>
                                                    <option value="2">активиран</option>
                                                    <option value="3">забранен</option>
                                                </select>
                                            </label>
                                            <label class="hidden">
                                                <input name="useridActive" id="useridActive" value="<?=$sr['userid']?>" checked type="radio">
                                            </label>
                                            <button type="submit" value="index" class="btn btn-default">Изпрати</button>
                                        </td>
                                    </form>
                                    <form method="post">
                                        <td><label for="posID">
                                                <select name="posID" class="form-control">
                                                    <option value="0"><?=htmlspecialchars($sr['type'])?></option>
                                                    <option value="1">Aдминистратор</option>
                                                    <option value="2">Ученик</option>
                                                    <option value="3">Учител</option>
                                                    <option value="4">Родител</option>
                                                </select>
                                            </label>
                                            <label class="hidden">
                                                <input name="useridActive" id="useridActive" value="<?=$sr['userid']?>" checked type="radio">
                                            </label>
                                            <label class="hidden">
                                                <input name="profileID" id="profileID" value="<?=$sr['pID']?>" checked type="radio">
                                            </label>
                                            <button type="submit" value="index" class="btn btn-default">Изпрати</button>
                                        </td>
                                    </form>
                                </tr>
                            <?php  endforeach;}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h1 class="panel-title"> <?=htmlentities($this->title)?></h1>
                </div>
                <div class="panel-body" >
                    <table class="table table-bordered"  style="font-size: 12px">
                        <thead>
                        <tr>
                            <th>Потреб.Име</th>
                            <th>Дата на създаване</th>
                            <th>Потреб.Статус</th>
                            <th>Три имена</th>
                            <th>Проф.Статут</th>
                            <th>Роден</th>
                            <th>Е-майл</th>
                            <th>ЕГН/лк.№</th>
                            <th>Позиция</th>
                            <th>Адрес</th>
                            <th>Пол</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!isset($_GET['page'])){
                            $page = 0;
                        }
                        else{
                            $page = $_GET['page'];
                        }
                        foreach ($this->profiles as $profile) : ?><tr>
                            <td><p>
                                    <?= htmlspecialchars($profile['username']) ?></p></td>
                            <td><p><?= htmlspecialchars($profile['dateofcreate']) ?></p></td>
                            <form method="post">
                                <td><label for="ustatus">
                                        <select name="ustatus" class="form-control">
                                            <option value="0"><?=$profile['ustatus']?></option>
                                            <option value="1">изчакване</option>
                                            <option value="2">активиран</option>
                                            <option value="3">забранен</option>
                                        </select>
                                    </label>
                                    <label class="hidden">
                                        <input name="useridActive" id="useridActive" value="<?=$profile['userid']?>" checked type="radio">
                                    </label>
                                    <button type="submit" value="index" class="btn btn-default">Изпрати</button>
                                </td>
                            </form>
                            <td><a href="<?=APP_ROOT?>/profile/view/<?=$profile['userid']?>"/>
                                <p><?= htmlspecialchars($profile['Fname']) ?>
                                    <?= htmlspecialchars($profile['Lname']) ?></p></td>
                            <form method="post">
                                <td><label for="pstatus">
                                        <select name="pstatus" class="form-control">
                                            <option value="0"><?=$profile['pstatus']?></option>
                                            <option value="1">изчакване</option>
                                            <option value="2">активиран</option>
                                            <option value="3">забранен</option>
                                        </select>
                                    </label>
                                    <label class="hidden">
                                        <input name="useridActive" id="useridActive" value="<?=$profile['userid']?>" checked type="radio">
                                    </label>
                                    <button type="submit" value="index" class="btn btn-default">Изпрати</button>
                                </td>
                            </form>
                            <td><?= htmlspecialchars($profile['DOB']) ?></td>
                            <td><?= htmlspecialchars($profile['email']) ?></td>
                            <td><?= htmlspecialchars($profile['egn']) ?></td>
                            <form method="post">
                                <td><label for="posID">
                                        <select name="posID" class="form-control">
                                            <option value="0"><?=htmlspecialchars($profile['type'])?></option>
                                            <option value="1">Aдминистратор</option>
                                            <option value="2">Ученик</option>
                                            <option value="3">Учител</option>
                                            <option value="4">Родител</option>
                                        </select>
                                    </label>
                                    <label class="hidden">
                                        <input name="useridActive" id="useridActive" value="<?=$profile['userid']?>" checked type="radio">
                                    </label>
                                    <label class="hidden">
                                        <input name="profileID" id="profileID" value="<?=$profile['pID']?>" checked type="radio">
                                    </label>
                                    <button type="submit" value="index" class="btn btn-default">Изпрати</button>
                                </td>
                            </form>
                            <td><?= htmlspecialchars($profile['countryName'])?>
                                гр.<?= htmlspecialchars($profile['cityName'])?>
                                улица:<?= htmlspecialchars($profile['streetName']) ?></td>
                            <td><?= $profile['gender'] ?></td>
                            </tr>
                        <?php endforeach;
                        if ($page > 0){ $p = $page -1; ?>
                            <a href="<?=APP_ROOT?>/notifications/index/?page=<?=$p?>" class="-align-center">BACK</a>
                        <?php } $page++;
                        $asd = $_SESSION['asd'];
                        $ass = $_SESSION['ass'];
                        if ($asd<$ass){?>
                            <a href="<?=APP_ROOT?>/notifications/index/?page=<?=$page?>" class="-align-center">NEXT</a>
                        <?php }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
