<?php $this->title = 'Профил'; ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-8 text-center">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Потребителско име:
                        <?php  $username = $this->personprofile['username']?>
                        <?= htmlspecialchars($this->personprofile['username']) ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-4 text-center">
                        <div class="panel panel-yellow" style="width: auto ; height: auto">
                            <div class="panel-heading">
                                <h3 class="panel-title">Профилна снимка</h3>
                            </div>
                            <div class="panel-body" >
                                <?php
                                $projectPath = "/var/www/html/simplex";
                                $imageExist = file_exists($projectPath.APP_ROOT."/content/profileImages/".$username.".png");
                                if ($imageExist){
                                    ?>
                                    <a href="<?= APP_ROOT ?>/content/profileImages/<?= $username?>.png">
                                        <img src="<?= APP_ROOT ?>/content/profileImages/<?= $username?>.png"
                                             class="img-circle" alt="" style="width: 60%">
                                    </a>
                                <?php }
                                else{
                                    ?>
                                    <a href="<?= APP_ROOT ?>/content/profileImages/avatar.jpg">
                                        <img src="<?= APP_ROOT ?>/content/profileImages/avatar.jpg"
                                             class="img-circle" alt="" style="width: 100%; height: 90%">
                                    </a>
                                <?php }?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 text-left">
                        <div class="panel-body">
                            <p><b>Трите ви имена:</b><i><?=htmlspecialchars($this->personprofile['Fname']) ?>
                                    <?=htmlspecialchars($this->personprofile['Mname']) ?>
                                    <?=htmlspecialchars($this->personprofile['Lname']) ?></i></p>
                            <p><b>ЕГН/л.к.№:</b><i><?=htmlspecialchars($this->personprofile['egn']) ?></i></p>
                            <p><b>Възраст:</b><i><?=htmlspecialchars($this->personprofile['DOB']) ?></i></p>
                            <p><b>Пол:</b><i><?=htmlspecialchars($this->personprofile['gender']) ?></i></p>
                            <p><b>E-mail</b><i><?=htmlspecialchars($this->personprofile['email']) ?></i></p>
                        </div>
                    </div>

                    <div class="col-lg-4 text-right">
                        <div class="panel-body">
                            <p><b>Държава:</b><i><?=htmlspecialchars($this->personprofile['countryName']) ?></i></p>
                            <p><b>Град:</b><i><?=htmlspecialchars($this->personprofile['cityName']) ?></i></p>
                            <p><b>Адрес:</b><i>бул./ул.<?=$this->personprofile['streetName'] ?></i></p>
                            <p><b>Телефон за връзка:</b><i><?=htmlspecialchars($this->personprofile['PhoneN']) ?></i></p>
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
                <div class="panel-footer">
                    <p><b>Дат на създаване на профил:</b>
                        <i><?=htmlspecialchars($this->personprofile['dateofcreate']) ?></i>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h3 class="panel-title">Добре дошъл, username: <?= htmlspecialchars($this->personprofile['username']) ?> </h3>
                </div>
                <div class="panel-body">
                    <p class="text-center" ><?= htmlspecialchars($this->school['name']) ?> </p>
                    <p class="text-left" >Държава: <?= htmlspecialchars($this->school['countryName']) ?> </p>
                    <p class="text-center" >град/село: <?= htmlspecialchars($this->school['cityName']) ?></p>
                    <p class="text-right">улица:  <?= htmlspecialchars($this->school['streetName']) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>


