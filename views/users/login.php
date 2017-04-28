<?php $this->title = 'Вход'; ?>

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
                    <i class="fa fa-edit"></i> Вход
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post">
                <div class="form-group">
                    <label for="username">Потребителско име:</label>
                    <input id="username" type="text" name="username" class="form-control" autofocus>
                    <p class="help-block">Изписва се с малка буква без разтояние.</p>
                    <label for="password">Парола:</label>
                    <input id="password" type="password" name="password" class="form-control">
                    <p class="help-block">Цифри и букви.</p>
                    <button type="submit" value="Login" class="btn btn-default">Влез</button>
                    <a href="<?=APP_ROOT?>/users/register">[Нямате регистрация?]</a> </div>
                </div>
            </form>
        </div>
    </div>
</div>