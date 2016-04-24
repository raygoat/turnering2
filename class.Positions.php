<?php

require_once 'class.DBU.php';

class Positions {

	private $kreds;
	private $age;
	private $positions = [];

	public function setKreds( $kreds ) {
		$this->kreds = $kreds;
	}

	public function setAge( $age ) {
		$this->age = $age;
	}

	public function showPositions() {
		if( $this->kreds && $this->age ) {
			$DBU = new DBU();
			$DBU->setAge($this->age);
			$DBU->setKreds($this->kreds);
			$this->positions = $DBU->getPositions();
			$this->formatPositions();
		} else {
			echo "Parameters not correctly set!";
		}
	}

	private function formatPositions() {
		echo "<table><thead><tr><th>Nr</th><th>Hold</th><th>Kampe</th><th>V</th><th>U</th><th>T</th><th>Score</th><th>Points</th></thead>";

		foreach ($this->positions->PositionResult->Position as $position) {
			echo "<tr>" .
			     "<td>" . $position->Pos . "</td>" .
			     "<td>" . $position->Hold . "</td>" .
			     "<td>" . $position->Kampe . "</td>" .
			     "<td>" . $position->Vundne . "</td>" .
			     "<td>" . $position->Uafgjorte . "</td>" .
			     "<td>" . $position->Tabte . "</td>" .
			     "<td>" . $position->ScoreFor . "-" . $position->ScoreImod . "</td>" .
			     "<td>" . $position->Point . "</td>" .
			     "</tr>";
		}
		echo "</table>";
	}

}