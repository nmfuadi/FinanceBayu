<?php $data['path'] = $path; ?>
<?php $data['LOAD_JAVASCRIPT'] = $LOAD_JAVASCRIPT; ?>
<?php $data['LOAD_BOTTOM_JS'] = $LOAD_BOTTOM_JS; ?>
<?php $data['LOAD_STYLE'] = $LOAD_STYLE; ?>
<?php $this->load->view('marketing/base/header', $data); ?>
<?php $this->load->view($view_file, $data); ?>
<?php $this->load->view('marketing/base/footer', $data); ?>