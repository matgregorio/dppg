{**
* comment.tpl
*
* Copyright (c) 2000-2012 John Willinsky
* Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
*
* Form to enter comments.
*
* $Id$
*}
{strip}
    {include file="submission/comment/header.tpl"}
{/strip}

<table class="data" width="100%">
    {foreach from=$paperComments item=comment}
        <tr valign="top">
            <td width="25%">
                <div class="commentRole">
                    {if $showReviewLetters and $comment->getRoleId() eq $reviewer}
                        {assign var="start" value="A"|ord}
                        {assign var="reviewId" value=$comment->getAssocId()}
                        {translate key=$comment->getRoleName()} {$reviewLetters[$reviewId]+$start|chr}
                    {else}
                        {translate key=$comment->getRoleName()}
                    {/if}
                </div>
                <div class="commentDate">{$comment->getDatePosted()|date_format:$datetimeFormatShort}</div>
                <br />
                <div class="commentNote">
                    {if $comment->getViewable()}
                        {translate key="submission.comments.canShareWithAuthor"}
                    {else}
                        {translate key="submission.comments.cannotShareWithAuthor"}
                    {/if}
                </div>
            </td>
            <td width="75%">
                {if $comment->getAuthorId() eq $userId and not $isLocked}
                    <div style="float: right"><a href="{if $reviewId}{url op="editComment" path=$paperId|to_array:$comment->getId() reviewId=$reviewId}{else}{url op="editComment" path=$paperId|to_array:$comment->getId()}{/if}" class="action">{translate key="common.edit"}</a>&nbsp;|&nbsp;<a href="{if $reviewId}{url op="deleteComment" path=$paperId|to_array:$comment->getId() reviewId=$reviewId}{else}{url op="deleteComment" path=$paperId|to_array:$comment->getId()}{/if}" onclick="return confirm('{translate|escape:"jsparam" key="submission.comments.confirmDelete"}')" class="action">{translate key="common.delete"}</a></div>
                    {/if}
                <div id="{$comment->getId()}">
                    {if $comment->getCommentTitle()}
                        <div class="commentTitle">{translate key="submission.comments.subject"}: {$comment->getCommentTitle()|escape}</div>
                    {/if}
                </div>
                <div class="comments">{$comment->getComments()|strip_unsafe_html|nl2br}</div>
            </td>
        </tr>
    {foreachelse}
        <tr>
            <td class="nodata">{translate key="submission.comments.noReviews"}</td>
        </tr>
    {/foreach}
</table>

<br />
<br />

{if not $isLocked}
    <form method="post" action="{url op=$commentAction}">
        {if $hiddenFormParams}
            {foreach from=$hiddenFormParams item=hiddenFormParam key=key}
                <input type="hidden" name="{$key|escape}" value="{$hiddenFormParam|escape}" />
            {/foreach}
        {/if}


        <div id="new">
            {include file="common/formErrors.tpl"}

            <table class="data" width="100%">
                <tr valign="top">
                    <td class="label">{fieldLabel name="commentTitle" key="submission.comments.subject"}</td>
                    <td class="value"><input type="text" name="commentTitle" id="commentTitle" value="{$commentTitle|escape}" size="50" maxlength="255" class="textField" /></td>
                </tr>
                <tr valign="top">
                    <td class="label">{fieldLabel name="authorComments"}{translate key="submission.comments.forAuthorDirector"}</td>
                    <td class="value"><textarea id="authorComments" name="authorComments" rows="10" cols="50" class="textArea">{$authorComments|escape}</textarea></td>
                </tr>
                <tr valign="top">
                    <td class="label">{fieldLabel name="comments"}{translate key="submission.comments.forDirector"}</td>
                    <td class="value"><textarea id="comments" name="comments" rows="10" cols="50" class="textArea">{$comments|escape}</textarea></td>
                </tr>
            </table>

            <p><input type="submit" name="save" value="{translate key="common.save"}" class="button defaultButton" /> <input type="button" value="{translate key="common.close"}" class="button" onclick="window.opener.location.reload();
        window.close()" /></p>

            <p><span class="formRequired">{translate key="common.requiredField"}</span></p>
        </div>
    </form>

{else}
    <input type="button" value="{translate key="common.close"}" class="button defaultButton" style="width: 5em" onclick="window.close()" />
{/if}

{include file="submission/comment/footer.tpl"}
