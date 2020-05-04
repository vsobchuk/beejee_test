<?php
/**
 * @var \App\Model\Task $task
 * @var string $errorMessage
 */
?>

<section class="task">
    <h2 class="text-center">
        <a href="<?= \Core\Helpers\Url::generate('home', 'create'); ?>">Create new entry</a>
        or
        <a href="#">Login</a>
    </h2>

    <div class="row task-list">
        <div class="col-3"></div>
        <div class="col-6">
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
                        <td><?= $task['is_completed'] ? "Yes" : "No";?></td>
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