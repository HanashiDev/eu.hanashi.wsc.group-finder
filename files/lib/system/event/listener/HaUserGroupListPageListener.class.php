<?php

namespace wcf\system\event\listener;

use wcf\system\request\LinkHandler;
use wcf\system\WCF;
use wcf\util\HeaderUtil;

final class HaUserGroupListPageListener implements IParameterizedEventListener
{
    public function execute($eventObj, $className, $eventName, array &$parameters)
    {
        if ($eventName == 'afterInitObjectList') {
            if (isset($_POST['haUserGroupName'])) {
                $eventObj->objectList->getConditionBuilder()->add(
                    'user_group.groupName LIKE ?',
                    ['%' . WCF::getDB()->escapeLikeValue($_POST['haUserGroupName']) . '%']
                );

                WCF::getSession()->register('haUserGroupName', $_POST['haUserGroupName']);

                WCF::getTpl()->assign([
                    'haUserGroupName' => $_POST['haUserGroupName'],
                ]);
            } elseif (!empty(WCF::getSession()->getVar('haUserGroupName'))) {
                $haUserGroupName = WCF::getSession()->getVar('haUserGroupName');

                $eventObj->objectList->getConditionBuilder()->add(
                    'user_group.groupName LIKE ?',
                    ['%' . WCF::getDB()->escapeLikeValue($haUserGroupName) . '%']
                );

                WCF::getTpl()->assign([
                    'haUserGroupName' => $haUserGroupName,
                ]);
            }
        } elseif ($eventName == 'countItems') {
            if ($eventObj->objectList->countObjects() == 0 && !empty(WCF::getSession()->getVar('haUserGroupName'))) {
                WCF::getSession()->unregister('haUserGroupName');

                HeaderUtil::delayedRedirect(
                    LinkHandler::getInstance()->getLink('UserGroupList'),
                    WCF::getLanguage()->getDynamicVariable('wcf.moderated.hanashi.noResult')
                );

                exit;
            }
        }
    }
}
