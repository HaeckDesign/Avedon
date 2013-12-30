<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
<span class="nocomments well col-md-12">This post is password protected. Enter the password to view comments.</span>
<?php return; } ?>

<?php if ( have_comments() ) : ?>
<div id="commentsbox" class="panel panel-default">
<div class="panel-heading">
<h3 id="comments" class="panel-title"><?php comments_number('No Responses', 'One Response', '% Responses' );?> so far...</h3>
</div>

<div class="panel-body"><ol class="commentlist">
<?php wp_list_comments(array('before' => '<div class="list-group-item"> ', 'after' => '</div>')); ?>
</ol></div>

<div class="comment-nav">
<div class="alignleft"><?php previous_comments_link() ?></div>
<div class="alignright"><?php next_comments_link() ?></div>
</div></div>
<?php else : endif ?>

<?php if ( comments_open() ) : ?>

<i class="cattag glyphicon glyphicon-comment"><span class="visuallyhidden">Comments</span></i>
<?php comment_form(); ?>

<?php endif; ?>
