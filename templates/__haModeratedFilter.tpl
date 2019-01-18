{if $templateName|isset && $templateName == 'moderatedUserGroupList'}
    <form action="{link controller='ModeratedUserGroupList'}{/link}" method="post">
        <input type="text" placeholder="{lang}wcf.moderated.hanashi.haGroupName{/lang}" name="haGroupName"{if $haGroupName|isset} value="{$haGroupName}"{/if}> <input type="submit" value="{lang}wcf.moderated.hanashi.submit{/lang}">
    </form>
{else if $templateName|isset && $templateName == 'userGroupManageMemberList'}
    <form action="{link controller='UserGroupManageMemberList' id=$group->groupID}{/link}" method="post">
        <input type="text" placeholder="{lang}wcf.moderated.hanashi.haMemberName{/lang}" name="haMemberName"{if $haMemberName|isset} value="{$haMemberName}"{/if}> <input type="submit" value="{lang}wcf.moderated.hanashi.submit{/lang}">
    </form>
{else if $templateName|isset && $templateName == 'userGroupList'}
    <form action="{link controller='UserGroupList'}{/link}" method="post">
        <input type="text" placeholder="{lang}wcf.moderated.hanashi.haGroupName{/lang}" name="haUserGroupName"{if $haUserGroupName|isset} value="{$haUserGroupName}"{/if}> <input type="submit" value="{lang}wcf.moderated.hanashi.submit{/lang}">
    </form>
{/if}