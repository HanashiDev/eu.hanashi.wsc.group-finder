{if $templateName|isset && $templateName == 'moderatedUserGroupList'}
    <form action="{link controller='ModeratedUserGroupList'}{/link}" method="post">
        <input type="text" placeholder="Gruppe suchen..." name="haGroupName"{if $haGroupName|isset} value="{$haGroupName}"{/if}> <input type="submit" value="Suchen">
    </form>
{else if $templateName|isset && $templateName == 'userGroupManageMemberList'}
    <form action="{link controller='UserGroupManageMemberList' id=$group->groupID}{/link}" method="post">
        <input type="text" placeholder="Mitglieder suchen..." name="haMemberName"{if $haMemberName|isset} value="{$haMemberName}"{/if}> <input type="submit" value="Suchen">
    </form>
{/if}