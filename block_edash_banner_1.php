<?php
global $CFG;
class block_edash_banner_1 extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edash_banner_1');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edash/inc/block_handler/specialization.php');
    }

    /**
     * The block can be used repeatedly in a page.
     */
    function instance_allow_multiple() {
        return true;
    }

    /**
     * Enables global configuration of the block in settings.php.
     *
     * @return bool True if the global configuration is enabled.
     */
    function has_config() {
        return true;
    }

    public function get_content() {
        global $CFG, $DB;

        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
          return $this->content;
        }

        $this->content         =  new stdClass;
        if(!empty($this->config->title)){
            $this->content->title = $this->config->title;
        }else{
            $this->content->title = '';
        }
        if(isset($this->config->body) && !empty($this->config->body)){
            $this->content->body = $this->config->body['text'];
        }else{
            $this->content->body = '';
        }

        if (\core_search\manager::is_global_search_enabled() === false) {
            $this->content->search_placeholder = '';
        }else{
            if(isset($this->config->search_placeholder) && !empty($this->config->search_placeholder)){
                $this->content->search_placeholder = $this->config->search_placeholder;
            }else{
                $this->content->search_placeholder = '';
            }
        }

        $url = new moodle_url('/search/index.php');

        if(isset($this->config->search_btn) && !empty($this->config->search_btn)){
            $this->content->search_btn = $this->config->search_btn;
        }else{
            $this->content->search_btn = '';
        }

        if(isset($this->config->button_icon) && !empty($this->config->button_icon)){
            $this->content->button_icon = $this->config->button_icon;
        }else{
            $this->content->button_icon = '';
        }

        if(isset($this->config->support_text) && !empty($this->config->support_text)){
            $this->content->support_text = $this->config->support_text['text'];
        }else{
            $this->content->support_text = '';
        }

        if(isset($this->config->banner_btn) && !empty($this->config->banner_btn)){
            $this->content->banner_btn = $this->config->banner_btn;
        }else{
            $this->content->banner_btn = '';
        }

        if(isset($this->config->banner_btn_link) && !empty($this->config->banner_btn_link)){
            $this->content->banner_btn_link = $this->config->banner_btn_link;
        }else{
            $this->content->banner_btn_link = '';
        }

        if(isset($this->config->banner_btn_icon) && !empty($this->config->banner_btn_icon)){
            $this->content->banner_btn_icon = $this->config->banner_btn_icon;
        }else{
            $this->content->banner_btn_icon = '';
        }

        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_edash_banner_1', 'content');
        $this->content->image = '';
        foreach ($files as $file) {
            $filename = $file->get_filename();
            if ($filename <> '.') {
                $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                echo $this->content->image .=  $url;
            }
        }

        $text = '';

        $text .= '
            <div class="main-banner-area">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="main-banner-content">
                                <h1>'.format_text($this->content->title, FORMAT_HTML, array('filter' => true)).'</h1>
                                <div class-main-banner-content-p>'.format_text($this->content->body, FORMAT_HTML, array('filter' => true, 'noclean' => true)).'</div>';

                                if($this->content->search_placeholder):
                                    $text .= '
                                    <form class="search-box" action="'.$url->out().'">
                                        <input type="text" id="searchform_search" name="s"  class="input-search" placeholder="'.format_text($this->content->search_placeholder, FORMAT_HTML, array('filter' => true)).'">
                                        <button type="submit"><i class="'.format_text($this->content->button_icon, FORMAT_HTML, array('filter' => true)).'"></i> '.format_text($this->content->search_btn, FORMAT_HTML, array('filter' => true)).'</button>
                                    </form>';
                                endif;

                                $text .= '
                                <div class="support-box">
                                    <div class="d-flex align-items-center">
                                        <div class="images d-flex align-items-center">
                                            
                                        </div>

                                        '; if($this->content->support_text): $text .= '
                                        <div class="text">
                                            '.format_text($this->content->support_text, FORMAT_HTML, array('filter' => true, 'noclean' => true)).'
                                        </div>
                                        '; endif; $text .= '
                                    </div>
                                </div>
                                ';if($this->content->banner_btn): $text .= '
                                    <a href="'.format_text($this->content->banner_btn_link, FORMAT_HTML, array('filter' => true)).'" class="link-btn"><i class="'.format_text($this->content->banner_btn_icon, FORMAT_HTML, array('filter' => true)).'"></i> '.format_text($this->content->banner_btn, FORMAT_HTML, array('filter' => true)).'</a>
                                '; endif;  $text .= '
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="main-banner-image">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6">

                                        <div class="image">
                                            <img src="#" data-aos="flip-left" data-aos-easing="ease" data-aos-delay="300" alt="banner-image">
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="image">
                                            <img src="assets/img/banner/banner-img2.jpg" data-aos="fade-up" data-aos-easing="ease" data-aos-delay="300" alt="banner-image">
                                        </div>
                                        <div class="image">
                                            <img src="assets/img/banner/banner-img3.jpg" data-aos="fade-down" data-aos-easing="ease" data-aos-delay="300" alt="banner-image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shape1"><img src="assets/img/shape/shape1.png" alt="shape"></div>
                <div class="shape2" data-speed="0.10" data-revert="true"><img src="assets/img/shape/shape2.png" alt="shape"></div>
                <div class="shape3" data-speed="0.10" data-revert="true"><img src="assets/img/shape/shape3.png" alt="shape"></div>
            </div>
        ';

        $this->content         =  new stdClass;
        $this->content->footer = '';
        $this->content->text   = $text;

        return $this->content;
    }

}