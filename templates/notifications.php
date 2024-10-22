<!-- In main -->

<!-- Top bar -->
<div class="top-bar">
    <h1>Notifications</h1>
</div>

<section>
    <?php foreach ($templateParams["notifications"] as $notification): ?>
    <?php $db = new DatabaseHelper(); ?>
    <?php $sender = $db->findUser($notification["sender_id"]); ?>
    <?php $db->readAllNotifications($_SESSION["user"]["user_id"]); ?>
    <!-- Notification -->
    <?php switch ($notification["notification_type"]):
        case "f": ?>
            <a href="user_profile.php?user=<?=$sender["user_id"]?>" class="no-underline">
        <?php break;
        case "c":
        case "l":
        case "p":
        case "t": ?>
            <a href="view_post.php?post=<?=$notification["post_id"]?>" class="no-underline">
        <?php break;
        case "s": ?>
            <a href="view_story.php?story=<?=$notification["story_id"]?>" class="no-underline">
        <?php break;
        default: ?>
            <a href="#" class="no-underline">
    <?php endswitch; ?>

        <!-- Sender profile picture -->
        <img src="<?=PROFILE_PICS_DIR.$sender["user_picture_path"]?>" alt="<?=$sender["user_id"]?>'s user profile picture">
        <!-- Sender username + notification content -->
        <p><strong><?=$sender["user_id"]?></strong> <?=$notification["content"]?></p>

        <?php switch ($notification["notification_type"]):
            case "f":
                if ($db->findFollowing($_SESSION["user"]["user_id"], $notification["sender_id"])): ?>
                    <button type="button" class="notifications following">Following</button>
                <?php else: ?>
                    <button type="button" class="notifications follow">Follow</button>
                <?php endif;
            break;
            case "c":
            case "l":
            case "p":
            case "t": 
                if ($db->findPost($notification["post_id"])["media_path0"] != null): ?>
                    <!-- Only takes the first image as thumbnail: this is not a bug -->
                    <img src="<?=MEDIA_DIR.$db->findPost($notification["post_id"])["media_path0"]?>"
                        alt="<?=$sender["user_id"]?>'s post">
                <?php endif;
                break;
            default: ?>
        <?php endswitch; ?>
    </a>
    <?php endforeach; ?>
</section>
