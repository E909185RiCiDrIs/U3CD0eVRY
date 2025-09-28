<?php
// 代码生成时间: 2025-09-29 00:01:53
class MonteCarloSimulator {

    /**
     * The number of iterations to run the simulation.
     * @var int
     */
    private $iterations;

    /**
     * Constructor to initialize the number of iterations.
     *
     * @param int $iterations
     */
    public function __construct($iterations) {
        $this->iterations = $iterations;
    }

    /**
     * Estimates the value of pi using the Monte Carlo method.
     *
     * @return float The estimated value of pi.
     */
    public function estimatePi() {
        $pointsInsideCircle = 0;
        $totalPoints = $this->iterations;

        for ($i = 0; $i < $totalPoints; $i++) {
            $x = $this->randomFloat(-1, 1);
            $y = $this->randomFloat(-1, 1);
            if ($this->isPointInsideCircle($x, $y)) {
                $pointsInsideCircle++;
            }
        }

        return ($pointsInsideCircle / $totalPoints) * 4;
    }

    /**
     * Generates a random float between $min and $max.
     *
     * @param float $min
     * @param float $max
     * @return float
     */
    private function randomFloat($min, $max) {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }

    /**
     * Checks if a point is inside a circle with radius 1.
     *
     * @param float $x
     * @param float $y
     * @return bool
     */
    private function isPointInsideCircle($x, $y) {
        return $x * $x + $y * $y <= 1;
    }
}

// Example usage
try {
    $simulator = new MonteCarloSimulator(1000000);
    $piEstimate = $simulator->estimatePi();
    echo "Estimated Pi: $piEstimate
";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "
";
}
