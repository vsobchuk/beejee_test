<?php
/**
 * @var \App\Model\Task $task
 * @var string $errorMessage
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

    <div class="row task-list">
        <div class="col-3"></div>
        <div class="col-6">
            <table id="table_tasks" class="display">
                <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">Email</th>
                    <th scope="col">Task</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $task):?>
                    <tr>
                        <td><?= htmlentities($task['user_name']); ?></td>
                        <td><?= $task['email']; ?></td>
                        <td><?= htmlentities($task['instructions']);?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-3"></div>
    </div>

</section>
<script>
    $(document).ready( function () {
        $('#table_tasks').DataTable({
            pageLength: <?= \App\Model\Task::DEFAULT_PAGE_SIZE;?>,
        });
    } );
</script>