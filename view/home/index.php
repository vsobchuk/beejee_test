<?php
/**
 * @var \App\Model\Task $task
 * @var string $errorMessage
 * @var bool $isEditEnabled
 */
?>

<section class="task">
    <h2 class="text-center">
        <a href="<?= \Core\Helpers\Url::generate('home', 'create'); ?>">Create new entry</a>
        <?php if (!\Core\RequestHandler::getUserId()):?>
        or
        <a href="<?= \Core\Helpers\Url::generate('home', 'login'); ?>">Login</a>
        <?php endif;?>
    </h2>

    <div class="row task-list">
        <div class="col-1"></div>
        <div class="col-10">
            <table id="table_tasks" class="display">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Email</th>
                    <th scope="col">Task</th>
                    <th scope="col">Completed</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $task):?>
                    <tr>
                        <td><?= $task['id']; ?></td>
                        <td><?= htmlentities($task['user_name']); ?></td>
                        <td><?= $task['email']; ?></td>
                        <td><?= htmlentities($task['instructions']);?></td>
                        <td>
                            <?php
                                $cellContent = $task['is_completed'] ? "Yes" : "No";
                                if ($isEditEnabled) {
                                    $url = \Core\Helpers\Url::generate('home', 'update', ['id' => $task['id']]);
                                    $cellContent = "<a href='$url'> $cellContent </a>";
                                }
                                echo $cellContent;
                            ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-1"></div>
    </div>

</section>
<script>
    $(document).ready( function () {
        $('#table_tasks').DataTable({
            pageLength: <?= \App\Model\Task::DEFAULT_PAGE_SIZE;?>,
        });
    } );
</script>