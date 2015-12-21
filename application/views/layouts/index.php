<?php
$this->load->view('layouts/header');
$this->load->view('layouts/leftsidebar.php');
$this->load->view($content);
$this->load->view('layouts/rightsidebar.php');
$this->load->view('layouts/footer');