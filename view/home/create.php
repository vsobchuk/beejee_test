<?php
/**
 * @var \App\Model\Task $task
 */
?>

<section class="task">
    <h2 class="text-center">The Tasks</h2>

    <div class="row create-task">
        <div class="col-4"></div>
        <div class="col-4">
            <form method="POST" class="text-center">
                <?php if (!empty($errorMessage)):?>
                <div class="alert alert-danger" role="alert"><?= $errorMessage; ?></div>
                <?php endif;?>

                <div class="row">
                    <div class="col">
                        <label for="user_name"><?= $task->getAttributeLabel('user_name');?></label>
                        <br>
                        <input type="text" name="user_name" id="user_name">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="email"><?= $task->getAttributeLabel('email');?></label>
                        <br>
                        <input type="email" name="email" id="email">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="instructions"><?= $task->getAttributeLabel('instructions');?></label>
                        <br>
                        <textarea name="instructions" id="instructions"></textarea>
                    </div>
                </div>

                <button type="submit">Create task</button>
            </form>
        </div>
        <div class="col-4"></div>
    </div>

</section>
