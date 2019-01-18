<?php
namespace wcf\system\event\listener;
use wcf\system\WCF;

class HaUserGroupListPageListener implements IParameterizedEventListener {
    public function execute($eventObj, $className, $eventName, array &$parameters) {
        if (isset($_POST['haUserGroupName'])) {
            $eventObj->objectList->getConditionBuilder()->add('user_group.groupName LIKE ?', ['%'.$_POST['haUserGroupName'].'%']);

            WCF::getSession()->register('haUserGroupName', $_POST['haUserGroupName']);

            WCF::getTpl()->assign([
                'haUserGroupName' => $_POST['haUserGroupName']
            ]);
        } else if (!empty(WCF::getSession()->getVar('haUserGroupName'))) {
            $haUserGroupName = WCF::getSession()->getVar('haUserGroupName');

            $eventObj->objectList->getConditionBuilder()->add('user_group.groupName LIKE ?', ['%'.$haUserGroupName.'%']);

            WCF::getTpl()->assign([
                'haUserGroupName' => $haUserGroupName
            ]);
        }
    }
}