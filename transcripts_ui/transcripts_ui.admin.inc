<?php

function transcripts_ui_admin()
{
    $form['transcripts_ui_tier_settings']['transcripts_ui_speaker_names'] = array(
        '#title' => t('Speaker names'),
        '#type' => 'textarea',
        '#rows' => 10,
        '#default_value' => list_allowed_values_string(variable_get('transcripts_ui_speaker_names', $default_speaker_names)),
        '#description' => t('Enter a list of speaker name display formats, one per line, each in the form SPEAKER_NAME_DISPLAY_ID|SPEAKER_NAME_DISPLAY_FORMAT.'),
        '#required' => TRUE,
    );
}
