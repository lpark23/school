<?php $this->title = 'Профил'; ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <?php
        $proPositionID = $this->profilePosition['positionID'];
        if ($proPositionID == 1){
            ?>
            <div class="col-lg-8 text-center">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <h3 class="panel-title">Данни за ученика с потребителско
                            име: <?= htmlspecialchars($this->personprofile['username']) ?> </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-4 text-center">
                            <div class="panel panel-yellow" style="width: 90%; height: 90%">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Профилна снимка</h3>
                                </div>
                                <div class="panel-body">
                                    <a href="<?= APP_ROOT ?>/content/profileImages/avatar.jpg">
                                        <img src="<?= APP_ROOT ?>/content/profileImages/avatar.jpg"
                                             class="img-circle" alt="" style="width: 100%; height: 90%">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-left">
                            <div class="panel-body">
                                <p><b>Трите ви имена:</b><i><?= htmlspecialchars($this->personprofile['Fname']) ?>
                                        <?= htmlspecialchars($this->personprofile['Mname']) ?>
                                        <?= htmlspecialchars($this->personprofile['Lname']) ?></i></p>
                                <p><b>ЕГН/л.к.№:</b><i><?= htmlspecialchars($this->personprofile['egn']) ?></i></p>
                                <p><b>Пол:</b><i><?= htmlspecialchars($this->personprofile['gender']) ?></i></p>
                                <p><b>E-mail</b><i><?= htmlspecialchars($this->personprofile['email']) ?></i></p>
                                <p><b>Дат на създаване на
                                        профил:</b><i><?= htmlspecialchars($this->personprofile['dateofcreate']) ?></i></p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <div class="panel-body">
                                <p><b>Държава:</b><i><?= htmlspecialchars($this->personprofile['countryName']) ?></i></p>
                                <p><b>Град:</b><i><?= htmlspecialchars($this->personprofile['cityName']) ?></i></p>
                                <p><b>Адрес:</b><i>ул.<?= htmlspecialchars($this->personprofile['streetName']) ?></i></p>
                                <p><b>Телефон за връзка</b><i><?= htmlspecialchars($this->personprofile['PhoneN']) ?></i>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <h3 class="panel-title">Добре дошъл, username:  <?= htmlspecialchars($this->personprofile['username']) ?> учащ
                            в:</h3>
                    </div>
                    <div class="panel-body">
                        <p class="text-center"><?= htmlspecialchars($this->school['name']) ?> </p>
                        <p class="text-left">Държава: <?= htmlspecialchars($this->school['countryName']) ?> </p>
                        <p class="text-center">град/село: <?= htmlspecialchars($this->school['cityName']) ?></p>
                        <p class="text-right">улица: <?= htmlspecialchars($this->school['streetName']) ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="row">
        <?php
        $proPositionID = $this->profilePosition['positionID'];
        if ($proPositionID == 2){
            ?>
            <div class="col-lg-8 text-center">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <h3 class="panel-title">Данни за ученика с потребителско
                            име: <?= htmlspecialchars($this->personprofile['username']) ?> </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-4 text-center">
                            <div class="panel panel-yellow" style="width: 90%; height: 90%">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Профилна снимка</h3>
                                </div>
                                <div class="panel-body">
                                    <a href="<?= APP_ROOT ?>/content/profileImages/avatar.jpg">
                                        <img src="<?= APP_ROOT ?>/content/profileImages/avatar.jpg"
                                             class="img-circle" alt="" style="width: 100%; height: 90%">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-left">
                            <div class="panel-body">
                                <p><b>Трите ви имена:</b><i><?= htmlspecialchars($this->personprofile['Fname']) ?>
                                        <?= htmlspecialchars($this->personprofile['Mname']) ?>
                                        <?= htmlspecialchars($this->personprofile['Lname']) ?></i></p>
                                <p><b>ЕГН/л.к.№:</b><i><?= htmlspecialchars($this->personprofile['egn']) ?></i></p>
                                <p><b>Пол:</b><i><?= htmlspecialchars($this->personprofile['gender']) ?></i></p>
                                <p><b>E-mail</b><i><?= htmlspecialchars($this->personprofile['email']) ?></i></p>
                                <p><b>Дат на създаване на
                                        профил:</b><i><?= htmlspecialchars($this->personprofile['dateofcreate']) ?></i></p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <div class="panel-body">
                                <p><b>Държава:</b><i><?= htmlspecialchars($this->personprofile['countryName']) ?></i></p>
                                <p><b>Град:</b><i><?= htmlspecialchars($this->personprofile['cityName']) ?></i></p>
                                <p><b>Адрес:</b><i>ул.<?= $this->personprofile['streetName'] ?></i></p>
                                <p><b>Телефон за връзка</b><i><?= htmlspecialchars($this->personprofile['PhoneN']) ?></i>
                                </p>
                                <p>
                                    <?php if($this->personprofile['positionID'] == 2){ ?>
                                        <b>Клас:</b>
                                        <b><?php
                                            if ($this->personcls['numberType']){
                                                ?>
                                                <?=htmlspecialchars($this->personcls['numberType'])?>
                                                <sup><?=htmlspecialchars($this->personcls['letterType'])?></sup>

                                                <?php
                                            }
                                            else{
                                                ?>
                                                не е избран клас
                                                <?php
                                            }
                                            ?>
                                        </b>
                                    <?php }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <h3 class="panel-title">Добре дошъл, username:  <?= htmlspecialchars($this->personprofile['username']) ?> учащ
                            в:</h3>
                    </div>
                    <div class="panel-body">
                        <p class="text-center"><?= htmlspecialchars($this->school['name']) ?> </p>
                        <p class="text-left">Държава: <?= htmlspecialchars($this->school['countryName']) ?> </p>
                        <p class="text-center">град/село: <?= htmlspecialchars($this->school['cityName']) ?></p>
                        <p class="text-right">улица: <?= htmlspecialchars($this->school['streetName']) ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($proPositionID == 3){
            ?>
            <div class="col-lg-8 text-center">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <h3 class="panel-title">Данни за ученика с потребителско
                            име: <?= htmlspecialchars($this->personprofile['username']) ?> </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-4 text-center">
                            <div class="panel panel-yellow" style="width: 90%; height: 90%">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Профилна снимка</h3>
                                </div>
                                <div class="panel-body">
                                    <a href="<?= APP_ROOT ?>/content/profileImages/avatar.jpg">
                                        <img src="<?= APP_ROOT ?>/content/profileImages/avatar.jpg"
                                             class="img-circle" alt="" style="width: 100%; height: 90%">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-left">
                            <div class="panel-body">
                                <p><b>Трите ви имена:</b><i><?= htmlspecialchars($this->personprofile['Fname']) ?>
                                        <?= htmlspecialchars($this->personprofile['Mname']) ?>
                                        <?= htmlspecialchars($this->personprofile['Lname']) ?></i></p>
                                <p><b>ЕГН/л.к.№:</b><i><?= htmlspecialchars($this->personprofile['egn']) ?></i></p>
                                <p><b>Пол:</b><i><?= htmlspecialchars($this->personprofile['gender']) ?></i></p>
                                <p><b>E-mail</b><i><?= htmlspecialchars($this->personprofile['email']) ?></i></p>
                                <p><b>Дат на създаване на
                                        профил:</b><i><?= htmlspecialchars($this->personprofile['dateofcreate']) ?></i></p>
                            </div>
                        </div>

                        <div class="col-lg-4 text-right">
                            <div class="panel-body">
                                <p><b>Държава:</b><i><?= htmlspecialchars($this->personprofile['countryName']) ?></i></p>
                                <p><b>Град:</b><i><?= htmlspecialchars($this->personprofile['cityName']) ?></i></p>
                                <p><b>Адрес:</b><i>ул.<?= htmlspecialchars($this->personprofile['streetName']) ?></i></p>
                                <p><b>Телефон за връзка</b><i><?= htmlspecialchars($this->personprofile['PhoneN']) ?></i>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <h3 class="panel-title">Добре дошъл, username:  <?= htmlspecialchars($this->personprofile['username']) ?> учащ
                            в:</h3>
                    </div>
                    <div class="panel-body">
                        <p class="text-center"><?= htmlspecialchars($this->school['name']) ?> </p>
                        <p class="text-left">Държава: <?= htmlspecialchars($this->school['countryName']) ?> </p>
                        <p class="text-center">град/село: <?= htmlspecialchars($this->school['cityName']) ?></p>
                        <p class="text-right">улица: <?= htmlspecialchars($this->school['streetName']) ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>