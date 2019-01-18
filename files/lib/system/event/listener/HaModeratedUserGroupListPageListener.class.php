<?php
namespace wcf\system\event\listener;
use wcf\system\WCF;

class HaModeratedUserGroupListPageListener implements IParameterizedEventListener {
    public function execute($eventObj, $className, $eventName, array &$parameters) {
        if (isset($_POST['haGroupName'])) {
            $eventObj->objectList->getConditionBuilder()->add('user_group.groupName LIKE ?', ['%'.$_POST['haGroupName'].'%']);

            WCF::getSession()->register('haGroupName', $_POST['haGroupName']);

            WCF::getTpl()->assign([
                'haGroupName' => $_POST['haGroupName']
            ]);
        } else if (!empty(WCF::getSession()->getVar('haGroupName'))) {
            $haGroupName = WCF::getSession()->getVar('haGroupName');

            $eventObj->objectList->getConditionBuilder()->add('user_group.groupName LIKE ?', ['%'.$haGroupName.'%']);

            WCF::getTpl()->assign([
                'haGroupName' => $haGroupName
            ]);
        }
    }
}