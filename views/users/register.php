<?php $this->title = 'Регистрация'; ?>

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
                    <i class="fa fa-edit"></i> Регистрация
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post">
                <div class="form-group">
                    <label for="username">Потребителско име:</label>
                    <input id="username" type="text" name="username" autofocus class="form-control">
                    <p class="help-block">Изписва се с малка буква без разтояние.</p>
                    <label for="password">Парола:</label>
                    <input id="password" type="password" name="password" class="form-control">
                    <label for="passwordconfirm">Потвърди парола:</label>
                    <input id="passwordconfirm" type="password" name="passwordconfirm" class="form-control">
                    <p class="help-block">Цифри и букви.</p>
                    <label for="email">email:</label>
                    <input id="email" type="text" name="email" class="form-control">
                    <p class="help-block">Цифри и букви. всичко, както и @ </p>
                    <button type="submit" value="registration" class="btn btn-default">Регистрация</button>
                    <a href="<?=APP_ROOT?>/users/login">[Към входа]</a>
                </div>
            </form>
        </div>
    </div>
</div>



