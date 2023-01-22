<!-- In main -->
<h1>Notifications</h1>
<section>
    <?php foreach ($templateParams["notifications"] as $notification): ?>
    <?php $db = new DatabaseHelper(); ?>
    <?php $sender = $db->findUser($notification["sender_id"]); ?>
    <section>
        <?php switch ($notification["notification_type"]):
            case "f": ?>
                <a href="user_profile.php" class="no-underline">
            <?php break;
            case "c":
            case "l":
            case "p":
            case "t": ?>
                <a href="view_post.php" class="no-underline">
            <?php break;
            case "s": ?>
                <a href="view_story.php" class="no-underline">
            <?php break;
            default: ?>
                <a href="#" class="no-underline">
        <?php endswitch; ?>

            <img src="<?=$sender["user_picture_path"]?>" alt="<?=$sender["user_id"]?>'s user image"/>
            <p><strong><?=$sender["user_id"]?></strong> <?=$notification["content"]?></p>

            <?php if ($notification["notification_type"] === "f"):
                //if ($dbh->isFollowing($_SESSION["user"]["user_id"], $notification["user_id"])):
                    //<!--<input type="button" value="Following" disabled/> -->
                //<?php //else: ?>
                    <input type="button" value="Follow"/>
                <?php //endif; ?>
            <?php else: ?>
                <img src="img/<?=$templateParams["notification_type"][$notification["type"]]["img"]?>"
                     alt="<?=$templateParams["notification_type"][$notification["type"]]["alt"]?>"/>
            <?php endif; ?>
        </a>
    </section>
    <?php endforeach; ?>
</section>