<?php
/**
 * @var \App\Model\User $user
 */
?>


<section class="task">
    <h2 class="text-center">Authenticate</h2>

    <div class="row create-task">
        <div class="col-4"></div>
        <div class="col-4">
            <form method="POST" action="<?= \Core\Helpers\Url::generate('home', 'login'); ?>" class="text-center">
                <?php if (!empty($errorMessage)):?>
                <div class="alert alert-danger" role="alert"><?= $errorMessage; ?></div>
                <?php endif;?>

                <div class="row">
                    <div class="col">
                        <label for="login"><?= $user->getAttributeLabel('login');?></label>
                        <br>
                        <input type="text" name="login" id="login">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="pass"><?= $user->getAttributeLabel('pass');?></label>
                        <br>
                        <input type="pass" name="pass" id="email">
                    </div>
                </div>

                <button type="submit">Login</button>
            </form>
        </div>
        <div class="col-4"></div>
    </div>

</section>
