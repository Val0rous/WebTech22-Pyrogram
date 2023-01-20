<!-- In main -->
<h1>Notifications</h1>
<section>
    <?php foreach ($templateParams["notifications"] as $notification): ?>
    <section>
        <img src="<?=$notification["user_image"]?>" alt="<?=$post["user_name"]?>'s user image"/>
        <p><strong><?=$notification["user_name"]?></strong> <?=$notification["content"]?></p>
        <?php if ($notification["type"] == "follow"): ?>
            <?php //if ($dbh->isFollowing($_SESSION["user"]["user_id"], $notification["user_id"])): ?>
                <!--<input type="button" value="Following" disabled/> -->
            <?php //else: ?>
                <input type="button" value="Follow"/>
            <?php //endif; ?>
        <?php else: ?>
            <img src="img/<?=$templateParams["notification_type"][$notification["type"]]["img"]?>"
                 alt="<?=$templateParams["notification_type"][$notification["type"]]["alt"]?>"/>
        <?php endif; ?>
    </section>
    <?php endforeach; ?>
</section>