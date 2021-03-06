<?php

class TranscriptUI
{
    var $trid; //transcript id
    var $shorttrid; //short id
    var $options; //display options
    var $tiers; //data tiers
    var $speakernames; //speaker names
    var $tcuCount = 0; //number of result documents
    var $hitCount = 0; //number of hits if a search
    var $render; //array of rendered components

    //constructor
    function __construct($trid, $options)
    {
        $this->shorttrid = $trid;
        $this->trid = 'trid-' . $trid;
        $this->options = $options;
        $this->tiers = isset($options['tiers']) ? $options['tiers'] : transcripts_ui_tiers();
        $this->speakernames = transcripts_ui_speaker_names();
        list($tcus, $highlights) = transcripts_apachesolr_transcripts_ui_transcript($this);
        $this->createUI($tcus, $highlights);
    }

    //query
    function createUI($timecodeunits, $highlights)
    {
        $this->tcuCount = count($timecodeunits);
        $tiers = $this->tiers;
        $speakernames = $this->speakernames;

        $highlight = $highlights !== NULL ? TRUE : FALSE;
        $hitCount = 0;

        $last_speaker_tiers = array();
        $tcus = array();

        foreach ($timecodeunits as $sentence) {
            $speaker_tiers = array();
            foreach (array_keys($speakernames) as $tier) {
                if (isset($sentence[$tier])) {
                    $speaker_tiers[$tier] = $sentence[$tier];
                }
            }
            $speaker = implode('/', array_values($speaker_tiers));

            list($tier_list, $hits) = transcripts_ui_merge_highlights($sentence, $highlights, $tiers);
            $hitCount += $hits;

            $speaker_turn = $speaker_tiers == $last_speaker_tiers ? 'same-speaker' : 'new-speaker';
            $tcus[] = transcripts_ui_tcu($sentence, $speaker_turn, $speaker_tiers, $tier_list);
            $last_speaker_tiers = $speaker_tiers;
        }

        $this->hitCount = $hitCount;

        //hits_only part is a bit of a hack to still return new search form for empty term searches
        if (strlen($this->options['term']) > 0 || (isset($this->options['hits_only']) && $this->options['hits_only'])) {
            $this->render['transcript_search'] = array(
                'transcript_search' => array(
                    '#theme' => 'transcripts_ui_transcript_search',
                    //'search_form' => drupal_get_form('transcripts_ui_search_form', $this),
                ),
            );
        }

        $transcript = array(
            'contents' => array(
                '#prefix' => "<ul class='list-group'>",
                'tcu_list' => $tcus,
                '#suffix' => "</ul>",
            ),
            '#trid' => $this->trid,
            '#prefix' => "<div id='transcripts-ui-transcript-{$this->trid}' class='scroller' data-transcripts-role='transcript' data-transcripts-id='{$this->trid}'>",
            '#suffix' => "</div>",
        );
        $tcu_list = "<ul class='list-group'>" .implode('', $tcus). "</ul>";
	$this->render['transcript'] = "<div id='transcripts-ui-transcript-{$this->trid}' class='scroller' data-hidden-tiers='" .transcripts_ui_hidden_tiers(). "' data-transcripts-role='transcript' data-transcripts-id='{$this->trid}'>" .$tcu_list. "</div>";
    }
}
