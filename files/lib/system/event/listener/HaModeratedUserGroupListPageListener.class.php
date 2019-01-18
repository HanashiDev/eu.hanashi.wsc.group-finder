<?php
namespace wcf\system\event\listener;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;
use wcf\util\HeaderUtil;

class HaModeratedUserGroupListPageListener implements IParameterizedEventListener {
    public function execute($eventObj, $className, $eventName, array &$parameters) {
        if ($eventName == 'afterInitObjectList') {
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
        } else if ($eventName == 'countItems') {
            if ($eventObj->objectList->countObjects() == 0 && !empty(WCF::getSession()->getVar('haGroupName'))) {
                WCF::getSession()->unregister('haGroupName');

                HeaderUtil::delayedRedirect(LinkHandler::getInstance()->getLink('ModeratedUserGroupList'), WCF::getLanguage()->getDynamicVariable('wcf.moderated.hanashi.noResult'));
		        exit;
            }
        }
    }
}