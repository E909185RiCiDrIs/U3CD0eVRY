<?php
// 代码生成时间: 2025-08-11 12:00:21
class TestDataGenerator {

    /**
     * Generate a random name
     *
     * @return string
     */
    public function generateName() {
        $firstNames = ['John', 'Jane', 'Alice', 'Bob'];
        $lastNames = ['Doe', 'Smith', 'Johnson', 'Williams'];
        $firstName = $firstNames[array_rand($firstNames)];
        $lastName = $lastNames[array_rand($lastNames)];
        return $firstName . ' ' . $lastName;
    }

    /**
     * Generate a random email address
     *
     * @return string
     */
    public function generateEmail() {
        $domains = ['@example.com', '@test.com', '@sample.com'];
        $name = $this->generateName();
        $email = str_replace(' ', '.', $name) . array_rand($domains);
        return $email;
    }

    /**
     * Generate a random date within the last 10 years
     *
     * @return string
     */
    public function generateDate() {
        $min = new DateTime('-10 years');
        $max = new DateTime('now');
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($min, $interval, $max);
        $randomDate = $dateRange[array_rand(new ArrayIterator($dateRange))];
        return $randomDate->format('Y-m-d');
    }

    /**
     * Generate a set of random data
     *
     * @return array
     */
    public function generateDataSet() {
        try {
            $data = [
                'name' => $this->generateName(),
                'email' => $this->generateEmail(),
                'date' => $this->generateDate()
            ];
            return $data;
        } catch (Exception $e) {
            // Handle any exceptions that may occur during data generation
            error_log('Error generating test data: ' . $e->getMessage());
            return [];
        }
    }
}

// Example usage
$testDataGenerator = new TestDataGenerator();
$dataSet = $testDataGenerator->generateDataSet();
print_r($dataSet);
