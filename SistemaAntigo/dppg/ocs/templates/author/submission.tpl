{**
* submission.tpl
*
* Copyright (c) 2000-2012 John Willinsky
* Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
*
* Author's submission summary.
*
* $Id$
*}
{strip}
    {translate|assign:"pageTitleTranslated" key="submission.page.summary" id=$submission->getPaperId()}
    {assign var="pageCrumbTitle" value="submission.summary"}
    {include file="common/header.tpl"}
{/strip}

<ul class="menu">
    <li class="current"><a href="{url op="submission" path=$submission->getPaperId()}">{translate key="submission.summary"}</a></li>
        {if $reviewMode == REVIEW_MODE_BOTH_SEQUENTIAL}
        <li><a href="{url op="submissionReview" path=$submission->getPaperId()|to_array:$smarty.const.REVIEW_STAGE_ABSTRACT}">
                {translate key="submission.abstractReview"}</a>
        </li>
        <li><a href="{url op="submissionReview" path=$submission->getPaperId()|to_array:$smarty.const.REVIEW_STAGE_PRESENTATION}">
                {translate key="submission.paperReview"}</a>
        </li>
    {else}
        <li><a href="{url op="submissionReview" path=$submission->getPaperId()}">{translate key="submission.review"}</a></li>
        {/if}
</ul>

{include file="author/submission/management.tpl"}

<div class="separator"></div>

{include file="author/submission/status.tpl"}

<div class="separator"></div>

{include file="submission/metadata/metadata.tpl"}

{include file="common/footer.tpl"}
