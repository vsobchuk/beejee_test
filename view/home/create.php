<?php
/**
 * @var \App\Model\Task $task
 */
$taskId = $task->getAttributeValue('id');
$buttonLabel = 'Create Task';
if ($taskId) {
    $buttonLabel = 'Update Task';
}
?>

<section class="task">
    <h2 class="text-center"><?= $buttonLabel; ?></h2>

    <div class="row create-task">
        <div class="col-4"></div>
        <div class="col-4">
            <form method="POST" class="text-center">
                <?php if (!empty($errorMessage)):?>
                <div class="alert alert-danger" role="alert"><?= $errorMessage; ?></div>
                <?php endif;?>

                <?php if ($taskId):?>
                <div class="row">
                    <div class="col">
                        <label for="is_completed"><?= $task->getAttributeLabel('is_completed');?></label>
                        <br>
                        <select name="is_completed">
                            <option value="0">
                                No
                            </option>
                            <option value="1" <?= $task->getAttributeValue('is_completed') ? 'selected' : '';?>>
                                Yes
                            </option>
                        </select>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col">
                        <label for="user_name"><?= $task->getAttributeLabel('user_name');?></label>
                        <br>
                        <input type="text" name="user_name" id="user_name" value="<?=$task->getAttributeValue('user_name');?>">
                        <input type="hidden" name="id" id="id" value="<?=$taskId;?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="email"><?= $task->getAttributeLabel('email');?></label>
                        <br>
                        <input type="email" name="email" id="email" value="<?=$task->getAttributeValue('email');?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="instructions"><?= $task->getAttributeLabel('instructions');?></label>
                        <br>
                        <textarea name="instructions" id="instructions"><?=$task->getAttributeValue('instructions');?></textarea>
                    </div>
                </div>

                <button type="submit"><?= $buttonLabel; ?></button>
            </form>
        </div>
        <div class="col-4"></div>
    </div>

</section>
