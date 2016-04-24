<?php

class Finals {
	private $finalsTableName = 'finaler';

	public function displayFinalRounds( $kreds ) {
		$finalRounds = $this->getFinalRounds( $kreds );
		if( $finalRounds ) {
			echo "<h2>Afsluttende runder</h2>";
			echo "<table id='turnering_table'><thead><tr><th>Spilletid</th><th>Hold 1</th><th>Hold 2</th><th class='turn-center'>Resultat</th><th>Spillested</th></thead>";

			foreach ($finalRounds as $match) {
				echo "<tr>" .
				     "<td>" . $this->formatDate( $match[3] ) . "</td>" .
				     "<td>" . $match[4] . "</td>" .
				     "<td>" . $match[5] . "</td>" .
				     "<td style='text-align: center'>" . " - " . "</td>" .
				     "<td>" . "" . "</td>" .
				     "</tr>";
			}
			echo "</table>";
			return true;
		} else {
			return false;
		}
	}

	private function getFinalRounds( $kreds ) {
		global $wpdb;
		$oob_db = $wpdb->prefix . $this->finalsTableName;
		$query = "SELECT * FROM " . $oob_db . " WHERE Kreds=" . $kreds . " ORDER BY Dato, Hjemmehold;";
		$finals = $wpdb->get_results($query, ARRAY_N);

		if( is_array( $finals ) ) {
			return $finals;
		} else {
			return false;
		}
	}

	private function formatDate( $dato ) {
		$date = strtotime( substr( $dato, 0, 10) );
		return date( 'd-m-Y', $date ) . " " . substr( $dato, 11, 5);
	}

}
