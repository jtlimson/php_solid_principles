<?php

/** 
 * SOLID: The First 5 Principles of Object Oriented Design
 * S: Single Responsibility Principle (SRP)
 * States that a class should have only one reason to change, meaning it should have only one job or responsibility. This principle helps in making the system easier to understand and maintain.
 * According to SRP, we should separate the concerns into different classes rather than having a single class handling multiple responsibilities. 
 */

/**
 * Example:
 * In this case, we might have one class for user data management, another for user persistence (e.g., database operations), and yet another * &* for user notification (e.g., sending emails).
 */
class User {
    private $name;
    private $email;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }
}

class UserDataManager {
    public function createUser($name, $email) {
        // Validate the input data
        if (empty($name) || empty($email)) {
            throw new Exception("Name and email cannot be empty.");
        }

        // Assuming validation passes, we create a new User instance.
        return new User($name, $email);
    }
}

class UserRepository {
    public function saveUser(User $user) {
        // Logic to save the user to a database
        echo "Saving {$user->getName()} to the database.\n";
    }
}

class UserNotification {
    public function sendWelcomeEmail(User $user) {
        // Logic to send a welcome email to the user
        echo "Sending welcome email to {$user->getEmail()}.\n";
    }
}

// Usage
$userDataManager = new UserDataManager();
$user = $userDataManager->createUser("John Doe", "john.doe@example.com");

$userRepository = new UserRepository();
$userRepository->saveUser($user);

$userNotification = new UserNotification();
$userNotification->sendWelcomeEmail($user);
