<?php $data['path'] = $path; ?>
<?php $data['LOAD_JAVASCRIPT'] = $LOAD_JAVASCRIPT; ?>
<?php $data['LOAD_BOTTOM_JS'] = $LOAD_BOTTOM_JS; ?>
<?php $data['LOAD_STYLE'] = $LOAD_STYLE; ?>
<?php $data['SIDEBAR'] = $content_sidebar; ?>
<?php $this->load->view('Report/base/header', $data); ?>
<?php $this->load->view('Report/base/sidebar', $data); ?>
<?php $this->load->view($view_file, $data); ?>
<?php $this->load->view('Report/base/footer', $data); ?>