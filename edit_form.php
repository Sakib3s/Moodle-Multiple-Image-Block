<?php

class block_edash_banner_1_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edashFontList = include($CFG->dirroot . '/theme/edash/inc/font_handler/edash_font_select.php');

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edash'));
        $mform->setDefault('config_title', 'Start learning from the world’s best institutions');
        $mform->setType('config_title', PARAM_RAW);

        // Body
        $editoroptions = array('maxfiles' => EDITOR_UNLIMITED_FILES, 'noclean'=>true, 'context'=>$this->block->context);
        $mform->addElement('editor', 'config_body', get_string('config_body', 'theme_edash'), null, $editoroptions);
        $mform->addRule('config_body', null, 'required', null, 'client');
        $mform->setType('config_body', PARAM_RAW); // XSS is prevented when printing the block contents and serving files

        // Search Placeholder Text
        $mform->addElement('text', 'config_search_placeholder', get_string('config_search_placeholder', 'block_edash_banner_1'));
        $mform->setDefault('config_search_placeholder', 'What do you want to learn today?');
        $mform->setType('config_search_placeholder', PARAM_RAW);

        // Search Button Text
        $mform->addElement('text', 'config_search_btn', get_string('config_search_btn', 'block_edash_banner_1'));
        $mform->setDefault('config_search_btn', 'Search');
        $mform->setType('config_search_btn', PARAM_RAW);

        $select = $mform->addElement('select', 'config_button_icon', get_string('config_button_icon', 'block_edash_banner_1'), $edashFontList, array('class'=>'edash_icon_class'));
        $select->setSelected('flaticon-search');

        // Body
        $editoroptions = array('maxfiles' => EDITOR_UNLIMITED_FILES, 'noclean'=>true, 'context'=>$this->block->context);
        $mform->addElement('editor', 'config_support_text', get_string('config_support_text', 'block_edash_banner_1'), null, $editoroptions);
        $mform->addRule('config_support_text', null, 'required', null, 'client');
        $mform->setType('config_support_text', PARAM_RAW); // XSS is prevented when printing the block contents and serving files

        // Banner Button Text
        $mform->addElement('text', 'config_banner_btn', get_string('config_banner_btn', 'block_edash_banner_1'));
        $mform->setDefault('config_banner_btn', 'Discover all courses');
        $mform->setType('config_banner_btn', PARAM_RAW);

        // Banner Button Link
        $mform->addElement('text', 'config_banner_btn_link', get_string('config_banner_btn', 'block_edash_banner_1'));
        $mform->setDefault('config_banner_btn_link', '#');
        $mform->setType('config_banner_btn_link', PARAM_RAW);

        // Banner Button Icon
        $select = $mform->addElement('select', 'config_banner_btn_icon', get_string('config_banner_btn_icon', 'block_edash_banner_1'), $edashFontList, array('class'=>'edash_icon_class'));
         $select->setSelected('flaticon-redo');

     
         // Image
        $mform->addElement('filemanager', 'config_image', 'dfd', null,
        array('subdirs' => 0, 'maxbytes' => EDITOR_UNLIMITED_FILES, 'areamaxbytes' => 10485760, 'maxfiles' => 1,
        'accepted_types' => array('.png', '.jpg', '.gif') ));
    }

    function set_data($defaults){
        // Begin CCN Image Processing
        if (empty($entry->id)) {
            $entry = new stdClass;
            $entry->id = null;
        }
        $draftitemid = file_get_submitted_draft_itemid('config_image');
        file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_edash_banner_1', 'content', 0,
            array('subdirs' => true));
        $entry->attachments = $draftitemid;
        parent::set_data($defaults);
        if ($data = parent::get_data()) {
            file_save_draft_area_files($data->config_image, $this->block->context->id, 'block_edash_banner_1', 'content', 0,
                array('subdirs' => true));
        }
    }
}
