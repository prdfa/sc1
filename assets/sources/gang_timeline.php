<?php
if (FA_isBlocked($sk['timeline']['id'])) {

    header('Location: index.php?t=home');
}

if ($sk['timeline']['group_privacy'] === "secret") {

    if (!FA_isFollowing($sk['timeline']['id']) && !FA_isGangAdmin($sk['timeline']['id'])) {
        header('Location: ' . FA_smoothLink('index.php?tab1=home'));
       // die();
    }
}

$sk['content'] = FA_getPage('timeline/gang');
