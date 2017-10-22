<?php
/**
 * @package Wsal
 * @subpackage Sensors
 * Wordpress comments.
 *
 * 2090 User approved a comment
 * 2091 User unapproved a comment
 * 2092 User replied to a comment
 * 2093 User edited a comment
 * 2094 User marked a comment as Spam
 * 2095 User marked a comment as Not Spam
 * 2096 User moved a comment to trash
 * 2097 User restored a comment from the trash
 * 2098 User permanently deleted a comment
 * 2099 User posted a comment
 */
class WSAL_Sensors_Comments extends WSAL_AbstractSensor
{
    /**
     * Listening to events using WP hooks.
     */
    public function HookEvents()
    {
        add_action('edit_comment', array($this, 'EventCommentEdit'), 10, 1);
        add_action('transition_comment_status', array($this, 'EventCommentApprove'), 10, 3);
        add_action('spammed_comment', array($this, 'EventCommentSpam'), 10, 1);
        add_action('unspammed_comment', array($this, 'EventCommentUnspam'), 10, 1);
        add_action('trashed_comment', array($this, 'EventCommentTrash'), 10, 1);
        add_action('untrashed_comment', array($this, 'EventCommentUntrash'), 10, 1);
        add_action('deleted_comment', array($this, 'EventCommentDeleted'), 10, 1);
        add_action('comment_post', array($this, 'EventComment'), 10, 2);
    }

    /**
     * Trigger comment edit.
     * @param integer $comment_ID comment ID
     */
    public function EventCommentEdit($comment_ID)
    {
        $comment = get_comment($comment_ID);
        $this->EventGeneric($comment_ID, 2093);
    }

    /**
     * Trigger comment status.
     * @param string $new_status new status
     * @param string $old_status old status
     * @param stdClass $comment comment
     */
    public function EventCommentApprove($new_status, $old_status, $comment)
    {
        if (!empty($comment) && $old_status != $new_status) {
            $post = get_post($comment->comment_post_ID);
            $comment_link = get_permalink($post->ID) . "#comment-" . $comment->comment_ID;
            $fields = array(
                'PostTitle' => $post->post_title,
                'Author' => $comment->comment_author,
                'Date' => $comment->comment_date,
                'CommentLink' => '<a target="_blank" href="' . $comment_link . '">' . $comment->comment_date . '</a>'
            );

            if ($new_status == 'approved') {
                $this->plugin->alerts->Trigger(2090, $fields);
            }
            if ($new_status == 'unapproved') {
                $this->plugin->alerts->Trigger(2091, $fields);
            }
        }
    }

    /**
     * Trigger comment spam.
     * @param integer $comment_ID comment ID
     */
    public function EventCommentSpam($comment_ID)
    {
        $this->EventGeneric($comment_ID, 2094);
    }

    /**
     * Trigger comment unspam.
     * @param integer $comment_ID comment ID
     */
    public function EventCommentUnspam($comment_ID)
    {
        $this->EventGeneric($comment_ID, 2095);
    }

    /**
     * Trigger comment trash.
     * @param integer $comment_ID comment ID
     */
    public function EventCommentTrash($comment_ID)
    {
        $this->EventGeneric($comment_ID, 2096);
    }

    /**
     * Trigger comment untrash.
     * @param integer $comment_ID comment ID
     */
    public function EventCommentUntrash($comment_ID)
    {
        $this->EventGeneric($comment_ID, 2097);
    }

    /**
     * Trigger comment deleted.
     * @param integer $comment_ID comment ID
     */
    public function EventCommentDeleted($comment_ID)
    {
        $this->EventGeneric($comment_ID, 2098);
    }

    /**
     * Fires immediately after a comment is inserted into the database.
     * @param int        $comment_ID       The comment ID.
     * @param int|string $comment_approved 1 if the comment is approved, 0 if not, 'spam' if spam.
     */
    public function EventComment($comment_ID, $comment_approved = null)
    {
        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'replyto-comment') {
            $this->EventGeneric($comment_ID, 2092);
        }
        if (isset($_REQUEST['comment'])) {
            $comment = get_comment($comment_ID);
            if (!empty($comment)) {
                if ($comment->comment_approved != 'spam') {
                    $post = get_post($comment->comment_post_ID);
                    $comment_link = get_permalink($post->ID) . "#comment-" . $comment_ID;
                    $fields = array(
                        'Date' => $comment->comment_date,
                        'CommentLink' => '<a target="_blank" href="' . $comment_link . '">' . $comment->comment_date . '</a>'
                    );
                    if (!username_exists($comment->comment_author)) {
                        $fields['CommentMsg'] = sprintf("A comment was posted in response to the post <strong>%s</strong>. The comment was posted by <strong>%s</strong>", $post->post_title, $this->CheckAuthor($comment));
                        $fields['Username'] = "Website Visitor";
                    } else {
                        $fields['CommentMsg'] = sprintf("Posted a comment in response to the post <strong>%s</strong>", $post->post_title);
                    }

                    $this->plugin->alerts->Trigger(2099, $fields);
                }
            }
        }
    }

    /**
     * Trigger generic event.
     * @param integer $comment_ID comment ID
     * @param integer $alert_code event code
     */
    private function EventGeneric($comment_ID, $alert_code)
    {
        $comment = get_comment($comment_ID);
        if (!empty($comment)) {
            $post = get_post($comment->comment_post_ID);
            $comment_link = get_permalink($post->ID) . "#comment-" . $comment_ID;
            $fields = array(
                'PostTitle' => $post->post_title,
                'Author' => $comment->comment_author,
                'Date' => $comment->comment_date,
                'CommentLink' => '<a target="_blank" href="' . $comment_link . '">' . $comment->comment_date . '</a>'
            );

            $this->plugin->alerts->Trigger($alert_code, $fields);
        }
    }

    /**
     * Shows the username if the comment is owned by a user
     * and the email if the comment was posted by a non WordPress user
     * @param stdClass $comment comment
     * @return string author username or email
     */
    private function CheckAuthor($comment)
    {
        if (username_exists($comment->comment_author)) {
            return $comment->comment_author;
        } else {
            return $comment->comment_author_email;
        }
    }
}
