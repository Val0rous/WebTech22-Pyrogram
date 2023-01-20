<!-- In main -->
<h1>Notifications</h1>
<section>
    <?php foreach ($templateParams["notifications"] as $notification): ?>
    <section>
        <img src="<?=$notification["user_image"]?>" alt="<?=$post["user_name"]?>'s user image"/>
        <p><strong><?=$notification["user_name"]?></strong> <?=$notification["content"]?></p>
        <img src="img/<?=$templateParams["notification_type"][$notification["type"]]["img"]?>"
             alt="<?=$templateParams["notification_type"][$notification["type"]]["alt"]?>"/>
    </section>
    <?php endforeach; ?>
</section>