<?php

function theme_transcripts_ui_transcript_controls($vars) {
    $out  = "<div class='btn-group btn-group-justified btn-group-transcript' role='group'>";
    $out .= $vars['transcript_navigation']; 
    $out .= $vars['transcript_searchform'];
    $out .= "</div>";
    $out .= $vars['transcript_searchinfo'];
    $out .= $vars['transcript_tiers'];
    return $out;
}

function theme_transcripts_ui_transcript_navigation() {
    $out  = "<button type='button' class='btn btn-default btn-icon info' title='Info'><span class='fa fa-info' aria-hidden='true'></span></button>";
    $out .= "<button type='button' class='btn btn-default btn-icon languages' title='Languages'><span class='fa fa-language' aria-hidden='true'></span></button>";
    $out .= "<button type='button' class='btn btn-default btn-icon playpause' title='Play/Pause' data-play-icon='fa-play' data-pause-icon='fa-pause'><span class='fa fa-play' aria-hidden='true'></span></button>";
    $out .= "<button type='button' class='btn btn-default btn-icon previous' title='Previous line'><span class='fa fa-step-backward' aria-hidden='true'></span></button>";
    $out .= "<button type='button' class='btn btn-default btn-icon sameagain' title='Same line'><span class='fa fa-repeat' aria-hidden='true'></span></button>";
    $out .= "<button type='button' class='btn btn-default btn-icon next' title='Next line'><span class='fa fa-step-forward' aria-hidden='true'></span></button>";
    return $out;
}

function theme_transcripts_ui_transcript_tiers($tiers)
{
    $out  = "<div style='display:none;' id='tier-selector-wrapper' class='collapsible'>";

    foreach ($tiers as $tier_id => $tier_name) {
        $out .= "<div data-tier='{$tier_id}'><input id='show-{$tier_id}' type='checkbox'> {$tier_name}</div>";
    }

    $out .= "</div>";
    return $out;
}

function theme_transcripts_ui_transcript_searchform($vars)
{
    $out  = '<form id="transcript-searchform" method="get" action="' .$vars['url']. '" role="search">';
    $out .= '<label class="assistive-text" for="q">Search</label>';
    $out .= '<input id="q" class="field" name="q" value="" placeholder="Search transcript …" type="text">';
    $out .= '<input id="searchsubmit" class="submit" name="submit" value="Search" type="submit">';
    $out .= '</form>';
    return $out;
}

function theme_transcripts_ui_transcript_searchinfo($vars)
{
    $out  = "<div id='transcript-search-wrapper' class='collapsible'>";
    if ($vars['q'] != '') {
      $out .= sprintf(_n("%s matching line", "%s matching lines", $vars['n']), $vars['n']). " for search term <em>" .$vars['q']. "</em>.";
    }
    $out .= "</div>";
    return $out;
}

function theme_transcripts_ui_speaker_name($vars)
{
    $vars['classes'][] = 'speaker-display';
    $classes = implode(' ', $vars['classes']);
    $out  = "<div class='speaker-name {$vars['speaker_turn']}'>";
    if (is_array($vars['speaker_name'])) {
        foreach ($vars['speaker_name'] as $speaker_display => $speaker_name) {
            $key = $speaker_display; //check_plain($speaker_display);
            $val = $speaker_name; //check_plain($speaker_name);
            $out .= "<span data-speaker-display='$key' class='$classes'>$val</span> ";
        }
    }
    $out .= "</div>";
    return $out;
}

function theme_transcripts_ui_tcu_tier($vars)
{
    $vars['classes'][] = 'tier';
    $classes = implode(' ', $vars['classes']);
    $tier_name = $vars['tier_name']; //check_plain($vars['tier_name']);
    $tier_text = $vars['tier_text']; //filter_xss($vars['tier_text'], array('mark')); // let through <mark> for highlighting hits
    $out = "<div data-tier='{$tier_name}' class='$classes'>{$tier_text}</div>";
    return $out;
}

function theme_transcripts_ui_play_tcu($vars)
{
    $mins = floor($vars['time'] / 60);
    $secs = $vars['time'] % 60;
    $time = sprintf("%d:%02d", $mins, $secs);
    $classes = 'btn btn-default btn-sm btn-icon play-tcu';
    $classes .= $vars['timecoded'] ? ' timed' : ' untimed';
    $out = "<button type='button' class='" .$classes ."' title='Play line'><span class='fa fa-play' aria-hidden='true'></span> ";
    $out .= $time;
    if (isset($vars['text'])) {
        $out .= " " . $vars['text'];
    }
    $out .= "</button>";
    return $out;
}
