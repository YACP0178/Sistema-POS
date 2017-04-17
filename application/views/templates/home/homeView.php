<?php
	echo "<h3><b>Bienvenido... </b>".$this->session->userdata('name')." ".$this->session->userdata('lastname')."</h3>";
	echo "<h3><b>Usuario:</b> ".$this->session->userdata('username')."</h3>";
?>