<?php

namespace wcf\system\event\listener;

use wcf\system\WCF;

final class HaUserGroupManageMemberListPageListener extends AbstractEventListener
{
    protected function onAfterInitObjectList($eventObj)
    {
        if (isset($_POST['haMemberName'])) {
            $eventObj->objectList->getConditionBuilder()->add(
                'user_table.username LIKE ?',
                ['%' . WCF::getDB()->escapeLikeValue($_POST['haMemberName']) . '%']
            );

            WCF::getSession()->register('haMemberName', $_POST['haMemberName']);

            WCF::getTpl()->assign([
                'haMemberName' => $_POST['haMemberName'],
            ]);
        } elseif (!empty(WCF::getSession()->getVar('haMemberName'))) {
            $haMemberName = WCF::getSession()->getVar('haMemberName');

            $eventObj->objectList->getConditionBuilder()->add(
                'user_table.username LIKE ?',
                ['%' . WCF::getDB()->escapeLikeValue($haMemberName) . '%']
            );

            WCF::getTpl()->assign([
                'haMemberName' => $haMemberName,
            ]);
        }
    }
}
