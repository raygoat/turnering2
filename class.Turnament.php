<?php

class Turnament {

	private $db_table_name = 'turnering';
	private $kreds = 0;
	private $alder = 1;
	private $syvMands = false;
	private $turnament_data = [];

	private function getTurnamentLayout() {
		global $wpdb;
		$turnament_table = $wpdb->prefix . $this->db_table_name;
		$query = "SELECT * FROM " . $turnament_table . " ORDER BY kreds;";
		$this->turnament_data = $wpdb->get_results($query, ARRAY_N);
	}

	public function showTurnament() {
		$this->getTurnamentLayout();
		// init age counter
		$alder = "";

		// Overskrift
		echo '<p><h2>ØOB turnering ';
        echo '2016 / 2017';
		echo '</h2></p>';

		//start første linie
		echo "<table><tr><td><b>11-Mands</b></td></tr><tr>";

		// Gennemløb alle kredse
		foreach ($this->turnament_data as $kreds) {
			if ( $kreds[$this->alder] != $alder ) { //then it is a new age-group
				if ( $kreds[$this->alder] != "" ){echo '</td>';} //only if not first time
				if ( strpos( $kreds[$this->alder], "/") && !$this->syvMands ) {
					echo "</tr><tr><td><b>7-Mands</b></td></tr><tr>";
					$this->syvMands = true;
				}
				echo "<td style='padding: 1em; vertical-align:top;'><b>" . $this->formatAlder( $kreds[$this->alder] ) . "</b><br />";
			}
			echo "<a href=" . get_permalink() . "?a=" . $this->formatAlder( $kreds[$this->alder] ) . "&k=" . $kreds[$this->kreds] . ">";
			echo "kreds " . $kreds[$this->kreds] . "</a><br/>";
			$alder = $kreds[$this->alder];
		}

		// Slut sidste linie og tabellen
		echo "</td></tr></table>";

	}

	/** Formatting helper functions **/

	private function formatAlder( $alder ) {
		return str_replace( "/7", "", $alder );
	}

}
