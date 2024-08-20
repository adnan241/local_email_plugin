<?php
require_once('../../config.php');
require_login();

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/emailplugin/index.php'));
$PAGE->set_title(get_string('pluginname', 'local_emailplugin'));
$PAGE->set_heading(get_string('pluginname', 'local_emailplugin'));

echo $OUTPUT->header();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = required_param('email', PARAM_EMAIL);
    $subject = required_param('subject', PARAM_TEXT);
    $message = required_param('message', PARAM_TEXT);

    if (email_to_user($USER, $USER, $subject, $message)) {
        
        echo html_writer::div(get_string('emailsuccess', 'local_emailplugin'), 'alert alert-success');
    } else {
       
        echo html_writer::div(get_string('emailfail', 'local_emailplugin'), 'alert alert-danger');
    }
}

echo '<form method="POST">';
echo '<div class="form-group">';
echo '<label for="email">'.get_string('senderemail', 'local_emailplugin').'</label>';
echo '<input type="email" class="form-control" id="email" name="email" required>';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="subject">'.get_string('emailsubject', 'local_emailplugin').'</label>';
echo '<input type="text" class="form-control" id="subject" name="subject" required>';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="message">'.get_string('emailbody', 'local_emailplugin').'</label>';
echo '<textarea class="form-control" id="message" name="message" rows="3" required></textarea>';
echo '</div>';
echo '<button type="submit" class="btn btn-primary">'.get_string('sendemail', 'local_emailplugin').'</button>';
echo '</form>';

echo $OUTPUT->footer();
