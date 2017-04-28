<?php $this->title = 'Създай клас'; ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-yellow" >
                <div class="panel-heading">
                    <h1 class="panel-title"> <?=htmlentities($this->title)?></h1>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" class="col-md-4">
                        <div class="form-inline">
                            <label for="term">срок:</label>
                            <input id="term" type="text" name="term" placeholder="първи,втори или трети" class="form-control">
                            <label for="termyear">учебна година:</label>
                            <input id="termyear" type="text" name="termyear" placeholder="формат YYYY" class="form-control">
                            <label for="availablePeriod">
                                <select name="availablePeriod" class="form-control">
                                    <option value=""  > налични периоди</option>
                                    <?php foreach ($this->studyperiod as $term) :?>
                                        <option value="<?=htmlspecialchars($term['studyPeriodID'])?> " class="dropdown-item" >
                                            <?=htmlspecialchars($term['term'])?> -
                                            <?=htmlspecialchars($term['termYear'])?> </option>
                                    <?php endforeach; ?>
                                    ?>
                                </select>
                            </label>
                            <button type="submit" value="Create" class="btn btn-default">Изпрати</button>
                        </div>
                    </form>
                    <form role="form" method="post" class="col-md-4">
                        <div class="form-inline">
                            <label for="number">група:
                                <select name="number" class="form-control">
                                    <option value=""  > налични класове</option>
                                    <?php foreach ($this->classnumbers as $number) :?>
                                        <option value="<?=htmlspecialchars($number['ID'])?> " class="dropdown-item" >
                                            <?=htmlspecialchars($number['classNumberType'])?> </option>
                                    <?php endforeach; ?>
                                    ?>
                                </select>
                            </label>
                            <label for="letter">подгрупа:
                                <select name="letter" class="form-control">
                                    <option value=""  > налични подгрупи</option>
                                    <?php foreach ($this->classletters as $letter) :?>
                                        <option value="<?=htmlspecialchars($letter['ID'])?> " class="dropdown-item" >
                                            <?=htmlspecialchars($letter['classLetterType'])?> </option>
                                    <?php endforeach; ?>
                                    ?>
                                </select>
                            </label>
                            <label for="availableClass">
                                <select class="form-control">
                                    <option value=""  > образувани класове:</option>
                                    <?php foreach ($this->classgroup as $classg) :?>
                                        <option value="" class="dropdown-item" >
                                            <?=htmlspecialchars($classg['numberType'])?>-<?=htmlspecialchars($classg['letterType'])?>
                                        </option>
                                    <?php endforeach; ?>
                                    ?>
                                </select>
                            </label>
                            <button type="submit" value="Create" class="btn btn-default">Изпрати</button>
                        </div>
                    </form>
                    <form role="form" method="post" class="col-md-4">
                        <div class="form-inline">
                            <label for="subject">въведи предмет:</label>
                            <input id="subject" type="text" name="subject"  class="form-control">
                            <label for="abb">Абривиатура на предемта:</label>
                            <input id="abb" type="text" name="abb" class="form-control">
                            <label for="availableSubjects" >
                                <select class="form-control">
                                    <option value=""  > налични предмети</option>
                                    <?php foreach ($this->subjects as $subject) :?>
                                        <option value="<?=htmlspecialchars($subject['ID'])?> " class="dropdown-item" >
                                            <?=htmlspecialchars($subject['Name'])?> -
                                            <?=htmlspecialchars($subject['ABB'])?> </option>
                                    <?php endforeach; ?>
                                    ?>
                                </select>
                            </label>
                            <button type="submit" value="Create" class="btn btn-default">Изпрати</button>
                        </div>
                    </form>
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
    </div>

</div>
<!-- /.container-fluid -->
