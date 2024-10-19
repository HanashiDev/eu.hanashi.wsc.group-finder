<?php

namespace wcf\system\event\listener;

use wcf\system\WCF;

class HaUserGroupManageMemberListPageListener implements IParameterizedEventListener
{
    public function execute($eventObj, $className, $eventName, array &$parameters)
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
