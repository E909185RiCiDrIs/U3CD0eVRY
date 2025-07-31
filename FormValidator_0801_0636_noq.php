<?php
// 代码生成时间: 2025-08-01 06:36:20
class FormValidator {

    /**
     * Validate the form data
     * 
     * @param array \$formData The form data to validate
     * @return array An array containing validation errors or true if valid
     */
    public function validate(array \$formData) {
        \$errors = [];

        // Validate name field
        if (empty(\$formData['name'])) {
            \$errors['name'] = 'Name is required.';
        } elseif (!preg_match('/^[a-zA-Z\s]+$/', \$formData['name'])) {
            \$errors['name'] = 'Name must contain only letters and spaces.';
        }

        // Validate email field
        if (empty(\$formData['email'])) {
            \$errors['email'] = 'Email is required.';
        } elseif (!filter_var(\$formData['email'], FILTER_VALIDATE_EMAIL)) {
            \$errors['email'] = 'Invalid email format.';
        }

        // Validate age field
        if (empty(\$formData['age'])) {
            \$errors['age'] = 'Age is required.';
        } elseif (!is_numeric(\$formData['age']) || (int)\$formData['age'] < 18) {
            \$errors['age'] = 'Age must be a number and at least 18.';
        }

        // Return true if no errors, otherwise return errors array
        return empty(\$errors) ? true : \$errors;
    }
}

// Example usage
\$validator = new FormValidator();
\$formData = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'age' => 25
];

\$result = \$validator->validate(\$formData);

if (\$result === true) {
    echo "Form data is valid.";
} else {
    echo "Form data has errors: ";
    print_r(\$result);
}
