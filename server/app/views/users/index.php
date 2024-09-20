<?php ob_start(); ?>
<section class="section">
    <div class="title">usuarios:</div>
    <div class="users">
        <ul>
            <li>sector & username</li>
            <?php
            foreach ($data['usuarios'] as $sector => $users) {

                echo "<li><strong>$sector</strong></li>";

                echo "<ul>";
                foreach ($users as $user) {
                    $username = ($user['username']);
                    $id = ($user['id']);

                    echo '<li><a href="/user?id=' . $id . '">' . $username . '</a></li>';
                }
                echo "</ul>";
            }
            ?>
        </ul>
    </div>
</section>
<main class="main">
    test
</main>
<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layouts/main.php'; ?>