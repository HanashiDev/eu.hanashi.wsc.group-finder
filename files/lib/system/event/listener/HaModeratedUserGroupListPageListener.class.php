<?php

namespace wcf\system\event\listener;

use wcf\system\request\LinkHandler;
use wcf\system\WCF;
use wcf\util\HeaderUtil;

final class HaModeratedUserGroupListPageListener extends AbstractEventListener
{
    protected function onAfterInitObjectList($eventObj)
    {
        if (isset($_POST['haGroupName'])) {
            $eventObj->objectList->getConditionBuilder()->add(
                'user_group.groupName LIKE ?',
                ['%' . WCF::getDB()->escapeLikeValue($_POST['haGroupName']) . '%']
            );

            WCF::getSession()->register('haGroupName', $_POST['haGroupName']);

            WCF::getTpl()->assign([
                'haGroupName' => $_POST['haGroupName'],
            ]);
        } elseif (!empty(WCF::getSession()->getVar('haGroupName'))) {
            $haGroupName = WCF::getSession()->getVar('haGroupName');

            $eventObj->objectList->getConditionBuilder()->add(
                'user_group.groupName LIKE ?',
                ['%' . WCF::getDB()->escapeLikeValue($haGroupName) . '%']
            );

            WCF::getTpl()->assign([
                'haGroupName' => $haGroupName,
            ]);
        }
    }

    protected function onCountItems($eventObj)
    {
        if ($eventObj->objectList->countObjects() == 0 && !empty(WCF::getSession()->getVar('haGroupName'))) {
            WCF::getSession()->unregister('haGroupName');

            HeaderUtil::delayedRedirect(
                LinkHandler::getInstance()->getLink('ModeratedUserGroupList'),
                WCF::getLanguage()->getDynamicVariable('wcf.moderated.hanashi.noResult')
            );

            exit;
        }
    }
}
